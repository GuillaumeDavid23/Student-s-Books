<?php
require_once(dirname(__FILE__).'/../public/utils/bdd.php');
/**
 * Explication de @param User
 * @param int $id
 * @param string $lastname 
 * @param string $firstname
 * @param date $birthdate
 * @param string $mail 
 * @param hash $password 
 * @param int $changePass 
 * @param true|false $statut 
 * @param int $id_ranks
 * @param int $id_matters
 * @param int $id_classes
 * @return void
 */
class User {
        private $id;
        private $firstname;
        private $lastname;
        private $birthdate;
        private $mail;
        private $password;
        private $changePass;
        private $statut;
        private $id_ranks;
        private $id_matters;
        private $id_classes;
        public $pdo;

        //Construction de la classe
        function __construct(
            $id = "" ,$firstname = "", $lastname = "", $birthdate = "", $mail = "", 
            $password = "", $changePass = "", $statut = "", 
            $id_ranks = "", $id_matters = "", $id_classes = "")
        {
            $this->id = $id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->birthdate = $birthdate;
            $this->mail = $mail;
            $this->password = $password;
            $this->changePass = $changePass;
            $this->statut = $statut;
            $this->id_ranks = $id_ranks;
            $this->id_matters = $id_matters;
            $this->id_classes = $id_classes;

            $this->pdo = SPDO::getInstance();
        }
        
        /**
         * Ajouter un utilisateurs
         */
        public function add()
        {
            $res = $this::checkDuplicate($this->mail);
            if($res === false){
                $sql = $this->pdo->prepare(
                    "INSERT INTO `users` (`firstname`,
                                        `lastname`,
                                        `birthdate`,
                                        `mail`, 
                                        `password`, 
                                        `changePass`, 
                                        `statut`, 
                                        `id_ranks`, 
                                        `id_matters`, 
                                        `id_classes`) 
                    VALUES(:firstname, 
                            :lastname, 
                            :birthdate, 
                            :mail, 
                            :password, 
                            :changePass, 
                            :statut, 
                            :id_ranks, 
                            :id_matters, 
                            :id_classes);");
                $sql->bindParam(':firstname', $this->firstname);
                $sql->bindParam(':lastname', $this->lastname);
                $sql->bindParam(':birthdate', $this->birthdate);
                $sql->bindParam(':mail', $this->mail);
                $sql->bindParam(':password', $this->password);
                $sql->bindParam(':changePass', $this->changePass);
                $sql->bindParam(':statut', $this->statut);
                $sql->bindParam(':id_ranks', $this->id_ranks);
                $sql->bindParam(':id_matters', $this->id_matters);
                $sql->bindParam(':id_classes', $this->id_classes);
                try {
                    $sql->execute();
                    return 1; //Validée 1
                } catch (PDOException $ex) {
                    return 11; //false 11
                }
            }else{
                return 2; //Doublon 2
            }
        }

