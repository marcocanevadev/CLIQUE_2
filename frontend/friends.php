<?php

session_start();

if (!isset($_SESSION["logged"]))  header('location:../index.php'); 


$mail = $_SESSION["email"];
$nome= "marco";
$cognome="mario";
$amici[] = array("nome"=>$nome,"cognome"=>$cognome,"mail"=>'giobonadeo00@gmail.com');

include_once "../common/connection.php";
include_once "../common/funzioni.php";

$newfriends = findFriends($cid,$mail,'new');
$oldfriends = findFriends($cid,$mail,'old');
$infriends = findFriends($cid,$mail,'pending_in');
$outfriends = findFriends($cid,$mail,'pending_out');

$a = "";
$b = "";
$c = "";
$d = "" ;
//$exfriends = findFriends($cid,$mail,'ex');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Clique - Friends</title>
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
          <div class="row pb-2">
            <div class="card card-body ">
              <h4 class="card-title">Your friends:</h4>
              <?php
              printFriends($oldfriends,'old');
              ?>
            </div>
          </div>
          <div class="row pb-2">
            <div class="card card-body ">
              <h4 class="card-title">Pending requests:</h4>
                <?php
                printFriends($infriends,"pending_in");
                printFriends($outfriends,"pending_out");
                ?>
            </div>
          </div>
          <div class="row pb-2">
            <div class="card card-body ">
              <h4 class="card-title">Find new friends:</h4>
              <div class="row mb-1">
                

                <div class="col-md-4">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-primary <?php echo $a ? 'active' : '';?>" id="btnA">Città</button>
                        <button type="button" class="btn btn-outline-primary <?php echo $b ? 'active' : '';?>" id="btnB">Hobby</button>
                        <button type="button" class="btn btn-outline-primary <?php echo $c ? 'active' : '';?>" id="btnC">Orientamento</button>
                        <button type="button" class="btn btn-outline-primary <?php echo $d ? 'active' : '';?>" id="btnD">Età</button>
                    </div>
                </div>

                <script>
                    document.getElementById('btnA').addEventListener('click', function() {
                        <?php $a = $a ? '' : 'active'; ?>;
                        this.classList.toggle('active');
                    });

                    document.getElementById('btnB').addEventListener('click', function() {
                        <?php $b = $b ? '' : 'active'; ?>;
                        this.classList.toggle('active');
                    });

                    document.getElementById('btnC').addEventListener('click', function() {
                        <?php $c = $c ? '' : 'active'; ?>;
                        this.classList.toggle('active');
                    });

                    document.getElementById('btnD').addEventListener('click', function() {
                        <?php $d = $d ? '' : 'active'; ?>;
                        this.classList.toggle('active');
                    });
                </script>

              
              </div>
                <?php
                printFriends($newfriends,"new");
                ?>
            </div>
          </div>
          <!--<div class="row pb-2">
            <div class="card card-body ">
              <h4 class="card-title">Ex friends:</h4>
                <?php
                //printFriends($exfriends,"new");
                ?>
            </div>
          </div>	-->      
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