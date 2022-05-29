<?php 

    session_start();

    if(isset($_SESSION["_username"])) {

        // Connessione al DB
        $conn = mysqli_connect("127.0.0.1", "root", "", "Homework1") or die("ERRORE: ".mysqli_connect_error());

        // Creazione query
        $query = "SELECT * FROM contents";
        $res = mysqli_query($conn, $query);

        // Creo un array di array
        $contents_array = array();

        while($risultato = mysqli_fetch_assoc($res)) {
            array_push($contents_array, $risultato);
        }
    
        // Conversione a json
        echo json_encode($contents_array);
        
    }
?>