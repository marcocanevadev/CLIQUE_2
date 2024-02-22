<?php
  session_start();
  include "../common/connection.php";
  include "../common/funzioni.php";

  $email = $_SESSION["email"];

  if (isBlocked($cid,$email)){
    header('location:../frontend/homie.php?status=ko');
  }

  $text = $_POST['commento'];

  $text=str_replace("'","\\'",$text);

  $grad = $_POST['indice_gradimento'];
  $post = $_POST['post_id'];
  $mail_post = $_POST['mail_poster'];


  $num_comm = numComm($cid, $email, $post);
  $liked = liked($cid, $email, $post);

  if ($num_comm > 6){
    header('location:../frontend/homie.php?status=ko');
  }

  if ($liked or $grad == 0){
    echo "ciao";
    $grad = 'NULL';
  }

  
 
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