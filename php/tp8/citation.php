<html>
<?php
include "connexpdo.php";
echo"

    <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\"
    rel=\"stylesheet\">   
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\" integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\" crossorigin=\"anonymous\">
    <container class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col\">
                <nav class=\"navbar navbar-expand-lg navbar-light bg-light mb-5\">
                    <a class=\"navbar-brand\" href=\"citation.php\">Informations</a>
                    <a class=\"navbar-brand\" href=\"recherche.php\">Recherche</a>
                    <a class=\"navbar-brand\" href=\"modification.php\">Modification</a>
                    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                        <span class=\"navbar-toggler-icon\"></span>
                    </button>
                </nav>
            </div>
        </div>";

$dbn = 'pgsql:dbname=citations;host=127.0.0.1;port=5432';
$us = 'postgres';
$pw = 'Isen2018';
$db = connexpdo($dbn,$us,$pw);
$q = $db->query("select count (*) from citation");

echo "<h1>La Citation du jour</h1><br>";
$nbre = $q->fetch();
echo"<p>Il y a <b>.$nbre[0]</b> citations repertoriées</p><br>";
echo"<p>En voici l'une d'elle générée aléatoirement :</p><br>";
$id = rand(1,$nbre[0]);
$q=$db->query("select phrase, auteurid, siecleid from citation where id =$id");
$cit = $q->fetch();
echo"<b>".$cit["phrase"]."</b><br>";
$auteur = $cit["auteurid"];
$siecle = $cit["siecleid"];
$q=$db->query("select * from auteur where id = $auteur");
$q1= $db->query("select numero from siecle where id=$siecle");
$infaut = $q->fetch();
$nom = $infaut["nom"];
$prenom =$infaut["prenom"];
$s = $q1->fetch();
$siecle1 =$s["numero"];
echo "$nom $prenom ($siecle1 ème siecle)";
?>
</html>
