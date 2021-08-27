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
    <link rel="stylesheet" href="../public/css/bootstrap/bootstrap.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../public/css/dash.css">
    <!-- FavIcon -->
    <link rel="shortcut icon" href="/public/img/favicon.ico" type="image/x-icon">
    <!-- META Description -->
    <meta name="description" content="Bienvenue sur Students'Books, c'est ici que commence la révolution scolaire.
    Emploi du temps/ devoirs/ absences... retrouver toutes les information scolaire içi">
    <!-- Titre du site -->
    <title>Accueil Students'Books : Les devoirs à la maison facilement</title>
</head>

<body>
    <div class="container-fluid h-100 p-0">
        <header class="w-100 mb-5 d-flex align-items-center">
            <img src="../public/img/LOGO SOLO.png" class="ms-3 h-100" alt="">
            <a href="../index.php" class="h-100 d-flex align-items-center">
                <img src="../public/img/backward.png" class="img-fluid" width="50" alt="">
            </a>
            <h1 class="ms-4 align-self-center text-center m-0">Devoirs</h1>
        </header>
        <div class="row justify-content-center justify-content-lg-evenly m-0 mb-5">
        <!-- colonne à rendre -->
            <div class="col-10 col-lg-4 resumeBloc h-100 mb-4">
            
                <h2>A rendre</h2>

                <?php foreach ($dataArray as $key => $currentArray) {
                        $save = explode("-", $currentArray[$key]['end_date']);
                        $year = $save[0];
                        $month = $save[1];
                        $day = $save[2];
                        $month = strftime('%h', strtotime("$day-$month-$year"));
                        $users = new User($currentArray[$key]['id_users']);
                        $teacher = $users->SelectOne();
                        $users = new User($teacher->id_matters);
                        $matters = $users->SelectOne('matters');
                ?>
                    <div class="hwEl d-flex w-100 mb-2">
                        <div class="hwDateBloc h-100">
                            <div id="hwDate" class="text-center fw-bold text-white subInfo"><?= $day ?> <br> <?= $month ?></div>
                        </div>
                        <div class="ps-1 w-100 bg-egg">
                            <div id="hwMatter" class="fw-bold"><?= $matters->matter ?> - <?= $currentArray[$key]['assignement'] ?></div>
                            <div id="hwProf" class="prof">Mme/Mr <?= $teacher->lastname?></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- colonne rendu -->
            <div class="col-10 col-lg-4 resumeBloc h-100">
                <h2>Rendu</h2>
                <div class="text-center text-white">Aucun devoirs rendu pour le moment.</div>
            </div>
            <?php if($_SESSION['rank'] == '3'){ ?>
            <div class="d-flex justify-content-center">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <label for="assignmentDate">Date de rendu du devoirs</label>
                    <input type="date" name="assignmentDate" id="assignmentDate">

                    <label for="assignmentName">Nom du devoir</label>
                    <input type="text" name="assignmentName" id="assignmentName">
                    
                    <label for="class">Classe</label>
                    <select name="class" id="class">
                        <option value=""></option>
                        <option value="1">6 ème</option>
                        <option value="2">5 ème</option>
                        <option value="3">4 ème</option>
                        <option value="4">3 ème</option>
                    </select>

                    <button type="submit">Ajouter le devoir</button>
                </form>
            </div>
            <?php } ?>
        </div>
        <div class="row justify-content-evenly w-100 d-none d-lg-flex">
            <div class="col-1 navBtnMob">
                <a href="../controller/noteCtrl.php">
                    <img src="../public/img/LogoNote.webp" class="img-fluid" width="100" alt="Page des notes" title="Vers les notes..">
                </a>
            </div>
            <div class="col-1 navBtnMob">
                <a href="edt.php">
                    <img src="../public/img/Edt.webp" class="img-fluid" width="100" alt="Page emploi du temps" title="Vers l'emploi du temps..">
                </a>
            </div>
            <div class="col-1  navBtnMob">
                <a href="absences.php">
                    <img src="../public/img/absences.webp" class="img-fluid" width="100" alt="Page des absences" title="Vers les absences..">
                </a>
            </div>
            <!-- <div class="col-1 navBtnMob ">
                <a href="agenda.php">
                    <img src="../public/img/agenda.png" class="img-fluid" width="100" alt="Page de l'agenda" title="Vers les agenda..">
                </a>
            </div> -->
            <div class="col-1 navBtnMob">
                <a href="tchat.php">
                    <img src="../public/img/message.png" class="img-fluid" width="100" alt="Page de la messagerie" title="Vers la messagerie..">
                </a>
            </div>
        </div>
        <footer class="d-flex flex-column justify-content-center align-items-center">
            <a href="view/mention.php" class="text-white " data-bs-toggle="modal" data-bs-target="#exampleModal">Un
                problème ?</a>
            <a href="view/mention.php" class="text-white">Mentions légales</a>
        </footer>
    </div>
    <!-- Bootstrap JavaScript -->
    <script src="../public/js/bootstrap/bootstrap.js"></script>
</body>

</html>