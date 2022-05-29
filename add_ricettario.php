<?php 

    // Avvio della sessione
    session_start();

    // Connessione al DB
    $conn = mysqli_connect("127.0.0.1", "root", "", "Homework1") or die("ERRORE: ".mysqli_connect_error());

    $userid = mysqli_real_escape_string($conn, $_SESSION["_user_id"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $image = mysqli_real_escape_string($conn, $_POST["immagine"]);
    $titolo = mysqli_real_escape_string($conn, $_POST["titolo"]);
    $descrizione = mysqli_real_escape_string($conn, $_POST["descrizione"]);

    // Creazione query
    $query = "INSERT INTO prefers VALUES($userid, $id, '$image', '$titolo', '$descrizione')";
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