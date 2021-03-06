<html>
<head>
<link rel="icon" type="image/png" href="/favicon.png" />
<link rel="stylesheet" href="/css/compact/style.css" type="text/css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/js/jquery.tagsinput.min.js"></script>

<title></title>

</head>
<body>

<input type="hidden" value="<?=$view_id?>" id="viewid">
<input type="hidden" value="<?=$token?>" id="session-token">
<input type="hidden" saveas="sheetname" class="sheet">

<div class="bg0 strong caps">
    <span saveas="charname" class="list"></span>
    <a href="/v/<?=$view_id?>" class="list"><?=say('full_view')?></a>
    <a href="/" class="list"><?=say('button_home')?></a>
</div>
<div>
    <span saveas="gender"></span>
    <span saveas="race"></span>
    <span class="entries" savetype="columns">
        <span>
            <span saveas="class_name"></span>
            <span saveas="class_levels"></span>
        </span>
    </span>
</div>
<div>
    <span saveas="alignment" class="caps"></span>
    <span saveas="size" class="capitalize"></span>
    (<span saveas="creature_type" class="capitalize"></span>)
    <span saveas="known_languages"></span>
</div>
<div>
    <span class="strong"><?=say('init')?></span>
    <span saveas="final_init"></span>
</div>
<div class="header">
    <?=say('defense')?>
</div>
<div>
    <span class="list">
        <span class="strong"><?=say('ac')?></span>
        <span saveas="final_ac"></span>

        <span class="strong"><?=say('touch')?></span>
        <span saveas="final_touch"></span>

        <span class="strong"><?=say('flat_foot')?></span>
        <span saveas="final_flatfoot"></span>
    </span>

    <span class="list">
        <span class="clear-if-empty">
            <span><?=say('armor')?></span>
            <span saveas="final_armor"></span>
        </span>
        <span class="clear-if-empty">
            <span><?=say('shield')?></span>
            <span saveas="final_shield"></span>
        </span>
        <span class="clear-if-empty">
            <span><?=say('dex')?></span>
            <span saveas="final_dex_armor"></span>
        </span>
        <span class="clear-if-empty">
            <span><?=say('size')?></span>
            <span saveas="final_size_armor"></span>
        </span>
        <span class="clear-if-empty">
            <span><?=say('dodge')?></span>
            <span saveas="armor_dodge"></span>
        </span>
        <span class="clear-if-empty">
            <span><?=say('natural')?></span>
            <span saveas="armor_natural"></span>
        </span>
        <span class="clear-if-empty">
            <span><?=say('deflect')?></span>
            <span saveas="armor_deflect"></span>
        </span>
        <span class="clear-if-empty">
            <span><?=say('misc')?></span>
            <span saveas="armor_misc"></span>
        </span>
    </span>

</div>
<div>
    <span class="list">
        <span class="strong"><?=say('hp')?></span>
        <span saveas="final_hp_total"></span>
    </span>

    <span class="list">
        <span class="strong"><?=say('current')?></span>
        <span saveas="final_hp_current"></span>
    </span>

    <span class="list">
        <span class="strong"><?=say('nonlethal')?></span>
        <span saveas="health_nonlethal"></span>
    </span>
</div>
<div>
    <span class="strong"><?=say('fort')?></span>
    <span saveas="final_fort"></span>

    <span class="strong"><?=say('ref')?></span>
    <span saveas="final_ref"></span>

    <span class="strong"><?=say('will')?></span>
    <span saveas="final_will"></span>
</div>
<div>
    <span class="list">
        <span class="clear-if-empty">
            <span class="strong"><?=say('resist')?></span>
            <span saveas="damage_resistance"></span>
        </span>
    </span>
    <span class="list">
        <span saveas="other_resistance" class="comma-list"></span>
    </span>
    <span class="list">
        <span class="clear-if-empty">
            <span class="strong"><?=say('sr')?></span>
            <span saveas="spell_resistance"></span>
        </span>
    </span>
</div>
<div class="header">
    <?=say('offense')?>
</div>
<div>
    <span class="list">
        <span class="strong"><?=say('speed')?></span>
        <span saveas="movement_speed"></span>ft
    </span>

    <span class="list">
        <span class="clear-if-empty"><?=say('base')?> <span saveas="movement_base"></span>ft</span>
        <span class="clear-if-empty"><?=say('fly')?> <span saveas="movement_fly"></span>ft</span>
        <span class="clear-if-empty"><?=say('swim')?> <span saveas="movement_swim"></span>ft</span>
        <span class="clear-if-empty"><?=say('climb')?> <span saveas="movement_climb"></span>ft</span>
        <span class="clear-if-empty"><?=say('misc')?> <span saveas="movement_misc"></span>ft</span>
    </span>
