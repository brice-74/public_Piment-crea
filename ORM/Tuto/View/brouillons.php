<?php 
use Vendors\DateTime\DateTimeTransform;
use Vendors\LandingPage\LandingPage;
$transformDate = new DateTimeTransform();

$page = new LandingPage();
$transformDate = new DateTimeTransform(); 
$page->setPage("brouillons");

if(isset($result)):?>
	<div class="main-container-min">
		<div class="flex maxW1200">
			<div class="flex flex1 fdC">
				<p class="txt12 pb5 cGris borderB">Derniers tutos non postés</p>
				<?php if(isset($result["tutos"])): ?>
					<?php if(is_array($result["tutos"])): ?>
						<?php foreach ($result["tutos"] as $tuto):?>
							<div class="m-10 p10 flex containBrouillon">
							 	<div class="container-visuels maxW180">
							 		<?php if(!is_null($tuto->getVisuelTuto())): ?>
									 	<a class="p0" href="modif-tuto-<?php echo $tuto->getIdTuto() ?>"
									 		<?php echo "style=\"background-image:url(".DOMAINE."medias/chaine/id-".$tuto->getChaineIdChaine()."/tuto-".$tuto->getIdTuto()."/".$tuto->getVisuelTuto().")\""?> 
									 	>
											<img class="img-visuel" src="
											<?php echo DOMAINE?>medias/chaine/id-<?php echo $tuto->getChaineIdChaine(); ?>/tuto-<?php echo $tuto->getIdTuto(); ?>/<?php echo $tuto->getVisuelTuto() ?>"
											>
										</a>
									<?php else: ?>
										<div class="noImg">
											<svg version="1.1" xml:space="preserve">
												<path style="fill:#b2afc7;" d="M41,61c-0.4,0-0.8-0.2-1.2-0.5L26,44.3L12.1,60.5c-0.6,0.7-1.5,0.7-2.1,0.2c-0.6-0.5-0.7-1.5-0.1-2.1
												l15-17.5c0.3-0.3,0.7-0.5,1.1-0.5s0.9,0.2,1.1,0.5l15,17.5c0.5,0.7,0.5,1.6-0.2,2.1C41.7,60.9,41.3,61,41,61z M44.5,54.5
												c-0.5,0-0.9-0.2-1.2-0.6L36,44.5l-0.3,0.4c-0.5,0.7-1.5,0.8-2.1,0.3c-0.7-0.5-0.8-1.5-0.3-2.1l1.5-2c0.3-0.4,0.7-0.6,1.2-0.6l0,0
												c0.5,0,0.9,0.2,1.2,0.6l8.5,11c0.5,0.7,0.4,1.6-0.3,2.1C45.2,54.4,44.8,54.5,44.5,54.5z M38,33.5c-3.6,0-6.5-2.9-6.5-6.5
												s2.9-6.5,6.5-6.5s6.5,2.9,6.5,6.5S41.6,33.5,38,33.5z M38,23.5c-2,0-3.5,1.5-3.5,3.5s1.5,3.5,3.5,3.5s3.5-1.5,3.5-3.5
												S40,23.5,38,23.5z"/>
											<g>
												<path style="fill:#b2afc7;" d="M11,46c0.9,0,1.5-0.7,1.5-1.5v-35C12.5,7.5,14.1,6,16,6h25.5v3.5c0,3.6,2.9,6.5,6.5,6.5h3.5v38.5
													c0,2-1.5,3.5-3.5,3.5c-0.8,0-1.5,0.7-1.5,1.5S47.2,61,48,61c3.6,0,6.5-2.9,6.5-6.5v-40C54.5,8.1,49.3,3,43,3H16
													c-3.6,0-6.5,2.9-6.5,6.5v35C9.5,45.3,10.1,46,11,46z M51.3,13H48c-2,0-3.5-1.6-3.5-3.5V6.1C48,6.7,50.8,9.5,51.3,13z"/>
											</g>
											</svg>
										</div>
									<?php endif; ?>
								</div>
								<div class="flex pl15 pr15">
									<div class="flex fdC">
										<div class="mbAuto">
											<div class="flex p0 mb5 cutBox2">
												<?php if(!is_null($tuto->getTitreTuto())): ?>
													<p class="mb0  txt16"><?php echo $tuto->getTitreTuto(); ?></p>
												<?php else: ?>	
													<p class="mb0 cGris txt16">Aucun titre</p>
												<?php endif; ?>
											</div>
											<div class="flex">
												<a href="modif-tuto-<?php echo $tuto->getIdTuto() ?>" class="opacity07 cViolet dpB a-link mb10 supprVisu" title="Modifier le tuto"><p class="mb0 txt12" <?php echo "id=\"modifier-tuto-".$tuto->getIdTuto()."\""; ?>>Modifier</p></a>
												<button modale="btn-supprTuto" class="opacity07 cRouge dpB a-link mb10 supprVisu ml10" title="Supprimer le tuto"><p class="mb0 txt12" <?php echo "id=\"suppression-tuto-".$tuto->getIdTuto()."\""; ?>>Supprimer</p></button>												
											</div>
										</div>
										<div>
											<p class="txt12 cGris mb0">Créé <?php echo $transformDate->transformDateTime($tuto->getDateCreaTuto()); ?><?php 
												if(!is_null($tuto->getDateModifTuto())){
													echo " / Modifié ".$transformDate->transformDateTime($tuto->getDateModifTuto());
												}
											?></p>
										</div>
									</div>
								</div>
								<div class="mlAuto flex">
									<a href="poster-tuto-<?php echo $tuto->getIdTuto() ?>" class="btnB mAuto"><p class="txt14">Poster</p></a>
								</div>
							</div>
						<?php endforeach; ?>
					<?php else: ?>
						<p class="cGris"><?php echo $result["tutos"]; ?></p>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="modale-supprTuto">
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
			<div class="flex fdC">
				<p class="titre2 mb40 alignCenter">Supprimer le tutoriel ?</p>
				<ul class="mb40">
					<li class="txt14 mb10">Celui-ci sera supprimer ainsi que les commentaires associés</li>
				</ul>
					<a href="" title="Je souhaite supprimer définitivement se visuel et toutes les informations le concernant" class="a-link cRouge alignCenter mb20 txt14">Confirmer</a>
					<button title="Je ne souhaite pas supprimer se post" class="annul btnV"><p>Annuler la suppression</p></button>
			</div>
		</div>
	</div>
<?php endif; ?>
<script src="<?php echo DOMAINE; ?>templates/front/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/toggle-nav.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/scroll-anim.js"></script>