<div class="loading-overlay" id="loading-overlay">
    <div>
        <?=say('loading')?>
        <p></p>
    </div>
</div>
<div class="exporter">
    <div class="row">
        <div class="column">
            <h4><?=say('export_data')?></h4>
            <textarea id="export-data" onclick="select()" style="height: 20rem"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <input type="submit" value="<?=say('close')?>" onclick="closeOverlay(this)">
        </div>
    </div>
</div>

<div class="importer">
    <div class="row">
        <div class="column">
            <h4><?=say('import_data')?></h4>
            <textarea id="import-data" style="height: 20rem"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <input type="submit" value="<?=say('button_load')?>" onclick="loadImport(this)">
            <input type="submit" value="<?=say('button_close')?>" onclick="closeOverlay(this)">
        </div>
    </div>
</div>

<div class="toolbar">
    <div class="container">
        <div class="row">
            <div class="column column-5">
                <label>&nbsp;</label>
                <div class="dropdown">
                    <h4><a onclick="dropDown()"><span class="glyphicon glyphicon-menu-hamburger"></span></a></h4>
                    <div class="dropdown-content" id="dropdown"></div>
                </div>
            </div>
            <div class="column column-20">
                <label><?=say('sheet_name')?></label>
                <input type="text" saveas="sheetname" class="sheet">
            </div>
            <? if ($mode == "edit") { ?>
            <div class="column column-25">
                <label><a target="_blank" id="publicurl-link"><?=say('public_url')?></a> <a target="_blank" id="compact-link"><span class="glyphicon glyphicon-share-alt"></span></a></label>
                <input type="text" readonly="readonly" onclick="select()" id="publicurl">
            </div>
            <div class="column">
                <label><?=say('message')?></label>
                <span id="server-message"></span>
            </div>
            <? } else { ?>
            <div class="column column-25"></div>
            <div class="column"></div>
            <? } ?>

            <div class="column column-33" align="right">
                <label>&nbsp;</label>
                <? if ($mode == "edit") { ?>
                <input type="submit" value="<?=say('button_save')?>" onclick="save()">
                <input type="submit" value="<?=say('button_import')?>" onclick="sheetImport()">
                <? } else { ?>
                <input type="submit" value="<?=say('button_compact')?>" onclick="viewCompact()">
                <? } ?>
                <input type="submit" value="<?=say('button_export')?>" onclick="sheetExport()">
                <input type="submit" value="<?=say('button_home')?>" onclick="goTo('/')">
                <? if ($mode == "edit") { ?>
                <input type="submit" id="more-tools-button" value="+" onclick="revealTools()">
                <? } ?>
            </div>
        </div>
        <div class="row more-tools" id="more-tools" align="right">
            <div class="column">
                <input type="submit" value="<?=say('button_compact')?>" onclick="viewCompact()">
                <input type="submit" value="<?=say('button_clear')?>" onclick="clearTemp()">
                <input type="submit" value="<?=say('button_hide')?>" onclick="hideAll()">
                <input type="submit" value="<?=say('button_show')?>" onclick="showAll()">
                <input type="submit" value="<?=say('button_prep')?>" onclick="showPreppedSpells()">
                <input type="submit" value="<?=say('button_spells')?>" onclick="showAllSpells()">
            </div>
        </div>
    </div>
</div>

<div class="bottombar">
    <div class="container d20pfsrd">
        <div class="row">
            <div class="column column-66">
                <div class="selected-text">
                    <span class="glyphicon glyphicon-search"></span>&nbsp;<span id="search-text"></span>
                </div>
                <a class="strong" id="search-d20" target="pfsearch" href="http://www.d20pfsrd.com/">
                    <span class="glyphicon glyphicon-search"></span>
                    <?=say('d20pfsrd')?>
                </a>
                <a class="strong" id="search-prd" target="pfsearch" href="http://paizo.com/pathfinderRPG/prd/">
                    <span class="glyphicon glyphicon-search"></span>
                    <?=say('paizo_prd')?>
                </a>
            </div>
            <div class="column rolz">
                <a href="http://rolz.org" target="pfsearch">Rolz.org</a> <?=say('dice_roller')?>:
                <input type="text" style="width: 10rem;" id="rolz-input">
                <input type="submit" value="Roll" id="rolz">
                <span class="glyphicon glyphicon-arrow-right"></span>
                <span id="rolz-result"></span>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="column" id="navbar">
            </div>
        </div>
    </div>
</div>

<div class="toolbar-under"></div>

<div class="sidenav">
    <div class="sidenav-content" id="sidenav">
    </div>
</div>

<div class="quick-look">
    <div class="quick-look-content" id="quicklook">
        <div>
            <strong><?=say('ac')?></strong>
            <span ref="total-ac"></span>
        </div>
        <div>
            <strong><?=say('flat')?></strong>
            <span ref="flatfoot-ac"></span>
        </div>
        <div>
            <strong><?=say('touch')?></strong>
            <span ref="touch-ac"></span>
        </div>
        <hr/>
        <div>
            <strong><?=say('hp')?></strong>
            <span ref="final_hp_current"></span>
        </div>
        <hr/>
        <div>
            <strong><?=say('init')?></strong>
            <span ref="init-total"></span>
        </div>
        <hr/>
        <div>
            <strong><?=say('fort')?></strong>
            <span ref="final_fort"></span>
        </div>
        <div>
            <strong><?=say('ref')?></strong>
            <span ref="final_ref"></span>
        </div>
        <div>
            <strong><?=say('will')?></strong>
            <span ref="final_will"></span>
        </div>
        <hr/>
        <div>
            <strong><?=say('bab')?></strong>
            <span ref="final_bab"></span>
        </div>
        <div>
            <strong><?=say('melee')?></strong>
            <span ref="final_melee"></span>
        </div>
        <div>
            <strong><?=say('ranged')?></strong>
            <span ref="final_ranged"></span>
        </div>
        <hr/>
        <div>
            <strong><?=say('cmb')?></strong>
            <span ref="cmb-total"></span>
        </div>
        <div>
            <strong><?=say('cmd')?></strong>
            <span ref="cmd-total"></span>
        </div>
        <hr/>
        <div>
            <strong><?=say('str')?></strong>
            <span ref="str-total"></span> (<span ref="str-mod"></span>)
        </div>
        <div>
            <strong><?=say('dex')?></strong>
            <span ref="dex-total"></span> (<span ref="dex-mod"></span>)
        </div>
        <div>
            <strong><?=say('con')?></strong>
            <span ref="con-total"></span> (<span ref="con-mod"></span>)
        </div>
        <div>
            <strong><?=say('int')?></strong>
            <span ref="int-total"></span> (<span ref="int-mod"></span>)
        </div>
        <div>
            <strong><?=say('wis')?></strong>
            <span ref="wis-total"></span> (<span ref="wis-mod"></span>)
        </div>
        <div>
            <strong><?=say('cha')?></strong>
            <span ref="cha-total"></span> (<span ref="cha-mod"></span>)
        </div>
        <hr/>
        <div>
            <strong><?=say('load')?></strong>
            <span ref="weight-status"></span>
        </div>
        <div>
            <strong><?=say('weight')?></strong>
            <span ref="total-weight"></span>
        </div>
        <hr/>
        <div>
            <strong><?=say('coin')?></strong>
            <span ref="currency-grand-total"></span>
        </div>

    </div>
</div>
<div class="quick-look-again">
    <div id="skills-quick">
        <div class="entry">
            <strong></strong>
            <span></span>
        </div>
    </div>
</div>

