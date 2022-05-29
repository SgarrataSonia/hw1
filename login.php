<?php

    // Avvio della sessione
    session_start();

    // Controlo se vi è già una sessione in corso per quell'utente
    if(isset($_SESSION['_username'])) 
    {
        header("Location: home.php");
        exit;
    }

    // Verifica del login utente ed eventuale reindirizzamento alla home
    if (isset($_POST["username"]) && isset($_POST["password"]) ) //se username e password sono stati inseriti
    {
        // Connessione al DB
        $conn = mysqli_connect("127.0.0.1", "root", "", "Homework1") or die("ERRORE: ".mysqli_connect_error()); 

        // Preparazione: creo stringhe utilizzabili in SQL
        $username = mysqli_real_escape_string($conn, $_POST['username']); 
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Creazione query
        $query = "SELECT * FROM users WHERE username = '$username'";

        // Esecuzione
        $res = mysqli_query($conn, $query) or die("ERRORE: ".mysqli_connect_error());

        if (mysqli_num_rows($res) > 0) {  // controllo il numero di righe restituite nel result set

            // Ritorna una sola riga perchè ho un solo utente con quel username
            $result = mysqli_fetch_assoc($res); // ho così un array associativo

            if (password_verify($_POST['password'], $result['password'])) { // controllo se le due password coincidono

                // Imposto una sessione dell'utente
                $_SESSION["_username"] = $result['username'];
                $_SESSION["_user_id"] = $result['id'];
                header("Location: home.php"); // reindirizzamento alla home
                mysqli_free_result($res); // rilascio dello spazio occupato dai risultati ottenuti
                mysqli_close($conn); // chiusura della connessione al DB
                exit;
            }
        }
        // Se l'utente non è stato trovato o la password non ha passato la verifica
        $error = "USERNAME e/o PASSWORD errati";
    } 

?>

<html>
    
    <head>
        <link rel='stylesheet' href='./Style/login.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Sonia's Recipes - LOGIN </title>
        <link rel="icon" type="image/png" href="./Images/IconaSito.png">
    </head>

    <body>
        <main class="loginUtente">
            <section class="form_login">
                <h1> BENTORNATO! </h1>

                <!-- parte di php per la visualizzazione errori -->
                <?php
                if (isset($error)) 
                {
                    echo "<span class='error'> $error </span>";
                }
                ?>

                <form name='login' method='post'>

                    <div class="username"> 
                        <div> <label for='username'> Nome utente </label> </div>
                        <div> <input type='text' name='username'> </div>
                    </div>

                    <div class="password"> 
                        <div> <label for='password'> Password </label> </div>
                        <div> <input type='password' name='password' id='password'> </div>
                        <div> <input type='button' onclick='showPassword()' value="Mostra/Nascondi" class="show"> </div>
                        <script>
                            function showPassword() {
                                let input = document.getElementById('password');
                                if(input.type === "password") {
                                    input.type = "text";
                                }
                                else {
                                    input.type = "password";
                                }
                            }
                        </script>
                    </div>

                    <div class="accedi">
                        <input type='submit' id="submit" value="Accedi">
                    </div>

                </form>

                <!-- link per passare alla pagina register -->
                <div class="signup"> Non hai un account? <a href="signup.php"> Iscriviti </a> </div>

            </section>

        </main>

    </body>

</html>