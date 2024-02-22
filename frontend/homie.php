<?php

session_start();

if (!isset($_SESSION["logged"]))  header('location:../index.php'); 
	
require "../common/connection.php";
require "../common/funzioni.php";


$cities = getAllCities($cid);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Clique - Home</title>
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

      <?php 
        if (isset($_GET['first'])){

          welcomeBanner(gethandle($_SESSION['email']));
          echo '<div class="row">';
        }else{
          echo '<div class="row mt-5 pt-5">';
        }    
      ?>
      <!-- qui l'apertura del row è spostata nel if del php sopra ^  -->
        <!-- sidenav colonna lg-3  -->     
        <?php
          include_once "../common/sidenav.php";

          $postAmici = findPostAmici($cid, $_SESSION['email']);

          

        ?>
        
        <div class="col-lg-9">
        <div class="row pb-2">
          <div class="col-md-3">
          
          </div>
      
          <div class="col-md-3">
          <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ModalText">
            Post testuale
          </button>
          </div>
          <div class="col-md-3">
          <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ModalImage">
            Post immaginoso
          </button>

          </div>
          
        

        </div>
        

        <?php

          printPosts($cid, $postAmici, true);
          //print_r($postAmici)

        ?>
        
        </div>                   <!-- chiude la colonna lg-9 Tutto il contenuto sta qui sopra -->
      
      </div>                     <!-- chiude la row  iniziata nell'if di php che contiene il contenuto lg-3 (sidenav) e lg-9 (content)  -->

    </div>                        <!-- chiude il Mega container -->

    <footer class="text-center text-white relative-bottom">
        <div class="container p-4"></div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          © 2023 Copyright:
          <a class="text-white" >clique.it</a>
        </div>
    </footer>
    <!-- Modal Text-->
  <form method="POST" action="../backend/poster.php">
  <div class="modal fade" id="ModalText" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Scrivi un pensiero</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="input-group">
        <span class="input-group-text" name="testo"></span>
        <textarea class="form-control" aria-label="With textarea" name="testo" maxlength='100'></textarea>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Post it!</button>
      </div>
    </div>
  </div>
  </div>
  </form>


<!-- Modal Image -->
<form action="../backend/imgposter.php" method="POST" enctype="multipart/form-data">
<div class="modal fade" id="ModalImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Post an image</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-1">
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-text" name="descrizione"></span>
              <textarea class="form-control" aria-label="With textarea" name="descrizione" maxlength='50'></textarea>
            </div>
          </div>
        </div>

        <div class="row mb-1">
          <div class="col-md-12">
            <div class="input-group mb-3">
              <input type="file" class="form-control" name="fileToUpload"id="inputGroupFile02">
              <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </div>
          </div>
        </div>
        <div class="row mb-1">
        <div class="col-md-10">
              <select class="form-select form-select-md" name ="location">
                        <?php 
                            echo '<option selected> scegli </option>';
                        ?>                
                        <?php printOption($cities['content']);?>
              </select>
          </div>    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

	    <!-- Collegamento ai file JavaScript di Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	</body>
</html>

