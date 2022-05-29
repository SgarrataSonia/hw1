<?php
  session_start();

  $conn = mysqli_connect('127.0.0.1', 'root', "", 'homework1') or die("ERRORE: ".mysqli_connect_error());

  $user = mysqli_real_escape_string($conn, $_GET['q']);
  $query = "SELECT username FROM users WHERE username = '$user'";

  $res = mysqli_query($conn, $query);
  if(mysqli_num_rows($res) > 0) 
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