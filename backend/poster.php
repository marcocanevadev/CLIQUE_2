
<?php
  session_start();
  include "../common/connection.php";
  include "../common/funzioni.php";

  $email = $_SESSION["email"];
  if (isBlocked($cid,$email)){
    header('location:../frontend/homie.php?status=ko');
  }
  $text = $_POST['testo'];
  $text=str_replace("'","\\'",$text);

  $res = createTextPost($cid, $email, $text);

  if ($res == null){
    header('location:../frontend/homie.php?status=ko');
  }else{
    header('location:../frontend/homie.php?status=ok');
  }
  //queri sul db dove estrai la password 
  //print_r($cid);

   
?>