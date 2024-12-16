<?php

    session_start();
    if (isset($_POST['rendben']))
    {
        $email = htmlspecialchars($_POST["email"]);
        $jelszo = $_POST["jelszo"];
        $jelszo = sha1($jelszo);

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $hiba = "Hibás email vagy jelszó";
        }
        else
        {
            /*sikeres belépés esetén
            if($email == "idk@gmail.com" && sha1($jelszo) == "c8f2c36bcdaae7e404560e4759c46542ebe32211")
            {
                $_SESSION["belepett"] = true;
                header("Loaction: felvitel.php");
            }
            else
            {
                $hiba = "Hibás email vagy jelszó";
            }
            */

            require "../connect.php";
            $sql = "SELECT * FROM felhasznalo WHERE email = '{$email}' AND jelszo = '{$jelszo}'";

            $eredmeny = mysqli_query($dbconn, $sql);
            //ha sikeres
            if (!isset($_REQUEST['id'])) header("Location: lista.php");
            else
            {
                $hiba = "Hibás email és jelszó";
            }

        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Belépés</h1>
    
    <form method="post">
        <?php
            if (isset($hiba))
            {
                print $hiba;
            }
        ?>
        <p><label for="email">Email</label></p>
        <input type="email" name="email" id="email">
        <p><label for="jelszo">Jelszó</label></p>
        <input type="password" name="jelszo" id="jelszo">

        <input type="submit" name="rendben" value="Belépés">
    </form>
    
</body>
</html>