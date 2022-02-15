<?php
/*
=========================================================================
Web 4 : Expressif (Logique) - Devoir 1
-------------------------------------------------------------------------
Votre nom :
-------------------------------------------------------------------------
Cette page affiche la liste des recettes disponibles sur le site
- Inclure le fichier de la class Recette
- Inclure le fichier donnees.inc.php contenant les données des recettes (crée la variable $donnees)
- Commencer par le fichier Recette.class.php
=========================================================================
*/
include_once("../src/Recette.class.php");
include_once("../src/donnees.inc.php");
?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="css/recettes.css" />
	<title>Liste des recettes</title>
</head>

<body>
	<div class="interface">
		<!-- /* Inclure l'entête ici */ -->
		<?php include("../components/header.php"); ?>
		<!-- /* Faire afficher le fil d'Ariane ici */ -->
        <?php echo Recette::ariane(); ?>
		<section class="body">
			<!-- /* Faire afficher l'article ici */ -->
			<?php echo Recette::articleIndex($donnees); ?>
		</section>
		<!-- /* Inclure le pied de page ici */ -->
		<?php include("../components/footer.php"); ?>
	</div>
</body>

</html>
