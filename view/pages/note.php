        <!-- Affichage des notes -->
        <?php if($_SESSION['user']->id_ranks == 1 || $_SESSION['user']->id_ranks == 2){ ?>
            <div class="row flex-column justify-content-center align-items-center">
                <div class="accordion accordion-flush col-12 col-lg-8 mb-5" id="accordionFlushExample">
                    <?php 
                        $count = 0;
                        foreach ($arrayOfMatters as $matter) { 
                            $count++; 
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading<?= $count ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse<?= $count ?>" aria-expanded="false" aria-controls="flush-collapse<?= $count ?>">
                                <?= $matter ?>
                            </button>
                        </h2>
                        <div id="flush-collapse<?= $count ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $count ?>"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                            <?php foreach ($dataArray as $key => $currentArray) {
                                    $dataUser = User::SelectOne($currentArray['id_users_teacher_marks']);

                                if($currentArray['matter'] == $matter){
                                ?>
                                <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                    <div class="notationBloc">
                                        <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['note']?></div>
                                        <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                    </div>
                                    <div class="ps-1 bg-egg" id="infoNote">
                                        <div id="noteMatter" class="fw-bold"><?= $currentArray['matter'].' - '.$currentArray['notation'] ?></div>
                                        <div id="noteProf" class="prof">Mr/Mme <?=$dataUser->lastname?></div>
                                    </div>
                                </div>
                            <?php }} ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="w-25 text-center h4 alert-<?= $result = $avg > 10 ? 'success' : 'danger'; ?>">Votre moyenne est de : <?= $avg ?></div>

                </div>

            </div>
        <?php } ?>

        <!-- Ajout de note -->
        <?php if($_SESSION['user']->id_ranks == '3'){ ?>

            <div class="row justify-content-center mb-lg-5 mt-5">
                
                <div class="col-8 resumeBloc text-white col-md-6 col-lg-5 col-xl-4 p-3">
                    <h3 class="text-center">Ajouter une note</h3>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="POST" class="w-100 d-flex flex-column justify-content-center">
                        <label for="notationDate">Date de la note</label>
                        <input type="date" required max="<?= date('Y-m-d') ?>" name="notationDate" id="notationDate">

                        <label for="notationName">Nom de la note</label>
                        <input type="text" required name="notationName" id="notationName">

                        <label for="notationInput">Note sur 20</label>
                        <input type="number" min="0" max="20" required name="notationInput" id="notationInput">
                        
                        <label for="class">Classe</label>
                        <select name="class" id="class">
                            <option value=""></option>
                            <?php foreach ($classesArray as $data){ ?>
                                    <option value="<?=$data['id']?>"><?=$data['class']?></option>
                            <?php }?>
                        </select>

                        <label for="student">élève :</label>
                        <select name="student" id="student">
                            <option value=""></option>
                        <?php   
                        foreach ($dataUsers as $data){ 
                            if($data['id_ranks'] == '1'){?>
                                <option value="<?=$data['id']?>"><?=$data['firstname'].' '.$data['lastname'] ?></option>
                        <?php }}?>
                        </select>
                        <button class="btn btn-outline-success mt-3" type="submit">Ajouter la note</button>
                    </form>
                </div>
            </div>
        <?php } ?>
