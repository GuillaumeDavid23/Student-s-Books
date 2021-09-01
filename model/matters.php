<?php
/**
 * Explication de @param Slots
 * @param int $id
 * @param string $slot
 * @return void
 */
class Matter {
        private $id;
        private $matter;

        public $pdo;

        //Construction de la classe
        function __construct($id = "" ,$matter = "")
        {
            $this->id = $id;
            $this->matter = $matter;
            
            $this->pdo = SPDO::getInstance();
        }
        
        /**
         * Sélection de colonne dans une ou plusieurs table.
         * @param string $column Colonnes choisies
         * @param string $table Tables choisies
         * @param string $addSql Paramètres SQL (optionnel)
         * @return array|false Retourne un tableau associatif ou False
         */
        public function SelectAll($table = 'matters')
        {
            $sql= ("SELECT * FROM `matters`;");
            
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
         * @return object|int(11) Retourne un tableau associatif ou False
         */
        public function SelectOne()
        {
            $sql= ("SELECT matter FROM `matters` WHERE `id` = $this->id");
            try {
                $sql = $this->pdo->query($sql);
                $result = $sql->fetch(PDO::FETCH_OBJ);
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }
    }  
 