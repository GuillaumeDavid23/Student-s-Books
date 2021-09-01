        <h1 class="text-center">Vos informations</h1>
        <div class="row justify-content-center justify-content-lg-evenly mb-5 p-5">
            
            <div class=" col-10 col-md-4 info text-center">
                <h3>Bonjour <?=$user->firstname.' '.$user->lastname?></h3>
                <div class="list">
                    <strong>Votre date de naissance est :</strong>  <?=$user->birthdate?> <br>
                    <strong>Votre e-mail :</strong>  <?=$user->mail?> <br>
                    <strong>Votre rang :</strong>  <?=$rank->rank?> <br>
                    <?php if($user->id_ranks == "3"){?>
                        <strong>Votre matière : </strong> <?= $matter->matter?><br>
                    <?php } ?>
                </div>
                <div class="border-top border-2 border-dark mt-5 pt-3">
                    <?php if($code) :?>
                        <div class="text-center h5 alert <?= $messageCode[$code]['type'] ?>">
                            <?= $messageCode[$code]['msg'] ?>
                        </div>
                    <?php endif ?>
                    <h5>Changer votre mot de passe</h5>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="d-flex flex-column">
                        <label for="pass" class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="pass" id="pass" class="form-control" required>

                        <label for="checkPass" class="form-label">Confirmer nouveau mot de passe</label>
                        <input type="password" name="checkPass" id="checkPass" class="form-control" required>

                        <button type="submit" class="btn btn-outline-success mt-2">Changer mon mot de passe.</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row justify-content-evenly w-100 d-none d-lg-flex">
            <div class="col-1 navBtnMob">
                <a href="../controller/noteCtrl.php">
                    <img src="../public/img/LogoNote.webp" class="img-fluid" width="100" alt="Page des notes" title="Vers les notes..">
                </a>
            </div>
            <div class="col-1 navBtnMob">
                <a href="../controller/assignmentCtrl.php">
                    <img src="../public/img/devoirs.webp" class="img-fluid" width="100" alt="Page des devoirs" title="Vers les devoirs..">
                </a>
            </div>
            <div class="col-1  navBtnMob">
                <a href="absences.php">
                    <img src="../public/img/absences.webp" class="img-fluid" width="100" alt="Page des absences" title="Vers les absences..">
                </a>
            </div>
            <!-- <div class="col-1 navBtnMob ">
                <a href="agenda.php">
                    <img src="../public/img/agenda.png" class="img-fluid" width="100" alt="Page de l'agenda" title="Vers l'agenda..">
                </a>
            </div> -->
            <div class="col-1 navBtnMob">
                <a href="tchat.php">
                    <img src="../public/img/message.png" class="img-fluid" width="100" alt="Page des notes" title="Vers la messagerie..">
                </a>
            </div>
        </div>
