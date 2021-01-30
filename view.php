<?php
include "database.php";

// upiti
$filmovi_sql = "SELECT * FROM filmovi";
$ocene_sql = "SELECT * FROM ocene";

$filmovi_result = $conn->query($filmovi_sql);
$ocene_result = $conn->query($ocene_sql);


?>

<!DOCTYPE html>
<html>

<head>
	<title>MovieTRAK</title>

	<!-- bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
					<input class="form-control me-2" type="search" placeholder="Pretraga" aria-label="Pretraga">
					<button class="btn btn-outline-success" type="submit">Pretraži</button>
				</form>
			</div>
		</div>
	</nav>

	<div class="container">
		<h2>Filmovi</h2>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Naslov</th>
					<th>Godina</th>
					<th>Reziser</th>
					<th>Opcije</th>
				</tr>
			</thead>
			<tbody>
				<?php
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
			<tbody>
				<?php
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

</html>