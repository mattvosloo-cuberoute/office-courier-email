<?php /*Check Page*/

$servername = "localhost";
$username = "root";
$password = "Dragon101";
$dbname = "epet_testdb";

$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$email = $_POST['email'];
$template = $_POST['template'];

$sql = "SELECT * FROM `oc_customer` WHERE `email` = '" . $email ."'";

$result = $db->query($sql);

$client_data = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $clientdata['name'] = $row['firstname'] . ' ' . $row['lastname'];
        $clientdata['newsletter'] = $row['newsletter'];
    }
} else {
    echo 'No Client Found';
    return;
}

$templateUrl = "template-" . $template . ".html";

$tpl = file_get_contents($templateUrl);
$tpl = str_replace('{{name}}', $clientdata['name'], $tpl);
$tpl = str_replace('{{order}}', $clientdata['newsletter'], $tpl);

echo $tpl;

//var_dump($clientdata);

$db->close();

?>