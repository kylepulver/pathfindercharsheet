var blankCode = "%%%%"; // I'm not proud of this
var enableLog = false;

var cachedLoadData = {};
var cachedIndex = 0;
var lastClickedText = "";
var firstLoad = true;

var callbackFinishedLoading = function(){};

$(document).ready(function() {
    // Mark dynamic dropdowns
    $('select').each(function() {
        if(!$(this).find('option').length) {
            $(this).attr('dynamic', '');
        }
    });

    // Keep track of dynamic entries
    $('.entries').each(function() {
        $(this).children().addClass("entry");
    });

    // Hide elements that should start hidden
    $('.reveal').hide();

    // $('#loading-overlay').hide();

    // Generate nav bar
    // Replaced with dropdown
    // var navbar = $('#navbar');
    // $('h1').each(function() {
    //     var name = $(this).text();
    //     var newElement = jQuery('<a/>', {text: name });
    //     newElement.click(function() {
    //         scrollTo(name);
    //     });
    //     navbar.append(newElement);
    // });

    // Generate dropdowns and sidenav
    var dropdown = $('#dropdown');
    var sidenav = $('#sidenav');
    $('h1').each(function() {
        var html = $(this).html();
        var text = $(this).text();
        var newElement = jQuery('<a/>', {html: html });
        newElement.click(function() {
            scrollTo(text);
            dropDown();
        });
        dropdown.append(newElement);

        var sideElement = jQuery('<a/>', {html: html });
        sideElement.click(function() {
            scrollTo(text);
        });
        sidenav.append(sideElement);
    });

    // Hide dropdown when not clicked on
    $(document).mouseup(function (e) {
        if ($('.dropdown-content').is(':visible')) {
            var container = $(".dropdown");
            if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) // ... nor a descendant of the container
                dropDown();
        }
    });

    // Rolz
    $('#rolz').click(function() {
        $('#rolz-result').text('?');

        $.post("/p", {
            mode: 'rolz',
            token: $('#session-token').val(),
            roll: $('#rolz-input').val()
        },
        function(data, success) {
            var json = JSON.parse(data);
            $('#rolz-result').html(json['result']);
            $('#rolz-result').attr('title', json['details']);
        });
    });

    // Rolz search on enter press
    $('#rolz-input').keypress(function(e) {
        if (e.which == 13) {
            e.preventDefault();
            $('#rolz').trigger('click');
        }
    });

    // Loading
    load();

    // Search links
    $('#sheet').mouseup(function() {
        var text = $(this).find('[type="text"]:focus').val();
        var url = "";
        if (typeof text == 'undefined') {
            text = $(this).find('[type="url"]:focus').val();
        }
        else {
            url = $(this).find('[type="text"]:focus').parent().parent().parent().find('input[type="url"]').val();
        }

        if (typeof text != 'undefined') {
            updateSearchLinks(text, url);
        }
    });
    $('[calc="skill-name"]').click(function() {
        var text = $(this).text().replace(' *', '');
        updateSearchLinks(text);
    });

    // Update events for doing calculations
    updateEvents();

    // Keep session alive
    setInterval(ping, 15000);
});

function updateSearchLinks(query, link = "") {
    if (typeof query == 'undefined' || !query) return;
    var output = query;
    if (link != "") {
        output = '<a href="' + link + '" target="pfsearch">' + query + '</a>';
    }
    else if (query.includes("http://")) {
        output = '<a href="' + query + '" target="pfsearch">' + query + '</a>';
    }
    $('#search-text').html(output);

    var url = 'https://cse.google.com/cse?cx=006680642033474972217%3A6zo0hx_wle8&q=#gsc.tab=0&gsc.q=' + query + '&gsc.page=1'
    $('#search-d20').attr('href', url);

    url = 'http://paizo.com/search?q=' + query + '&what=prd';
    $('#search-prd').attr('href', url);
}

