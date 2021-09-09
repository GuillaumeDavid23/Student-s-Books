        <h1 class="text-center">Vos informations</h1>
        <div class="row justify-content-center justify-content-lg-evenly mb-5 p-5 w-100">
            
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
                    <div id="msg" class="text-center h5 alert-danger"></div>
                    <h5>Changer votre mot de passe</h5>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="post" id="changePass" class="d-flex flex-column">
                        
                        <label for="pass" class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="pass" id="pass" class="form-control" *required>
                        <small class="error"><?= $stockError['pass'] ?? '' ?></small>
                        <label for="checkPass" class="form-label">Confirmer nouveau mot de passe</label>
                        <input type="password" name="checkPass" id="checkPass" class="form-control" *required>
                        <small class="error"><?= $stockError['checkPass'] ?? '' ?></small>

                        <button type="submit" class="btn btn-outline-success mt-2" id="btnSubmit">Changer mon mot de passe.</button>
                    </form>
                </div>
            </div>
        </div>
