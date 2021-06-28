<?php    
    class BDD{
        private $host = 'localhost';
        private $dbname = 'studentbook';
        private $username = 'root';
        private $password = ''; 

        public function bddConnect()
        {
            $host = 'localhost';
            $dbname = 'studentbook';
            $username = 'root';
            $password = '';

            //CONNEXION A LA BDD
            try{
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
            return $pdo;
        }
        
    }