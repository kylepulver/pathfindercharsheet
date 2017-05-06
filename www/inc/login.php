<div class="toolbar-under"></div>
<div class="container">
    <h1><?=say("log_in")?></h1>
    <div class="row">
        <div class="column">
            <label><?=say('username')?></label>
            <input type="text" id="username">

            <label><?=say('password')?></label>
            <input type="password" id="password">

            <input type="submit" value="<?=say('log_in')?>" onclick="login()" id="login-submit">
            <input type="submit" value="<?=say('reset_pass')?>" onclick="forgotPassword()" id="reset-password">
        </div>
    </div>
    <div class="row">
        <div class="column">
            <p id="message" class="warning"></p>
            <p><?=say('log_in_hint_1')?></p>
            <p><?=say('log_in_hint_2')?></p>
        </div>
    </div>
</div>

<script>
$(function() {
    $('input').keypress(function (e) {
        if (e.which == 13) {
            e.preventDefault();
            login();
        }
    });
    $('#message').hide();
});

function forgotPassword() {
    $.post("/p", {
        mode: 'forgot',
        token: $('#session-token').val(),
    },
    function(data, status) {
        var json = JSON.parse(data);
        $('#message').show();
        $('#message').text(json['message']);
    });
}

function login() {
    $.post("/p", {
        mode: "login",
        token: $('#session-token').val(),
        username: $('#username').val(),
        password: $('#password').val()
    },
    function(data, status) {
        if (data == true) {
            window.location.href = "/";
        }
        else {
            $('#message').show();
            $('#message').text('Invalid username and/or password!');
        }
    });
}
</script>
