
<!-- ANCORA DA SISTEMARE BENE -->

<?php   
    // Avvio della sessione
    session_start();

    // Controlo se vi è già una sessione in corso per quell'utente
    if(!isset($_SESSION['_username'])) 
    {
        header("Location: login.php");
        exit;
    }

    // Connessione al DB
    $conn = mysqli_connect("127.0.0.1", "root", "", "Homework1") or die("ERRORE: ".mysqli_connect_error());
?>

<html>

    <head>
        <meta charset="utf-8">
        <title> Sonia's Recipes - HOME </title>
        <link rel="stylesheet" href="./Style/home.css">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        <script src="./Scripts/home.js" defer="true"> </script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="icon" type="image/png" href="./Images/IconaSito.png">
    </head>

    <body>

        <nav>
            <div id="nome_sito"> Sonia's Recipes </div>
            <ul id="menu">
                <?php
                // Id utente
                $id = mysqli_real_escape_string($conn, $_SESSION["_user_id"]);
                // Creo la query
                $query = "SELECT * FROM users WHERE id = '$id'";
                $res = mysqli_query($conn, $query);
                // Controllo risposta
                if(mysqli_num_rows($res) > 0)
                {
                    $result = mysqli_fetch_assoc($res);
                    echo "<li> <a href='ricettario.php'> Ricettario di ".$result["username"]."</a> </li>"; // Sistema con possibilità di visualizzare le ricette preferite (in un'altra pagina)
                }
                ?>
                <li> <a href="profile.php"> Profilo </a> </li>
                <li> <a id="logout" href="logout.php"> LOGOUT </a> </li>
            </ul>
            <div id="menu_icon" onclick="toggleMobileMenu(this)">
                <div class="bar1"> </div>
                <div class="bar2"> </div>
                <div class="bar3"> </div>
                <ul class="menu_mobile">
                    <?php
                    // Id utente
                    $id = mysqli_real_escape_string($conn, $_SESSION["_user_id"]);
                    // Creo la query
                    $query = "SELECT * FROM users WHERE id = '$id'";
                    $res = mysqli_query($conn, $query);
                    // Controllo risposta
                    if(mysqli_num_rows($res) > 0)
                    {
                        $result = mysqli_fetch_assoc($res);
                        echo "<li> <a href='ricettario.php'> Ricettario di ".$result["username"]."</a> </li>"; // Sistema con possibilità di visualizzare le ricette preferite (in un'altra pagina)
                    }
                    ?>
                    <li> <a href="profile.php"> Profilo </a> </li>
                    <li> <a id="logout" href="logout.php"> LOGOUT </a> </li>
                </ul>
            </div>
        </nav>

        <section id="contents">
                <!-- CARICAMENTO DINAMICO DEI CONTENUTI -->
        </section>


        <!-- INSERIRE PARTE DI RICERCA DI UNA CANZONE DA METTERE CON PLAY NELLA PAGINA STESSA (o meno) --> 

        
        <footer>
            Sgarrata Sonia 1000001075
        </footer>

    </body>

</html>