<?php
  session_start();
  include "../common/connection.php";
  include "../common/funzioni.php";

  $email = $_SESSION["email"];

  $text = $_POST['commento'];
  $grad = $_POST['indice_gradimento'];
  $post = $_POST['post_id'];
  $mail_post = $_POST['mail_poster'];
  $text=str_replace("'","\\'",$text);

  $grad = (int)$grad;
  
 
  $res = createComment($cid, $post, $text, $email, $grad);



  setScore($cid, $mail_post);
  

  if ($res == null){
    header('location:../frontend/homie.php?status=ko');
  }else{
    header('location:../frontend/homie.php?status=ok');
  }
  //queri sul db dove estrai la password 
  //print_r($cid);

   
?>