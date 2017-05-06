<?
$show_all = false;
if ($mode == "all")
    $show_all = true;

$campaign_id = $_SESSION['campaign'];
if ($campaign_id == 0)
    $campaign_id = 1; // default campaign

$query = "SELECT * FROM `" . $config['sql_campaigns'] . "` ORDER BY date ASC";
$resultcampaign = mysqli_query($link, $query);

// god I hate doing all of this here but whatever
// if has password
$query = "SELECT * FROM `" . $config['sql_campaigns'] . "` WHERE id='$campaign_id'";
$result = mysqli_query($link, $query);
$campaign_data = mysqli_fetch_assoc($result);

$has_password = $campaign_data['password'] !== "";

$enter_password = false;
if ($has_password) {
    if ($_SESSION['campaign_access'][$campaign_id])
        $enter_password = false;
    else
        $enter_password = true;
}

// show password entry
if ($enter_password) {
?>

<div class="toolbar">
    <div class="container">
        <div class="row">
            <div class="column column-40">
                <label><?=say('select_campaign')?></label>
                <select id="campaign_choice">
                    <? while ($row = mysqli_fetch_assoc($resultcampaign)) { ?>
                    <option value="<?=$row['id']?>"><?=$row['name']?></option>
                    <? } mysqli_data_seek($resultcampaign, 0); ?>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="toolbar-under"></div>
<div class="container">
    <h1><?=say('passkey_required')?></h1>
    <div class="column">
        <label><?=say('passkey')?></label>
        <input type="text" data="passkey" />
    </div>
    <div class="column" align="right">
        <input type="submit" value="<?=say('submit')?>" onclick="passkey()"/>
    </div>
    <div class="row">
        <div class="column">
            <p id="message" class="warning"></p>
        </div>
    </div>
</div>
<script>
$(function() {
    $('input').keypress(function (e) {
        if (e.which == 13) {
            e.preventDefault();
            passkey();
        }
    });
    $('#message').hide();
});

function passkey() {
    $.post("/p", {
        mode: "campaign_passkey",
        token: $('#session-token').val(),
        passkey: $('[data="passkey"]').val(),
        id: <?=$_SESSION['campaign']?>
    },
    function(data, status) {
        if (data == true)
            location.reload();
        else {
            $("#message").text("<?=say('invald_passkey')?>");
            $('#message').show();
        }
    });
}

$('#campaign_choice').change(function() {
    $.post("/p", {
        mode: "set_campaign",
        token: $('#session-token').val(),
        id: $(this).val()
    },
    function(data, status) {
        location.reload();
    });
});

$('#campaign_choice').val(<?=$campaign_id?>);
</script>
<?

} // entering password
// if password accepted, show characters
// or no password, show characters
if (!$enter_password) { // big ole if statement cause why not

if ($show_all)
    $query = "SELECT * FROM `" . $config['sql_table'] . "` WHERE campaign='$campaign_id' ORDER BY sheet_type, charname";
else
    $query = "SELECT * FROM `" . $config['sql_table'] . "` WHERE (`is_retired` IS NULL OR `is_retired` <> 1) AND campaign='$campaign_id' ORDER BY sheet_type, charname";

$result = mysqli_query($link, $query);
?>
<div class="toolbar">
    <div class="container">
        <div class="row">
            <div class="column column-40">
                <label><?=say('select_campaign')?></label>
                <select id="campaign_choice">
                    <? while ($row = mysqli_fetch_assoc($resultcampaign)) { ?>
                    <option value="<?=$row['id']?>"><?=$row['name']?></option>
                    <? } mysqli_data_seek($resultcampaign, 0); ?>
                </select>
            </div>
            <div class="column" align="right">
                <label>&nbsp;</label>
                <input type="submit" value="<?=say('view_active')?>" onclick="goTo('/gm')">
                <input type="submit" value="<?=say('view_all')?>" onclick="goTo('/all')">
                <input type="submit" value="<?=say('button_compact')?>" onclick="goTo('/gmc/')">
                <input type="submit" value="<?=say('button_refresh')?>" onclick="refresh()">
            </div>
        </div>
    </div>
</div>
<div class="toolbar-under"></div>
<div class="container">
    <h1>
        <? if ($show_all) { ?>
        <?=say('all_chars')?>
        <? } else { ?>
        <?=say('active_chars')?>
        <? } ?>
    </h1>
    <? while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="entry highlight" row="<?=$row['id']?>" sheet-view="<?=$row['publicid']?>">
            <div class="row">
                <div class="column column-20">
                    <p class="strong"><?=$row['sheetname']?></p>
                </div>
                <div class="column column-25">
                    <p class="strong">
                        <span class="glyphicon glyphicon-star"></span>
                        <a href="/v/<?=$row['publicid']?>" target="_blank"><?=$row['charname']?></a></p>
                </div>
                <div class="column column-15">
                    <p><?=$row['playername']?></p>
                </div>
                <div class="column column-10" style="vertical-align: middle;">
                    <p><?=date("m/d/y", strtotime($row['date']))?></p>
                </div>
                <div class="column column-10">
                    <select saveas="sheet_type">
                        <option value="4"></option>
                        <option value="0-pc"><?=say('player')?></option>
                        <option value="1-npc"><?=say('npc')?></option>
                        <option value="3-enemy"><?=say('enemy')?></option>
                    </select>
                </div>
                <div class="column" align="right">
                    <input type="submit" value="<?=say('button_view')?>" onclick="goTo('/v/<?=$row['publicid']?>')">
                    <input type="submit" value="<?=say('button_edit')?>" onclick="goTo('/e/<?=$row['editid']?>')">
                    <input type="submit" value="+" onclick="revealMore(this)">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label><?=say('init')?></label>
                    <h4 loadvalue="final_init"></h4>
                </div>
                <div class="column">
                    <label><?=say('ac')?></label>
                    <h4 loadvalue="final_ac"></h4>
                </div>
                <div class="column">
                    <label><?=say('touch')?></label>
                    <h4 loadvalue="final_touch"></h4>
                </div>
                <div class="column">
                    <label><?=say('flat')?></label>
                    <h4 loadvalue="final_flatfoot"></h4>
                </div>
                <div class="column">
                    <label><?=say('hp')?></label>
                    <h4 loadvalue="final_hp_current" class="strong"></h4>
                </div>
                <div class="column">
                    <label><?=say('nonl')?></label>
                    <h4 loadvalue="health_nonlethal"></h4>
                </div>
                <div class="column">
                    <label><?=say('fort')?></label>
                    <h4 loadvalue="final_fort"></h4>
                </div>
                <div class="column">
                    <label><?=say('ref')?></label>
                    <h4 loadvalue="final_ref"></h4>
                </div><div class="column">
                    <label><?=say('will')?></label>
                    <h4 loadvalue="final_will"></h4>
                </div>
                <div class="column">
                    <label><?=say('perc')?></label>
                    <h4 loadvalue="final_skill" loadsearch="skill_name" loadmatch="Perception"></h4>
                </div>
                <div class="column">
                    <label><?=say('stealth')?></label>
                    <h4 loadvalue="final_skill" loadsearch="skill_name" loadmatch="Stealth"></h4>
                </div>
                <div class="column">
                    <label><?=say('melee')?></label>
                    <h4 loadvalue="final_melee"></h4>
                </div>
                <div class="column">
                    <label><?=say('range')?></label>
                    <h4 loadvalue="final_ranged"></h4>
                </div>
                <div class="column">
                    <label><?=say('cmb')?></label>
                    <h4 loadvalue="final_cmb"></h4>
                </div>
                <div class="column">
                    <label><?=say('cmd')?></label>
                    <h4 loadvalue="final_cmd"></h4>
                </div>
            </div>
            <div class="row reveal" style="padding-bottom:0">
                <div class="column">
                    <label><?=say('str')?></label>
                    <h4 loadvalue="final_str_total">0</h4>
                </div>
                <div class="column">
                    <label><?=say('dex')?></label>
                    <h4 loadvalue="final_dex_total">0</h4>
                </div>
                <div class="column">
                    <label><?=say('con')?></label>
                    <h4 loadvalue="final_con_total">0</h4>
                </div>
                <div class="column">
                    <label><?=say('int')?></label>
                    <h4 loadvalue="final_int_total">0</h4>
                </div>
                <div class="column">
                    <label><?=say('wis')?></label>
                    <h4 loadvalue="final_wis_total">0</h4>
                </div>
                <div class="column">
                    <label><?=say('cha')?></label>
                    <h4 loadvalue="final_cha_total">0</h4>
                </div>
                <div class="column">
                    <label><?=say('bab')?></label>
                    <h4 loadvalue="final_bab">0</h4>
                </div>
                <div class="column">
                    <label><?=say('bluff')?></label>
                    <h4 loadvalue="final_skill" loadsearch="skill_name" loadmatch="Bluff"></h4>
                </div>
                <div class="column">
                    <label><?=say('senmo')?></label>
                    <h4 loadvalue="final_skill" loadsearch="skill_name" loadmatch="Sense%20Motive"></h4>
                </div>
                <div class="column">
                    <label><?=say('disguise')?></label>
                    <h4 loadvalue="final_skill" loadsearch="skill_name" loadmatch="Disguise"></h4>
                </div>
                <div class="column">
                    <label><?=say('sp_craft')?></label>
                    <h4 loadvalue="final_skill" loadsearch="skill_name" loadmatch="Spellcraft"></h4>
                </div>
            </div>
            <div class="row reveal">
                <div class="column">
                    <label><?=say('languages')?></label>
                    <select data="languages">
                        <option>Common</option>
                    </select>
                </div>
                <div class="column column-40">
                    <label><?=say('campaign')?></label>
                    <select data="campaign">
                        <option value="0"><?=say('send_campaign')?></option>
                        <? while ($rowc = mysqli_fetch_assoc($resultcampaign)) { ?>
                        <option value="<?=$rowc['id']?>"><?=$rowc['name']?></option>
                        <? } mysqli_data_seek($resultcampaign, 0); ?>
                    </select>
                </div>
                <div class="column column-30" align="right">
                    <label>&nbsp;</label>
                    <input type="submit" value="<?=say('button_retire')?>" onclick="retireRow('<?=$row['id']?>')" data="retire">
                    <input type="submit" value="<?=say('button_restore')?>" onclick="restoreRow('<?=$row['id']?>')" data="restore">
                    <input type="submit" value="<?=say('button_delete')?>" onclick="deleteRow('<?=$row['id']?>')" data="delete">
                </div>
            </div>
        </div>
    <? } ?>
    <div class="row">
        <div class="column">
            <? if ($is_god) { ?>
            <input type="submit" value="<?=say('admin_view')?>" onclick="goTo('/admin')">
            <? } ?>
            <input type="submit" value="<?=say('user_view')?>" onclick="goTo(/user/)">
            <input type="submit" value="<?=say('new_sheet')?>" onclick="createNew()">
            <input type="submit" value="<?=say('log_out')?>" onclick="logout()">
        </div>
    </div>
