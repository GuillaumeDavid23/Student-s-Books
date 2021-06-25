<?php 
    session_start();
    if(empty($_SESSION['rank'])){
        header('Location: ../controllers/connectCtrl.php');
    }
?>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-8 col-lg-4  text-center" id="connectBloc">
            <img src="../assets/img/LogoStudentBook.webp" alt="logo student's books école facile" class="imgConnexion img-fluid mb-5 mt-4" width="50%">
            <fieldset  class="form-group">
                <legend>Connexion</legend>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="d-flex flex-column text-center align-items-center">
                    <label for="inputMail">E-mail :</label>
                    <input type="mail" name="inputMail" id="inputMail" class="mb-4 <?= $classError = array_key_exists('mail', $stockError) ? 'inputError':'';?>" pattern="^((\w[^\W]+)[\.\-]?){1,}\@(([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$" >
                    <label for="inputPass">Mot de passe : </label>
                    <input type="password" name="inputPass" id="inputPass" <?= $classError = array_key_exists('password', $stockError) ? 'class="inputError"':'';?>>
                    <button type="submit" class="m-2 rounded-circle" id="btnSubmit"><img src="../assets/img/arrow.png" alt="" class="img-fluid" width="40"></button>
                </form>
            </fieldset>
        </div>
    </div>
</div>
