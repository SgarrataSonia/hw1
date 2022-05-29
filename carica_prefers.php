<?php
    // Avvio della sessione
    session_start();

    if(isset($_SESSION["_username"])) {
        
        // Connessione al DB
        $conn = mysqli_connect("127.0.0.1", "root", "", "Homework1") or die(mysqli_error($conn));

        $userid = mysqli_real_escape_string($conn, $_SESSION["_user_id"]);

        // Creazione query
        $query = "SELECT * FROM prefers WHERE userId = $userid";
        $res = mysqli_query($conn, $query);

        $array = array();
        while($result = mysqli_fetch_assoc($res)) 
        {
            array_push($array, $result);
        }

        echo json_encode($array);
    }
    
?>