<?
// Everything here is AJAXed or whatever.
$mode = $_POST['mode'];

// I don't know why I did all these if statements but sometimes we make strange choices in life.
if ($mode == 'create')
    createNew($link);

if ($mode == 'save')
    save($link);

if ($mode == 'load')
    load($link);

if ($mode == 'login')
    login($link);

if ($mode == 'logout')
    logout($link);

if ($mode == 'delete')
    delete_row($link);

if ($mode == 'install')
    install($link);

if ($mode == 'rolz')
    rolz($link);

if ($mode == 'sheet_type')
    sheet_type($link);

if ($mode == 'forgot')
    forgot($link);

if ($mode == 'new_password')
    new_password($link);

if ($mode == 'retire')
    retire($link);

if ($mode == 'restore')
    restore($link);

if ($mode == 'zip_export')
    zip_export($link);

if ($mode == 'health')
    health($link);

if ($mode == 'ping')
    ping($link);

if ($mode == 'add_campaign')
    add_campaign($link);

if ($mode == 'delete_campaign')
    delete_campaign($link);

if ($mode == 'update_campaigns')
    update_campaigns($link);

if ($mode == 'set_campaign')
    set_campaign();

if ($mode == 'change_campaign')
    change_campaign($link);

if ($mode == "campaign_passkey")
    campaign_passkey($link);

function verify_token() {
    if ($_SESSION['token'] != $_POST['token']) die("-");
}

function campaign_passkey($link) {
    verify_token();
    global $config;
    global $is_gm;

    if (!$is_gm) die("-");

    $passkey = mysqli_real_escape_string($link, $_POST['passkey']);
    $id = mysqli_real_escape_string($link, $_POST['id']);

    $query = "SELECT password FROM `" . $config['sql_campaigns'] . "`WHERE id='$id' LIMIT 1";
    $result = mysqli_query($link, $query);
    $campaign_passkey = mysqli_fetch_assoc($result)['password'];

    // I'm only storing these as plaintext because who cares
    // This app should be used amongst of trusted friends, not internet randos
    // and this is just to access campaign characters, not credit card info or whatever
    if ($passkey == $campaign_passkey) {
        $_SESSION['campaign_access'][$id] = true;
        echo(true);
    }
    else {
        echo(false);
    }
}

function change_campaign($link) {
    verify_token();
    global $config;
    global $is_gm;

    if (!$is_gm) die("-");

    $campaign_id = mysqli_real_escape_string($link, $_POST['campaign']);
    $id = mysqli_real_escape_string($link, $_POST['id']);

    $query = "UPDATE `" . $config['sql_table'] . "` SET campaign='$campaign_id' WHERE id='$id' LIMIT 1";
    $result = mysqli_query($link, $query);
}

function set_campaign() {
    verify_token();

    $id = intval($_POST['id']);
    $_SESSION['campaign'] = $id;
    echo($id);
}

function update_campaigns($link) {
    verify_token();
    global $config;
    global $is_god;

    if (!$is_god) die("-");

    $names = $_POST['names'];
    $passwords = $_POST['passwords'];
    foreach($names as $key => $value) {
        $id = mysqli_real_escape_string($link, $key);
        $name = mysqli_real_escape_string($link, $value);
        $password = mysqli_real_escape_string($link, $passwords[$key]); // assume this should be the same key
        if ($id == 1) // dont change default campaign
            continue;

        $query = "UPDATE `" . $config['sql_campaigns'] . "` SET name='$name', password='$password' WHERE id='$id' LIMIT 1";
        $result = mysqli_query($link, $query);
    }

    echo(true);
}

function delete_campaign($link) {
    verify_token();
    global $config;
    global $is_god;

    if (!$is_god) die("-");

    // delete the campaign
    $campaign_id = mysqli_real_escape_string($link, $_POST['id']);
    $query = "DELETE FROM `" . $config['sql_campaigns'] . "` WHERE id=$campaign_id";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    // convert orphaned characters to default campaign
    $query = "
        UPDATE `" . $config['sql_table'] . "`
        SET campaign=1
        WHERE campaign=$campaign_id";

    $result = mysqli_query($link, $query);
    if ($result) echo(true);

    // dont look at deleted campaigns
    $_SESSION['campaign'] = 1;
}

function add_campaign($link) {
    verify_token();
    global $config;
    global $is_god;

    if (!$is_god) die("-");

    $query = "INSERT INTO `" . $config['sql_campaigns'] . "` (name, date, password) VALUES('New Campaign', now(), '')";
    $result = mysqli_query($link, $query);

    $query = "SELECT max(id) FROM `" . $config['sql_campaigns'] . "`";
    $resultid = mysqli_query($link, $query);
    $id = mysqli_fetch_assoc($resultid)['max(id)'];

    $response = array();
    if ($result) {
        $response['message'] = "added";
        $response['id'] = $id;
    }
    else {
        $response['error'] = mysqli_error($link);
    }

    echo(respond($response));
}

function ping($link) {
    // I think this happens in index.php, but just in case
    $_SESSION['last_activity'] = time();
}

