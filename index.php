<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- CSS linkovi -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<?php
include "database.php";
$mTdb = new Database("movietrak");

?>


<body>
    <!-- navbar -->
    <div class="navbar-fixed">
        <nav class="grey darken-4">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo light-green-text accent-3 right">MovieTRAK</a>
                    <a href="#" data-target="mobile-nav" class="sidenav-trigger">
                        <i class="material-icons">menu</i>
                    </a>
                    <ul class="left hide-on-med-and-down">
                        <li><a class="waves-effect waves-light btn modal-trigger" href="#modal-film">Unos filma</a></li>
                        <li><a class="waves-effect waves-light btn modal-trigger" href="#modal-ocena">Unos ocene</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <ul id="mobile-nav" class="sidenav grey darken-4">
        <li><a class="waves-effect waves-light modal-trigger light-green-text accent-4" href="#modal-film">Unos filma</a></li>
        <li><a class="waves-effect waves-light modal-trigger light-green-text accent-4" href="#modal-ocena">Unos ocene</a></li>
    </ul>

    <!-- modal za unos filma -->
    <div id="modal-film" class="modal">
        <div class="modal-content grey darken-4">
            <form action="" method="POST">
                <div id="dodaj-film" class="col s12">

                    <!-- sadrzaj forme za unos filma  -->
                    <div class="container" id="unos-filma">
                        <div class="row">
                            <div class="input-field col s10 m12 offset-s1">
                                <!--  naziv filma -->
                                <i class="material-icons prefix movie-icon white-text">movie</i>
                                <input placeholder="Naslov filma" id="naslov-filma-unos" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s10 m6 offset-s1">
                                <!-- godina objavljivanja filma -->
                                <i class="material-icons prefix date-icon white-text">date_range</i>
                                <input placeholder="Godina" id="datum" type="text">
                            </div>
                            <div class="input-field col s10 m6 offset-s1">
                                <!-- ime rezisera  -->
                                <i class="material-icons prefix grade-icon white-text">account_box</i>
                                <input placeholder="Ime rezisera" id="reziser" type="text">
                            </div>
                        </div>

                        <!-- dugmad za slanje zahteva bazi -->
                        <div class="row">
                            <button class="btn waves-effect waves-light col m2 s2 offset-m1 tooltipped" type="submit" name="action" data-position="top" data-tooltip="POST zahtev">
                                <i class="material-icons center">add_box</i>
                            </button>
                            <div class="col s.5"></div>
                            <button class="btn waves-effect waves-light col m2 s2 tooltipped" type="submit" name="action" data-position="top" data-tooltip="GET zahtev">
                                <i class="material-icons center">autorenew</i>
                            </button>
                            <div class="col s.5"></div>
                            <button class="btn waves-effect waves-light col m2 s2 tooltipped" type="submit" name="action" data-position="top" data-tooltip="UPDATE zahtev">
                                <i class="material-icons center">edit</i>
                            </button>
                            <div class="col s.5"></div>
                            <button class="btn waves-effect waves-light col m2 s2 tooltipped" type="submit" name="action" data-position="top" data-tooltip="DELETE zahtev">
                                <i class="material-icons center">delete</i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- modal za unos ocene -->
    <div id="modal-ocena" class="modal">
        <div class="modal-content grey darken-4">
            <form action="" method="POST">
                <div id="oceni-film" class="col s12">
                    <!-- OCENA FILMA -->
                    <div class="container" id="ocena-filma">
                        <div class="row">
                            <div class="input-field col s10 m7 offset-s1 offset-m1">
                                <i class="material-icons prefix movie-icon white-text">movie</i>
                                <!-- IZBOR FILMA KOJI SE OCENJUJE -->
                                <select>
                                    <option value="" disabled selected>Naziv filma</option>
                                    <?php
                                    $mTdb->select("filmovi", "*", null, null, null);
                                    while ($red = $mTdb->getResult()->fetch_object()) :
                                    ?>
                                        <option value="<?php echo $red->id; ?>"><?php echo $red->naslov; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="input-field col s10 m3 offset-s1">
                                <!-- OCENA FILMA -->
                                <i class="material-icons prefix date-icon white-text">star</i>
                                <input placeholder="Ocena" id="ocena" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s10 m10 offset-s1 offset-m1">
                                <!-- OBJASNJENJE OCENE  -->
                                <i class="material-icons prefix grade-icon white-text">textsms</i>
                                <textarea class="materialize-textarea white-text" id="opis-ocene" placeholder="Opis ocene"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <button class="btn waves-effect waves-light col m2 s2 offset-m1 tooltipped" type="submit" name="action" data-position="top" data-tooltip="POST zahtev">
                                <i class="material-icons center">add_box</i>
                            </button>
                            <div class="col s.5"></div>
                            <button class="btn waves-effect waves-light col m2 s2 tooltipped" type="submit" name="action" data-position="top" data-tooltip="GET zahtev">
                                <i class="material-icons center">autorenew</i>
                            </button>
                            <div class="col s.5"></div>
                            <button class="btn waves-effect waves-light col m2 s2 tooltipped" type="submit" name="action" data-position="top" data-tooltip="UPDATE zahtev">
                                <i class="material-icons center">edit</i>
                            </button>
                            <div class="col s.5"></div>
                            <button class="btn waves-effect waves-light col m2 s2 tooltipped" type="submit" name="action" data-position="top" data-tooltip="DELETE zahtev">
                                <i class="material-icons center">delete</i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- tabela -->
    <div class="container">
        <h3 class="center white-text">Tvoj video dnevnik</h3>

        <table class="highlight responsive-table white-text">
            <thead>
                <tr>
                    <th>Naziv filma</th>
                    <th>Ocena</th>
                    <th>Opis</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>
    </div>





    <!-- javaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script> -->
    <script src="js/main.js"></script>
</body>

<!-- dodatni css neophodan za overridovanje odredjenih materialize komponenti -->
<style>
    .dropdown-content.select-dropdown li span {
        background-color: #272727;
        color: white;
    }

    .dropdown-content.select-dropdown li span:hover {
        background-color: #212121;
        color: #8BC34A;
    }

    .dropdown-content {
        max-height: 400px;
        overflow-y: auto;
    }
</style>

</html>