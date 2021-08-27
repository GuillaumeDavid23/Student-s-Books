<?php
class Calendar{
        private $id;
        private $event;
        private $event_date;
        private $id_classes;
        private $id_users;
        private $pdo;


        function __construct($id = "", $event = "", $event_date = "", $id_users = "")
        {
            $this->id = $id;
            $this->event = $event;
            $this->event_date = $event_date;
            $this->id_users = $id_users;

            $this->pdo = SPDO::getInstance();
        }

        public function Add()
        {
            $sql = $this->pdo->prepare("INSERT INTO `calendar`(`event`, `event_date`, `id_users`)
            VALUES(:event, :event_date, :id_users)");
            $sql->bindParam(':event', $this->event);
            $sql->bindParam(':event_date', $this->event_date);
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
            $sql = "DELETE FROM `calendar` WHERE `id` = $this->id";
            try {
                $sql = $this->pdo->query($sql);
                return $sql;
            } catch (PDOException $ex) {
                return 11;
            }
            
        }

        public function Modify()
        {
            $sql = $this->pdo->prepare("UPDATE `calendar`
            SET `event` = :event,
                `event_date` = :event_date,
                `id_users` = :id_users
            WHERE `id` = :id;");
            $sql->bindParam(':event', $this->event);
            $sql->bindParam(':event_date', $this->event_date);
            $sql->bindParam(':id_users', $this->id_users);
            $sql->bindParam(':id', $this->id);
            
            try {
                $sql->execute();
                return 4;
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
            $sql= ("SELECT * FROM `calendar`");
            try {
                $sql = $this->pdo->query($sql);
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }
}