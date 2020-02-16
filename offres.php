<?php

$title = 'Toutes nos offres';
require 'inc/config.php';
include 'partials/header.php';




$sql = 'SELECT * FROM travels WHERE country_id = 75 ORDER BY RAND()';
$requete = $bdd->prepare($sql);
$requete->execute();
$travels_france = $requete->fetchAll(PDO::FETCH_ASSOC);

$sql2 = 'SELECT * FROM travels WHERE country_id = 54 ORDER BY RAND()';
$requete = $bdd->prepare($sql2);
$requete->execute();
$travels_costa_rica = $requete->fetchAll(PDO::FETCH_ASSOC);



?>
<main class="pb-5">
    <div class="container pb-2">

      <!-- annonces voyages -->
      <div class="row">
            <div class="col-12 pt-5">
              <h4>France : </h4>
            </div>
      </div>

          <div class="row text-center py-3">

            <?php foreach($travels_france as $travel_france):?>
            <div class="col-4 flex-row bd-highlight pb-3">
              <!-- Destinations top 3 -->
                <div class="card" style="width: 18rem;">
                <img src="img/upload/<?=$travel_france['picture']?>" height="150" class="card-img-top" alt="">
                <div class="card-body">
                  <h5 class="card-title"><?=$travel_france['entitled']?></h5>
                  <p class="card-text"><?=$travel_france['description']?></p>
                  <a href="annonce.php?id=<?=$travel_france['id']?>" class="btn btn-info" role="button">En savoir plus</a>
                </div>
              </div>
            </div>
            <?php endforeach;?>
          </div>
    </div>

    <div class="container pb-5">

      <!-- annonces voyages -->
      <div class="row">
            <div class="col-12 pt-2">
              <h4>Costa Rica : </h4>
            </div>
      </div>

          <div class="row text-center py-3">

            <?php foreach($travels_costa_rica as $travel_costa_rica):?>
            <div class="col-4 flex-row bd-highlight pb-3">
              <!-- Destinations top 3 -->
                <div class="card" style="width: 18rem;">
                <img src="img/upload/<?=$travel_costa_rica['picture']?>" height="150" class="card-img-top" alt="">
                <div class="card-body">
                  <h5 class="card-title"><?=$travel_costa_rica['entitled']?></h5>
                  <p class="card-text"><?=$travel_costa_rica['description']?></p>
                  <a href="annonce.php?id=<?=$travel_costa_rica['id']?>" class="btn btn-info" role="button">En savoir plus</a>
                </div>
              </div>
            </div>
            <?php endforeach;?>
          </div>
    </div>


<?php
include 'partials/footer.php';
?>
