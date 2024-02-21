<?php

    function authentication($cid, $email) {

        $risultato = array('status' => 'ok', 'content' => '');

        $user=array();

        $sql="SELECT mail, password FROM USER WHERE mail = '$email' ";
        $res=$cid->query($sql);

        if ($res==null) {
            echo 'male';
            //da fare
        } elseif ($res->num_rows==0) {
            echo 'male male';
            
        } else {
            $row=$res->fetch_assoc();
            //$user=array("email" => $row["mail"], "city" => $row["citta"]);
            $user['mail']=$row['mail'];
            $user['password']=$row['password'];

            $risultato['content']=$user;
        }

        return $risultato;
    }


    function registrazione($cid, $email, $pass){
        $sql = "INSERT INTO  USER (mail, tipo, password) VALUES ('$email','User', '$pass');";
        $res=$cid->query($sql);

        return $res;

    }

    function friendRequest($cid, $mail_mittente, $mail_ricevente){
        $sql = "INSERT INTO `RICHIESTE` ( `timestamp_richiesta`, `timestamp_accettazione`, `timestamp_fine`, `mail_richiedente`, `mail_accettatore`) 
        VALUES ( current_timestamp(), NULL, NULL, $mail_mittente, $mail_ricevente);"; 
        
        
        $res=$cid->query($sql);

        return $res;

    }

    function friendAccept($cid, $id){
        $sql = "UPDATE `RICHIESTE` SET `timestamp_accettazione` = current_timestamp(), `timestamp_fine` = NULL WHERE `RICHIESTE`.`req_id` = $id;"; 
        
        
        $res=$cid->query($sql);

        return $res;

    }

    function getTypo($cid, $email){
      $sql ="SELECT tipo FROM USER WHERE mail = '$email'";
      $res = $cid->query($sql);
      if ($res != null){
        $row = $res->fetch_assoc();
        $type = $row['tipo'];

        return $type;
      }
      return null;
    }


    function getname($cid, $email){
        $sql = "SELECT nome, cognome FROM USER WHERE mail = '$email';";

        $res=$cid->query($sql);
        
        if ($res==null) {
            echo 'male';
            //da fare
        } elseif ($res->num_rows==0) {
            echo 'male male';
            
        } else {
            $row=$res->fetch_assoc();
            $name = $row['nome'];
            $surname = $row['cognome'];
            $risultato = array('nome'=>$name,'cognome'=>$surname);
            //$name=$row['nome'].' '.$row['cognome'];
        }

        return $risultato;
    }

    function gethandle($email){
        $out = explode('@',$email);
        $handle = '@'.$out[0];

        return "$handle";
    }


    function getBday($cid, $email){
        $sql = "SELECT data_n FROM USER WHERE mail = '$email';";

        $risultato = null;

        $res=$cid->query($sql);

        $date = array('1','2','salve');
        //return $res;
        
        if ($res!=null){
            $row=$res->fetch_assoc();
            $date = $row['data_n'];
            if ($date == null) return null;
            $date = explode('-',$date);
            
            $risultato = array('y'=>$date[0],'m'=>$date[1],'d'=>$date[2]);
        }

        return $risultato;


    } 

    function getOrient($cid, $email){
        $sql = "SELECT orientamento FROM USER WHERE mail = '$email';";

        $res=$cid->query($sql);
        
        if ($res==null) {
            echo 'male';
            //da fare
        } elseif ($res->num_rows==0) {
            echo 'male male';
           
        } else {
            $row=$res->fetch_assoc();
            $ori = $row['orientamento'];
            $risultato = array('orient'=>$ori);
            //$name=$row['nome'].' '.$row['cognome'];
        }

        return $risultato;
    }

    function getCity($cid, $email, $field){
        $sql = "SELECT c.nome, c.provincia, c.stato, c.id_citta FROM CITTA c JOIN USER u ON u.$field= c.id_citta WHERE mail = '$email';";
        $res = $cid->query($sql);
        $risultato = null;
        if ($res != null && $res->num_rows != 0){
            $city = $res->fetch_assoc();
            $risultato = array('citta'=>$city['nome'],
                            'provincia'=>$city['provincia'],
                            'idcitta'=>$city['id_citta'],
                            'stato'=>$city['stato']);
        }   
        return $risultato;
    }

    function getAllHobbies($cid){
      $sql = "SELECT * from HOBBY";
      $res = $cid->query($sql);
        
        while ($row=$res->fetch_assoc()) {
            $hobby[] = $row["hobby"];
        }
        $risultato= $hobby;

        return $risultato;

    }

    function getHobbies($cid, $email){
      $sql = "SELECT hobby from APPREZZA WHERE mail = '$email'";
      $res = $cid->query($sql);
        
        while ($row=$res->fetch_assoc()) {
            $hobby[] = $row["hobby"];
        }
        $risultato= $hobby;

        return $risultato;

    }


    function setUser($cid, $email, $field, $val){
        $sql = "UPDATE USER SET $field = '$val' WHERE mail = '$email'";
        $res = $cid->query($sql);

        return $res;
    }
    
    function setDataN($cid, $email, $gg, $mm, $yyyy){
        $sql = "UPDATE USER SET data_n = '$yyyy-$mm-$gg' WHERE mail = '$email'; ";
        $res = $cid->query($sql);

        return $res;
    }


    function getAllCities($cid){
        $sql = "SELECT * FROM CITTA WHERE 1;";

        $res = $cid->query($sql);
        
        while ($row=$res->fetch_assoc()) {
            $city[] = array("citta"=>$row["nome"],
                            "provincia"=>$row["provincia"],
                            "stato"=>$row['stato'],
                            "id"=>$row['id_citta']);
        }
        $risultato["content"]= $city;

        return $risultato;

    }
    
    function getNrFriends($cid, $email){
        $sql = "SELECT DISTINCT COUNT(mail) 
        FROM RICHIESTE JOIN USER ON mail=mail_accettatore
        WHERE timestamp_accettazione is NOT NULL AND timestamp_fine IS NULL AND mail_richiedente='$email';";
        $sql1= "SELECT DISTINCT COUNT(mail) 
        FROM RICHIESTE JOIN USER ON mail=mail_richiedente
        WHERE timestamp_accettazione is NOT NULL AND timestamp_fine IS NULL AND mail_accettatore='$email';";

        $res = $cid->query($sql);
        $row = $res->fetch_row();
        $nr = $row[0];


        $res1 = $cid->query($sql1);
        $row = $res1->fetch_row();
        $nr1 = $row[0];

        return $nr+$nr1;
    }

    function findFriends($cid, $email, $tipo){

        if      ($tipo == 'new'){
            
            $sql = "SELECT mail, nome, cognome
            FROM USER
            WHERE mail<>'$email' AND mail NOT IN 
            (SELECT mail FROM USER JOIN RICHIESTE ON mail=mail_richiedente 
            WHERE mail_accettatore='$email' 
            UNION SELECT mail FROM USER JOIN RICHIESTE ON mail=mail_accettatore 
            WHERE mail_richiedente='$email')";

        }elseif ($tipo == 'old'){
           
            $sql ="SELECT DISTINCT mail, nome, cognome 
            FROM RICHIESTE JOIN USER ON mail=mail_accettatore
            WHERE timestamp_accettazione is NOT NULL AND timestamp_fine IS NULL AND mail_richiedente='$email'
            UNION 
            SELECT DISTINCT mail, nome, cognome
            FROM RICHIESTE JOIN USER ON mail=mail_richiedente
            WHERE timestamp_accettazione is NOT NULL AND timestamp_fine IS NULL AND mail_accettatore='$email'";

        }elseif ($tipo == 'pending_in'){

            $sql = "SELECT DISTINCT mail, nome, cognome
            FROM RICHIESTE JOIN USER ON mail = mail_richiedente AND mail_accettatore = '$email'
            WHERE timestamp_accettazione IS NULL";

        }elseif ($tipo == 'pending_out'){

            $sql = "SELECT DISTINCT mail, nome, cognome
            FROM RICHIESTE JOIN USER ON mail = mail_accettatore AND mail_richiedente = '$email'
            WHERE timestamp_accettazione IS NULL";

        }elseif ($tipo == 'ex'){
            

            $sql = "SELECT mail, nome, cognome
            FROM USER JOIN RICHIESTE ON mail=mail_accettatore
            WHERE mail<>'$email' and mail 
            NOT IN (SELECT DISTINCT mail
            FROM RICHIESTE JOIN USER ON mail=mail_accettatore
            WHERE timestamp_accettazione is NOT NULL AND timestamp_fine IS NULL AND mail_richiedente='$email'
            UNION 
            SELECT DISTINCT mail
            FROM RICHIESTE JOIN USER ON mail=mail_richiedente
            WHERE timestamp_accettazione is NOT NULL AND timestamp_fine IS NULL AND mail_accettatore='$email'
            UNION
            SELECT DISTINCT mail
            FROM RICHIESTE join USER on mail = mail_richiedente
            WHERE timestamp_accettazione IS NULL and mail <> '$email'
            UNION
            SELECT DISTINCT mail
            FROM RICHIESTE join USER on mail = mail_accettatore
            WHERE timestamp_accettazione IS NULL and mail <> '$email'
            ) 
            AND timestamp_fine IS NOT NULL
            UNION SELECT mail, nome, cognome
            FROM USER JOIN RICHIESTE ON mail=mail_richiedente
            WHERE mail<>'$email' and mail
            NOT IN (SELECT DISTINCT mail
            FROM RICHIESTE JOIN USER ON mail=mail_accettatore
            WHERE timestamp_accettazione is NOT NULL AND timestamp_fine IS NULL AND mail_richiedente='$email'
            UNION 
            SELECT DISTINCT mail
            FROM RICHIESTE JOIN USER ON mail=mail_richiedente
            WHERE timestamp_accettazione is NOT NULL AND timestamp_fine IS NULL AND mail_accettatore='$email'
            UNION
            SELECT DISTINCT mail
            FROM RICHIESTE join USER on mail = mail_richiedente
            WHERE timestamp_accettazione IS NULL and mail <> '$email'
            UNION
            SELECT DISTINCT mail
            FROM RICHIESTE join USER on mail = mail_accettatore
            WHERE timestamp_accettazione IS NULL and mail <> '$email'
            )  
            AND timestamp_fine IS NOT NULL
            ";
        }

        $res = $cid->query($sql);
        
        if ($res != null){
            $user = null;
            while ($row=$res->fetch_assoc()) {
                $user[] = array("mail"=>$row["mail"],
                                "nome"=>$row["nome"],
                                "cognome"=>$row['cognome']);
            }
            $risultato= $user;
            return $risultato;
        }
        return null;

    }

    function printOption($data){
        foreach ($data as $row){
            echo "<option value=".$row['id'].">".printCity($row)."</option>";
        }
    }

    function printFriends($data, $type){
        if ($data == null){
            return null;
        }

        $disabled = "";

        if ($type == "new"){
            $outline="outline-primary";
            $text = "Add";
            //$action = 'befriend.php';
        }elseif ($type == 'old'){
            $outline= "danger";
            $text = "Unfriend";
            //$action = 'unfriend.php';
        }elseif ($type =='pending_in'){
            $outline= "primary";
            $text = "Accept";
            //$action = 'unfriend.php';
        }elseif ($type =='pending_out'){
            $outline= "outline-secondary disabled";
            $text = "Pending";
            $disabled = "aria-disabled='true'";
            //$action = 'unfriend.php';
        }elseif ($type =='block'){
            $outline = "";
            $text = "";
        }

        foreach ($data as $row){
            if ($type == 'block'){
              if ($row['bloccatoda'] == null){
                $outline = "danger";
                $text = "Block";
              }else{
                $outline = "outline-primary";
                $text = "Unblock";
              }
            }
            echo "
            <div class='row pb-2 px-2'>
            <div class='card card-body'>
            <div class='row pb-2'>
              <div class='col-1'>
                <img src='https://i.ibb.co/Bgp883W/faccina.png' class='img-circle' height='35' width='35' alt='Avatar'>
              </div>
              <div class='col-1'> </div>
              <div class='col-4'>
                <h6 class='card-title'>".$row["nome"]." ".$row["cognome"]."</h6>                
              </div>               
              <div class='col-4'>
                <h6 class='card-title text-body-secondary'>
                  ".gethandle($row["mail"])."
                </h6>
              </div>
              
              <div class='col-2'>
              <a href='../backend/befriend.php?mail=".$row["mail"]."&tipo=".$text."' class='w-100 btn btn-".$outline."  btn-block'".$disabled.">".$text."</a>
              
              </div>

            </div>
            </div>
            </div>";
        }
    }

    function findPostCity($cid, $id){
        $sql = "SELECT c.nome, c.provincia, c.stato FROM CITTA c WHERE id_citta = '$id';";
        $res = $cid->query($sql);
        $risultato = null;
        if ($res != null && $res->num_rows != 0){
            $city = $res->fetch_assoc();
            $risultato = array('citta'=>$city['nome'],
                            'provincia'=>$city['provincia'],
                            'stato'=>$city['stato']);
        }
        return $risultato;
    }
    

    function printCity($city){
        $res = $city["citta"].", ".$city['provincia'].", ".$city['stato'];
        return $res;
    }

    

    function welcomeBanner($handle){
        echo 
        '<div class="row mt-5 pt-5"> 
        <div class="col-sm-12">
          
          <div class="alert alert-dark alert-dismissible fade show" role="alert">
          welcome Back, '.$handle.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
            
          
          
        </div>
      </div>';
    }

    function findMyPosts($cid,$mail){
        $sql="SELECT post_id, timestamp_post, tipo_post, testo_post, img_desc, img_path, img_nome, img_citta
        FROM POST
        WHERE mail='$mail' ORDER BY post_id DESC";
        $res = $cid->query($sql);

        if ($res != null){
            $postAtt = null;
            while ($row=$res->fetch_assoc()) {
                $postAtt[] = array("post_id"=>$row["post_id"],
                                "timestamp_post"=>$row["timestamp_post"],
                                "tipo_post"=>$row["tipo_post"],
                                "testo_post"=>$row["testo_post"],
                                "img_path"=>$row["img_path"],
                                "img_desc"=>$row["img_desc"],
                                "img_nome"=>$row["img_nome"],
                                "img_citta"=>$row["img_citta"]);
            }
            $risultato= $postAtt;
            return $risultato;
        }
        return null;
    }

    function findPostAmici($cid,$email){
        $sql="SELECT nome, cognome, post_id, P1.mail, timestamp_post, tipo_post, testo_post, img_desc, img_path, img_nome, img_citta
        FROM POST P1 JOIN RICHIESTE ON P1.mail=mail_richiedente JOIN USER U1 ON P1.mail=U1.mail
        WHERE mail_accettatore='$email' AND timestamp_accettazione IS NOT NULL AND timestamp_fine IS NULL
        UNION SELECT nome, cognome, post_id, P2.mail,timestamp_post, tipo_post, testo_post, img_desc, img_path, img_nome, img_citta 
        FROM POST P2 JOIN RICHIESTE ON P2.mail=mail_accettatore JOIN USER U2 ON P2.mail=U2.mail
        WHERE mail_richiedente='$email' AND timestamp_accettazione IS NOT NULL AND timestamp_fine IS NULL
        ORDER BY post_id DESC";

        $res = $cid->query($sql);

        if ($res != null){
            $postAmici = null;
            while ($row=$res->fetch_assoc()) {
                $postAmici[] = array("post_id"=>$row["post_id"],
                                "mail"=>$row["mail"],
                                "nome"=>$row["nome"],
                                "cognome"=>$row["cognome"],
                                "timestamp_post"=>$row["timestamp_post"],
                                "tipo_post"=>$row["tipo_post"],
                                "testo_post"=>$row["testo_post"],
                                "img_path"=>$row["img_path"],
                                "img_desc"=>$row["img_desc"],
                                "img_nome"=>$row["img_nome"],
                                "img_citta"=>$row["img_citta"]);
            }
            $risultato= $postAmici;
            return $risultato;
        }
        return null;
    }

    function postVote($cid, $post_id){
      $commenti = findComments($cid, $post_id);
      if ($commenti == null){
        $commenti = [];
      }
      $i = 0;
      $tot = 0;
      foreach($commenti as $commt){
        if ($commt['indice_gradimento'] != null){
          $i += 1;
          $tot += $commt['indice_gradimento'];
        }
      }
      if ($i != 0){
        $mipiace = $tot / $i;
        $mipiace = number_format($mipiace, 1);
      }else{
        $mipiace = number_format(0,1);
      }

      return $mipiace;


    }

    function setScore($cid, $email){
      $respect = getRespect($cid, $email);

      $posts = findMyPosts($cid, $email);
      $tot = 0;
      foreach($posts as $post){
        $tot += postVote($cid, $post['post_id']);
      }
      $tot *= 0.5;

      $respect += $tot;

      updateRespect($cid, $email, $respect);
      
      

    }

    function printPosts($cid, $data, $home) {

        if ($data == null){
            return null;
        }
        

        foreach ($data as $row){
          $commenti= findComments($cid, $row['post_id']);
          if ($commenti == null){
            $commenti = [];
          }

          $mipiace = postVote($cid, $row['post_id']);
          
          

            $text = "";
            $trailer = "";
            if ($home == true){
            $text ="<div class='col-md-3'>      <!-- colonna dei postatori [foto, nome, handle] -->

            <div class='card'>
              <div class='card-body'>
                <div class='row'>
                  <div class='col-sm-2'>
                    <img src='https://i.ibb.co/Bgp883W/faccina.png' class='img-circle' height='35' width='35' alt='Avatar'>
                  </div>
                  <div class='col-sm-10 ps-4'>
                    <p class='card-title'>".$row["nome"]." ".$row["cognome"]."</p>
                    <h6 class='card-subtitle mb-2 text-body-secondary'>".gethandle($row["mail"])."</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class='col-md-9'>      <!-- colonna dei post [post, commenti]-->
            ";
            $trailer = "</div>";
        }

            if ($row["tipo_post"]=="Text") {
            echo " 
            <div class='row pb-2'>".$text.
            "<div class='card'>
            <div class='card-body'>
              <h5 class='card-text'>".$row["testo_post"]."</h5>
              <h6 class='card-subtitle mb-1 text-body-secondary text-end'>posted on ".$row["timestamp_post"]."</h6>
              <div class='row'>
              <div class='col-md-3'>
              <p class='d-inline-flex gap-1'>
                <a class='btn btn-outline-secondary' data-bs-toggle='collapse' href='#collapse".$row['post_id']."' role='button' aria-expanded='false' aria-controls='collapseExample'>
                  Commenti
                </a>
              </p>
              </div>
              <div class='col-md-9'>
              <h6 class='card-subtitle mb-1 text-body-secondary text-end'><span class='badge text-bg-secondary text-end'>".$mipiace."</span></h6> 
              </div>
              </div>
              <div class='collapse' id='collapse".$row['post_id']."'>       <!-- qui ci vanno gli n commenti -->
                ";
                
              foreach ($commenti as $comm){
                echo "<div class='card card-body mb-1'>
                        <div class='row'>
                          <div class='col-1'>
                            <img src='https://i.ibb.co/Bgp883W/faccina.png' class='img-circle' height='35' width='35' alt='Avatar'> 
                          </div>
                          <div class='col-10'>
                            <span class='card-title'>".$comm['nome']." ".$comm['cognome']."</span>
                            <h6 class='card-subtitle mb-2 text-body-secondary'>".gethandle($comm['mail_commentatore'])."</h6>
                          </div>
                        </div>
                        <div class='row'>
                          <div class='col-1'></div>
                          <div class='col-10'>
                            <p class='card-text'>".$comm['testo_commento']."</p>
                          </div>
                        </div>                        
                      </div>";
              }
                
                
                echo " 
                <!-- dopo i commenti la possibilità di inserire il tuo -->
                <form action='../backend/checkComment.php' method='POST'>
                <div class='card card-body mb-1'>
                  <div class='row'>                     
                    <div class='col-1'>
                      <img src='https://i.ibb.co/Bgp883W/faccina.png' class='img-circle' height='35' width='35' alt='Avatar'> 
                    </div>
                    <div class='col-10'>
                      <span class='card-title'>".gethandle($_SESSION['email'])."</span>
                    </div>
                  </div>                  
                  <div class='row pt-1'>
                    <div class='form-outline'>
                      <div class='input-group pb-2'>
                        <input type='text' id='formControlLg' class='form-control form-control-lg pb-2' name='commento'/>
                      </div>
                      <input type='hidden' name='post_id' value='".$row['post_id']."'/>
                      <div class='row'>
                        <div class='col-md-2'>
                          <input class='btn btn-outline-primary' type='submit' value='Submit'>
                        </div>
                        <div class='col-md-4'> </div>

                        <div class='col-md-6'>
                          <div class='btn-toolbar pb-2' role='toolbar' aria-label='Toolbar with button groups'>
                            <div class='btn-group me-2' role='group' aria-label='First group' name='indice_gradimento'>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=-3>-3</button>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=-2>-2</button>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=-1>-1</button>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=0>0</button>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=1>1</button>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=2>2</button>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=3>3</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                     
                    </div>                        
                  </div>
                </div>
                </form>
              </div>  <!-- chiude il collapse dei commenti-->
            </div>      <!-- chiude il card body del post-->
          </div>          <!-- chiude il card del post -->
          ".$trailer."
          </div> 
          ";
            } else {
                $city = findPostCity($cid, $row["img_citta"]);
                echo "
                <div class='row pb-2'>".$text.
                "<div class='card'>
                <img src=../".$row["img_path"].$row["img_nome"]." class='card-img-top' >
                <div class='card-body'>
                  <div class='row'>
                    <div class='col-sm-7'>
                      <h5 class='card-text'>".$row["img_desc"]."</h5>
                    </div>
                    <div class='col-sm-5'>
                      <h6 class='card-subtitle mb-2 text-body-secondary text-end'>posted on ".$row["timestamp_post"]."</h6>
                      <p class='card-text text-end'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-geo-alt-fill' viewBox='0 0 16 16'>
                          <path d='M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6'/>
                        </svg>".printCity($city)."</p>
                        
                    </div>
                  </div>
                  <div class='row mb-2'>
                    <div class='col-3'>
                    
                    <a class='btn btn-outline-secondary' data-bs-toggle='collapse' href='#collapse".$row['post_id']."' role='button' aria-expanded='false' aria-controls='collapseExample'>
                      Commenti
                    </a>
                    
                 
                    </div>
                    <div class='col-8'>

                    </div>
                    <div class='col-1'>
                    <span class='badge text-bg-secondary'>".$mipiace."</span>
                    </div>
                    </div>
                  

                  <div class='collapse' id='collapse".$row['post_id']."'>";
                  foreach ($commenti as $comm){
                    echo "<div class='card card-body mb-1'>
                            <div class='row'>
                              <div class='col-1'>
                                <img src='https://i.ibb.co/Bgp883W/faccina.png' class='img-circle' height='35' width='35' alt='Avatar'> 
                              </div>
                              <div class='col-10'>
                                <span class='card-title'>".$comm['nome']." ".$comm['cognome']."</span>
                                <h6 class='card-subtitle mb-2 text-body-secondary'>".gethandle($comm['mail_commentatore'])."</h6>
                              </div>
                            </div>
                            <div class='row'>
                              <div class='col-1'></div>
                              <div class='col-10'>
                                <p class='card-text'>".$comm['testo_commento']."</p>
                              </div>
                            </div>                        
                          </div>";
                  }

                    
                    echo "
                    <!-- dopo i commenti la possibilità di inserire il tuo -->
                <form action='../backend/checkComment.php' method='POST'>
                <div class='card card-body mb-1'>
                  <div class='row'>                     
                    <div class='col-1'>
                      <img src='https://i.ibb.co/Bgp883W/faccina.png' class='img-circle' height='35' width='35' alt='Avatar'> 
                    </div>
                    <div class='col-10'>
                      <span class='card-title'>".gethandle($_SESSION['email'])."</span>
                    </div>
                  </div>                  
                  <div class='row pt-1'>
                    <div class='form-outline'>
                      <div class='input-group pb-2'>
                        <input type='text' id='formControlLg' class='form-control form-control-lg pb-2' name='commento'/>
                      </div>
                      <input type='hidden' name='post_id' value='".$row['post_id']."'/>
                      <div class='row'>
                        <div class='col-md-2'>
                          <input class='btn btn-outline-primary' type='submit' value='Submit'>
                        </div>
                        <div class='col-md-4'> </div>

                        <div class='col-md-6'>
                          <div class='btn-toolbar pb-2' role='toolbar' aria-label='Toolbar with button groups'>
                            <div class='btn-group me-2' role='group' aria-label='First group' name='indice_gradimento'>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=-3>-3</button>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=-2>-2</button>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=-1>-1</button>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=0>0</button>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=1>1</button>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=2>2</button>
                              <button type='radio' class='btn btn-outline-primary' name='indice_gradimento' value=3>3</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                     
                    </div>                        
                  </div>
                </div>
                </form>
              </div>  <!-- chiude il collapse dei commenti-->
                </div>          <!-- chiude il card body -->
              </div>              <!-- chiude il card dei post-->
              
              ".$trailer."
                </div>
                ";
            }
        }
    }

    function createTextPost($cid, $mail, $text){

      $sql="INSERT INTO `POST` ( `mail`, `timestamp_post`, `tipo_post`, `testo_post`, `img_desc`, `img_path`, `img_nome`, `img_citta`) VALUES ( '$mail', CURRENT_TIMESTAMP, 'Text', '$text', NULL, NULL, NULL, NULL)";
      $res = $cid->query($sql);
      return $res;
    }

    function createImgPost($cid, $mail, $desc, $path, $nome, $citta){

        $sql="INSERT INTO `POST` ( `mail`, `timestamp_post`, `tipo_post`, `img_desc`, `img_path`, `img_nome`, `img_citta`) VALUES ( '$mail', CURRENT_TIMESTAMP, 'Image', '$desc', '$path', '$nome', '$citta')";
        $res = $cid->query($sql);
        return $res;
    }

    function findComments($cid, $idpost){
      $sql = "SELECT comment_id, mail_commentatore, timestamp_commento, indice_gradimento, testo_commento, nome, cognome FROM COMMENTO JOIN USER on mail = mail_commentatore WHERE post_id = '$idpost'";

      $res =  $cid->query($sql);
      if ($res != null){
        $comms = null;
        while ($row=$res->fetch_assoc()) {
            $comms[] = array("comment_id"=>$row["comment_id"],
                            "mail_commentatore"=>$row["mail_commentatore"],
                            "timestamp_commento"=>$row["timestamp_commento"],
                            "indice_gradimento"=>$row["indice_gradimento"],
                            "testo_commento"=>$row["testo_commento"],
                            "nome"=>$row["nome"],
                            "cognome"=>$row["cognome"]
                          );
        }
        $risultato= $comms;
        return $risultato;
    }
    return null;

    }

    function AdminNUser($cid){
      $sql = "SELECT COUNT(nome) c FROM USER";
      $res = $cid->query($sql);
      $row= $res->fetch_assoc();
      return $row['c'];
    }

    function AdminNBlock($cid){
      $sql = "SELECT COUNT(nome) c FROM USER WHERE bloccatoda IS NOT NULL";
      $res = $cid->query($sql);
      $row= $res->fetch_assoc();
      return $row['c'];
    }
    
    function AdminNPost($cid){
      $sql = "SELECT COUNT(post_id) c FROM POST";
      $res = $cid->query($sql);
      $row= $res->fetch_assoc();
      return $row['c'];
    }

    function findPeasants($cid){
      $sql = "SELECT mail, nome, cognome, bloccatoda FROM USER WHERE tipo = 'User'";
      $res = $cid->query($sql);
      if ($res != null){
        $user = null;
        while ($row=$res->fetch_assoc()) {
            $user[] = array("mail"=>$row["mail"],
                            "nome"=>$row["nome"],
                            "cognome"=>$row['cognome'],
                            "bloccatoda"=>$row['bloccatoda']);
        }
        $risultato= $user;
        return $risultato;
      }
      return null;

    }

    function createComment($cid, $post, $text, $email, $grad){
      $sql="INSERT INTO `COMMENTO` (`mail_commentatore`, `post_id`, `timestamp_commento`, `indice_gradimento`, `testo_commento`) VALUES ('$email', '$post', CURRENT_TIMESTAMP, '$grad', '$text');";
      $res = $cid->query($sql);
      return $res;
    }

    function createRefComAPost($cid, $comment, $post){

    }
?>