<?php

session_start();

if (!isset($_SESSION["logged"]))  header('location:../index.php'); 


$mail = $_SESSION["email"];


include_once "../common/connection.php";
include_once "../common/funzioni.php";
$myTexts = findMyPosts($cid,$mail);



?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Clique - My feed</title>
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
        
        <?php
		      require "../common/sidenav.php";
	      ?>
        <div class="col-2"></div>
        <div class="col-lg-7">
          <?php
          printPosts($cid, $myTexts, false);
          ?>       
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