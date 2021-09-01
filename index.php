<?php
    session_start();
    if(empty($_SESSION['rank'])){
        header('Location: controller/connectCtrl.php');
    }
    setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
    //Connexion BDD
    require_once(dirname(__FILE__).'/model/model.php');
    require_once(dirname(__FILE__).'/model/bdd.php');
    require_once(dirname(__FILE__).'/model/user.php');
    require_once(dirname(__FILE__).'/model/marks.php');
    require_once(dirname(__FILE__).'/model/matters.php');
    require_once(dirname(__FILE__).'/public/config/config.php');
    $users = new User();
    $dataArrayNote = [];
    $dataArrayEdt = [];
    
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $object = $_POST['object'];
        $prob = $_POST['prob'];
        mail('guillaume.david744@orange.fr', "$object", "$prob");
    }
    $marks = new Mark();
    $noteArray = $marks->SelectAll('marks');


    foreach ($noteArray as $note){
        
        if($_SESSION['rank'] == "1"){
            if($note['id_users'] == $_SESSION['id']){
                array_push($dataArrayNote, $note);
            }
        }
        elseif($_SESSION['rank'] == "3"){
            if($note['id_users_teacher_marks'] == $_SESSION['id']){
                array_push($dataArrayNote, $note);
            }
        }
    }

    $time = time();
    $currentDay = ucfirst(strftime('%A', $time));
?>
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
    <link rel="stylesheet" href="public/css/bootstrap/bootstrap.css">
    <!-- CSS -->
    <link rel="stylesheet" href="public/css/dash.css">
    <!-- FavIcon -->
    <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
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
            <img src="public/img/LOGO SOLO.png" class="ms-3 h-100" alt="">
            <h1 class="ms-4 align-self-center text-center">Tableau de bord</h1>
        </header>
        <div class="row justify-content-center w-100">
            <div class="col-4 navBtnMob ">
                <a href="../controller/assignmentCtrl.php" class="d-flex justify-content-center">
                    <img src="public/img/devoirs.webp" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <div class="col-4 offset-1 navBtnMob">
                <a href="../controller/noteCtrl.php" class="d-flex justify-content-center">
                    <img src="public/img/LogoNote.webp" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <div class="col-4 mt-5 navBtnMob">
                <a href="../controller/edtCtrl.php" class="d-flex justify-content-center">
                    <img src="public/img/Edt.webp" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <div class="col-4 mt-5  offset-1 navBtnMob">
                <a href="../controller/absencesCtrl.php" class="d-flex justify-content-center">
                    <img src="public/img/absences.webp" class="img-fluid w-75"  alt="">
                </a>
            </div>
            <!-- <div class="col-4 mt-5 navBtnMob ">
                <a href="../view/agenda.php" class="d-flex justify-content-center">
                    <img src="public/img/agenda.png" class="img-fluid w-75"  alt="">
                </a>
            </div> -->
            <div class="col-4 mt-5 offset-1 navBtnMob">
                <a href="../view/tchat.php" class="d-flex justify-content-center">
                    <img src="public/img/message.png" class="img-fluid w-75"  alt="">
                </a>
            </div>
        </div>
        <footer class="d-flex flex-column justify-content-center align-items-center position-fixed bottom-0">
            <a href="../view/mention.php" class="text-white " data-bs-toggle="modal" data-bs-target="#exampleModal">Un
                problème ?</a>
            <a href="../view/mention.php" class="text-white">Mentions légales</a>
        </footer>

    </div>
    <!-- VERSION DESKTOP -->
    <div class="container-fluid d-none d-lg-none d-xl-block h-100 p-0 align-items-center">
        <header class="mb-5 d-flex w-100">
            <div class="logoBloc">
                <img src="public/img/LOGO SOLO.png" class="ms-3 h-100" alt="">
            </div>
            <div class="ms-4 w-100 d-flex align-items-center justify-content-center">
                <h1>Tableau de bord</h1>
            </div>
            <div class="align-self-end">
                <a href="controller/profilCtrl.php" class="link-warning fw-bold">Bonjour <?= $_SESSION['lastname'] ?></a> 
            </div>
            <div class="logoBloc">
                <img src="public/img/LOGO SOLO.png" class="ms-3 h-100" alt="">
            </div>
        </header>
        <div class="h-75 w-100 d-flex ps-5 pe-5">
            <div class="row h-100 w-75 ">
                <div class="row w-100 h-50">
                    <div class="offset-1 col-3 h-100 resumeBloc">
                        <a href="../controller/noteCtrl.php" class="text-decoration-none">
                            <h2>Notes</h2>
                        </a>
                        
                        <?php 
                            foreach ($dataArrayNote as $key => $currentArray) {
                                if($currentArray['id_users'] == $_SESSION['id']){
                                    $teachers = new User($currentArray['id_users_teacher_marks']);
                                    $teacher = $teachers->SelectOne();
                                    $matters = new Matter($teacher->id_matters);
                                    $matter = $matters->SelectOne();
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['note']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $matter.' - '.$currentArray['notation'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$teacher?></div>
                                    </div>
                                </div>
                        <?php 
                            }}
                            if($_SESSION['rank'] == 3 || $_SESSION['rank'] == 4){
                                echo "<p class='text-center text-danger fw-bold'>Vous êtes professeur ou administrateur, la prévisualition des notes n'est donc pas possible.</p>";
                            }
                        ?>
                    </div>
                    <div class="offset-1 col-5 h-100 resumeBloc">
                        <a href="../controller/assignmentCtrl.php" class="text-decoration-none">
                            <h2>Devoirs</h2>
                        </a>
                        
                        <div id="homeworkBloc">
                            <?php 
                            $users = new User();
                            $dataArrayHw = $users->SelectAll('assignements');
                            foreach ($dataArrayHw as $data){ 
                                $save = explode("-", $data['end_date']);
                                $year = $save[0];
                                $month = $save[1];
                                $day = $save[2];
                                $month = strftime('%h', strtotime("$day-$month-$year"));
                                $users = new User($data['id_users']);
                                $teacher = $users->SelectOne();
                                $users = new User($teacher->id_matters);
                                $matters = $users->SelectOne('matters');
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
                        <a href="../controller/edtCtrl.php" class="text-decoration-none">
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
                        <a href="../controller/absencesCtrl.php" class="text-decoration-none">
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
                            <img src="public/img/avatar.jpg" class="img-fluid rounded-circle" width="50" alt="Avatar">
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
                                <img src="public/img/envoie.png" alt="Bouton enoyer un message dans le tchat"
                                    class="img-fluid w-75">
                            </button>
                        </div>
                        <textarea type="text" name="" id="chatInput"></textarea>
                    </div>
                </div>
            </div>
        </div>


        <footer class="d-flex flex-column justify-content-center align-items-center">
            <a href="#" class="text-white " data-bs-toggle="modal" data-bs-target="#exampleModal">
                Un problème ?
            </a>
            <a href="../view/mention.php" class="text-white">Mentions légales</a>
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

    <!-- Bootstrap JavaScript -->
    <script src="public/js/bootstrap/bootstrap.js"></script>
</body>

</html>