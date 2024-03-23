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
  $reference = $_POST['reference'];

  $num_comm = numComm($cid, $email, $post);
  $liked = liked($cid, $email, $post);

  

  if ($liked or $grad == 0){
    echo "ciao";
    $grad = 'NULL';
  }


  //$num_comm = 0;
  //$liked = false;
  if ($num_comm >= 5){
    echo "hello";
    
    header('location:../frontend/homie.php?status=ko');
    $res = null;
  }else{
    $res = createComment($cid, $post, $text, $email, $grad);
    setScore($cid, $mail_post);
  }
  
  $comment_id = findCommentID($cid, $post, $text);
  referenceComment($cid, $reference, $comment_id);

  
  
 
  //$res = createComment($cid, $post, $text, $email, $grad);



  //setScore($cid, $mail_post);
  

  if ($res == null){
    header('location:../frontend/homie.php?status=ko');
  }else{
    header('location:../frontend/homie.php?status=ok');
  }
  //queri sul db dove estrai la password 
  //print_r($cid);

   
?>