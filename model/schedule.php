<?php
require_once(dirname(__FILE__).'/../public/utils/bdd.php');

class Schedule{
        private $id;
        private $day;
        private $id_slots;
        private $id_matters;
        private $id_rooms;
        private $pdo;


        function __construct($id = "", $day = "", $id_slots = "", $id_matters = "", $id_rooms = "")
        {
            $this->id = $id;
            $this->day = $day;
            $this->id_slots = $id_slots;
            $this->id_matters = $id_matters;
            $this->id_rooms = $id_rooms;

            $this->pdo = SPDO::getInstance();
        }

        public function Add()
        {   
            $sql = 'INSERT INTO `schedule`(`day`, `id_slots`, `id_matters`, `id_rooms`)
            VALUES(:day, :id_slots, :id_matters, :id_rooms)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':day', $this->day);
            $stmt->bindParam(':id_slots', $this->id_slots);
            $stmt->bindParam(':id_matters', $this->id_matters);
            $stmt->bindParam(':id_rooms', $this->id_rooms);
            try {
                $test = $stmt->execute();
                return 16;
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
            $sql = "DELETE FROM `schedule` WHERE `id` = $this->id";
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
        public static function SelectAll()
        {
            $pdo = SPDO::getInstance();

            $sql= ("SELECT `day`, `id_slots`, `id_matters`, `id_rooms`, `id_class` FROM `schedule` INNER JOIN `classes_schedule` ON `schedule`.id = `classes_schedule`.id_schedule");
            try {
                $sql = $pdo->query($sql);
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
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
        public static function getLastId()
        {
            $pdo = SPDO::getInstance();
           
            try {
                return $pdo->lastInsertId();
            } catch (PDOException $ex) {
                return 11;
            }
        }


}