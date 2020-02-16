<?php
session_start();

if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
  header('Location: index.php');
}

$title = 'Agence de Voyage / Connexion';
require 'inc/config.php';
include 'partials/header.php';


if(!empty($_POST)){
  $errors = [];
  $post = [];


  foreach($_POST as $key => $value){
    $post[$key] = trim(strip_tags($value));
  }

  if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL) || empty($post['password'])){
    $errors[] = 'Vous devez saisir vos identifiants';
  }
  else {

    $sql = 'SELECT * FROM users WHERE email = :param_email';
    $request = $bdd->prepare($sql);
    $request->bindValue(':param_email', $post['email']);
    $request->execute();

    $my_user = $request->fetch(PDO::FETCH_ASSOC);

    if(!empty($my_user)){

      if(password_verify($post['password'], $my_user['password']) == false){
        $errors[] = 'Couple email / mot de passe invalide';
      }

    }
    else {
      $errors[] = 'Couple email / mot de passe invalide';
    }

  }


  if(count($errors) === 0){
    $formValid = true;


    $_SESSION['user'] = [
      'id'          => $my_user['id'],
      'login'       => $my_user['login'],
      'admin_right' => $my_user['admin_right'],
    ];

    //  Redirection après connexion
    header('Location: admin.php');

  }
  else {
    $formValid = false;
  }


}

?>

<div class="container">

<div class="row">
  <div class="col-12 col-md-6 col-lg-6 mx-auto">
    <div class="text-center">
    <h1>Connexion</h1>
    <p>text</p>
    </div>
    <div class="text-center">
      <?php if(isset($formValid) && $formValid == true):?>
        <div class="alert alert-success text-center">
          <p>l'inscription de <?=$post['login'];?> a bien été prise en compte!<br>
            Un email de confirmation d'inscription a été envoyer.<br>
          En vous remerciant</p>
        </div>
      <?php elseif(isset($formValid) && $formValid == false):?>
          <div class="alert alert-danger text-center">
            <?=implode('<br>', $errors);?>
          </div>
      <?php endif;?>
    </div>




      <form method="POST" enctype="multipart/form-data">
              <div class="border border-success rounded p-4">

        <div class="form-group mt-2">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" aria-describedby="email" name="email">
        </div>

        <div class="form-group mt-2">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" aria-describedby="password" name="password">
        </div>


        <button type="submit" class="btn btn-outline-success mt-2">Envoyer</button>

        <hr>

        <div class="form-group mt-2">

        </div>

      </div>

      </form>

    </div>
  </div>
</div>

<?php include 'partials/footer.php'; ?>
