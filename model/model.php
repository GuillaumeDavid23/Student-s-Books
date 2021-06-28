<?php
    function bddConnect()
    {
        $host = 'localhost';
        $dbname = 'studentbook';
        $username = 'root';
        $password = ''; 
        $connect = "mysql:host=$host;dbname=$dbname"; 

        // récupérer tous les utilisateurs
        $sql = "SELECT * FROM users";
        
        //CONNEXION A LA BDD
        try{
            $pdo = new PDO($connect, $username, $password);
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