function updateEvents() {
    // Clear events for change
    $('*').off('change');

    // Change the title of the page
    $('.sheet').change(function() {
        document.title = $('.sheet').val() + " Pathfinder Character Sheet";
    });

    // Size
    $('[calc="size"]').change(calculateSize);

    // Ability Scores
    var types = ["str", "dex", "con", "wis", "int", "cha"]
    $.each(types, function(i, type) {
        $('#' + type).change(function() {
            calculateAbility(type);
        });
    });

    // Health
    $('#health').change(calculateHealth);

    // Classes
    $('#classes').change(calculateClass);

    // Attacks
    $('[calc="attacks"]').change(calculateAttacks);

    // Armor
    $('[calc="armor-class"]').change(calculateArmor);

    // Saves
    $('[calc="saves"]').change(calculateSaves)

    // Maneuvers
    $('[calc="maneuvers"]').change(calculateManeuvers)

    // Initiative
    $('[calc="initiative"]').change(calculateInit);

    // Skills
    $('[calc="skills"]').change(calculateSkills);

    // Currency
    $('[calc="currency"]').change(calculateCurrency);

    // Weight
    $('#weight, #gear, [weight], [quantity], [carried], [container]').change(calculateWeight);
    $('[calc="container-name"]').change(calculateContainers);

    // Spell Casting
    $('#casting-class').change(calculateCasting);

    // Spell List
    $('#spell-list').change(calculateSpellList);

    // Experience
    $('#experience').change(calculateExperience);

    // Pool Points
    $('#pool-points').change(calculatePoolPoints);

    // Links
    $('#links').change(calculateLinks);
}

function calculateAll() {
    calculateSize();
    calculateAllAbilities();
    calculateClass();
    calculateHealth();
    calculateAttacks();
    calculateCurrency();
    calculateContainers();
    calculateWeight();
    calculateArmor();
    calculateSaves();
    calculateManeuvers();
    calculateInit();
    calculateSkills();
    calculateCasting();
    calculateExperience();
    calculatePoolPoints();
    calculateSpellList();
    calculateLinks();

    firstLoad = false;
}

function calculateLinks() {
    log('calc links');

    $('#links .entry').each(function() {
        var row = $(this);
        var url = row.find('[type="url"]').val();
        var a = row.find('a');
        if (url != "") {
            a.attr('href', url);
            a.text(row.find('[type="text"]').val());
        }
        else {
            a.text("");
        }
    });
}

function calculateAllAbilities() {
    var types = ["str", "dex", "con", "wis", "int", "cha"];
    $.each(types, function(i, type) {
        calculateAbility(type);
    });
}

function calculateAbility(type) {
    log("calc ability " + type);

    var total = sumValues($('#' + type + ' [sum="' + type + '"]'));
    writeValue('[calc="' + type + '-total"]', total);
    var mod = Math.floor((total - 10) / 2);
    $('[calc="' + type + '-mod"]').text(mod);
    writeValue($('[calc="' + type + '-mod"]'), mod);
}

function calculateExperience() {
    log("calc experience");

    var points = parseValue('[calc="experience-points"]');
    var prevGoal = parseValue('[calc="experience-prev-goal"]');
    var goal = parseValue('[calc="experience-goal"]');

    var progress = mapRange(points - prevGoal, 0, goal - prevGoal, 0, 100);
    if (progress > 100) progress = 100;
    $('[calc="experience-progress"]').width(progress + "%");
}

function calculatePoolPoints() {
    $('#pool-points .row').each(function() {
        var used = parseValue($(this).find('[calc="pool-used"]'));
        var total = parseValue($(this).find('[calc="pool-total"]'));
        writeValue($(this).find('[calc="pool-remaining"]'), total - used);
    });
}

function calculateContainers() {
    log("calc containers");

    $('[calc="gear-container-dropdown"]').each(function() {
        populateOptions($(this), '[calc="container-name"]');
    })
}