</div>
<div>
    <span class="list">
        <span class="strong"><?=say('melee')?></span>
        <span saveas="final_melee"></span>
    </span>
    <span class="list">
        <span class="strong"><?=say('ranged')?></span>
        <span saveas="final_ranged"></span>
    </span>
</div>
<div class="entries" savetype="columns">
    <div>
        <span class="strong capitalize" saveas="weapon_attack_type"></span>
        <a saveas="weapon_name"></a>
        <span saveas="weapon_attack"></span>
        <span saveas="weapon_damage"></span>
        <span class="clear-if-empty">(<span saveas="weapon_critical"></span>)</span>
    </div>
</div>
<div class="entries" savetype="columns" id="spell-list">
    <div>
        <span class="strong" saveas="casting_class"></span>
        <span class="strong"><?=say('spells')?></span>
        <?=say('cl')?> <span saveas="final_casting_class_level"></span>
        <?=say('concentration')?> <span saveas="final_concentration"></span>
        <div data="spell-entry" class="indent">
            <span data="spell-level"></span>
            [<span data="spell-per-day"></span>]
            <span data="spell-dc"></span>
            <span data="spell-names">
                <a class="list"></a>
            </span>
        </div>
    </div>
</div>
<span class="entries list clear-if-empty" savetype="columns">
    <span class="list">
        <span class="strong capitalize" saveas="caster_attr_0_type"></span>
        <span class="capitalize check-for-empty" saveas="caster_attr_0_entry"></span>
    </span>
</span>
<span class="entries list clear-if-empty" savetype="columns">
    <span class="list">
        <span class="strong capitalize" saveas="caster_attr_1_type"></span>
        <span class="capitalize check-for-empty" saveas="caster_attr_1_entry"></span>
    </span>
</span>

<div class="header">
    <?=say('statistics')?>
</div>
<div>
    <? foreach(array("str", "dex", "con", "int", "wis", "cha") as $type) { ?>
    <span class="strong caps"><?=say($type)?></span>
    <span saveas="final_<?=$type?>_total"></span>
    <? } ?>
</div>
<div>
    <span class="strong"><?=say('bab')?></span>
    <span saveas="final_bab"></span>

    <span class="strong"><?=say('cmb')?></span>
    <span saveas="final_cmb"></span>

    <span class="strong"><?=say('cmd')?></span>
    <span saveas="final_cmd"></span>
</div>
<div>
    <span class="strong"><?=say('feats')?></span>
    <span class="entries" savetype="columns">
        <span class="list">
            <a saveas="feat_name"></a>
        </span>
    </span>
</div>
<div>
    <span class="strong"><?=say('skills')?></span>
    <span class="entries" savetype="columns">
        <span class="list clear-if-empty">
            <span saveas="skill_name"></span>&nbsp;<span saveas="final_skill"></span>
        </span>
    </span>
</div>
<div>
    <span class="strong"><?=say('abilities')?></span>
    <span class="entries" savetype="columns">
        <span class="list">
            <a saveas="special_name"></a>
            <span class="clear-if-empty">(<span saveas="special_type" class="check-for-empty"></span>)</span>
        </span>
    </span>
</div>
<div>
    <span class="strong"><?=say('gear')?></span>
    <span class="entries list" savetype="columns">
        <span class="list clear-if-empty">
            <a saveas="gear_quantity_description"></a>&nbsp;x<span saveas="gear_quantity"></span>
        </span>
    </span>

    <span class="entries list" savetype="columns">
        <span class="list clear-if-empty">
            <a saveas="gear_uses_description"></a>&nbsp;*<span saveas="gear_uses"></span>
        </span>
    </span>
</div>
<div>
    <span class="strong"><?=say('magic_items')?></span>
    <span class="entries list">
        <? foreach(array("belt", "body", "chest", "eyes", "feet", "hands", "head", "headband", "neck", "ring", "ring2", "shoulders", "wrist") as $type) { ?>
        <span class="entry clear-if-empty"><a saveas="magic_item_<?=$type?>" magic-item="<?=$type?>"></a>&nbsp;</span>
        <? } ?>
    </span>