function health($link) {
    verify_token();
    global $config;
    global $is_guest;

    if ($is_guest) die("-");
    if ($_POST['editid'] == "") die("-");

    $hp_total = mysqli_real_escape_string($link, $_POST['total']);
    $hp_current = mysqli_real_escape_string($link, $_POST['current']);
    $hp_nonlethal = mysqli_real_escape_string($link, $_POST['nonlethal']);
    $hp_lethal = mysqli_real_escape_string($link, $_POST['lethal']);
    $editid = mysqli_real_escape_string($link, $_POST['editid']);

    $query = "UPDATE `" . $config['sql_table'] . "`SET
        `final_hp_total` = '$hp_total',
        `final_hp_current` = '$hp_current',
        `health_nonlethal` = '$hp_nonlethal',
        `health_lethal` = '$hp_lethal'
        WHERE editid = '$editid'";

    $result = mysqli_query($link, $query);

    $response = array();
    if ($result) {
        $response['message'] = "saved";
    }
    else {
        $response['error'] = mysqli_error($link);
    }

    echo(respond($response));
}

function zip_export($link) {
    verify_token();
    global $config;
    global $is_gm;

    if (!$is_gm) die("-");

    $zip = new ZipArchive();
    $filename = "characters_json.zip";
    if ($zip->open($filename, ZipArchive::CREATE) !== true) {
        die("Can't create zip file.");
    }

    $query = "SELECT * FROM " . $config['sql_table'];
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 0) {
        die(false);
    }

    while($row = mysqli_fetch_assoc($result)) {
        unset($row['id']);
        unset($row['ip']);
        unset($row['date']);
        unset($row['is_retired']);
        unset($row['editid']);
        unset($row['publicid']);
        unset($row['sheet_type']);
        unset($row['campaign']);

        $json = json_encode($row);
        $localname = $row['sheetname'];
        if ($localname == "") $localname = $row['id'];
        $localname .= ".txt";
        $zip->addFromString($localname, $json);
    }
    $zip->close();

    echo($config['domain'] . '/' . $filename);
}

function restore($link) {
    verify_token();
    global $config;
    global $is_gm;

    if (!$is_gm) die("-");

    $id = mysqli_real_escape_string($link, $_POST['id']);
    $query = "UPDATE `" . $config['sql_table']  . "` SET is_retired = '0' WHERE id = '$id'";
    $result = mysqli_query($link, $query);
    if ($result) echo(true);
}

function retire($link) {
    verify_token();
    global $config;
    global $is_gm;

    if (!$is_gm) die("-");

    $id = mysqli_real_escape_string($link, $_POST['id']);
    $query = "UPDATE `" . $config['sql_table']  . "` SET is_retired = '1' WHERE id = '$id'";
    $result = mysqli_query($link, $query);
    if ($result) echo(true);
}

function forgot($link) {
    verify_token();
    global $config;
    global $ip;

    $reset_token = random_string(32);
    $query = "INSERT INTO `" . $config['sql_reset'] . "` (date, reset_token, ip) VALUES (now(), '$reset_token', '$ip')";
    $result = mysqli_query($link, $query);
    $url = $config['domain'] . "/reset/" . $reset_token;

    $to      = $config['email'];
    $subject = 'Pathfinder Character Sheet Password';
    $message = $url;
    $headers = 'From: ' . $config['email'] . "\r\n" .
        'Reply-To: ' . $config['email'] . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    @mail($to, $subject, $message); // Mail is a pain :I

    $data = array();
    $data['message'] = "Check your config email for a link.  (It may be in your spam folder!)";
    echo(respond($data));
}

function new_password($link) {
    verify_token();
    global $config;
    $data = array();

    $reset_token = mysqli_real_escape_string($link, $_POST['reset_token']);
    $pc_password = mysqli_real_escape_string($link, $_POST['pc_password']);
    $gm_password = mysqli_real_escape_string($link, $_POST['gm_password']);
    $admin_password = mysqli_real_escape_string($link, $_POST['admin_password']);
    if ($pc_password == "" && $gm_password == "" && $admin_password == "") {
        $data['error'] = "All fields can't be blank!";
        echo(respond($data));
        return;
    }

    $query = "SELECT * FROM `" . $config['sql_reset'] . "` WHERE reset_token = '$reset_token'";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) != 1) {
        $data['error'] = "Invalid request!";
        echo(respond($data));
        return;
    }

    // todo: fix timezone error :(
    $date_issued = strtotime(mysqli_fetch_assoc($result)['date']);
    if (time() - $date_issued > 60 * 60 * 12) { // 12 hour expiration
        $data['error'] = "Reset token expired!";

        // Clear out password resets
        $query = "TRUNCATE TABLE `" . $config['sql_reset'] . "`";
        $result3 = mysqli_query($link, $query);

        echo(respond($data));
        return;
    }

    if ($pc_password != "") {
        $pc_password_hash = password_hash($pc_password, PASSWORD_DEFAULT);
        $query = "UPDATE `" . $config['sql_users'] . "` SET pass = '$pc_password_hash' WHERE permission=10";
        $result = mysqli_query($link, $query);
    }

    if ($gm_password != "") {
        $gm_password_hash = password_hash($gm_password, PASSWORD_DEFAULT);
        $query = "UPDATE `" . $config['sql_users'] . "` SET pass = '$gm_password_hash' WHERE permission=100";
        $result2 = mysqli_query($link, $query);
    }

    if ($admin_password != "") {
        $admin_password_hash = password_hash($admin_password, PASSWORD_DEFAULT);
        $query = "UPDATE `" . $config['sql_users'] . "` SET pass = '$admin_password_hash' WHERE permission=1000";
        $result2 = mysqli_query($link, $query);
    }

    $data['status'] = true;

    // Clear out password resets
    $query = "TRUNCATE TABLE `" . $config['sql_reset'] . "`";
    $result3 = mysqli_query($link, $query);

    echo(respond($data));
}

