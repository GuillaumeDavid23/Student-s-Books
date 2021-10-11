 <?php
switch ($page) {
    case 1:
        $pages =  [
            2 => (object) ['alt' => 'Page des devoirs','title' => 'Vers les devoirs..'],
            3 => (object) ['alt' => 'Page emploi du temps','title' => 'Vers l\'emploi du temps..'],
            4 => (object) ['alt' => 'Page des absences','title' => 'Vers les absences..'],
            5 => (object) ['alt' => 'Page de l\'agenda','title' => 'Vers l\'agenda..'],
            8 => (object) ['alt' => 'Page de la messagerie','title' => 'Vers la messagerie..']
        ];
        break;
    case 2:
        $pages =  [
            1 => (object) ['alt' => 'Page des notes','title' => 'Vers les notes..'],
            3 => (object) ['alt' => 'Page emploi du temps','title' => 'Vers l\'emploi du temps..'],
            4 => (object) ['alt' => 'Page des absences','title' => 'Vers les absences..'],
            5 => (object) ['alt' => 'Page de l\'agenda','title' => 'Vers l\'agenda..'],
            8 => (object) ['alt' => 'Page de la messagerie','title' => 'Vers la messagerie..']
        ];
        break;
    case 3:
        $pages =  [
            2 => (object) ['alt' => 'Page des devoirs','title' => 'Vers les devoirs..'],
            1 => (object) ['alt' => 'Page des notes','title' => 'Vers les notes..'],
            4 => (object) ['alt' => 'Page des absences','title' => 'Vers les absences..'],
            5 => (object) ['alt' => 'Page de l\'agenda','title' => 'Vers l\'agenda..'],
            8 => (object) ['alt' => 'Page de la messagerie','title' => 'Vers la messagerie..']
        ];
        break;
    case 4:
        $pages =  [
            2 => (object) ['alt' => 'Page des devoirs','title' => 'Vers les devoirs..'],
            1 => (object) ['alt' => 'Page des notes','title' => 'Vers les notes..'],
            3 => (object) ['alt' => 'Page emploi du temps','title' => 'Vers l\'emploi du temps..'],
            5 => (object) ['alt' => 'Page de l\'agenda','title' => 'Vers l\'agenda..'],
            8 => (object) ['alt' => 'Page de la messagerie','title' => 'Vers la messagerie..']
        ];
        break;
    case 7:
        $pages =  [
            2 => (object) ['alt' => 'Page des devoirs','title' => 'Vers les devoirs..'],
            1 => (object) ['alt' => 'Page des notes','title' => 'Vers les notes..'],
            3 => (object) ['alt' => 'Page emploi du temps','title' => 'Vers l\'emploi du temps..'],
            5 => (object) ['alt' => 'Page de l\'agenda','title' => 'Vers l\'agenda..'],
            8 => (object) ['alt' => 'Page de la messagerie','title' => 'Vers la messagerie..']
        ];
        break;
    case 8:
        $pages =  [
            2 => (object) ['alt' => 'Page des devoirs','title' => 'Vers les devoirs..'],
            1 => (object) ['alt' => 'Page des notes','title' => 'Vers les notes..'],
            3 => (object) ['alt' => 'Page emploi du temps','title' => 'Vers l\'emploi du temps..'],
            5 => (object) ['alt' => 'Page de l\'agenda','title' => 'Vers l\'agenda..'],
            8 => (object) ['alt' => 'Page de la messagerie','title' => 'Vers la messagerie..']
        ];
        break;
    default:
        $pages = [];
        break;
}
if(isset($_SESSION['user']) && $_SESSION['user']->id_ranks == 3){
    unset($pages[4]);
}
?>
            <?php if(!empty($pages)){?>        
            <div class="mt-5 mb-5 row justify-content-evenly w-100 d-none d-lg-flex">
                <?php 
                
                foreach ($pages as $key => $value) { ?>
                    <div class="col-1 navBtnMob">
                        <a href="../index.php?page=<?= $key ?>">
                            <img src="../public/img/nav/<?= $key ?>.webp" class="img-fluid" width="100" alt="Page des devoirs" title="<?= $value->title ?>">
                        </a>
                    </div>
                <?php } ?>
            </div>
            <?php } ?>
            
        </main>
        <footer class="d-flex flex-column justify-content-center align-items-center">

            <a href="#" class="text-white " data-bs-toggle="modal" data-bs-target="#Prob">
                Un problème ?
            </a>
            <a href="/index.php?page=13" class="text-white">Mentions légales</a>
        </footer>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="Prob" tabindex="-1" aria-labelledby="ProbLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ProbLabel">Un problème ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body d-flex flex-column">
                        <label for="object" class="mb-2">Titre de votre demande</label>
                        <input type="text" name="object" id="object" class="mb-3">
                        <label for="prob">Décrivez votre problème</label>
                        <textarea name="prob" id="prob" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-info text-white">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <?php
        if($page == 7){
            echo '<script src="../public/js/changePass.js"></script>';
        }
        if($page == 11){
            echo '<script src="../public/js/main.js"></script>';
        }
        if($page == 3){
            echo '<script src="../public/js/edt.js"></script>';
        }
    ?>

    <script src="/public/js/bootstrap/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>

</html>