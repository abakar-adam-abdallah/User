<?php
require "function.php";
if(isset($_SESSION["id"])){
    header("location: index.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylee.css">
    <title>resgistration</title>
</head>
    <body>
        <section>
            <div id="ho">
            
         

                <h1>S'inscrire</h1>
                <?php

                    $register = new Register();
                    if(isset($_POST["submit"])){
                        $result = $register->registration($_POST["name"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["confirmpassword"]);
                        if ($result == 1) {
                            echo "ienvenue chez nous! Votre inscription est confirmée!"; 
                            // "<script>  alert('Bienvenue chez nous! Votre inscription est confirmée!'); </script>";  
                        }
                        elseif ($result == 10) {
                            echo "Nom d'utilisateur ou email déjà pris";
                            // "<script>  alert('Nom d'utilisateur ou email déjà pris'); </script>";  
                        }
                        elseif ($result == 100) {
                            echo "e mot de passe ne correspond pas";
                            // "<script>  alert('Le mot de passe ne correspond pas'); </script>";  
                        }
                    }
                ?>
                <form class="" action="registration.php" method="post" autocomplete="off">
                    <input type="text"    name="name" placeholder="Votre nom " required/> 
                    <input type="text"    name="username" placeholder="Votre prenom " required/> 
                    <input type="email"   name="email" placeholder="Votre adresse email " required/> 
                    <input type="password"name="password" placeholder="Mot de passe " required/> 
                    <input type="password"name="confirmpassword" placeholder="Retapez votre mot de passe" required/> 
                    <button type="submit" name="submit">S'inscrire</button>
                    <p class="grey">Première visite sur Zara ? <a href="login.php">Inscrivez-vous</a>.</p>
                </form>
            </div>

        </section>
    </body>
</html>
