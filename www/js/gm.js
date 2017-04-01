function changeType(element, row) {
    var id = row.attr('row');
    $.post("/p", {
        mode: "sheet_type",
        token: $('#session-token').val(),
        id: id,
        type: $(element).val()
    },
    function(data, status) {
    });

    if ($(element).val() == "0-pc") {
        row.find('.glyphicon-star').show();
    }
    else {
        row.find('.glyphicon-star').hide();
    }
}

function restoreRow(id) {
    $.post("/p", {
        mode: "restore",
        token: $('#session-token').val(),
        id: id
    },
    function(data, status) {
        if (data == true) {
            refresh();
        }
    });
}

function deleteRow(id) {
    var c = window.confirm("Are you sure you want to delete this sheet?\n\nTHIS CANNOT BE UNDONE!");
    if (!c) return;

    $.post("/p", {
        mode: "delete",
        token: $('#session-token').val(),
        id: id
    },
    function(data, status) {
        if (data == true) {
            $('[row="' + id + '"]').remove();
        }
        else {
            alert("Cannot delete non-retired sheet.");
        }
    });
}

function retireRow(id) {
    var c = window.confirm("Are you sure you want to retire this sheet?");
    if (!c) return;

    console.log("retire?");

    $.post("/p", {
        mode: "retire",
        token: $('#session-token').val(),
        id: id
    },
    function(data, status) {
        if (data == true) {
            if ($('#mode').val() == "all" || $('#info').val() == "all") {
                refresh();
            }
            else {
                $('[row="' + id + '"]').remove();
            }
        }
    });
}
