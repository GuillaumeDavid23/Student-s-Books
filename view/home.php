
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
    <link rel="stylesheet" href="/public/css/bootstrap/bootstrap.css">
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/8fbc0d958d.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    
    <link rel="stylesheet" href="/public/css/dash.css">
    <!-- FavIcon -->
    <link rel="shortcut icon" href="/public/img/favicon.ico" type="image/x-icon">
    <!-- META Description -->
    <meta name="description" content="Bienvenue sur Students'Books, c'est ici que commence la révolution scolaire.
    Emploi du temps/ devoirs/ absences... retrouver toutes les information scolaire içi">
    <!-- Titre du site -->
    <title>Accueil Students'Books : Les devoirs à la maison facilement</title>
</head>

<body>

    <!-- NAV VERSION MOBILE -->
    <div class="container-fluid p-0 d-flex flex-column align-items-center d-xl-none">
        <header class="w-100 mb-5 d-flex ">
            <img src="/public/img/LOGO SOLO.png" class="ms-3 img-fluid" width="70" alt="">
            <h1 class="ms-4 align-self-center text-center">Tableau de bord</h1>
        </header>
        <div class="row justify-content-center h-100 w-100">
            <div class="col-5 navBtnMob ">
                <a href="/index.php?page=2" class="d-flex justify-content-center">
                    <img src="/public/img/devoirs.webp" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <div class="col-5 offset-1 navBtnMob">
                <a href="/index.php?page=1" class="d-flex justify-content-center">
                    <img src="/public/img/LogoNote.webp" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <div class="col-5 mt-5 navBtnMob">
                <a href="/index.php?page=3" class="d-flex justify-content-center">
                    <img src="/public/img/Edt.webp" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <div class="col-5 mt-5  offset-1 navBtnMob">
                <a href="/index.php?page=4" class="d-flex justify-content-center">
                    <img src="/public/img/absences.webp" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <div class="col-5 mt-5 navBtnMob ">
                <a href="/index.php?page=5" class="d-flex justify-content-center">
                    <img src="/public/img/agenda.png" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <div class="col-5 mt-5 offset-1 navBtnMob">
                <a href="/index.php?page=8" class="d-flex justify-content-center">
                    <img src="/public/img/message.png" class="img-fluid w-75"  alt="">
                </a>
            </div>
        </div>
    </div>

    <!-- VERSION DESKTOP -->
    <div class="container-fluid d-none d-lg-none d-xl-block h-100 p-0 align-items-center">
        <header class="mb-5 d-flex w-100 align-items-center">
            <div class="logoBloc ms-1">
                <img src="/public/img/LOGO SOLO.png" width="70" alt="">
            </div>
            <div class="w-100 d-flex align-items-center justify-content-center">
                <h1 class="m-0">Tableau de bord</h1>
            </div>
            <div class="align-self-center">
                <a href="/index.php?page=7" class="btn btn-outline-dark fw-bold me-3"><i class="fas fa-user-alt"></i></a> 
            </div>
            <div class="align-self-center me-2">
                <a href="/index.php?page=12" class="btn btn-outline-danger fw-bold"><i class="fas fa-sign-out-alt"></i></a> 
            </div>
        </header>
        <div class="h-75 w-100 d-flex ps-5 pe-5">
            <div class="row h-100 w-75 ">
                <div class="row w-100 h-50">
                    <div class="offset-1 col-3 h-100 resumeBloc">
                        <a href="/index.php?page=1" class="text-decoration-none">
                            <h2>Notes</h2>
                        </a>
                        
                        <?php 
                            foreach ($dataArrayNote as $key => $currentArray) {
                                if($currentArray['id_users'] == $_SESSION['user']->id){
                                    $teacher = User::SelectOne($currentArray['id_users_teacher_marks']);
                                    $matter = Matter::SelectOne($teacher->id_matters);
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['note']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $matter->matter.' - '.$currentArray['notation'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$teacher->lastname?></div>
                                    </div>
                                </div>
                        <?php 
                            }}
                            if($_SESSION['user']->id_ranks == 3 || $_SESSION['user']->id_ranks == 4){
                                echo "<p class='text-center text-white text-decoration-underline fw-bold'>Vous êtes professeur ou administrateur, la prévisualition des notes n'est donc pas possible.</p>";
                            }
                        ?>
                    </div>
                    <div class="offset-1 col-5 h-100 resumeBloc">
                        <a href="/index.php?page=2" class="text-decoration-none">
                            <h2>Devoirs</h2>
                        </a>
                        
                        <div id="homeworkBloc">
                            <?php 
                            $dataArrayHw = Assign::SelectAll();
                            foreach ($dataArrayHw as $data){ 
                                $save = explode("-", $data['end_date']);
                                $year = $save[0];
                                $month = $save[1];
                                $day = $save[2];
                                $month = strftime('%h', strtotime("$day-$month-$year"));
                                $teacher = User::SelectOne($data['id_users']);
                                $matters = Matter::SelectOne($teacher->id_matters);
                            ?>
                            <div class="hwEl d-flex w-100 mb-2">
                                <div class="hwDateBloc h-100">
                                    <div id="hwDate" class="text-center fw-bold text-white subInfo"><?= $day ?> <br> <?= $month ?></div>
                                </div>
                                <div class="ps-1 w-100 bg-egg">
                                    <div id="hwMatter" class="fw-bold"><?= $matters->matter ?> - <?= $data['assignement'] ?></div>
                                    <div id="hwProf" class="prof">Mme/Mr <?= $teacher->lastname?></div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row w-100 h-50 mt-4">
                    <div class="col-5 h-100 resumeBloc">
                        <a href="/index.php?page=3" class="text-decoration-none">
                            <h2>Emploi du temps</h2>
                        </a>
                        
                        <div id="edtBloc" class="text-center text-white">
                            <?php foreach ($dataArrayEdt as $key => $currentArray) {
                                if($currentArray['day'] == $currentDay ){ ?>
                                    <div class="edtEl d-flex w-100 mb-2">
                                        <div class="edtDateBloc h-100">
                                            <div id="edtLocal" class="text-center fw-bold text-white subInfo">Salle <?=' '.$currentArray['room']?></div>
                                        </div>
                                        <div class="ps-1 w-100 bg-egg d-flex align-items-center">
                                            <div id="infoBloc" class="fw-bold text-dark">
                                                <span id="hours"><?=$currentArray['hour']?>h</span>
                                                <span id="edtMatter"><?=$currentArray['matter']?> - </span>
                                                <span id="edtProf" class="prof">Mme Lafoins</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="offset-1 col-3 h-100 resumeBloc">
                        <a href="/index.php?page=4" class="text-decoration-none">
                            <h2>Absences</h2>
                        </a>
                        
                        <?php foreach ($absencesArray as $absencesObj) { 
                            $timestamp_start = strtotime($absencesObj->start_date.' '.$absencesObj->start_hour);
                            $timestamp_end = strtotime($absencesObj->end_date.' '.$absencesObj->end_hour);

                            $day_start = strftime('%d', $timestamp_start);
                            $month_start = strftime('%B', $timestamp_start);

                            $day_end = strftime('%d', $timestamp_end);
                            $month_end = strftime('%B', $timestamp_end);

                            if($_SESSION['user']->id == $absencesObj->id_users ){?>
                                <div class="absentEl d-flex w-100 mb-2">
                                    <div class="absentDateBloc ">
                                        <div id="absentBloc" class="text-center fw-bold text-white subInfo ps-2 pe-2"><?= $day_start.' au '.$day_end.'<br>'.$month_start ?></div>
                                    </div>
                                    <div class="ps-1 w-100 bg-egg d-flex align-items-center">
                                        <div id="reasonBloc" class="fw-bold">
                                            <span id="reason"><?= $absencesObj->justification ?> - de <?= date('H:i', $timestamp_start) ?> à <?= date('H:i', $timestamp_end) ?> </span>
                                        </div>
                                    </div>
                                </div>
                        <?php }} ?>
                    </div>
                </div>

            </div>
            <div class="row h-100">
                <div class="col-12 h-100 p-0 resumeBloc" id="chatBloc">
                    <div id="topChat" class="d-flex">
                        <div id="chatContact" class="d-flex flex-column align-items-center pt-1 p-2">
                            <strong class="text-center">En ligne :</strong> 
                            <div id="connected" class="rounded-circle bg-light text-success mt-2 d-flex justify-content-center align-items-center"
                                style="width: 50px; height: 50px;">
                                <!-- Code js ICI -->
                            </div>
                        </div>
                        <div id="chatMessage" class="text-white overflow-scroll d-flex flex-column w-100" data-id="<?= $_SESSION['user']->id ?>">

                        </div>
                    </div>
                    <div id="chatBar" class="d-flex">
                        <div id="chatBtnBloc">
                            <button id="chatBtnSend">
                                <img src="/public/img/envoie.png" alt="Bouton enoyer un message dans le tchat"
                                    class="img-fluid w-75">
                            </button>
                        </div>
                        <textarea type="text" name="" id="chatInput"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- FOOTER -->
    <footer class="d-flex flex-column justify-content-center align-items-center w-100">
        <a href="#" class="text-white " data-bs-toggle="modal" data-bs-target="#exampleModal">
            Un problème ?
        </a>
        <a href="/index.php?page=13" class="text-white">Mentions légales</a>
    </footer>

    <!-- Modal de contact -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Un problème ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body d-flex flex-column">
                        <label for="object" class="mb-2">Titre de votre demande</label>
                        <input type="text" name="object" id="object" class="mb-3">
                        <label for="prob">Décrivez votre problème</label>
                        <textarea name="prob" id="prob" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-info text-white">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Script -->
    <script src="../public/js/chat.js"></script>
    <script src="/public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap/bootstrap.js"></script>
</body>

</html>