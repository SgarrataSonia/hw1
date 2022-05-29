<?php
    
    // Avvio della sessione
    session_start();

    // Controlo se vi è già una sessione in corso per quell'utente
    if(isset($_SESSION["_username"])) {
        header("Location: home.php");
    }

    // Controllo inserimento delle credenziali
    if (isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["username"]) && isset($_POST["email"]) && 
        isset($_POST["password"]) && isset($_POST["conf_psw"]))
    {
        // Array errori
        $error = array();

        // Connessione al DB
        $conn = mysqli_connect('127.0.0.1', 'root', "", 'homework1') or die("ERRORE: ".mysqli_connect_error());
        
        // Controlla che l'username rispetti il pattern specificato
        if(strlen($_POST["username"]) > 16) 
        {
            $error[] = "Max caratteri superato";
        }
        else
        {
            if(!preg_match('/[a-zA-Z0-9_]{1,16}/', $_POST['username'])) 
            {
                $error[] = "Username non valido";
            } 
            else 
            {
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                // Cerco se l'username esiste già
                $query = "SELECT username FROM users WHERE username = '$username'";
                $res = mysqli_query($conn, $query);
                if (mysqli_num_rows($res) > 0) {
                    $error[] = "Username già utilizzato";
                }
            }
        }
        
        // Controllo password
        if (strlen($_POST["password"]) < 8) 
        {
            $error[] = "Caratteri password insufficienti";
        } 
        if (strcmp($_POST["password"], $_POST["conf_psw"]) != 0) 
        {
            $error[] = "Le password non coincidono";
        }
        
        // Controllo email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        {
            $error[] = "Email non valida";
        } 
        else 
        {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email'])); //permette di inserire l'email anche MAIUSC
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }

        // Registrazione dei dati nel DB
        if (count($error) == 0) {
            $nome = mysqli_real_escape_string($conn, $_POST['nome']);
            $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT); // la rendo non visibile nel database

            // Inserimento
            $query = "INSERT INTO users(nome, cognome, username, email, password) VALUES('$nome', '$cognome', '$username', '$email', '$password')";
            
            if (mysqli_query($conn, $query)) {
                // Creazione sessione
                $_SESSION["_username"] = $_POST["username"];
                $_SESSION["_user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php"); // Reindirizzamento alla home
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
      
?>

<html>
    <head>
        <link rel='stylesheet' href='./Style/login.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <script src='./Scripts/signup.js' defer="true"></script>
        <title> Sonia's Recipes - SIGNUP </title>
        <link rel="icon" type="image/png" href="./Images/IconaSito.png">
    </head>

    <body>
        <main class="registraUtente">
            <section class="form_registra">
                <h1> REGISTRATI: </h1>

                <form name='registra' method='post' autocomplete="off">

                    <div class="names"> 

                        <div class="nome"> 
                            <div> <label for='nome'> Nome </label> </div>
                            <div> <input type='text' name='nome'> </div>
                            <span> </span>
                        </div>

                        <div class="cognome"> 
                            <div> <label for='cognome'> Cognome </label> </div>
                            <div> <input type='text' name='cognome'> </div>
                            <span> </span>
                        </div>

                    </div>
                    
                    <div class="username"> 
                        <div> <label for='username'> Nome utente </label> </div>
                        <div> <input type='text' name='username'> </div>
                        <div id="dimMax"> Max 16 caratteri </div>
                        <span> </span>
                    </div>

                    <div class="email"> 
                        <div> <label for='email'> Email </label> </div>
                        <div> <input type='text' name='email'> </div>
                        <span> </span>
                    </div>

                    <div class="password"> 
                        <div> <label for='password'> Password </label> </div>
                        <div> <input type='text' name='password'> </div>
                        <div id="dimMax"> Min 8 caratteri </div>
                        <span> </span>
                    </div>

                    <div class="conferma_psw"> 
                        <div> <label for='conf_psw'> Conferma password </label> </div>
                        <div> <input type='text' name='conf_psw'> </div>
                        <span> </span>
                    </div>

                    <div class="registrati">
                        <input type='submit' id="submit" value="Registrati">
                    </div>

                </form>

                <!-- link per passare alla pagina login !-->
                <div class="registrer">  Hai già un account? <a href="login.php"> Accedi </a> </div>

            </section>
        </main>
    </body>
</html>