<?
// Core Config

// The domain or full url that will host this thing.
// Example: "http://mydomainname.com"
$config['domain']       = "http://pathfinder.dev";

// The location of the mySQL database server.
// Example: "localhost";
$config['sql_server']   = "localhost";

// The username to use to log into the database server.
// Example: "randysavage"
$config['sql_user']     = "pathfinder";

// The password to use to log into the database server.
// Example: "funkylikeamonkey"
$config['sql_password'] = "password";

// The name of the database to use.
// Example: "pfcharsheet"
$config['sql_database'] = "pfcharsheet";

// The name of the table for the character sheets.
// Example: "pf_chars"
$config['sql_table']    = "pf_chars";

// The name of the table for the usernames and passwords.
// Example: "pf_users"
$config['sql_users']    = "pf_users";

// The name of the table for password reset tokens.
// Example "pf_reset"
$config['sql_reset']    = "pf_reset";

// The email to send all password reset requests to
// Example "hello@gmail.com"
$config['email']        = "pulverk@gmail.com";



// Dev mode
// DO NOT SET THIS TO TRUE WHEN LIVE!!  Risky business.
$is_dev = true;

?>
