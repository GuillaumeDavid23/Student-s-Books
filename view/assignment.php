
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

                <?php foreach ($dataArray as $currentArray) {
                        $save = explode("-", $currentArray['end_date']);
                        $year = $save[0];
                        $month = $save[1];
                        $day = $save[2];
                        $month = strftime('%h', strtotime("$day-$month-$year"));
                        $users = new User($currentArray['id_users']);
                        $teacher = $users->SelectOne();
                        $users = new User($teacher->id_matters);
                        $matters = $users->SelectOne('matters');
                ?>
                    <div class="hwEl d-flex w-100 mb-2">
                        <div class="hwDateBloc h-100">
                            <div id="hwDate" class="text-center fw-bold text-white subInfo"><?= $day ?> <br> <?= $month ?></div>
                        </div>
                        <div class="ps-1 w-100 bg-egg">
                            <div id="hwMatter" class="fw-bold"><?= $matters->matter ?> - <?= $currentArray['assignement'] ?></div>
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