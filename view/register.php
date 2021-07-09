<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/css/bootstrap/bootstrap.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../public/css/general.css">
    <link rel="stylesheet" href="../public/css/register.css">
    <title>Inscription La Manu : inscrivez-vous afin de pouvoir accéder à votre espace personnel</title>
</head>

<body>
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-8 col-lg-4  text-center" id="connectBloc">
            <img src="../public/img/LogoStudentBook.webp" alt="logo student's books école facile"
                class="imgConnexion img-fluid mb-5 mt-4" width="50%">
            <fieldset class="form-group">
                <legend>Inscription</legend>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"
                    class="d-flex flex-column text-center align-items-center">

                    <!-- Nom / Prénom -->
                    <label for="lastname">Nom : </label>
                    <div class="error"><?= $testError = array_key_exists('lastname', $stockError) ? $stockError['lastname']:'';?></div>
                    <input type="text" name="lastname" id="lastname"
                        <?= $classError = array_key_exists('lastname', $stockError) ? 'class="inputError"':'';?>
                        placeholder="Nom" <?= $required = $requiredInput['lastname'] == true? 'required':'' ; ?>
                        pattern="<?=REGEX_NAME?>">

                    <label for="firstname">Prénom : </label>
                    <div class="error"><?= $testError = array_key_exists('firstname', $stockError) ? $stockError['firstname']:'';?></div>
                    <input type="text" name="firstname" id="firstname"
                        <?= $classError = array_key_exists('firstname', $stockError)? 'class="inputError"':'';?>
                        placeholder="Prénom" <?= $required = $requiredInput['firstname'] == true? 'required':'' ; ?>
                        pattern="<?=REGEX_NAME?>">

                    <!-- Date de naissance -->
                    <label for="birthday">Date de naissance :</label>
                    <?= $testError = array_key_exists('birthday', $stockError) ? $stockError['birthday']:'';?>
                    <input type="date" name="birthday" id="birthday"
                        <?= $classError = array_key_exists('birthday', $stockError)? 'class="inputError"':'';?>
                        <?= $required = $requiredInput['birthday'] == true? 'required':'' ; ?>>
                    
                    <!-- Email -->
                    <label for="mail">E-mail : </label>
                    <div class="error"><?= $testError = array_key_exists('mail', $stockError) ? $stockError['mail']:'';?></div>
                    <input type="email" name="mail" id="mail"
                        <?= $classError = array_key_exists('mail', $stockError)? 'class="inputError"':'';?>
                        placeholder="Email" <?= $required = $requiredInput['mail'] == true? 'required':'' ; ?>
                        pattern="^((\w[^\W]+)[\.\-]?){1,}\@(([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$">
                    
                    <!-- Rang -->
                    <label for="rank">Rang :</label>
                    <div class="error"><?= $testError = array_key_exists('rank', $stockError) ? $stockError['rank']:'';?></div>
                    <select name="rank" id="rank"
                        <?= $classError = array_key_exists('rank', $stockError)? 'class="inputError"':'';?>
                        <?= $required = $requiredInput['mail'] == true? 'required':'' ; ?>>
                        <option value=""></option>
                        <option value="student">Etudiant</option>
                        <option value="parent">Parent</option>
                        <option value="teacher">Professeur</option>
                    </select>
                    <!-- Matière -->
                    <div class="d-flex flex-column d-none" id="subjectBloc">
                        <label for="subject">Matière :</label>
                        <div class="error"><?= $testError = array_key_exists('subject', $stockError) ? $stockError['subject']:'';?></div>
                        <select name="subject" id="subject"
                            <?= $classError = array_key_exists('subject', $stockError)? 'class="inputError"':'';?>>
                            <option value="" selected></option>
                            <option value="Math">Math</option>
                            <option value="Français">Français</option>
                            <option value="Science">Science</option>
                            <option value="SVT">SVT</option>
                            <option value="Anglais">Anglais</option>
                            <option value="Latin">Latin</option>
                            <option value="Sport">Sport</option>
                        </select>
                    </div>
                    
                    <!-- Envoi du formulaire -->
                    <button type="submit" class="m-2 rounded-circle" id="btnSubmit"><img src="../public/img/arrow.png" alt="" class="img-fluid" width="40"></button>
                </form>
            </fieldset>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="../public/js/main.js"></script>
    <script src="../public/js/bootstrap/bootstrap.js"></script>
    
</body>

</html>