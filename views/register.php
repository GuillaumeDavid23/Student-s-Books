<?php 
    session_start();
    if(empty($_SESSION['rank'])){
        header('Location: ../controllers/connectCtrl.php');
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/register.css">
    <title>Inscription La Manu : inscrivez-vous afin de pouvoir accéder à votre espace personnel</title>
</head>

<body>
    <h1>Inscription Student's Books</h1>
    <!-- Formulaire -->
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <!-- Affichage des erreurs -->
        <?php
            foreach ($stockError as $key => $value) { //boucle affichage ERROR
                echo "<div class='error'>$value</div>";
            }
        ?>

        <!-- Nom / Prénom -->
        <div>
            <label for="lastname">Nom : </label>
            <input type="text" name="lastname" id="lastname" <?= $classError = array_key_exists('lastname', $stockError) ? 'class="inputError"':'';?> placeholder="Nom" <?= $required = $requiredInput['lastname'] == true? 'required':'' ; ?> pattern="<?=REGEX_NAME?>">
            <label for="firstname">Prénom : </label>
            <input type="text" name="firstname" id="firstname" <?= $classError = array_key_exists('firstname', $stockError)? 'class="inputError"':'';?> placeholder="Prénom"  <?= $required = $requiredInput['firstname'] == true? 'required':'' ; ?> pattern="<?=REGEX_NAME?>">
        </div>

        <!-- Date de naissance -->
        <div>
            <label for="birthday">Date de naissance :</label>
            <input type="date" name="birthday" id="birthday" <?= $classError = array_key_exists('birthday', $stockError)? 'class="inputError"':'';?>  <?= $required = $requiredInput['birthday'] == true? 'required':'' ; ?>>
        </div>

        <!-- Email -->
        <div>
            <label for="mail">E-mail : </label>
            <input type="email" name="mail" id="mail" <?= $classError = array_key_exists('mail', $stockError)? 'class="inputError"':'';?> placeholder="Email"  <?= $required = $requiredInput['mail'] == true? 'required':'' ; ?> pattern="^((\w[^\W]+)[\.\-]?){1,}\@(([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$">
        </div>
        
        <select name="rank" id="rank" <?= $classError = array_key_exists('mail', $stockError)? 'class="inputError"':'';?> <?= $required = $requiredInput['mail'] == true? 'required':'' ; ?>>
            <option value=""></option>
            <option value="student">Etudiant</option>
            <option value="parent">Parent</option>
            <option value="teacher">Professeur</option>
            <option value=""></option>
        </select>
        <!-- Envoi du formulaire -->
        <button type="submit">Envoyer !</button>
    </form>
    
    <script src="assets/js/main.js"></script>
</body>

</html>