function calculateWeight() {
    log("calc weight");

    var containerWeights = {};
    $('[calc="container-name"]').each(function() {
        var name = $(this).val();
        containerWeights[name] = 0;
    });

    var totalWeight = 0;
    $('[weight]').each(function() {
        var row = $(this).parent().parent();
        var quantity = row.find('[quantity]');
        var carried = row.find('[carried]');
        var container = row.parent().find('[container]').val();
        var weight = 0;
        var quantityValue = 1;
        if (quantity.length)
            quantityValue = parseValue(quantity);
        if (carried.is(':checked'))
            weight = parseValue(this) * quantityValue;
        if (!carried.length) weight = parseValue(this) * quantityValue;

        if (typeof container == 'undefined') container = '';
        if (container == '')
            totalWeight += weight;
        else
            containerWeights[container] += weight;
    });
    writeValue('[calc="total-weight"]', totalWeight);

    $('[calc="container-name"]').each(function() {
        var key = $(this).val();
        var value = containerWeights[key];
        var maxWeight = parseValue($(this).parent().parent().parent().find('[calc="container-max"]'));
        var holding = $(this).parent().parent().find('[calc="container-holding"]');
        writeValue(holding, value);
        if (value > maxWeight) {
            holding.addClass('warning');
        }
        else {
            holding.removeClass('warning');
        }

    });

    var carryingCapacityTable = [
        [0,0,0], // 0
        [3,6,10], // 1
        [6,13,20], // 2
        [10,20,30], // 3
        [13,26,40], // 4
        [16,33,50], // 5
        [20,40,60], // 6
        [23,46,70], // 7
        [26,53,80], // 8
        [30,60,90], // 9
        [33,66,100], // 10
        [38,76,115], // 11
        [43,86,130], // 12
        [50,100,150], // 13
        [58,116,175], // 14
        [66,133,200], // 15
        [76,153,230], // 16
        [86,173,260], // 17
        [100,200,300], // 18
        [116,233,350], // 19
        [133,266,400], // 20
        [153,306,460], // 21
        [173,346,520], // 22
        [200,400,600], // 23
        [233,466,700], // 24
        [266,533,800], // 25
        [306,613,920], // 26
        [346,693,1040], // 27
        [400,800,1200], // 28
        [466,933,1400] // 29
    ];

    var bipedalMultiplier = {
        fine: 0.125,
        diminutive: 0.25,
        tiny: 0.5,
        small: 0.75,
        medium: 1,
        large: 2,
        huge: 4,
        gargantuan: 8,
        colossal: 16
    };
    var quadrupedalMultiplier = {
        fine: 0.25,
        diminutiv: 0.5,
        tiny: 0.75,
        small: 1,
        medium: 1.5,
        large: 3,
        huge: 6,
        gargantuan: 12,
        colossal: 24
    };
    var legsTable = {
        2: bipedalMultiplier,
        4: quadrupedalMultiplier
    };

    var baseStrength = parseValue('[calc="str-total"]');
    var strengthBonus = parseValue('[calc="weight-strength-bonus"]');
    var strength = baseStrength + strengthBonus;
    writeValue('[calc="weight-strength"]', strength);

    var legs = $('[calc="weight-legs"]').val();
    var size = $('[calc="size"]').val();
    writeValue('[calc="weight-current-size"]', capitalizeFirstLetter(size));
    var multiplier = legsTable[legs][size];

    while(strength > 29) {
        strength -= 10;
        multiplier *= 4;
    }

    var capacity = carryingCapacityTable[strength];
    var light = capacity[0] * multiplier;
    var medium = capacity[1] * multiplier;
    var heavy = capacity[2] * multiplier;

    writeValue('[calc="weight-light"]', light);
    writeValue('[calc="weight-medium"]', medium);
    writeValue('[calc="weight-heavy"]', heavy);
    writeValue('[calc="weight-above"]', heavy);
    writeValue('[calc="weight-off-ground"]', heavy * 2);
    writeValue('[calc="weight-drag"]', heavy * 5);

    var status = "LIGHT";
    var maxDex = 9999;
    var checkPenalty = 0;
    if (totalWeight > light) {
        status = "MEDIUM";
        maxDex = 3;
        checkPenalty = -3;
    }
    if (totalWeight > medium) {
        status = "HEAVY";
        maxDex = 1;
        checkPenalty = -6;
    }
    if (totalWeight > heavy) {
        status = "OVER";
        maxDex = 1;
        checkPenalty = -6;
    }
    writeValue("[calc='weight-status']", status);
    writeValue('[calc="max-dex-weight"]', maxDex);
    writeValue('[calc="check-penalty-weight"]', checkPenalty);
    calculateArmor();
}

