<?php /*Office Courier Mailer*/


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
            <h4>Enter the Order ID and Select the Delivery Type</h4>
        </header>
        <content>
            <form action="information.php" method="post">
                <div class="input">
                    <input name="order_id" type="number" placeholder="Order ID" required />
                    <label for="email">Order ID</label>
                </div>
                <div class="input">
                    <select name="template" >
                        <option value="epetstore" >ePETstore Delivery</option>
                        <option value="courierguy" selected >Courier Guy Delivery</option>
                        <option value="clickncollect" >Click-n-Collect</option>
                    </select>
                    <label for="email">Delivery Type</label>
                </div>
                <div class="input">
                    <input type="submit" value="Submit" />
                </div>
            </form>
        </content>
        <footer>
        </footer>
    </body>
</html>