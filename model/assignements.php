<?php
require_once(dirname(__FILE__).'/../public/utils/bdd.php');

class Assign{
        private $id;
        private $end_date;
        private $assignement;
        private $returnAssign;
        private $id_classes;
        private $id_users;
        private $pdo;


        function __construct($id = "", $end_date = "", $assignement = "", $returnAssign = "",$id_classes = "", $id_users = "")
        {
            $this->id = $id;
            $this->end_date = $end_date;
            $this->assignement = $assignement;
            $this->returnAssign = $returnAssign;
            $this->id_classes = $id_classes;
            $this->id_users = $id_users;

            $this->pdo = SPDO::getInstance();
        }

        public function Add()
        {
            $sql = $this->pdo->prepare("INSERT INTO `assignements`(`end_date`, `assignement`,`returnAssign` ,`id_classes`, `id_users`)
            VALUES(:end_date, :assignement, :returnAssign,:id_classes, :id_users)");
            $sql->bindParam(':end_date', $this->end_date);
            $sql->bindParam(':assignement', $this->assignement);
            $sql->bindParam(':returnAssign', $this->returnAssign);
            $sql->bindParam(':id_classes', $this->id_classes);
            $sql->bindParam(':id_users', $this->id_users);
            
            try {
                $sql->execute();
                return 18;
            } catch (PDOException $ex) {
                return 11;
            }
        }

        /**
         * Supprime une entrée dans la Base
         * @param string $table Table sélectionnée
         * @param string $addSql Paramètre supplémentaire SQL
         */
        public static function Delete($id)
        {   
            $pdo = SPDO::getInstance();

            $sql = "DELETE FROM `assignements` WHERE `id` = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            try {
                $stmt->execute();
                return 19;
            } catch (PDOException $ex) {
                return 11;
            }
            
        }

        public function Modify()
        {
            $stmt = $this->pdo->prepare("UPDATE `assignements`
            SET `end_date` = :end_date,
                `assignement` = :assignement,
                `id_classes` = :id_classes,
                `returnAssign` = :returnAssign
            WHERE `id` = :id;");
            $stmt->bindParam(':end_date', $this->end_date);
            $stmt->bindParam(':assignement', $this->assignement);
            $stmt->bindParam(':id_classes', $this->id_classes);
            $stmt->bindParam(':returnAssign', $this->returnAssign);
            $stmt->bindParam(':id', $this->id);
            
            try {
                $stmt->execute();
                if($stmt->rowCount() == 0){
                    return 22;
                }else{
                    return 21;
                }
            } catch (PDOException $ex) {
                return $ex;
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

            $sql= ("SELECT * FROM `assignements`");
            try {
                $sql = $pdo->query($sql);
                $result = $sql->fetchAll(PDO::FETCH_OBJ);
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }

        public static function SelectAllByTeacher($id)
        {
            $pdo = SPDO::getInstance();

            $sql= ("SELECT * FROM `assignements` WHERE `id_users`= :id");
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            try {
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }
        public static function SelectAllByClass($id)
        {
            $pdo = SPDO::getInstance();

            $sql= ("SELECT * FROM `assignements` WHERE `id_classes`= :id");
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            try {
                $stmt->execute();
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
         * @return Object|false Retourne un tableau associatif ou False
         */
        public static function SelectOne($id)
        {   
            $pdo = SPDO::getInstance();
            
            $sql= ("SELECT * FROM `assignements` WHERE `id` = :id");
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
}