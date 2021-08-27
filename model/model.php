<?php    
    class BDD{

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
            $sql = $pdo->prepare("SELECT * FROM".' '.$table);
            $sql->execute();
            return $sql;
        }

        public function select($pdo, $column, $table, $addSql)
        {  
            $sql = $pdo->query("SELECT ".$column." FROM ".$table.' '.$addSql);
            return $sql;
        }
        public function addNote($pdo, $notationDate, $matter, $notationName, $notationInput, $class, $student, $teacher )
        {   
            $sql = $pdo->prepare("INSERT INTO `notation`(`date`, `matter`, `name`, `notation`, `class`, `lastname`, `teacher`) 
            VALUES(:notationDate, :matter, :notationName, :notationInput, :class, :student, :teacher)");
            $sql->bindParam(':notationDate', $notationDate);
            $sql->bindParam(':matter', $matter);
            $sql->bindParam(':notationName', $notationName);
            $sql->bindParam(':notationInput', $notationInput);
            $sql->bindParam(':class', $class);
            $sql->bindParam(':student', $student);
            $sql->bindParam(':teacher', $teacher);
            $sql->execute();
        }

        public function addUser($pdo, $mail, $password,$firstname, $lastname,$birthday, $rank, $subject)
        {
            $sql = $pdo->prepare("INSERT INTO `users`(`mail`, `password`, `firstname`, `lastname`,`birthday`,`rank`, `subject`,`changePass`) 
            VALUES(:mail, :password,:firstname, :lastname,:birthday, :rank, :subject, '1' )");
            $sql->bindParam(':mail', $mail);
            $sql->bindParam(':password', $password);
            $sql->bindParam(':firstname', $firstname);
            $sql->bindParam(':lastname', $lastname);
            $sql->bindParam(':birthday', $birthday);
            $sql->bindParam(':rank', $rank);
            $sql->bindParam(':subject', $subject);
            $sql->execute();
        }

        public function addAssignment($pdo, $hwDate, $hwName,$teacherName, $subject,$class)
        {
            $sql = $pdo->prepare("INSERT INTO `assignment`(`date`, `name`, `teacherName`, `subject`, `class`) 
            VALUES(:hwDate, :hwName, :teacherName, :subject, :class)");
            $sql->bindParam(':hwDate', $hwDate);
            $sql->bindParam(':hwName', $hwName);
            $sql->bindParam(':teacherName', $teacherName);
            $sql->bindParam(':subject', $subject);
            $sql->bindParam(':class', $class);
            $sql->execute();
        }

        public function addEvent($pdo, $eventDay,$eventMonth,$eventYear,$eventName)
        {
            $sql = $pdo->prepare("INSERT INTO events(day,month,year,message) 
            VALUES(:eventDay,:eventMonth,:eventYear,:eventName)");
            $sql->bindParam(':eventDay', $eventDay);
            $sql->bindParam(':eventMonth', $eventMonth);
            $sql->bindParam(':eventYear', $eventYear);
            $sql->bindParam(':eventName', $eventName);
            $sql->execute();
        }
        
    }