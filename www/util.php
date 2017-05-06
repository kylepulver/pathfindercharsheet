<?
// Generate a random string
function random_string($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// Ensure config has all entries
function check_config($config) {
    foreach($config as $entry) {
        if ($entry == "") return false;
    }
    return true;
}
// For language support
function say($string) {
    global $lang;
    if (empty($lang[$string])) {
        return "%?%";
    }
    return $lang[$string];
}
?>
