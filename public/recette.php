<?php
/*
=========================================================================
Web 4 : Expressif (Logique) - Devoir 1
-------------------------------------------------------------------------
Votre nom :
-------------------------------------------------------------------------
Cette page affiche une recette en fonction de la catégorie et du id fournis dans l'adresse
- Inclure le fichier de la class Recette
- Inclure le fichier donnees.inc.php contenant les données des recettes (crée la variable $donnees)
- Commencer par le fichier Recette.class.php

- Cette page s'attend à recevoir de l'adresse les données "nomCategorie" et "idRecette". Il faut donc récupérer ces données.
- S'il manque une de ces deux données dans l'adresse, on DOIT retourner à la page index.php
- Récupérer la recette correspondante
- Si la recette ne se trouve pas dans la variable $donnees, on DOIT retourner à la page index.php
=========================================================================
*/
include_once("../src/Recette.class.php");
include_once("../src/donnees.inc.php");
if (!isset($_GET['nomCategorie'])) {
	header("location:index.php");
	exit;
}
$nomCategorie = $_GET['nomCategorie'];
if (!isset($_GET['idRecette'])) {
	header("location:index.php");
	exit;
}
$idRecette = $_GET['idRecette'];
$recette = Recette::trouverRecette($donnees, $nomCategorie, $idRecette);
if (!$recette) {
	header("location:index.php");
//	header("categorie.php?nomCategorie=$nomCategorie");
	exit;
}
?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="css/recettes.css" />
	<!-- /* Faire afficher le titre de la recette ici (dans un title); */ -->
	<title><?php echo $recette['titre'] ?></title>
</head>

<body>
	<div class="interface">
		<!-- /* Inclure l'entête ici */ -->
		<?php include("../components/header.php") ?>
		<!-- /* Faire afficher le fil d'Ariane ici */ -->
        <?php echo Recette::ariane($nomCategorie, $recette['titre']) ?>
		<section class="body">
			<!-- /* Faire afficher l'article ici */ -->
			<?php echo Recette::articleRecette($idRecette, $recette) ?>
		</section>
		<!-- /* Inclure le pied de page ici */ -->
		<?php include("../components/footer.php") ?>
	</div>
</body>

</html>
