<?php

define("PTH", "/");

$route[] = [
	"url" 			=> PTH."vue-admin",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "ViewAdmin",
	"logged" 		=> TRUE,
	"droits" 		=> 3
];
$route[] = [
	"url" 			=> PTH."add-actif-prop-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Proposition",
	"action" 		=> "AddActifProp",
	"logged" 		=> TRUE,
	"droits" 		=> 3
];
$route[] = [
	"url" 			=> PTH."add-actif-signal-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Signal",
	"action" 		=> "AddActifSignal",
	"logged" 		=> TRUE,
	"droits" 		=> 3
];
$route[] = [
	"url" 			=> PTH."toggle-actif-chaine-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Signal",
	"action" 		=> "ToggleActifChaine",
	"logged" 		=> TRUE,
	"droits" 		=> 3
];
$route[] = [
	"url" 			=> PTH."toggle-actif-commentaire-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Signal",
	"action" 		=> "ToggleActifCommentaire",
	"logged" 		=> TRUE,
	"droits" 		=> 3
];
$route[] = [
	"url" 			=> PTH."toggle-actif-tuto-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Signal",
	"action" 		=> "ToggleActifTuto",
	"logged" 		=> TRUE,
	"droits" 		=> 3
];
$route[] = [
	"url" 			=> PTH."ajout-categorie-by-proposition-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Proposition",
	"action" 		=> "AjoutCategorieProp",
	"logged" 		=> TRUE,
	"droits" 		=> 3
];
$route[] = [
	"url" 			=> PTH."toggle-actif-visuel-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Signal",
	"action" 		=> "ToggleActifVisuel",
	"logged" 		=> TRUE,
	"droits" 		=> 3
];
$route[] = [
	"url" 			=> PTH,
	"namespace" 	=> "Vendors",
	"module" 		=> "StaticPage",
	"action" 		=> "Concept",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."index",
	"namespace" 	=> "Vendors",
	"module" 		=> "StaticPage",
	"action" 		=> "Concept",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."index.php",
	"namespace" 	=> "Vendors",
	"module" 		=> "StaticPage",
	"action" 		=> "Concept",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];

$route[] = [
	"url" 			=> PTH."rgpd",
	"namespace" 	=> "Vendors",
	"module" 		=> "StaticPage",
	"action" 		=> "RGPD",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."creation-compte",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "CreerCompte",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."connexion",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "ConnecterCompte",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."traitement-prop",
	"namespace" 	=> "ORM",
	"module" 		=> "Proposition",
	"action" 		=> "TraitementFormProp",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."traitement-prop-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Proposition",
	"action" 		=> "TraitementFormPropTuto",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."remove-prop",
	"namespace" 	=> "ORM",
	"module" 		=> "Proposition",
	"action" 		=> "TraitementRemoveProp",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."deconnexion",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "LogOut",
	"logged" 		=> TRUE,
	"droits" 		=> 1
];
$route[] = [
	"url" 			=> PTH."activation-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "ActiverCompte",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."nouvelle-activation",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "NewActivation",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."profil",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "ViewProfil",
	"logged" 		=> TRUE,
	"droits" 		=> 1
];
$route[] = [
	"url" 			=> PTH."modifier-avatar",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "ModifierAvatar",
	"logged" 		=> TRUE,
	"droits" 		=> 1
];
$route[] = [
	"url" 			=> PTH."mot-passe-oublie",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "NewMdp",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."nouveau-mdp-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "CreateMdp",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."modifier-profil",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "ModifierProfil",
	"logged" 		=> TRUE,
	"droits" 		=> 1
];
$route[] = [
	"url" 			=> PTH."supprimer-compte",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "SuppressionCompte",
	"logged" 		=> TRUE,
	"droits" 		=> 1
];
$route[] = [
	"url" 			=> PTH."creation-chaine",
	"namespace" 	=> "ORM",
	"module" 		=> "Chaine",
	"action" 		=> "CreerChaine",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."quitter-chaine",
	"namespace" 	=> "ORM",
	"module" 		=> "User",
	"action" 		=> "QuitterChaine",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."chaine-([0-9]+)-(.*)/visuels",
	"namespace" 	=> "ORM",
	"module" 		=> "Visuel",
	"action" 		=> "ViewVisuelsChaine",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."chaine-([0-9]+)-(.*)/tutos",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "ViewTutosChaine",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."chaine-([0-9]+)-(.*)/description",
	"namespace" 	=> "ORM",
	"module" 		=> "Chaine",
	"action" 		=> "ViewDescriptionChaine",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."supprimer-chaine",
	"namespace" 	=> "ORM",
	"module" 		=> "Chaine",
	"action" 		=> "SuppressionChaine",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."ajouter-membre",
	"namespace" 	=> "ORM",
	"module" 		=> "Chaine",
	"action" 		=> "AjoutMembre",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."addesion-(.*)",
	"namespace" 	=> "ORM",
	"module" 		=> "Chaine",
	"action" 		=> "AddesionChaine",
	"logged" 		=> TRUE,
	"droits" 		=> 1
];
$route[] = [
	"url" 			=> PTH."vue-chaine/(.*)",
	"namespace" 	=> "ORM",
	"module" 		=> "Chaine",
	"action" 		=> "ViewMyChaine",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."suppression-visuel-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Visuel",
	"action" 		=> "SuppressionVisuel",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."deposte-tuto-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "DepostTuto",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."suppression-tuto-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "SuppressionTuto",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."modifier-infos-chaine",
	"namespace" 	=> "ORM",
	"module" 		=> "Chaine",
	"action" 		=> "ModifInfosChaine",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."poster-visuel",
	"namespace" 	=> "ORM",
	"module" 		=> "Visuel",
	"action" 		=> "AjoutVisuel",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."visuel-([0-9]+)-(.*)",
	"namespace" 	=> "ORM",
	"module" 		=> "Visuel",
	"action" 		=> "ViewVisuel",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."visuels",
	"namespace" 	=> "ORM",
	"module" 		=> "Visuel",
	"action" 		=> "ActifVisuels",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."favoris",
	"namespace" 	=> "ORM",
	"module" 		=> "Favoris",
	"action" 		=> "FavorisByUser",
	"logged" 		=> TRUE,
	"droits" 		=> 1
];
$route[] = [
	"url" 			=> PTH."brouillons",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "Brouillons",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."poster-tuto-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "PostTuto",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."ajout-tuto",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "AjoutTuto",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."creation-tuto-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "BuilderTuto",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."modif-tuto-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "UpdateModifTuto",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."modifier-tuto-([0-9]+)",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "BuilderTuto",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."tutoriaux",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "ActifTutos",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."tuto-([0-9]+)-(.*)",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "ViewTuto",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."abonnements",
	"namespace" 	=> "ORM",
	"module" 		=> "Abonnement",
	"action" 		=> "ViewVisuelsAbonnements",
	"logged" 		=> TRUE,
	"droits" 		=> 1
];
$route[] = [
	"url" 			=> PTH."visuels(\+[a-z]+_[-0-9]*)*",
	"namespace" 	=> "ORM",
	"module" 		=> "Visuel",
	"action" 		=> "TrieVisuels",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."tutoriaux(\+[a-z]+_[-0-9]*)*",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "TrieTutos",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."search\?search\=(.*)\&goSearch\=recherche",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "SearchView",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];




