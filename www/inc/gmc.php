<?
$show_all = false;
if ($info == "all")
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

if ($enter_password) {
    header('Location: /gm');
}

if ($show_all)
    $query = "SELECT * FROM `" . $config['sql_table'] . "` WHERE campaign='$campaign_id' ORDER BY sheet_type, charname";
else
    $query = "SELECT * FROM `" . $config['sql_table'] . "` WHERE (`is_retired` IS NULL OR `is_retired` <> 1) AND campaign='$campaign_id' ORDER BY sheet_type, charname";

$result = mysqli_query($link, $query);

$query = "SELECT * FROM `" . $config['sql_campaigns'] . "` ORDER BY date ASC";
$resultcampaign = mysqli_query($link, $query);
?>
<html>
<head>

<link rel="stylesheet" href="/css/compact/style.css" type="text/css" />
<link rel="icon" type="image/png" href="/favicon.png" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/js/jquery.tagsinput.min.js"></script>

<title></title>

</head>
<body>

<input type="hidden" value="<?=$info?>" id="info">
<input type="hidden" value="<?=$view_id?>" id="viewid">
<input type="hidden" value="<?=$token?>" id="session-token">
<input type="hidden" saveas="sheetname" class="sheet">
<div class="caps strong" row style="float: left">
    <? if ($show_all) { ?>
    all characters
    <? } else { ?>
    active characters
    <? } ?>

    <select id="campaign_choice">
        <? while ($row = mysqli_fetch_assoc($resultcampaign)) { ?>
        <option value="<?=$row['id']?>"><?=$row['name']?></option>
        <? } mysqli_data_seek($resultcampaign, 0); ?>
    </select>
</div>
<div class="caps" align="right" row style="width:100%">
    <a href="/gmc" class="list">view active</a>
    <a href="/gmc/all" class="list">view all</a>
    <a href="/gm" class="list">fancy view</a>
    <a onclick="refresh()" class="list">refresh sheets</a>
