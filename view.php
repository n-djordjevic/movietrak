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
	<title>View Page</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
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
							<td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;<a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
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
							<td><a class="btn btn-info" href="update.php?id_ocene=<?php echo $row['id']; ?>">Edit</a>&nbsp;<a class="btn btn-danger" href="delete.php?id_ocene=<?php echo $row['id']; ?>">Delete</a></td>
						</tr>

				<?php		}
				}
				?>

			</tbody>
		</table>
	</div>

</body>

</html>