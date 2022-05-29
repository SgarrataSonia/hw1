<?php
    // Avvio della sessione
    session_start();

    // Connessione al DB
    $conn = mysqli_connect("127.0.0.1", "root", "", "Homework1") or die("ERRORE: ".mysqli_connect_error());

    $userid = mysqli_real_escape_string($conn, $_SESSION["_user_id"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    // Creazione query
    $query = "DELETE FROM prefers WHERE userId = $userid AND id = $id";
    $res = mysqli_query($conn, $query);

    if($res) 
    {
        $response = array('esito' => true);
    } 
    else 
    {
        $response = array('esito' => false);
    }

    echo json_encode($response);
    
    mysqli_close($conn);
?>