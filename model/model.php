<?php    
    class BDD{
        private $host = 'localhost';
        private $dbname = 'studentbook';
        private $username = 'root';
        private $password = ''; 

        public function bddConnect()
        {
            // récupérer tous les utilisateurs
            $sql = "SELECT * FROM users";
            
            //CONNEXION A LA BDD
            try{
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $stmt = $pdo->query($sql);
            
                if($stmt === false){
                    die("Erreur");
                }
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
            return $stmt;
        }
        
    }