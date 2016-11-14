<html>
<head>

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
    <a href="/v/<?=$view_id?>" class="list">FULL VIEW</a>
    <a href="/" class="list">HOME</a>
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
</div>
<div>
    <span class="strong">Init</span>
    <span saveas="final_init"></span>
</div>
<div class="header">
    defense
</div>
<div>
    <span class="list">
        <span class="strong">AC</span>
        <span saveas="final_ac"></span>

        <span class="strong">Touch</span>
        <span saveas="final_touch"></span>

        <span class="strong">Flatfoot</span>
        <span saveas="final_flatfoot"></span>
    </span>

    <span class="list">
        <span class="clear-if-empty">
            <span>Armor</span>
            <span saveas="final_armor"></span>
        </span>
        <span class="clear-if-empty">
            <span>Shield</span>
            <span saveas="final_shield"></span>
        </span>
        <span class="clear-if-empty">
            <span>Dex</span>
            <span saveas="final_dex_armor"></span>
        </span>
        <span class="clear-if-empty">
            <span>Size</span>
            <span saveas="final_size_armor"></span>
        </span>
        <span class="clear-if-empty">
            <span>Dodge</span>
            <span saveas="armor_dodge"></span>
        </span>
        <span class="clear-if-empty">
            <span>Natural</span>
            <span saveas="armor_natural"></span>
        </span>
        <span class="clear-if-empty">
            <span>Deflect</span>
            <span saveas="armor_deflect"></span>
        </span>
        <span class="clear-if-empty">
            <span>Misc</span>
            <span saveas="armor_misc"></span>
        </span>
    </span>

</div>
<div>
    <span class="list">
        <span class="strong">HP</span>
        <span saveas="final_hp_total"></span>
    </span>

    <span class="list">
        <span class="strong">Current</span>
        <span saveas="final_hp_current"></span>
    </span>

    <span class="list">
        <span class="strong">Non Lethal</span>
        <span saveas="health_nonlethal"></span>
    </span>
</div>
<div>
    <span class="strong">Fort</span>
    <span saveas="final_fort"></span>

    <span class="strong">Ref</span>
    <span saveas="final_ref"></span>

    <span class="strong">Will</span>
    <span saveas="final_will"></span>
</div>
<div>
    <span class="list">
        <span class="clear-if-empty">
            <span class="strong">Resist</span>
            <span saveas="damage_resistance"></span>
        </span>
    </span>
    <span class="list">
        <span saveas="other_resistance" class="comma-list"></span>
    </span>
    <span class="list">
        <span class="clear-if-empty">
            <span class="strong">SR</span>
            <span saveas="spell_resistance"></span>
        </span>
    </span>
</div>
<div class="header">
    offense
</div>
<div>
    <span class="list">
        <span class="strong">Speed</span>
        <span saveas="movement_speed"></span>ft
    </span>

    <span class="list">
        <span class="clear-if-empty">Base <span saveas="movement_base"></span>ft</span>
        <span class="clear-if-empty">Fly <span saveas="movement_fly"></span>ft</span>
        <span class="clear-if-empty">Swim <span saveas="movement_swim"></span>ft</span>
        <span class="clear-if-empty">Climb <span saveas="movement_climb"></span>ft</span>
        <span class="clear-if-empty">Misc <span saveas="movement_misc"></span>ft</span>
    </span>
</div>
<div class="entries" savetype="columns">
    <div>
        <span class="strong capitalize" saveas="weapon_attack_type"></span>
        <span saveas="weapon_name"></span>
        <span saveas="weapon_attack"></span>
        <span saveas="weapon_damage"></span>
        <span class="clear-if-empty">(<span saveas="weapon_critical"></span>)</span>
    </div>
</div>
<div class="entries" savetype="columns">
    <div>
        <span class="strong" saveas="casting_class"></span>
        <span class="strong">Spells</span>
        CL <span saveas="final_casting_class_level"></span>
        Concentration <span saveas="final_concentration"></span>
        <div data="spell-entry" class="indent">
            <span data="spell-level"></span>
            [<span data="spell-per-day"></span>]
            <span data="spell-dc"></span>
            <span data="spell-names">
                <span class="list"></span>
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
    statistics
</div>
<div>
    <? foreach(array("str", "dex", "con", "int", "wis", "cha") as $type) { ?>
    <span class="strong caps"><?=$type?></span>
    <span saveas="final_<?=$type?>_total"></span>
    <? } ?>
</div>
<div>
    <span class="strong">BAB</span>
    <span saveas="final_bab"></span>

    <span class="strong">CMB</span>
    <span saveas="final_cmb"></span>

    <span class="strong">CMD</span>
    <span saveas="final_cmd"></span>
</div>
<div>
    <span class="strong">Feats</span>
    <span class="entries" savetype="columns">
        <span saveas="feat_name" class="list"></span>
    </span>
</div>
<div>
    <span class="strong">Skills</span>
    <span class="entries" savetype="columns">
        <span class="list clear-if-empty">
            <span saveas="skill_name"></span>&nbsp;<span saveas="final_skill"></span>
        </span>
    </span>
</div>
<div>
    <span class="strong">Languages</span>
    <span saveas="known_languages" class="comma-list"></span>
</div>
<div>
    <span class="strong">Abilities</span>
    <span class="entries" savetype="columns">
        <span class="list">
            <span saveas="special_name"></span>
            <span class="clear-if-empty">(<span saveas="special_type" class="check-for-empty"></span>)</span>
        </span>
    </span>
</div>
<div>
    <span class="strong">Gear</span>
    <span class="entries list" savetype="columns">
        <span class="list clear-if-empty">
            <span saveas="gear_quantity_description"></span>&nbsp;x<span saveas="gear_quantity"></span>
        </span>
    </span>

    <span class="entries list" savetype="columns">
        <span class="list clear-if-empty">
            <span saveas="gear_uses_description"></span>&nbsp;*<span saveas="gear_uses"></span>
        </span>
    </span>
</div>
<div>
    <span class="list clear-if-empty">
        <span saveas="final_currency_carried"></span>g&nbsp;carried
    </span>
    <span class="list clear-if-empty">
        <span saveas="final_currency_stored"></span>g&nbsp;stored
    </span>
</div>
<div class="header">
    special abilities
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
    notes
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

        $('.comma-list').each(function() {
            var text = $(this).text().replace(/,/g, ', ');
            $(this).text(text);
        });

        // Spell list stuff oh my god why
        var classes = decodeToArray(data['casting_class']);
        var levels = decodeToArray(data['spell_list_level']);
        var spellNames = decodeToArray(data['spell_list_name']);
        var spellCasters = decodeToArray(data['spell_list_class_name']);
        var dcs = decodeToArray(data['spell_list_dc']);
        var mods = decodeToArray(data['casting_class_mod']);

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

                for(var i = 0; i < spellNames.length; i++) {
                    if (levels[i] == lv && spellCasters[i] == className) {
                        var newSpellName = spellName.clone();
                        newSpellName.text(spellNames[i]);
                        newSpellName.appendTo(spellNameContainer);
                    }
                }

                spellName.remove();
                if (spellNameContainer.children().length)
                    newRow.appendTo(container)
            }
            row.remove();
        });
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
