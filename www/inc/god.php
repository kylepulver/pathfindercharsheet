<?
$query = "SELECT * FROM `" . $config['sql_campaigns'] . "` ORDER BY date ASC";
$result = mysqli_query($link, $query);
?>
<div class="toolbar">
    <div class="container">
        <div class="row">
            <div class="column" align="right">
                <label>&nbsp;</label>
                <input type="submit" value="Download All Sheets" onclick="downloadAll()">
            </div>
        </div>
    </div>
</div>
<div class="toolbar-under"></div>
<div class="container">
    <h1><?=say('campaigns')?></h1>
    <div class="row">
        <div class="column column-40">
            <p class="strong"><?=say('campaign_name')?></p>
        </div>
        <div class="column column-20">
            <p class="strong"><?=say('passkey')?></p>
        </div>
        <div class="column column-20">
            <p class="strong"><?=say('created')?></p>
        </div>
        <div class="column">
            &nbsp;
        </div>
    </div>
    <div class="entries">
        <? while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="entry highlight" row="<?=$row['id']?>" campaign>
            <div class="row">
                <div class="column column-40">
                    <input type="text" value="<?=$row['name']?>" data="name"/>
                </div>
                <div class="column column-20">
                    <input type="text" value="<?=$row['password']?>" data="password"/>
                </div>
                <div class="column column-20">
                    <p><?=date("m/d/y", strtotime($row['date']))?></p>
                </div>
                <div class="column" align="right">
                    <input type="submit" value="Delete" onclick="deleteCampaign(this)">
                </div>
            </div>
        </div>
        <? } ?>
    </div>
    <div class="row">
        <div class="column" align="right">
            <input type="submit" value="Add Campaign" onclick="addCampaign(this)">
        </div>
    </div>
    <div class="row">
        <div class="column">
            <input type="submit" value="<?=say('gm_view')?>" onclick="goTo(/gm/)">
            <input type="submit" value="<?=say('user_view')?>" onclick="goTo(/user/)">
            <input type="submit" value="<?=say('new_sheet')?>" onclick="createNew()">
            <input type="submit" value="<?=say('log_out')?>" onclick="logout()">
        </div>
    </div>
</div>
<script src="/js/pf.js"></script>
<script>
$(function() {
    $('[campaign] input[data="name"]').change(refresh);
    $('[campaign] input[data="password"]').change(refresh);
    $('[row="1"] [data="name"]').prop("readonly", true);
    $('[row="1"] [data="password"]').prop("readonly", true);
    $('[row="1"] input[type="submit"]').remove();
});

function downloadAll() {
    $.post("/p", {
        token: $('#session-token').val(),
        mode: "zip_export"
    },
    function(data, status) {
        if (data != false)
            location.href = data;
    });
}

function refresh() {
    var datanames = {};
    var datapasswords = {};

    // Yeah I know this is dumb
    $('[campaign]').each(function() {
        var key = $(this).attr('row');
        var name = $(this).find('[data="name"]').val();
        if (name == '')
            name = ' ';
        datanames[key] = name;
        var password = $(this).find('[data="password"]').val();
        datapasswords[key] = password;
    });

    $.post("/p", {
        mode: "update_campaigns",
        names: datanames,
        passwords: datapasswords,
        token: $('#session-token').val()
    },
    function(data, status) {
    });
}

function addCampaign(element) {
    $.post("/p", {
        mode: "add_campaign",
        token: $('#session-token').val()
    },
    function(data, status) {
        var data = JSON.parse(data);
        var newId = data['id']
        var rowContainer = $(element).parent().parent().prev();
        var row = rowContainer.children().last().clone();
        row.appendTo(rowContainer);
        row.change(refresh);
        row.attr("row", newId);

        row.find('input[data="name"]').val("New Campaign");
        row.find('input[data="password"]').val("");

        row.find('input[data="name"]').prop("readonly", false);
        row.find('input[data="password"]').prop("readonly", false);
    });
}

function deleteCampaign(element) {
    // Dont allow deletion of id 1 default campaign
    var rowContainer = $(element).parents('.entries')
    var rowCount = rowContainer.children().length;

    var rowId = $(element).parents('[row]').attr('row');
    if (rowId == 1)
        alert("<?=say('no_delete_camp')?>");
    else {
        var c = window.confirm("<?=say('del_campaign')?>");
        if (!c) return;

        $.post("/p", {
            mode: "delete_campaign",
            id: rowId,
            token: $('#session-token').val()
        },
        function(data, status) {
            var row = $(element).parents('.entry');
            if (data == true)
                row.remove();
        });
    }
}

function save() {

}
</script>