</div>
<div>
    <span class="strong"><?=say('coin')?></span>
    <span class="list clear-if-empty">
        <span saveas="final_currency_carried"></span>g&nbsp;carried
    </span>
    <span class="list clear-if-empty">
        <span saveas="final_currency_stored"></span>g&nbsp;stored
    </span>
</div>
<div>
    <span class="strong"><?=say('weight')?></span>
    <span saveas="weight_total"></span>
    (<span saveas="weight_status"></span>)
</div>
<div class="header">
    <?=say('special_abilities')?>
</div>
<div class="entries" savetype="columns">
    <div>
        <span class="strong" saveas="feat_name"></span>
        <span saveas="feat_more_notes"></span>
    </div>
</div>
<div class="entries" savetype="columns">
    <div class="clear-if-empty">
        <span class="strong check-for-empty" saveas="special_name"></span>
        (<span saveas="special_type"></span>)
        <span saveas="special_notes"></span>
    </div>
</div>
<div class="header">
    <?=say('notes')?>
</div>
<div>
    <span class="strong" saveas="notes_1_header"></span>
    <pre saveas="notes_1_contents"></pre>
</div>
<div>
    <span class="strong" saveas="notes_2_header"></span>
    <pre saveas="notes_2_contents"></pre>
</div>
<div>
    <span class="strong" saveas="notes_3_header"></span>
    <pre saveas="notes_3_contents"></pre>
</div>

<input type="hidden" calc="weight-legs" value="2">
<input type="hidden" calc="size" value="medium">

