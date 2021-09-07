<?php
require_once(dirname(__FILE__).'/../public/utils/bdd.php');

/**
 * Explication de @param Slots
 * @param int $id
 * @param string $slot
 * @return void
 */
class Online {
        private $id;
        private $id_users_online;
        private $last_action;

        public $pdo;

        //Construction de la classe
        function __construct($id = "" , $id_users_online = "", $last_action = "")
        {
            $this->id = $id;
            $this->id_users_online = $id_users_online;
            $this->last_action = $last_action;
            
            $this->pdo = SPDO::getInstance();
        }

        public function Add()
        {   
            $res = $this::checkDuplicate($this->id_users_online);
            if($res === false){
                $sql = $this->pdo->prepare("INSERT INTO `online`(`id_users_online`, `last_action`)
                VALUES(:id_users_online, :last_action)");
                $sql->bindParam(':id_users_online', $this->id_users_online);
                $sql->bindParam(':last_action', $this->last_action);
                
                try {
                    $test = $sql->execute();
                    return 3;
                } catch (PDOException $ex) {
                    return $ex;
                }
            }
        }

        /**
         * Supprime une entrée dans la Base
         * @param string $table Table sélectionnée
         * @param string $addSql Paramètre supplémentaire SQL
         */
        public function Delete()
        {   
            $sql = "DELETE FROM `online` WHERE `id_users_online` = $this->id_users_online";
            try {
                $sql = $this->pdo->query($sql);
                return $sql;
            } catch (PDOException $ex) {
                return 11;
            }
            
        }

        /**
         * Test si le mail est déjà dans la Base SQL
         * @param string $mail Mail à tester
         * @return string|false Retourne le mail doublon ou False
         */
        public static function checkDuplicate($id_users_online)
        {
            $pdo = SPDO::getInstance();
            $sql = "SELECT `id_users_online` FROM `online` WHERE `id_users_online` = :id_users_online";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id_users_online', $id_users_online);
            try {
                $stmt->execute();
                $result = $stmt->fetchColumn();
                return $result;
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
        public static function SelectAll()
        {
            $pdo = SPDO::getInstance();
            $sql= ("SELECT COUNT(*) AS nb FROM `online` INNER JOIN users ON users.id = online.id_users_online;");
            
            try {
                $stmt = $pdo->query($sql);
                $result = $stmt->fetch();
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }

        public static function checkOffline($timestamp)
        {
            $pdo = SPDO::getInstance();
            $sql= ("DELETE FROM `online` WHERE last_action < :timestamp");
            
            try {
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':timestamp', $timestamp);
                $result = $stmt->execute();
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }
        /**
         * Sélection de colonne dans une ou plusieurs table.
         * @param string $column Colonnes choisies
         * @param string $table Tables choisies
         * @param string $addSql Paramètres SQL (optionnel)
         * @return object|int(11) Retourne un tableau associatif ou False
         */
        public function SelectOne()
        {
            $sql= ("SELECT id_users_online FROM `online` WHERE `id` = $this->id");
            try {
                $sql = $this->pdo->query($sql);
                $result = $sql->fetch(PDO::FETCH_OBJ);
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }
    }  
 