function calculateCurrency() {
    log("calc currency");

    var grandTotal = 0;

    var total = 0;
    total += parseValue($('[calc="copper-carried"]'));
    total += parseValue($('[calc="silver-carried"]')) * 10;
    total += parseValue($('[calc="gold-carried"]')) * 100;
    total += parseValue($('[calc="platinum-carried"]')) * 1000;

    var totalCarried = Math.round(total) / 100;
    writeValue('[calc="currency-carried"]', totalCarried);

    grandTotal += total;
    total = parseValue($('[calc="copper-stored"]'));
    total += parseValue($('[calc="silver-stored"]')) * 10;
    total += parseValue($('[calc="gold-stored"]')) * 100;
    total += parseValue($('[calc="platinum-stored"]')) * 1000;

    var totalStored = Math.round(total) / 100;
    writeValue('[calc="currency-stored"]', totalStored);

    var totalWeight = sumValues('[sum="currency-weight"]') / 50;
    writeValue('[calc="currency-weight"]', totalWeight);

    grandTotal += total;
    writeValue('[calc="currency-grand-total"]', grandTotal / 100);

}

function calculateManeuvers() {
    log("calc maneuvers");

    // CMB
    var type = $('[calc="cmb-type"]').val();
    var ability = parseValue('[calc="' + type + '-mod"]');
    writeValue('[calc="cmb-ability"]', ability);

    var total = sumValues('[sum="cmb"]');
    writeValue('[calc=cmb-total]', total);

    // CMD
    total = sumValues('[sum="cmd"]') + 10;
    writeValue('[calc="cmd-total"]', total)
}

function calculateInit() {
    log("calc init");

    var total = sumValues('[sum="init"]');
    writeValue('[calc="init-total"]', total);
}

function calculateSkills() {
    log("calc skills");

    $('[calc="skills"]').each(function() {
        log("calc " + $(this).find('[calc="skill-name"]').text());
        var skillRanks = parseValue($(this).find('[calc="skill-ranks"]'));
        var needsTraining = $(this).attr('train') == 1;

        var trainedPoints = 0;
        if ($(this).find('[calc="skill-trained"]').is(':checked'))
            trainedPoints = 3;
        if (skillRanks < 1) {
            trainedPoints = 0;
        }
        $(this).find('[calc="skill-trained-points"]').text(trainedPoints);

        if (needsTraining && skillRanks < 1)
            $(this).addClass('needs-train');
        else
            $(this).removeClass('needs-train');

        var typeElement = $(this).find('[calc="skill-type"]');
        if (typeElement.prop("tagName") == "SELECT") {
            var type = $(this).find('[calc="skill-type"]').val();
            var abilityMod = parseValue('[calc="' + type + '-mod"]');
            $(this).find('[calc="skill-type-ability"]').text(abilityMod)
        }
        else {
            var type = $(this).find('[calc="skill-type"]').text().toLowerCase();
        }

        var total = sumValues($(this).find('[sum="skill"]'));
        if (type == "str" || type == "dex")
            total += parseValue('[calc="penalty-total"');

        writeValue($(this).find('[calc="skill-total"]'), total);
    });

    var totalRanks = sumValues('[calc="skill-ranks"]');
    writeValue('[calc="skill-used"]', totalRanks);
}

function calculateArmor() {
    log("calc armor");

    var maxDexWeight = parseValue('[calc="max-dex-weight"]');
    var checkPenaltyWeight = parseValue('[calc="check-penalty-weight"]');
    log("max dex weight " + maxDexWeight + " check penalty weight " + checkPenaltyWeight);
    var maxDexBonus = maxDexWeight;

    // Calc some values first
    var armorGear = parseValue('[calc="armor-ac-bonus"]');
    armorGear += parseValue('[calc="armor-enhance-bonus"]');
    writeValue('[calc="armor-gear"]', armorGear);

    var shieldGear = parseValue('[calc="shield-ac-bonus"]');
    shieldGear += parseValue('[calc="shield-enhance-bonus"]');
    writeValue('[calc="shield-gear"]', shieldGear);

    var armorCheckPenalty = sumValues('[sum="armor-penalty"]');
    if (armorCheckPenalty > checkPenaltyWeight) armorCheckPenalty = checkPenaltyWeight;
    writeValue('[calc="penalty-total"]', armorCheckPenalty);

    var dexMod = parseValue('[calc="dex-mod"]');

    var maxDexArmor = parseInt($('[calc="armor-max-dex"]').val());
    if (isNaN(maxDexArmor)) maxDexArmor = dexMod;
    var maxDexShield = parseInt($('[calc="shield-max-dex"]').val());
    if (isNaN(maxDexShield)) maxDexShield = dexMod;

    maxDexBonus += dexMod;
    maxDexBonus = Math.min(maxDexBonus, maxDexArmor, maxDexShield);
    if (maxDexBonus < 0) maxDexBonus = 0;
    if (maxDexBonus > maxDexWeight) maxDexBonus = maxDexWeight;
    writeValue('[calc="max-dex-total"]', maxDexBonus);
    writeValue('[calc="max-dex-bonus"]', maxDexBonus);

    // Sum up everything
    var total = sumValues('[sum="armor-total"]') + 10;
    writeValue('[calc="total-ac"]', total);

    var touch = total;
    touch -= parseValue('[calc="armor-gear"]');
    touch -= parseValue('[calc="shield-gear"]');
    touch -= parseValue('[saveas="armor_natural"]');
    writeValue('[calc="touch-ac"]', touch);

    var flatFoot = total;
    flatFoot -= parseValue('[saveas="armor_dodge"]');
    flatFoot -= maxDexBonus;
    writeValue('[calc="flatfoot-ac"]', flatFoot);

    var spellFailChance = sumValues('[sum="spell-chance"]');
    writeValue('[calc="spell-fail-total"]', spellFailChance + "%");

    // Update dodge and deflect for refs
    writeValueSelf('[calc="armor-dodge"]');
    writeValueSelf('[calc="armor-deflect"]');
}

