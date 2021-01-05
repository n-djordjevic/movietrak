<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <!-- navbar -->
    <div class="navbar-fixed">
        <nav class="grey darken-4">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo light-green-text accent-3 center">MovieTRAK</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- tabovi -->
    <div class="row">
        <div class="col s10 m8 offset-s1 offset-m2">
            <ul class="tabs">
                <li class="tab col s5 m4 offset-m2"><a class="active" href="#dodaj-film">Dodaj film</a></li>
                <li class="tab col s5 m4"><a href="#oceni-film">Oceni film</a></li>
            </ul>
        </div>
    </div>

    <!-- forme za svaki tab -->
    <form action="" method="POST">
        <div id="dodaj-film" class="col s12">

            <!-- UNOS FILMA  -->
            <div class="container" id="unos-filma">
                <div class="row">
                    <div class="input-field col s10 m8 offset-s1 offset-m2">
                        <!--  NASLOV FILMA -->
                        <i class="material-icons prefix movie-icon white-text">movie</i>
                        <input placeholder="Naslov filma" id="naslov-filma-unos" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s10 m4 offset-s1 offset-m2">
                        <!-- DATUM OBJAVLJIVANJA FILMA -->
                        <i class="material-icons prefix date-icon white-text">date_range</i>
                        <input placeholder="Godina objavljivanja" id="datum" type="text">
                    </div>
                    <div class="input-field col s10 m4 offset-s1">
                        <!-- IME REZISERA  -->
                        <i class="material-icons prefix grade-icon white-text">account_box</i>
                        <input placeholder="Ime rezisera" id="reziser" type="text">
                    </div>
                </div>

                <!-- zahtevi -->
                <div class="row">
                    <button class="btn waves-effect waves-light col m1 s2 offset-m5 offset-s1" type="submit" name="action">
                        <i class="material-icons center">add_box</i>
                    </button>
                    <div class="col s.5"></div>
                    <button class="btn waves-effect waves-light col m1 s2" type="submit" name="action">
                        <i class="material-icons center">autorenew</i>
                    </button>
                    <div class="col s.5"></div>
                    <button class="btn waves-effect waves-light col m1 s2" type="submit" name="action">
                        <i class="material-icons center">edit</i>
                    </button>
                    <div class="col s.5"></div>
                    <button class="btn waves-effect waves-light col m1 s2" type="submit" name="action">
                        <i class="material-icons center">delete</i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div id="oceni-film" class="col s12">
        <!-- OCENA FILMA -->
        <div class="container" id="ocena-filma">
            <div class="row">
                <div class="input-field col s10 m6 offset-s1 offset-m2">
                    <!-- IZBOR FILMA KOJI SE OCENJUJE -->
                    <i class="material-icons prefix movie-icon white-text">movie</i>
                    <input placeholder="Naslov filma" id="naslov-filma-ocena" type="text">
                </div>
                <div class="input-field col s10 m2 offset-s1">
                    <!-- OCENA FILMA -->
                    <i class="material-icons prefix date-icon white-text">star</i>
                    <input placeholder="Ocena" id="ocena" type="text">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s10 m8 offset-s1 offset-m2">
                    <!-- OBJASNJENJE OCENE  -->
                    <i class="material-icons prefix grade-icon white-text">textsms</i>
                    <input placeholder="Opis ocene" id="opis-ocene" type="text">
                </div>
            </div>
            <div class="row">
                <button class="btn waves-effect waves-light col m1 s2 offset-m5 offset-s1" type="submit" name="action">
                    <i class="material-icons center">add_box</i>
                </button>
                <div class="col s.5"></div>
                <button class="btn waves-effect waves-light col m1 s2" type="submit" name="action">
                    <i class="material-icons center">autorenew</i>
                </button>
                <div class="col s.5"></div>
                <button class="btn waves-effect waves-light col m1 s2" type="submit" name="action">
                    <i class="material-icons center">edit</i>
                </button>
                <div class="col s.5"></div>
                <button class="btn waves-effect waves-light col m1 s2" type="submit" name="action">
                    <i class="material-icons center">delete</i>
                </button>
            </div>
        </div>
    </div>

    <!-- tabela -->
    <div class="container">
        <div class="divider col s10"></div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>