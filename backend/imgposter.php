<?php 
session_start();
include "../common/connection.php";
include "../common/funzioni.php";

$email = $_SESSION["email"];

if (isBlocked($cid,$email)){
  header('location:../frontend/homie.php?status=ko');
}

$file_name= $_FILES['fileToUpload']['name'];
$tmp_name =  $_FILES['fileToUpload']['tmp_name'];

$desc = $_POST['descrizione'];
$location = $_POST['location'];



$desc=str_replace("'","\\'",$desc);

$position= strpos($file_name, ".");
$fileextension= substr($file_name, $position + 1);
$fileextension= strtolower($fileextension);

if (isset($file_name)) {
    $path= '../img/'.$file_name;
}

if (($fileextension !== "jpg") && ($fileextension !== "jpeg") && ($fileextension !== "png") && ($fileextension !== "bmp")) {
      echo "The file extension must be .jpg, .jpeg, .png, or .bmp in order to be uploaded";
}else{
    if (move_uploaded_file($tmp_name, $path)) {
        $tipo="picture";
        echo 'Uploaded!'; 
    }
    else
    {
        $errore["file"]="4";
    }
}
$res = createImgPost($cid, $email, $desc, 'img/', $file_name, $location);

  if ($res == null){
    header('location:../frontend/homie.php?status=ko');
  }else{
    header('location:../frontend/homie.php?status=ok');
  }



/**
 * A questo punto occorre salvare nel db sql la variabile $file_name che contiene il nome del file appena caricato
 * INSERT INTO...
 */



?>