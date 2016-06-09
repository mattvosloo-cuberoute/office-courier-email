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

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $clientdata['id'] = $row['customer_id'];
        $clientdata['name'] = $row['firstname'] . ' ' . $row['lastname'];
        $clientdata['newsletter'] = $row['newsletter'];
    }
} else {
    echo 'No Client Found';
    return;
}

$sql = "SELECT * FROM `oc_order` WHERE `customer_id` = '" . $clientdata['id'] ."' AND order_status_id < 3";
echo $sql;

$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $i = 0;
    while($row = $result->fetch_assoc()) {
        //var_dump($row);
        $order_data[$i]['order_id'] = $row['order_id'];
        $order_data[$i]['total'] = $row['total'];
        $order_data[$i]['telephone'] = $row['telephone'];
        $i++;
    }
} else {
    echo 'No Orders Found';
    return;
}

$db->close();

$order_tpl = "<form action='send.php' method='post' ><table class='order-list'><tr><td></td><td>Order ID</td><td>Telephone</td><td>Total</td><td>Select Order</td></tr>";
foreach($order_data as $order) {
    $order_tpl .= "<tr>";
    $order_tpl .= "<td><input type='radio' name='id' value='".$order['order_id']."' /><input type='hidden' name='name' value='".$clientdata['name']."' /><input type='hidden' name='template' value='".$template."' /><input type='hidden' name='email' value='".$email."' /></td><td>".$order['order_id']."</td><td>".$order['telephone']."</td><td>R".$order['total']."</td>";
    $order_tpl .= "</tr>";
}
$order_tpl .= "<tr><td colspan='4'></td><td><input type='submit' value='Send'></td></tr></form></table>";

echo $order_tpl;

?>