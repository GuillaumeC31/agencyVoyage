<!DOCTYPE html>
 <html lang="fr" dir="ltr" class="h-100">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title><?=$title ?? 'Agence de Voyages';?></title>

     <!--Bootstrap-->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

     <!-- css -->
     <link rel="stylesheet" href="css/style.css">

   </head>

   <header>
     
    <!--Nav-->
 		<nav class="navbar navbar-expand-lg text-light bg-info pb-3">
      <a class="navbar-brand js-scroll-trigger"> <a href="index.php"><i class="fas fa-plane-departure pr-2"></i> Agence de Voyages</a>
 			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
 				<span class="navbar-toggler-icon"></span>
 			</button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
          <li class="nav-item">
            <a href="creation_sejour.php" class="nav-link js-scroll-trigger text-light">Ajouter annonce</a>
          </li>
          <li class="nav-item">
            <a href="modifications_sejour.php" class="nav-link js-scroll-trigger text-light">Modifier annonce</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link js-scroll-trigger text-light">Création profil</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link js-scroll-trigger text-light">Se déconnecter</a>
          </li>
        <?php else:?>
          <li class="nav-item">
          <a href="index.php" class="nav-link js-scroll-trigger text-light mr-2">Accueil</a>
        </li>
          <li class="nav-item">
          <a href="annonces.php" class="nav-link btn btn-outline-dark js-scroll-trigger text-light">Voir toutes nos offres</a>
        </li>

        <?php endif;?>
        </ul>
      </div>
    </nav>
