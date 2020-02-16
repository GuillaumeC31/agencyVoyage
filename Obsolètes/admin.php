<?php
session_start();

//if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
//  header('Location: index.php');

$title = 'Agence de Voyage / Liste Utilisateur';
require 'inc/config.php';
include 'partials/header.php';


// SELECT USER :
$sql = 'SELECT * FROM users';
$requete = $bdd->prepare($sql);
$requete->execute();
$users = $requete->fetchAll(PDO::FETCH_ASSOC);



/* Liste des Utilistateurs */


?>
<div class="row">
  <div class="col-12 col-md-6 col-lg-8 mx-auto">
    <div class="text-center">
      <h1>Modification Utilisateur</h1>
      <p>Liste des utilisateurs</p>
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

    <form>
      <div class="table-responsive">

      </div>
    </form>

  </div>

<?php include 'partials/footer.php'; ?>


