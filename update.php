<?php
include "database.php";

function alert($message)
{
	echo "<script>alert('$message');</script>";
}

// azuriranje filma
if (isset($_POST['update_film'])) {
	$naslov = $_POST['naslov'];
	$film_id = $_POST['film_id'];
	$godina = $_POST['godina'];
	$reziser = $_POST['reziser'];

	// proveravamo da li je uneta godina veca od trenutne
	if ($godina > date("Y") || $godina < 1888) {
		alert("Greška prilikom unosa godine");
	} else {
		// update upit
		$sql = "UPDATE `filmovi` SET `naslov`='$naslov',`godina`='$godina',`reziser`='$reziser' WHERE `id`='$film_id'";

		$result = $conn->query($sql);

		if ($result == TRUE) {
			alert("Uspešno ste ažurirali film!");
			header('Location: view.php');
		} else {
			alert("Greška:" . $sql . "<br>" . $conn->error);
		}
	}
}

// azuriranje ocene
if (isset($_POST['update_ocena'])) {
	$ocena = $_POST['ocena'];
	$ocena_id = $_POST['ocena_id'];
	$opis = $_POST['opis'];

	if ($ocena > 5 || $ocena < 1) {
		alert("Greška prilikom unosa ocene.");
	} else {
		$sql = "UPDATE `ocene` SET `ocena`='$ocena',`opis`='$opis' WHERE `id`='$ocena_id'";


		$result = $conn->query($sql);

		if ($result == TRUE) {
			alert("Uspešno ste ažurirali ocenu!");
			header('Location: view.php');
		} else {
			alert("Greška:" . $sql . "<br>" . $conn->error);
		}
	}
}

// ako u url-u imamo samo id kao paremater onda se radi o azuriranju filma
if (isset($_GET['id_filma'])) {
	$id = $_GET['id_filma'];


	// upit za popunjavanje trenutnih vrednosti polja na formi
	$sql = "SELECT * FROM `filmovi` WHERE `id`='$id'";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()) {
			$id = $row['id'];
			$naslov = $row['naslov'];
			$godina = $row['godina'];
			$reziser = $row['reziser'];
		}

?>


		<!DOCTYPE html>
		<html lang="en">

		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>MovieTRAK</title>

			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		</head>

		<body>


		<div class="container" style="margin-top:50px">
			<div class="row">
				<h2>Ažuriraj film:</h2>
				<h1><?php echo $naslov; ?></h1>
			</div>
			<div class="col-6">
				<form action="" method="POST">
					<div class="form-group">
						<label for="naslov">Naslov</label>
						<input type="text" class="form-control" name="naslov" value="<?php echo $naslov; ?>">
						<input type="hidden" name="film_id" value="<?php echo $id; ?>">
					</div>
					<div class="form-group">
						<label for="godina">Godina</label>
						<input type="text" class="form-control" name="godina" value="<?php echo $godina; ?>">
					</div>
					<div class="form-group">
						<label for="reziser">Reziser</label>
						<input type="text" class="form-control" name="reziser" value="<?php echo $reziser; ?>">
					</div>
					<br><br>
					<input type="submit" name="update_film" value="Ažuriraj" class="btn btn-primary">
				</form>
			</div>
		</div>

		</body>

		</html>



<?php
	}
}


// ako se u url-u nadje id_ocene kao parametar onda znamo da se radi o azuriranju ocene
if (isset($_GET['id_ocene'])) {
	$ocena_id = $_GET['id_ocene'];

	// vrati info o trazenoj oceni
	$ocena_sql = "SELECT * FROM `ocene` WHERE `id`='$ocena_id'";
	$ocena_result = $conn->query($ocena_sql);

	if ($ocena_result->num_rows > 0) {
		while ($row = $ocena_result->fetch_assoc()) {
			$ocena_id = $row['id'];
			$ocena = $row['ocena'];
			$opis = $row['opis'];
			$film_id_ocena = $row['id_filma'];
		}
	}

	// vrati naslov vezan za trazenu ocenu
	$film_naslov_sql = "SELECT * FROM `filmovi` WHERE `id`='$film_id_ocena'";
	$film_naslov_result = $conn->query($film_naslov_sql);

	if ($film_naslov_result->num_rows > 0) {
		while ($film_row = $film_naslov_result->fetch_assoc()) {
			$film_naslov = $film_row['naslov'];
		}
	}


	?>


	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>MovieTRAK</title>

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	</head>

	<body>

		<div class="container" style="margin-top:50px">
			<div class="row">
				<h2>Ažuriraj ocenu za film:</h2>
				<h1><?php echo $film_naslov; ?></h1>
			</div>
			<div class="col-6">
				<form action="" method="POST">
					<div class="form-group">
						<label for="naslov">Ocena</label>
						<input type="text" class="form-control" name="ocena" value="<?php echo $ocena; ?>">
						<input type="hidden" name="ocena_id" value="<?php echo $ocena_id; ?>">
					</div>
					<div class="form-group">
						<label for="godina">Opis</label>

						<input type="text" class="form-control" name="opis" value="<?php echo $opis; ?>">


					</div>
					<br><br>
					<input type="submit" name="update_ocena" value="Ažuriraj" class="btn btn-primary">
				</form>
			</div>
		</div>

	</body>

	</html>


<?php
} 
?>