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
    var c = window.confirm($('#message-sheet-delete').val());
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
            alert($('#message-sheet-cant-delete').val());
        }
    });
}

function retireRow(id) {
    var c = window.confirm($('#message-sheet-retire').val());
    if (!c) return;

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
