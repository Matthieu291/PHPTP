<html>
<?php
include "connexpdo.php";
echo"<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\" integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\"></script>
    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\" integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\" crossorigin=\"anonymous\"></script>
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
        </div>
        <h1>Rechercher une citation</h1>
        <form method='post'>
            <div class='form-group'>
                <label>Auteur</label>
                <select class='form-control' name = 'author'>";
    $dbn = 'pgsql:dbname=citations;host=127.0.0.1;port=5432';
$us = 'postgres';
$pw = 'Isen2018';
$db = connexpdo($dbn,$us,$pw);
$q = $db->query("select count (*) from auteur");
$n0 = $q->fetch();
$nbre = $n0[0];
$increment = 0;
while ($increment <$nbre){
    $q= $db->query("select nom from auteur where id =$increment");
    $aut =$q->fetch();
    $nom =$aut["nom"];
    echo "<option>\"$nom\"</option>";
    $increment --;
}
echo"</select>
            </div>
            <div class='form-group'>
                <label>Siècle</label>
                <select class='form-control' name = 'siecle'>";
$q = $db->query("select count (*) from siecle");
$n0 = $q->fetch();
$nbre = $n0[0];
$increment = 2;
while ($increment <=$nbre+1){
    $q= $db->query("select numero from siecle where id =$increment");
    $aut =$q->fetch();
    $nom =$aut["numero"];
    echo "<option value=\"$increment\">\"$nom\"</option>";
    $increment ++;
}
echo"</select>
  </div>
  <button type='submit' name = 'search' class='btn btn-primary'>Rechercher</button>
</form>";

if (isset($_POST['search'])){
    $idauthsearched = $_POST ['author'];
    $idsieclesearched = $_POST['siecle'];
    $q = $db->query("select phrase, auteurid, siecleid from citation where auteurid =$idauthsearched and siecleid=$idsieclesearched");
    $result = $q->fetch();
    if ($result['phrase'][0] == NULL) {
        echo ("Il n'y a pas de citations correspondantes");
    }
    else {
        echo ("<table class=\"table\">
  <thead>
    <tr>
      <th scope=\"col\">Citation</th>
      <th scope=\"col\">Auteur</th>
      <th scope=\"col\">Siecle</th>
    </tr>
  </thead>
  <tbody>");
        $i = 0;
        while ($result['phrase'][$i] != NULL){
            $p = $result['phrase'][$i];
            $p1 = $result['auteurid'][$i];
            $p2 = $result['siecleid'][$i];
            echo("<tr>
      <th scope=\"row\">1</th>
     
      <td>$p</td>
      <td>$p1</td>
      <td>$p2</td>
    </tr>");
            $i++;
        }
    }
}
?>
</html>
