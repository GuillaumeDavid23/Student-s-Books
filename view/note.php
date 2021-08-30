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
                                    if($currentArray['matter'] == $matter){
                                    ?>
                                    <div class="noteEl d-flex w-100 mb-2 bg-egg">
                                        <div class="notationBloc">
                                            <div id="notation" class="d-flex justify-content-center align-items-center"><?=$currentArray['note']?></div>
                                            <div id="onTwenty" class="d-flex justify-content-center align-items-center">20</div>
                                        </div>
                                        <div class="ps-1 bg-egg" id="infoNote">
                                            <div id="noteMatter" class="fw-bold"><?= $currentArray['matter'].' - '.$currentArray['notation'] ?></div>
                                            <div id="noteProf" class="prof">Mr/Mme <?=$currentArray['id_users_teacher_marks']?></div>
                                        </div>
                                    </div>
                                <?php }} ?>
                                </div>
                            </div>
                        </div>
                <?php } ?>
            
                </div>
            </div>
        </div>
        <!-- Ajout de note -->
        <div class="row justify-content-center mb-lg-5 mt-5">
            <?php if($_SESSION['rank'] == '3'){ ?>
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
                        <option value="1">6 ème</option>
                        <option value="2">5 ème</option>
                        <option value="3">4 ème</option>
                        <option value="4">3 ème</option>
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
                    <button class="btn btn-info mt-3" type="submit">Ajouter la note</button>
                </form>
            </div>
            <?php } ?>
        </div>
