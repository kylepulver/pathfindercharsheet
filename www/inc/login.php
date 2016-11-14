<div class="toolbar-under"></div>
<div class="container">
    <h1>Log In</h1>
    <div class="row">
        <div class="column">
            <label>Username</label>
            <input type="text" id="username">

            <label>Password</label>
            <input type="password" id="password">

            <input type="submit" value="Log In" onclick="login()" id="login-submit">
            <input type="submit" value="Reset Passwords" onclick="forgotPassword()" id="reset-password">
        </div>
    </div>
    <div class="row">
        <div class="column">
            <p id="message" class="warning"></p>
            <p>Log in to gain access to editing character sheets.</p>
            <p>If you are the game master you can access all character sheets to edit and view.</p>
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
