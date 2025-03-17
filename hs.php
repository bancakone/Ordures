<?php 
$mot = "Admin";
$motHache = password_hash($mot, PASSWORD_DEFAULT);
echo "Mot haché : " . $motHache;

?>