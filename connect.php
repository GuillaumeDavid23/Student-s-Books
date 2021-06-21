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
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- META Description -->
    <meta name="description" content="Bienvenue sur Students'Books, c'est ici que commence la révolution scolaire.
     Emploi du temps/ devoirs/ absences... retrouver toutes les information scolaire içi">
    <!-- Titre du site -->
    <title>Connexion Student's Books : Les devoirs à la maison facilement</title>
</head>
<body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-8 col-lg-4 h-75 text-center" id="connectBloc">
                <img src="assets/img/LogoStudentBook.webp" alt="logo student's books école facile" class="imgConnexion img-fluid mb-5 mt-4" width="50%">
                <form action="connexion.php" class="d-flex flex-column text-center align-items-center">
                    <label for="mail">E-mail :</label>
                    <input type="text" name="mail" id="inputMail" class="mb-4">
                    <label for="pass">Mot de passe : </label>
                    <input type="text" name="pass" id="inputPass" class="">

                    <button type="submit" class="mt-5 rounded-circle" id="btnSubmit"><img src="assets/img/arrow.png" alt="" class="img-fluid" width="50"></button>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JavaScript -->
    <script src="assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>