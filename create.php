<?php

include "database.php";

if (isset($_POST['submit_film'])) {
    $naslov_filma = $_POST['naslov'];
    $godina = $_POST['godina'];
    $reziser = $_POST['reziser'];


    $film_sql = "INSERT INTO `filmovi`(`naslov`, `godina`, `reziser`) VALUES (`$naslov_filma`, `$godina`, `$reziser`)";
    $film_result = $conn->query($film_sql);
    
    if ($film_result == TRUE) {
        echo "Uspešno ste uneli novi film u bazu.";
    } else {
        echo "Error:". $film_sql ."<br>". $conn->error;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>

    <h2>Forma za unos novog filma</h2>
    <form>
        <div class="form-group">
            <label for="naslov">Naslov filma</label>
            <input type="text" class="form-control" name="naslov" placeholder="Unesite naslov filma">
        </div>
        <div class="form-group">
            <label for="godina">Godina</label>
            <input type="text" class="form-control" name="godina" placeholder="Unesite godinu">
        </div>
        <div class="form-group">
            <label for="reziser">Reziser/i</label>
            <input type="text" class="form-control" name="reziser" placeholder="Unesite ime/na rezera">
        </div>
        <button type="submit" name="submit_film" value="submit_film" class="btn btn-primary">Potvrdi</button>
    </form>

</body>

</html>