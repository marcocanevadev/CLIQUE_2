<?php 
session_start();
include "../common/funzioni.php";
include "../common/connection.php";

$email=$_SESSION['email'];
$cognome = $_POST["cognome"];
$nome = $_POST["nome"];
$giorno = $_POST["giorno"];
$mese = $_POST["mese"];
$anno = $_POST["anno"];
$vivea = $_POST['vivea'];
$citta = $_POST["citta"];
$stato = $_POST["stato"];
$prov = $_POST["prov"];
$natoa = $_POST["natoa"];
$orientamento = $_POST["orientamento"];

$allhobbies = getAllHobbies($cid);
$myhobbies = getHobbies($cid, $email);
if ($myhobbies == null){
    $myhobbies = [];
}
foreach ($allhobbies as $hobi){
    $hobbies[] = $_POST[$hobi]; 
}
//$attivita = (isset($_POST["attivita"]))?$_POST["attivita"]:array();
//$condizioni = (isset($_POST["condizioni"]))?$_POST["condizioni"]:null;

$errore = array();
$dati = array();




if (!empty($nome)){
    if (strlen($nome)<3){
        $errore["nome"]="2";
    }else{
        $nome = ucfirst(strtolower($nome));
        $dati["nome"]=$nome;
        $resnome = setUser($cid, $_SESSION['email'],'nome',$dati["nome"]);
        if (is_null($resnome)){
            $errore["nome"]='0';
        }

    }
    

}

if (!empty($cognome)){
    if (strlen($cognome)<3){
        $errore["cognome"]="1";
    }else{
        $cognome = ucfirst(strtolower($cognome));
        $dati["cognome"]=$cognome;
        $rescognome = setUser($cid, $_SESSION['email'],'cognome',$dati["cognome"]);
        if (is_null($rescognome)){
            $errore["cognome"]='0';
        }
    }
    
}


if ($anno=="yyyy" || $mese=="mm" || $giorno=="gg"){
    $anno="";
    $mese="";
    $giorno="";
}

if (!empty($giorno) && !empty($mese) && !empty($anno)){
    
    if ( !checkdate($mese,$giorno,$anno)){
        $errore["giorno"]="3";
    } else{
        $dati["giorno"]=$giorno;
        $dati["mese"]=$mese;
        $dati["anno"]=$anno;
        
        $resdata = setDataN($cid, $_SESSION['email'],$giorno,$mese,$anno);
        if (is_null($resdata)){
            $errore['datan']='0';
        }
    }
    

}

/*
if (!empty($citta) && !empty($stato) && !empty($prov)){
    //if ( !checkdate($mese,$giorno,$anno)){
    //    $errore["giorno"]="3";
    //}
    $dati["citta"]=$citta;
    $dati["stato"]=$stato;
    $dati["prov"]=$prov;

}

*/
if (!empty($vivea)){
    $dati["vivea"]= $vivea;
    $resvive = setUser($cid, $_SESSION['email'],'citta',$dati["vivea"]);
    if (is_null($resvive)){
        $errore["vivea"]='0';
    }
}

if (!empty($natoa)){
    $dati["natoa"]= $natoa;
    $resnatoa = setUser($cid, $_SESSION['email'],'luogo_n',$dati["natoa"]);
    if (is_null($resnatoa)){
        $errore["natoa"]='0';
    }
}


if (!empty($orientamento)){
    $dati["orientamento"] = $orientamento;
    $resorient = setUser($cid, $_SESSION['email'],'orientamento',$dati["orientamento"]);
    if (is_null($resorient)){
        $errore["orientamento"]='0';
    }
    
}

if(!empty($hobbies)){


    for($i = 0; $i < count($hobbies); $i++){
        echo $allhobbies[$i];
        print_r($myhobbies);
        echo in_array($allhobbies[$i],$myhobbies);
        echo $hobbies[$i]==null;
        //exit();
        if ($hobbies[$i] != null){
            $sql = "INSERT INTO `APPREZZA` (`mail`, `hobby`) VALUES ('$email', '$hobbies[$i]')";
            $res = $cid->query($sql);
        }elseif ($hobbies[$i] == null AND in_array($allhobbies[$i], $myhobbies)){
            $sql = "DELETE FROM APPREZZA WHERE `mail` = '$email' AND `hobby` = '$allhobbies[$i]';";
            $res = $cid->query($sql);
        }

    }
    
}







// METTIAMo LA ROBA NEL DATABASE




// se si sono verificati degli errori devo tornare i dati, la lista degli errori e una parametro status = ko
// se invece non si sono verificati errori (per semplicità restituisco i dati e un parametro status =ok)
// in casi reali, i dati inseriti dall'utente (che sono corretti) verranno inseriti in una base di dati (vedremo più avanti)

if (count($errore)>0)
{
    header('location:../frontend/customize.php?status=ko&dati='. serialize($dati). 
               "&errore=". serialize($errore)); 
}
else{
    header('location:../frontend/customize.php?status=ok&dati='. serialize($dati)); 
}


?>