<?
// Setup
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
$_SESSION['last_activity'] = time();

// Require
require_once("config.php");
require_once("util.php");

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
    $config['sql_password'],
    $config['sql_database']
) or die("Error connecting to database.  Check your config.php file.");

// Check Install
$query = "SHOW TABLES LIKE '" . $config['sql_table'] . "'";
$result = mysqli_query($link, $query);
$is_installed = mysqli_num_rows($result) > 0;

// Security
if (!$_SESSION['token'])
    $_SESSION['token'] = md5(uniqid(rand(), true));

$token = $_SESSION['token'];
$ip = $_SERVER['REMOTE_ADDR'];

if ($_SESSION['permission'])
    $permission = $_SESSION['permission'];
else
    $permission = 0;

$is_gm = $permission == 100;
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
        if ($is_gm)
            include('inc/gm.php');
        else if ($is_user)
            include('inc/user.php');
        else
            include('inc/login.php');
    break;
}

// Footer
include('inc/footer.php');

?>
