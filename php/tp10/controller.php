<?php

$dbn = 'pgsql:dbname=etudiant;host=127.0.0.1;port=5432';
$us = 'postgres';
$pw = 'Isen2018';
try{
    $db = new PDO($dbn, $us, $pw);
}
catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}


if (isset($_GET['func'])){
    if($_GET['func'] == 'readLogin') {
        authentification($db);
    }
    if($_GET['func'] == 'inscrire') {
        inscrire($db);
    }
    if($_GET['func'] == 'newStudent') {
        newStudent($db);
    }
    if($_GET['func'] == 'editetudiant') {
        editetudiant($db);
    }

}

function authentification($db){
    if (isset($_POST['email']) && $_POST['password']){
        $req = $db->prepare('select * from utilisateur where mail=?');
        $req->execute(array($_POST['email']));
        $isconnected = false;
        $data = $req->fetch();
        while ($req->fetch() != 0 && !$isconnected) {
            if (password_verify($_POST['password'], $data['password'])) {
                $isconnected = true;
                session_start();
                $_SESSION['nom'] = $req->fetch(['nom']);
                $_SESSION['prenom'] = $req->fetch(['prenom']);
                $_SESSION['id'] = $req->fetch(['id']);
            }
        }
    }
    if ($isconnected) {
        header ('Location: viewadmin.php');
    }
    else {
        echo '<br><section id="errors" class="container alert alert-danger">Email ou mot de passe incorrect.</section>';
    }
}
function inscrire ($db) {
    if (isset($_POST['login']) && $_POST['email'] && $_POST['password']&& isset($_POST['passwordrepeat'])  && isset($_POST['name']) && isset($_POST['firstname'])) {
        if($_POST['password'] == $_POST['passwordrepeat']){
            $id = $db->query ("select count(*) as number from utilisateur")->fetch()['number'] +1;
            $password =password_hash ($_POST['password'], PASSWORD_DEFAULT);
            $new = $db->prepare('insert into utilisateur(id,login,password,mail,nom,prenom) values (?,?,?,?,?,?)');
            $new->execute(array($id,$_POST['login'],$_POST['password'],$_POST['email'],$_POST['name'],$_POST['firstname']));
            header ("Location: index.php");
        }
        else{
            echo"Ce ne sont pas les mêmes mots de passe";
        }
    }
}

function displayList($db){
    $recup = $db->prepare('select * from student where user_id=?');
    $recup->execute(array($_SESSION['id']));

    echo '<table class="table">';
    echo '<thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Moyenne</th>
                </tr>
            </thead>';

    while(($data = $recup->fetch())!=0){
        echo '<tr>',
            '<td>'.$data['id'].'</td>',
            '<td>'.$data['nom'].'</td>',
            '<td>'.$data['prenom'].'</td>',
            '<td>'.$data['note'].'</td>',
        '<td><form method="post" action="vieweditetudiant.php"><button type="submit" class="btn btn-warning">Editer</button></form></td>',
        '<td><form method="post" action="controller.php?func=deleteEtudiant"><button type="submit" class="btn btn-danger">Supprimer</button></form></td>',
        '</tr>';
    }

    echo '</table>';
}

function newStudent ($db)
{
    session_start();
    if (isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['moyenne'])) {
        $id = $db->query ("select count(*) as number from student")->fetch()['nb'] +1;
        $new = $db->prepare('insert into etudiant(id,user_id,nom,prenom,note) values (?,?,?,?,?)');
        $new->execute(array($id,$_SESSION['id'],$_POST['name'],$_POST['firstname'],(int)$_POST['moyenne']));
        header ('Location: viewadmin.php');
    }
    else{
        echo"Il manque des valeurs";
    }
}

function editetudiant($db) {

}
