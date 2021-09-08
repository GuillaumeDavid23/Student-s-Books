<?php 

session_start();

unset($_SESSION['user']);

header('Location: /index.php?page=10');
exit;