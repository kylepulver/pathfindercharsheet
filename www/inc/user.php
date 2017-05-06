<div class="toolbar-under"></div>
<div class="container">
    <h1><?=say("logged_in")?></h1>
    <div class="row">
        <div class="column">
            <strong><?=say('recent_sheets')?></strong>
            <ul id="recent-links">
                <li><a></a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <? if ($is_god) { ?>
            <input type="submit" value="<?=say('admin_view')?>" onclick="goTo('/admin')">
            <? } ?>
            <? if ($is_gm) { ?>
            <input type="submit" value="<?=say('gm_view')?>" onclick="goTo('/gm')">
            <? } ?>
            <input type="submit" value="<?=say('new_sheet')?>" onclick="createNew()">
            <input type="submit" value="<?=say('log_out')?>" onclick="logout()">
        </div>
    </div>
    <div class="row">
        <div class="column">
            <p><?=say('if_lost')?></p>
        </div>
    </div>
</div>
<script>
$(function() {
    var recentSheets = localStorage.getItem("recent");
    if (recentSheets !== null) {
        var links = JSON.parse(recentSheets);
        var row = $('#recent-links li');
        var container = $('#recent-links');
        for(var i = links.length - 1; i >= 0; i--) {
            var link = links[i];
            var newRow = row.clone();
            var a = newRow.find('a');
            var domain = $('#domain').val();
            a.attr('href', domain + '/e/' + link['key']);
            if (link['name'] != "")
                a.text(link['name']);
            else
                a.text(link['key']);

            newRow.appendTo(container);
        }
        row.remove();
    }
    else {
        $('#recent-links').parent().parent().remove();
    }
});
</script>
