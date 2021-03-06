<?php use Vendors\LandingPage\LandingPage;

$page = new LandingPage();
if($page->existPage()){
	$direction = $page->getPage();
}else{
	$direction = "index";
}

if(isset($result)): ?>
	<div class="main-container-max">
		<a href="<?php echo DOMAINE.$direction ?>" class="retour2 cGris bold Iflex pl0">
			<svg class="mr10" version="1.1" viewBox="0 0 512.011 512.011" xml:space="preserve">
				<g>
					<g>
						<path d="M505.755,123.592c-8.341-8.341-21.824-8.341-30.165,0L256.005,343.176L36.421,123.592c-8.341-8.341-21.824-8.341-30.165,0
							s-8.341,21.824,0,30.165l234.667,234.667c4.16,4.16,9.621,6.251,15.083,6.251c5.462,0,10.923-2.091,15.083-6.251l234.667-234.667
							C514.096,145.416,514.096,131.933,505.755,123.592z"/>
					</g>
				</g>
			</svg>
			<p class="mAuto txt12">Retour</p>
		</a>
	<div class="maxW600">
		<h1 class="titre2 mb60 alignCenter">Ajout d'un membre sur la chaine</h1>
		<p class="mb10">Les membres posséderont l'enssemble des fonctionnalités liés à la chaine.</p>
		<p class="mb40">Si voulu, lors de la suppression de la chaine, seul le dernier membre aura la possibilité de faire cette action.</p>
	</div>
	<?php echo $result["form"][1]->getForm(); ?>
	</div>
<?php endif; ?>
<script src="<?php echo DOMAINE; ?>templates/front/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/toggle-nav.js"></script>