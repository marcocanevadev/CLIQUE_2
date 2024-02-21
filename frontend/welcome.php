
<?php
session_start();
if (!isset($_SESSION["logged"]))  header('location:../index.php?o'); 
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Clique - Welcome</title>
		<!-- Collegamento ai file CSS di Bootstrap 5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<!-- Collegamento a un file CSS personalizzato per il design -->
		<link href="../CSS/style.css" rel="stylesheet">
	</head>
	<body>
    <?php

    require_once "../common/navbar_out.html"

    ?>

		<div class="container">
			<div class="row pt-5">
				<div class="col-7">
					<h2>Benvenuto in CLIQUE!</h2>
					<h6> Dicci di più  </h6>
					<h6>Completa il tuo profilo </h6>
					<!-- <img src="https://i.ibb.co/4KRKCyn/sfondo2.png" alt="sfondo2" class='img-fluid'> !-->
				</div>
				<div class="col-4">
    
				</div>
			</div>

			<div class="row">
				<div class="col-7"></div>
				<div class="col-4 d-flex">
						<a role="button" href='customize.php' class="w-100 btn btn-primary btn-lg btn-block mx-2">Vai</a>
						<a role="button" href='homie.php' class="w-100 btn btn-outline-secondary btn-lg btn-block">Salta</a>
				</div>
			</div>
            
		</div>

		<footer class="text-center text-white fixed-bottom">
			<div class="container p-4"></div>
			<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
				© 2023 Copyright:
				<a class="text-white" >clique.it</a>
			</div>
		</footer>   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	</body>
</html>