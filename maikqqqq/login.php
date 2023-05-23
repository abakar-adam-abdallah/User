<?php
require "function.php";
if(isset($_SESSION["id"])){
    header("location: index.php");

}
$login = new Login();
if(isset($_POST["submit"])){
    $result = $login->login($_POST["usernameemail"], $_POST["password"]);
    if ($result == 1) {
        $_SESSION["login"] = true;
        $_SESSION["id"] = $login->idUser();
        header("location: index.php");
        // echo 
        // "<script>  alert('Inscrivez-vous avec succès'); </script>";  
    }
    elseif ($result == 10) {
        echo 
        "<script>  alert('Nom d'utilisateur ou email déjà pris'); </script>";  
    }
    elseif ($result == 100) {
        echo "<script>  alert('Le mot de passe ne correspond pas'); </script>";  
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylee.css">
        <title>login</title>
    </head>
    <body>
        <section>
            <div id="ho">

                <h1>S'identifier</h1>
                <form action="login.php" method="post" autocomplete="off">
                    <input type="text" name="usernameemail" placeholder="Votre adresse email ou prenom " required> 
                    <input type="password" name="password" placeholder="Mot de passe " required> 
                    <button type="submit" name="submit">S'identifier</button>
                    <p class="grey">Dèja sur Zara ? <a href="registration.php">Connectez-vous</a>.</p>
                </form>
            </div>

        </section>
    </body>
</html>
