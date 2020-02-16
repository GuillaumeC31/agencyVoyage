<!DOCTYPE html>
 <html lang="fr" dir="ltr" class="h-100">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$title ?? 'Agence de Voyages';?></title>

     <!--Bootstrap-->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

     <!--google fonts-->


     <!-- css -->
     <link rel="stylesheet" href="css/style.css">

   </head>
   <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info pb-3">
      <span> <img src="img/webforcetweet_fav.png" alt=""></span>
      <a class="navbar-brand js-scroll-trigger pl-3"> Agence de Voyages
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
          <li class="nav-item">
            <a href="#" class="nav-link js-scroll-trigger text-light">Ajouter annonces</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link js-scroll-trigger text-light">Listing</a>
          </li>
        <?php else:?>
          <li class="nav-item">
          <a href="#" class="nav-link js-scroll-trigger text-light">Voir plus d'annonces</a>
        </li>

        <?php endif;?>
        </ul>
      </div>
    </nav>
