<?php
/*
Web 4 : Expressif (Logique) - Devoir 1
-------------------------------------------------------------------------
Votre nom :
-------------------------------------------------------------------------
- Compléter les méthodes suivantes
- Toutes les méthodes sont statiques
- Conseils :
	- Commencer par créer toutes les méthodes vides avec les bons paramètres et la bonne valeur de retour
	- Faire chaque méthode en oubliant le contexte dans lequel elles seront utilisées. "Elles prennent des données et retournent une valeur. Point final!"
	- Tester CHAQUE méthode individuellement en ajoutant une ligne de test à la fin de ce document (comme pour l'exercice "objet divers". La ligne de test doit être à l'extérieur de la classe.
*/
class Recette {
	/**
	 * Méthode "fraction" qui
	 * @param  string $valeur - Une chaîne représentant un nombre avec potentiellement une fraction
	 * @return string - une chaine avec les balises créant une fraction
	 */
	static public function fraction($valeur) {
		$parties = explode(" ", $valeur);
		if (count($parties) > 1) {
			return $parties[0] . self::fraction($parties[1]);
		}
		$parties = explode("/", $valeur);
		if (count($parties) == 1) {
			return $parties[0];
		}
		return '<span class="fraction"><sup>'.$parties[0].'</sup>/<sub>'.$parties[1].'</sub></span>';
	}

	/**
	 * Méthode "trouverRecette" qui retourne le array représentant une recette.
	 * En fonction de la catégorie et du id envoyés en paramètres.
	 * Si la catégorie n'existe pas ou la recette n'existe pas pour cette catégorie, on retourne false
	 * @param array  $recettes     - Le array contenant les recettes
	 * @param string $nomCategorie - La catégorie à rechercher
	 * @param string $idRecette    - la recette à rechercher dans la catégorie
	 * @return array	- Le array de la recette ou false
	 */
	static public function trouverRecette($recettes, $nomCategorie, $idRecette) {
		if (!isset($recettes[$nomCategorie])) {
			return false;
		}
		if (!isset($recettes[$nomCategorie][$idRecette])) {
			return false;
		}
		return $recettes[$nomCategorie][$idRecette];
	}

	/**
	 * Méthode "ariane" qui retourne la balise nav contenant le fil d'Ariane
	 * @param  string $nomCategorie - La catégorie à traiter. Valeur par défaut: ""
	 * @param  string $titreRecette   - Le titre de la recette qui est affichée. Valeur par défaut: ""
	 * @return string - Le HTML de la balise nav
	 */
	static public function ariane($nomCategorie='', $titreRecette='') {
		$resultat = '';
		$resultat .= '<nav id="ariane">';
		$resultat .= '<ul>';
		if ($nomCategorie === '') {
			$resultat .= '<li><span>Accueil</span></li>';
		} else if ($titreRecette === '') {
			$resultat .= '<li><a href="index.php">Accueil</a></li>';
			$resultat .= '<li><span>'.$nomCategorie.'</span></li>';
		} else {
			$resultat .= '<li><a href="index.php">Accueil</a></li>';
			$resultat .= '<li><a href="categorie.php?nomCategorie='.$nomCategorie.'">'.$nomCategorie.'</a></li>';
			$resultat .= '<li><span>'.$titreRecette.'</span></li>';
		}
		$resultat .= '</ul>';
		$resultat .= '</nav>';
		return $resultat;
	}

	/**
	 * Méthode "image" qui retourne l'image de la recette donnée.
	 * Si $vignette est true, alors on retourne le span.vignette sinon, on retourne figure.photoprincipale
	 * @param  string  $idRecette   - le id de la recette (donc le nom du fichier)
	 * @param  array   $recette     - la recette comme telle
	 * @param  boolean $vignette	- s'agit-il d'une vignette?  Valeur par défaut : false
	 * @return string  - Le HTML du figure ou d'un span
	 */
	static public function image($idRecette, $recette, $vignette=false) {
		$resultat = '';
		if ($vignette) {
			$resultat .= '<span class="vignette" style="background-image:url(images/recettes/'.$idRecette.'.jpg)" title="'.$recette['legende'].'"></span>';
		} else {
			$resultat .= '<figure class="photoprincipale">';
			$resultat .= '<img src="images/recettes/'.$idRecette.'.jpg" alt="'.$recette['legende'].'" title="'.$recette['legende'].'">';
			$resultat .= '<figcaption>'.$recette['legende'].'</figcaption>';
			$resultat .= '</figure>';
		}
		return $resultat;
	}

	/**
	 * Méthode "lien" qui retourne le lien vers une recette
	 * Note : Cette méthode utilise la méthode "image"
	 * @param  string $nomCategorie - Le nom de la catégorie
	 * @param  string $idRecette    - Le id de la recette
	 * @param  array  $recette      - La recette comme telle
	 * @return string - Le HTML d'une balise a
	 */
	static public function lien($nomCategorie, $idRecette, $recette) {
		$resultat = '';
		$resultat .= '<a href="recette.php?nomCategorie='.$nomCategorie.'&amp;idRecette='.$idRecette.'">';
		$resultat .= self::image($idRecette, $recette, true);
		$resultat .= '<span>'.$recette['titre'].'</span>';
		$resultat .= '</a>';
		return $resultat;
	}

