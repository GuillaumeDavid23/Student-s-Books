<?php
//VERIF DE QUI DESATIVE
require_once(dirname(__FILE__).'/../../model/user.php');

$id = trim(strip_tags(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
$code = User::Desactivate($id);

unset($_SESSION['user']);

header('Location: /index.php?page=15&code='.$code);
exit;