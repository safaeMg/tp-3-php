<!DOCTYPE html>
<html>
    <head>
        <title>Modifier etudiant</title>
    </head>
    <body>
	    <h1>Modification d'un Etudient :</h1>
		<?php
  require_once 'connexion.php';
  if ($_POST) {
      extract($_POST);
      $sql = "UPDATE etudiants SET nom='$nom', 
			prenom='$prenom', 
			date='$date', 
			sexe='$sexe',
			adresse='$adresse' 
			WHERE  matricule='$matricule'";

      $resultat = mysqli_query($bdd, $sql);

      if ($resultat) {
          echo "Etudiant modifier avec succés <br>";
          echo "<a href='liste_etudiant.php'>Retoure a la page d'accuiel</a>";
      } else {
          echo "<b>Erreur</b> de modification d'un etudiant";
          echo "<a href='liste_etudiant.php'>Retoure a la page d'accuiel</a>";
      }
      mysqli_close($bdd);
      unset($_GET);
  }

  if (isset($_GET['mat_modif'])) {
      $mat_modif = $_GET['mat_modif'];
      $sql = "SELECT * FROM etudiants WHERE matricule='$mat_modif'";
      $resultat = mysqli_query($bdd, $sql);

      if ($resultat == false) {
          echo "aucun etudiant avec le matricule :" . $mat_modif;
          echo "<script type='text/javascript'>alert('aucun etudiant avec le matricule demandé !!')</script>";
          echo "<br><a href='liste_etudiant.php'>Retour a la page d'accueil</a>";
      } else {

          $rows = mysqli_fetch_assoc($resultat);
          extract($rows);
          mysqli_free_result($resultat);
          mysqli_close($bdd);
          ?>
				<form action='modifier_etd.php' method='POST'>
				<table>
				
				<tr>
				<td>Matricule :</td>
				<td><input type="text" name="matricule" value="<?php echo $matricule; ?>" size="30" /></td>
				</tr>
				
				<tr>
				<td>Nom :</td>
				<td><input type="text" name="nom" value="<?php echo $nom; ?>" size="30" /></td>
				</tr>
				
				<tr>
				<td>Prénom :</td>
				<td><input type="text" name="prenom" value="<?php echo $prenom; ?>" size="30" /></td>
				</tr>
				
				<tr>
				<td>Date de naissance :</td>
				<td><input type="date" name="date" value="<?php echo $date; ?>" /></td>
				</tr>
				
				
 <tr>
 <td>Sexe:</td>
 <td>
 <select name="sexe">
 <option value='M' <?php if ($sexe == "M") {
     echo 'selected';
 } ?> >Masculin</option>
 <option value='F' <?php if ($sexe == "F") {
     echo 'selected';
 } ?> >Féminin</option>
 </select>
 </td>
 </tr>
 
				<tr>
				<td>Address :</td>
				<td><input type="text" name="adresse" value="<?php echo $adresse; ?>" size="30" /></td>
				</tr>
				
				<tr>
				<td colspan="2" align="center">
 <input type="submit"  value="Modifier" />
 <input type="reset"  value="Effacer" />
				</td>
				</tr>
				
				</table>
				</from>
				<a href="liste_etudiant.php">Retoure a la page d'accuiel</a>
			<?php
      }
  }

  if (isset($_GET['mat_sup'])) {
      $mat_sup = $_GET['mat_sup'];
      $sql = "DELETE FROM etudiants WHERE matricule='$mat_sup'";
      $resultat = mysqli_query($bdd, $sql);
      mysqli_close($bdd);
      if ($resultat) {
          header("Location:liste_etudiant.php?action=vrai&sup=$mat_sup");
      } else {
          header("Location:liste_etudiant.php?action=non&sup=$mat_sup");
      }
      mysqli_free_result($resultat);
  }
  ?>
	</body>
</html>