<div class="container" id="sheet">
    <h1 onclick="toggleSection(this)" style="margin-top: 2rem"><span class="glyphicon glyphicon-user"></span> <?=say('character')?></h1>

    <section>
    <div class="row">
        <div class="column">
            <label><?=say('name')?></label>
            <input type="text" saveas="charname">
        </div>
        <div class="column">
            <label><?=say('player')?></label>
            <input type="text" saveas="playername">
        </div>
        <div class="column">
            <label><?=say('race')?></label>
            <input type="text" saveas="race">
        </div>
        <div class="column">
            <label><?=say('deity')?></label>
            <input type="text" saveas="deity">
        </div>
        <div class="column">
            <label><?=say('alignment')?></label>
            <select saveas="alignment" calc="alignment">
                <option value="ng"><?=say('alignment_ng')?></option>
                <option value="n" selected="selected"><?=say('alignment_n')?></option>
                <option value="ne"><?=say('alignment_ne')?></option>
                <option value="lg"><?=say('alignment_lg')?></option>
                <option value="ln"><?=say('alignment_ln')?></option>
                <option value="le"><?=say('alignment_le')?></option>
                <option value="cg"><?=say('alignment_cg')?></option>
                <option value="cn"><?=say('alignment_cn')?></option>
                <option value="ce"><?=say('alignment_ce')?></option>
            </select>
        </div>

    </div>

    <div class="row">
        <div class="column column-15">
            <label><?=say('homeland')?></label>
            <input type="text" saveas="homeland">
        </div>

        <div class="column column-15">
            <label><?=say('size')?></label>
            <select saveas="size" calc="size">
                <option value="fine" mod="8"><?=say('fine')?></option>
                <option value="diminutive" mod="4"><?=say('diminutive')?></option>
                <option value="tiny" mod="2"><?=say('tiny')?></option>
                <option value="small" mod="1"><?=say('small')?></option>
                <option value="medium" mod="0" selected="selected"><?=say('medium')?></option>
                <option value="large" mod="-1"><?=say('large')?></option>
                <option value="huge" mod="-2"><?=say('huge')?></option>
                <option value="gargantuan" mod="-4"><?=say('gargantuan')?></option>
                <option value="colossal" mod="-8"><?=say('colossal')?></option>
            </select>
            <input type="hidden" calc="size-mod">
            <input type="hidden" calc="size-mod-special">
        </div>

        <div class="column column-10">
            <label><?=say('gender')?></label>
            <input type="text" saveas="gender">
        </div>

        <div class="column column-10">
            <label><?=say('age')?></label>
            <input type="number" saveas="age">
        </div>

        <div class="column column-10">
            <label><?=say('weight')?></label>
            <input type="number" saveas="weight">
        </div>

        <div class="column column-10">
            <label><?=say('height')?></label>
            <input type="text" saveas="height">
        </div>

        <div class="column column-10">
            <label><?=say('hair')?></label>
            <input type="text" saveas="hair">
        </div>

        <div class="column column-10">
            <label><?=say('eyes')?></label>
            <input type="text" saveas="eyes">
        </div>

        <div class="column column-10">
            <label><?=say('skin')?></label>
            <input type="text" saveas="skin">
        </div>
    </div>

    <div class="row">
        <div class="column column-80">
            <label><?=say('languages')?></label>
            <input type="text" saveas="known_languages" id="language-tags">
        </div>
        <div class="column">
            <label><?=say('creature_type')?></label>
            <select saveas="creature_type">
                <option value="aberration"><?=say('aberration')?></option>
                <option value="animal"><?=say('animal')?></option>
                <option value="construct"><?=say('construct')?></option>
                <option value="dragon"><?=say('dragon')?></option>
                <option value="fey"><?=say('fey')?></option>
                <option value="humanoid" selected><?=say('humanoid')?></option>
                <option value="magical_beast"><?=say('magical_beast')?></option>
                <option value="monsterous_humanoid"><?=say('monsterous_humanoid')?></option>
                <option value="ooze"><?=say('ooze')?></option>
                <option value="outsider"><?=say('outsider')?></option>
                <option value="plant"><?=say('plant')?></option>
                <option value="undead"><?=say('undead')?></option>
                <option value="vermin"><?=say('vermin')?></option>
            </select>
        </div>
    </div>
    </section>

    <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-th-list"></span> <?=say('ability_scores')?></h1>

    <section id="ability-scores">
    <div class="row">
        <div class="column">
            <label><?=say('type')?></label>
        </div>
        <div class="column">
            <label><?=say('total')?></label>
        </div>
        <div class="column">
            <label><?=say('modifier')?></label>
        </div>
        <div class="column">
            <label><?=say('base')?></label>
        </div>
        <div class="column">
            <label><?=say('level')?></label>
        </div>
        <div class="column">
            <label><?=say('race')?></label>
        </div>
        <div class="column">
            <label><?=say('enhance')?></label>
        </div>
        <div class="column">
            <label><?=say('size')?></label>
        </div>
        <div class="column">
            <label><?=say('damage')?></label>
        </div>
        <div class="column">
            <label><?=say('drain')?></label>
        </div>
        <div class="column">
            <label><?=say('age')?></label>
        </div>
        <div class="column">
            <label><?=say('misc')?></label>
        </div>
        <div class="column">
            <label><?=say('temp')?></label>
        </div>
    </div>

    <? foreach(array("str", "dex", "con", "int", "wis", "cha") as $type) { ?>

    <div class="row" id="<?=$type?>">
        <div class="column">
            <h4><?=strtoupper(say($type))?></h4>
        </div>
        <div class="column">
            <h4 saveas="final_<?=$type?>_total" class="calc-result" calc="<?=$type?>-total">0</h4>
        </div>
        <div class="column">
            <h4 saveas="final_<?=$type?>_mod" class="calc-result" calc="<?=$type?>-mod">0</h4>
        </div>
        <div class="column">
            <input type="number" sum="<?=$type?>" saveas="<?=$type?>_base" calc="<?=$type?>-base">
        </div>
        <div class="column">
            <input type="number" sum="<?=$type?>" saveas="<?=$type?>_level">
        </div>
        <div class="column">
            <input type="number" sum="<?=$type?>" saveas="<?=$type?>_race">
        </div>
        <div class="column">
            <input type="number" sum="<?=$type?>" saveas="<?=$type?>_enhance">
        </div>
        <div class="column">
            <input type="number" sum="<?=$type?>" saveas="<?=$type?>_size">
        </div>
        <div class="column">
            <input type="number" sum="<?=$type?>" saveas="<?=$type?>_damage" calctype="subtract">
        </div>
        <div class="column">
            <input type="number" sum="<?=$type?>" saveas="<?=$type?>_drain" calctype="subtract">
        </div>
        <div class="column">
            <input type="number" sum="<?=$type?>" saveas="<?=$type?>_age">
        </div>
        <div class="column">
            <input type="number" sum="<?=$type?>" saveas="<?=$type?>_misc">
        </div>
        <div class="column">
            <input type="number" sum="<?=$type?>" saveas="<?=$type?>_temp" temp>
        </div>
    </div>
    <? } ?>

    <div class="row">
        <div class="column column-10">
            <label><?=say('point_max')?></label>
            <input type="number" saveas="point_maximum" calc="point-max" id="points-max"/>
        </div>
        <div class="column column-15">
            <label><?=say('fantasy')?></label>
            <h4 calc="fantasy-type">CUSTOM</h4>
        </div>
        <div class="column">
            <label><?=say('points')?></label>
            <h4 calc="point-total" class="strong"></h4>
        </div>
        <div class="column">&nbsp;</div>
        <div class="column">&nbsp;</div>
        <div class="column">&nbsp;</div>
        <? foreach(array("str", "dex", "con", "int", "wis", "cha") as $type) { ?>
        <div class="column">
            <label><?=strtoupper(say($type))?></label>
            <h4 calc="<?=$type?>-points">0</h4>
        </div>
        <? } ?>
    </div>
    </section>

    <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-knight"></span> <?=say('class')?></h1>

    <section>
    <div class="row" calc="classes-total">
        <div class="column column-20">
            <label><?=say('favored_class')?></label>
            <select saveas="favored_class" calc="favored-class"></select>
        </div>
        <div class="column">
            <label><?=say('levels')?></label>
            <h4 class="calc-result" calc="levels">0</h4>
        </div>
        <div class="column">
            <label><?=say('bab')?></label>
            <h4 saveas="final_bab" class="calc-result" calc="bab">0</h4>
        </div>
        <div class="column">
            <label><?=say('skill')?></label>
            <h4 class="calc-result" calc="skill">0</h4>
        </div>
        <div class="column">
            <label><?=say('hp_bonus')?></label>
            <h4 class="calc-result" calc="hpbonus">0</h4>
        </div>
        <div class="column">
            <label><?=say('fortitude')?></label>
            <h4 class="calc-result" calc="fortitude">0</h4>
        </div>
        <div class="column">
            <label><?=say('reflex')?></label>
            <h4 class="calc-result" calc="reflex">0</h4>
        </div>
        <div class="column">
            <label><?=say('will')?></label>
            <h4 class="calc-result" calc="will">0</h4>
        </div>
        <div class="column column-10"></div>
    </div>

    <div class="row">
        <div class="column">
            <label><?=say('class_name')?></label>
        </div>
    </div>

    <div id="classes" class="entries" savetype="columns">
        <div>
            <div class="row">
                <div class="column column-20">
                    <input type="text" saveas="class_name" calc="class-name">
                </div>
                <div class="column">
                    <input type="number" calc="levels" saveas="class_levels">
                </div>
                <div class="column">
                    <input type="number" calc="bab" saveas="class_bab">
                </div>
                <div class="column">
                    <input type="number" calc="skill" saveas="class_skill">
                </div>
                <div class="column">
                    <input type="number" calc="hpbonus" saveas="class_hpbonus">
                </div>
                <div class="column">
                    <input type="number" calc="fortitude" saveas="class_fortitude">
                </div>
                <div class="column">
                    <input type="number" calc="reflex" saveas="class_reflex">
                </div>
                <div class="column">
                    <input type="number" calc="will" saveas="class_will">
                </div>
                <div class="column column-10" align="right">
                    <input type="submit" value="+" onclick="revealMore(this)">
                    <? if ($mode == "edit") { ?>
                    <input type="submit" value="X" onclick="deleteRow(this)">
                    <? } ?>
                </div>
            </div>
            <div class="row reveal">
                <div class="column column-20">
                    <label><?=say('reference_url')?></label>
                    <input type="url" saveas="class_url" onclick="select()">
                </div>
                <div class="column">
                    <label><?=say('additional_notes')?></label>
                    <textarea saveas="class_notes"></textarea>
                </div>
            </div>
        </div>
    </div>

    <? if ($mode == "edit") { ?>
    <div class="row">
        <div class="column">
            <input type="submit" value="<?=say('button_add')?>" onclick="addRow(this)">
        </div>
    </div>
    <? } ?>
    </section>

    <div class="row">
        <div class="column column-50">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-education"></span> <?=say('skills')?></h1>


            <section>
            <div class="row" calc="skills">
                <div class="column">
                    <label><?=say('total_skill')?></label>
                    <h4 ref="skill">0</h4>
                </div>
                <div class="column">
                    <label><?=say('used_skill')?></label>
                    <h4 calc="skill-used">0</h4>
                </div>
                <div class="column">
                    <label><?=say('armor_check_penalty')?></label>
                    <h4 ref="penalty-total">0</h4>
                </div>
            </div>

            <div class="row">
                <div class="column column-30">
                    <label><?=say('type')?></label>
                </div>
                <div class="column">
                    <label><?=say('total')?></label>
                </div>
                <div class="column">
                    <label><?=say('ability')?></label>
                </div>
                <div class="column">
                </div>
                <div class="column">
                    <label><?=say('train')?></label>
                </div>
                <div class="column">
                    <label><?=say('ranks')?></label>
                </div>
                <div class="column">
                    <label><?=say('misc')?></label>
                </div>
            </div>

            <div class="entries" savetype="columns">
                <?
                $needs_train = array(
                    "Disable Device", "Handle Animal", "Linguistics",
                    "Sleight of Hand", "Spellcraft", "Use Magic Device"
                );
                $skills = array(
                    "Acrobatics *", "Appraise *", "Bluff *", "Climb *", "Diplomacy *",
                    "Disable Device", "Disguise *", "Escape Artist *", "Fly *",
                    "Handle Animal", "Heal *", "Intimidate *", "Linguistics",
                    "Perception *", "Ride *", "Sense Motive *", "Sleight of Hand",
                    "Spellcraft", "Stealth *", "Survival *", "Swim *", "Use Magic Device"
                );
                $skills_lang = array(
                    "acrobatics", "appraise", "bluff", "climb", "diplomacy", "disable_device",
                    "disguise", "escape_artist", "fly", "handle_animal", "heal", "intimidate",
                    "linguistics", "perception", "ride", "sense_motive", "sleight_of_hand",
                    "spellcraft", "stealth", "survival", "swim", "use_magic_device"
                );
                $abilities = array(
                    "dex", "int", "cha", "str", "cha", "dex", "cha", "dex",
                    "dex", "cha", "wis", "cha", "int", "wis", "dex", "wis",
                    "dex", "int", "dex", "wis", "str", "cha"
                );
                foreach($skills as $index=>$skill) {
                    $skill_needs_train = in_array($skill, $needs_train);
                ?>
                <div class="row skills" calc="skills" train="<?=$skill_needs_train?>">
                    <div class="column column-30">
                        <span calc="skill-name" saveas="skill_name" load="no"><?=say($skills_lang[$index])?></span>
                    </div>
                    <div class="column">
                        <span calc="skill-total" class="calc-result" saveas="final_skill">0</span>
                    </div>
                    <div class="column">
                        <span calc="skill-type" saveas="skill_ability" load="no"><?=strtoupper(say($abilities[$index]))?></span>
                    </div>
                    <div class="column">
                        <span sum="skill" ref="<?=$abilities[$index]?>-mod">0</span>
                    </div>
                    <div class="column">
                        <input calc="skill-trained" type="checkbox" saveas="skill_trained">
                        <span sum="skill" calc="skill-trained-points">0</span>
                    </div>
                    <div class="column">
                        <input sum="skill" calc="skill-ranks" type="number" saveas="skill_ranks">
                    </div>
                    <div class="column">
                        <input sum="skill" type="number" saveas="skill_misc">
                    </div>
                </div>
                <? } ?>

                <div class="row skills" calc="skills">
                    <div class="column column-30">
                        <input type="text" saveas="skill_name" onchange="deleteRowIfEmpty(this)">
                    </div>
                    <div class="column">
                        <span calc="skill-total" class="calc-result" saveas="final_skill">0</span>
                    </div>
                    <div class="column">
                        <select calc="skill-type" saveas="skill_ability">
                            <option value="str"><?=say('str')?></option>
                            <option value="dex"><?=say('dex')?></option>
                            <option value="con"><?=say('con')?></option>
                            <option value="int" selected="selected"><?=say('int')?></option>
                            <option value="wis"><?=say('wis')?></option>
                            <option value="cha"><?=say('cha')?></option>
                        </select>
                    </div>
                    <div class="column">
                        <span calc="skill-type-ability" sum="skill">0</span>
                    </div>
                    <div class="column">
                        <input calc="skill-trained" type="checkbox" saveas="skill_trained">
                        <span sum="skill" calc="skill-trained-points">0</span>
                    </div>
                    <div class="column">
                        <input sum="skill" calc="skill-ranks" type="number" saveas="skill_ranks">
                    </div>
                    <div class="column">
                        <input sum="skill" type="number" saveas="skill_misc">
                    </div>
                </div>
            </div>

            <? if ($mode == "edit") { ?>
            <div class="row">
                <div class="column">
                    <input type="submit" value="<?=say('button_add')?>" onclick="addRow(this)">
                </div>
            </div>
            <? } ?>
            </section>
        </div>

        <div class="column column-50">
            <div class="row">
                <div class="column">
                    <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-star"></span> <?=say('feats')?></h1>

                    <section>
                    <div class="row">
                        <div class="column column-40">
                            <label><?=say('feat')?></label>
                        </div>
                        <div class="column column-40">
                            <label><?=say('notes')?></label>
                        </div>
                        <div class="column column-20">
                            <label>&nbsp;</label>
                        </div>
                    </div>

                    <div class="entries" savetype="columns">
                        <div>
                            <div class="row">
                                <div class="column column-40">
                                    <input type="text" saveas="feat_name">
                                </div>
                                <div class="column column-40">
                                    <input type="text" saveas="feat_notes">
                                </div>
                                <div class="column column-20" align="right">
                                    <input type="submit" value="+" onclick="revealMore(this)">
                                    <? if ($mode == "edit") { ?>
                                    <input type="submit" value="X" onclick="deleteRow(this)">
                                    <? } ?>
                                </div>
                            </div>
                            <div class="row reveal">
                                <div class="column column-40">
                                    <label><?=say('reference_url')?></label>
                                    <input type="url" saveas="feat_url" onclick="select()">
                                </div>
                                <div class="column">
                                    <label><?=say('additional_notes')?></label>
                                    <textarea saveas="feat_more_notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <? if ($mode == "edit") { ?>
                    <div class="row">
                        <div class="column">
                            <input type="submit" value="<?=say('button_add')?>" onclick="addRow(this)">
                        </div>
                    </div>
                    <? } ?>
                    </section>

                    <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-star-empty"></span> <?=say('special_abilities')?></h1>

                    <section>
                    <div class="row">
                        <div class="column column-33">
                            <label><?=say('ability')?></label>
                        </div>
                        <div class="column">
                            <label><?=say('type')?></label>
                        </div>
                        <div class="column">
                            <label><?=say('uses')?></label>
                        </div>
                        <div class="column">
                            <label><?=say('used')?></label>
                        </div>
                        <div class="column column-20">
                            <label>&nbsp;</label>
                        </div>
                    </div>

                    <div class="entries" savetype="columns">
                        <div>
                            <div class="row">
                                <div class="column column-33">
                                    <input type="text" saveas="special_name">
                                </div>
                                <div class="column">
                                    <select saveas="special_type">
                                        <option value=" "> </option>
                                        <option value="Su"><?=say('supernatural')?></option>
                                        <option value="Sp"><?=say('spell_like')?></option>
                                        <option value="Ex"><?=say('extraordinary')?></option>
                                    </select>
                                </div>
                                <div class="column">
                                    <input type="number" saveas="special_uses">
                                </div>
                                <div class="column">
                                    <input type="number" saveas="special_used">
                                </div>
                                <div class="column column-20" align="right">
                                    <input type="submit" value="+" onclick="revealMore(this)">
                                    <? if ($mode == "edit") { ?>
                                    <input type="submit" value="X" onclick="deleteRow(this)">
                                    <? } ?>
                                </div>
                            </div>
                            <div class="row reveal">
                                <div class="column column-33">
                                    <label><?=say('reference_url')?></label>
                                    <input type="url" saveas="special_url">
                                </div>
                                <div class="column">
                                    <label><?=say('additional_notes')?></label>
                                    <textarea saveas="special_notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <? if ($mode == "edit") { ?>
                    <div class="row">
                        <div class="column">
                            <input type="submit" value="<?=say('button_add')?>" onclick="addRow(this)">
                        </div>
                    </div>
                    <? } ?>
                    </section>

                </div>
            </div>
        </div>
    </div>

    <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-heart"></span> <?=say('health')?></h1>

    <section>
    <div class="row" id="health">
        <input type="hidden" ref="con-total">
        <div class="column column-10">
            <label><?=say('total')?></label>
            <h4 class="calc-result" calc="result-total" saveas="final_hp_total">0</h4>
        </div>
        <div class="column column-10">
            <label><?=say('current')?></label>
            <h4 class="calc-result" calc="current" saveas="final_hp_current">0</h4>
        </div>
        <div class="column column-20">
            <label><?=say('status')?></label>
            <h4 calc="status"></h4>
        </div>
        <div class="column column-10">
            <label><?=say('base')?></label>
            <input type="number" calc="total" saveas="health_base">
        </div>
        <div class="column column-10">
            <label><?=say('temp')?></label>
            <input type="number" calc="total" saveas="health_temp" temp id="health-temp">
        </div>
        <div class="column column-10">
            <label><?=say('misc')?></label>
            <input type="number" calc="total" saveas="health_misc">
        </div>
        <div class="column column-10">
            <label><?=say('class')?></label>
            <h4 ref="hpbonus" calc="total">0</h4>
        </div>
        <div class="column column-10" calc="lethal">
            <label><?=say('lethal')?></label>
            <input type="number" calctype="subtract" saveas="health_lethal" id="health-lethal">
        </div>
        <div class="column column-10" calc="nonlethal">
            <label><?=say('nonlethal')?></label>
            <input type="number" saveas="health_nonlethal" id="health-nonlethal">
        </div>
    </div>

    <div class="row">
        <div class="column column-40">
            <label><?=say('health_bar')?></label>
            <div class="health-bar bar-container">
                <div class="bar ko" calc="healthbar-ko"></div><div class="bar health" calc="healthbar-hp"></div>
            </div>
        </div>
        <div class="column column-40">
            <label><?=say('conditions')?></label>
            <input type="text" id="conditions-tags" saveas="health_conditions">
        </div>
        <div class="column column-10">
            <label><?=say('damage')?></label>
            <input type="number" id="damage-lethal">
        </div>
        <div class="column column-10">
            <label><?=say('damage')?></label>
            <input type="number" id="damage-nonlethal">
        </div>
    </div>
    </section>

    <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-tower"></span> <?=say('armor')?></h1>

    <section>
    <div class="row" calc="armor-class">
        <input type="hidden" ref="dex-mod"> <!-- So armor updates when dex mod changes -->
        <div class="column">
            <label><?=say('total_ac')?></label>
            <h4 class="calc-result" calc="total-ac" saveas="final_ac">0</h4>
        </div>
        <div class="column">
            <label><?=say('touch')?></label>
            <h4 class="calc-result" calc="touch-ac" saveas="final_touch">10</h4>
        </div>
        <div class="column">
            <label><?=say('flat_foot')?></label>
            <h4 class="calc-result" calc="flatfoot-ac" saveas="final_flatfoot">10</h4>
        </div>
        <div class="column">
            <label><?=say('armor')?></label>
            <h4 sum="armor-total" calc="armor-gear" saveas="final_armor">0</h4>
        </div>
        <div class="column">
            <label><?=say('shield')?></label>
            <h4 sum="armor-total" calc="shield-gear" saveas="final_shield">0</h4>
        </div>
        <div class="column">
            <label><?=say('dex')?></label>
            <h4 sum="armor-total" calc="max-dex-bonus" saveas="final_dex_armor">0</h4>
        </div>
        <div class="column">
            <label><?=say('size')?></label>
            <h4 sum="armor-total" ref="size-mod" saveas="final_size_armor">0</h4>
        </div>
        <div class="column">
            <label><?=say('dodge')?></label>
            <input type="number" calc="armor-dodge" sum="armor-total" saveas="armor_dodge">
        </div>
        <div class="column">
            <label><?=say('natural')?></label>
            <input type="number" sum="armor-total" saveas="armor_natural">
        </div>
        <div class="column">
            <label><?=say('deflect')?></label>
            <input type="number" calc="armor-deflect" sum="armor-total" saveas="armor_deflect">
        </div>
        <div class="column">
            <label><?=say('misc')?></label>
            <input type="number" sum="armor-total" saveas="armor_misc">
        </div>
        <div class="column">
            <label><?=say('temp')?></label>
            <input type="number" sum="armor-total" saveas="armor_temp" temp>
        </div>
    </div>

    <? foreach(array("armor", "shield") as $armor) { ?>
    <div class="row" calc="armor-class">
        <div class="column">
            <label><?=say($armor)?></label>
            <input type="text" saveas="<?=$armor?>_name">
        </div>
        <div class="column column-10">
            <label><?=say('ac_bonus')?></label>
            <input type="number" calc="<?=$armor?>-ac-bonus" saveas="armor_<?=$armor?>_ac">
        </div>
        <div class="column column-10">
            <label><?=say('enhance')?></label>
            <input type="number" calc="<?=$armor?>-enhance-bonus" saveas="armor_<?=$armor?>_enhance">
        </div>
        <div class="column column-10">
            <label><?=say('max_dex')?></label>
            <input type="number" calc="<?=$armor?>-max-dex" saveas="armor_<?=$armor?>_max_dex">
        </div>
        <div class="column column-10">
            <label><?=say('penalty')?></label>
            <input type="number" sum="armor-penalty" calctype="subtract" saveas="armor_<?=$armor?>_penalty">
        </div>
        <div class="column column-10">
            <label><?=say('spell_fail')?></label>
            <input type="number" sum="spell-chance" saveas="armor_<?=$armor?>_spellfail">
        </div>
        <div class="column column-10">
            <label><?=say('type')?></label>
            <input type="text" saveas="armor_<?=$armor?>_type">
        </div>
        <div class="column column-10">
            <label><?=say('weight')?></label>
            <input type="number" saveas="armor_<?=$armor?>_weight" weight step="0.5">
        </div>
    </div>
    <? } ?>

    <div class="row">
        <div class="column column-10">
            <label><?=say('penalty')?></label>
            <h4 ref="penalty-total">0</h4>
            <input type="hidden" calc="penalty-total">
        </div>
        <div class="column column-10">
            <label><?=say('max_dex')?></label>
            <h4 calc="max-dex-total">0</h4>
        </div>
        <div class="column column-10">
            <label><?=say('spell_fail')?></label>
            <h4 calc="spell-fail-total">0%</h4>
        </div>
        <div class="column column-10" calc="armor-class">
            <label><?=say('dex_mod')?></label>
            <select saveas="armor_dex_override" calc="armor-dex-override">
                <option value="str"><?=say('str')?></option>
                <option value="dex" selected="selected"><?=say('dex')?></option>
                <option value="con"><?=say('con')?></option>
                <option value="int"><?=say('int')?></option>
                <option value="wis"><?=say('wis')?></option>
                <option value="cha"><?=say('cha')?></option>
            </select>
        </div>
        <div class="column">
            <label><?=say('notes')?></label>
            <input type="text" saveas="armor_notes">
        </div>
    </div>
    </section>

    <div class="row">
        <div class="column">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-flash"></span> <?=say('saves')?></h1>

            <section>
            <div class="row">
                <div class="column column-15">
                    <label><?=say('type')?></label>
                </div>
                <div class="column">
                    <label><?=say('total')?></label>
                </div>
                <div class="column">
                    <label><?=say('class')?></label>
                </div>
                <div class="column">
                    <label><?=say('ability')?></label>
                </div>
                <div class="column">
                    <label><?=say('enhance')?></label>
                </div>
                <div class="column">
                    <label><?=say('misc')?></label>
                </div>
                <div class="column">
                    <label><?=say('temp')?></label>
                </div>
            </div>

            <?
            $abilities = array("con", "dex", "wis");
            $saves = array("fortitude", "reflex", "will");
            foreach(array("fort", "ref", "will") as $index=>$save) {
            ?>
            <div class="row" calc="saves">
                <input type="hidden" value="<?=$save?>" calc="save-type">
                <div class="column column-15">
                    <h4><?=strtoupper(say($save))?></h4>
                </div>
                <div class="column">
                    <h4 class="calc-result" calc="save-total" saveas="final_<?=$save?>">0</h4>
                </div>
                <div class="column">
                    <h4 sum="save" ref="<?=$saves[$index]?>">0</h4>
                </div>
                <div class="column">
                    <h4 sum="save" calc="save-ability">0</h4>
                </div>
                <div class="column">
                    <input sum="save" type="number" saveas="<?=$save?>_enhance">
                </div>
                <div class="column">
                    <input sum="save" type="number" saveas="<?=$save?>_misc">
                </div>
                <div class="column">
                    <input sum="save" type="number" saveas="<?=$save?>_temp" temp>
                </div>
            </div>
            <? } ?>

            <div class="row" calc="saves-more">
                <div class="column column">
                    <label><?=say('fort')?></label>
                    <select calc="fort-type" saveas="fort_ability">
                        <option value="str"><?=say('str')?></option>
                        <option value="dex"><?=say('dex')?></option>
                        <option value="con" selected="selected"><?=say('con')?></option>
                        <option value="int"><?=say('int')?></option>
                        <option value="wis"><?=say('wis')?></option>
                        <option value="cha"><?=say('cha')?></option>
                    </select>
                </div>
                <div class="column column">
                    <label><?=say('ref')?></label>
                    <select calc="ref-type" saveas="ref_ability">
                        <option value="str"><?=say('str')?></option>
                        <option value="dex" selected="selected"><?=say('dex')?></option>
                        <option value="con"><?=say('con')?></option>
                        <option value="int"><?=say('int')?></option>
                        <option value="wis"><?=say('wis')?></option>
                        <option value="cha"><?=say('cha')?></option>
                    </select>
                </div>
                <div class="column column">
                    <label><?=say('will')?></label>
                    <select calc="will-type" saveas="will_ability">
                        <option value="str"><?=say('str')?></option>
                        <option value="dex"><?=say('dex')?></option>
                        <option value="con"><?=say('con')?></option>
                        <option value="int"><?=say('int')?></option>
                        <option value="wis" selected="selected"><?=say('wis')?></option>
                        <option value="cha"><?=say('cha')?></option>
                    </select>
                </div>
                <div class="column column-50">
                    <label><?=say('notes')?></label>
                    <input type="text" saveas="save_notes">
                </div>
            </div>
            </section>
        </div>

        <div class="column">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-heart-empty"></span> <?=say('resistance')?></h1>

            <section>
            <div class="row">
                <div class="column column-20">
                    <label><?=say('spell_resist')?></label>
                    <input type="number" saveas="spell_resistance">
                </div>
                <div class="column">
                    <label><?=say('damage_resist')?></label>
                    <input type="text" saveas="damage_resistance">
                </div>
            </div>

            <div class="row" style="height: 0.925rem"></div> <!-- purely to line up with the rows in saves lol -->

            <div class="row">
                <div class="column">
                    <label><?=say('other_resist')?></label>
                    <input type="text" id="resistance-tags" saveas="other_resistance">
                </div>
            </div>

            <div class="row" style="height: 0.925rem"></div> <!-- purely to line up with the rows in saves lol -->

            <div class="row">
                <div class="column">
                    <label><?=say('notes')?></label>
                    <input type="text" saveas="resistance_notes">
                </div>
            </div>
            </section>
        </div>
    </div>

    <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-scissors"></span> <?=say('weapons')?></h1>

    <section>
    <div class="row">
        <div class="column column-20">
            <label><?=say('weapon_name')?></label>
        </div>
        <div class="column column-15">
            <label><?=say('attack')?></label>
        </div>
        <div class="column column-15">
            <label><?=say('damage')?></label>
        </div>
        <div class="column">
            <label><?=say('critical')?></label>
        </div>
        <div class="column">
            <label><?=say('range')?></label>
        </div>
        <div class="column">
            <label><?=say('type')?></label>
        </div>
        <div class="column">
            <label><?=say('quantity')?></label>
        </div>
        <div class="column">
            <label><?=say('weight')?></label>
        </div>
        <div class="column column-10">
            &nbsp;
        </div>
    </div>

    <div class="entries" savetype="columns">
        <div>
            <div class="row">
                <div class="column column-20">
                    <input type="text" class="strong" saveas="weapon_name">
                </div>
                <div class="column column-15">
                    <input type="text" saveas="weapon_attack">
                </div>
                <div class="column column-15">
                    <input type="text" saveas="weapon_damage">
                </div>
                <div class="column">
                    <input type="text" saveas="weapon_critical">
                </div>
                <div class="column">
                    <input type="number" saveas="weapon_range">
                </div>
                <div class="column">
                    <input type="text" saveas="weapon_type">
                </div>
                <div class="column">
                    <input type="number" saveas="weapon_quantity" quantity>
                </div>
                <div class="column">
                    <input type="number" saveas="weapon_weight" weight step="0.5">
                </div>
                <div class="column column-10" align="right">
                    <input type="submit" value="+" onclick="revealMore(this)">
                    <? if ($mode == "edit") { ?>
                    <input type="submit" value="X" onclick="deleteRow(this)">
                    <? } ?>
                </div>
            </div>
            <div class="row reveal">
                <div class="column column-20">
                    <label><?=say('reference_url')?></label>
                    <input type="url" saveas="weapon_ref" onclick="select()">

                    <label><?=say('attack_type')?></label>
                    <select saveas="weapon_attack_type">
                        <option value="melee"><?=say('melee')?></option>
                        <option value="ranged"><?=say('ranged')?></option>
                        <option value="other"><?=say('other')?></option>
                    </select>
                </div>
                <div class="column">
                    <label><?=say('additional_notes')?></label>
                    <textarea saveas="weapon_notes"></textarea>
                </div>
            </div>
        </div>
    </div>

    <? if ($mode == "edit") { ?>
    <div class="row">
        <div class="column">
            <input type="submit" value="<?=say('button_add')?>" onclick="addRow(this)">
        </div>
    </div>
    <? } ?>
    </section>

    <div class="row">
        <div class="column column-50">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-warning-sign"></span> <?=say('attacks')?></h1>

            <section>
            <?
            $type = array("str", "dex");
            foreach(array("melee", "ranged") as $index=>$attack) {
            ?>
            <div class="row" calc="attacks">
                <div class="column column-15">
                    <label><?=say($attack)?></label>
                    <h4 class="calc-result" calc="<?=$attack?>-total" saveas="final_<?=$attack?>">0</h4>
                </div>
                <div class="column">
                    <label><?=say('bab')?></label>
                    <h4 sum="attack-<?=$attack?>" ref="bab">0</h4>
                </div>
                <div class="column">
                    <label><?=say('ability')?></label>
                    <h4 sum="attack-<?=$attack?>" calc="<?=$attack?>-ability">0</h4>
                </div>
                <div class="column column-20">
                    <label><?=say('type')?></label>
                    <select calc="<?=$attack?>-type" saveas="<?=$attack?>_ability">
                        <option value="str"<? if ($type[$index] == "str") { ?> selected="selected"<? } ?>><?=say('str')?></option>
                        <option value="dex"<? if ($type[$index] == "dex") { ?> selected="selected"<? } ?>><?=say('dex')?></option>
                        <option value="con"><?=say('con')?></option>
                        <option value="int"><?=say('int')?></option>
                        <option value="wis"><?=say('wis')?></option>
                        <option value="cha"><?=say('cha')?></option>
                    </select>
                </div>
                <div class="column column-10">
                    <label><?=say('size')?></label>
                    <h4 sum="attack-<?=$attack?>" ref="size-mod" calc="attack">0</h4>
                </div>
                <div class="column">
                    <label><?=say('temp')?></label>
                    <input sum="attack-<?=$attack?>" type="number" calc="attack" saveas="attack_<?=$attack?>_temp" temp>
                </div>
                <div class="column">
                    <label><?=say('misc')?></label>
                    <input sum="attack-<?=$attack?>" type="number" calc="attack" saveas="attack_<?=$attack?>_misc">
                </div>
            </div>
            <? } ?>
            </section>

        </div>
        <div class="column column-50">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-record"></span> <?=say('maneuvers')?></h1>

            <section>
            <div class="row" calc="maneuvers">
                <div class="column column-20">
                    <label><?=say('cmb')?></label>
                    <h4 class="calc-result" calc="cmb-total" saveas="final_cmb">0</h4>
                </div>
                <div class="column">
                    <label><?=say('bab')?></label>
                    <h4 ref="bab" sum="cmb">0</h4>
                </div>
                <div class="column">
                    <label><?=say('ability')?></label>
                    <h4 sum="cmb" calc="cmb-ability">0</h4>
                </div>
                <div class="column column-20">
                    <label><?=say('type')?></label>
                    <select calc="cmb-type" saveas="cmb_ability">
                        <option value="str" selected="selected"><?=say('str')?></option>
                        <option value="dex"><?=say('dex')?></option>
                        <option value="con"><?=say('con')?></option>
                        <option value="int"><?=say('int')?></option>
                        <option value="wis"><?=say('wis')?></option>
                        <option value="cha"><?=say('cha')?></option>
                    </select>
                </div>
                <div class="column">
                    <label><?=say('size')?></label>
                    <h4 ref="size-mod" sum="cmb">0</h4>
                </div>
                <div class="column">
                    <label><?=say('misc')?></label>
                    <input type="number" sum="cmb" saveas="cmb_misc">
                </div>
            </div>

            <div class="row cmd" calc="maneuvers">
                <div class="column column-20">
                    <label><?=say('cmd')?></label>
                    <h4 class="calc-result" calc="cmd-total" saveas="final_cmd">0</h4>
                </div>
                <div class="column">
                    <label><?=say('bab')?></label>
                    <h4 sum="cmd" ref="bab">0</h4>
                </div>
                <div class="column">
                    <label><?=say('dodge')?></label>
                    <h4 sum="cmd" ref="armor-dodge">0</h4>
                </div>
                <div class="column">
                    <label><?=say('deflect')?></label>
                    <h4 sum="cmd" ref="armor-deflect">0</h4>
                </div>
                <div class="column">
                    <label><?=say('str')?></label>
                    <h4 sum="cmd" ref="str-mod">0</h4>
                </div>
                <div class="column">
                    <label><?=say('dex')?></label>
                    <h4 sum="cmd" ref="dex-mod">0</h4>
                </div>
                <div class="column">
                    <label><?=say('size')?></label>
                    <h4 sum="cmd" ref="size-mod-special">0</h4>
                </div>
                <div class="column">
                    <label><?=say('misc')?></label>
                    <input sum="cmd" type="number" saveas="cmd_misc">
                </div>
            </div>
            </section>

        </div>
    </div>

    <div class="row">
        <div class="column column-50">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-alert"></span> <?=say('initiative')?></h1>

            <section>
            <div class="row" calc="initiative">
                <div class="column column-20">
                    <label><?=say('initiative')?></label>
                    <h4 class="calc-result" calc="init-total" saveas="final_init">0</h4>
                </div>
                <div class="column column-20">
                    <label><?=say('ability')?></label>
                    <h4 calc="init-mod" sum="init">0</h4>
                </div>
                <div class="column column-20">
                    <label><?=say('misc')?></label>
                    <input sum="init" type="number" saveas="init_misc">
                </div>
                <div class="column column-20">
                    <label><?=say('temp')?></label>
                    <input sum="init" type="number" saveas="init_temp" temp>
                </div>
                <div class="column column-20">
                    <label><?=say('type')?></label>
                    <select calc="init-type" saveas="init_ability">
                        <option value="str"><?=say('str')?></option>
                        <option value="dex" selected="selected"><?=say('dex')?></option>
                        <option value="con"><?=say('con')?></option>
                        <option value="int"><?=say('int')?></option>
                        <option value="wis"><?=say('wis')?></option>
                        <option value="cha"><?=say('cha')?></option>
                    </select>
                </div>
            </div>
            </section>
        </div>

        <div class="column column-50">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-dashboard"></span> <?=say('movement')?></h1>

            <section>
            <div class="row">
                <div class="column">
                    <label><?=say('speed')?></label>
                    <input type="number" saveas="movement_speed">
                </div>
                <div class="column">
                    <label><?=say('base')?></label>
                    <input type="number" saveas="movement_base">
                </div>
                <div class="column">
                    <label><?=say('fly')?></label>
                    <input type="number" saveas="movement_fly">
                </div>
                <div class="column">
                    <label><?=say('swim')?></label>
                    <input type="number" saveas="movement_swim">
                </div>
                <div class="column">
                    <label><?=say('climb')?></label>
                    <input type="number" saveas="movement_climb">
                </div>
                <div class="column">
                    <label><?=say('misc')?></label>
                    <input type="number" saveas="movement_misc">
                </div>
            </div>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="column column-50">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-bookmark"></span> <?=say('experience')?></h1>

            <section>
            <div class="row" id="experience">
                <div class="column column-33">
                    <label><?=say('rate')?></label>
                    <select saveas="experience_rate">
                        <option value="slow"><?=say('slow')?></option>
                        <option value="medium"><?=say('medium')?></option>
                        <option value="fast"><?=say('fast')?></option>
                    </select>
                </div>
                <div class="column">
                    <label><?=say('points')?></label>
                    <input type="number" calc="experience-points" saveas="experience_points">
                </div>
                <div class="column">
                    <label><?=say('previous_goal')?></label>
                    <input type="number" calc="experience-prev-goal" saveas="experience_prev_goal">
                </div>
                <div class="column">
                    <label><?=say('next_goal')?></label>
                    <input type="number" calc="experience-goal" saveas="experience_goal">
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <div class="experience-bar bar-container">
                        <div class="bar experience" calc="experience-progress"></div>
                    </div>
                </div>
            </div>
            </section>
        </div>

        <div class="column column-50">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-tasks"></span> <?=say('pool_points')?></h1>

            <section>
            <div class="row">
                <div class="column column-33">
                    <label><?=say('type')?></label>
                </div>
                <div class="column">
                    <label><?=say('remaining')?></label>
                </div>
                <div class="column">
                    <label><?=say('used')?></label>
                </div>
                <div class="column">
                    <label><?=say('total')?></label>
                </div>
                <div class="column column-10">
                </div>
            </div>

            <div id="pool-points" class="entries" savetype="columns">
                <div class="row">
                    <div class="column column-33">
                        <input type="text" saveas="pool_type">
                    </div>
                    <div class="column">
                        <h4 calc="pool-remaining">0</h4>
                    </div>
                    <div class="column">
                        <input type="number" calc="pool-used" saveas="pool_used">
                    </div>
                    <div class="column">
                        <input type="number" calc="pool-total" saveas="pool_total">
                    </div>
                    <div class="column column-10" align="right">
                        <? if ($mode == "edit") { ?>
                        <input type="submit" value="X" onclick="deleteRow(this)">
                        <? } ?>
                    </div>
                </div>
            </div>

            <? if ($mode == "edit") { ?>
            <div class="row">
                <div class="column">
                    <input type="submit" value="<?=say('button_add')?>" onclick="addRow(this)">
                </div>
            </div>
            <? } ?>
            </section>

        </div>
    </div>

    <div class="row">
        <div class="column column-50" id="gear">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-shopping-cart"></span> <?=say('gear')?></h1>

            <section>
            <? foreach(array("quantity", "uses") as $geartype) { ?>

            <div class="row">
                <div class="column column-40">
                    <label>
                        <? if ($geartype == "quantity") { ?>Equipment<? } ?>
                        <? if ($geartype == "uses") { ?>Magical Items<? } ?>
                    </label>
                </div>
                <div class="column">
                    <label><?=say($geartype)?></label>
                </div>
                <div class="column">
                    <label><?=say('weight')?></label>
                </div>
                <div class="column column-5">
                </div>
                <div class="column column-20">
                </div>
            </div>

            <div class="entries" savetype="columns">
                <div>
                    <div class="row">
                        <div class="column column-40">
                            <input type="text" saveas="gear_<?=$geartype?>_description">
                        </div>
                        <div class="column">
                            <input type="number" saveas="gear_<?=$geartype?>" <?=$geartype?>>
                        </div>
                        <div class="column">
                            <input type="number" step="0.25" saveas="gear_<?=$geartype?>_weight" weight>
                        </div>
                        <div class="column column-5">
                            <input type="checkbox" checked saveas="gear_<?=$geartype?>_carried" carried>
                        </div>
                        <div class="column column-20" align="right">
                            <input type="submit" value="+" onclick="revealMore(this)">
                            <? if ($mode == "edit") { ?>
                            <input type="submit" value="X" onclick="deleteRow(this)">
                            <? } ?>
                        </div>
                    </div>
                    <div class="row reveal">
                        <div class="column column-40">
                            <label><?=say('reference_url')?></label>
                            <input type="url" saveas="gear_<?=$geartype?>_url" onclick="select()">

                            <label><?=say('container')?></label>
                            <select type="text" calc="gear-container-dropdown" saveas="gear_<?=$geartype?>_container" container><option value=""></option></select>
                        </div>
                        <div class="column">
                            <label><?=say('additional_notes')?></label>
                            <textarea saveas="gear_<?=$geartype?>_notes"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <? if ($mode == "edit") { ?>
            <div class="row">
                <div class="column">
                    <input type="submit" value="<?=say('button_add')?>" onclick="addRow(this)">
                </div>
            </div>
            <? } ?>
            <? } ?>

            <div class="row">
                <div class="column column-40">
                    <label><?=say('container')?></label>
                </div>
                <div class="column">
                    <label><?=say('holding')?></label>
                </div>
                <div class="column">
                    <label><?=say('weight')?></label>
                </div>
                <div class="column column-5">
                    <label>&nbsp;</label>
                </div>
                <div class="column column-20" align="right">
                    <label>&nbsp;</label>
                </div>
            </div>

            <input type="hidden" calc="container-name" value="">

            <div class="entries" savetype="columns">
                <div>
                    <div class="row">
                        <div class="column column-40">
                            <input type="text" calc="container-name" saveas="container_name">
                        </div>
                        <div class="column">
                            <span calc="container-holding">0</span>
                        </div>
                        <div class="column">
                            <input type="number" step="0.25" saveas="container_weight" weight>
                        </div>
                        <div class="column column-5">
                            <input type="checkbox" checked style="margin-top: 1.2rem" saveas="container_carried" carried>
                        </div>
                        <div class="column column-20" align="right">
                            <input type="submit" value="+" onclick="revealMore(this)">
                            <? if ($mode == "edit") { ?>
                            <input type="submit" value="X" onclick="deleteRow(this)">
                            <? } ?>
                        </div>
                    </div>
                    <div class="row reveal">
                        <div class="column column-40">
                            <label><?=say('reference_url')?></label>
                            <input type="url" saveas="container_url" onclick="select()">

                            <div class="row">
                                <div class="column column-50">
                                    <label><?=say('max_weight')?></label>
                                    <input calc="container-max" type="number" step="0.25" saveas="container_max_weight">
                                </div>
                                <div class="column column-50">
                                    <label><?=say('add_weight')?></label>
                                    <input type="checkbox" checked style="margin-top: 1.2rem" saveas="container_add_weight" calc="container-add-weight">
                                </div>
                            </div>

                        </div>
                        <div class="column">
                            <label><?=say('additional_notes')?></label>
                            <textarea saveas="container_notes"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <? if ($mode == "edit") { ?>
            <div class="row">
                <div class="column">
                    <input type="submit" value="<?=say('button_add')?>" onclick="addRow(this)">
                </div>
            </div>
            <? } ?>
            </section>

        </div>

        <div class="column column-50">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-gift"></span> <?=say('magic_items')?></h1>

            <section>
            <div class="row">
                <div class="column column-30">
                    <label><?=say('slot')?></label>
                </div>
                <div class="column">
                    <label><?=say('description')?></label>
                </div>
                <div class="column column-10">
                    <label>&nbsp;</label>
                </div>
            </div>

            <?
            $slots = array(
                'belt', 'body', 'chest', 'eyes', 'feet', 'hands', 'head',
                'headband', 'neck', 'ring', 'ring', 'shoulders', 'wrist'
            );
            $slot_save = array(
                'belt', 'body', 'chest', 'eyes', 'feet', 'hands', 'head',
                'headband', 'neck', 'ring1', 'ring2', 'shoulders', 'wrist'
            );
            foreach($slots as $index=>$slot) {
            ?>
            <div class="entry">
                <div class="row">
                    <div class="column column-30">
                        <h4><?=strtoupper(say($slot))?></h4>
                    </div>
                    <div class="column">
                        <input type="text" saveas="magic_item_<?=$slot_save[$index]?>">
                    </div>
                    <div class="column column-10" align="right">
                        <input type="submit" value="+" onclick="revealMore(this)">
                    </div>
                </div>
                <div class="row reveal">
                    <div class="column column-30">
                        <label><?=say('reference_url')?></label>
                        <input type="url" saveas="magic_item_<?=$slot_save[$index]?>_url" onclick="select()">

                        <label><?=say('weight')?></label>
                        <input type="number" step="0.25" saveas="magic_item_<?=$slot_save[$index]?>_weight" weight>
                    </div>
                        <div class="column">
                        <label><?=say('additional_notes')?></label>
                        <textarea saveas="magic_item_<?=$slot_save[$index]?>_notes"></textarea>
                    </div>
                </div>
            </div>
            <? } ?>
            </section>

        </div>
    </div>

    <div class="row">
        <div class="column">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-piggy-bank"></span> <?=say('currency')?></h1>

            <section>
            <div class="row" calc="currency">
                <div class="column column-25">
                    <label><?=say('carried')?></label>
                    <h4 class="calc-result" calc="currency-carried" saveas="final_currency_carried">0</h4>
                </div>
                <div class="column">
                    <label><?=say('copper')?></label>
                    <input sum="currency-weight" class="narrow" calc="copper-carried" type="number" saveas="copper_carried">
                </div>
                <div class="column">
                    <label><?=say('silver')?></label>
                    <input sum="currency-weight" class="narrow" calc="silver-carried" type="number" saveas="silver_carried">
                </div>
                <div class="column">
                    <label><?=say('gold')?></label>
                    <input sum="currency-weight" class="narrow" calc="gold-carried" type="number" saveas="gold_carried">
                </div>
                <div class="column">
                    <label><?=say('platinum')?></label>
                    <input sum="currency-weight" class="narrow" calc="platinum-carried" type="number" saveas="platinum_carried">
                </div>
            </div>

            <div class="row" calc="currency">
                <div class="column column-25">
                    <label><?=say('stored')?></label>
                    <h4 class="calc-result" calc="currency-stored" saveas="final_currency_stored">0</h4>
                </div>
                <div class="column">
                    <label><?=say('copper')?></label>
                    <input class="narrow" type="number" calc="copper-stored" saveas="copper_stored">
                </div>
                <div class="column">
                    <label><?=say('silver')?></label>
                    <input class="narrow" type="number" calc="silver-stored" saveas="silver_stored">
                </div>
                <div class="column">
                    <label><?=say('gold')?></label>
                    <input class="narrow" type="number" calc="gold-stored" saveas="gold_stored">
                </div>
                <div class="column">
                    <label><?=say('platinum')?></label>
                    <input class="narrow" type="number" calc="platinum-stored" saveas="platinum_stored">
                </div>
            </div>

            <div class="row">
                <div class="column column-25">
                    <label><?=say('grand_total')?></label>
                    <h4 class="calc-result" calc="currency-grand-total">0</h4>
                </div>
                <div class="column">
                    <label><?=say('weight')?></label>
                    <h4 calc="currency-weight">0</h4>
                    <input type="hidden" ref="currency-weight" weight>
                </div>
            </div>
            </section>

        </div>
        <div class="column" id="weight">

            <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-scale"></span> <?=say('weight')?></h1>

            <section>
            <div class="row">
                <input type="hidden" calc="max-dex-weight">
                <input type="hidden" calc="check-penalty-weight">
                <input type="hidden" ref="str-total">
                <input type="hidden" ref="size">
                <div class="column">
                    <label><?=say('total')?></label>
                    <h4 class="calc-result" calc="total-weight" saveas="weight_total">0</h4>
                </div>
                <div class="column">
                    <label><?=say('misc')?></label>
                    <input type="number" step="0.25" weight saveas="weight_misc">
                </div>
                <div class="column">
                    <label><?=say('light')?></label>
                    <h4 calc="weight-light">0</h4>
                </div>
                <div class="column">
                    <label><?=say('medium')?></label>
                    <h4 calc="weight-medium">0</h4>
                </div>
                <div class="column">
                    <label><?=say('heavy')?></label>
                    <h4 calc="weight-heavy">0</h4>
                </div>
            </div>

            <div class="row">
                <div class="column column-40">
                    <label><?=say('load_status')?></label>
                    <h4 calc="weight-status" saveas="weight_status">LIGHT</h4>
                </div>
                <div class="column">
                    <label><?=say('above_head')?></label>
                    <h4 calc="weight-above">0</h4>
                </div>
                <div class="column">
                    <label><?=say('off_ground')?></label>
                    <h4 calc="weight-off-ground">0</h4>
                </div>
                <div class="column">
                    <label><?=say('drag_push')?></label>
                    <h4 calc="weight-drag">0</h4>
                </div>
            </div>

            <div class="row">
                <div class="column column-20">
                    <label><?=say('strength')?></label>
                    <h4 calc="weight-strength">0</h4>
                </div>
                <div class="column column-20">
                    <label><?=say('bonus')?></label>
                    <input type="number" calc="weight-strength-bonus" saveas="weight_strength_bonus">
                </div>
                <div class="column column-30">
                    <label><?=say('size')?></label>
                    <h4 calc="weight-current-size">Medium</h4>
                </div>
                <div class="column column-30">
                    <label><?=say('legs')?></label>
                    <select calc="weight-legs">
                        <option value="2" selected="selected"><?=say('biped')?></option>
                        <option value="4"><?=say('quadruped')?></option>
                    </select>
                </div>
            </div>
            </section>
        </div>
    </div>

    <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-fire"></span> <?=say('casting')?></h1>

    <section>
    <div id="casting-class" class="entries" savetype="columns">
        <div class="spaced">
            <div class="row">
                <? foreach(array('str', 'dex', 'con', 'wis', 'int', 'cha') as $type) { ?>
                <input type="hidden" ref="<?=$type?>-mod">
                <? } ?>
                <div class="column column-20">
                    <label><?=say('caster_class')?></label>
                    <select saveas="casting_class" calc="casting-class-name"></select>
                </div>
                <div class="column">
                    <label><?=say('level')?></label>
                    <h4 calc="casting-class-level" saveas="final_casting_class_level">1</h4>
                </div>
                <div class="column">
                    <label><?=say('ability')?></label>
                    <select saveas="casting_modifier" calc="casting-class-attribute">
                        <option value="str"><?=say('str')?></option>
                        <option value="dex"><?=say('dex')?></option>
                        <option value="con"><?=say('con')?></option>
                        <option value="int" selected="selected"><?=say('int')?></option>
                        <option value="wis"><?=say('wis')?></option>
                        <option value="cha"><?=say('cha')?></option>
                    </select>
                </div>
                <div class="column">
                    <label><?=say('modifier')?></label>
                    <h4 calc="casting-class-mod" saveas="casting_class_mod">1</h4>
                </div>
                <div class="column">
                    <label><?=say('concen')?></label>
                    <h4 calc="casting-concentration" saveas="final_concentration"></h4>
                </div>
                <div class="column">
                    <label><?=say('points')?></label>
                    <input type="number" saveas="casting_points">
                </div>
                <div class="column">
                    <label><?=say('close')?></label>
                    <h4 calc="casting-range-close">25ft</h4>
                </div>
                <div class="column">
                    <label><?=say('medium')?></label>
                    <h4 calc="casting-range-medium">100ft</h4>
                </div>
                <div class="column">
                    <label><?=say('long')?></label>
                    <h4 calc="casting-range-long">400ft</h4>
                </div>
                <div class="column column-10" align="right">
                    <label>&nbsp;</label>
                    <input type="submit" value="+" onclick="revealMore(this)">
                    <? if ($mode == "edit") { ?>
                    <input type="submit" value="X" onclick="deleteRow(this)">
                    <? } ?>
                </div>
            </div>

            <div class="row reveal" calc="spell-casting-class">
                <div class="column column-20">
                    <label><?=say('caster_type')?></label>
                    <select saveas="caster_type">
                        <option value="divine"><?=say('divine')?></option>
                        <option value="arcane"><?=say('arcane')?></option>
                        <option value="other"><?=say('other')?></option>
                    </select>

                    <label><?=say('notes')?></label>
                    <textarea saveas="spells_notes" style="min-height: 39rem"></textarea>
                </div>
                <? for($i = 0; $i < 10; $i++) { ?>
                <div class="column">
                    <label class="squeeze"><?=say('lv')?><?=$i?> / <?=say('day')?></label>
                    <h4 calc="spells-<?=$i?>-day-total" saveas="spells_<?=$i?>_per_day">0</h4>

                    <label><?=say('class')?></label>
                    <input type="number" sum="spells-<?=$i?>-day" saveas="spells_<?=$i?>_day">

                    <label><?=say('bonus')?></label>
                    <input type="number" sum="spells-<?=$i?>-day" saveas="spells_<?=$i?>_bonus">

                    <label><?=say('misc')?></label>
                    <input type="number" sum="spells-<?=$i?>-day" saveas="spells_<?=$i?>_bonus">

                    <label>&nbsp;</label>

                    <label class="squeeze"><?=say('lv')?><?=$i?> <?=say('known')?></label>
                    <input type="number" saveas="spells_<?=$i?>_known">

                    <label>&nbsp;</label>

                    <label><?=say('lv')?><?=$i?> <?=say('dc')?></label>
                    <h4 calc="spell-dc">10</h4>
                </div>
                <? } ?>
            </div>
        </div>
    </div>

    <? if ($mode == "edit") { ?>
    <div class="row">
        <div class="column">
            <input type="submit" value="<?=say('button_add')?>" onclick="addRow(this)">
        </div>
    </div>
    <? } ?>

    <div class="row">
        <? for($i = 0; $i < 2; $i++) { ?>
        <div class="column">
            <div class="row">
                <div class="column">
                    <label><?=say('caster_attributes')?></label>
                </div>
            </div>

            <div class="entries" savetype="columns">
                <div class="row">
                    <div class="column column-33">
                        <select saveas="caster_attr_<?=$i?>_type">
                            <option value="bloodline"><?=say('bloodline')?></option>
                            <option value="patron"><?=say('patron')?></option>
                            <option value="domain"><?=say('domain')?></option>
                            <option value="subdomain"><?=say('subdomain')?></option>
                            <option value="specialty"><?=say('specialty')?></option>
                            <option value="focused"><?=say('focused')?></option>
                            <option value="prohibited"><?=say('prohibited')?></option>
                        </select>
                    </div>
                    <div class="column">
                        <input type="text" saveas="caster_attr_<?=$i?>_entry">
                    </div>
                    <? if ($mode == "edit") { ?>
                    <div class="column column-10" align="right">
                        <input type="submit" value="X" onclick="deleteRow(this)">
                    </div>
                    <? } ?>
                </div>
            </div>

            <? if ($mode == "edit") { ?>
            <div class="row">
                <div class="column">
                    <input type="submit" value="<?=say('button_add')?>" onclick="addRow(this)">
                </div>
            </div>
            <? } ?>

        </div>
        <? } ?>
    </div>
    </section>

    <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-list-alt"></span> <?=say('spell_list')?></h1>

    <section>
    <div class="row">
        <div class="column">
            <label><?=say('lv')?></label>
        </div>
        <div class="column">
            <label><?=say('prep')?></label>
        </div>
        <div class="column">
            <label><?=say('used')?></label>
        </div>
        <div class="column column-20">
            <label><?=say('name')?></label>
        </div>
        <div class="column column-15">
            <label><?=say('school')?></label>
        </div>
        <div class="column column-10">
            <label><?=say('duration')?></label>
        </div>
        <div class="column column-10">
            <label><?=say('range')?></label>
        </div>
        <div class="column column-10">
            <label><?=say('save')?></label>
        </div>
        <div class="column column-5">
            <label><?=say('sr')?></label>
        </div>
        <div class="column column-15">
        </div>
    </div>

    <div id="spell-list" class="entries" savetype="columns">
        <div>
            <div class="row highlight">
                <div class="column">
                    <input type="number" calc="spell-list-level" class="narrow strong" saveas="spell_list_level">
                </div>
                <div class="column">
                    <input type="number" class="narrow" saveas="spell_list_prep" calc="prep">
                </div>
                <div class="column">
                    <input type="number" class="narrow" saveas="spell_list_used">
                </div>
                <div class="column column-20">
                    <input type="text" class="strong" saveas="spell_list_name">
                </div>
                <div class="column column-15">
                    <input type="text" saveas="spell_list_school">
                </div>
                <div class="column column-10">
                    <input type="text" saveas="spell_list_duration">
                </div>
                <div class="column column-10">
                    <input type="text" saveas="spell_list_range">
                </div>
                <div class="column column-10">
                    <select saveas="spell_list_save">
                        <option value="na"></option>
                        <option value="fortitude"><?=strtoupper(say('fort'))?></option>
                        <option value="reflex"><?=strtoupper(say('ref'))?></option>
                        <option value="will" selected><?=strtoupper(say('will'))?></option>
                    </select>
                </div>
                <div class="column column-5">
                    <input type="checkbox" saveas="spell_list_sr">
                </div>
                <div class="column column-15" align="right">
                    <input type="submit" value="+" onclick="revealMore(this)">
                    <? if ($mode == "edit") { ?>
                    <input type="submit" value="⇑" onclick="moveUpRow(this)" hide-prep>
                    <input type="submit" value="⇓" onclick="moveDownRow(this)" hide-prep>
                    <input type="submit" value="X" onclick="deleteRow(this)">
                    <? } ?>
                </div>
            </div>
            <div class="row reveal">
                <div class="column column-30">
                    <div class="row">
                        <div class="column column-70">
                            <label><?=say('caster_class')?></label>
                            <select calc="spell-caster-class-name" saveas="spell_list_class_name"></select>
                        </div>
                        <div class="column">
                            <label><?=say('dc')?></label>
                            <h4 calc="spell-list-dc" saveas="spell_list_dc">10</h4>
                        </div>
                    </div>
                    <label><?=say('reference_url')?></label>
                    <input type="url" onclick="select()" saveas="spell_list_ref">
                </div>
                <div class="column">
                    <label><?=say('additional_notes')?></label>
                    <textarea style="min-height: 11.3rem;" saveas="spell_list_notes"></textarea>
                </div>
            </div>
        </div>
    </div>

    <? if ($mode == "edit") { ?>
    <div class="row">
        <div class="column">
            <input type="submit" value="<?=say('button_add')?>" onclick="addRow(this)">
        </div>
    </div>
    <? } ?>
    </section>

    <h1 onclick="toggleSection(this)"><span class="glyphicon glyphicon-file"></span> <?=say('notes')?></h1>

    <section>
    <div class="row">
        <? for($i = 1; $i < 4; $i++) { ?>
        <div class="column">
            <label><?=say('title')?></label>
            <input type="text" class="strong" saveas="notes_<?=$i?>_header">
            <label><?=say('contents')?></label>
            <textarea saveas="notes_<?=$i?>_contents" style="min-height: 50rem"></textarea>
        </div>
        <? } ?>
    </div>

    <div class="row">
        <div class="column column-20">
            <label><?=say('link')?></label>
        </div>
        <div class="column">
            <label><?=say('url')?></label>
        </div>
        <div class="column">
            <label><?=say('title')?><label>
        </div>
        <div class="column">
            <label><?=say('notes')?><label>
        </div>
        <div class="column column-5">
        </div>
    </div>

    <div class="entries" savetype="columns" id="links">
        <div class="row">
            <div class="column column-20">
                <a class="strong" href="#" target="pfsearch"></a>
            </div>
            <div class="column">
                <input type="url" saveas="link_url">
            </div>
            <div class="column">
                <input type="text" saveas="link_title">
            </div>
            <div class="column">
                <input type="text" saveas="link_notes">
            </div>
            <div class="column column-5" align="right">
                <? if ($mode == "edit") { ?>
                    <input type="submit" value="X" onclick="deleteRow(this)">
                <? } ?>
            </div>
        </div>
    </div>

    <? if ($mode == "edit") { ?>
    <div class="row">
        <div class="column">
            <input type="submit" value="<?=say('button_add')?>" onclick="addRow(this)">
        </div>
    </div>
    <? } ?>
    </section>

