<?php /*Office Courier Mailer*/

require("db.php");

$order_id = $_POST['order_id'];
$template = $_POST['template'];

$type = $_POST['template'];

$sql = "SELECT * FROM `oc_order` WHERE `order_id` = '" . $order_id ."'";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //var_dump($row);
        $order_data['name'] = $row['firstname'] . ' ' . $row['lastname'];
        $order_data['email'] = $row['email'];
        $order_data['telephone'] = $row['telephone'];
        $order_data['delivery_name'] = $row['shipping_firstname'] . ' ' . $row['shipping_lastname'];
        if($row['shipping_company']) $order_data['address']['company'] = "<strong>".$row['shipping_company']."</strong>";
        if($row['shipping_address_1']) $order_data['address']['address_1'] = $row['shipping_address_1'];
        if($row['shipping_address_2']) $order_data['address']['address_2'] = $row['shipping_address_2'];
        if($row['shipping_city']) $order_data['address']['city'] = $row['shipping_city'];
        if($row['shipping_postcode']) $order_data['address']['postcode'] = $row['shipping_postcode'];
        if($row['shipping_zone']) $order_data['address']['province'] = $row['shipping_zone'];
        if($row['shipping_country']) $order_data['address']['country'] = $row['shipping_country'];
    }
} else {
    echo 'No Order Found';
    return;
}

$order_data['full_address'] = implode("<br>", $order_data['address']);

$db->close();

?>
<html>
    <head>
        <title>ePETstore Delivery Emailer</title>
        <meta name="description" content="Creates delivery emails for ePET">
        
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <h1>ePETstore Delivery Emailer</h1>
            <h2>Delivery Type: <span style="color: red;"><?php echo $type; ?></span></h2>
            <h4>Check Customer Info</h4>
        </header>
        <content>
            <table class="order_details">
                <tr>
                    <td>Order ID:</td><td><?php echo $order_id; ?></td>
                </tr>
                <tr>
                    <td>Name:</td><td><?php echo $order_data['delivery_name']; ?></td>
                </tr>
                <tr>
                    <td>Telephone:</td><td><?php echo $order_data['telephone']; ?></td>
                </tr>
                <tr>
                    <td>Email:</td><td><?php echo $order_data['email']; ?></td>
                </tr>
                <?php if($template != 'clickncollect') { ?>
                <tr>
                    <td>Address:</td><td><?php echo $order_data['full_address']; ?></td>
                </tr>
                <?php } ?>
            </table>
            <form action="send.php" method="post">
                <input type='hidden' name='id' value='<?php echo $order_id; ?>' />
                <input type='hidden' name='name' value='<?php echo $order_data['delivery_name']; ?>' />
                <input type='hidden' name='template' value='<?php echo $template; ?>' />
                <input type='hidden' name='email' value='<?php echo $order_data['email']; ?>' />
                <input type='hidden' name='full_address' value='<?php echo $order_data['full_address']; ?>' />
                <?php if($template == 'courierguy') { ?>
                <div class="input">
                    
                    <input name="waybill" type="text" placeholder="Waybill Number" />
                    <label for="waybill">Waybill Number</label>
                </div>
                <?php } ?>
                <div class="input">
                    <input type="submit" value="Send Email" />
                </div>
            </form>
        </content>
        <footer>
        </footer>
    </body>
</html>