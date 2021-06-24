<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/dash.css">
    <!-- FavIcon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <!-- META Description -->
    <meta name="description" content="Bienvenue sur Students'Books, c'est ici que commence la révolution scolaire.
     Emploi du temps/ devoirs/ absences... retrouver toutes les information scolaire içi">
    <!-- Titre du site -->
    <title>Accueil Students'Books : Les devoirs à la maison facilement</title>
</head>

<body>
    <!-- VERSION MOBILE -->
    <div class="container-fluid h-100 p-0 d-flex flex-column align-items-center d-xl-none">
        <header class="w-100 mb-5 d-flex ">
            <img src="assets/img/LOGO SOLO.png" class="ms-3 h-100" alt="">
            <h1 class="ms-4 align-self-center text-center">Tableau de bord</h1>
        </header>
        <div class="row justify-content-center w-100">
            <div class="col-4 navBtnMob ">
                <a href="views/devoirs.php" class="d-flex justify-content-center">
                    <img src="assets/img/devoirs.webp" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <div class="col-4 offset-1 navBtnMob">
                <a href="views/note.php" class="d-flex justify-content-center">
                    <img src="assets/img/LogoNote.webp" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <div class="col-4 mt-5 navBtnMob">
                <a href="views/edt.php" class="d-flex justify-content-center">
                    <img src="assets/img/Edt.webp" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <div class="col-4 mt-5  offset-1 navBtnMob">
                <a href="views/absences.php" class="d-flex justify-content-center">
                    <img src="assets/img/absences.webp" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <!-- <div class="col-4 mt-5 navBtnMob ">
                <a href="views/agenda.php" class="d-flex justify-content-center">
                    <img src="assets/img/agenda.png" class="img-fluid w-75"  alt="">
                </a>
            </div> -->
            <div class="col-4 mt-5 offset-1 navBtnMob">
                <a href="views/tchat.php" class="d-flex justify-content-center">
                    <img src="assets/img/message.png" class="img-fluid w-75"  alt="">
                </a>
            </div>
        </div>
        <footer class="d-flex flex-column justify-content-center align-items-center position-fixed bottom-0">
            <a href="views/mention.php" class="text-white " data-bs-toggle="modal" data-bs-target="#exampleModal">Un
                problème ?</a>
            <a href="views/mention.php" class="text-white">Mentions légales</a>
        </footer>

    </div>
    <!-- VERSION DESKTOP -->
    <div class="container-fluid d-none d-lg-none d-xl-block h-100 p-0 align-items-center">
        <header class="mb-5 d-flex w-100">
            <div class="logoBloc">
                <img src="assets/img/LOGO SOLO.png" class="ms-3 h-100" alt="">
            </div>
            <div class="ms-4 w-100 d-flex align-items-center justify-content-center">
                <h1>Tableau de bord</h1>
            </div>

            <div class="logoBloc">
                <img src="assets/img/LOGO SOLO.png" class="ms-3 h-100" alt="">
            </div>
        </header>
        <div class="h-75 w-100 d-flex ps-5 pe-5">
            <div class="row h-100 w-75 ">
                <div class="row w-100 h-50">
                    <div class="offset-1 col-3 h-100 resumeBloc">
                        <a href="views/note.php" class="text-decoration-none">
                            <h2>Notes</h2>
                        </a>
                        
                        <div id="noteBloc">
                            <div class="noteEl d-flex w-100 mb-2">
                                <div class="notationBloc">
                                    <div id="notation" class="d-flex justify-content-center align-items-center">14</div>
                                    <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                </div>
                                <div class="ps-1 bg-egg" id="infoNote">
                                    <div id="noteMatter" class="fw-bold">EPS - Course d'orientation</div>
                                    <div id="noteProf" class="prof">Mr Delaporte</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offset-1 col-5 h-100 resumeBloc">
                        <a href="views/devoirs.php" class="text-decoration-none">
                            <h2>Devoirs</h2>
                        </a>
                        
                        <div id="homeworkBloc">
                            <div class="hwEl d-flex w-100 mb-2">
                                <div class="hwDateBloc h-100">
                                    <div id="hwDate" class="text-center fw-bold text-white subInfo">27 <br> février</div>
                                </div>
                                <div class="ps-1 w-100 bg-egg">
                                    <div id="hwMatter" class="fw-bold">Français - Expression écrite sur voltaire</div>
                                    <div id="hwProf" class="prof">Mme Lafoins</div>
                                </div>
                            </div>
                            <div class="hwEl d-flex w-100 mb-2">
                                <div class="hwDateBloc h-100">
                                    <div id="hwDate" class="text-center fw-bold text-white subInfo">29 <br> mai</div>
                                </div>
                                <div class="ps-1 w-100 bg-egg">
                                    <div id="hwMatter" class="fw-bold">Anglais LV1  - Oral verbes irréguliers</div>
                                    <div id="hwProf" class="prof">Mme Thomas</div>
                                </div>
                            </div>
                            <div class="hwEl d-flex w-100 mb-2">
                                <div class="hwDateBloc h-100">
                                    <div id="hwDate" class="text-center fw-bold text-white subInfo">27 <br> juin</div>
                                </div>
                                <div class="ps-1 w-100 bg-egg">
                                    <div id="hwMatter" class="fw-bold">Espagnol LV2 - Contrôle de séquence</div>
                                    <div id="hwProf" class="prof">Mme Espegoles</div>
                                </div>
                            </div>
                            <div class="hwEl d-flex w-100 mb-2">
                                <div class="hwDateBloc h-100">
                                    <div id="hwDate" class="text-center fw-bold text-white subInfo">17 <br> juillet</div>
                                </div>
                                <div class="ps-1 w-100 bg-egg">
                                    <div id="hwMatter" class="fw-bold">Français - BAC oral</div>
                                    <div id="hwProf" class="prof">Mme Lafoins</div>
                                </div>
                            </div>
                            <div class="hwEl d-flex w-100 mb-2">
                                <div class="hwDateBloc h-100">
                                    <div id="hwDate" class="text-center fw-bold text-white subInfo">27 <br> Juillet</div>
                                </div>
                                <div class="ps-1 w-100 bg-egg">
                                    <div id="hwMatter" class="fw-bold">Math  - Table de multiplication</div>
                                    <div id="hwProf" class="prof">Mr Dieu</div>
                                </div>
                            </div>
                            <div class="hwEl d-flex w-100 mb-2">
                                <div class="hwDateBloc h-100">
                                    <div id="hwDate" class="text-center fw-bold text-white subInfo">21 <br> Août</div>
                                </div>
                                <div class="ps-1 w-100 bg-egg">
                                    <div id="hwMatter" class="fw-bold">Latin - DS sur la partie 2</div>
                                    <div id="hwProf" class="prof">Mr Stuff</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row w-100 h-50 mt-4">
                    <div class="col-5 h-100 resumeBloc">
                        <a href="views/edt.php" class="text-decoration-none">
                            <h2>Emploi du temps</h2>
                        </a>
                        
                        <div id="edtBloc">
                            <div class="edtEl d-flex w-100 mb-2">
                                <div class="edtDateBloc h-100">
                                    <div id="edtLocal" class="text-center fw-bold text-white subInfo">Salle 23</div>
                                </div>
                                <div class="ps-1 w-100 bg-egg d-flex align-items-center">
                                    <div id="infoBloc" class="fw-bold">
                                        <span id="hours">8h :</span>
                                        <span id="edtMatter">Français - </span>
                                        <span id="edtProf" class="prof">Mme Lafoins</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offset-1 col-3 h-100 resumeBloc">
                        <a href="views/absences.php" class="text-decoration-none">
                            <h2>Absences</h2>
                        </a>
                        
                        <div id="absentBloc">
                            <div class="absentEl d-flex w-100 mb-2">
                                <div class="absentDateBloc">
                                    <div id="absentBloc" class="text-center fw-bold text-white subInfo">27 février</div>
                                </div>
                                <div class="ps-1 w-100 bg-egg d-flex align-items-center">
                                    <div id="reasonBloc" class="fw-bold">
                                        <span id="reason">Retard - 8h à 8h30</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row h-100 w-25">
                <div class="col-12 h-100 p-0" id="chatBloc">
                    <div id="topChat" class="d-flex">
                        <div id="chatContact" class="d-flex flex-column align-items-center pt-1">
                            <img src="assets/img/avatar.jpg" class="img-fluid rounded-circle" width="50" alt="Avatar">
                            <div class="rounded-circle bg-light mt-2 d-flex justify-content-md-center align-items-center"
                                style="width: 50px; height: 50px;">PROF</div>
                            <div class="rounded-circle bg-light mt-2 d-flex justify-content-md-center align-items-center"
                                style="width: 50px; height: 50px;">Thom..</div>
                            <div class="rounded-circle bg-light mt-2 d-flex justify-content-md-center align-items-center"
                                style="width: 50px; height: 50px;">Classe</div>
                            <div class="rounded-circle bg-light mt-2 d-flex justify-content-md-center align-items-center"
                                style="width: 50px; height: 50px;">Autres</div>
                        </div>
                        <div id="chatMessage">

                        </div>
                    </div>
                    <div id="chatBar" class="d-flex">
                        <div id="chatBtnBloc">
                            <button id="chatBtnSend">
                                <img src="assets/img/envoie.png" alt="Bouton enoyer un message dans le tchat"
                                    class="img-fluid w-75">
                            </button>
                        </div>
                        <textarea type="text" name="" id="chatInput"></textarea>
                    </div>
                </div>
            </div>
        </div>


        <footer class="d-flex flex-column justify-content-center align-items-center">

            <a href="views/mention.php" class="text-white " data-bs-toggle="modal" data-bs-target="#exampleModal">
                Un problème ?
            </a>
            <a href="views/mention.php" class="text-white">Mentions légales</a>
        </footer>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Un problème ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column">
                    <label for="object" class="mb-2">Titre de votre demande</label>
                    <input type="text" name="object" id="" class="mb-3">
                    <label for="prob">Décrivez votre problème</label>
                    <textarea name="prob" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-info text-white">Envoyer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="assets/js/bootstrap/bootstrap.js"></script>
</body>

</html>