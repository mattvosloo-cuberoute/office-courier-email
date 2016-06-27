<?php /*DB Connection*/

$servername = "sql22.jnb1.host-h.net";
$username = "rpetstorer_1";
$password = "xNh9f2h8";
$dbname = "rpetstorer_db1";

$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

?>