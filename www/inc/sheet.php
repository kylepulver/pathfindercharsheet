<div class="exporter">
    <div class="row">
        <div class="column">
            <h4>Export Data</h4>
            <textarea id="export-data" onclick="select()" style="height: 20rem"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <input type="submit" value="Close" onclick="closeOverlay(this)">
        </div>
    </div>
</div>

<div class="importer">
    <div class="row">
        <div class="column">
            <h4>Import Data</h4>
            <textarea id="import-data" style="height: 20rem"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <input type="submit" value="Load" onclick="loadImport(this)">
            <input type="submit" value="Close" onclick="closeOverlay(this)">
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
                <label>Sheet Name</label>
                <input type="text" saveas="sheetname" class="sheet">
            </div>
            <? if ($mode == "edit") { ?>
            <div class="column column-25">
                <label><a target="_blank" id="publicurl-link">Public Url</a> <a target="_blank" id="compact-link"><span class="glyphicon glyphicon-share-alt"></span></a></label>
                <input type="text" readonly="readonly" onclick="select()" id="publicurl">
            </div>
            <div class="column">
                <label>Message</label>
                <span id="server-message"></span>
            </div>
            <? } else { ?>
            <div class="column column-25"></div>
            <div class="column"></div>
            <? } ?>

            <div class="column column-33" align="right">
                <label>&nbsp;</label>
                <? if ($mode == "edit") { ?>
                <input type="submit" value="Save" onclick="save()">
                <input type="submit" value="Import" onclick="sheetImport()">
                <? } else { ?>
                <input type="submit" value="Compact View" onclick="viewCompact()">
                <? } ?>
                <input type="submit" value="Export" onclick="sheetExport()">
                <input type="submit" value="Home" onclick="goTo('/')">
                <? if ($mode == "edit") { ?>
                <input type="submit" id="more-tools-button" value="+" onclick="revealTools()">
                <? } ?>
            </div>
        </div>
        <div class="row more-tools" id="more-tools" align="right">
            <div class="column">
                <input type="submit" value="Compact View" onclick="viewCompact()">
                <input type="submit" value="Clear All Temps" onclick="clearTemp()">
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
                    D20PFSRD
                </a>
                <a class="strong" id="search-prd" target="pfsearch" href="http://paizo.com/pathfinderRPG/prd/">
                    <span class="glyphicon glyphicon-search"></span>
                    Paizo PRD
                </a>
            </div>
            <div class="column rolz">
                <a href="http://rolz.org" target="pfsearch">Rolz.org</a> Dice Roller:
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
            <strong>AC</strong>
            <span ref="total-ac"></span>
        </div>
        <div>
            <strong>FLAT</strong>
            <span ref="flatfoot-ac"></span>
        </div>
        <div>
            <strong>TOUCH</strong>
            <span ref="touch-ac"></span>
        </div>
        <div>
            <strong>HP</strong>
            <span ref="final_hp_current"></span>
        </div>
        <div>
            <strong>INIT</strong>
            <span ref="init-total"></span>
        </div>
        <div>
            <strong>FORT</strong>
            <span ref="final_fort"></span>
        </div>
        <div>
            <strong>REF</strong>
            <span ref="final_ref"></span>
        </div>
        <div>
            <strong>WILL</strong>
            <span ref="final_will"></span>
        </div>
        <div>
            <strong>BAB</strong>
            <span ref="final_bab"></span>
        </div>
        <div>
            <strong>MELEE</strong>
            <span ref="final_melee"></span>
            <strong>RANGE</strong>
            <span ref="final_ranged"></span>
        </div>
        <div>
            <strong>CMB</strong>
            <span ref="cmb-total"></span>
            <strong>CMD</strong>
            <span ref="cmd-total"></span>
        </div>
        <div>
            <strong>STR</strong>
            <span ref="str-total"></span> (<span ref="str-mod"></span>)
        </div>
        <div>
            <strong>DEX</strong>
            <span ref="dex-total"></span> (<span ref="dex-mod"></span>)
        </div>
        <div>
            <strong>CON</strong>
            <span ref="con-total"></span> (<span ref="con-mod"></span>)
        </div>
        <div>
            <strong>INT</strong>
            <span ref="int-total"></span> (<span ref="int-mod"></span>)
        </div>
        <div>
            <strong>WIS</strong>
            <span ref="wis-total"></span> (<span ref="wis-mod"></span>)
        </div>
        <div>
            <strong>CHA</strong>
            <span ref="cha-total"></span> (<span ref="cha-mod"></span>)
        </div>
        <div>
            <strong>LOAD</strong>
            <span ref="weight-status"></span>
        </div>
        <div>
            <strong>WEIGHT</strong>
            <span ref="total-weight"></span>
        </div>
        <div>
            <strong>COIN</strong>
            <span ref="currency-grand-total"></span>
        </div>
    </div>
</div>

