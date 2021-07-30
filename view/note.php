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
    <link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
    <!-- META Description -->
    <meta name="description" content="Bienvenue sur Students'Books, c'est ici que commence la révolution scolaire.
        Emploi du temps/ devoirs/ absences... retrouver toutes les information scolaire içi">
    <!-- Titre du site -->
    <title>Page des notes Students'Books : Les devoirs à la maison facilement</title>
</head>

<body>
    <div class="container-fluid h-100 p-0">
        <header class="w-100 mb-5 d-flex align-items-center">
            <img src="../public/img/LOGO SOLO.png" class="ms-3 h-100" alt="">
            <a href="../index.php" class="h-100 d-flex align-items-center">
                <img src="../public/img/backward.png" class="img-fluid" width="50" alt="">
            </a>
            <h1 class="ms-4 align-self-center text-center m-0">Notes</h1>
        </header>
        <div class="row justify-content-center">
            <div class="accordion accordion-flush col-12 col-lg-8" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Mathématique
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach ($dataArray as $key => $currentArray) {
                                if($currentArray['matter'] == "Math"){
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['notation']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $currentArray['matter'].' - '.$currentArray['name'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$currentArray['teacher']?></div>
                                    </div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Histoire géographie
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach ($dataArray as $dataKey => $currentArray) {
                                if($currentArray['matter'] == "Histoire"){
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['notation']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $currentArray['matter'].' - '.$currentArray['name'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$currentArray['teacher']?></div>
                                    </div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                            aria-controls="flush-collapseThree">
                            Francais
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach ($dataArray as $key => $currentArray) {
                                if($currentArray['matter'] == "Français"){
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['notation']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $currentArray['matter'].' - '.$currentArray['name'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$currentArray['teacher']?></div>
                                    </div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseFour" aria-expanded="false"
                            aria-controls="flush-collapseFour">
                            Sciences de la vie et de la terre
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach ($dataArray as $key => $currentArray) {
                                if($currentArray['matter'] == "SVT"){
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['notation']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $currentArray['matter'].' - '.$currentArray['name'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$currentArray['teacher']?></div>
                                    </div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseFive" aria-expanded="false"
                            aria-controls="flush-collapseFive">
                            Sciences physiques
                        </button>
                    </h2>
                    <div id="flush-collapseFive" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach ($dataArray as $key => $currentArray) {
                                if($currentArray['matter'] == "Sciences"){
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['notation']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $currentArray['matter'].' - '.$currentArray['name'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$currentArray['teacher']?></div>
                                    </div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseSix" aria-expanded="false"
                            aria-controls="flush-collapseSix">
                            Technologie
                        </button>
                    </h2>
                    <div id="flush-collapseSix" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach ($dataArray as $key => $currentArray) {
                                if($currentArray['matter'] == "Technologie"){
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['notation']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $currentArray['matter'].' - '.$currentArray['name'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$currentArray['teacher']?></div>
                                    </div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseSeven" aria-expanded="false"
                            aria-controls="flush-collapseSeven">
                            Musique
                        </button>
                    </h2>
                    <div id="flush-collapseSeven" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach ($dataArray as $key => $currentArray) {
                                if($currentArray['matter'] == "Musique"){
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['notation']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $currentArray['matter'].' - '.$currentArray['name'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$currentArray['teacher']?></div>
                                    </div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingEight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseEight" aria-expanded="false"
                            aria-controls="flush-collapseEight">
                            Anglais
                        </button>
                    </h2>
                    <div id="flush-collapseEight" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach ($dataArray as $key => $currentArray) {
                                if($currentArray['matter'] == "Anglais"){
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['notation']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $currentArray['matter'].' - '.$currentArray['name'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$currentArray['teacher']?></div>
                                    </div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingNine">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseNine" aria-expanded="false"
                            aria-controls="flush-collapseNine">
                            Art Plastiques
                        </button>
                    </h2>
                    <div id="flush-collapseNine" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach ($dataArray as $key => $currentArray) {
                                if($currentArray['matter'] == "Art"){
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['notation']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $currentArray['matter'].' - '.$currentArray['name'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$currentArray['teacher']?></div>
                                    </div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTen" aria-expanded="false"
                            aria-controls="flush-collapseTen">
                            EPS
                        </button>
                    </h2>
                    <div id="flush-collapseTen" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php foreach ($dataArray as $key => $currentArray) {
                                if($currentArray['matter'] == "EPS"){
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['notation']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $currentArray['matter'].' - '.$currentArray['name'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$currentArray['teacher']?></div>
                                    </div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-lg-5 mt-5">
            <?php if($_SESSION['rank'] == 'teacher'){ ?>
            <div class="col-8 col-md-6 col-lg-5 col-xl-4">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="w-100 d-flex flex-column justify-content-center">
                    <label for="notationDate">Date de la note</label>
                    <input type="date" name="notationDate" id="notationDate">

                    <label for="notationName">Nom de la note</label>
                    <input type="text" name="notationName" id="notationName">

                    <label for="notationInput">Note sur 20</label>
                    <input type="number" min="0" max="20" name="notationInput" id="notationInput">
                    
                    <label for="class">Classe</label>
                    <select name="class" id="class">
                        <option value=""></option>
                        <option value="6ème">6 ème</option>
                        <option value="5ème">5 ème</option>
                        <option value="4ème">4 ème</option>
                        <option value="3ème">3 ème</option>
                    </select>

                    <label for="student">élève :</label>
                    <select name="student" id="student">
                        <option value=""></option>
                    <?php 

                    $sql = "SELECT * FROM users";
                    $request = $pdo->query($sql);
                    
                    // $request = $bdd->selectAll($pdo, 'users');
                    
                    while ($data = $request->fetch(PDO::FETCH_ASSOC)){ 
                        if($data['rank'] == 'student'){?>
                            <option value="<?=$data['lastname']?>"><?=$data['firstname'].' '.$data['lastname'] ?></option>
                    <?php }}?>
                    </select>
                    <button type="submit">Ajouter la note</button>
                </form>
            </div>
            <?php } ?>
        </div>
        <div class="row justify-content-evenly w-100 d-none d-lg-flex">
            <div class="col-1 navBtnMob">
                <a href="../controller/assignmentCtrl.php">
                    <img src="../public/img/devoirs.webp" class="img-fluid" width="100" alt="Page des devoirs" title="Vers les devoirs..">
                </a>
            </div>
            <div class="col-1 navBtnMob">
                <a href="edt.php">
                    <img src="../public/img/Edt.webp" class="img-fluid" width="100" alt="Page emploi du temps" title="Vers l'emploi du temps..">
                </a>
            </div>
            <div class="col-1  navBtnMob">
                <a href="absences.php">
                    <img src="../public/img/absences.webp" class="img-fluid" width="100"  alt="Page des absences" title="Vers les absences..">
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