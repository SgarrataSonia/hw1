<?php
  session_start();

  $conn = mysqli_connect('127.0.0.1', 'root', "", 'homework1') or die("ERRORE: ".mysqli_connect_error());

  $email = mysqli_real_escape_string($conn, $_GET['q']);
  $query = "SELECT email FROM users WHERE email = '$email'";

  $res = mysqli_query($conn, $query);
  if(mysqli_num_rows($res) > 0) 
  {
    $response = array('esiste' => true);
  } 
  else 
  {
    $response = array('esiste' => false);
  }

  echo json_encode($response);
  mysqli_close($conn);
?>