function sheet_type($link) {
    verify_token();
    global $is_gm;
    global $config;

    if (!$is_gm) die("-");

    $id = mysqli_real_escape_string($link, $_POST['id']);
    $type = mysqli_real_escape_string($link, $_POST['type']);
    $query = "UPDATE `" . $config['sql_table'] . "` SET sheet_type = '$type' WHERE id='$id'";
    $result = mysqli_query($link, $query);
}

function delete_row($link) {
    verify_token();
    global $is_gm;
    global $config;

    if (!$is_gm) die("-");

    $id = mysqli_real_escape_string($link, $_POST['id']);

    $query = "SELECT * FROM `" . $config['sql_table'] . "` WHERE id = '$id' AND is_retired = '1'";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 0) {
        echo(false);
    }
    else {
        $query = "DELETE FROM `" . $config['sql_table'] . "` WHERE id = '$id'";
        $result = mysqli_query($link, $query);
        if ($result) echo(true);
    }
}

function login($link) {
    verify_token();
    global $config;

    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);

    $query = "SELECT * FROM " . $config['sql_users'] . " WHERE name = '$username'";
    $result = mysqli_query($link, $query);
    if (!$result) die(mysqli_error($link));
    $data = mysqli_fetch_assoc($result);
    $hash = $data['pass'];

    if (password_verify($password, $hash)) {
        // Login
        $permission = $data['permission'];
        $_SESSION['permission'] = $permission;
        if ($permission >= 100) {
            // GM and Admins have campaign choice
            $_SESSION['campaign'] = 1;
            $_SESSION['campaign_access'] = array();
        }
        echo(true);
    }
    else {
        echo(false);
    }
}

function logout($link) {
    $_SESSION['permission'] = 0;
    $permission = 0;
    session_destroy();
}

function save($link) {
    verify_token();
    global $config;
    global $ip;
    global $is_guest;

    if ($is_guest) die("-");
    if ($_POST['editid'] == "") die("-");

    $data = $_POST['data'];

    $blacklist = array( // Forbidden fields to change by players
        'id', 'publicid', 'editid', 'ip', 'sheet_type', 'is_retired', 'date', 'campaign'
    );

    $editid = mysqli_real_escape_string($link, $_POST['editid']);

    $query = "UPDATE `" . $config['sql_table'] . "` SET ";
    $data['ip'] = $ip;
    foreach($data as $key => $value) {
        if ($value == '')
            continue;

        if (in_array($key, $blacklist))
            continue;

        $key = mysqli_real_escape_string($link, $key);
        $type = mysqli_real_escape_string($link, $_POST['type'][$key]);
        $value = mysqli_real_escape_string($link, $value);
        if ($value == "%%%%")
            $query .= "`" . $key . "` = '', ";
        else
            $query .= "`" . $key . "` = '" . $value . "', ";

        global $is_dev;
        if ($is_dev) {
            createColumnIfNeeded($link, $key, $type);
        }
    }
    $query = substr($query, 0, -2);
    $query .= " WHERE editid='" . $editid . "'";  // Sometimes I concat, other times I dont.  I dunno.
    $result = mysqli_query($link, $query);

    $response = array();
    if ($result) {
        $response['message'] = "saved";
    }
    else {
        $response['error'] = mysqli_error($link);
    }

    echo(respond($response));
}

function load($link) {
    verify_token();
    global $config;

    $editid = mysqli_real_escape_string($link, $_POST['editid']);
    $viewid = mysqli_real_escape_string($link, $_POST['viewid']);

    if ($editid != "") {
        $query = "SELECT * FROM `" . $config['sql_table'] . "` WHERE editid = '$editid'";
    }
    else {
        $query = "SELECT * FROM `" . $config['sql_table'] . "` WHERE publicid = '$viewid'";
    }
    $result = mysqli_query($link, $query);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 0) die("-");

    $data['domain'] = preg_replace('#^https?://#', '', $config['domain']);

    echo(respond($data));
}

