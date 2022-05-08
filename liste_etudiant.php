<?php require_once 'connexion.php'; ?>
<h1>Liste des étudiants</h1>
<table border="1">
<tr>
<th>Matricule</th>
<th>Nom</th>
<th>Prénom</th>
<th>Date de naissance</th>
<th>Sexe</th>
<th>Adresse</th>
<th>Action</th>
</tr>

<?php

$resultat = mysqli_query($bdd, 'SELECT * FROM etudiants');
while ($donnee = mysqli_fetch_assoc($resultat)) {
	extract($donnee);
		echo "<tr>";
		echo "<td>".$matricule."</td>";
		echo "<td>".$nom."</td>";
		echo "<td>".$prenom."</td>";
		echo "<td>".$date."</td>";
		if($sexe == 'M') {
			echo "<td>Masculin</td>";
		} else {
			echo "<td>Fiminin</td>";
		}
		echo "<td>".$adresse."</td>";
		echo "<td><a href='modifier_etd.php?mat_modif=$matricule'>Modifier</a>";
		echo ' / ';
		echo "<a href='modifier_etd.php?mat_sup=$matricule'>Supprimer</a>";
		echo "</td></tr>";
}

echo "</table><br>";

if (isset($_GET['action'])) {
    if ($_GET['action'] == "vrai") {
        echo "<b>NB:</b> l'etudiant ayant le matricule: <span style='color:green'>". $_GET['sup']."</span> est supprimé avec succès";
    } else {
        echo "<b>attention:</b> erreur de suppression de l'etudiant". $_GET['sup'];
    }
}

echo "<hr><pre>";
echo "<a href='Ajouter_etd.html'>Ajouter un etudiant</a>";
echo "(le nombre actuel des etudiants inscrits est: <b> ".mysqli_num_rows($resultat)."</b>)<br>";

mysqli_free_result($resultat);
mysqli_close($bdd);

?>