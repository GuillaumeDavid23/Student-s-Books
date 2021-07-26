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
        public function selectAll($pdo, $table)
        {
            $sql = "SELECT * FROM notation";
            $request = $pdo->query($sql);
            return $request;
        }

        public function addNote($pdo, $notationDate, $matter, $notationName, $notationInput, $class, $student, $teacher )
        {
            $sql = "INSERT INTO `notation`(`date`, `matter`, `name`, `notation`, `class`, `lastname`, `teacher`) 
            VALUES('$notationDate', '$matter', '$notationName', '$notationInput', '$class', '$student', '$teacher')";
            $pdo->query($sql);
        }

        public function addUser($pdo, $mail, $password,$firstname, $lastname,$birthday, $rank, $subject)
        {
            $sql = "INSERT INTO `users`(`mail`, `password`, `firstname`, `lastname`,`birthday`,`rank`, `subject`,`changePass`) 
            VALUES('$mail', '$password','$firstname', '$lastname','$birthday', '$rank', '$subject', '1' )";
            $pdo->query($sql);
        }

        public function addAssignment($pdo, $hwDate, $hwName,$teacherName, $subject,$class)
        {
            $sql = "INSERT INTO `assignment`(`date`, `name`, `teacherName`, `subject`, `class`) 
            VALUES('$hwDate', '$hwName', '$teacherName', '$subject', '$class')";
            $pdo->query($sql);
        }

        public function addEvent($pdo, $eventDay,$eventMonth,$eventYear,$eventName)
        {
            $sql = "INSERT INTO events(day,month,year,message) 
            VALUES($eventDay,'$eventMonth',$eventYear,'$eventName')";
            $pdo->exec($sql);
        }
        
    }