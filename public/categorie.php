<?php
/*
=========================================================================
Web 4 : Expressif (Logique) - Devoir 1
-------------------------------------------------------------------------
Votre nom :
-------------------------------------------------------------------------
Cette page affiche la liste des recettes en fonction de la catégorie fournie dans l'adresse
- Inclure le fichier de la class Recette
- Inclure le fichier donnees.inc.php contenant les données des recettes (crée la variable $donnees)
- Commencer par le fichier Recettes.php

- Cette page s'attend à recevoir de l'adresse la donnée "nomCategorie". Il faut donc récupérer cette donnée.
- S'il manque la catégorie dans l'adresse, on DOIT retourner à la page index.php
- Si la catégorie ne se trouve pas dans la variable $donnees, on DOIT retourner à la page index.php
=========================================================================
*/
include_once("../src/Recette.php");
include_once("../src/donnees.inc.php");
if (!isset($_GET['nomCategorie'])) {
	header("location:index.php");
	exit;
}
$nomCategorie = $_GET['nomCategorie'];
if (!isset($donnees[$nomCategorie])) {
	header("location:index.php");
	exit;
}
$categorie = $donnees[$nomCategorie];
?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="css/recettes.css" />
	<!-- /* Afficher le nom de la catégorie dans le title */ -->
	<title><?php echo $nomCategorie; ?></title>
</head>

<body>
	<div class="interface">
		<!-- /* Inclure l'entête ici */ -->
		<?php include("../components/header.php") ?>
		<!-- /* Faire afficher le fil d'Ariane ici */ -->
        <?php echo Recette::ariane($nomCategorie); ?>
		<section class="body">
			<!-- /* Faire afficher l'article ici */ -->
			<?php echo Recette::articleCategorie($nomCategorie, $donnees[$nomCategorie]) ?>
		</section>
		<!-- /* Inclure le pied de page ici */ -->
		<?php include("../components/footer.php") ?>
	</div>
</body>

</html>