function calculateSaves() {
    log("calc saves");

    $('[calc="saves"]').each(function() {
        var type = $(this).find('[calc="save-type"]').val();
        var total = sumValues($(this).find('[sum="save"]'));
        writeValue($(this).find('[calc="save-total"]'), total);
    });
}

function calculateHealth() {
    log("calc health");

    var total = 0;
    $('#health [calc="total"]').each(function () {
        total += parseValue(this);
    });
    $('#health .column [calc="result-total"]').text(total);

    var lethal = $('div[calc="lethal"] input').val()
    if (isNaN(lethal)) lethal = 0;

    var nonlethal = $('div[calc="nonlethal"] input').val()
    if (isNaN(nonlethal)) nonlethal = 0;

    var con = parseValue($('#health').find('[ref="con-total"]'));

    var current = total - lethal;
    var status = "GOOD";
    if (current == nonlethal) status = "DISABLE";
    if (current < nonlethal) status = "OUT";
    if (current <= -con) status = "DEAD";

    writeValue('#health .column [calc="current"]', current);
    writeValue('#health .column [calc="status"]', status);
    // $('#health .column [calc="current"]').text(current);
    // $('#health .column [calc="status"]').text(status);

    if (nonlethal < 0) nonlethal = 0;
    if (current > total) current = total;
    var koWidth = mapRange(nonlethal, 0, total, 0, 100);
    var hpWidth = mapRange(current, 0, total, 0, 100) - koWidth;
    if (hpWidth < 0) koWidth += hpWidth;
    $('[calc="healthbar-ko"]').width(koWidth + '%');
    $('[calc="healthbar-hp"]').width(hpWidth + '%');

    var mode = $('#mode').val();
    if (mode != "view" && !firstLoad) { // If in edit mode
        var editid = $('#editid').val();
        if (editid != "" && typeof editid !== 'undefined') {
            saveHp();
        }
    }
}

function calculateClass() {
    log("calc class");

    $('[calc="classes-total"] h4').each(function() {
        var total = sumValues($('#classes [calc="' + $(this).attr("calc") + '"]'));
        writeValue(this, total);
    });

    populateOptions('[calc="favored-class"]', '[calc="class-name"]');
    $('[calc="casting-class-name"]').each(function() {
        populateOptions(this, '[calc="class-name"]');
    });

    calculateCasting();
}

function calculateSize() {
    log("calc size");

    var value = $('[calc="size"]').find(':selected').attr("mod");
    if (isNaN(value)) value = 0;

    writeValue('[calc="size-mod"]', value);
    writeValue('[calc="size-mod-special"]', value * -1);
}

function calculateAttacks() {
    log("calc attacks");

    $('[calc="attacks"]').each(function () {
        var total = 0;
        $(this).find('[calc="attack"]').each(function () {
            total += parseValue(this);
        });
        writeValue($(this).find('[calc="result-total"]'), total);
    });
}

