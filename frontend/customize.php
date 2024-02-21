<?php

session_start();

$mail = $_SESSION["email"];


include_once "../common/connection.php";
include_once "../common/funzioni.php";
$name = getname($cid, $mail);
$orient = getOrient($cid, $mail);
$cities = getAllCities($cid);
$nasce = getCity($cid, $mail, 'luogo_n');
$vive = getCity($cid, $mail, 'citta');
$bday = getBday($cid, $mail);

$allhobbies = getAllHobbies($cid);
$hobbies = getHobbies($cid, $mail);
if (!isset($_SESSION["logged"]))  header('location:../index.php'); 

if (isset($_GET["status"]))
{
	
	if ($_GET["status"]=='ko') $errore=unserialize($_GET["errore"]);
	$dati=unserialize($_GET["dati"]);
    // print_r($dati);
    // print_r($errore);
}
else
{
	
	$dati["nome"]="";
	$dati["cognome"]="";
	$dati["giorno"]="";
	$dati["mese"]="";
	$dati["anno"]="";
	$dati["orientamento"]="";
	//$dati["attivita"]=array();
	//$dati["condizioni"]="ko";
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Clique - Customize</title>
		<!-- Collegamento ai file CSS di Bootstrap 5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<!-- Collegamento a un file CSS personalizzato per il design -->
		<link href="../CSS/style.css" rel="stylesheet">
        
	</head>
	<body>
	  <?php
      require "../common/navbar.html";
    ?>
    
    <div class="container"> 
      <div class="row mt-5 pt-5">

        <div class="row">
          <div class="col-sm-12">

          </div>
        </div>

        <?php
          require "../common/sidenav.php";
        ?>
        <div class="col-lg-9">
          <div class="card card-body">
            <p class="form">
              <form method="POST" action="../backend/checkCustomize.php">

                <div class="mb-5 row">
                  <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-8">				
                    <input type="text" id="disabledTextInput" class="form-control" placeholder=<?php echo $_SESSION["email"] ?> disabled>
                  </div>
                </div>

                <div class="mb-5 row">
                  <label  class="col-sm-4 col-form-label"></label>
                  <div class="col-sm-8">
                    <img src="https://i.ibb.co/Bgp883W/faccina.png" class="img-circle" height="55" width="55" alt="Avatar">
                  </div>
                </div>

                <div class="mb-4 row">
                  <label for="staticEmail" class="col-sm-4 col-form-label">Foto profilo</label>
                  <div class="col-sm-8">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="inputGroupFile02">
                      <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label  class="col-sm-4 col-form-label">Nome</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="nome" placeholder=<?php echo $name['nome'];?>>
                  </div>
                </div>

                <div class="mb-5 row">
                  <label class="col-sm-4 col-form-label">Cognome</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="cognome" placeholder=<?php echo $name['cognome'];?>>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label class="col-sm-4 col-form-label">Residenza</label>
                  <div class="col-sm-7">
                    <select class="form-select form-select-md" name ="vivea">
                    <?php 
                      if (is_null($vive)){
                        echo '<option selected> scegli </option>';
                      }else{
                        echo '<option value='.$vive['idcitta'].'>'.printCity($vive).'</option>';
                      }
                    ?>                
                    <?php printOption($cities['content']);?>
                    </select>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label class="col-sm-4 col-form-label">Non trovi la tua città? [not impl]</label>
                  <div class="col-sm-4">
                    <input type="text" name ="citta" class="form-control" placeholder="Città" aria-label="City">
                  </div>
                  <div class="col-sm">
                    <input type="text" name ="prov" class="form-control" placeholder="Provincia" aria-label="State">
                  </div>
                  <div class="col-sm">
                    <input type="text" name ="stato" class="form-control" placeholder="Stato" aria-label="Zip">
                  </div>                
                </div>

                <div class="mb-3 row">
                  <label class="col-sm-4 col-form-label">Data di nascita</label>
                  <div class="col-sm-2">             
                    <select class="form-select form-select-md" name ="giorno" aria-label="Small select example">
                    <?php 
                      if (is_null($bday)){
                        echo '<option selected> dd </option>';
                      }else{
                        
                        echo '<option value='.$bday['d'].'>'.$bday['d'].'</option>';
                      }
                    ?>
                    <?php
                      for ($i=1;$i<=31;$i++) 
                      {
                      $check=""; 
                      if ($dati["giorno"]==$i) $check="selected";  
                      echo "<option value=\"$i\" $check>$i</option>";
                      }
                    ?>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <select class="form-select form-select-md" name ="mese" aria-label="Small select example">
                    <?php 
                      if (is_null($bday)){
                        echo '<option selected> mm </option>';
                      }else{
                        echo '<option value='.$bday['m'].'>'.$bday['m'].'</option>';
                      }
                    ?>
                    <?php
                      for ($i=1;$i<=12;$i++) 
                      {
                      $check=""; 
                      if ($dati["mese"]==$i) $check="selected";  
                      echo "<option value=\"$i\" $check>$i</option>";
                      }
                    ?>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <select class="form-select form-select-md" name ="anno" aria-label="Small select example">
                    <?php 
                      if (is_null($bday)){
                        echo '<option selected> yyyy </option>';
                      }else{
                        echo '<option value='.$bday['y'].'>'.$bday['y'].'</option>';
                      }
                    ?>
                    <?php
                      for ($i=1970;$i<=2024;$i++) 
                      {
                      $check=""; 
                      if ($dati["anno"]==$i) $check="selected";  
                      echo "<option value=\"$i\" $check>$i</option>";
                      }
                    ?>
                    </select>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label class="col-sm-4 col-form-label">Luogo di nascita</label>
                  <div class="col-sm-7">
                    <select class="form-select form-select-md" name ="natoa" aria-label="Small select example">
                      <?php 
                        if (is_null($nasce)){
                          echo '<option selected> scegli </option>';
                        }else{
                          echo '<option selected value='.$nasce['idcitta'].'>'.printCity($nasce).'</option>';
                        }
                      ?>
                      <?php printOption($cities['content']);?>
                    </select>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label  class="col-sm-4 col-form-label">Orientamento sessuale</label>
                  <div class="col-sm-8">
                    <select class="form-select form-select-md" name ="orientamento" aria-label="Small select example">
                      <?php 
                        if (is_null($orient)){
                          echo '<option selected value="cioa"> scegli </option>';
                        }else{
                          echo '<option selected value='.$orient['orient'].'>'.$orient['orient'].'</option>';
                        }
                      ?>
                      <option value='Etero'> Etero </option> 
                      <option value='Gay'> Gay </option>
                      <option value='Bisex'> Bisex </option>
                    </select>
                  </div>
                </div>

                <div class="mb-4 row">
                  <label  class="col-sm-4 col-form-label">Hobby</label>
                  <div class="col-sm-8">
                    <ul class="list-group">
                      <?php
                        foreach ($allhobbies as $row){
                          $check="";
                          if (in_array($row, $hobbies)){
                            $check="checked";
                          }
                          echo "<li class='list-group-item'>
                          <input class='form-check-input me-1 ' type='checkbox' value='".$row."' name='".$row."' id='".$row."Checkbox' ".$check.">
                          <label class='form-check-label stretched-link' for='".$row."Checkbox'>".$row."</label>
                        </li>";
                        }
                      ?>
                    </ul>
                  </div>
                </div>

                <div class="mb-4 row">
                  <div class="col-sm-4">
                  
                  </div>
                  <div class="col-sm-4">
                    <button type="submit" class="w-100 btn btn-primary btn-lg btn-block">Salva Modifiche</button>
                  </div>
                </div>
          
              </form>
            </p>
      
          </div>
        </div>
      </div>
    </div>
 
    <footer class="text-center text-white relative-bottom">    
      <div class="container p-4"></div>  
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          © 2023 Copyright:
        <a class="text-white" >clique.it</a>
      </div>
    </footer>

	<!-- Collegamento ai file JavaScript di Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>	
  </body>
</html>