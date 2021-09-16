<?php if($_SESSION['user']->id_ranks == '3'){ //PROF ?>
    <div class="row pt-5 w-100 h-75 justify-content-center justify-content-lg-evenly text-white">
        <!-- colonne rendu -->
        <div class="col-10 h-100 col-lg-4 resumeBloc h-100">
            <h2>Rendu</h2>
            <?php
                $dir = './uploads/assign';
                
                if($dossier = opendir($dir))
                {
                    $nb_fichier = 0;
                    while(($fichier = readdir($dossier)))
                    {  
                        
                        if($fichier != '.' && $fichier != '..'){
                            $nb_fichier++;
                            $position = strpos($fichier, '.');
                            $fichier = substr($fichier, 0, $position);
                            $fichierArray = explode('-', $fichier);
                            $user = User::SelectOne($fichierArray[0]);
                            $assign = Assign::SelectOne($fichierArray[1]);
                        ?>
                            <div class="hwEl d-flex w-100 mb-2 text-dark">
                                <div class="ps-1 w-100 bg-egg">
                                    <div id="hwMatter" class="fw-bold"><?= $assign->assignement ?></div>
                                    <div id="hwProf" class="prof">Elève : <?= $user->firstname.' '.$user->lastname?></div>
                                </div>
                                <a href="/uploads/assign/<?=$fichier?>.pdf" target="_blank" class="btn btn-success">
                                    <i class="fas fa-file-download"></i>
                                </a>
                            </div>
                        <?php 
                        }
                    }
                    if ($nb_fichier == 0) {?>
                        <div class="text-center text-white">Aucun devoirs rendu pour le moment.</div>
                    <?php }
                }
            ?>
        </div>
        <div class="col-10 h-50 col-lg-3 resumeBloc p-3 align-self-center">
            <h3 class="text-center">Ajouter un devoir</h3>
            <?php if($code) :?>
                <div class="text-center h5 alert <?= $messageCode[$code]['type'] ?>">
                    <?= $messageCode[$code]['msg'] ?>
                </div>
            <?php endif ?>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="POST" class="d-flex flex-column align-items-center">

                <label for="assignmentDate">Date de rendu du devoirs</label>
                <input type="date" name="assignmentDate" id="assignmentDate">
                <div class="error"><?= $testError = array_key_exists('assignmentDate', $stockError) ? $stockError['assignmentDate']:'';?></div>

                <label for="assignmentName">Nom du devoir</label>
                <input type="text" name="assignmentName" id="assignmentName">
                <div class="error"><?= $testError = array_key_exists('assignmentName', $stockError) ? $stockError['assignmentName']:'';?></div>

                <label for="class">Classe</label>
                <select name="class" id="class">
                    <option value="">Choisissez une classe</option>
                    <?php
                    foreach ($classesArray as $value) {
                        echo "<option value=\"".$value['id']."\">".$value['class']."</option>";
                    }
                    ?>
                </select>
                <div class="error"><?= $testError = array_key_exists('class', $stockError) ? $stockError['class']:'';?></div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="returnAssign" value="1" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Rendu en ligne ?</label>
                </div>
                <div class="error"><?= $testError = array_key_exists('returnAssign', $stockError) ? $stockError['returnAssign']:'';?></div>

                <button type="submit" class="mt-3 btn btn-outline-success">Ajouter le devoir</button>
            </form>
        </div>
    </div>
<?php }else{ //ELEVE?>
<div class="row h-50 justify-content-center justify-content-lg-evenly m-0 mb-5">
    <!-- colonne à rendre -->
    <div class="col-10 col-lg-5 h-100 resumeBloc mb-4">

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
                <?php if ($currentArray['returnAssign'] == 1) { ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $currentArray['id'] ?>">
                        <i class="fas fa-folder-plus"></i>
                    </button>
                <?php } ?>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?= $currentArray['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $currentArray['id'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel<?= $currentArray['id'] ?>">Rendre un devoir</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="post" enctype='multipart/form-data'>
                            <div class="modal-body">
                                    <input type="hidden" name="idAssign" id="idAssign" value="<?= $currentArray['id'] ?>">
                                    <input type="file" name="assignFile" id="assignFile">
                                    <div class="text-center mt-3">
                                        <small class="alert-danger"><?= $stockError['assignFile'] ?? '' ?></small>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Envoyer le fichier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>



<?php } ?>
