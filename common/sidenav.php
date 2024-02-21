<?php
  
  $mail = $_SESSION["email"];
  $nfriends = 10;
  

  include_once "../common/connection.php";
  include_once "../common/funzioni.php";
  $nfriends = getNrFriends($cid, $mail);
  $name = getname($cid, $mail);
  $nomecogn=$name['nome'].' '.$name['cognome'];
  $handle = gethandle($mail);
  $type = getTypo($cid, $mail);

  //$name = 'TONy';

  $current_page = basename($_SERVER['PHP_SELF']);

  

?>


<div class="col-lg-3">              
    <div class="card">
      <div class="card-body"> 
        <div class="col-sm-9"> <!--Da verificare se ha senso-->
          <img src="https://i.ibb.co/Bgp883W/faccina.png" class="img-circle" height="35" width="35" alt="Avatar">
          <h4 class="card-title"><?php echo "$nomecogn";?></h4>   
          <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo "$handle";?></h6> 
          
          
                                    
          <div class="list-group">               
            <a href="../frontend/homie.php" class="list-group-item list-group-item-action  <?php echo ($current_page == 'homie.php') ? 'list-group-item-secondary active' : ''; ?>" aria-current="<?php echo ($current_page == 'homie.php') ? 'true' : 'false'; ?>">Home</a>
            <a href="../frontend/friends.php" class="list-group-item list-group-item-action <?php echo ($current_page == 'friends.php') ? 'list-group-item-secondary active' : ''; ?>" aria-current="<?php echo ($current_page == 'friends.php') ? 'true' : 'false'; ?>">Friends <span class="badge text-bg-secondary"><?php echo "$nfriends";?></span></a>
            <!--<button type="button btn-outline-secondary" class="list-group-item list-group-item-action">Interests</button> -->
            <a href="../frontend/myfeed.php" class="list-group-item list-group-item-action  <?php echo ($current_page == 'myfeed.php') ? 'list-group-item-secondary active' : ''; ?>" aria-current="<?php echo ($current_page == 'myfeed.php') ? 'true' : 'false'; ?>">My Posts</a>
            <a href="../frontend/customize.php" class="list-group-item list-group-item-action  <?php echo ($current_page == 'customize.php') ? 'list-group-item-secondary active' : ''; ?>" aria-current="<?php echo ($current_page == 'customize.php') ? 'true' : 'false'; ?>">Customize</a>
            <?php
            if ($type == 'Admin'){    
              if ($current_page == 'admin.php'){
                $str1 ="list-group-item-secondary active";
                $str2 ="true";
              } else {
                $str1 = "";
                $str2 = "false";
              }
              echo "<a href=../frontend/admin.php class='list-group-item list-group-item-action ".$str1."' aria-current='".$str2."' > Admin Panel </a>";
            }
            ?>
            <a href="../backend/logout.php" class="list-group-item list-group-item-action ">Log Out</a>
          </div>              
        </div>          
      </div>            
    </div>

    <div class="card card-body">
        <p class="text-end">Ads by Marco</p>
        <div class="row">
            <div class="col-sm-12 text-center">
                <img src="assets/ad3.jpg" class="img-fluid"/>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-sm-12 text-center">
                <img src="assets/ad4.jpg" class="img-fluid"/>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-sm-12 text-center">
                <img src="assets/ad5.jpg" class="img-fluid"/>
            </div>
        </div>
    </div>  
</div>