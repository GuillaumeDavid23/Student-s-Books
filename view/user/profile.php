<h1 class="text-center">Vos informations</h1>

<div class="avatarBloc d-flex position-relative justify-content-center" id="pic">
    <img width='150' class="rounded-circle" src="/uploads/users/<?= $_SESSION['user']->id.'.jpg' ?>" alt="">

    <div class="avatarBtn">
        <a href="#" data-bs-toggle="modal" data-bs-target="#Avatar" class="text"><i class="fas fa-user-edit fa-lg">i</i></a>
    </div>
</div>
<div class="text-center mt-3">
    <small class="alert-danger"><?= $stockError['avatar'] ?? '' ?></small>
</div>

<div class="row justify-content-center justify-content-lg-evenly mb-5 p-5 w-100">
    
    <div class=" col-10 col-md-4 info text-center ">
        <?php if($code) :?>
            <div class="text-center h5 alert <?= $messageCode[$code]['type'] ?>">
                <?= $messageCode[$code]['msg'] ?>
            </div>
        <?php endif ?>
        <h3>Bonjour <?=$user->firstname.' '.$user->lastname?></h3>
        <div class="list">
            <strong>Votre date de naissance est :</strong>  <?=$user->birthdate?> <br>
            <strong>Votre e-mail :</strong>  <?=$user->mail?> <br>
            <strong>Votre rang :</strong>  <?=$rank->rank?> <br>
            <?php if($user->id_ranks == "3"){?>
                <strong>Votre matière : </strong> <?= $matter->matter?><br>
            <?php } ?>
        </div>
        <div class="border-top border-2 border-dark mt-5 pt-3 mb-5">
            <div id="msg" class="text-center h5 alert-danger"></div>
            <h5>Changer votre mot de passe</h5>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="post" id="changePass" class="d-flex flex-column">
                
                <label for="pass" class="form-label">Nouveau mot de passe</label>
                <input type="password" name="pass" id="pass" class="form-control" required>
                <small class="error"><?= $stockError['pass'] ?? '' ?></small>
                <label for="checkPass" class="form-label">Confirmer nouveau mot de passe</label>
                <input type="password" name="checkPass" id="checkPass" class="form-control" required>
                <small class="error"><?= $stockError['checkPass'] ?? '' ?></small>

                <button type="submit" class="btn btn-outline-success mt-2" id="btnSubmit">Changer mon mot de passe.</button>
            </form>
        </div>

        <a href="/controller/user/desactivateCtrl.php?id=<?= $_SESSION['user']->id ?>" class="btn btn-danger mt-5">Désactiver mon compte</a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Avatar" tabindex="-1" aria-labelledby="AvatarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AvatarLabel">Changer votre image de profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="post" enctype="multipart/form-data" class="text-center">
                <div class="modal-body">
                    <div>
                        <input type="file" id="fileselect" accept="image/*" name="fileselect" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Envoyer l'image</button>
                </div>
            </form>
        </div>
    </div>
</div>