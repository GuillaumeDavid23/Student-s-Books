<?php
require_once(dirname(__FILE__).'/../public/utils/bdd.php');
/**
 * Explication de @param Slots
 * @param int $id
 * @param string $slot
 * @return void
 */
class ClassSchedule {
        private $id_class;
        private $id_schedule;

        public $pdo;

        //Construction de la classe
        function __construct($id_class = "" ,$id_schedule = "")
        {
            $this->id_class = $id_class;
            $this->id_schedule = $id_schedule;
            
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

            $sql = "SELECT * FROM `classes_schedule`";
            try {
                $stmt = $pdo->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            
            $sql= ("SELECT * FROM `classes_schedule` WHERE `id_class` = :id");
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
            $sql = $this->pdo->prepare("INSERT INTO `classes_schedule`(`id_class`, `id_schedule`)
            VALUES(:id_class, :id_schedule)");
            $sql->bindParam(':id_class', $this->id_class);
            $sql->bindParam(':id_schedule', $this->id_schedule);
            
            try {
                $test = $sql->execute();
                return 16;
            } catch (PDOException $ex) {
                return $ex;
            }
        }
    }  
 