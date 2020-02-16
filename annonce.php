<?php

$title = 'Voici l\'offre';
require 'inc/config.php';
include 'partials/header.php';



if(!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])){

}

$sql = 'SELECT * FROM travels WHERE id = :id_param';

/*
$sql = 'SELECT * FROM countries
        RIGHT JOIN travels
        ON `travels`.`country_id` = `countries`.`id`';


// $sql = 'SELECT * FROM countries, travels WHERE `country_id` = `travels.pays_id`';
// $sql = 'SELECT * FROM travels WHERE id = :id_param';
// $sql = 'SELECT * FROM countries INNER JOIN travels ON `country_id` = `travels.pays_id`';

<p class="card-text"><?=$travel['nom_fr_fr']?></p>
*/

$requete = $bdd->prepare($sql);
$requete->bindValue(':id_param', $_GET['id']);
$requete->execute();
$travels = $requete->fetchAll(PDO::FETCH_ASSOC);

?>
<main class="pb-5">
    <div class="container text-center rounded border border-info shadow p-4 mt-5">
      <div class="row">
        <?php foreach($travels as $travel):?>
      <div class="col-12">
        <h4 class="card-title my-3"><?=$travel['entitled']?></h4>
        <img src="img/upload/<?=$travel['picture']?>" height="150" class="img-fluid" alt="">

        <div class="card-body">
          <p class="btn btn-outline-info"><?=$travel['price']?> €</p>

          <p class="card-text"><b class="h5"><?=$travel['hostel_name']?></b></p>
          <p class="card-text"><?=$travel['term']?></p>
          <p class="card-text"><?=$travel['description']?></p>

      </div>
    <?php endforeach;?>

      </div>
</div>

<?php
include 'partials/footer.php';
?>
