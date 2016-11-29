<?
$show_all = false;
if ($mode == "all")
    $show_all = true;

if ($show_all)
    $query = "SELECT * FROM `" . $config['sql_table'] . "` ORDER BY sheet_type, charname";
else
    $query = "SELECT * FROM `" . $config['sql_table'] . "` WHERE `is_retired` IS NULL OR `is_retired` <> 1 ORDER BY sheet_type, charname";

$result = mysqli_query($link, $query);
?>
<div class="toolbar">
    <div class="container">
        <div class="row">
            <div class="column" align="right">
                <label>&nbsp;</label>
                <input type="submit" value="Download All" onclick="download()">
                <input type="submit" value="View Active" onclick="goTo('/')">
                <input type="submit" value="View All" onclick="goTo('/all')">
                <input type="submit" value="Compact View" onclick="goTo('/gmc/')">
                <input type="submit" value="Refresh Sheets" onclick="refresh()">
            </div>
        </div>
    </div>
</div>
<div class="toolbar-under"></div>
<div class="container">
    <h1>
        <? if ($show_all) { ?>
        All Characters
        <? } else { ?>
        Active Characters
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
                        <option value="0-pc">Player</option>
                        <option value="1-npc">NPC</option>
                        <option value="3-enemy">Enemy</option>
                    </select>
                </div>
                <div class="column" align="right">
                    <input type="submit" value="View" onclick="goTo('/v/<?=$row['publicid']?>')">
                    <input type="submit" value="Edit" onclick="goTo('/e/<?=$row['editid']?>')">
                    <input type="submit" value="+" onclick="revealMore(this)">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label>Init</label>
                    <h4 loadvalue="final_init"></h4>
                </div>
                <div class="column">
                    <label>AC</label>
                    <h4 loadvalue="final_ac"></h4>
                </div>
                <div class="column">
                    <label>Touch</label>
                    <h4 loadvalue="final_touch"></h4>
                </div>
                <div class="column">
                    <label>Flat</label>
                    <h4 loadvalue="final_flatfoot"></h4>
                </div>
                <div class="column">
                    <label>HP</label>
                    <h4 loadvalue="final_hp_current"></h4>
                </div>
                <div class="column">
                    <label>NonL</label>
                    <h4 loadvalue="health_nonlethal"></h4>
                </div>
                <div class="column">
                    <label>Fort</label>
                    <h4 loadvalue="final_fort"></h4>
                </div>
                <div class="column">
                    <label>Ref</label>
                    <h4 loadvalue="final_ref"></h4>
                </div><div class="column">
                    <label>Will</label>
                    <h4 loadvalue="final_will"></h4>
                </div>
                <div class="column">
                    <label>Perc</label>
                    <h4 loadvalue="final_skill" loadsearch="skill_name" loadmatch="Perception"></h4>
                </div>
                <div class="column">
                    <label>Stealth</label>
                    <h4 loadvalue="final_skill" loadsearch="skill_name" loadmatch="Stealth"></h4>
                </div>
                <div class="column">
                    <label>Melee</label>
                    <h4 loadvalue="final_melee"></h4>
                </div>
                <div class="column">
                    <label>Range</label>
                    <h4 loadvalue="final_ranged"></h4>
                </div>
                <div class="column">
                    <label>CMB</label>
                    <h4 loadvalue="final_cmb"></h4>
                </div>
                <div class="column">
                    <label>CMD</label>
                    <h4 loadvalue="final_cmd"></h4>
                </div>
            </div>
            <div class="row reveal">
                <div class="column">
                    <label>STR</label>
                    <h4 loadvalue="final_str_total">0</h4>
                </div>
                <div class="column">
                    <label>DEX</label>
                    <h4 loadvalue="final_str_total">0</h4>
                </div>
                <div class="column">
                    <label>CON</label>
                    <h4 loadvalue="final_str_total">0</h4>
                </div>
                <div class="column">
                    <label>INT</label>
                    <h4 loadvalue="final_str_total">0</h4>
                </div>
                <div class="column">
                    <label>WIS</label>
                    <h4 loadvalue="final_str_total">0</h4>
                </div>
                <div class="column">
                    <label>CHA</label>
                    <h4 loadvalue="final_str_total">0</h4>
                </div>
                <div class="column">
                    <label>BAB</label>
                    <h4 loadvalue="final_bab">0</h4>
                </div>
                <div class="column">
                    <label>Bluff</label>
                    <h4 loadvalue="final_skill" loadsearch="skill_name" loadmatch="Bluff"></h4>
                </div>
                <div class="column">
                    <label>Sen Mo</label>
                    <h4 loadvalue="final_skill" loadsearch="skill_name" loadmatch="Sense%20Motive"></h4>
                </div>
                <div class="column">
                    <label>Disguise</label>
                    <h4 loadvalue="final_skill" loadsearch="skill_name" loadmatch="Disguise"></h4>
                </div>
                <div class="column">
                    <label>Sp&nbsp;Craft</label>
                    <h4 loadvalue="final_skill" loadsearch="skill_name" loadmatch="Spellcraft"></h4>
                </div>

                <div class="column column-20" align="right">
                    <label>&nbsp;</label>
                    <input type="submit" value="Retire" onclick="retireRow('<?=$row['id']?>')">
                    <input type="submit" value="Restore" onclick="restoreRow('<?=$row['id']?>')">
                    <input type="submit" value="Delete" onclick="deleteRow('<?=$row['id']?>')">
                </div>
            </div>
        </div>
    <? } ?>
    <div class="row">
        <div class="column">
            <input type="submit" value="User Page" onclick="goTo(/user/)">
            <input type="submit" value="New Sheet" onclick="createNew()">
            <input type="submit" value="Log Out" onclick="logout()">
        </div>
    </div>
</div>
<script src="/js/gm.js"></script>
<script>
$(function() {
    refresh();

    $('.reveal').hide();

    $('[saveas="sheet_type"]').change(function() {
        var row = $(this).parent().parent().parent();
        changeType(this, row);
    });

    setInterval(refresh, 5000);
});

function download() {
    $.post("/p", {
        token: $('#session-token').val(),
        mode: "zip_export"
    },
    function(data, status) {
        console.log(data);
        location.href = data;
    })
}

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

            if (json['is_retired'] == '1') {
                row.addClass('retired');
                row.find('[value="Retire"]').hide();
                row.find('[value="Restore"]').show();
                row.find('[value="Delete"]').show();
            }
            else {
                row.removeClass('retired');
                row.find('[value="Retire"]').show();
                row.find('[value="Restore"]').hide();
                row.find('[value="Delete"]').hide();
            }
        });
    });
}
</script>
