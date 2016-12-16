$(document).ready(function() {
    // Override Ctrl+S for saving
    $(window).bind('keydown', function(event) {
        if (event.ctrlKey || event.metaKey) {
            switch (String.fromCharCode(event.which).toLowerCase()) {
            case 's':
                event.preventDefault();
                save();
                break;
            }
        }
    });
});

function saveHp() {
    sendMessage("Updating health...");

    var finalHpTotal = readValue('#health [saveas="final_hp_total"]');
    var finalHpCurrent = readValue('#health [saveas="final_hp_current"]');
    var healthNonlethal = readValue('#health [saveas="health_nonlethal"]');
    var healthLethal = readValue('#health [saveas="health_lethal"]');

    var canPost = true;

    var editid = $('#editid').val();
    if (editid == "") canPost = false;

    if (canPost) {
        $.post("/p", {
            mode: "health",
            token: $('#session-token').val(),
            total: finalHpTotal,
            current: finalHpCurrent,
            nonlethal: healthNonlethal,
            lethal: healthLethal,
            editid: editid
        },
        function(data, status) {
            if (data == "-") {

            }
            else {
                sendMessage("Health updated successfully!");
            }
        });
    }

}

function save() {
    sendMessage("Saving...");

    var savedata = {};
    var savetype = {};
    $('[saveas]').each(function() {
        var key = $(this).attr("saveas");
        var value = readValue(this);

        savedata[key] = value;
        savetype[key] = "varchar(128)";

        if ($(this).prop("tagName") == "TEXTAREA") {
            savetype[key] = "text";
        }

        if ($(this).parents('[savetype="columns"]').length) {
            savetype[key] = "text";
            savedata[key] = $('[saveas="' + $(this).attr("saveas") + '"]').map(function() {
                return encodeURIComponent(readValue(this));
            }).get().join(",");
        }

        // Special case to send blank data. (BAD FIX)
        if (savedata[key] == '')
            savedata[key] = blankCode;
    });

    var canPost = true;

    var mode = $('#mode').val();
    if (mode == "view") canPost = false;

    var editid = $('#editid').val();
    if (editid == "") canPost = false;

    var token = $('#session-token').val();
    if (token == "") canPost = false;

    if (canPost)
        $.post("/p", {
            mode: "save",
            token: $('#session-token').val(),
            data: savedata,
            type: savetype,
            editid: editid
        },
        function(data, status) {
            if (data == "-") {
                alert("Save failed!  Export your sheet to back it up.");
                sendMessage("Validation error :(");
            }
            else {
                var json = JSON.parse(data);
                if (json['message'] == "saved") {
                    sendMessage("Sheet saved successfully.");
                }
                if (json['error']) {
                    sendMessage("Validation error :(");
                    alert("Save failed!  Export your sheet to back it up.");
                }
            }
        });

    for (var key in savedata)
        if (savedata[key] == blankCode) savedata[key] = "";

    return savedata;
}

function addRow(element) {
    var rowContainer = $(element).parent().parent().prev();
    var row = rowContainer.children().last().clone();
    row.appendTo(rowContainer);
    row.find('input[type!="submit"]').val("");
    row.find('textarea').val("");
    row.find('select').each(function() {
        $(this)[0].selectedIndex = 0; // Select first option in drop downs
    });
    row.attr("extra", "true");
    row.addClass("entry");

    updateEvents();
    row.trigger('change');
}

function deleteRow(element) {
    var rowContainer = $(element).parents('.entries');
    var rowCount = rowContainer.children().length;
    if (rowCount > 1) {
        var c = window.confirm("Are you sure you want to delete this row?\n\nThis cannot be undone!");
        if (!c) return;
        var row = $(element).closest('.entry');
        row.find('input, select, textarea').each(function() {
            $(this).val("");
        });
        row.find('[weight], [quantity]').each(function() {
            $(this).trigger('change');
        });
        row.trigger('change');
        row.remove();
    }
}

function deleteRowIfEmpty(element) {
    if ($(element).val() == "") deleteRow(element);
}

function moveUpRow(element) {
    var rowContainer = $(element).parents('.entries');
    var row = $(element).closest('.entry');
    row.insertBefore(row.prev());
}

function moveDownRow(element) {
    var rowContainer = $(element).parents('.entries');
    var row = $(element).closest('.entry');
    row.insertAfter(row.next());
}

function revealTools() {
    $('#more-tools').slideDown(250);
    $('#more-tools-button').val("-");
    $('#more-tools-button').attr("onclick", "hideTools()");
}

function hideTools() {
    $('#more-tools').slideUp(250);
    $('#more-tools-button').val("+");
    $('#more-tools-button').attr("onclick", "revealTools()");
}

function clearTemp() {
    $('[temp]').each(function() {
        $(this).val('');
        $(this).trigger('change');
    });
}