function createColumnIfNeeded($link, $name, $type = 'VARCHAR(128)') {
    global $config;

    $name = mysqli_real_escape_string($link, $name);
    $type = mysqli_real_escape_string($link, $type);

    $result = mysqli_query($link, "SHOW COLUMNS FROM `" . $config['sql_table'] . "` LIKE '$name'") or die(mysqli_error($link));
    $exists = mysqli_num_rows($result) > 0;
    if (!$exists) {
        $result = mysqli_query($link, "ALTER TABLE `" . $config['sql_table'] . "` ADD $name $type") or die(mysqli_error($link));
    }
}

function createNew($link) {
    verify_token();
    global $ip;
    global $config;

    $edit_id = random_string(32);
    $view_id = random_string(6);

    $result = mysqli_query($link, "SELECT * FROM `" . $config['sql_table'] . "` WHERE publicid = '$view_id'");
    while(mysqli_num_rows($result) > 0) {
        $view_id = random_string();
        $result = mysqli_query($link, "SELECT * FROM `" . $config['sql_table'] . "` WHERE publicid = '$view_id'");
    }

    $result = mysqli_query($link, "SELECT * FROM `" . $config['sql_table'] . "` WHERE editid = '$edit_id'");
    while(mysqli_num_rows($result) > 0) {
        $edit_id = random_string();
        $result = mysqli_query($link, "SELECT * FROM `" . $config['sql_table'] . "` WHERE editid = '$edit_id'");
    }

    $result = mysqli_query($link, "INSERT INTO `" . $config['sql_table'] . "` (date, publicid, editid, ip, campaign) VALUES (now(), '$view_id', '$edit_id', '$ip', '1')");

    if ($result) {
        $id = mysqli_insert_id($link);
        $result = mysqli_query($link, "SELECT * FROM `" . $config['sql_table'] . "` WHERE id = '$id'");
        $data = mysqli_fetch_assoc($result);
    }
    else {
        $data['error'] = mysqli_error($link);
    }

    $data['domain'] = preg_replace('#^https?://#', '', $config['domain']);

    echo(respond($data));
}

function rolz($link) {
    verify_token();

    $roll = $_POST['roll'];
    $url = "https://rolz.org/api/?" . urlencode($roll) . ".json";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    $content = curl_exec($ch);
    curl_close($ch);
    echo($content);
}

function respond($data) {
    array_walk($data,function(&$item){$item=strval($item);});
    return json_encode($data);
}

