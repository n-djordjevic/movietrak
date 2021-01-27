<?php
include "database.php";

function alert($message){
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
if (isset($_GET['id'])) {
	$film_id = $_GET['id'];

	// upit za popunjavanje trenutnih vrednosti polja na formi
	$sql = "SELECT * FROM `filmovi` WHERE `id`='$film_id'";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()) {
			$film_id = $row['id'];
			$naslov = $row['naslov'];
			$godina = $row['godina'];
			$reziser = $row['reziser'];
		}

?>
		<h2>Ažuriranje filma</h2>
		<form action="" method="post">
			<fieldset>
				<legend>Informacije o filmu:</legend>
				Naslov:<br>
				<input type="text" name="naslov" value="<?php echo $naslov; ?>">
				<input type="hidden" name="film_id" value="<?php echo $film_id; ?>">
				<br>
				Godina:<br>
				<input type="text" name="godina" value="<?php echo $godina; ?>">
				<br>
				Režiser:<br>
				<input type="text" name="reziser" value="<?php echo $reziser; ?>">
				<br><br>
				<input type="submit" value="Ažuriraj" name="update_film">
			</fieldset>
		</form>

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
		}

	?>
		<h2>Ažuriraj ocenu</h2>
		<form action="" method="post">
			<fieldset>
				<legend>Informacije o oceni:</legend>
				Ocena:<br>
				<input type="text" name="ocena" value="<?php echo $ocena; ?>">
				<input type="hidden" name="ocena_id" value="<?php echo $ocena_id; ?>">
				<br>
				Opis ocene:<br>
				<input type="text" name="opis" value="<?php echo $opis; ?>">

				<br><br>
				<input type="submit" value="Ažuriraj" name="update_ocena">
			</fieldset>
		</form>

		</body>

		</html>


<?php
	//ako url nema ni jedan od prethodna dva parametara a radi se o update-u vrati se na view stranicu
	} else {
		header('Location: view.php');
	}
}

?>