<?php
class Mark{
        private $id;
        private $date;
        private $note;
        private $notation;
        private $id_users;
        private $id_teacher;
        private $pdo;


        function __construct($id = "", $date = "", $note = "", $notation = "", $id_users = "", $id_teacher = "")
        {
            $this->id = $id;
            $this->date = $date;
            $this->note = $note;
            $this->notation = $notation;
            $this->id_teacher = $id_teacher;
            $this->id_users = $id_users;

            $this->pdo = SPDO::getInstance();
        }

        public function Add()
        {
            $sql = $this->pdo->prepare("INSERT INTO `marks`(`date`, `note`, `notation`, `id_users`, `id_users_teacher_marks`)
            VALUES(:date, :note, :notation, :id_users, :id_teacher)");
            $sql->bindParam(':date', $this->date);
            $sql->bindParam(':note', $this->note);
            $sql->bindParam(':notation', $this->notation);
            $sql->bindParam(':id_users', $this->id_users);
            $sql->bindParam(':id_teacher', $this->id_teacher);
            
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
            $sql = "DELETE FROM `marks` WHERE `id` = $this->id";
            try {
                $sql = $this->pdo->query($sql);
                return $sql;
            } catch (PDOException $ex) {
                return 11;
            }
            
        }

        public function Modify()
        {
            $sql = $this->pdo->prepare("UPDATE `assignements`
            SET `end_date` = :end_date,
                `assignement` = :assignement,
                `id_classes` = :id_classes,
                `id_users` = :id_users
            WHERE `id` = :id;");
            $sql->bindParam(':end_date', $this->end_date);
            $sql->bindParam(':assignement', $this->assignement);
            $sql->bindParam(':id_classes', $this->id_classes);
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
            $sql= ("SELECT date, note, notation, id_users, id_users_teacher_marks FROM `marks`");
            try {
                $sql = $this->pdo->query($sql);
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
        public function SelectOne()
        {
            $sql= ("SELECT * 
                    FROM appointments 
                    INNER JOIN `patients` 
                    ON `appointments`.`idPatients` = `patients`.`id` 
                    WHERE `appointments`.`idPatients` = $this->idPatient
                    AND `appointments`.`id` = $this->idAssign");
            try {
                $sql = $this->pdo->query($sql);
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
        public function SelectAssoc()
        {
            $sql= ("SELECT * 
                    FROM appointments 
                    INNER JOIN `patients` 
                    ON `appointments`.`idPatients` = `patients`.`id` 
                    WHERE idPatients =".' '.$this->idPatient);
            try {
                $stmt = $this->pdo->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $ex) {
                return 11;
            }
        }

        public function Show()
        {
             // On détermine sur quelle page on se trouve
            if(isset($_GET['page']) && !empty($_GET['page'])){
                $currentPage = (int) strip_tags($_GET['page']);
            }else{
                $currentPage = 1;
            }
            // On détermine le nombre d'articles par page
            $parPage = 4;
            // Calcul du 1er article de la page
            $premier = ($currentPage * $parPage) - $parPage;

            $sql = $this->pdo->prepare(
                "SELECT `appointments`.id, `appointments`.`dateHour`, `patients`.`lastname`, `patients`.`firstname`, `patients`.`id` AS 'idPatients' 
                FROM appointments 
                INNER JOIN `patients` 
                ON `appointments`.`idPatients` = `patients`.`id` 
                LIMIT :premier, :parpage;");
            $sql->bindValue(':premier', $premier, PDO::PARAM_INT);
            $sql->bindValue(':parpage', $parPage, PDO::PARAM_INT);
            // On exécute
            try {
                $sql->execute();
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $ex) {
                return 11;
            } 
        }

        public function count($addSql = "")
            {
                $sql = $this->pdo->query("SELECT COUNT(*) AS nb FROM appointments INNER JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id`");

                // On récupère le nombre d'articles
                
                try {
                    $result = $sql->fetch();
                    return $result;
                } catch (PDOException $ex) {
                    return 11;
                }
                
            }
}