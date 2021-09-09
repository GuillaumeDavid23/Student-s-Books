<?php
require_once(dirname(__FILE__).'/../public/utils/bdd.php');

/**
 * Explication de @param Slots
 * @param int $id
 * @param string $slot
 * @return void
 */
class Absence {
        private $id;
        private $start_date;
        private $end_date;
        private $start_hour;
        private $end_hour;
        private $justification;
        private $id_users;

        public $pdo;

        //Construction de la classe
        function __construct($id = "" ,$start_date = "",$end_date = "",$start_hour = "",$end_hour = "",$justification = "",$id_users = "")
        {
            $this->id = $id;
            $this->start_date = $start_date;
            $this->end_date = $end_date;
            $this->start_hour = $start_hour;
            $this->end_hour = $end_hour;
            $this->justification = $justification;
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
        public static function SelectAll()
        {
            $pdo = SPDO::getInstance();

            $sql= ("SELECT `start_date`,
            `end_date`,
            `start_hour`,
            `end_hour`,
            `justification`,
            `id_users` 
            FROM `absences`;");
            
            try {
                $stmt = $pdo->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
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
         * @return object|11 Retourne un objet ou code 11
         */
        public static function SelectOne($id)
        {   
            $pdo = SPDO::getInstance();
            
            $sql= ("SELECT `start_date`, `end_date`, `start_hour`, `end_hour`, `justification`, `id_users` FROM `absences` WHERE `id` = :id");
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
        public function Add()
        {
            $sql = $this->pdo->prepare("INSERT INTO `absences`(`start_date`, `end_date`, `start_hour`, `end_hour`, `justification`, `id_users`)
            VALUES(:start_date, :end_date, :start_hour, :end_hour, :justification, :id_users)");

            $sql->bindParam(':start_date', $this->start_date);
            $sql->bindParam(':end_date', $this->end_date);
            $sql->bindParam(':start_hour', $this->start_hour);
            $sql->bindParam(':end_hour', $this->end_hour);
            $sql->bindParam(':justification', $this->justification);
            $sql->bindParam(':id_users', $this->id_users);
            
            try {
                $sql->execute();
                return 3;
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
            $sql = "DELETE FROM `absences` WHERE `id` = $this->id";
            try {
                $sql = $this->pdo->query($sql);
                return $sql;
            } catch (PDOException $ex) {
                return 11;
            }
            
        }

        public function Modify()
        {
            $sql = $this->pdo->prepare("UPDATE `absences`
            SET `start_date` = :start_date,
                `end_date` = :end_date,
                `start_hour` = :start_hour,
                `end_hour` = :end_hour,
                `justification` = :justification,
                `id_users` = :id_users
            WHERE `id` = :id;");
            $sql->bindParam(':start_date', $this->start_date);
            $sql->bindParam(':end_date', $this->end_date);
            $sql->bindParam(':start_hour', $this->start_hour);
            $sql->bindParam(':end_hour', $this->end_hour);
            $sql->bindParam(':justification', $this->justification);
            $sql->bindParam(':id_users', $this->id_users);
            $sql->bindParam(':id', $this->id);
            
            try {
                $sql->execute();
                return 4;
            } catch (PDOException $ex) {
                return 11;
            }
        }
    }  
 