<?php
require_once 'include/database.php';
//we use $_GET because we're getting the id from the URL not the form
$id = $_GET['id'];
$sqlState = $pdo->prepare("DELETE FROM categorie WHERE id=?");
$supprimer = $sqlState->execute([$id]);
if($supprimer){
  header('Location: categories.php');
}else{
    echo "Database erreur";
}