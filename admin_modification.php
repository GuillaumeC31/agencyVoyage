<?php
session_start();

if(!isset($_SESSION['user']) && empty($_SESSION['user'])){
  header('Location: index.php');
}

$title = 'Agence de Voyage / Modification utilisateur';
require 'inc/config.php';
include 'partials/header.php';



if(!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])){
  //var_dump($_GET);
  //die('ERREUR : id invalide');
}

  // SELECT USER :
  $sql = 'SELECT * FROM users WHERE id = :id_param';
  $requete = $bdd->prepare($sql);
  $requete->bindValue(':id_param', $_GET['id']);
  $requete->execute();
  $user = $requete->fetch(PDO::FETCH_ASSOC);
  //var_dump($_GET);
  //var_dump($_GET);
  //print_r($user);

if(!empty($_POST)){

  $errors = [];
  $post = [];
  // Nettoyage
  foreach($_POST as $key => $value){
    $post[$key] = trim(strip_tags($value));
  }

  // vérif login
  if(strlen($post['login']) < 2 || strlen($post['login']) > 30){
    $errors[] = 'Votre nom d\'utilisateur doit comporter entre 2 et 30 caractères';
  }
  // verif email
  if(filter_var($post['email'], FILTER_VALIDATE_EMAIL) == false){
    $errors[] = 'Votre email est invalide';
  }
  // verif password
  if(!empty($post['password']) && !empty($post['confirm_password'])){

    if(strlen($post['password']) < 8){
      $errors[] = 'Votre mot de passe doit contenir au moins 8 caractères';
    }
    elseif($post['confirm_password'] !== $post['password']){
      $errors[] = 'Votre mot de passe et sa confirmation sont incorrects';
    }
  }

  if(count($errors) == 0){

    $sql = 'UPDATE users SET login = :new_login, email = :new_email, admin_right = :new_admin_right ';

    if(!empty($post['password']) && !empty($post['confirm_password'])){
      $sql.= ', password = :new_password ';
    }

    $sql.= 'WHERE id = :param_id';

    $update = $bdd->prepare($sql);
    $update->bindValue(':new_login', $post['login']);
    $update->bindValue(':new_email', $post['email']);
    $update->bindValue(':new_admin_right', $post['admin_right']);
    $update->bindValue(':param_id', $_GET['id']);
    //var_dump($_GET);

    if(!empty($post['password']) && !empty($post['confirm_password'])){
      $update->bindValue(':new_password', password_hash($post['password'], PASSWORD_DEFAULT));
    }

    if($update->execute()){

      $formValid = true;

      $to = $post['email'];
      $subject = 'inscription';
      $message = 'Bonjour '.$post['login'].',';
      $message .= '<br><br>Votre administrateur viens de modifier vos identifiants.';
      $message .= '<br>Veuillez les retrouver ci-dessous :';
      $message .= '<br><br>Login : '.$post['login'];
      $message .= '<br>Password : '.$post['password'];
      $message .= '<br>valeur des droits : '.$post['admin_right'];
      $message .= '<br><br>Veuillez noter que seul l\'admin peu modifier votre compte.';
      $headers = [
        'From' => 'contact@agencedevoyage.com',
        'Content-type' => 'text/html; charset=utf-8',
      ];

      mail($to, $subject, $message, $headers);


      //$_SESSION['user']['login'] = $post['login'];
    }
    else {
      // On est dans un cas d'erreur de dev. C'est que vous avez fait nawak !
      echo 'ERREUR SQL :';
      var_dump($request->errorInfo()); // Me donnera un message d'erreur SQL (pourquoi la requete SQL n'a pas fonctionné)
      die();
    }
  }
  else {
    $formValid = false;
  }
}


?>

<div class="row">
  <div class="col-12 col-md-6 col-lg-6 mx-auto">
    <div class="text-center">
      <h1>Modification Utilisateur</h1>
      <p>modifier les éléments d'un utilisateur</p>
    </div>
    <br>
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

    <form method="POST">
      <div class="border border-info rounded p-4">

      <div class="form-group mt-2">
        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" aria-describedby="login" name="login" value="<?=$user['login'];?>">
      </div>

      <div class="form-group mt-2">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" aria-describedby="email" name="email" value="<?=$user['email'];?>">
      </div>

      <div class="form-group mt-2">
        <label for="password">Modification Password</label>
        <input type="password" class="form-control" id="password" aria-describedby="password" name="password">
      </div>

      <div class="form-group mt-2">
        <label for="conrim_password">Confirm Modification Password</label>
        <input type="password" class="form-control" id="confirm_password" aria-describedby="password" name="confirm_password">
      </div>

      <div class="form-check mt-2">
        <input class="form-check-input" type="radio" name="admin_right" id="admin" value="1" <?=($user['admin_right'] == '1') ? 'checked' : '';?>>
        <label class="form-check-label" for="admin">
          droit administrateur
        </label>
      </div>
      <div class="form-check mt-2">
        <input class="form-check-input" type="radio" name="admin_right" id="standard" value="0" <?=($user['admin_right'] == '1') ? '' : 'checked';?>>
        <label class="form-check-label" for="standard">
          droit standard
        </label>
      </div>

      <button type="submit" class="btn btn-outline-info mt-4">Envoyer</button>

      </div>
    </form>
  </div>
</div>



<?php include 'partials/footer.php'; ?>