</div>
<input type="hidden" id="js-fantasy-custom" value="<?=strtoupper(say('fantasy_custom'))?>" />
<input type="hidden" id="js-fantasy-low" value="<?=strtoupper(say('fantasy_low'))?>" />
<input type="hidden" id="js-fantasy-standard" value="<?=strtoupper(say('fantasy_standard'))?>" />
<input type="hidden" id="js-fantasy-high" value="<?=strtoupper(say('fantasy_high'))?>" />
<input type="hidden" id="js-fantasy-epic" value="<?=strtoupper(say('fantasy_epic'))?>" />

<input type="hidden" id="js-weight-light" value="<?=strtoupper(say('weight_light'))?>" />
<input type="hidden" id="js-weight-medium" value="<?=strtoupper(say('weight_medium'))?>" />
<input type="hidden" id="js-weight-heavy" value="<?=strtoupper(say('weight_heavy'))?>" />
<input type="hidden" id="js-weight-over" value="<?=strtoupper(say('weight_over'))?>" />

<input type="hidden" id="js-health-alive" value="<?=strtoupper(say('health_alive'))?>" />
<input type="hidden" id="js-health-disabled" value="<?=strtoupper(say('health_disabled'))?>" />
<input type="hidden" id="js-health-out" value="<?=strtoupper(say('health_out'))?>" />
<input type="hidden" id="js-health-dead" value="<?=strtoupper(say('health_dead'))?>" />
<input type="hidden" id="js-health-very-dead" value="<?=strtoupper(say('health_very_dead'))?>" />
<input type="hidden" id="js-health-ultra-dead" value="<?=strtoupper(say('health_ultra_dead'))?>" />

<input type="hidden" id="message-validation-error" value="<?=say('validation_error')?>" />

<? if ($mode == "edit") { ?>
<input type="hidden" id="message-save-hp" value="<?=say('updating_health')?>" />
<input type="hidden" id="message-save-hp-true" value="<?=say('health_update_success')?>" />
<input type="hidden" id="message-saving" value="<?=say('saving')?>" />
<input type="hidden" id="message-saved" value="<?=say('sheet_saved')?>" />
<input type="hidden" id="message-save-failed" value="<?=say('save_failed')?>" />
<input type="hidden" id="message-row-delete" value="<?=say('row_delete')?>" />

<script type="text/javascript" src="/js/edit.js"></script>
<? } ?>
<script type="text/javascript" src="/js/sheet.js"></script>
