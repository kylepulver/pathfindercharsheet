function goTo(page) {
    window.location.href = page;
}
function logout() {
    $.post("/p", {
        mode: "logout",
        token: $('#session-token').val()
    },
    function(data, status) {
        window.location.href = "/";
    });
}
function createNew() {
    $.post("/p", {
        mode: "create",
        token: $('#session-token').val()
    },
    function(data, status) {
        if (data == "-") {
        }
        else {
            var response = JSON.parse(data);
            var editid = response['editid'];
            window.location.href = "/e/" + editid;
        }
    });
}
