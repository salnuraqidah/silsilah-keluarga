<div class="row">
	<div class="col-md-12">
		<?php
		if (!empty($_GET['hal'])) {
			include_once $_GET['hal'] . '.php';
		} else {
			include_once 'home.php';
		}
		?>
	</div>