        /**
         * Test si le mail est déjà dans la Base SQL
         * @param string $mail Mail à tester
         * @return string|int Retourne le mail doublon ou code erreur 11
         */
        public static function checkDuplicate($mail)
        {
            $pdo = SPDO::getInstance();
            $sql = "SELECT `mail` FROM `users` WHERE `mail` = :mail";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':mail', $mail);
            try {
                $stmt->execute();
                $result = $stmt->fetchColumn();
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }
        /**
         * Modifier un patient
         * @param int $id
         * @return true|int Validé ou Erreur
         */
        public function Modify()
        {
            $sql = $this->pdo->prepare("UPDATE `users`
            SET `firstname` = :firstname,
            `lastname` = :lastname,
            `birthdate` = :birthdate,
            `mail` = :mail,
            `password` = :password,
            `changePass` = :changePass
            WHERE `users`.`id` = :id");
            
            $sql->bindParam(':firstname', $this->firstname, PDO::PARAM_STR);
            $sql->bindParam(':lastname', $this->lastname, PDO::PARAM_STR);
            $sql->bindParam(':birthdate', $this->birthdate);
            $sql->bindParam(':mail', $this->mail, PDO::PARAM_STR);
            $sql->bindParam(':password', $this->password);
            $sql->bindParam(':changePass', $this->changePass, PDO::PARAM_INT);
            $sql->bindParam(':id', $this->id);
            
            try {
                $result = $sql->execute();
                return 3;
            } catch (PDOException $ex) {
                return 4;
            }
        }
        /**
         * Modifier un patient
         * @param int $id
         * @return true|int
         */
        public function ResetPass($token)
        {
            $sql = $this->pdo->prepare("UPDATE `users`
            SET `resetPass` = :resetPass,
            WHERE `users`.`mail` = :mail");
            
            $sql->bindParam(':resetPass', $token, PDO::PARAM_STR);
            $sql->bindParam(':mail', $this->mail, PDO::PARAM_STR);
            
            try {
                $result = $sql->execute();
                return 3;
            } catch (PDOException $ex) {
                return 4;
            }
        }
        /**
         * Sélection de colonne dans une ou plusieurs table.
         * @param string $column Colonnes choisies
         * @param string $table Tables choisies
         * @param string $addSql Paramètres SQL (optionnel)
         * @return array|false Retourne un tableau associatif ou False
         */
        public static function SelectAll()
        {
            $pdo = SPDO::getInstance();

            $sql = "SELECT * FROM `users`";
            try {
                $stmt = $pdo->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $ex) {
                return 404;
            }
        }

        public static function SelectAllByClass($idClass)
        {
            $pdo = SPDO::getInstance();

            $sql = "SELECT * FROM `users` WHERE `id_classes`= :id_class ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id_class', $idClass);
            try {
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $ex) {
                return 404;
            }
        }

        /**
         * Sélection d'un user par son id.
         * @param int $id
         * @return object|int Retourne un objet ou code 11
         */
        public static function SelectOne($id)
        {   
            $pdo = SPDO::getInstance();
            
            $sql= ("SELECT * FROM `users` WHERE `id` = :id");
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            try {
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_OBJ);
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }

        /**
         * Sélection d'un user par son mail.
         * @param string $email Colonnes choisies
         * @return object|int Retourne un objet ou code 11
         */
        public static function SelectOneByMail($email)
        {   
            $pdo = SPDO::getInstance();
            
            $sql= ("SELECT * FROM `users` WHERE `mail` = :mail");
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':mail', $email);
            try {
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_OBJ);
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }

        public static function Desactivate($id)
        {   
            $pdo = SPDO::getInstance();

            $sql = "UPDATE `users`
            SET `statut` = 0
            WHERE `users`.`id` = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            try {
                $result = $stmt->execute();
                return 14;
            } catch (PDOException $ex) {
                return 11;
            }
            
        }

        public static function SetAvatar($id, $ext)
        {   
            $pdo = SPDO::getInstance();

            $sql = "UPDATE `users`
            SET `pic` = :ext
            WHERE `users`.`id` = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':ext', $ext);
            try {
                $result = $stmt->execute();
                return 15;
            } catch (PDOException $ex) {
                return 11;
            }
            
        }
        
        
        /**
         * Supprime une entrée dans la Base
         * @param string $table Table sélectionnée
         * @param string $addSql Paramètre supplémentaire SQL
         */
        public function Delete()
        {   

            $sql = "DELETE FROM `users` WHERE `id` = $this->id";
            try {
                $sql = $this->pdo->query($sql);
                return $sql;
            } catch (PDOException $ex) {
                return 11;
            }
        }

        
        /**
         * Sélection de colonne dans une ou plusieurs table.
         * @param string $column Colonnes choisies
         * @param string $table Tables choisies
         * @param string $addSql Paramètres SQL (optionnel)
         * @return array|false Retourne un tableau associatif ou False
         */
        public static function Search($search)
        {
            $pdo = SPDO::getInstance();

            $sql = 'SELECT * FROM users WHERE lastname LIKE :search WHERE `statut` = 1';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':search', '%'.$search.'%');
            try {
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                return 11;
            }
        }

        public static function Count()
        {
            $pdo = SPDO::getInstance();

            $stmt = $pdo->query("SELECT COUNT(*) AS nb FROM users WHERE `statut` = 1");

            // On récupère le nombre d'articles
            
            try {
                $result = $stmt->fetch();
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
            
        }

        public static function Show()
        {
            $pdo = SPDO::getInstance();

             // On détermine sur quelle page on se trouve
            if(isset($_GET['list']) && !empty($_GET['list'])){
                $currentPage = (int) strip_tags($_GET['list']);
            }else{
                $currentPage = 1;
            }
            
            // On détermine le nombre d'articles par page
            $parPage = 4;
            // Calcul du 1er article de la page
            $premier = ($currentPage * $parPage) - $parPage;

            $stmt = $pdo->prepare("SELECT * FROM users WHERE `statut` = 1 LIMIT :premier, :parpage;");
            $stmt->bindValue(':premier', $premier, PDO::PARAM_INT);
            $stmt->bindValue(':parpage', $parPage, PDO::PARAM_INT);
            // On exécute
            try {
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
            
            
        }
        
}