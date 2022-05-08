<?php
require_once 'connexion.php';
echo "<h1>Ajout d'un Etudiant</h1>";
if ($_POST) {
    extract($_POST);
    $sql = "INSERT INTO etudiants VALUES('$matricule','$nom','$prenom','$date','$sexe','$adresse')";
    $resultat = mysqli_query($bdd, $sql);
    if ($resultat) {
        echo "L'etudiant<span style='color=green'>$nom $prenom </span>est enregistré avec succés .<br>";
        echo "<a href='liste_etudiant.php'>Retoure a la page d'accueil</a>";
    } else {
        echo "erreur d'enregistrement de l'etudiant <span style='color:green'>$nom $prenom</span><br>";
        echo "<a href='liste_etudiant.php'>retoure a la page d'accueil</a>";
    }
    mysqli_close($bdd);
}
?>
