<?php if(isset($result)): ?>
	<div class="main-container-max">
		<a href="<?php echo DOMAINE ?>" class="retour2 cGris bold Iflex pl0">
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
	<div class="maxW600 mb80">
		<h1 class="titre2 mb60 alignCenter">Poster un visuel sur ma chaine</h1>
		<p class="mb10">- Sélèctionner un fichier .jpg ou .png (max 2mo) et charger l'image.</p>
		<p class="mb40">- Il est conseillé de renseigné une catégorie au minimum, celle-ci permettra aux utlisateurs de retrouver plus facilement votre contenu.</p>
		<div class="flex">
			<p class="mb10 bold mAuto0">- Si une catégorie vous manque faite le nous savoir.</p>
			<button class="btnV" modale='btn-proposition'><p class="txt12">nouvelle catégorie</p></button>
		</div>
		<?php if(isset($result['props'])): ?>
			<div class="pt20">
				<p class="mb10">Nouvelle(s) catégorie(s) :</p>
			<?php foreach ($result['props'] as $prop):?>
				<div class="catProp">
					<p class="mb0 cBleu bold"><?php echo $prop->getTitreProposition() ?></p>
					<div class="removeCatProp" ajax="rm-prop" datas="<?php echo $prop->getIdProposition() ?>"></div>
				</div>
			<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	
	<?php echo $result["form"][1]->getForm(); ?>
	<div class="preview fdC flex p20"></div>
	</div>
	<div id="modale-proposition">
		<div>
			<button class="retour1 cWhite bold flex pl0">
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
			</button>
			<div>
				<p class="titre2 mb60 alignCenter">Intitulé de la catégorie</p>
				<p class="mb5">La catégorie sera traité en amont de sa publication.</p>
				<p class="mb60 bold">Suite à sa vérification elle sera automatiquement associé à votre contenu.</p>
				<?php echo $result["form"][2]->getForm(); ?>
				<p class="cGris txt12 mt-20">Si vous souhaitez renseigner plusieurs catégories, veuillez répéter l'opération.</p>
			</div>
		</div>
	</div>
<?php endif; ?>
<script src="<?php echo DOMAINE; ?>templates/front/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/toggle-nav.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/select.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/preview-img.js"></script>
