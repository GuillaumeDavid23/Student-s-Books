<?php
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
        public function SelectAll($lastId = "")
        {
            $filtre = ($lastId > 0) ? " WHERE `messages`.`id` > $lastId" : '';
            $sql= ("SELECT `messages`.`id`,
            `message`,
            `messages`.`create_at`,
            `id_users`,
            `users`.`firstname`,
            `users`.`lastname`  
            FROM `messages` 
            INNER JOIN `users` 
            ON `users`.`id` = `messages`.`id_users`".' '.$filtre.' '." 
            ORDER BY `create_at` 
            DESC LIMIT 10;");
            
            try {
                $stmt = $this->pdo->query($sql);
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
                return $ex;
            }
        }
    }  
 