function install($link) {
    global $config;
    global $is_installed;
    $data = array();

    if ($is_installed)
        return;

    $pc_username = mysqli_real_escape_string($link, $_POST['pc_username']);
    $gm_username = mysqli_real_escape_string($link, $_POST['gm_username']);
    $admin_username = mysqli_real_escape_string($link, $_POST['admin_username']);
    $pc_password = mysqli_real_escape_string($link, $_POST['pc_password']);
    $gm_password = mysqli_real_escape_string($link, $_POST['gm_password']);
    $admin_password = mysqli_real_escape_string($link, $_POST['admin_password']);
    if ($pc_username == "" || $pc_password == "" || $gm_username == "" || $gm_password == "" || $admin_password == "" || $admin_username == "") {
        $data['error'] = "Fill out all the fields!";
        echo(respond($data));
        return;
    }
    $names = array($pc_username, $gm_username, $admin_username);
    if (count($names) !== count(array_unique($names))) { // fancy way to check if all names are unique
        $data['error'] = "Can't use the same name for multiple logins!";
        echo(respond($data));
        return;
    }

    // That's a lot of columns!!
    $query = "
        CREATE TABLE `" . $config['sql_table'] . "` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `publicid` varchar(256) NOT NULL,
            `editid` varchar(256) NOT NULL,
            `ip` varchar(128) NOT NULL,
            `date` datetime NOT NULL,
            `campaign` int(11) NOT NULL,
            `sheetname` varchar(128) DEFAULT NULL,
            `charname` varchar(128) DEFAULT NULL,
            `playername` varchar(128) DEFAULT NULL,
            `alignment` varchar(128) DEFAULT NULL,
            `size` varchar(128) DEFAULT NULL,
            `skill_name` text,
            `skill_ability` text,
            `skill_trained` text,
            `skill_ranks` text,
            `skill_misc` text,
            `armor_dodge` varchar(128) DEFAULT NULL,
            `armor_deflect` varchar(128) DEFAULT NULL,
            `cmb_ability` varchar(128) DEFAULT NULL,
            `experience_rate` varchar(128) DEFAULT NULL,
            `gear_quantity_carried` text,
            `gear_uses_carried` text,
            `casting_modifier` text,
            `spells_0_bonus` text,
            `spells_1_bonus` text,
            `spells_2_bonus` text,
            `spells_3_bonus` text,
            `spells_4_bonus` text,
            `spells_5_bonus` text,
            `spells_6_bonus` text,
            `spells_7_bonus` text,
            `spells_8_bonus` text,
            `spells_9_bonus` text,
            `caster_attr_0_type` text,
            `caster_attr_1_type` text,
            `spell_list_save` text,
            `spell_list_sr` text,
            `str_base` varchar(128) DEFAULT NULL,
            `dex_base` varchar(128) DEFAULT NULL,
            `con_base` varchar(128) DEFAULT NULL,
            `wis_base` varchar(128) DEFAULT NULL,
            `int_base` varchar(128) DEFAULT NULL,
            `cha_base` varchar(128) DEFAULT NULL,
            `casting_points` text,
            `spells_0_day` text,
            `casting_class` text,
            `spells_notes` text,
            `spells_0_known` text,
            `spells_1_day` text,
            `spells_1_known` text,
            `spells_2_day` text,
            `spells_2_known` text,
            `spells_3_day` text,
            `spells_3_known` text,
            `spells_4_day` text,
            `spells_4_known` text,
            `spells_5_day` text,
            `spells_5_known` text,
            `spells_6_day` text,
            `spells_6_known` text,
            `spells_7_day` text,
            `spells_7_known` text,
            `spells_8_day` text,
            `spells_8_known` text,
            `spells_9_day` text,
            `spells_9_known` text,
            `copper_carried` varchar(128) DEFAULT NULL,
            `silver_carried` varchar(128) DEFAULT NULL,
            `gold_carried` varchar(128) DEFAULT NULL,
            `platinum_carried` varchar(128) DEFAULT NULL,
            `race` varchar(128) DEFAULT NULL,
            `deity` varchar(128) DEFAULT NULL,
            `homeland` varchar(128) DEFAULT NULL,
            `gender` varchar(128) DEFAULT NULL,
            `age` varchar(128) DEFAULT NULL,
            `weight` varchar(128) DEFAULT NULL,
            `height` varchar(128) DEFAULT NULL,
            `hair` varchar(128) DEFAULT NULL,
            `eyes` varchar(128) DEFAULT NULL,
            `skin` varchar(128) DEFAULT NULL,
            `known_languages` varchar(128) DEFAULT NULL,
            `health_base` varchar(128) DEFAULT NULL,
            `health_temp` varchar(128) DEFAULT NULL,
            `health_misc` varchar(128) DEFAULT NULL,
            `health_lethal` varchar(128) DEFAULT NULL,
            `health_nonlethal` varchar(128) DEFAULT NULL,
            `health_conditions` varchar(128) DEFAULT NULL,
            `str_level` varchar(128) DEFAULT NULL,
            `str_race` varchar(128) DEFAULT NULL,
            `str_enhance` varchar(128) DEFAULT NULL,
            `str_damage` varchar(128) DEFAULT NULL,
            `str_drain` varchar(128) DEFAULT NULL,
            `str_age` varchar(128) DEFAULT NULL,
            `str_misc` varchar(128) DEFAULT NULL,
            `dex_level` varchar(128) DEFAULT NULL,
            `dex_race` varchar(128) DEFAULT NULL,
            `dex_enhance` varchar(128) DEFAULT NULL,
            `dex_damage` varchar(128) DEFAULT NULL,
            `dex_drain` varchar(128) DEFAULT NULL,
            `dex_age` varchar(128) DEFAULT NULL,
            `dex_misc` varchar(128) DEFAULT NULL,
            `con_level` varchar(128) DEFAULT NULL,
            `con_race` varchar(128) DEFAULT NULL,
            `con_enhance` varchar(128) DEFAULT NULL,
            `con_damage` varchar(128) DEFAULT NULL,
            `con_drain` varchar(128) DEFAULT NULL,
            `con_age` varchar(128) DEFAULT NULL,
            `con_misc` varchar(128) DEFAULT NULL,
            `wis_level` varchar(128) DEFAULT NULL,
            `wis_race` varchar(128) DEFAULT NULL,
            `wis_enhance` varchar(128) DEFAULT NULL,
            `wis_damage` varchar(128) DEFAULT NULL,
            `wis_drain` varchar(128) DEFAULT NULL,
            `wis_age` varchar(128) DEFAULT NULL,
            `wis_misc` varchar(128) DEFAULT NULL,
            `int_level` varchar(128) DEFAULT NULL,
            `int_race` varchar(128) DEFAULT NULL,
            `int_enhance` varchar(128) DEFAULT NULL,
            `int_damage` varchar(128) DEFAULT NULL,
            `int_drain` varchar(128) DEFAULT NULL,
            `int_age` varchar(128) DEFAULT NULL,
            `int_misc` varchar(128) DEFAULT NULL,
            `cha_level` varchar(128) DEFAULT NULL,
            `cha_race` varchar(128) DEFAULT NULL,
            `cha_enhance` varchar(128) DEFAULT NULL,
            `cha_damage` varchar(128) DEFAULT NULL,
            `cha_drain` varchar(128) DEFAULT NULL,
            `cha_age` varchar(128) DEFAULT NULL,
            `cha_misc` varchar(128) DEFAULT NULL,
            `favored_class` varchar(128) DEFAULT NULL,
            `class_name` text,
            `class_levels` text,
            `class_bab` text,
            `class_skill` text,
            `class_hpbonus` text,
            `class_fortitude` text,
            `class_reflex` text,
            `class_will` text,
            `class_url` text,
            `class_notes` text,
            `feat_name` text,
            `feat_notes` text,
            `special_name` text,
            `special_uses` text,
            `special_used` text,
            `special_notes` text,
            `armor_natural` varchar(128) DEFAULT NULL,
            `armor_misc` varchar(128) DEFAULT NULL,
            `armor_temp` varchar(128) DEFAULT NULL,
            `armor_name` varchar(128) DEFAULT NULL,
            `armor_armor_ac` varchar(128) DEFAULT NULL,
            `armor_armor_enhance` varchar(128) DEFAULT NULL,
            `armor_armor_penalty` varchar(128) DEFAULT NULL,
            `armor_armor_spellfail` varchar(128) DEFAULT NULL,
            `armor_armor_type` varchar(128) DEFAULT NULL,
            `armor_armor_weight` varchar(128) DEFAULT NULL,
            `shield_name` varchar(128) DEFAULT NULL,
            `armor_shield_ac` varchar(128) DEFAULT NULL,
            `armor_shield_enhance` varchar(128) DEFAULT NULL,
            `armor_shield_penalty` varchar(128) DEFAULT NULL,
            `armor_shield_spellfail` varchar(128) DEFAULT NULL,
            `armor_shield_type` varchar(128) DEFAULT NULL,
            `armor_shield_weight` varchar(128) DEFAULT NULL,
            `armor_notes` varchar(128) DEFAULT NULL,
            `fort_enhance` varchar(128) DEFAULT NULL,
            `fort_misc` varchar(128) DEFAULT NULL,
            `fort_temp` varchar(128) DEFAULT NULL,
            `ref_enhance` varchar(128) DEFAULT NULL,
            `ref_misc` varchar(128) DEFAULT NULL,
            `ref_temp` varchar(128) DEFAULT NULL,
            `will_enhance` varchar(128) DEFAULT NULL,
            `will_misc` varchar(128) DEFAULT NULL,
            `will_temp` varchar(128) DEFAULT NULL,
            `spell_resistance` varchar(128) DEFAULT NULL,
            `damage_resistance` varchar(128) DEFAULT NULL,
            `other_resistance` varchar(128) DEFAULT NULL,
            `weapon_name` text,
            `weapon_attack` text,
            `weapon_damage` text,
            `weapon_critical` text,
            `weapon_range` text,
            `weapon_type` text,
            `weapon_quantity` text,
            `weapon_weight` text,
            `weapon_ref` text,
            `weapon_notes` text,
            `attack_Array_temp` varchar(128) DEFAULT NULL,
            `attack_Array_misc` varchar(128) DEFAULT NULL,
            `cmb_misc` varchar(128) DEFAULT NULL,
            `cmd_misc` varchar(128) DEFAULT NULL,
            `movement_speed` varchar(128) DEFAULT NULL,
            `movement_base` varchar(128) DEFAULT NULL,
            `movement_fly` varchar(128) DEFAULT NULL,
            `movement_swim` varchar(128) DEFAULT NULL,
            `movement_climb` varchar(128) DEFAULT NULL,
            `movement_misc` varchar(128) DEFAULT NULL,
            `experience_points` varchar(128) DEFAULT NULL,
            `experience_prev_goal` varchar(128) DEFAULT NULL,
            `experience_goal` varchar(128) DEFAULT NULL,
            `pool_type` text,
            `pool_used` text,
            `pool_total` text,
            `gear_quantity_description` text,
            `gear_quantity` text,
            `gear_quantity_weight` text,
            `gear_uses_description` text,
            `gear_uses` text,
            `gear_uses_weight` text,
            `magic_item_belt` varchar(128) DEFAULT NULL,
            `magic_item_body` varchar(128) DEFAULT NULL,
            `magic_item_chest` varchar(128) DEFAULT NULL,
            `magic_item_eyes` varchar(128) DEFAULT NULL,
            `magic_item_feet` varchar(128) DEFAULT NULL,
            `magic_item_hands` varchar(128) DEFAULT NULL,
            `magic_item_head` varchar(128) DEFAULT NULL,
            `magic_item_headband` varchar(128) DEFAULT NULL,
            `magic_item_neck` varchar(128) DEFAULT NULL,
            `magic_item_ring` varchar(128) DEFAULT NULL,
            `magic_item_shoulders` varchar(128) DEFAULT NULL,
            `magic_item_wrist` varchar(128) DEFAULT NULL,
            `copper_stored` varchar(128) DEFAULT NULL,
            `silver_stored` varchar(128) DEFAULT NULL,
            `gold_stored` varchar(128) DEFAULT NULL,
            `platinum_stored` varchar(128) DEFAULT NULL,
            `weight_misc` varchar(128) DEFAULT NULL,
            `weight_strength_bonus` varchar(128) DEFAULT NULL,
            `spell_list_class_name` text,
            `caster_attr_0_entry` text,
            `caster_attr_1_entry` text,
            `spell_list_level` text,
            `spell_list_prep` text,
            `spell_list_used` text,
            `spell_list_name` text,
            `spell_list_school` text,
            `spell_list_range` text,
            `spell_list_ref` text,
            `spell_list_notes` mediumtext,
            `notes_1_header` varchar(128) DEFAULT NULL,
            `notes_1_contents` text,
            `notes_2_header` varchar(128) DEFAULT NULL,
            `notes_2_contents` text,
            `notes_3_header` varchar(128) DEFAULT NULL,
            `notes_3_contents` text,
            `gear_quantity_notes` text,
            `gear_uses_notes` text,
            `feat_url` text,
            `feat_more_notes` text,
            `magic_item_feet_url` varchar(128) DEFAULT NULL,
            `magic_item_feet_notes` text,
            `magic_item_ring1` varchar(128) DEFAULT NULL,
            `magic_item_ring1_url` varchar(128) DEFAULT NULL,
            `magic_item_ring1_notes` text,
            `magic_item_ring2` varchar(128) DEFAULT NULL,
            `magic_item_ring2_url` varchar(128) DEFAULT NULL,
            `magic_item_ring2_notes` text,
            `gear_quantity_url` text,
            `gear_uses_url` text,
            `magic_item_belt_url` varchar(128) DEFAULT NULL,
            `magic_item_belt_notes` text,
            `magic_item_body_url` varchar(128) DEFAULT NULL,
            `magic_item_body_notes` text,
            `magic_item_chest_url` varchar(128) DEFAULT NULL,
            `magic_item_chest_notes` text,
            `magic_item_eyes_url` varchar(128) DEFAULT NULL,
            `magic_item_eyes_notes` text,
            `magic_item_hands_url` varchar(128) DEFAULT NULL,
            `magic_item_hands_notes` text,
            `magic_item_head_url` varchar(128) DEFAULT NULL,
            `magic_item_head_notes` text,
            `magic_item_headband_url` varchar(128) DEFAULT NULL,
            `magic_item_headband_notes` text,
            `magic_item_neck_url` varchar(128) DEFAULT NULL,
            `magic_item_neck_notes` text,
            `magic_item_shoulders_url` varchar(128) DEFAULT NULL,
            `magic_item_shoulders_notes` text,
            `magic_item_wrist_url` varchar(128) DEFAULT NULL,
            `magic_item_wrist_notes` text,
            `armor_armor_max_dex` varchar(128) DEFAULT NULL,
            `armor_shield_max_dex` varchar(128) DEFAULT NULL,
            `special_type` text,
            `spell_list_duration` text,
            `special_url` text,
            `str_temp` varchar(128) DEFAULT NULL,
            `dex_temp` varchar(128) DEFAULT NULL,
            `con_temp` varchar(128) DEFAULT NULL,
            `int_temp` varchar(128) DEFAULT NULL,
            `wis_temp` varchar(128) DEFAULT NULL,
            `cha_temp` varchar(128) DEFAULT NULL,
            `final_ac` varchar(128) DEFAULT NULL,
            `final_hp_total` varchar(128) DEFAULT NULL,
            `final_hp_current` varchar(128) DEFAULT NULL,
            `final_touch` varchar(128) DEFAULT NULL,
            `final_flatfoot` varchar(128) DEFAULT NULL,
            `final_fort` varchar(128) DEFAULT NULL,
            `final_ref` varchar(128) DEFAULT NULL,
            `final_will` varchar(128) DEFAULT NULL,
            `final_melee` varchar(128) DEFAULT NULL,
            `final_ranged` varchar(128) DEFAULT NULL,
            `final_cmb` varchar(128) DEFAULT NULL,
            `final_cmd` varchar(128) DEFAULT NULL,
            `final_init` varchar(128) DEFAULT NULL,
            `final_skill` text,
            `sheet_type` varchar(128) DEFAULT NULL,
            `link_url` text,
            `link_title` text,
            `link_notes` text,
            `weapon_attack_type` text,
            `gear__container` text,
            `container_name` text,
            `container_weight` text,
            `container_url` text,
            `container_max_weight` text,
            `container_notes` text,
            `is_retired` tinyint(1) DEFAULT NULL,
            `gear_quantity_container` text,
            `gear_uses_container` text,
            `final_str_total` varchar(128) DEFAULT NULL,
            `final_str_mod` varchar(128) DEFAULT NULL,
            `final_dex_total` varchar(128) DEFAULT NULL,
            `final_dex_mod` varchar(128) DEFAULT NULL,
            `final_con_total` varchar(128) DEFAULT NULL,
            `final_con_mod` varchar(128) DEFAULT NULL,
            `final_int_total` varchar(128) DEFAULT NULL,
            `final_int_mod` varchar(128) DEFAULT NULL,
            `final_wis_total` varchar(128) DEFAULT NULL,
            `final_wis_mod` varchar(128) DEFAULT NULL,
            `final_cha_total` varchar(128) DEFAULT NULL,
            `final_cha_mod` varchar(128) DEFAULT NULL,
            `final_bab` varchar(128) DEFAULT NULL,
            `container_carried` text,
            `final_armor` varchar(128) DEFAULT NULL,
            `final_shield` varchar(128) DEFAULT NULL,
            `final_dex_armor` varchar(128) DEFAULT NULL,
            `final_size_armor` varchar(128) DEFAULT NULL,
            `final_casting_class_level` text,
            `final_concentration` text,
            `spell_list_dc` text,
            `casting_class_mod` text,
            `spells_0_per_day` text,
            `spells_1_per_day` text,
            `spells_2_per_day` text,
            `spells_3_per_day` text,
            `spells_4_per_day` text,
            `spells_5_per_day` text,
            `spells_6_per_day` text,
            `spells_7_per_day` text,
            `spells_8_per_day` text,
            `spells_9_per_day` text,
            `final_currency_carried` varchar(128) DEFAULT NULL,
            `final_currency_stored` varchar(128) DEFAULT NULL,
            `creature_type` varchar(128) DEFAULT NULL,
            `str_size` varchar(128) DEFAULT NULL,
            `dex_size` varchar(128) DEFAULT NULL,
            `con_size` varchar(128) DEFAULT NULL,
            `int_size` varchar(128) DEFAULT NULL,
            `wis_size` varchar(128) DEFAULT NULL,
            `cha_size` varchar(128) DEFAULT NULL,
            `caster_type` text,
            `init_misc` varchar(128) DEFAULT NULL,
            `init_temp` varchar(128) DEFAULT NULL,
            `attack_melee_temp` varchar(128) DEFAULT NULL,
            `attack_melee_misc` varchar(128) DEFAULT NULL,
            `attack_ranged_temp` varchar(128) DEFAULT NULL,
            `attack_ranged_misc` varchar(128) DEFAULT NULL,
            `armor_dex_override` varchar(128) DEFAULT NULL,
            `init_ability` varchar(128) DEFAULT NULL,
            `melee_ability` varchar(128) DEFAULT NULL,
            `ranged_ability` varchar(128) DEFAULT NULL,
            `point_maximum` varchar(128) DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `publicid` (`publicid`),
            UNIQUE KEY `editid` (`editid`)
        ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
        ";

    $result = mysqli_query($link, $query);
    if ($result) $data[0] = "Character sheet table created.";

    $query = "
        CREATE TABLE `" . $config['sql_users'] . "` (
            `id` INT NOT NULL AUTO_INCREMENT ,
            `permission` INT NOT NULL ,
            `name` VARCHAR(256) NOT NULL ,
            `pass` VARCHAR(256) NOT NULL ,
            PRIMARY KEY (`id`)
            ) ENGINE = MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
    ";

    $result2 = mysqli_query($link, $query);
    if ($result2) $data[1] = "User table created.";

    $pc_password_hash = password_hash($pc_password, PASSWORD_DEFAULT);
    $gm_password_hash = password_hash($gm_password, PASSWORD_DEFAULT);
    $admin_password_hash = password_hash($admin_password, PASSWORD_DEFAULT);

    $query = "
        INSERT INTO `" . $config['sql_users'] . "` (permission, name, pass)
        VALUES ('10', '$pc_username', '$pc_password_hash')
    ";

    $result3 = mysqli_query($link, $query);
    if ($result3) $data[2] = "Player login data created.";

    $query = "
        INSERT INTO `" . $config['sql_users'] . "` (permission, name, pass)
        VALUES ('100', '$gm_username', '$gm_password_hash')
    ";

    $result4 = mysqli_query($link, $query);
    if ($result4) $data[3] = "Game master login data created.";

    $query = "
        INSERT INTO `" . $config['sql_users'] . "` (permission, name, pass)
        VALUES ('1000', '$admin_username', '$admin_password_hash')
    ";

    $result5 = mysqli_query($link, $query);
    if ($result5) $data[4] = "Admin login data created.";

    $query = "
        CREATE TABLE IF NOT EXISTS `" . $config['sql_campaigns'] . "` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(128) NOT NULL,
            `date` datetime NOT NULL,
            `password` varchar(128) NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

    $result6 = mysqli_query($link, $query);
    if ($result6) $data[5] = "Campaigns data created.";

    $query = "
        INSERT INTO `" . $config['sql_campaigns'] . "` (name, date, password) VALUES('Default', now(), '')
    ";

    $result7 = mysqli_query($link, $query);
    if ($result7) $data[6] = "Reset password table created.";

    $query = "
        CREATE TABLE `" . $config['sql_reset'] . "` (
            `id` INT NOT NULL AUTO_INCREMENT ,
            `date` DATETIME NOT NULL ,
            `reset_token` VARCHAR(128) NOT NULL ,
            `ip` VARCHAR(128) NOT NULL ,
            PRIMARY KEY (`id`)
        ) ENGINE = MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;";

    $result8 = mysqli_query($link, $query);
    if ($result8) $data[7] = "Reset password table created.";

    $data['status'] = true;
    echo(respond($data));
}
?>
