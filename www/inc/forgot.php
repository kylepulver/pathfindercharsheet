<?
$reset_token = $info;
?>
<div class="container">
    <h1></h1>
    <div class="row">
        <div class="column">
            <label><?=say('player_pass')?></label>
            <input type="password" id="pc-password">

            <label><?=say('gm_pass')?></label>
            <input type="password" id="gm-password">

            <label><?=say('admin_pass')?></label>
            <input type="password" id="admin-password">

            <input type="submit" value="<?=say('update_pass')?>" onclick="newPassword()" id="new-password">
        </div>
    </div>
</div>
<script>
$(function() {
    $('input').keypress(function (e) {
        if (e.which == 13) {
            e.preventDefault();
            newPassword();
        }
    });
});
function newPassword() {
    $.post("/p", {
        mode: 'new_password',
        token: $('#session-token').val(),
        reset_token: '<?=$reset_token?>',
        pc_password: $('#pc-password').val(),
        gm_password: $('#gm-password').val(),
        admin_password: $('#admin-password').val()
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
