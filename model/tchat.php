<?php
require_once(dirname(__FILE__).'/../public/utils/bdd.php');
/**
 * Explication de @param Slots
 * @param int $id
 * @param string $slot
 * @return void
 */
class Chat {
        private $id;
        private $message;
        private $id_users;

        public $pdo;

        //Construction de la classe
        function __construct($id = "" ,$message = "", $id_users = "")
        {
            $this->id = $id;
            $this->message = $message;
            $this->id_users = $id_users;
            
            $this->pdo = SPDO::getInstance();
        }
        
        /**
         * Sélection de colonne dans une ou plusieurs table.
         * @param string $column Colonnes choisies
         * @param string $table Tables choisies
         * @param string $addSql Paramètres SQL (optionnel)
         * @return array|false Retourne un tableau associatif ou False
         */
        public static function SelectAll($lastId = "", $id_class = "")
        {
            $pdo = SPDO::getInstance();
            $filtre = ($lastId > 0) ? $lastId : '';
            $sql= ("SELECT `messages`.`id`,
            `message`,
            `messages`.`create_at`,
            `id_users`,
            `users`.`firstname`,
            `users`.`lastname`  
            FROM `messages` 
            INNER JOIN `users` 
            ON `users`.`id` = `messages`.`id_users`
            WHERE `messages`.`id` > :lastId
            AND `users`.`id_classes` = :idClass
            ORDER BY `create_at` 
            DESC LIMIT 10;");
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':lastId', $filtre);
            $stmt->bindValue(':idClass', $id_class);
            try {
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }

        public function Add()
        {
            $sql = $this->pdo->prepare("INSERT INTO `messages`(`message`,`id_users`)
            VALUES(:message, :id_users)");
            
            $sql->bindParam(':message', $this->message);
            $sql->bindParam(':id_users', $this->id_users);
            
            try {
                $test = $sql->execute();
                return 3;
            } catch (PDOException $ex) {
                return false;
            }
        }
    }  
 