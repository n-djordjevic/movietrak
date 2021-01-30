<?php

include "database.php";

function alert($message)
{
    echo "<script>alert('$message');</script>";
}

// unos filma klikom na dugme 'Potvrdi'
if (isset($_POST['submit_film'])) {
    $naslov_filma = $_POST['naslov'];
    $godina = $_POST['godina'];
    $reziser = $_POST['reziser'];


    if ($godina > date("Y") || $godina < 1888) {
        alert("Greska prilikom unosa godine");
    } else {

        $film_sql = "INSERT INTO `filmovi`(`naslov`, `godina`, `reziser`) VALUES ('$naslov_filma', '$godina', '$reziser')";
        $film_result = $conn->query($film_sql);

        if ($film_result == TRUE) {
            alert("Uspešno ste uneli novi film u bazu.");
            header('Location: view.php');
        } else {
            alert("Error:" . $film_sql . "<br>" . $conn->error);
        }
    }
    $conn->close();
}


// unos ocene klikom na dugme 'Potvrdi'
if (isset($_POST['submit_ocena'])) {
    $id_filma = $_POST['naslov'];
    $ocena = $_POST['ocena'];
    $opis = $_POST['opis'];

    $film_id_postoji = "SELECT `id_filma` FROM ocene WHERE `id_filma`='$id_filma'";
    $fip_result = $conn->query($film_id_postoji);

    if ($fip_result->num_rows > 0) {
        alert("Ocena za ovaj film vec postoji!");

    } elseif ($ocena > 5 || $ocena < 1) {
        alert("Greska prilikom unosa godine");
    } else {

        $ocena_sql = "INSERT INTO `ocene`(`id_filma`, `ocena`, `opis`) VALUES ('$id_filma', '$ocena', '$opis')";
        $ocena_result = $conn->query($ocena_sql);

        if ($ocena_result == TRUE) {
            alert("Uspešno ste uneli novu ocenu u bazu.");
            header('Location: view.php');
        } else {
            alert("Error:" . $film_sql . "<br>" . $conn->error);
        }
    }
}

// odredjujemo koju formu je potrebno prikazati
if (isset($_GET['unos'])) {
    $unos = $_GET['unos'];
    if ($unos == 0) {

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
            <div class="container" style="margin-top: 50px;">
                <div class="row">
                    <h2>Forma za unos novog filma</h2>
                </div>
                <div class="col-6 row">
                    <form action="" method="POST">
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
                        <br><br>
                        <input type="submit" name="submit_film" value="Potvrdi" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </body>

        </html>

    <?php
    } elseif ($unos == 1) {
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
            <div class="container" style="margin-top: 50px;">
                <div class="row">
                    <h2>Forma za unos nove ocene</h2>
                </div>
                <div class="col-6 row">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="naslov">Naslov filma</label>
                            <!-- <input type="text" class="form-control" name="naslov" placeholder="Unesite naslov filma"> -->
                            <select class="form-select" name="naslov" id="">
                                <?php
                                $sql = "SELECT * FROM `filmovi`";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {

                                    while ($row = $result->fetch_assoc()) {
                                        $id_filma = $row['id'];
                                        $naslov_filma = $row['naslov'];
                                ?>
                                        <option value="<?php echo $id_filma; ?>"><?php echo $naslov_filma; ?></option>
                                <?php  }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="godina">Ocena</label>
                            <input type="text" class="form-control" name="ocena" placeholder="Unesite ocenu (od 1 do 5)">
                        </div>
                        <div class="form-group">
                            <label for="reziser">Opis ocene</label>
                            <!-- <input type="text" class="form-control" name="opis" placeholder="Unesite opis ocene"> -->
                            <textarea class="form-control" name="opis" id="opis" placeholder="Unesite opis ocene" style="height: 100px"></textarea>
                        </div>
                        <br><br>
                        <input type="submit" name="submit_ocena" value="Potvrdi" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </body>

        </html>

<?php
    }
}
?>