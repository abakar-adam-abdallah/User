<?php
require "function.php";

$select = new Select();

if (isset($_SESSION["id"])) {
 $user = $select->selectUserById($_SESSION["id"]);
    
}
else{
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index</title>
    </head>
    <body>
        <h1>Welcome <?php echo $user["name"] ;?></h1>

        <a href="logouth.php">Login</a>

        
    </body>
</html>