<?php
include "database.php";
// ako u url-u imamo samo id kao paremater onda se radi o azuriranju filma
if (isset($_REQUEST['s'])) {
    $search = $_REQUEST['s'];
   
    // upit za popunjavanje trenutnih vrednosti polja na formi
    $search_sql = "SELECT * FROM filmovi WHERE naslov LIKE '%" . $search . "%';";

    $search_result = $conn->query($search_sql) or die($conn->error);

    if ($search_result->num_rows > 0) {
        while ($row = $search_result->fetch_assoc()) {
            $id = $row['id'];
            $naslov = $row['naslov'];
            $godina = $row['godina'];
            $reziser = $row['reziser'];
            echo "<tr>";
            echo "<td>".$id."</td>";
            echo "<td>".$naslov."</td>";
            echo "<td>".$godina."</td>";
            echo "<td>".$reziser."</td>";
            echo "<td><a class=\"btn btn-info\" href=\"update.php?id_filma=".$id."\">Ažuriraj</a>&nbsp;<a class=\"btn btn-danger\" href=\"delete.php?id=".$id."\">Obriši</a></td>";
            echo "</tr>";
        }
    }
}
?>