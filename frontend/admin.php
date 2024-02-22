<?php

session_start();

$mail = $_SESSION["email"];


include_once "../common/connection.php";
include_once "../common/funzioni.php";

$admin = getTypo($cid, $mail);
if (!isset($_SESSION["logged"]))  header('location:../index.php'); 
if ($admin != 'Admin') header('location:../index.php');
$nusers = AdminNUser($cid);
$nblock = AdminNBlock($cid);
$npost = AdminNPost($cid);
$utenti = findPeasants($cid);
$toppers = getTopUsers($cid);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Clique - Admin Panel</title>
		<!-- Collegamento ai file CSS di Bootstrap 5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<!-- Collegamento a un file CSS personalizzato per il design -->
		<link href="../CSS/style.css" rel="stylesheet">
        <script src=
        "https://d3js.org/d3.v4.min.js"></script>
        <script src=
        "https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.js"></script>
        <link rel="stylesheet"
            href=
        "https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.css" />
        <link rel=
        "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
            type="text/css" />
        
        <script src=
        "https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
        </script>
        <script src=
        "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
        </script>
        
        <script src=
        "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js">
        </script>
    
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
            <div class="row">
                <div class="col-md-5">               
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Numero Utenti
                        <span class="badge bg-secondary"><?php echo $nusers  ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Numero Utenti Bloccati
                        <span class="badge bg-danger"><?php echo $nblock  ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Numero Post
                        <span class="badge bg-secondary"><?php echo $npost  ?></span>
                    </li>
                    </ul>
                </div>
                <div class="col-md-7">
                <div id="donut-chart"></div>
 
                    <script>
                        let chart = bb.generate({
                            data: {
                                columns: [
                                    ["Utenti", <?php echo$nusers?>],
                                    ["Bloccati", <?php echo$nblock?>],
                                ],
                                type: "donut",
                                onclick: function (d, i) {
                                    console.log("onclick", d, i);
                                },
                                onover: function (d, i) {
                                    console.log("onover", d, i);
                                },
                                onout: function (d, i) {
                                    console.log("onout", d, i);
                                },
                            },
                            
                            bindto: "#donut-chart",
                        });
                    </script>
                </div>
            </div>
            <div class="row">
                <div class="col-5">TOP UTENTI</div>
            </div>
            <div class="row">
                <div class="col-md-10">
                <?php printFriends($cid, $toppers, 'top') ?>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-5">UTENTI</div>
            </div>
            <div class="row">
                <div class="col-md-10">
                <?php printFriends($cid, $utenti, 'block') ?>
                </div>
                <div class="col-md-2"></div>
            </div>
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