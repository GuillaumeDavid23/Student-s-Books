<?php
function ShowTimeSelect()
{
    $hours = [];
    $minutes = [];

    for ($i=8; $i <= 20; $i++) { //Heures
        if($i < 10){
            $zero = "0".$i;
            array_push($hours, $zero);
        }else{
            array_push($hours, $i);
        }
    }
    for ($i=0; $i < 60; $i+=10) { //Minutes
        if($i < 10){
        $zero = "0".$i;
        array_push($minutes, $zero);
        }else{
        array_push($minutes, $i);
        }
    }

    //SHOW MINUTES
    echo "<div id='time' class='text-center'>";
        echo "<select name='hours'>";
            echo "<option>HH</option>";
            foreach ($hours as $key => $value) {
                echo "<option value='$value'>$value</option>";
            }
        echo "</select>";

        echo " : ";
        //SHOW HOURS
        echo "<select name='minutes'>";
            echo "<option>MM</option>";
            foreach ($minutes as $key => $value) {
                echo "<option value='$value'>$value</option>";
            }
        echo "</select>";
    echo "</div>";
}

//TRAITEMENT
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $hour = filter_input(INPUT_POST,'hours', FILTER_SANITIZE_NUMBER_INT);
  $minute = filter_input(INPUT_POST,'minutes', FILTER_SANITIZE_NUMBER_INT);
  $time = $hour.':'.$minute;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../public/css/bootstrap/bootstrap.css">
  <title>test</title>
</head>
<body>
  <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="">
    <?= ShowTimeSelect() ?>
    <button type="submit">Envoie</button>
  </form>
  
</body>
</html>