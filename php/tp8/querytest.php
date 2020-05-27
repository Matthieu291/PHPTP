<html>
<?php
include ("connexpdo.php");

$dbn = 'pgsql:dbname=citations;host=127.0.0.1;port=5432';
$us = 'postgres';
$pw = 'Isen2018';
 $db = connexpdo($dbn,$us,$pw);
$q = $db->query("select * from auteur");

echo("<h2>Auteur de la BD</h2>");
while ($donnee = $q->fetch()){
    echo"<tr><td>".$donnee["prenom"]."</td><td>".$donnee["nom"]."</td></tr><br>";
}

$q= $db->query("select * from citation");
echo("<h2>Citation de la BD</h2>");
while($d1 = $q->fetch()){
    echo"<tr><td>".$d1["phrase"] ."</td></tr><br>";
}

$q= $db->query("select * from siecle");
echo("<h2>Siècle de la BD</h2>");
while($d2 = $q->fetch()){
    echo"<tr><td>".$d2["numero"] ."</td></tr><br>";
}
?>
</html>


