<div class="row justify-content-center align-items-center">
    <div class="col-11 col-md-8 resumeBloc">
        <h2>Liste des utilisateurs</h2>
        <?php if($code) :?>
            <div class="text-center h5 alert <?= $messageCode[$code]['type'] ?>">
                <?= $messageCode[$code]['msg'] ?>
            </div>
        <?php endif ?>
        <div class="d-flex justify-content-center mb-5">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=15" method="post">
                <label for="search" class="form-label fw-bold">Rechercher un patient : </label>
                <input type="text" name="search" placeholder="Recherche" id="search">
                <button type="submit" class="btn btn-outline-success me-1">Recherche</button>
            </form>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=15" method="post">
                <button type="submit" class="btn btn-outline-danger">Annuler</button>
            </form>
        </div>
        <div class="d-flex justify-content-center">
            <table class="bg-white">
                <thead class="border-1 text-center">
                    <th class="border-1 p-3">#</th>
                    <th class="border-1 p-3">Nom de famille</th>
                    <th class="border-1 p-3">Prénom</th>
                    <th class="border-1 p-3 ">Date de naissance</th>
                    <th class="border-1 p-3">Email</th>
                    <th class="border-1 p-3">Action</th>
                </thead>
                <tbody class="border-1">
                    <?php foreach ($data as $user) { 
                        $count++;?>
                    <tr>
                        <td class="border-1 h5 text-center"><?= $count ?></td>
                        <td class="border-1" data-href='../controllers/profil-patientCtrl.php?id=<?= $user['id'] ?>'><?= $user['lastname'] ?></td>
                        <td class="border-1" data-href='../controllers/profil-patientCtrl.php?id=<?= $user['id'] ?>'><?= $user['firstname']?></td>
                        <td class="border-1" data-href='../controllers/profil-patientCtrl.php?id=<?= $user['id'] ?>'><?= $user['birthdate']?></td>
                        <td class="border-1" data-href='../controllers/profil-patientCtrl.php?id=<?= $user['id'] ?>'><?= $user['mail']?></td>
                        <td class="border-1">
                            <a href="/index.php?page=16&id=<?= $user['id'] ?>" class="btn btn-warning rounded"><i class="fas fa-user-slash"></i></a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <nav class="d-flex justify-content-center mt-5">
            <ul class="pagination ">
                <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                <li class="page-item <?= ($currentList == 1) ? "disabled" : "" ?>">
                    <a href="./index.php?page=15&list=<?= $currentList - 1 ?>" class="page-link">Précédente</a>
                </li>
                <?php for($list = 1; $list <= $pagesNb; $list++): ?>
                <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                <li class="page-item <?= ($currentList == $list) ? "active" : "" ?>">
                    <a href="./index.php?page=15&list=<?= $list ?>" class="page-link"><?= $list ?></a>
                </li>
                <?php endfor ?>
                <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                <li class="page-item <?= ($currentList == $pagesNb) ? "disabled" : "" ?>">
                    <a href="./index.php?page=15&list=<?= $currentList + 1 ?>" class="page-link">Suivante</a>
                </li>
            </ul>
        </nav>
    </div>
</div>