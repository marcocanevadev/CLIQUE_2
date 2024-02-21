
<?php
  session_start();
  include "../common/connection.php";
  include "../common/funzioni.php";

  $pass = $_POST["pwd"];
  $passc = $_POST["pwdc"];
  $email = $_POST["email"];

  print_r($pass);
  print_r($passc);

  if ($pass != $passc){
    session_destroy();
    
    header('location:../frontend/signUp.php');    
  } else{
    $user=registrazione($cid, $email, $pass);
    if ($user != 1){
      session_destroy();
      header('location:../frontend/signUp.php');
    } else {
      $_SESSION["logged"]=true;
      $_SESSION["email"]=$email;
      $_SESSION["pass"]=$pass;
  
      // si noti che l'uso delle sessioni permette di evitare passaggi di parametri
      header('location:../frontend/welcome.php');
    }

  }
  

?>