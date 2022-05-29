<?php

    // Distruggo la sessione
    session_start();
    session_destroy();

    // Ritorno alla pagina di login
    header('Location: login.php');
?>