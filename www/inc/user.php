<div class="toolbar-under"></div>
<div class="container">
    <h1>Logged In</h1>
    <div class="row">
        <div class="column">
            <strong>Recently Edited Sheets</strong>
            <ul id="recent-links">
                <li><a></a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <? if ($is_god) { ?>
            <input type="submit" value="Admin View" onclick="goTo('/admin')">
            <? } ?>
            <? if ($is_gm) { ?>
            <input type="submit" value="GM View" onclick="goTo('/gm')">
            <? } ?>
            <input type="submit" value="New Sheet" onclick="createNew()">
            <input type="submit" value="Log Out" onclick="logout()">
        </div>
    </div>
    <div class="row">
        <div class="column">
            <p>If you lost your edit url your game master can let you know what it is!</p>
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
