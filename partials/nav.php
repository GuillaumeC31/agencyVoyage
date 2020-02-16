
<!--Nav-->
    <nav class="navbar navbar-expand-lg text-light bg-info pb-3">
      <a class="navbar-brand js-scroll-trigger"> <a href="index.php"><i class="fas fa-plane-departure pr-2"></i> Agence de Voyages</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">


            <li class="nav-item">
              <a href="index.php" class="nav-link js-scroll-trigger text-light mr-2">Accueil</a>
            </li>

        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {

            if ($_SESSION['user']['admin_right'] == 1) {

              echo '<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Gestion des Annonces</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="creation_sejour.php">Ajouter annonce</a>
                      <a class="dropdown-item" href="admin.php">Modifier annonce</a>
                    </li>';

              echo '<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Gestion des Utilisateurs</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="admin_inscription.php">Creation utilisateur</a>
                      <a class="dropdown-item" href="admin_liste_user.php">Liste utilisateur</a>
                    </li>';

              echo  '<li class="nav-item">
                  <a href="deconnexion.php" class="nav-link js-scroll-trigger text-light mr-2">déconnexion</a>
                  </li>';

            }
            elseif ($_SESSION['user']['admin_right'] == 0) {

              echo '<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Gestion des Annonces</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="creation_sejour.php">Ajouter annonce</a>
                      <a class="dropdown-item" href="modifications_sejour.php">Modifier annonce</a>
                    </li>';
              echo  '<li class="nav-item">
                  <a href="deconnexion.php" class="nav-link js-scroll-trigger text-light mr-2">déconnexion</a>
                  </li>';
              }

          }
          else {

            echo '<li class="nav-item">
                  <a href="offres.php" class="nav-link btn btn-outline-dark js-scroll-trigger text-light">Voir toutes nos offres</a>
                  </li>';

            echo '<li class="nav-item">
                  <a href="connexion.php" class="nav-link js-scroll-trigger text-light mr-2">connexion</a>
                  </li>';
          }



          ?>

        </ul>
      </div>
    </nav>
