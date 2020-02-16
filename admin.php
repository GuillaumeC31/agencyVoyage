<?php
session_start();

if(!isset($_SESSION['user']) && empty($_SESSION['user'])){
  header('Location: index.php');
}

$title = 'Gestion des offres';
require 'inc/config.php';
include 'partials/header.php';


// $sql = 'SELECT * FROM countries, travels
// WHERE `travels`.`country_id` = `countries`.`id` ORDER BY `travels`.`id` DESC';
$sql = 'SELECT * FROM countries
       RIGHT JOIN travels
       ON `travels`.`country_id` = `countries`.`id`
       ORDER BY `travels`.`id` DESC';
$requete = $bdd->prepare($sql);
$requete->execute();
$travels = $requete->fetchAll(PDO::FETCH_ASSOC);

?>
<main class="pb-5">

    <div class="container">
      <div class="row py-5">

      <!-- cards annonces -->
      <div class="col-12">
        <?php foreach($travels as $travel):?>
        <div class="card my-3">
          <div class="card-header h5" id="bouton_annonces"><?=$travel['entitled']?> -
            <span class="text-info"><?=$travel['nom_fr_fr']?></span>
          </div>

            <div class="card-body">
              <p class="card-text"><b>Hôtel :</b> <?=$travel['hostel_name']?></p>
              <p class="card-text"><b>Durée du séjour :</b> <?=$travel['term']?></p>
              <p class="card-text"><b>Prix :</b> <?=$travel['price']?> €</p>
              <a href="modification_sejour.php?id=<?=$travel['id']?>" class="btn btn-info">Modifier</a>
            </div>
          </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>

<?php
include 'partials/footer.php';
?>
