<?php /*Office Courier Mailer*/


?>
<html>
    <head>
        <title>ePETstore Delivery Emailer</title>
        <meta name="description" content="Creates delivery emails for ePET">
        
        <link href="css/style.css" type="text/css" />
    </head>
    <body>
        <header>
            <h1>ePETstore Delivery Emailer</h1>
        </header>
        <content>
            <form action="check.php" method="post">
                <div class="input">
                    <input name="email" type="email" placeholder="Customer Email" />
                    <label for="email">Customer Email</label>
                </div>
                <div class="input">
                    <select name="template" >
                        <option value="ontheway" selected >Delivery is on the way</option>
                    </select>
                    <label for="email">Customer Email</label>
                </div>
                <div class="input">
                    <input type="submit" value="Send" />
                </div>
            </form>
        </content>
        <footer>
        </footer>
    </body>
</html>