<?php
    //Salvare e visualizzare le modifiche apportate

    // Avvio della sessione
    session_start();

    // Connessione al DB
    $conn = mysqli_connect("127.0.0.1", "root", "", "Homework1") or die("ERRORE: ".mysqli_connect_error());

    // Prendo l'id della sessione che corrisponde all'id dell'utente
    $id = mysqli_real_escape_string($conn, $_SESSION["_user_id"]);

    // Controllo cosa è stato modificato
    if(isset($_POST["new_nome"])) 
    {
        $new_nome =  mysqli_real_escape_string($conn, $_POST["new_nome"]);

        // Creo la query
        $query = "UPDATE users SET nome = '$new_nome' WHERE id = '$id'";

        $res = mysqli_query($conn, $query);

        if(!$res) 
        {
            $error = "Modifica del nome fallita";
        }
    }
    else if(isset($_POST["new_cognome"])) 
    {
        $new_cognome =  mysqli_real_escape_string($conn, $_POST["new_cognome"]);

        $query = "UPDATE users SET cognome = '$new_cognome' WHERE id = '$id'";

        $res = mysqli_query($conn, $query);

        if(!$res) 
        {
            $error = "Modifica del cognome fallita";
        }
    }
    else if(isset($_POST["new_username"])) 
    {
        if(strlen($_POST["new_username"]) > 16) 
        {
            $error = "Inserire max 16 caratteri";
        }
        else
        {
            if(!preg_match('/[a-zA-Z0-9_]{1,15}/', $_POST['new_username'])) 
            {
                $error = "Username non valido";
            } 
            else
            { 
                $new_username =  mysqli_real_escape_string($conn, $_POST["new_username"]);

                $query = "UPDATE users SET username = '$new_username' WHERE id = '$id'";

                $res = mysqli_query($conn, $query);

                if(!$res) 
                {
                    $error = "Modifica dell'username fallita";
                }
            }
        }
    }
    else if(isset($_POST["new_email"]))
    {
        if (!filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL)) 
        {
            $error = "Email non valida";
        } 
        else 
        {
            $new_email = mysqli_real_escape_string($conn, strtolower($_POST['new_email'])); //permette di inserire l'email anche MAIUSC

            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            
            if (mysqli_num_rows($res) > 0) 
            {
                $error = "Email già utilizzata";
            }
            else
            {
                $query = "UPDATE users SET email = '$new_email' WHERE id = '$id'";

                $res = mysqli_query($conn, $query);

                if(!$res) 
                {
                    $error = "Modifica del'email fallita";
                }
            }
        }
    }
    else if(isset($_POST["new_psw"]))
    {
        if (strlen($_POST["new_psw"]) < 8) 
        {
            $error = "Inserire min 8 caratteri";
        } 
        else
        {
            $new_psw =  mysqli_real_escape_string($conn, $_POST["new_psw"]);
            $new_psw = password_hash($new_psw, PASSWORD_BCRYPT); // la rendo non visibile nel database

            $query = "UPDATE users SET password = '$new_psw' WHERE id = '$id'";

            $res = mysqli_query($conn, $query);

            if(!$res) 
            {
                $error = "Modifica della password fallita";
            }
        }
    }

?>

<html>

    <head>
        <meta charset="utf-8">
        <title> Sonia's Recipes - PROFILE </title>
        <link rel="stylesheet" href="./Style/profile.css">
        <script src="./Scripts/profile.js" defer="true"> </script> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="./Images/IconaSito.png">
    </head>

    <body>
        <section class="credentials">
            <h1> Benvenuto sul tuo profilo! </h1>
            <?php

                if (isset($error)) 
                {
                    echo "<span class='error'> $error </span>"; // visualizzo l'eventuale errore
                }
                
                $query = "SELECT * FROM users where id = '$id'";

                $res = mysqli_query($conn, $query);

                if(mysqli_num_rows($res) > 0) 
                {
                    $result = mysqli_fetch_assoc($res);

                    // Visualizzazione info utente
                    echo "<section class='mod'>",
                     "<p> Nome: ".$result["nome"]."<button id='mod_nome'> Modifica </button> <form method='post' id='nome'>  </form> </p>",
                     "<p> Cognome: ".$result["cognome"]."<button id='mod_cognome'> Modifica </button> <form method='post' id='cognome'>  </form> </p>",
                     "<p> Username: ".$result["username"]."<button id='mod_username'> Modifica </button> <form method='post' id='username'>  </form> </p>",
                     "<p> Email: ".$result["email"]."<button id='mod_email'> Modifica </button> <form method='post' id='email'>  </form> </p>",
                     // echo "<p> Password: ".$result["password"]."</p>",  // comparirebbe criptata, inutile
                     "<p> Password: <button id='mod_psw'> Modifica password </button> <form method='post' id='password'>  </form> </p>",
                     "</section>";
                }

            ?>           

            <section class="buttonContainer">
                <a id="backHome" href="home.php"> Torna alla Home </a>
            </section>

        </section>
        
    </body>

</html>