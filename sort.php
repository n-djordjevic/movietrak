<?php
include "database.php";

$columnName = $_POST['columnName'];
$sort = $_POST['sort'];

$sort_sql = "SELECT * FROM filmovi ORDER BY ".$columnName." ".$sort." ";
$sort_result = $conn->query($sort_sql);

$html = '<tbody>';
while($row = $sort_result->fetch_assoc()){
  $id = $row['id'];
  $naslov = $row['naslov'];
  $godina = $row['godina'];
  $reziser = $row['reziser'];

  $html .= "<tr>
    <td>".$id."</td>
    <td>".$naslov."</td>
    <td>".$godina."</td>
    <td>".$reziser."</td>
    <td><a class=\"btn btn-info\" href=\"update.php?id_filma=".$id."\">Ažuriraj</a>&nbsp;<a class=\"btn btn-danger\" href=\"delete.php?id=".$id."\">Obriši</a></td>
  </tr>";
}
$html.="</tbody>";

echo $html;
