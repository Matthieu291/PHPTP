<h1>TP7</h1>

<hr>
<h2>Exercice 1 :</h2>

<?php
class Formulaire{
    //Méthodes :
    function __construct($nomfic,$method) {
        echo "<form method='".$method."' action='".$nomfic."'>";
        echo '<br>';
    }

    function ajouterZoneTexte($name){
        echo $name." ";
        echo '<input type="text" name='.$name.'/>';
        echo '<br>';
    }

    function ajouterBouton(){
        echo '<input type="submit" value="Envoi"/>';
        echo '<br>';
    }
    function getform() {
        echo '</form>';
    }
}

final class Formulaire2 extends Formulaire {
    //Méthodes :
    final function ajouterRadio($value){
        echo '<input type="radio" value='.$value.'>'.$value.'</input>';
        echo '<br>';
    }

    final function ajouterCheckBox($value){
        echo '<input type="checkbox" value='.$value.'>'.$value.'</input>';
        echo '<br>';
    }
}

$form = new Formulaire2("formulaire.php","post");
$form->ajouterZoneTexte("Votre nom :");
$form->ajouterZoneTexte("Votre code :");
$form->ajouterBouton();
$form->ajouterRadio("Homme");
$form->ajouterRadio("Homme");
$form->ajouterCheckBox("Tennis");
$form->ajouterCheckBox("Equitation");
?>
