<?php
session_start();

require "../common/connection.php";

$mail_amico = $_GET['mail'];
$tipo = $_GET['tipo'];

$mail_user = $_SESSION['email'];


if ($tipo == 'Add'){
    $sql = "INSERT INTO `RICHIESTE` ( `timestamp_richiesta`, `timestamp_accettazione`, `timestamp_fine`, `mail_richiedente`, `mail_accettatore`) 
    VALUES ( current_timestamp(), NULL, NULL, '$mail_user', '$mail_amico');";
    $res = $cid->query($sql);

    if ($res != null){
        header('location:../frontend/friends.php?status=ok');
    }else{
        header('location:../frontend/friends.php?status=ko');
    }
}elseif ($tipo == 'Unfriend'){
    //$sql = " UPDATE `RICHIESTE` SET `timestamp_fine` = current_timestamp()
    $sql = "DELETE FROM RICHIESTE
    WHERE (mail_richiedente = '$mail_user' AND mail_accettatore = '$mail_amico') OR (mail_richiedente = '$mail_amico' AND mail_accettatore = '$mail_user');";
    $res = $cid->query($sql);

    if ($res != null){
        header('location:../frontend/friends.php?status=ok');
    }else{
        header('location:../frontend/friends.php?status=ko');
    }
}elseif ($tipo == 'Accept'){
    $sql = " UPDATE `RICHIESTE` SET `timestamp_accettazione` = current_timestamp() 
    WHERE (mail_richiedente = '$mail_user' AND mail_accettatore = '$mail_amico') OR (mail_richiedente = '$mail_amico' AND mail_accettatore = '$mail_user');";
    $res = $cid->query($sql);

    if ($res != null){
        header('location:../frontend/friends.php?status=ok');
    }else{
        header('location:../frontend/friends.php?status=ko');
    }
}elseif ($tipo == 'Block'){
    $sql = "UPDATE `USER` SET `bloccatoda` = '$mail_user' 
    WHERE mail = '$mail_amico'";
    $res = $cid->query($sql);
    header('location:../frontend/admin.php?status=ok');
    if ($res != null){
        header('location:../frontend/admin.php?status=ok');
    }else{
        header('location:../frontend/admin.php?status=ko');
    }
    
}elseif ($tipo == 'Unblock'){
    $sql = "UPDATE `USER` SET `bloccatoda` = NULL 
    WHERE mail = '$mail_amico'";
    $res = $cid->query($sql);
    header('location:../frontend/admin.php?status=ok');
    if ($res != null){
        header('location:../frontend/admin.php?status=ok');
    }else{
        header('location:../frontend/admin.php?status=ko');
    }
    
}




?>