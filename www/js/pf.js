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

function mapRange(value, low1, high1, low2, high2) {
    return low2 + (high2 - low2) * (value - low1) / (high1 - low1);
}

function capitalizeFirstLetter(string) {
    if (string === null) return "";
    if (typeof string == 'undefined') return "";
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function log(str) {
    if (enableLog) console.log(str);
}
