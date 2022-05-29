
<!-- Pagina per la visualizzazione delle ricette a cui l'utente ha messo mi piace -->

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
        <title> Sonia's Recipes - FAVORITE RECIPES </title>
        <link rel="stylesheet" href="./Style/ricettario.css"> 
        <script src="./Scripts/fav_recipes.js" defer="true"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="./Images/IconaSito.png">
    </head>

    <body>
        <div id="preferiti">

            <h1> Ricette a cui hai messo mi piace: </h1>
                
            <div id="div_prefers">
                <!-- Visualizzazione dinamica delle ricette che un utente ha aggiunto nel ricettario -->
            </div>
            
            <a id="backHome" href="home.php"> Torna alla Home </a>
        </div>

        <section>
            <div id="music">
                <form id="search">
                    Cerca un brano da ascoltare mentre cucini:
                    <input type="text" id="song">
                    <input type="submit" id="submit" value="Cerca brano">
                </form>

                <div id="results">
                    <!-- Visualizzazione dei risultati della ricerca -->
                </div>
            </div>
        </section>

    </body>
</html>