function calculateCasting() {
    log("calc casting");

    $('#casting-class .entry').each(function() {
        // class level (wow this is complex UGH)
        var level = 0;
        var calcRow = $(this);
        var targetName = $(this).find('[calc="casting-class-name"]').val();
        $('[calc="class-name"]').each(function() {
            var sourceName = $(this).val();
            if (targetName == sourceName) {
                var sourceRow = $(this).parent().parent();
                level = parseValue(sourceRow.find('[calc="levels"]'));
            }
        });
        calcRow.find('[calc=casting-class-level]').text(level);

        // attribute modifier
        var attribute = $(this).find('[calc="casting-class-attribute"]').val();
        var modifier = parseValue('[calc="' + attribute + '-mod"]');
        writeValue($(this).find('[calc="casting-class-mod"]'), modifier);
        $(this).find('[calc="casting-class-mod"]').text(modifier);

        calcRow.find('[calc="spell-dc"]').each(function(i) {
            var dc = modifier + i + 10;
            writeValue(this, dc);
        });

        var concentration = level + modifier;
        writeValue(calcRow.find('[calc="casting-concentration"]'), concentration);

        // ranges
        var rangeClose = Math.floor(level/2) * 5 + 25;
        var rangeMedium = level * 10 + 100;
        var rangeLong = level * 40 + 400;

        writeValue($(this).find('[calc=casting-range-close]'), rangeClose + "ft");
        writeValue($(this).find('[calc=casting-range-medium]'), rangeMedium + "ft");
        writeValue($(this).find('[calc=casting-range-long]'), rangeLong + "ft");

        for(var i = 0; i < 10; i++) {
            var spellsPerDay = sumValues($(this).find('[sum="spells-' + i + '-day"]'));
            writeValue($(this).find('[calc="spells-' + i + '-day-total"]'), spellsPerDay);
        }
    });

    $('[calc="spell-caster-class-name"]').each(function() {
        populateOptions(this, '[calc="casting-class-name"]');
    });
}

function calculateSpellList() {
    log("calc spell list");

    $('#spell-list .entry').each(function() {
        var modifier = 0;
        var targetName = $(this).find('[calc="spell-caster-class-name"]').val();
        $('[calc="casting-class-name"]').each(function() {
            var sourceName = $(this).val();
            if (targetName == sourceName) {
                var sourceRow = $(this).parent().parent();
                modifier = parseValue(sourceRow.find('[calc="casting-class-mod"]'));
            }
        });

        var spellLevel = parseValue($(this).find('[calc="spell-list-level"]'));
        var dc = 10 + modifier + spellLevel;

        writeValue($(this).find('[calc="spell-list-dc"]'), dc);
    });
}

function sumValues(element) {
    if (!(element instanceof jQuery)) element = $(element);
    var total = 0;
    element.each(function() {
        total += parseValue(this);
    });
    return total;
}
function parseValue(element) {
    if (!(element instanceof jQuery)) element = $(element);
    var value = parseFloat(element.val());
    if (isNaN(value)) value = parseFloat(element.text());
    if (isNaN(value)) value = 0;
    if (element.attr("calctype") == "subtract") value *= -1;
    return value;
}
function readValue(element) { // Used for SAVING ONLY
    var value = $(element).val();
    if ($(element).attr("type") == "number") {
        if (isNaN(parseFloat(value))) return '';
    }
    if ($(element).prop("tagName") == "H4") value = $(element).text();
    if ($(element).prop("tagName") == "P") value = $(element).text();
    if ($(element).prop("tagName") == "SPAN") value = $(element).text();
    if ($(element).attr("type") == "checkbox") value = $(element).is(':checked');
    return value;
}
function writeValue(element, data, updateRef = true) {
    if (data == "undefined") data = ""; // Dirty fix

    if ($(element).attr("type") == "checkbox") {
        if (data == "true") $(element).prop("checked", true);
        else $(element).prop("checked", false);
    }
    else {
        if ($(element).prop("tagName") == "INPUT") $(element).val(data);
        else if ($(element).prop("tagName") == "SELECT") {
            if (data == "") {
                data = ($(element).find(':selected').val());
            }
            if (!$(element).find("option").length) {
                cachedLoadData[cachedIndex] = data;
                cachedIndex++;
            }
            if (data != "null") { // Gross fix whoops
                if (!$(element).find('option[value="' + data + '"]').length) {
                    $('<option />', {value: data, text: data}).appendTo($(element));
                }
            }
            $(element).val(data);
        }
        else $(element).text(data);
    }

    if (updateRef) {
        // Update elements that ref this value
        var calcId = $(element).attr("calc");
        var saveId = $(element).attr("saveas");
        updateRefs(calcId, data);
        updateRefs(saveId, data);
    }
}
function writeValueSelf(element) {
    writeValue(element, parseValue(element));
}

