<?
// Setup
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
$_SESSION['last_activity'] = time();

// Require
require_once("config.php");
require_once("util.php");

// Language
$l = array();
$lang_path = 'inc/lang/' . $config['language'] . '.php';
if (!file_exists($lang_path)) {
    $lang_path = 'inc/lang/en.php'; // Default to english
}
require_once($lang_path);
$lang = $l;

// Check Config
if (!check_config($config)) {
    include('inc/header.php');
    include('inc/install.php');
    include('inc/footer.php');
    die();
}

// Database Connection
$link = mysqli_connect(
    $config['sql_server'],
    $config['sql_user'],
    $config['sql_password']
) or die("Error connecting to database.  Check your config.php file.");

// Create database if necessary
$query = "CREATE DATABASE IF NOT EXISTS " . $config['sql_database'];
$result = mysqli_query($link, $query);
mysqli_select_db($link, $config['sql_database']);

// Check Install
$query = "SHOW TABLES LIKE '" . $config['sql_table'] . "'";
$result = mysqli_query($link, $query);
$is_installed = mysqli_num_rows($result) > 0;

// Always run this
update($link);

// Security
if (!$_SESSION['token'])
    $_SESSION['token'] = md5(uniqid(rand(), true));

$token = $_SESSION['token'];
$ip = $_SERVER['REMOTE_ADDR'];

if ($_SESSION['permission'])
    $permission = $_SESSION['permission'];
else
    $permission = 0;

$is_god = $permission == 1000;
$is_gm = $permission >= 100;
$is_user = $permission == 10;
$is_guest = $permission == 0;



// Get
$mode = $_GET['mode'];
$info = $_GET['info'];

if ($mode == "v") $mode = "view"; // Alias
if ($mode == "e") $mode = "edit"; // Alias
if ($mode == "c") $mode = "compact"; // Alias

// Sheet Id
if ($mode == "edit")
    $edit_id = $info;
if ($mode == "view")
    $view_id = $info;
if ($mode == "compact")
    $view_id = $info;

// Process Mode
if ($mode == "p") {
    include('inc/process.php');
    die();
}

if ($mode == "compact") {
    include("inc/compact.php");
    die();
}

if ($mode == "gmc") {
    if ($is_gm) {
        include("inc/gmc.php");
        die();
    }
    else
        $mode = "login";
}

// Header
include('inc/header.php');

// Install mode
if (!$is_installed)
    $mode = "install";

// Navigate
switch($mode) {
    case "reset":
        include("inc/forgot.php");
    break;

    case "install":
        if (!$is_installed)
            include("inc/install.php");
        else
            include("inc/login.php");
    break;

    case "edit":
        if (!$is_guest)
            include('inc/sheet.php');
        else
            include('inc/login.php');
    break;

    case "view":
        include('inc/sheet.php');
    break;

    case "gm":
        if ($is_gm)
            include('inc/gm.php');
        else
            include('inc/login.php');
    break;

    case "god":
        if ($is_god)
            include('inc/god.php');
        else
            include('inc/login.php');
    break;

    case "user":
        if (!$is_guest)
            include('inc/user.php');
        else
            include('inc/login.php');
    break;

    case "all":
        if ($is_gm)
            include('inc/gm.php');
        else
            include('inc/login.php');
    break;

    default:
        if ($is_god)
            include('inc/god.php');
        else if ($is_gm)
            include('inc/gm.php');
        else if ($is_user)
            include('inc/user.php');
        else
            include('inc/login.php');
    break;
}

// Footer
include('inc/footer.php');

// Functions
function update($link) {
    // Remove character zip file if it's expired.
    $filename = "characters_json.zip";
    if (file_exists($filename)) {
        $filetime = filemtime($filename);
        if ($filetime < time() - 60 * 5)
            unlink($filename);
    }

    global $is_installed;
    if (!$is_installed)
        return;

    // < Backwards Compatability >
    // This is probably not efficient but this is not a huge web application so whatever
    global $config;

    # Version 1.0.XX -> 1.2.00
    // Ensure an admin account exists
    $query = "SELECT * FROM `" . $config['sql_users'] . "` WHERE permission='1000'";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 0) {
        $passwordhash = password_hash($config['email'], PASSWORD_DEFAULT);
        $query = "INSERT INTO `" . $config['sql_users'] . "` (id, name, permission, pass) VALUES('3', 'admin', '1000', '$passwordhash')";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
    }

    // Ensure characters have campaign column
    $query = "SHOW COLUMNS FROM `" . $config['sql_table'] . "` LIKE 'campaign';";
    $result = mysqli_query($link, $query);
    $hasCampaign = mysqli_num_rows($result) > 0;
    if (!$hasCampaign) {
        $query = "ALTER TABLE `" . $config['sql_table'] . "` ADD 'campaign' 'VARCHAR(128)'";
        $result = mysqli_query($link, $query);
    }

    // Update characters that have campaign set to 0
    $query = "
        UPDATE `" . $config['sql_table'] . "`
        SET campaign='1'
        WHERE campaign='0'";
    $result = mysqli_query($link, $query);

    // Make sure the default campaign exists
    $query = "SELECT * FROM `" . $config['sql_campaigns'] . "` WHERE id='1'";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO `" . $config['sql_campaigns'] . "` (name, date, id, password) VALUES('Default', now(), 1, '')";
        $result = mysqli_query($link, $query);
    }
}

?>
