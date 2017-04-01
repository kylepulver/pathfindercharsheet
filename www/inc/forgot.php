<?
$reset_token = $info;
?>
<div class="container">
    <h1>Reset Passwords</h1>
    <div class="row">
        <div class="column">
            <label>Player Password (Leave blank to not change)</label>
            <input type="password" id="pc-password">

            <label>Game Master Password (Leave blank to not change)</label>
            <input type="password" id="gm-password">

            <label>Super Admin Password (Leave blank to not change)</label>
            <input type="password" id="admin-password">

            <input type="submit" value="Update Passwords" onclick="newPassword()" id="new-password">
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
