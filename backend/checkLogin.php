
<?php
  session_start();
  include "../common/connection.php";
  include "../common/funzioni.php";

  $pass = $_POST["pwd"];
  $email = $_POST["email"];
  //queri sul db dove estrai la password 
  $user=authentication($cid, $email);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    session_destroy();

    header('location:../index.php?err=0');
  }
  

  if ($pass == ""){
    
    session_destroy();

    header('location:../index.php?err=1');
  }

  if ( $email == ""){
    
    session_destroy();

    header('location:../index.php?err=2');
  }


if ($email==$user['content']['mail'] && $pass== $user['content']['password'])

  if ($email==$user['content']['mail'] && $pass== $user['content']['password'])
   {
	 $_SESSION["logged"]=true;
	 $_SESSION["email"]=$email;
	 $_SESSION["pass"]=$pass;
	 // si noti che l'uso delle sessioni permette di evitare passaggi di parametri
     header('location:../frontend/homie.php?first=1');    
  }else{

	  // se l'operazione di login non è andata a buon fine, do notifica all'utente e 
      // elimino la sesssione di lavoro. 	  
	  session_destroy();

    header('location:../index.php?err=3');
  }
?>