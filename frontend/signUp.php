



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Clique - Login</title>
		<!-- Collegamento ai file CSS di Bootstrap 5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<!-- Collegamento a un file CSS personalizzato per il design -->
		<link href="../CSS/style.css" rel="stylesheet">
	</head>
	<body>
    <?php
    require_once "../common/navbar_out.html";
    ?>

    <div class="container">
      <div class="row pt-5">
        <div class="col-7">
          <h2>ISCRIVITI ORA!</h2>
          <h4>Rinuncia ai tuoi diritti!</h4>
          <!-- <img src="https://i.ibb.co/4KRKCyn/sfondo2.png" alt="sfondo2" class='img-fluid'> !-->
        </div>
        <div class="col-4">
                
          <form method="POST" action="../backend/checkSignup.php">
            <div class="form-outline mb-4">
              <input type="email" name="email" class="form-control form-control-lg" pattern="[@\s]+@[^@\s]+\.[^@\s]+" title='aaaaaaaaa@bbbb.ccc'required> email </input>
            </div>

            <div class="form-outline mb-1">
              <input type="password" name="pwd" class="form-control form-control-lg" required> password </input>
            </div>

            <div class="form-outline mb-5">
              <input type="password" name="pwdc" class="form-control form-control-lg" required> ripeti password </input>
            </div>

            <div class="row ">
              <div class="col-sm-12 text-center">
                <button type="submit" class="w-100 btn btn-primary btn-lg btn-block">Sign Up</button>              
              </div>
            </div>  

          </form>  
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