<div class="container" id="sheet">
    <h1><span class="glyphicon glyphicon-user"></span> Character</h1>
    <div class="row">
        <div class="column">
            <label>Name</label>
            <input type="text" saveas="charname">
        </div>
        <div class="column">
            <label>Player</label>
            <input type="text" saveas="playername">
        </div>
        <div class="column">
            <label>Race</label>
            <input type="text" saveas="race">
        </div>
        <div class="column">
            <label>Deity</label>
            <input type="text" saveas="deity">
        </div>
        <div class="column">
            <label>Alignment</label>
            <select saveas="alignment" calc="alignment">
                <option value="n" selected="selected">Neutral</option>
                <option value="ng">Neutral Good</option>
                <option value="ne">Neutral Evil</option>
                <option value="lg">Lawful Good</option>
                <option value="ln">Lawful Neutral</option>
                <option value="le">Lawful Evil</option>
                <option value="cg">Chaotic Good</option>
                <option value="cn">Chaotic Neutral</option>
                <option value="ce">Chaotic Evil</option>
            </select>
        </div>

    </div>

    <div class="row">
        <div class="column column-15">
            <label>Homeland</label>
            <input type="text" saveas="homeland">
        </div>

        <div class="column column-15">
            <label>Size</label>
            <select saveas="size" calc="size">
                <option value="fine" mod="8">Fine</option>
                <option value="diminutive" mod="4">Diminutive</option>
                <option value="tiny" mod="2">Tiny</option>
                <option value="small" mod="1">Small</option>
                <option value="medium" mod="0" selected="selected">Medium</option>
                <option value="large" mod="-1">Large</option>
                <option value="huge" mod="-2">Huge</option>
                <option value="gargantuan" mod="-4">Gargantuan</option>
                <option value="colossal" mod="-8">Colossal</option>
            </select>
            <input type="hidden" calc="size-mod">
            <input type="hidden" calc="size-mod-special">
        </div>

        <div class="column column-10">
            <label>Gender</label>
            <input type="text" saveas="gender">
        </div>

        <div class="column column-10">
            <label>Age</label>
            <input type="number" saveas="age">
        </div>

        <div class="column column-10">
            <label>Weight</label>
            <input type="number" saveas="weight">
        </div>

        <div class="column column-10">
            <label>Height</label>
            <input type="text" saveas="height">
        </div>

        <div class="column column-10">
            <label>Hair</label>
            <input type="text" saveas="hair">
        </div>

        <div class="column column-10">
            <label>Eyes</label>
            <input type="text" saveas="eyes">
        </div>

        <div class="column column-10">
            <label>Skin</label>
            <input type="text" saveas="skin">
        </div>
    </div>

    <div class="row">
        <div class="column column-80">
            <label>Languages</label>
            <input type="text" saveas="known_languages" id="language-tags">
        </div>
        <div class="column">
            <label>Creature Type</label>
            <select saveas="creature_type">
                <option value="aberration">Abberations</option>
                <option value="animal">Animal</option>
                <option value="construct">Construct</option>
                <option value="dragon">Dragon</option>
                <option value="fey">Fey</option>
                <option value="humanoid" selected>Humanoid</option>
                <option value="magical_beast">Magical Beast</option>
                <option value="monsterous_humanoid">Monsterous Humanoid</option>
                <option value="ooze">Ooze</option>
                <option value="outsider">Outsider</option>
                <option value="plant">Plant</option>
                <option value="undead">Undead</option>
                <option value="vermin">Vermin</option>
            </select>
        </div>
    </div>

    <h1><span class="glyphicon glyphicon-th-list"></span> Ability Scores</h1>

    <div class="row">
        <div class="column">
            <label>Type</label>
        </div>
        <div class="column">
            <label>Total</label>
        </div>
        <div class="column">
            <label>Modifier</label>
        </div>
        <div class="column">
            <label>Base</label>
        </div>
        <div class="column">
            <label>Level</label>
        </div>
        <div class="column">
            <label>Race</label>
        </div>
        <div class="column">
            <label>Enhance</label>
        </div>
        <div class="column">
            <label>Size</label>
        </div>
        <div class="column">
            <label>Damage</label>
        </div>
        <div class="column">
            <label>Drain</label>
        </div>
        <div class="column">
            <label>Age</label>
        </div>
        <div class="column">
            <label>Misc</label>
        </div>
        <div class="column">
            <label>Temp</label>
        </div>
    </div>

    <? foreach(array("str", "dex", "con", "int", "wis", "cha") as $type) { ?>

    <div class="row" id="<?=$type?>">
        <div class="column">
            <h4><?=strtoupper($type)?></h4>
        </div>
        <div class="column">
            <h4 saveas="final_<?=$type?>_total" class="calc-result" calc="<?=$type?>-total">0</h4>
        </div>
        <div class="column">
            <h4 saveas="final_<?=$type?>_mod" class="calc-result" calc="<?=$type?>-mod">0</h4>
        </div>
        <div class="column">
            <input type="number" sum="<?=$type?>" saveas="<?=$type?>_base">
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

    <h1><span class="glyphicon glyphicon-knight"></span> Class</h1>

    <div class="row" calc="classes-total">
        <div class="column column-20">
            <label>Favored Class</label>
            <select saveas="favored_class" calc="favored-class"></select>
        </div>
        <div class="column">
            <label>Levels</label>
            <h4 class="calc-result" calc="levels">0</h4>
        </div>
        <div class="column">
            <label>BAB</label>
            <h4 saveas="final_bab" class="calc-result" calc="bab">0</h4>
        </div>
        <div class="column">
            <label>Skill</label>
            <h4 class="calc-result" calc="skill">0</h4>
        </div>
        <div class="column">
            <label>HP Bonus</label>
            <h4 class="calc-result" calc="hpbonus">0</h4>
        </div>
        <div class="column">
            <label>Fortitude</label>
            <h4 class="calc-result" calc="fortitude">0</h4>
        </div>
        <div class="column">
            <label>Reflex</label>
            <h4 class="calc-result" calc="reflex">0</h4>
        </div>
        <div class="column">
            <label>Will</label>
            <h4 class="calc-result" calc="will">0</h4>
        </div>
        <div class="column column-10"></div>
    </div>

    <div class="row">
        <div class="column">
            <label>Class Name</label>
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
                    <label>Reference URL</label>
                    <input type="url" saveas="class_url" onclick="select()">
                </div>
                <div class="column">
                    <label>Additional Notes</label>
                    <textarea saveas="class_notes"></textarea>
                </div>
            </div>
        </div>
    </div>

    <? if ($mode == "edit") { ?>
    <div class="row">
        <div class="column">
            <input type="submit" value="Add" onclick="addRow(this)">
        </div>
    </div>
    <? } ?>

    <div class="row">
        <div class="column column-50">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-education"></span> Skills</h1>
                </div>
            </div>

            <div class="row" calc="skills">
                <div class="column">
                    <label>Total Skill Points</label>
                    <h4 ref="skill">0</h4>
                </div>
                <div class="column">
                    <label>Used Skill Points</label>
                    <h4 calc="skill-used">0</h4>
                </div>
                <div class="column">
                    <label>Armor Check Penalty</label>
                    <h4 ref="penalty-total">0</h4>
                </div>
            </div>

            <div class="row">
                <div class="column column-30">
                    <label>Type</label>
                </div>
                <div class="column">
                    <label>Total</label>
                </div>
                <div class="column">
                    <label>Ability</label>
                </div>
                <div class="column">
                </div>
                <div class="column">
                    <label>Train</label>
                </div>
                <div class="column">
                    <label>Ranks</label>
                </div>
                <div class="column">
                    <label>Misc</label>
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
                        <span calc="skill-name" saveas="skill_name" load="no"><?=$skill?></span>
                    </div>
                    <div class="column">
                        <span calc="skill-total" class="calc-result" saveas="final_skill">0</span>
                    </div>
                    <div class="column">
                        <span calc="skill-type" saveas="skill_ability" load="no"><?=strtoupper($abilities[$index])?></span>
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
                            <option value="str">STR</option>
                            <option value="dex">DEX</option>
                            <option value="con">CON</option>
                            <option value="int" selected="selected">INT</option>
                            <option value="wis">WIS</option>
                            <option value="cha">CHA</option>
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
                    <input type="submit" value="Add" onclick="addRow(this)">
                </div>
            </div>
            <? } ?>
        </div>

        <div class="column column-50">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-star"></span> Feats</h1>

                    <div class="row">
                        <div class="column column-40">
                            <label>Feat</label>
                        </div>
                        <div class="column column-40">
                            <label>Notes</label>
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
                                    <label>Reference URL</label>
                                    <input type="url" saveas="feat_url" onclick="select()">
                                </div>
                                <div class="column">
                                    <label>Additional Notes</label>
                                    <textarea saveas="feat_more_notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <? if ($mode == "edit") { ?>
                    <div class="row">
                        <div class="column">
                            <input type="submit" value="Add" onclick="addRow(this)">
                        </div>
                    </div>
                    <? } ?>

                    <h1><span class="glyphicon glyphicon-star-empty"></span> Special Abilities</h1>

                    <div class="row">
                        <div class="column column-33">
                            <label>Ability</label>
                        </div>
                        <div class="column">
                            <label>Type</label>
                        </div>
                        <div class="column">
                            <label>Uses</label>
                        </div>
                        <div class="column">
                            <label>Used</label>
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
                                        <option value="Su">Su</option>
                                        <option value="Sp">Sp</option>
                                        <option value="Ex">Ex</option>
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
                                    <label>Reference URL</label>
                                    <input type="url" saveas="special_url">
                                </div>
                                <div class="column">
                                    <label>Additional Notes</label>
                                    <textarea saveas="special_notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <? if ($mode == "edit") { ?>
                    <div class="row">
                        <div class="column">
                            <input type="submit" value="Add" onclick="addRow(this)">
                        </div>
                    </div>
                    <? } ?>

                </div>
            </div>
        </div>
    </div>

    <h1><span class="glyphicon glyphicon-heart"></span> Health</h1>

    <div class="row" id="health">
        <input type="hidden" ref="con-total">
        <div class="column column-10">
            <label>Total</label>
            <h4 class="calc-result" calc="result-total" saveas="final_hp_total">0</h4>
        </div>
        <div class="column column-10">
            <label>Current</label>
            <h4 class="calc-result" calc="current" saveas="final_hp_current">0</h4>
        </div>
        <div class="column column-20">
            <label>Status</label>
            <h4 calc="status">GOOD</h4>
        </div>
        <div class="column column-10">
            <label>Base</label>
            <input type="number" calc="total" saveas="health_base">
        </div>
        <div class="column column-10">
            <label>Temp</label>
            <input type="number" calc="total" saveas="health_temp" temp>
        </div>
        <div class="column column-10">
            <label>Misc</label>
            <input type="number" calc="total" saveas="health_misc">
        </div>
        <div class="column column-10">
            <label>Class</label>
            <h4 ref="hpbonus" calc="total">0</h4>
        </div>
        <div class="column column-10" calc="lethal">
            <label>Lethal</label>
            <input type="number" calctype="subtract" saveas="health_lethal">
        </div>
        <div class="column column-10" calc="nonlethal">
            <label>Nonlethal</label>
            <input type="number" saveas="health_nonlethal">
        </div>
    </div>

    <div class="row">
        <div class="column">
            <div class="row">
                <div class="column">
                    <label>Health Bar</label>
                    <div class="health-bar bar-container">
                        <div class="bar ko" calc="healthbar-ko"></div><div class="bar health" calc="healthbar-hp"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="row">
                <div class="column">
                    <label>Conditions</label>
                    <input type="text" id="conditions-tags" saveas="health_conditions">
                </div>
            </div>
        </div>
    </div>

    <h1><span class="glyphicon glyphicon-tower"></span> Armor</h1>

    <div class="row" calc="armor-class">
        <input type="hidden" ref="dex-mod"> <!-- So armor updates when dex mod changes -->
        <div class="column">
            <label>Total AC</label>
            <h4 class="calc-result" calc="total-ac" saveas="final_ac">0</h4>
        </div>
        <div class="column">
            <label>Touch</label>
            <h4 class="calc-result" calc="touch-ac" saveas="final_touch">10</h4>
        </div>
        <div class="column">
            <label>Flat Foot</label>
            <h4 class="calc-result" calc="flatfoot-ac" saveas="final_flatfoot">10</h4>
        </div>
        <div class="column">
            <label>Armor</label>
            <h4 sum="armor-total" calc="armor-gear" saveas="final_armor">0</h4>
        </div>
        <div class="column">
            <label>Shield</label>
            <h4 sum="armor-total" calc="shield-gear" saveas="final_shield">0</h4>
        </div>
        <div class="column">
            <label>Dex</label>
            <h4 sum="armor-total" calc="max-dex-bonus" saveas="final_dex_armor">0</h4>
        </div>
        <div class="column">
            <label>Size</label>
            <h4 sum="armor-total" ref="size-mod" saveas="final_size_armor">0</h4>
        </div>
        <div class="column">
            <label>Dodge</label>
            <input type="number" calc="armor-dodge" sum="armor-total" saveas="armor_dodge">
        </div>
        <div class="column">
            <label>Natural</label>
            <input type="number" sum="armor-total" saveas="armor_natural">
        </div>
        <div class="column">
            <label>Deflect</label>
            <input type="number" calc="armor-deflect" sum="armor-total" saveas="armor_deflect">
        </div>
        <div class="column">
            <label>Misc</label>
            <input type="number" sum="armor-total" saveas="armor_misc">
        </div>
        <div class="column">
            <label>Temp</label>
            <input type="number" sum="armor-total" saveas="armor_temp" temp>
        </div>
    </div>

    <? foreach(array("armor", "shield") as $armor) { ?>
    <div class="row" calc="armor-class">
        <div class="column">
            <label><?=ucfirst($armor)?></label>
            <input type="text" saveas="<?=$armor?>_name">
        </div>
        <div class="column column-10">
            <label>AC Bonus</label>
            <input type="number" calc="<?=$armor?>-ac-bonus" saveas="armor_<?=$armor?>_ac">
        </div>
        <div class="column column-10">
            <label>Enhance</label>
            <input type="number" calc="<?=$armor?>-enhance-bonus" saveas="armor_<?=$armor?>_enhance">
        </div>
        <div class="column column-10">
            <label>Max Dex</label>
            <input type="number" calc="<?=$armor?>-max-dex" saveas="armor_<?=$armor?>_max_dex">
        </div>
        <div class="column column-10">
            <label>Penalty</label>
            <input type="number" sum="armor-penalty" calctype="subtract" saveas="armor_<?=$armor?>_penalty">
        </div>
        <div class="column column-10">
            <label>Spell Fail</label>
            <input type="number" sum="spell-chance" saveas="armor_<?=$armor?>_spellfail">
        </div>
        <div class="column column-10">
            <label>Type</label>
            <input type="text" saveas="armor_<?=$armor?>_type">
        </div>
        <div class="column column-10">
            <label>Weight</label>
            <input type="number" saveas="armor_<?=$armor?>_weight" weight step="0.5">
        </div>
    </div>
    <? } ?>

    <div class="row">
        <div class="column column-20">
            <label>Armor Check Penalty</label>
            <h4 ref="penalty-total">0</h4>
            <input type="hidden" calc="penalty-total">
        </div>
        <div class="column column-20">
            <label>Maximum DEX Bonus</label>
            <h4 calc="max-dex-total">0</h4>
        </div>
        <div class="column column-20">
            <label>Spell Failure Chance</label>
            <h4 calc="spell-fail-total">0%</h4>
        </div>
        <div class="column">
            <label>Notes</label>
            <input type="text" saveas="armor_notes">
        </div>
    </div>

    <div class="row">
        <div class="column">
            <div class="row">
                <div class="column0">
                    <h1><span class="glyphicon glyphicon-flash"></span> Saves</h1>
                </div>
            </div>

            <div class="row">
                <div class="column column-15">
                    <label>Type</label>
                </div>
                <div class="column">
                    <label>Total</label>
                </div>
                <div class="column">
                    <label>Class</label>
                </div>
                <div class="column">
                    <label>Ability</label>
                </div>
                <div class="column">
                    <label>Enhance</label>
                </div>
                <div class="column">
                    <label>Misc</label>
                </div>
                <div class="column">
                    <label>Temp</label>
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
                    <h4><?=strtoupper($save)?></h4>
                </div>
                <div class="column">
                    <h4 class="calc-result" calc="save-total" saveas="final_<?=$save?>">0</h4>
                </div>
                <div class="column">
                    <h4 sum="save" ref="<?=$saves[$index]?>">0</h4>
                </div>
                <div class="column">
                    <h4 sum="save" ref="<?=$abilities[$index]?>-mod">0</h4>
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
        </div>

        <div class="column">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-heart-empty"></span> Resistance</h1>
                </div>
            </div>

            <div class="row">
                <div class="column column-20">
                    <label>Spell Resist</label>
                    <input type="number" saveas="spell_resistance">
                </div>
                <div class="column">
                    <label>Damage Resistance</label>
                    <input type="text" saveas="damage_resistance">
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <label>Other Resistances</label>
                    <input type="text" id="resistance-tags" saveas="other_resistance">
                </div>
            </div>
        </div>
    </div>

    <h1><span class="glyphicon glyphicon-scissors"></span> Weapons</h1>

    <div class="row">
        <div class="column column-20">
            <label>Weapon Name</label>
        </div>
        <div class="column column-15">
            <label>Attack</label>
        </div>
        <div class="column column-15">
            <label>Damage</label>
        </div>
        <div class="column">
            <label>Critical</label>
        </div>
        <div class="column">
            <label>Range</label>
        </div>
        <div class="column">
            <label>Type</label>
        </div>
        <div class="column">
            <label>Quantity</label>
        </div>
        <div class="column">
            <label>Weight</label>
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
                    <label>Reference URL</label>
                    <input type="url" saveas="weapon_ref" onclick="select()">

                    <label>Attack Type</label>
                    <select saveas="weapon_attack_type">
                        <option value="melee">Melee</option>
                        <option value="ranged">Ranged</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="column">
                    <label>Additional Notes</label>
                    <textarea saveas="weapon_notes"></textarea>
                </div>
            </div>
        </div>
    </div>

    <? if ($mode == "edit") { ?>
    <div class="row">
        <div class="column">
            <input type="submit" value="Add" onclick="addRow(this)">
        </div>
    </div>
    <? } ?>

    <div class="row">
        <div class="column column-50">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-warning-sign"></span> Attacks</h1>
                </div>
            </div>

            <?
            $type = array("str", "dex");
            foreach(array("melee", "ranged") as $index=>$attack) {
            ?>
            <div class="row" calc="attacks">
                <div class="column column-20">
                    <label><?=ucfirst($attack)?></label>
                    <h4 class="calc-result" calc="result-total" saveas="final_<?=$attack?>">0</h4>
                </div>
                <div class="column">
                    <label>BAB</label>
                    <h4 ref="bab" calc="attack">0</h4>
                </div>
                <div class="column">
                    <label>Ability</label>
                    <h4 ref="<?=$type[$index]?>-mod" calc="attack">0</h4>
                </div>
                <div class="column">
                    <label>Size</label>
                    <h4 ref="size-mod" calc="attack">0</h4>
                </div>
                <div class="column">
                    <label>Temp</label>
                    <input type="number" calc="attack" saveas="attack_<?=$type?>_temp" temp>
                </div>
                <div class="column">
                    <label>Misc</label>
                    <input type="number" calc="attack" saveas="attack_<?=$type?>_misc">
                </div>
            </div>
            <? } ?>

        </div>
        <div class="column column-50">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-record"></span> Maneuvers</h1>
                </div>
            </div>

            <div class="row" calc="maneuvers">
                <div class="column column-20">
                    <label>CMB Total</label>
                    <h4 class="calc-result" calc="cmb-total" saveas="final_cmb">0</h4>
                </div>
                <div class="column">
                    <label>BAB</label>
                    <h4 ref="bab" sum="cmb">0</h4>
                </div>
                <div class="column">
                    <label>Ability</label>
                    <h4 sum="cmb" calc="cmb-ability">0</h4>
                </div>
                <div class="column column-20">
                    <label>Type</label>
                    <select calc="cmb-type" saveas="cmb_ability">
                        <option value="str" selected="selected">STR</option>
                        <option value="dex">DEX</option>
                        <option value="con">CON</option>
                        <option value="int">INT</option>
                        <option value="wis">WIS</option>
                        <option value="cha">CHA</option>
                    </select>
                </div>
                <div class="column">
                    <label>Size</label>
                    <h4 ref="size-mod" sum="cmb">0</h4>
                </div>
                <div class="column">
                    <label>Misc</label>
                    <input type="number" sum="cmb" saveas="cmb_misc">
                </div>
            </div>

            <div class="row cmd" calc="maneuvers">
                <div class="column column-20">
                    <label>CMD Total</label>
                    <h4 class="calc-result" calc="cmd-total" saveas="final_cmd">0</h4>
                </div>
                <div class="column">
                    <label>BAB</label>
                    <h4 sum="cmd" ref="bab">0</h4>
                </div>
                <div class="column">
                    <label>Dodge</label>
                    <h4 sum="cmd" ref="armor-dodge">0</h4>
                </div>
                <div class="column">
                    <label>Deflect</label>
                    <h4 sum="cmd" ref="armor-deflect">0</h4>
                </div>
                <div class="column">
                    <label>STR</label>
                    <h4 sum="cmd" ref="str-mod">0</h4>
                </div>
                <div class="column">
                    <label>DEX</label>
                    <h4 sum="cmd" ref="dex-mod">0</h4>
                </div>
                <div class="column">
                    <label>Size</label>
                    <h4 sum="cmd" ref="size-mod-special">0</h4>
                </div>
                <div class="column">
                    <label>Misc</label>
                    <input sum="cmd" type="number" saveas="cmd_misc">
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="column column-50">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-alert"></span> Initiative</h1>
                </div>
            </div>
            <div class="row" calc="initiative">
                <div class="column column-25">
                    <label>Initivative Total</label>
                    <h4 class="calc-result" calc="init-total" saveas="final_init">0</h4>
                </div>
                <div class="column column-25">
                    <label>DEX Modifier</label>
                    <h4 ref="dex-mod" sum="init" >0</h4>
                </div>
                <div class="column column-25">
                    <label>Misc Bonus</label>
                    <input sum="init" type="number">
                </div>
                <div class="column column-25">
                    <label>Temp Bonus</label>
                    <input sum="init" type="number" temp>
                </div>
            </div>
        </div>

        <div class="column column-50">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-dashboard"></span> Movement</h1>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label>Speed</label>
                    <input type="number" saveas="movement_speed">
                </div>
                <div class="column">
                    <label>Base</label>
                    <input type="number" saveas="movement_base">
                </div>
                <div class="column">
                    <label>Fly</label>
                    <input type="number" saveas="movement_fly">
                </div>
                <div class="column">
                    <label>Swim</label>
                    <input type="number" saveas="movement_swim">
                </div>
                <div class="column">
                    <label>Climb</label>
                    <input type="number" saveas="movement_climb">
                </div>
                <div class="column">
                    <label>Misc</label>
                    <input type="number" saveas="movement_misc">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="column column-50">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-bookmark"></span> Experience</h1>
                </div>
            </div>
            <div class="row" id="experience">
                <div class="column column-33">
                    <label>Rate</label>
                    <select saveas="experience_rate">
                        <option value="slow">Slow</option>
                        <option value="medium">Medium</option>
                        <option value="fast">Fast</option>
                    </select>
                </div>
                <div class="column">
                    <label>Points</label>
                    <input type="number" calc="experience-points" saveas="experience_points">
                </div>
                <div class="column">
                    <label>Previous Goal</label>
                    <input type="number" calc="experience-prev-goal" saveas="experience_prev_goal">
                </div>
                <div class="column">
                    <label>Next Goal</label>
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
        </div>

        <div class="column column-50">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-tasks"></span> Pool Points</h1>
                </div>
            </div>

            <div class="row">
                <div class="column column-33">
                    <label>Type</label>
                </div>
                <div class="column">
                    <label>Remaining</label>
                </div>
                <div class="column">
                    <label>Used</label>
                </div>
                <div class="column">
                    <label>Total</label>
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
                    <input type="submit" value="Add" onclick="addRow(this)">
                </div>
            </div>
            <? } ?>

        </div>
    </div>

    <div class="row">
        <div class="column column-50" id="gear">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-shopping-cart"></span> Gear</h1>
                </div>
            </div>

            <? foreach(array("quantity", "uses") as $geartype) { ?>
            <div class="row">
                <div class="column column-40">
                    <label>Description</label>
                </div>
                <div class="column">
                    <label><?=ucfirst($geartype)?></label>
                </div>
                <div class="column">
                    <label>Weight</label>
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
                            <input type="checkbox" checked style="margin-top: 1.2rem" saveas="gear_<?=$geartype?>_carried" carried>
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
                            <label>Reference URL</label>
                            <input type="url" saveas="gear_<?=$geartype?>_url" onclick="select()">

                            <label>Container</label>
                            <select type="text" calc="gear-container-dropdown" saveas="gear_<?=$geartype?>_container" container><option value=""></option></select>
                        </div>
                        <div class="column">
                            <label>Additional Notes</label>
                            <textarea saveas="gear_<?=$geartype?>_notes"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <? if ($mode == "edit") { ?>
            <div class="row">
                <div class="column">
                    <input type="submit" value="Add" onclick="addRow(this)">
                </div>
            </div>
            <? } ?>
            <? } ?>

            <div class="row">
                <div class="column column-40">
                    <label>Container Name</label>
                </div>
                <div class="column">
                    <label>Holding</label>
                </div>
                <div class="column">
                    <label>Weight</label>
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
                            <h4 calc="container-holding">0</h4>
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
                            <label>Reference URL</label>
                            <input type="url" saveas="container_url" onclick="select()">

                            <label>Max Weight</label>
                            <input calc="container-max" type="number" step="0.25" saveas="container_max_weight">
                        </div>
                        <div class="column">
                            <label>Additional Notes</label>
                            <textarea saveas="container_notes"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <? if ($mode == "edit") { ?>
            <div class="row">
                <div class="column">
                    <input type="submit" value="Add" onclick="addRow(this)">
                </div>
            </div>
            <? } ?>
        </div>

        <div class="column column-50">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-gift"></span> Magic Items</h1>
                </div>
            </div>

            <div class="row">
                <div class="column column-30">
                    <label>Slot</label>
                </div>
                <div class="column">
                    <label>Description</label>
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
                        <h4><?=strtoupper($slot)?></h4>
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
                        <label>Reference URL</label>
                        <input type="url" saveas="magic_item_<?=$slot_save[$index]?>_url" onclick="select()">
                    </div>
                        <div class="column">
                        <label>Additional Notes</label>
                        <textarea saveas="magic_item_<?=$slot_save[$index]?>_notes"></textarea>
                    </div>
                </div>
            </div>
            <? } ?>

        </div>
    </div>

    <div class="row">
        <div class="column">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-piggy-bank"></span> Currency</h1>
                </div>
            </div>

            <div class="row" calc="currency">
                <div class="column column-25">
                    <label>Carried</label>
                    <h4 class="calc-result" calc="currency-carried" saveas="final_currency_carried">0</h4>
                </div>
                <div class="column">
                    <label>Copper</label>
                    <input sum="currency-weight" class="narrow" calc="copper-carried" type="number" saveas="copper_carried">
                </div>
                <div class="column">
                    <label>Silver</label>
                    <input sum="currency-weight" class="narrow" calc="silver-carried" type="number" saveas="silver_carried">
                </div>
                <div class="column">
                    <label>Gold</label>
                    <input sum="currency-weight" class="narrow" calc="gold-carried" type="number" saveas="gold_carried">
                </div>
                <div class="column">
                    <label>Platinum</label>
                    <input sum="currency-weight" class="narrow" calc="platinum-carried" type="number" saveas="platinum_carried">
                </div>
            </div>

            <div class="row" calc="currency">
                <div class="column column-25">
                    <label>Stored</label>
                    <h4 class="calc-result" calc="currency-stored" saveas="final_currency_stored">0</h4>
                </div>
                <div class="column">
                    <label>Copper</label>
                    <input class="narrow" type="number" calc="copper-stored" saveas="copper_stored">
                </div>
                <div class="column">
                    <label>Silver</label>
                    <input class="narrow" type="number" calc="silver-stored" saveas="silver_stored">
                </div>
                <div class="column">
                    <label>Gold</label>
                    <input class="narrow" type="number" calc="gold-stored" saveas="gold_stored">
                </div>
                <div class="column">
                    <label>Platinum</label>
                    <input class="narrow" type="number" calc="platinum-stored" saveas="platinum_stored">
                </div>
            </div>

            <div class="row">
                <div class="column column-25">
                    <label>Grand Total</label>
                    <h4 class="calc-result" calc="currency-grand-total">0</h4>
                </div>
                <div class="column">
                    <label>Weight</label>
                    <h4 calc="currency-weight">0</h4>
                    <input type="hidden" ref="currency-weight" weight>
                </div>
            </div>

        </div>
        <div class="column" id="weight">
            <div class="row">
                <div class="column">
                    <h1><span class="glyphicon glyphicon-scale"></span> Weight</h1>
                </div>
            </div>

            <div class="row">
                <input type="hidden" calc="max-dex-weight">
                <input type="hidden" calc="check-penalty-weight">
                <input type="hidden" ref="str-total">
                <input type="hidden" ref="size">
                <div class="column">
                    <label>Total</label>
                    <h4 class="calc-result" calc="total-weight">0</h4>
                </div>
                <div class="column">
                    <label>Misc</label>
                    <input type="number" step="0.25" weight saveas="weight_misc">
                </div>
                <div class="column">
                    <label>Light</label>
                    <h4 calc="weight-light">0</h4>
                </div>
                <div class="column">
                    <label>Medium</label>
                    <h4 calc="weight-medium">0</h4>
                </div>
                <div class="column">
                    <label>Heavy</label>
                    <h4 calc="weight-heavy">0</h4>
                </div>
            </div>

            <div class="row">
                <div class="column column-40">
                    <label>Load Status</label>
                    <h4 calc="weight-status">LIGHT</h4>
                </div>
                <div class="column">
                    <label>Above Head</label>
                    <h4 calc="weight-above">0</h4>
                </div>
                <div class="column">
                    <label>Off Ground</label>
                    <h4 calc="weight-off-ground">0</h4>
                </div>
                <div class="column">
                    <label>Drag / Push</label>
                    <h4 calc="weight-drag">0</h4>
                </div>
            </div>

            <div class="row">
                <div class="column column-20">
                    <label>Strength</label>
                    <h4 calc="weight-strength">0</h4>
                </div>
                <div class="column column-20">
                    <label>Bonus</label>
                    <input type="number" calc="weight-strength-bonus" saveas="weight_strength_bonus">
                </div>
                <div class="column column-30">
                    <label>Size</label>
                    <h4 calc="weight-current-size">Medium</h4>
                </div>
                <div class="column column-30">
                    <label>Legs</label>
                    <select calc="weight-legs">
                        <option value="2" selected="selected">Biped</option>
                        <option value="4">Quadruped</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <h1><span class="glyphicon glyphicon-fire"></span> Casting</h1>

    <div id="casting-class" class="entries" savetype="columns">
        <div class="spaced">
            <div class="row">
                <? foreach(array('str', 'dex', 'con', 'wis', 'int', 'cha') as $type) { ?>
                <input type="hidden" ref="<?=$type?>-mod">
                <? } ?>
                <div class="column column-20">
                    <label>Caster Class</label>
                    <select saveas="casting_class" calc="casting-class-name"></select>
                </div>
                <div class="column">
                    <label>Level</label>
                    <h4 calc="casting-class-level" saveas="final_casting_class_level">1</h4>
                </div>
                <div class="column">
                    <label>Ability</label>
                    <select saveas="casting_modifier" calc="casting-class-attribute">
                        <option value="str">STR</option>
                        <option value="dex">DEX</option>
                        <option value="con">CON</option>
                        <option value="int" selected="selected">INT</option>
                        <option value="wis">WIS</option>
                        <option value="cha">CHA</option>
                    </select>
                </div>
                <div class="column">
                    <label>Modifier</label>
                    <h4 calc="casting-class-mod" saveas="casting_class_mod">1</h4>
                </div>
                <div class="column">
                    <label>Concen</label>
                    <h4 calc="casting-concentration" saveas="final_concentration"></h4>
                </div>
                <div class="column">
                    <label>Points</label>
                    <input type="number" saveas="casting_points">
                </div>
                <div class="column">
                    <label>Close</label>
                    <h4 calc="casting-range-close">25ft</h4>
                </div>
                <div class="column">
                    <label>Medium</label>
                    <h4 calc="casting-range-medium">100ft</h4>
                </div>
                <div class="column">
                    <label>Long</label>
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
                    <label>Caster Type</label>
                    <select saveas="caster_type">
                        <option value="divine">Divine</option>
                        <option value="arcane">Arcane</option>
                        <option value="other">Other</option>
                    </select>

                    <label>Notes</label>
                    <textarea saveas="spells_notes" style="min-height: 39rem"></textarea>
                </div>
                <? for($i = 0; $i < 10; $i++) { ?>
                <div class="column">
                    <label class="squeeze">Lv<?=$i?> / Day</label>
                    <h4 calc="spells-<?=$i?>-day-total" saveas="spells_<?=$i?>_per_day">0</h4>

                    <label>Class</label>
                    <input type="number" sum="spells-<?=$i?>-day" saveas="spells_<?=$i?>_day">

                    <label>Bonus</label>
                    <input type="number" sum="spells-<?=$i?>-day" saveas="spells_<?=$i?>_bonus">

                    <label>Misc</label>
                    <input type="number" sum="spells-<?=$i?>-day" saveas="spells_<?=$i?>_bonus">

                    <label>&nbsp;</label>

                    <label class="squeeze">Lv<?=$i?> Known</label>
                    <input type="number" saveas="spells_<?=$i?>_known">

                    <label>&nbsp;</label>

                    <label>Lv<?=$i?> DC</label>
                    <h4 calc="spell-dc">10</h4>
                </div>
                <? } ?>
            </div>
        </div>
    </div>

    <? if ($mode == "edit") { ?>
    <div class="row">
        <div class="column">
            <input type="submit" value="Add" onclick="addRow(this)">
        </div>
    </div>
    <? } ?>

    <div class="row">
        <? for($i = 0; $i < 2; $i++) { ?>
        <div class="column">
            <div class="row">
                <div class="column">
                    <label>Caster Attributes</label>
                </div>
            </div>

            <div class="entries" savetype="columns">
                <div class="row">
                    <div class="column column-33">
                        <select saveas="caster_attr_<?=$i?>_type">
                            <option value="bloodline">Bloodline</option>
                            <option value="patron">Patron</option>
                            <option value="domain">Domain</option>
                            <option value="subdomain">Subdomain</option>
                            <option value="specialty">Specialty</option>
                            <option value="focused">Focused</option>
                            <option value="prohibited">Prohibited</option>
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
                    <input type="submit" value="Add" onclick="addRow(this)">
                </div>
            </div>
            <? } ?>

        </div>
        <? } ?>
    </div>

    <h1><span class="glyphicon glyphicon-list-alt"></span> Spell List</h1>

    <div class="row">
        <div class="column">
            <label>Lv</label>
        </div>
        <div class="column">
            <label>Prep</label>
        </div>
        <div class="column">
            <label>Used</label>
        </div>
        <div class="column column-20">
            <label>Name</label>
        </div>
        <div class="column column-15">
            <label>School</label>
        </div>
        <div class="column column-10">
            <label>Duration</label>
        </div>
        <div class="column column-10">
            <label>Range</label>
        </div>
        <div class="column column-10">
            <label>Save</label>
        </div>
        <div class="column column-5">
            <label>SR</label>
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
                    <input type="number" class="narrow" saveas="spell_list_prep">
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
                        <option value="fortitude">FORT</option>
                        <option value="reflex">REF</option>
                        <option value="will" selected>WILL</option>
                    </select>
                </div>
                <div class="column column-5">
                    <input type="checkbox" saveas="spell_list_sr">
                </div>
                <div class="column column-15" align="right">
                    <input type="submit" value="+" onclick="revealMore(this)">
                    <? if ($mode == "edit") { ?>
                    <input type="submit" value="⇑" onclick="moveUpRow(this)">
                    <input type="submit" value="⇓" onclick="moveDownRow(this)">
                    <input type="submit" value="X" onclick="deleteRow(this)">
                    <? } ?>
                </div>
            </div>
            <div class="row reveal">
                <div class="column column-30">
                    <div class="row">
                        <div class="column column-70">
                            <label>Caster Class</label>
                            <select calc="spell-caster-class-name" saveas="spell_list_class_name"></select>
                        </div>
                        <div class="column">
                            <label>DC</label>
                            <h4 calc="spell-list-dc" saveas="spell_list_dc">10</h4>
                        </div>
                    </div>
                    <label>Reference URL</label>
                    <input type="url" onclick="select()" saveas="spell_list_ref">
                </div>
                <div class="column">
                    <label>Additional Notes</label>
                    <textarea style="min-height: 11.3rem;" saveas="spell_list_notes"></textarea>
                </div>
            </div>
        </div>
    </div>

    <? if ($mode == "edit") { ?>
    <div class="row">
        <div class="column">
            <input type="submit" value="Add" onclick="addRow(this)">
        </div>
    </div>
    <? } ?>

    <h1><span class="glyphicon glyphicon-file"></span> Notes</h1>
    <div class="row">
        <? for($i = 1; $i < 4; $i++) { ?>
        <div class="column">
            <label>Title</label>
            <input type="text" class="strong" saveas="notes_<?=$i?>_header">
            <label>Contents</label>
            <textarea saveas="notes_<?=$i?>_contents" style="min-height: 50rem"></textarea>
        </div>
        <? } ?>
    </div>

    <div class="row">
        <div class="column column-20">
            <label>Link</label>
        </div>
        <div class="column">
            <label>URL</label>
        </div>
        <div class="column">
            <label>Title<label>
        </div>
        <div class="column">
            <label>Notes<label>
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
            <input type="submit" value="Add" onclick="addRow(this)">
        </div>
    </div>
    <? } ?>


</div>
<? if ($mode == "edit") { ?>
<script type="text/javascript" src="/js/edit.js"></script>
<? } ?>
<script type="text/javascript" src="/js/sheet.js"></script>
