<?php 
include "database.php";

function alert($message){
    echo "<script>alert('$message');</script>"; 
}

// uzimamo id elementa koji treba da se brise iz url-a
if (isset($_GET['id'])) {
	$film_id = $_GET['id'];

	// upit
	$film_sql = "DELETE FROM `filmovi` WHERE `id`='$film_id'";
	$film_result = $conn->query($film_sql);

	if ($film_result == TRUE) {
        alert("Uspešno ste obrisali film.");
        header('Location: view.php');
	}else{
		alert("Error:" . $film_sql . "<br>" . $conn->error);
	}
}

// uzimamo id elementa koji treba da se brise iz url-a
if (isset($_GET['id_ocene'])) {
	$ocena_id = $_GET['id_ocene'];

	// upit
	$ocena_sql = "DELETE FROM `ocene` WHERE `id`='$ocena_id'";
	$ocena_result = $conn->query($ocena_sql);

	if ($ocena_result == TRUE) {
        alert("Uspešno ste obrisali ocenu.");
        header('Location: view.php');
	}else{
		alert("Error:" . $ocena_sql . "<br>" . $conn->error);
	}
}


?>