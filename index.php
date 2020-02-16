<?php

session_start();

$title = 'Agence de Voyage - Index';
require 'inc/config.php';
include 'partials/header.php';


if(!empty($_POST)){

  $errors = [];
  $post = [];

  foreach ($_POST as $key => $value) {
    $post[$key] = trim(strip_tags($value));
  }


    if(strlen($post['input_firstname']) < 2) {
      $errors[] = 'Votre prénom doit comporter 2 caractères minimun.';
    }
    if(strlen($post['input_lastname']) < 5) {
      $errors[] = 'Votre nom doit comporter 5 caractères minimun.';
    }


    if(empty($post['input_phone'])){

      $search = [' ', '.', '-','/'];
      $replace = '';
      $phone = str_replace($search, $replace, $post['input_phone']);

      if(strlen($phone) != 10 || !is_numeric($phone)){
      $errors[] = 'Votre numéro de téléphone est invalide.';
      }
      else {
    		$errors[] = 'Vous devez saisir un numéro de téléphone.';
    	}
    }


    if(!filter_var($post['input_email'], FILTER_VALIDATE_EMAIL)){
      $errors[] = 'Vous devez saisir votre email.';
    }


    if(strlen($post['input_message']) < 20){
      $errors[] = 'Votre message doit contenir 20 caractères minimum.';
    }

    if(empty($post['input_select'])){
         $errors[] = 'Merci de sélectionner une destination.';
    }



  if(count($errors) == 0){
    $formValid = true;

    $to = 'contact@agencevoyage.fr';
        $subject = 'Nouveau message du site en date du ' .date('d-m-Y H:i');
        $message = 'Bonjour' . "\r\n";
        $message .= $post['input_firstname'] . ' ' . $post['input_lastname'] . "\r\n";

        $message .= ' ' . "\n";
        $message .= 'Nous avons bien reçu votre message concernant la destination ' . $post['input_select'] . "\r\n";
        $message .= 'Nous répondrons dans les plus brefs délais.';

        $headers = [
                    'From'     => 'no-reply@agencevoyage.fr',
                    'Reply-To' => 'no-reply@agencevoyage.fr',
        ];

        mail($to, $subject, $message, $headers);

  }
    else {
      $formValid = false;
    }
}

$sql = 'SELECT * FROM travels';
$requete = $bdd->prepare($sql);
// $requete->bindValue(':select_pays', $post['input_select']);
$requete->execute();
$travels_select = $requete->fetchAll(PDO::FETCH_ASSOC);



$sql2 = 'SELECT * FROM travels ORDER BY actived = "on" DESC LIMIT 3';
$requete = $bdd->prepare($sql2);
$requete->execute();
$travels = $requete->fetchAll(PDO::FETCH_ASSOC);


// var_dump($_POST);
?>


  <div class="jumbotron jumbotron-fluid m-0 text-light" id="bg_img_jumbotron">
    <div class="container display-3 shadow_text">1 chambre lit double</div>
    <div class="container display-4 shadow_text">Dans un de nos plus beaux hôtels</div>
    <div class="container h4 shadow_text"> <i class="fa fa-map-marker fa-xs" style="color:white" aria-hidden="true"></i>
      Paris, France</div>
    <div class="container text-light">
      <button type="button" class="btn btn-info mt-3">En savoir plus</button>
    </div>
  </div>

    <div class="container pb-5">

      <!-- annonces voyages -->
      <div class="row text-center py-5 mx-auto">

        <?php foreach($travels as $travel):?>
        <div class="col-12 col-lg-4 flex-wrap pb-3">

          <!-- Destinations top 3 -->
          <div class="card" style="width: 20rem;">
            <img src="img/upload/<?=$travel['picture']?>" height="150" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title"><?=$travel['entitled']?></h5>
              <p class="card-text"><?=$travel['description']?></p>

              <a href="annonce.php?id=<?=$travel['id']?>" class="btn btn-info" role="button">En savoir plus</a>
            </div>
          </div>
        </div>
          <?php endforeach;?>
      </div>
    </div>

    <div class="container pb-5">


        <!-- formulaire -->
        <div class="row pt-3">
          <h2 class="pb-3">Nous contacter :</h2>

          <div class="col-12 border border-info rounded p-5 shadow">

            <!-- messages d'erreurs-->
            <div class="row">
              <div class="col-12">
                <?php  if(isset($formValid) && $formValid == true):?>
                  <div class="alert alert-success text-center">
                    Merci pour votre message, un email de confirmation vous a été envoyé.
                  </div>
                <?php elseif(isset($formValid) && $formValid == false):?>
                  <div class="alert alert-danger text-center">
                    <?=implode('<br>', $errors);?>
                  </div>
                <?php endif;?>
              </div>
            </div>

            <form method="post">


              <div class="form-group">
              <!-- Firstname & Lastname -->
                <div class="row">
                  <div class="col-6">
                    <label for="firstname">Prénom :</label>
                    <input type="text" name="input_firstname" id="firstname" class="form-control" placeholder="Votre prénom">
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="lastname">Nom :</label>
                      <input type="text" name="input_lastname" id="lastname" class="form-control" placeholder="Votre nom">
                    </div>
                  </div>
                </div>
              </div>

                <!-- Phone & Email -->
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="phone">Téléphone :</label>
                      <input type="text" name="input_phone" id="phone" class="form-control" placeholder="Votre numéro ">
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="email">Email :</label>
                      <input type="email" name="input_email" id="email" class="form-control" placeholder="Votre email">
                    </div>
                  </div>
                </div>

                <!-- Message -->
                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea class="form-control" name="input_message" id="message" placeholder="Votre message" rows="6"></textarea>
                  <small class="text-muted">Votre message doit contenir au moins 20 caractères.</small>
                </div>

                <div class="row">
                  <div class="col-6">

                    <!-- Select -->
                    <div class="input-group mb-3">
                      <select class="custom-select" name="input_select" id="pays_select">
                        <option value="0" selected>-- Choississez votre séjour --</option>
                        <?php foreach($travels_select as $travel_select):?>
                        <option value="<?=$travel_select['id']?>"><?=$travel_select['entitled'];?></option>
                      <?php endforeach;?>
                      </select>
                    </div>
                  </div>

                  <!-- Submit -->
                  <div class="col-6">
                    <div class="text-right">
                      <button type="submit" class="btn btn-outline-info">Envoyer</button>
                  </div>
                </div>
            </form>

          </div>
        </div>
      </div>

<?php
include 'partials/footer.php';
?>
