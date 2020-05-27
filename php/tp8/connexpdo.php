<?php

function connexpdo ($base, $user, $password) {
   try{
       $db = new PDO($base, $user, $password);
   }
   catch (PDOException $e) {
       echo 'Connexion échouée : ' . $e->getMessage();
   }
   return $db;
}
?>