/*        AJAX         */
$route[] = [
	"url" 			=> PTH."traitement-search",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "TraitementSearch",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."traitement-signal",
	"namespace" 	=> "ORM",
	"module" 		=> "Signal",
	"action" 		=> "TraitementSignal",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."next-actifs-tuto",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "NextActifTuto",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."next-actifs-visu",
	"namespace" 	=> "ORM",
	"module" 		=> "Visuel",
	"action" 		=> "NextActifVisu",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."chaine-([0-9]+)-(.*)/traitement-abonnement",
	"namespace" 	=> "ORM",
	"module" 		=> "Abonnement",
	"action" 		=> "TraitementAbonnement",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."traitement-commentaire-tuto",
	"namespace" 	=> "ORM",
	"module" 		=> "Commentaire",
	"action" 		=> "TraitementCommentaireTuto",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."ajout-note",
	"namespace" 	=> "ORM",
	"module" 		=> "Note",
	"action" 		=> "TraitementNote",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."traitement-commentaire",
	"namespace" 	=> "ORM",
	"module" 		=> "Commentaire",
	"action" 		=> "TraitementCommentaire",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."ajout-img-tuto",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "TraitementOneImgTuto",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."update-tvc-tuto",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "TraitementTuto",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."update-html-tuto",
	"namespace" 	=> "ORM",
	"module" 		=> "Tuto",
	"action" 		=> "TraitementHtmlTuto",
	"logged" 		=> TRUE,
	"droits" 		=> 2
];
$route[] = [
	"url" 			=> PTH."post-like",
	"namespace" 	=> "ORM",
	"module" 		=> "Like",
	"action" 		=> "TraitementLike",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."ajout-favoris-tuto",
	"namespace" 	=> "ORM",
	"module" 		=> "Favoris",
	"action" 		=> "TraitementFavorisTuto",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."ajout-favoris",
	"namespace" 	=> "ORM",
	"module" 		=> "Favoris",
	"action" 		=> "TraitementFavoris",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."chaine-([0-9]+)-(.*)/post-like",
	"namespace" 	=> "ORM",
	"module" 		=> "Like",
	"action" 		=> "TraitementLike",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];
$route[] = [
	"url" 			=> PTH."chaine-([0-9]+)-(.*)/ajout-favoris",
	"namespace" 	=> "ORM",
	"module" 		=> "Favoris",
	"action" 		=> "TraitementFavoris",
	"logged" 		=> FALSE,
	"droits" 		=> NULL
];

return $route;
?>