</div>
<? while ($row = mysqli_fetch_assoc($result)) { ?>
<div row="<?=$row['id']?>" sheet-view="<?=$row['publicid']?>">
    <div class="bg0 strong caps">
        <span saveas="charname" class="list"></span>
        <span saveas="sheetname" class="list" style="color: #999"></span>
        <select saveas="sheet_type" class="strong list">
            <option value="4"></option>
            <option value="0-pc">Player</option>
            <option value="1-npc">NPC</option>
            <option value="3-enemy">Enemy</option>
        </select>
        <select data="campaign">
            <option>Send to Campaign...</option>
            <? while($rowc = mysqli_fetch_assoc($resultcampaign)) { ?>
                <option value="<?=$rowc['id']?>"><?=$rowc['name']?></option>
            <? } mysqli_data_seek($resultcampaign, 0); ?>
        </select>
        <a href="/c/<?=$row['publicid']?>" class="list">view</a>
        <a href="/e/<?=$row['editid']?>" class="list">edit</a>
        <a onclick="retireRow('<?=$row['id']?>')" action="retire" class="list">retire</a>
        <a onclick="restoreRow('<?=$row['id']?>')" action="restore" class="list">restore</a>
        <a onclick="deleteRow('<?=$row['id']?>')" action="delete" class="list">delete</a>
    </div>
    <div>
        <span saveas="alignment" class="caps"></span>
        <span saveas="size" class="capitalize"></span>
        <span saveas="gender"></span>
        <span saveas="race"></span>
        <span saveas="known_languages"></span>
    </div>
    <div>
        <span class="list">
            <span class="strong">Init</span>&nbsp;<span saveas="final_init"></span>
        </span>
        <span class="list">
            <span class="strong">AC</span>&nbsp;<span saveas="final_ac"></span>
        </span>
        <span class="list">
            <span class="strong">Touch</span>&nbsp;<span saveas="final_touch"></span>
        </span>
        <span class="list">
            <span class="strong">Flat</span>&nbsp;<span saveas="final_flatfoot"></span>
        </span>
        <span class="list">
            <span class="strong">HP</span>&nbsp;<span saveas="final_hp_current"></span>
        </span>
        <span class="list">
            <span class="strong">NonL</span>&nbsp;<span saveas="health_nonlethal"></span>
        </span>
        <span class="list">
            <span class="strong">Fort</span>&nbsp;<span saveas="final_fort"></span>
        </span>
        <span class="list">
            <span class="strong">Ref</span>&nbsp;<span saveas="final_ref"></span>
        </span>
        <span class="list">
            <span class="strong">Will</span>&nbsp;<span saveas="final_will"></span>
        </span>
        <span class="list">
            <span class="strong">Perc</span>&nbsp;<span saveas="final_skill" loadsearch="skill_name" loadmatch="Perception"></span>
        </span>
        <span class="list">
            <span class="strong">Stealth</span>&nbsp;<span saveas="final_skill" loadsearch="skill_name" loadmatch="Stealth"></span>
        </span>
        <span class="list">
            <span class="strong">Melee</span>&nbsp;<span saveas="final_melee"></span>
        </span>
        <span class="list">
            <span class="strong">Range</span>&nbsp;<span saveas="final_ranged"></span>
        </span>
        <span class="list">
            <span class="strong">CMB</span>&nbsp;<span saveas="final_cmb"></span>
        </span>
        <span class="list">
            <span class="strong">CMD</span>&nbsp;<span saveas="final_cmd"></span>
        </span>
        <span class="list">
            <span class="strong">STR</span>&nbsp;<span saveas="final_str_total"></span>
        </span>
        <span class="list">
            <span class="strong">DEX</span>&nbsp;<span saveas="final_dex_total"></span>
        </span>
        <span class="list">
            <span class="strong">CON</span>&nbsp;<span saveas="final_con_total"></span>
        </span>
        <span class="list">
            <span class="strong">INT</span>&nbsp;<span saveas="final_int_total"></span>
        </span>
        <span class="list">
            <span class="strong">WIS</span>&nbsp;<span saveas="final_wis_total"></span>
        </span>
        <span class="list">
            <span class="strong">CHA</span>&nbsp;<span saveas="final_cha_total"></span>
        </span>
        <span class="list">
            <span class="strong">BAB</span>&nbsp;<span saveas="final_bab"></span>
        </span>
        <span class="list">
            <span class="strong">Bluff</span>&nbsp;<span saveas="final_skill" loadsearch="skill_name" loadmatch="Bluff"></span>
        </span>
        <span class="list">
            <span class="strong">Sense Motive</span>&nbsp;<span saveas="final_skill" loadsearch="skill_name" loadmatch="Sense%20Motive"></span>
        </span>
        <span class="list">
            <span class="strong">Disguise</span>&nbsp;<span saveas="final_skill" loadsearch="skill_name" loadmatch="Disguise"></span>
        </span>
        <span class="list">
            <span class="strong">Spellcraft</span>&nbsp;<span saveas="final_skill" loadsearch="skill_name" loadmatch="Spellcraft"></span>
        </span>
    </div>
</div>

<? } ?>

<script src="/js/gm.js"></script>
<script>
$(function() {
    refresh();

    $('select').change(function() {
        changeType(this, $(this).parent().parent());
    })

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

    setInterval(refresh, 5000);
});

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
            row.find('[saveas]').each(function() {
                var key = $(this).attr('saveas');
                if ($(this).prop('tagName') != "SELECT") {
                    $(this).text(json[key]);
                }

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
                row.find('[action="retire"]').hide();
                row.find('[action="restore"]').show();
                row.find('[action="delete"]').show();
            }
            else {
                row.removeClass('retired');
                row.find('[action="retire"]').show();
                row.find('[action="restore"]').hide();
                row.find('[action="delete"]s').hide();
            }

            $('span[saveas="known_languages"]').each(function() {
                var text = $(this).text();
                text = text.replace(/,/g, ", ");
                $(this).text(text); // lol
            });

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
                    console.log("change campaign to " + c);
                    // hide character.
                    row.remove();
                });
            });

        });
    });
}
</script>
</body>
</html>
