<?php
    $hostname="localhost";
    $username="root";
    $password="";
    $db="MiniFacebook";

    try {
        $cid=new mysqli($hostname, $username, $password, $db);
    } catch(Exception $e) {
        $cid=null;
    }
?>