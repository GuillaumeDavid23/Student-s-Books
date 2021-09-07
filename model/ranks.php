<?php
require_once(dirname(__FILE__).'/../public/utils/bdd.php');
/**
 * Explication de @param Slots
 * @param int $id
 * @param string $slot
 * @return void
 */
class Rank {
        private $id;
        private $rank;

        public $pdo;

        //Construction de la classe
        function __construct($id = "" ,$rank = "")
        {
            $this->id = $id;
            $this->rank = $rank;
            
            $this->pdo = SPDO::getInstance();
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
            $sql= ("SELECT * FROM `ranks`;");
            
            try {
                $stmt = $this->pdo->query($sql);
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
            
            $sql= ("SELECT `rank` FROM `ranks` WHERE `id` = :id");
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
 