</div>
<input type="hidden" id="message-sheet-delete" value="<?=say('sheet_delete')?>" />
<input type="hidden" id="message-sheet-cant-delete" value="<?=say('sheet_cant_delete')?>" />
<input type="hidden" id="message-sheet-retire" value="<?=say('sheet_retire')?>" />
<script src="/js/gm.js"></script>
<script>
$(function() {
    refresh();

    $('.reveal').hide();

    $('[saveas="sheet_type"]').change(function() {
        var row = $(this).parent().parent().parent();
        changeType(this, row);
    });

    $('#campaign_choice').change(function() {
        $.post("/p", {
            mode: "set_campaign",
            token: $('#session-token').val(),
            id: $(this).val()
        },
        function(data, status) {
            location.reload();
        });
    });

    $('#campaign_choice').val(<?=$campaign_id?>);

    setInterval(refresh, 2500);
});

function revealMore(element) {
    var more = $(element).parents('.entry').find('.reveal').slideDown(200);
    $(element).val("-");
    $(element).attr('onclick', 'hideMore(this)');
}
function hideMore(element) {
    var more = $(element).parents('.entry').find('.reveal').slideUp(200);
    $(element).val("+");
    $(element).attr('onclick', 'revealMore(this)');
}

function refresh() {
    $('[sheet-view]').each(function() {
        var viewid = $(this).attr('sheet-view');
        var row = $(this);

        $.post("/p", {
            mode: "load",
            token: $('#session-token').val(),
            viewid: viewid
        },
        function(data, status) {
            var json = JSON.parse(data);

            row.find('h4').each(function() {
                var key = $(this).attr('loadvalue');
                $(this).text(json[key]);

                var match = $(this).attr('loadmatch');
                if (typeof match != 'undefined') {
                    var search = json[$(this).attr('loadsearch')];
                    var dataArray = json[key].split(",");
                    var searchArray = search.split(",");
                    for(var i = 0; i < dataArray.length; i++) {
                        if (searchArray[i].includes(match)) {
                            $(this).text(dataArray[i]);
                            break;
                        }
                    }
                }
            });
            row.find('[saveas="sheet_type"]').val(json['sheet_type']);
            row.find('[saveas="sheet_type"]').trigger('change');

            var languageDropdown = row.find('select[data="languages"]');
            languageDropdown.empty();
            json['known_languages'].split(",").forEach(function(lang) {
                $('<option />', {value: lang, text: lang}).appendTo($(languageDropdown));
            })

            if (json['is_retired'] == '1') {
                row.addClass('retired');
                row.find('[data="retire"]').hide();
                row.find('[data="restore"]').show();
                row.find('[data="delete"]').show();
            }
            else {
                row.removeClass('retired');
                row.find('[data="retire"]').show();
                row.find('[data="restore"]').hide();
                row.find('[data="delete"]').hide();
            }

            var campaignSelect = row.find('select[data="campaign"]');
            campaignSelect.off();
            campaignSelect.change(function() {
                var c = campaignSelect.val();
                if (c == 0)
                    return;
                if (c == <?=$campaign_id?>)
                    return;

                var id = row.attr('row');

                // do the post stuff
                $.post("/p", {
                    mode: "change_campaign",
                    token: $('#session-token').val(),
                    id: id,
                    campaign: c
                },
                function(data, status) {
                    // hide character.
                    row.remove();
                });
            });
        });
    });
}
</script>
<?
} // enter_password is false
?>
