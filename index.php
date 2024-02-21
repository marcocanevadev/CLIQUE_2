<?php 
   function checkErrorLogin()
   {
	 if (isset($_GET["errore"]))
     {
        if ($_GET["errore"]=="login")    echo "Username errato";
        if ($_GET["errore"]=="password") echo "Password errata";	
    }
    else echo "ciao";
   }   
?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Clique - Login</title>
		<!-- Collegamento ai file CSS di Bootstrap 5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<!-- Collegamento a un file CSS personalizzato per il design -->
		<link href="CSS/style.css" rel="stylesheet">
	</head>
	<body>
        <?php

            require_once "common/navbar_out.html"
        
        ?>

        <div class="container">
            <div class="row pt-3">
                <div class="col-7">
                    <img src="https://i.ibb.co/4KRKCyn/sfondo2.png" alt="sfondo2" class='img-fluid'>
                </div>

                <div class="col-4">
                    
                    <form method="POST" action="backend/checkLogin.php">
                        <div class="form-outline mb-4">
                            <input type="email" name="email" class="form-control form-control-lg"  value="<?php  $a=isset($_GET["login"])?$_GET["login"]:"";echo $a; ?>"> email </input>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="password" name="pwd" class="form-control form-control-lg"> password </input>
                        </div>
                        <div class="row ">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="w-100 btn btn-primary btn-lg btn-block">Sign In</button>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                or
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <a role="button" href='frontend/signUp.php' class="w-100 btn btn-secondary btn-lg btn-block">Sign Up</a>
                            </div>
                        </div>
                    </form>
                    <div class="errore">
                        <?php
                        checkErrorLogin();
                        ?>
                    </div>       
                </div>
            </div>
        </div>


		<!-- Navbar -->

		<!-- Features Section -->
		
		<!-- Footer -->
        <footer class="text-center text-white fixed-bottom">
            <!-- Grid container -->
            <div class="container p-4"></div>
            <!-- Grid container -->
          
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
              © 2023 Copyright:
              <a class="text-white" >clique.it</a>
            </div>
            <!-- Copyright -->
          </footer>

	<!-- Collegamento ai file JavaScript di Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	</body>
</html>