<?php
include "database.php";




?>

<!DOCTYPE html>
<html>

<head>
	<title>MovieTRAK</title>

	<!-- bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">MovieTRAK</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="view.php">Preged filmova i ocena</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="create.php?unos=0">Dodaj filmove</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="create.php?unos=1">Dodaj ocene</a>
					</li>
				</ul>
				<form class="d-flex">
					<input class="form-control me-2" type="search" placeholder="Pretraga po naslovu" onkeyup="search_func(this.value)" aria-label="Pretraga" id="pretraga">
					<button class="btn btn-outline-success" type="submit">Osveži</button>
				</form>
			</div>
		</div>
	</nav>
	<div class="container">
		<h2>Filmovi</h2>
		<input type='hidden' id='sort' value='asc'>
		<table class="table" id="f-tabela">
			<thead>
				<tr>
					<th><span id="id" onclick='sortTable("id");'><i id="id-icon" class="bi bi-arrow-down-short"></i>ID</th>
					<th><span id="naslov" onclick='sortTable("naslov");'><i id="naslov-icon" class="bi bi-arrow-down-short"></i>Naslov</th>
					<th><span id="godina" onclick='sortTable("godina");'><i id="godina-icon" class="bi bi-arrow-down-short"></i>Godina</th>
					<th><span id="reziser" onclick='sortTable("reziser");'><i id="reziser-icon" class="bi bi-arrow-down-short"></i>Reziser</th>
					<th>Opcije</th>
				</tr>
			</thead>
			<tbody id="filmovi-tabela">


				<?php
				// upiti
				$filmovi_sql = "SELECT * FROM filmovi ORDER BY id ASC";
				$filmovi_result = $conn->query($filmovi_sql);

				if ($filmovi_result->num_rows > 0) {

					while ($row = $filmovi_result->fetch_assoc()) {
				?>

						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['naslov']; ?></td>
							<td><?php echo $row['godina']; ?></td>
							<td><?php echo $row['reziser']; ?></td>
							<td><a class="btn btn-info" href="update.php?id_filma=<?php echo $row['id']; ?>">Ažuriraj</a>&nbsp;<a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Obriši</a></td>
						</tr>

				<?php		}
				}

				?>

			</tbody>
		</table>
	</div>

	<br>
	<br>
	<br>

	<div class="container">
		<h2>Ocene</h2>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Naslov filma</th>
					<th>Ocena</th>
					<th>Opis</th>
					<th>Opcije</th>
				</tr>
			</thead>
			<tbody id="ocene-tabela">
				<?php
				$ocene_sql = "SELECT * FROM ocene ORDER BY id ASC";
				$ocene_result = $conn->query($ocene_sql);

				if ($ocene_result->num_rows > 0) {

					while ($row = $ocene_result->fetch_assoc()) {

						$id = $row['id_filma'];
						$naslov_sql = "SELECT naslov FROM filmovi WHERE id = $id";
						$naslov_result = $conn->query($naslov_sql);
				?>

						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $naslov_result->fetch_assoc()['naslov']; ?></td>
							<td><?php echo $row['ocena']; ?></td>
							<td><?php echo $row['opis']; ?></td>
							<td><a class="btn btn-info" href="update.php?id_ocene=<?php echo $row['id']; ?>">Ažuriraj</a>&nbsp;<a class="btn btn-danger" href="delete.php?id_ocene=<?php echo $row['id']; ?>">Obriši</a></td>
						</tr>

				<?php		}
				}
				?>

			</tbody>
		</table>
	</div>

</body>
<script>
	function search_func(value) {

		console.log(value)
		var xhttp = new XMLHttpRequest();

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("filmovi-tabela").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "search.php?s=" + value, true);
		xhttp.send();
	}

	function sortTable(columnName) {

		var sort = $("#sort").val();
		$.ajax({
			url: 'sort.php',
			type: 'post',
			data: {
				columnName: columnName,
				sort: sort
			},
			success: function(response) {

				$("#f-tabela tr:not(:first)").remove();

				$("#f-tabela").append(response);
				if (sort == "asc") {
					$("#sort").val("desc");
				} else {
					$("#sort").val("asc");
				}

			}
		});
	}

	$(document).on('click', function(e) {
		clicked_id = e.target.id;
		clicked_class = $('#' + e.target.id + "-icon").attr('class');
		if (clicked_class.includes("down")) {
			$('#' + e.target.id + "-icon").attr('class', 'bi bi-arrow-up-short');
		} else {
			$('#' + e.target.id + "-icon").attr('class', 'bi bi-arrow-down-short');
		}
	})

</script>

</html>