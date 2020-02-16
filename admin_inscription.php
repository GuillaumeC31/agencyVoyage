<?php
session_start();

if(!isset($_SESSION['user']) && empty($_SESSION['user'])){
  header('Location: index.php');
}

$title = 'Agence de Voyage / Inscription Utilisateur';
require 'inc/config.php';
require 'inc/function.php';
include 'partials/header.php';

if(!empty($_POST)){

  $errors = [];
  $post = [];

  foreach($_POST as $key => $value){
    $post[$key] = trim(strip_tags($value));
  }


  if(strlen($post['login']) < 2 || strlen($post['login']) > 30){
    $errors[] = 'Votre nom d\'utilisateur doit comporter entre 2 et 30 caractères';
  }
  elseif(checkUsernameExist($post['login'])){
    $errors[] = 'Ce nom d\'utilisateur existe déjà';
  }

  if(filter_var($post['email'], FILTER_VALIDATE_EMAIL) == false){
    $errors[] = 'Votre email est invalide';
  }
  elseif(checkEmailExist($post['email'])){
    $errors[] = 'Cette adresse email est déjà inscrite';
  }

  if(strlen($post['password']) < 8){
    $errors[] = 'Votre mot de passe doit contenir au moins 8 caractères';
  }
  elseif($post['confirm_password'] !== $post['password']){
    $errors[] = 'Votre mot de passe et sa confirmation sont incorrects';
  }


  if(count($errors) > 0){
    $formValid = false;
  }
  else{

    $sql = 'INSERT INTO users ( login,
                                email,
                                password,
                                admin_right)
            VALUES( :data_login,
                    :data_email,
                    :data_password,
                    :data_right)';

    $request = $bdd->prepare($sql);
    $request->bindValue(':data_login', $post['login']);
    $request->bindValue(':data_email', $post['email']);
    $request->bindValue(':data_password', password_hash($post['password'], PASSWORD_DEFAULT));
    $request->bindValue(':data_right', $post['admin_right']);

    if($request->execute()){

      $formValid = true;

      $to = $post['email'];
      $subject = 'inscription';
      $message = 'Bonjour '.$post['login'].', <br> Votre administrateur viens de créer vos identifiants. <br> Veuillez les Dans ce mail';
      $message .= '<br> Votre administrateur viens de créer vos identifiants.';
      $message .= '<br> Veuillez les trouver ci-dessous :';
      $message .= 'Login : '.$post['login'];
      $message .= 'Password : '.$post['password'];
      $message .= 'valeur des droits : '.$post['admin_right'];
      $message .= 'Veuillez noter que seul l\'admin peu modifier votre mot de passe si vous le perdez.';
      $headers = [
        'From' => 'contact@agencedevoyage.com',
      ];

      mail($to, $subject, $message, $headers);

    }
    else {
      $formValid = false;
      die();
    }

  }


}

?>
<div class="container">

<div class="row">
  <div class="col-12 col-md-6 col-lg-6 mx-auto">
    <div class="text-center">
      <h1>Inscription</h1>
      <p>Inscription d'un utilisateur</p>
    </div>
    <br>
    <div class="text-center">
      <?php if(isset($formValid) && $formValid == true):?>
        <div class="alert alert-success text-center">
          <p>l'inscription de <?=$post['login'];?> a bien été prise en compte!<br>
            Un email de confirmation d'inscription a été envoyé.<br>
          En vous remerciant.</p>
        </div>
      <?php elseif(isset($formValid) && $formValid == false):?>
          <div class="alert alert-danger text-center">
            <?=implode('<br>', $errors);?>
          </div>
      <?php endif;?>
    </div>

    <form method="POST" enctype="multipart/form-data">
      <div class="border border-info rounded p-4">



      <div class="form-group mt-2">
        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" aria-describedby="login" name="login">
      </div>

      <div class="form-group mt-2">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" aria-describedby="email" name="email">
      </div>

      <div class="form-group mt-2">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" aria-describedby="password" name="password">
      </div>

      <div class="form-group mt-2">
        <label for="conrim_password">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" aria-describedby="password" name="confirm_password">
      </div>

      <div class="form-check mt-2">
        <input class="form-check-input" type="radio" name="admin_right" id="admin" value="1" checked>
        <label class="form-check-label" for="admin">
          droit administrateur
        </label>
      </div>
      <div class="form-check mt-2">
        <input class="form-check-input" type="radio" name="admin_right" id="standard" value="0">
        <label class="form-check-label" for="standard">
          droit standard
        </label>
      </div>

      <button type="submit" class="btn btn-outline-info mt-4">Envoyer</button>

      </div>

    </form>

  </div>
</div>
</div>

<?php include 'partials/footer.php'; ?>