<script type="text/javascript" src="/js/sheet.js"></script>
<script type="text/javascript" src="/js/pf.js"></script>
<script>
$(function() {

    callbackFinishedLoading = function(data) {
        // Dont break up names with auto wrap
        $('[saveas="skill_name"]').each(function() {
            var text = $(this).text().replace(' *', '');
            text = text.replace(/ /g, '\xa0');
            $(this).text(text);
        });

        $('[saveas="gear_quantity_description"]').each(function() {
            var text = $(this).text().replace(/ /g, '\xa0');
            $(this).text(text);
        });

        $('[saveas="gear_uses_description"]').each(function() {
            var text = $(this).text().replace(/ /g, '\xa0');
            $(this).text(text);
        });

        // Some things should just be removed from the dom if they're empty
        $('.clear-if-empty').each(function() {
            var parent = $(this);
            parent.find('[saveas]').each(function() {
                var text = $(this).text();
                if (text == "" || text == "null" || text == "0" || text == " ")
                    parent.remove();
            });
            parent.find('.check-for-empty').each(function() {
                var text = $(this).text();
                if (text == "" || text == "null" || text == "0" || text == " ")
                    parent.remove();
            });
        });

        // Make tagged lists more readable
        $('.comma-list').each(function() {
            var text = $(this).text().replace(/,/g, ', ');
            $(this).text(text);
        });

        $('[magic-item]').each(function(i, e) {
            var slot = $(this).attr('magic-item');
            var description = data['magic_item_' + slot + '_notes'];
            var url = data['magic_item_' + slot + '_url'];

            $(this).attr('href', url);
            $(this).attr('title', description);
        });

        // Add hover over stuff and links to everything
        var weaponNotes = decodeToArray(data['weapon_notes']);
        var weaponUrl = decodeToArray(data['weapon_ref']);
        $('.entries [saveas="weapon_name"]').each(function(i) {
            var hoverText = weaponNotes[i];
            $(this).attr('title', hoverText);
            if (weaponUrl[i] != "")
                $(this).attr('href', weaponUrl[i]);
        });

        var specialAbilityNotes = decodeToArray(data['special_notes']);
        var specialAbilityUrl = decodeToArray(data['special_url']);
        $('.list [saveas="special_name"]').each(function(i) {
            $(this).attr('title', specialAbilityNotes[i]);
            if (specialAbilityUrl[i] != "")
                $(this).attr('href', specialAbilityUrl[i]);
        });

        var featNotes = decodeToArray(data['feat_notes']);
        var featMoreNotes = decodeToArray(data['feat_more_notes'])
        var featUrl = decodeToArray(data['feat_url']);
        $('.list [saveas="feat_name"]').each(function(i) {
            var featTitle = featNotes[i];
            if (featMoreNotes[i] != "")
                featTitle += "\n\n" + featMoreNotes[i];
            $(this).attr('title', featTitle);
            if (featUrl[i] != "")
                $(this).attr('href', featUrl[i]);
        });

        var gearQuantityNotes = decodeToArray(data['gear_quantity_notes']);
        var gearQuantityUrl = decodeToArray(data['gear_quantity_url']);
        $('.list [saveas="gear_quantity_description"]').each(function(i) {
            var hoverText = gearQuantityNotes[i];
            $(this).attr('title', hoverText);
            if (gearQuantityUrl[i] != "")
                $(this).attr('href', gearQuantityUrl[i]);
        });

        var gearUsesNotes = decodeToArray(data['gear_uses_notes']);
        var gearUsesUrl = decodeToArray(data['gear_uses_url']);
        $('.list [saveas="gear_uses_description"]').each(function(i) {
            var hoverText = gearUsesNotes[i];
            $(this).attr('title', hoverText);
            if (gearUsesUrl[i] != "")
                $(this).attr('href', gearUsesUrl[i]);
        });

        // Spell list stuff oh my god why
        var classes = decodeToArray(data['casting_class']);
        var levels = decodeToArray(data['spell_list_level']);
        var spellNames = decodeToArray(data['spell_list_name']);
        var spellSchools = decodeToArray(data['spell_list_school']);
        var spellDurations = decodeToArray(data['spell_list_duration']);
        var spellRanges = decodeToArray(data['spell_list_range']);
        var spellSaves = decodeToArray(data['spell_list_save']);
        var spellSrs = decodeToArray(data['spell_list_sr']);
        var spellCasters = decodeToArray(data['spell_list_class_name']);
        var spellNotes = decodeToArray(data['spell_list_notes']);
        var spellUrl = decodeToArray(data['spell_list_ref']);
        var dcs = decodeToArray(data['spell_list_dc']);
        var mods = decodeToArray(data['casting_class_mod']);

        if (spellNames.length == 1 && spellNames[0] == '') {
            $('#spell-list').remove();
        }

        // Make the spell list yahoooooo~
        $('[saveas="casting_class"]').each(function() {
            var className = $(this).text();
            var classNameIndex;
            for(var i = 0; i < classes.length; i++ ) {
                if (className == classes[i]) {
                    classNameIndex = i;
                    break;
                }
            }

            var castingMod = parseInt(mods[classNameIndex]);
            var container = $(this).parent();
            var row = container.find('[data="spell-entry"]');

            for(var lv = 9; lv >= 0; lv--) {
                var dc = castingMod + 10 + lv;
                var spellsPerDay = decodeToArray(data['spells_' + lv + '_per_day']);
                var perDay = spellsPerDay[classNameIndex];

                var newRow = row.clone();
                newRow.find('[data="spell-level"]').text('Lv' + lv);
                newRow.find('[data="spell-per-day"]').text(perDay + '/day');

                if (lv == 0 && perDay == 0)
                    newRow.find('[data="spell-per-day"]').text('at will');

                newRow.find('[data="spell-dc"]').text('(DC ' + dc + ')');
                var spellNameContainer = newRow.find('[data="spell-names"]');
                var spellName = spellNameContainer.children();

                // WHAT IS HAPPENING
                for(var i = 0; i < spellNames.length; i++) {
                    if (levels[i] == lv && spellCasters[i] == className) {
                        var newSpellName = spellName.clone();
                        newSpellName.text(spellNames[i]);
                        var hoverText =
                            spellNames[i] + ": " +
                            spellSchools[i] + ", " +
                            spellDurations[i] + ", " +
                            spellRanges[i];

                        if (spellSaves[i] != "null" && spellSaves[i] != "" && spellSaves[i] != "Null")
                            hoverText += ", " + capitalizeFirstLetter(spellSaves[i]);

                        if (spellSrs[i] == "true")
                            hoverText += ", SR";

                        if (spellNotes[i] != "")
                            hoverText += "\n\n" + spellNotes[i];

                        newSpellName.attr('title', hoverText);
                        newSpellName.appendTo(spellNameContainer);

                        if (spellUrl[i] != "")
                            newSpellName.attr('href', spellUrl[i]);
                    }
                }

                spellName.remove();
                if (spellNameContainer.children().length)
                    newRow.appendTo(container)
            }
            row.remove();
        });

        $('span[saveas="known_languages"]').each(function() {
            var text = $(this).text().replace(/,/g, ", ");
            $(this).text(text); // lol
        });

        // I'm so lazy
        $('.entries a').attr('target', 'pfsearch')
    }
});

function decodeToArray(data) {
    var split = data.split(',');
    for(var i = 0; i < split.length; i++) {
        split[i] = decodeURIComponent(split[i]);
    }
    return split;
}
</script>
</body>
</html>
