<?php
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
            $sql = $this->pdo->prepare("INSERT INTO `schedule`(`day`, `id_slots`, `id_matters`, `id_rooms`)
            VALUES(:day, :id_slots, :id_matters, :id_rooms)");
            $sql->bindParam(':day', $this->day);
            $sql->bindParam(':id_slots', $this->id_slots);
            $sql->bindParam(':id_matters', $this->id_matters);
            $sql->bindParam(':id_rooms', $this->id_rooms);
            
            try {
                $test = $sql->execute();
                return 3;
            } catch (PDOException $ex) {
                return $ex;
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
        public function SelectAll()
        {
            $sql= ("SELECT `day`, `id_slots`, `id_matters`, `id_rooms` FROM `schedule`");
            try {
                $sql = $this->pdo->query($sql);
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }


}