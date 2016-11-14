<?
$error = "";
foreach($config as $key=>$value) {
    if ($value == "") {
        $error = "config.php requires '$key' to be set!";
        break;
    }
}
?>

<div class="container">
    <h1>Install</h1>
    <? if ($error != "") { ?>
        <h2 class="error"><?=$error?></h2>
    <? } else { ?>
    <p>To install the Pathfinder Character Sheet Manager enter the following information.</p>
    <div class="row">
        <div class="column">
            <label>Player Username</label>
            <input type="text" id="player-username">

            <label>Player Password</label>
            <input type="password" id="player-password">

            <label>Game Master Username</label>
            <input type="text" id="gm-username">

            <label>Game Master Password</label>
            <input type="password" id="gm-password">

            <input type="submit" value="Install" onclick="install()">
        </div>
    </div>
    <? } ?>
</div>
<script>
$(function() {
    $('input').keypress(function (e) {
        if (e.which == 13) {
            e.preventDefault();
            install();
        }
    });
});
function install() {
    $.post("/p", {
        mode: "install",
        token: $('#session-token').val(),
        pc_username: $('#player-username').val(),
        pc_password: $('#player-password').val(),
        gm_username: $('#gm-username').val(),
        gm_password: $('#gm-password').val(),
    },
    function(data, status) {
        var response = JSON.parse(data);
        if (response['status'] == true) {
            window.location.href = "/";
        }
        else {
            alert(response['error']);
        }
    });
}
</script>
