
<div class="row justify-content-center">
    <div class="col-8 col-md-4 col-lg-4  text-center h-100" id="connectBloc">
        <img src="/public/img/LogoStudentBook.webp" alt="logo student's books école facile" class="imgConnexion img-fluid mb-2 mt-4" width="50%">
        <fieldset  class="form-group">
            <legend>Connexion</legend>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=<?= $page ?>" method="POST" class="d-flex flex-column text-center align-items-center">
                <?php if($code) :?>
                    <div class="text-center h5 alert <?= $messageCode[$code]['type'] ?>">
                        <?= $messageCode[$code]['msg'] ?>
                    </div>
                <?php endif ?>
                <label for="inputMail">E-mail :</label>
                <?= $testError = array_key_exists('mail', $stockError) ? $stockError['mail']:'';?>
                <input type="mail" name="inputMail" id="inputMail" value="<?= $mail ?? '' ?>" class="mb-2 <?= $classError = array_key_exists('mail', $stockError) ? 'inputError':'';?>" pattern="^((\w[^\W]+)[\.\-]?){1,}\@(([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$" >
                
                <label for="inputPass">Mot de passe : </label>
                <?= $testError = array_key_exists('password', $stockError) ? $stockError['password']:'';?>
                <input type="password" name="inputPass" id="inputPass" <?= $classError = array_key_exists('password', $stockError) ? 'class="inputError"':'';?>>
                <a href="/index.php?page=9" class="link link-warning">Mot de passe oublié ?</a>
                <button type="submit" class="m-3 rounded-circle" id="btnSubmit"><i class="fas fa-sign-in-alt fa-2x"></i></button>
            </form>
        </fieldset>
    </div>
</div>
