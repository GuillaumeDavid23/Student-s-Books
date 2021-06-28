
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
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/css/bootstrap/bootstrap.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../public/css/general.css">
    <link rel="stylesheet" href="../public/css/connect.css">
    <!-- META Description -->
    <meta name="description" content="Bienvenue sur Students'Books, c'est ici que commence la révolution scolaire.
     Emploi du temps/ devoirs/ absences... retrouver toutes les information scolaire içi">
    <!-- Titre du site -->
    <title>Connexion Student's Books : Les devoirs à la maison facilement</title>
</head>
<body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-8 col-lg-4  text-center" id="connectBloc">
                <img src="../public/img/LogoStudentBook.webp" alt="logo student's books école facile" class="imgConnexion img-fluid mb-5 mt-4" width="50%">
                <fieldset  class="form-group">
                    <legend>Changer votre mot de passe</legend>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="d-flex flex-column text-center align-items-center">
                        <label for="inputPass">Mot de passe :</label>
                        <input type="password" name="inputPass" id="inputPass" required class="mb-4  <?= $classError = array_key_exists('inputPass', $stockError) ? 'inputError':'';?>" pattern="^((\w[^\W]+)[\.\-]?){1,}\@(([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$" >
                        <label for="inputCtrlPass">Confirmation du mot de passe : </label>
                        <input type="password" name="inputCtrlPass" id="inputCtrlPass" required <?= $classError = array_key_exists('inputCtrlPass', $stockError) ? 'class="inputError"':'';?>>
                        <button type="submit" class="m-2 rounded-circle" id="btnSubmit"><img src="../public/img/arrow.png" alt="" class="img-fluid" width="40"></button>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
    <!-- Bootstrap JavaScript -->
    <script src="../public/js/bootstrap/bootstrap.js"></script>
</body>
</html>