function updateRefs(element, data) {
    var ref = $('[ref="' + element + '"]');
    if (ref.length) {
        writeValue('[ref="' + element + '"]', data, false); // Write value but dont trigger
        ref.trigger('change');
    }
}

function loadData(data, status, imported = false) {
    loadingMessage("Loading Data");

    $('.reveal').hide();
    cachedIndex = 0;
    $('[dynamic]').html("");

    var data = JSON.parse(data);
    $('[saveas][readonly!="readonly"][load!="no"]').each(function() {
        var saveas = $(this).attr("saveas");
        var value = data[saveas];
        if (typeof value == 'undefined') return true; // Continue;
        var element = $(this); // this is the input thing

        log("loading " + saveas);

        // Columns are stored as comma separated data
        if ($(this).parents('[savetype="columns"]').length) {
            var dataArray = value.split(",");
            var rowsNeeded = dataArray.length;
            var columnsParent = $(this).parents('[savetype="columns"]');
            var rows = columnsParent.find('[saveas="' + saveas + '"]').length;
            // var rows = $('[saveas="' + saveas + '"]').length;
            log("rows " + rows + "/" + rowsNeeded);
            // Generate extra rows as needed
            log("generating row " + rows + "/" + rowsNeeded);
            while (rows < rowsNeeded) {
                // var parentRow = element.closest('.entries');
                var parentRow = columnsParent;
                var newRow = parentRow.children().last().clone();
                newRow.appendTo(parentRow);
                newRow.attr("extra", "true");
                rows++;
                log("generating row " + rows + "/" + rowsNeeded);
            }

            // Actually load the data
            columnsParent.find('[saveas="' + saveas + '"][readonly!="readonly"]').each(function(i) {
            // $('[saveas="' + saveas + '"][readonly!="readonly"]').each(function(i) {
                if ($(this).attr("load") != "no") {
                    try {
                        var arrayValue = decodeURIComponent(dataArray[i]);
                    }
                    catch(err) {
                        sendMessage(err);
                    }
                    writeValue(this, arrayValue, false);
                }
            });
        }
        else {
            writeValue(this, value, false);
        }
    });

    if (!imported) {
        var domain = data['domain'];
        var publicid = data['publicid'];
        $("#publicurl").val(domain + "/v/" + publicid);
        $("#viewid").val(publicid);
    }

    $('#publicurl-link').attr('href', 'http://' + domain + "/v/" + publicid);
    $('#compact-link').attr('href', 'http://' + domain + "/c/" + publicid);

    loadingMessage("Crunching Numbers");

    updateEvents();

    if (imported) firstLoad = true;

    calculateAll();

    // Set values of dynamic drop downs
    $('[dynamic]').each(function(i) {
        writeValue($(this), cachedLoadData[i]);
        $(this).trigger('change'); // might need this?
    });

    // Tags Setup
    $('#language-tags, #resistance-tags, #conditions-tags').tagsInput({
        width:'auto',
        height: '3.8rem',
        defaultText: '',
        interactive: mode != view
    });

    document.title = $('.sheet').val() + " Pathfinder Character Sheet";

    loadingMessage("Wrapping Up");

    // When viewing replace all form fields with static stuff
    var mode = $('#mode').val();
    if (mode == "view") {
        $('.tag a').remove();
        $('#sheet input, #sheet textarea').attr("readonly", "readonly");
        $('#sheet textarea').css("resize", "none");
        $('.sheet').attr("readonly", "readonly");
        $('#sheet input[type="checkbox"], #sheet select').attr("disabled", true);
    }

    callbackFinishedLoading(data);

    // Local Storage recent sheets
    if (mode != "view") {
        var editid = $('#editid').val();
        if (editid != "" && typeof editid !== 'undefined') {
            var recentSheets = localStorage.getItem("recent");
            if (recentSheets === null) {
                localStorage.setItem('recent', JSON.stringify([]));
                recentSheets = localStorage.getItem("recent");
            }
            recentSheets = JSON.parse(recentSheets);
            for(var i = 0; i < recentSheets.length; i++) {
                if (recentSheets[i]['key'] == editid)
                    recentSheets.splice(i, 1);
            }
            if (recentSheets.length > 10)
                recentSheets.splice(0, 1);
            var item = {key: editid, name: $('[saveas="sheetname"]').val()};
            recentSheets.push(item);
            localStorage.setItem('recent', JSON.stringify(recentSheets));
        }
    }

    $('#loading-overlay').fadeOut(250);
    log("================");
}

