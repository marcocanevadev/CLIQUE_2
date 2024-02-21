<?php

session_start();

if (!isset($_SESSION["logged"]))  header('location:../index.php'); 
	
require "../common/connection.php";
require "../common/funzioni.php";
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


        <?php

          printPosts($cid, $postAmici, true);
          //print_r($postAmici)

        ?>
        
          <div class="row">

            <div class="col-md-3">      <!-- colonna dei postatori [foto, nome, handle] -->

              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-2">
                      <img src="https://i.ibb.co/Bgp883W/faccina.png" class="img-circle" height="35" width="35" alt="Avatar">
                    </div>
                    <div class="col-sm-10 ps-4">
                      <p class="card-title">tony da milano</p>
                      <h6 class="card-subtitle mb-2 text-body-secondary">@tonydami</h6>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-9">      <!-- colonna dei post [post, commenti]-->

              <div class="card">
                <div class="card-body">
                  <h5 class="card-text">Lorem <?php print_r($postAmici) ?>ipsum dolor sit, amet consectetur adipisicing elit. Natus rerum officiis quis magni maxime laudantium eveniet dicta ut nulla tenetur eos est maiores numquam temporibus veritatis, mollitia voluptatem ducimus voluptatum et voluptate explicabo eligendi quibusdam, similique ex? Aperiam quam quae provident iure necessitatibus cupiditate nesciunt?</h5>
                  <h6 class="card-subtitle mb-1 text-body-secondary text-end">posted today at 12:36</h6>
                  <p class="d-inline-flex gap-1">
                    <a class="btn btn-outline-secondary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Commenti
                    </a>
                    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                      B
                    </button>
                  </p>
                  <div class="collapse" id="collapseExample">       <!-- qui ci vanno gli n commenti -->

                    <div class="card card-body mb-1">
                      <div class="row">
                        <div class="col-1">
                          <img src="https://i.ibb.co/Bgp883W/faccina.png" class="img-circle" height="35" width="35" alt="Avatar"> 
                        </div>
                        <div class="col-10">
                          <span class="card-title">mario draghi</span>
                          <h6 class="card-subtitle mb-2 text-body-secondary">@mariod</h6>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                          <p class="card-text">spacchi bro!</p>
                        </div>
                      </div>                        
                    </div>
                    
                    <!-- dopo i commenti la possibilità di inserire il tuo -->
                    <div class="card card-body mb-1">
                      <div class="row">                     
                        <div class="col-1">
                          <img src="https://i.ibb.co/Bgp883W/faccina.png" class="img-circle" height="35" width="35" alt="Avatar"> 
                        </div>
                        <div class="col-10">
                          <span class="card-title">Muammar al-Qaddafi</span>
                        </div>
                      </div>                  
                      <div class="row pt-1">
                        <div class="form-outline">
                            <input type="text" id="formControlLg" class="form-control form-control-lg" />
                            <p>inserisci commento</p>
                        </div>                        
                      </div>
                    </div>

                  </div>  <!-- chiude il collapse dei commenti-->
                </div>      <!-- chiude il card body del post-->
              </div>          <!-- chiude il card del post -->



            </div>              <!-- chiude la colonna md-9 quella dei post -->
          </div>                  <!-- chiude la row del primo post -->

          <div class="row mt-3">          <!-- Post tipo immagine -->
            <div class="col-md-3">      <!-- secondo tipologia di colonna postatori da buttare probabilmente (è più bella l'altra) -->

              <div class="card pt-2 ps-2 pb-2">
                <img src="https://i.ibb.co/Bgp883W/faccina.png" class="img-circle" height="35" width="35" alt="Avatar">
                <p class="card-title">Tonino da milanello</p>
                <h6 class="card-subtitle mb-2 text-body-secondary">@tonydami</h6>
              
              </div>
            </div>

            <div class="col-md-9">   <!-- colonna dei post [post, commenti]-->

              <div class="card" >
                <img src="https://i.ibb.co/61WjY5x/cat.jpg" alt="cat" class="card-img-top" >
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-7">
                      <h5 class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere veritatis itaque natus cumque laboriosam velit quis! Minus libero ducimus corrupti neque vitae, nemo est ullam voluptatum eaque a voluptates expedita, id modi perferendis officiis placeat qui omnis doloribus ipsum dignissimos quibusdam? Eos harum neque, amet aspernatur voluptate nemo. Asperiores, ex.</h5>
                    </div>
                    <div class="col-sm-5">
                      <h6 class="card-subtitle mb-2 text-body-secondary text-end">posted today at 12:36</h6>
                      <p class="card-text text-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                          <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                        </svg> Milano, MI</p>
                    </div>
                  </div>
                  
                  <p class="d-inline-flex gap-1 pt-4">
                    <a class="btn btn-outline-secondary" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                      Commenti
                    </a>
                    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                      B
                    </button>
                  </p>

                  <div class="collapse" id="collapseExample1">
                
                    <div class="card card-body mb-1">

                      <div class="row">
                        <div class="col-1">
                          <img src="https://i.ibb.co/Bgp883W/faccina.png" class="img-circle" height="35" width="35" alt="Avatar"> 
                        </div>
                        <div class="col-10">
                          <span class="card-title">mario draghi</span>
                          <h6 class="card-subtitle mb-2 text-body-secondary">@mariod</h6>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                          <p class="card-text">spacchi bro!</p>
                        </div>
                      </div>

                    </div>
                    
                    <div class="card card-body mb-1">

                      <img src="https://i.ibb.co/Bgp883W/faccina.png" class="img-circle" height="35" width="35" alt="Avatar">
                        <p class="card-title">Muhammar al-Qaddafi</p>                      
                      <div class="row">
                        <div class="form-outline">
                          <input type="text" id="formControlLg" class="form-control form-control-lg" />
                          <label class="form-label" for="formControlLg">Inserisci il tuo commento</label>
                        </div>                        
                      </div>

                    </div> 

                  </div>       <!-- chiude il collapse -->
                </div>          <!-- chiude il card body -->
              </div>              <!-- chiude il card dei post-->
            </div>                    <!-- chiude la colonna md-9 dei post -->
          </div>                          <!-- chiude la row del secondo post-->
          
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

	    <!-- Collegamento ai file JavaScript di Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	</body>
</html>