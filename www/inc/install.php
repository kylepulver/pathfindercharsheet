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
    <h1><?=say('install')?></h1>
    <? if ($error != "") { ?>
        <h2 class="error"><?=$error?></h2>
    <? } else { ?>
    <p><?=say('install_hint_1')?></p>
    <div class="row">
        <div class="column">
            <label><?=say('inst_pc_user')?></label>
            <input type="text" id="player-username" value="pc">

            <label><?=say('inst_pc_pass')?></label>
            <input type="password" id="player-password">

            <label><?=say('inst_gm_user')?></label>
            <input type="text" id="gm-username" value="gm">

            <label><?=say('inst_gm_pass')?></label>
            <input type="password" id="gm-password">

            <label><?=say('inst_god_user')?></label>
            <input type="text" id="admin-username" value="admin">

            <label><?=say('inst_god_pass')?></label>
            <input type="password" id="admin-password">

            <input type="submit" value="<?=say('install')?>" onclick="install()">
        </div>
    </div>
    <? } ?>

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
            install();
        }
    });
    $('#message').hide();
});
function install() {
    $.post("/p", {
        mode: "install",
        token: $('#session-token').val(),
        pc_username: $('#player-username').val(),
        pc_password: $('#player-password').val(),
        gm_username: $('#gm-username').val(),
        gm_password: $('#gm-password').val(),
        admin_username: $('#admin-username').val(),
        admin_password: $('#admin-password').val(),
    },
    function(data, status) {
        var response = JSON.parse(data);
        if (response['status'] == true) {
            window.location.href = "/";
        }
        else {
            // alert(response['error']);
            $('#message').show();
            $('#message').text(response['error']);
        }
    });
}
</script>