function loadingMessage(text) {
    // This might work someday...
    $('#loading-overlay p').text(text);
}

function load() {
    log("load");

    var loadingOverlay = $('#loading-overlay');
    // $('body').prepend(loadingOverlay);
    loadingOverlay.show();

    loadingMessage("Cleaing Up");

    $('[extra="true"]').remove();

    var editid = $('#editid').val();
    var viewid = $('#viewid').val();
    var mode = $('#mode').val();

    loadingMessage("Fetching Data");

    $.post("/p", {
        mode: "load",
        token: $('#session-token').val(),
        editid: editid,
        viewid: viewid
    },
    function(data, status) {
        if (data == "-")
            sendMessage("Validation error :(")
        else
            loadData(data, status);
    });
}

function sendMessage(message) {
    $('#server-message').stop(true, true);
    $('#server-message').fadeIn(1);
    $('#server-message').text(message);
    $('#server-message').delay(5000).fadeOut(2000);
    $('#loading-overlay p').text(message);
}

function revealMore(element) {
    var more = $(element).parents('.entry').find('.reveal').slideDown(200);
    $(element).val("-");
    $(element).attr('onclick', 'hideMore(this)');
}

function hideMore(element) {
    var more = $(element).parents('.entry').find('.reveal').slideUp(200);
    $(element).val("+");
    $(element).attr('onclick', 'revealMore(this)');
}

function populateOptions(target, data) {
    var selected = $(target).val();
    $(target).html('');
    $(data).each(function() {
        var value = $(this).val();
        $('<option />', {value: value, text: value}).appendTo($(target));
    });
    if (selected == '')
        $(target).val($(target).find('option:first').val());
    else
        $(target).val(selected);
}

function view() {
    log("view");
}

function scrollTo(h1tag) {
    var element = $('h1:contains(' + h1tag + ')');
    $('html, body').animate({
        scrollTop: $(element).offset().top - 80
    }, 500);
}

function sheetExport() {
    log("export");

    $('.importer').fadeOut(250);

    var savedata = {};
    $('[saveas]').each(function() {
        var key = $(this).attr("saveas");
        var value = readValue(this);

        savedata[key] = value;
        if ($(this).parents('[savetype="columns"]').length) {
            savedata[key] = $('[saveas="' + $(this).attr("saveas") + '"]').map(function() {
                return encodeURIComponent(readValue(this));
            }).get().join(",");
        }
    });

    var str = JSON.stringify(savedata);

    $('#export-data').val(str);
    $('.exporter').fadeIn(250);
}

function sheetImport() {
    var mode = $('#mode').val();
    if (mode == 'view') return;

    log("import");

    $('.importer').fadeIn(250);
}

function loadImport(element) {
    var mode = $('#mode').val();
    if (mode == 'view') return;
    
    var data = $('#import-data').val();
    $('.importer').fadeOut(250);

    var loadingOverlay = $('#loading-overlay');
    // $('body').prepend(loadingOverlay);
    loadingOverlay.show();
    $('[extra="true"]').remove();

    loadData(data, "success", true);
    $('#import-data').val('');
}

function closeOverlay(element) {
    $(element).parent().parent().parent().fadeOut(250);
}

function viewCompact() {
    window.location.href = "/c/" + $('#viewid').val();
}

function dropDown() {
    $('#dropdown').toggle();
}

function ping() {
    $.post("/p", {
        mode: "ping",
        token: $('#session-token').val(),
    },
    function(data, status) {
        // sendMessage("Session refreshed."); // Eh dont really need this
    });
}
