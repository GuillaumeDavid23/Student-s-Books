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
                        $teacher = User::SelectOne($currentArray['id_users']);
                        $matters = Matter::SelectOne($teacher->id_matters);
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
            <?php if($_SESSION['user']->id_ranks == '3'){ ?>
            <div class="mt-5">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="POST" class="d-flex flex-column align-items-center">
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

                    <button type="submit" class="mt-3 btn btn-outline-success">Ajouter le devoir</button>
                </form>
            </div>
            <?php } ?>
        </div>