	/**
	 * Méthode "ingredients" qui retourne la liste des ingrédients (ul.ingredients) donnée
	 * Note : Cette méthode utilise la méthode "fraction"
	 * @param  array  $ingredients - un tableau d'ingrédients. Voir le format dans donnees.inc.php
	 * @return string - une balise ul
	 */
	static public function ingredients($ingredients) {
		$resultat = '';
		$resultat .= '<ul class="ingredients">';
		foreach ($ingredients as $ingredient) {
			$resultat .= '<li>';
			$resultat .= '<span class="quantite">'.self::fraction($ingredient['quantite']).'</span>';
			$resultat .= '<span class="unite">'.$ingredient['unite'].'</span>';
			$resultat .= '<span class="ingredient">'.$ingredient['ingredient'].'</span>';
			$resultat .= '</li>';
		}
		$resultat .= '</ul>';
		return $resultat;
	}

	/**
	 * Méthode "instructions" qui returne la liste des instructions (ol.instructions) donnée
	 * @param  array  $instructions - La liste des instructions. Voir le format dans donnees.inc.php
	 * @return string - une balise ol
	 */
	static public function instructions($instructions) {
		$resultat = '';
		$resultat .= '<ol class="instructions">';
		foreach ($instructions as $instruction) {
			$resultat .= '<li>';
			$resultat .= $instruction;
			$resultat .= '</li>';
		}
		$resultat .= '</ol>';
		return $resultat;
	}

	/**
	 * Méthode "listeRecettes" qui retourne le HTML du ul.recettes qui fait la liste des recettes d'une catégorie
	 * Note : Cette méthode utilise la méthode "lien"
	 * @param  string $nomCategorie - Le nom de la catgorie
	 * @param  array  $recettes     - La liste des recettes à afficher
	 * @return string - Le HTML d'une balise ul
	 */
	static public function listeRecettes($nomCategorie, $recettes) {
		$resultat = '';
		$resultat .= '<ul class="recettes">';
		foreach ($recettes as $idRecette=>$recette) {
			$resultat .= '<li>';
			$resultat .= self::lien($nomCategorie, $idRecette, $recette);
			$resultat .= '</li>';
		}
		$resultat .= '</ul>';
		return $resultat;
	}

	/**
	 * Méthode "listeCategories" qui retourne le HTML du ul.categories qui fait la liste des catégories
	 * Note : Cette méthode utilise la méthode "listeRecettes"
	 * @param  [[Type]] $categories [[Description]]
	 * @return [[Type]] [[Description]]
	 */
	static public function listeCategories($categories) {
		$resultat = '';
		$resultat .= '<ul class="categories">';
		foreach ($categories as $nomCategorie=>$recettes) {
			$resultat .= '<li>';
			$resultat .= '<div>';
			$resultat .= '<a href="categorie.php?nomCategorie='.$nomCategorie.'">';
			$resultat .= $nomCategorie;
			$resultat .= '</a>';
			$resultat .= '</div>';
			$resultat .= self::listeRecettes($nomCategorie, $recettes);
			$resultat .= '</li>';
		}
		$resultat .= '</ul>';
		return $resultat;
	}

	/**
	 * Méthode "articleRecette" qui retourne le HTML de l'article de la page recette.php
	 * Note : Cette méthode utilise les méthodes "image", "ingredients" et "instructions"
	 * @param  string $idRecette - Le id de la recette à afficher
	 * @param  array  $recette   - Les informations d'une recette (voir le format dans donnees.inc.php)
	 * @return string - Le HTML d'une balise article
	 */
	static public function articleRecette($idRecette, $recette) {
		$resultat = '';
		$resultat .= '<article>';
		$resultat .= '<header>';
		$resultat .= '<h1>'.$recette['titre'].'</h1>';
		$resultat .= '</header>';
		$resultat .= '<p class="intro">'.$recette['intro'].'</p>';
		$resultat .= self::image($idRecette, $recette);
		$resultat .= $recette['description'];
		$resultat .= '<h2>Ingrédients</h2>';
		$resultat .= self::ingredients($recette['ingredients']);
		$resultat .= '<h2>Instructions</h2>';
		$resultat .= self::instructions($recette['instructions']);
		$resultat .= '</article>';
		return $resultat;
	}

	/**
	 * Méthode "articleCategorie" qui retourne le HTML de l'article de la page categorie.php
	 * Note : Cette méthode utilise la méthode "articleCategorie"
	 * @param  string $nomCategorie      - Le nom de la catégorie à afficher
	 * @param  array  $recettesCategorie - Les recettes appartenant à cette catégorie
	 * @return string - Le HTML d'une balise article
	 */
	static public function articleCategorie($nomCategorie, $recettesCategorie) {
		$resultat = '';
		$resultat .= '<article>';
		$resultat .= '<header>';
		$resultat .= '<h1>'.$nomCategorie.'</h1>';
		$resultat .= '</header>';
		$resultat .= self::listeRecettes($nomCategorie, $recettesCategorie);
		$resultat .= '</article>';
		return $resultat;
	}

	/**
	 * Méthode "articleIndex" qui retourne le HTML de l'article de la page index.php
	 * Note : Cette méthode utilise la méthode "listeCategories"
	 * @param  array  $recettes - La liste des catégories et leur recettes
	 * @return string - Le HTML d'une balise article
	 */
	static public function articleIndex($recettes) {
		$resultat = '';
		$resultat .= '<article>';
		$resultat .= '<header>';
		$resultat .= '<h1>Liste des recettes</h1>';
		$resultat .= '</header>';
		$resultat .= self::listeCategories($recettes);
		$resultat .= '</article>';
		return $resultat;
	}

}

/*LIGNE DE TEST*/
//echo Recette::fraction('10 3/4');
