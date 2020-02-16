<?php
$openings = [
	1   => [
      'start' => '09:00',
      'end'   => '18:00',
      ],

	2   => [
	    'start' => '09:00',
	    'end'   => '18:00',
	],
	3   => [
	    'start' => '09:00',
	    'end'   => '18:00',
	],
	4   => [
	    'start' => '09:00',
	    'end'   => '18:00',
	],

	5   => [
	    'start' => '09:00',
	    'end'   => '18:00',
	],
	6   => [
	    'start' => '09:00',
	    'end'   => '16:00',
	],
	7   => null,
];
// Liste des jours
$days = [
	1 => 'Lundi',
	2 => 'Mardi',
	3 => 'Mercredi',
	4 => 'Jeudi',
	5 => 'Vendredi',
	6 => 'Samedi',
	7 => 'Dimanche',
];

?>

</main>

<footer class="mt-auto">
  <div class="container-fluid text-light bg-info py-3">
  <div class="container">
    <div class="row mx-auto">
      <div class="col-4" style="list-style: none;">
          <h4>Horaires :</h4>
        <?php
        foreach ($openings as $key => $value) {

            echo '<li>';
            echo '<strong>' . $days[$key] . ' : </strong>';

         if(is_null($value)){
           echo 'fermé';
         }

         elseif(is_array($value)){
            echo $value['start'] . ' - ' . $value['end'];
         }
            echo '</li>';
        }
        ?>
      </div>
			<div class="col-4">
				<div class="row mx-auto">
				  <div class="col-12">

						<ul style="list-style: none; color: white;">
							<h4>Contact :</h4>
							<li><a href="#">Aide/FAQ</a></li>
							<li><a href="#">Presse</a></li>
							<li><a href="#">Propriétaires d’hôtels</a></li>
							<li><a href="#">Professionnels</a></li>
							<li><a href="#">Assurance</a></li>
						</ul>
				  </div>
				</div>
			</div>

			<div class="col-4">
				<div class="row mx-auto">
					<div class="col-12">

						<ul style="list-style: none;">
							<h4>À propos</h4>
							<li><a href="#">Qui sommes-nous ?</li>
							<li><a href="#">Conditions générales</a></li>
							<li><a href="#">Déclaration de confidentialité</a></li>
							<li><a href="#">Professionnels</a></li>
							<li><a href="#">Assurance</a></li>
						</ul>
					</div>
				</div>
			</div>

		</div>
  </div>
</div>
</footer>


<!--JQurey first, then Popper.js, then Bootstrap JS-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>
