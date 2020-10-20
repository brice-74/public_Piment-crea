<?php 
use Vendors\DateTime\DateTimeTransform;
use Vendors\LandingPage\LandingPage;
$transformDate = new DateTimeTransform();

$page = new LandingPage();
$transformDate = new DateTimeTransform(); 
$page->setPage("vue-chaine/".$result["chaine"]->getNomChaine());

if(isset($result)):?>
	<div class="statViewC flex">
		<div class="stat1 flex">
			<div class="borderR">
				<p class="mb0 cWhite txt32 mb5 alignCenter"><?php 
					if(is_array($result['visuels'])){
						$moy = $result['sumLike'] / $result['nbVisu'];
						$moy = (is_float($moy))?number_format($moy, 1, '.', ''):$moy;
						echo $moy;  
					}else{
						echo '0';
					}
				?>	
				</p>
				<p class="mb10 cGhost txt10 alignCenter">Like moyen par poste</p>
			</div>
			<div>
				<p class="mb0 cWhite txt32 mb5 alignCenter">
				<?php 
					if(is_array($result['visuels'])){
						echo $result['sumLike'];
					}else{
						echo '0';
					}
				?>	
				</p>
				<p class="mb10 cGhost txt10 alignCenter">like(s)</p>
			</div>
		</div>
		<div class="stat2 flex">
			<div class="borderR">
				<p class="mb0 cWhite txt32 alignCenter">
				<?php 
				if(is_array($result['tutos'])){
					$moy = $result['sumNote'] / $result['countNote'];
					$moy = (is_float($moy))?number_format($moy, 1, '.', ''):$moy;
					echo $moy; 
				}else{
					echo '0';
				}
				?>	
				<span class="txt18 cGhost"> / 10</span></p>
				<p class="mb10 cGhost txt10 alignCenter">Note moyenne par poste</p>
			</div>
			<div>
				<p class="mb0 cWhite txt32 mb5 alignCenter">
					<?php 
						if(is_array($result['tutos'])){
							echo $result['countNote']; 
						}else{
							echo '0';
						}
					?>	
				</p>
				<p class="mb10 cGhost txt10 alignCenter">note(s)</p>
			</div>
		</div>
		<div class="stat3">
			<p class="mb5 cWhite txt32 alignCenter"><?php 
				echo $result['nbAbo'];
			?>	
			</p>
			<p class="mb10 cGhost txt10 alignCenter">Abonnement(s)</p>
		</div>
	</div>
	<div class="main-container-min">
		<div class="flex mb40 viewCcontainVT">
			<div class="flex flex1 fdC mr60" <?php if(!is_array($result['visuels'])){echo 'noPost';} ?>>
				<p class="txt12 pb5 cGris borderB posR">Derniers visuels postés 
					<?php if(is_array($result['visuels'])): ?>
						<span class=" posA r0 cOrange"><?php echo $result['nbVisu']; ?> visuel(s)</span>
					<?php endif; ?>
				</p>
				<div class="containViewC containVisuViewC m-10">
					<?php if(isset($result["visuels"])): ?>
						<?php if(is_array($result["visuels"])): ?>
							<?php foreach ($result["visuels"] as $visuel):?>
								<div class= "p10 flex postViewC">
								 	<div class="container-visuels maxW180">
									 	<a class="p0" href="<?php echo DOMAINE ?>visuel-<?php echo $visuel->getIdVisuel(); ?>-<?php echo preg_replace("/.jpg$|.jpeg$|.png$/", '', $visuel->getVisuelVisuel()) ?>"
									 		<?php echo "style=\"background-image:url(".DOMAINE."medias/chaine/id-".$visuel->getChaineIdChaine()."/visuel/min-".$visuel->getVisuelVisuel().")\""?> 
									 	>
											<img class="img-visuel" src="
											<?php echo DOMAINE?>medias/chaine/id-<?php echo $visuel->getChaineIdChaine() ?>/visuel/<?php echo $visuel->getVisuelVisuel() ?>"
											>
										</a>
									</div>
									<div class="flex pb5 pt5 pl15 pr15">
										<div class="flex fdC">
											<div class="mbAuto">
												<div class="like-min flex p0 mb5">
													<p class="cBleu bold mb0 mr10 mtAuto">
													<?php if(isset($result["countLikes"])){
														$nb = 0;
														foreach($result["countLikes"] as $nblike){
															if(!is_null($nblike)){
																if($nblike->getVisuelIdVisuel() == $visuel->getIdVisuel()){
																	echo $nblike->sommeLikes;
																	$nb++;
																}
															}
														 }
														 if($nb == 0){
															echo '0';
														}
													}	
													?>
													</p>
													<svg version="1.1" viewBox="0 0 35 35" xml:space="preserve">
														<g>
															<g>
																<path d="M2.3,31.1c-0.7,0-1.3-0.6-1.3-1.3V13.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3v16.7C3.6,30.5,3,31.1,2.3,31.1
																	z"/>
															</g>
															<path d="M26.9,11.9H16.6c0.8-5.4,0.2-8.8-1.7-10.4c-1.2-1.1-2.7-0.9-3.4-0.7c-0.4,0.1-0.7,0.4-0.8,0.8L6.8,12.7
																c0,0.1-0.1,0.3-0.1,0.4v16.9c0,0.1,0,0.1,0,0.2c0,0.7,0.6,1.3,1.3,1.3H8h11.2h0.1c3,0,5.5-1,7.4-2.9c3.6-3.6,4.1-9.6,4-12.9
																C30.8,13.6,29,11.9,26.9,11.9z M24.9,26.9c-1.3,1.3-3.1,2-5.2,2.1H9.3V13.4l3.6-10.2c0.1,0,0.3,0.1,0.4,0.2
																c0.4,0.4,1.8,2.2,0.5,9.5c-0.1,0.4,0,0.8,0.3,1.1c0.2,0.3,0.6,0.5,1,0.5h11.8c0.7,0,1.3,0.6,1.3,1.3C28.2,18.7,27.8,24,24.9,26.9z"
																/>
														</g>
													</svg>
												</div>
												<div>
													<button modale="btn-supprVisu" class="opacity07 cRouge dpB a-link mb10 supprVisu" title="Supprimer le visuel"><p class="mb0 txt12" <?php echo "id=\"suppression-visuel-".$visuel->getIdVisuel()."\""; ?>>Supprimer</p></button>
												</div>
											</div>
											<div class="">
												<p class="txt12 cGris mb0"><?php echo $transformDate->transformDateTime($visuel->getDatePostVisuel()); ?></p>
											</div>
										</div>
									</div>
									<div class="flex mlAuto fdC posR">
										<?php
										$ComV = 0;
										$newComV = 0;
										if(isset($result["comVisu"])){
											foreach ($result["comVisu"] as $comVisu) {
												if(!is_null($comVisu)){
													foreach ($comVisu as $com) {
														if($com->getVisuelIdVisuel() == $visuel->getIdVisuel()){
															$ComV++;
															
															if($com->getNewPostCommentaire() == 1){
																$newComV++;
															}
														}
													}
												}
												
											}
										}
										?>
										<?php if($newComV > 0): ?>
											<div class="pointNews"></div>
										<?php endif; ?>
										<div class="flex fdC mAuto">
											<div class="flex" title="<?php if($ComV > 1){echo $ComV." commentaires";}else{echo $ComV." commentaire";} ?>">
												<p class="cGris txt14 mb5 bold dpIB"><?php echo $ComV; ?></p>
												<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve" class="commentVC">
													<path class="st0" d="M22.3,4.7H2.8c-0.6,0-1.1,0.5-1.1,1.1v13.3c0,0.4,0.2,0.8,0.6,1c0.2,0.1,0.3,0.1,0.5,0.1c0.4,0,0.5,0,0.5-0.1
													L3.4,20l4.2-3.3h14.7c0.6,0,1.1-0.5,1.1-1.1V5.8C23.4,5.2,22.9,4.7,22.3,4.7z M21.2,14.5H7.3c-0.3,0-0.5,0.1-0.7,0.3l-2.7,2V6.9
													h17.3V14.5z"/>
												</svg>
											</div>
											
											<a class="btnB p5-15 mb5" 
											<?php if($newComV > 0): ?>
												href="<?php echo DOMAINE ?>visuel-<?php echo $visuel->getIdVisuel(); ?>-<?php echo preg_replace('/.jpg$|.jpeg$|.png$/','',$visuel->getVisuelVisuel()); ?>#bloc-com"
											<?php else: ?>
												href="<?php echo DOMAINE ?>visuel-<?php echo $visuel->getIdVisuel(); ?>-<?php echo preg_replace('/.jpg$|.jpeg$|.png$/','',$visuel->getVisuelVisuel()); ?>"
											<?php endif; ?>
											>
												<p class="txt12">Afficher</p>
											</a>
											<p class="cOrange txt10 mb5">
												<?php if($newComV > 1): ?>
													<span class="txt12"><?php echo $newComV; ?></span> nouveaux
												<?php elseif($newComV > 0): ?>
													<span class="txt12"><?php echo $newComV; ?></span> nouveau
												<?php endif; ?>
											</p>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<p class="cGris alignCenter"><?php echo $result["visuels"]; ?></p>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="flex flex1 fdC" <?php if(!is_array($result['tutos'])){echo 'noPost';} ?>>
				<p class="txt12 pb5 cGris borderB posR">Derniers tutos postés
					<?php if(is_array($result['tutos'])): ?>
						<span class=" posA r0 cOrange"><?php echo $result['nbTuto']; ?> tuto(s)</span>
					<?php endif; ?>
				</p>
				<div class="containViewC containTutoViewC m-10">
					<?php if(isset($result["tutos"])): ?>
						<?php if(is_array($result["tutos"])): ?>
							<?php foreach ($result["tutos"] as $tuto):?>
								<div class= "p10 flex postViewC">
								 	<div class="container-visuels maxW180">
									 	<a class="p0" href="<?php echo DOMAINE ?>tuto-<?php echo $tuto->getIdTuto(); ?>-<?php echo $tuto->getTitreTuto(); ?>"
									 		<?php echo "style=\"background-image:url(".DOMAINE."medias/chaine/id-".$tuto->getChaineIdChaine()."/tuto-".$tuto->getIdTuto()."/min-".$tuto->getVisuelTuto().")\""?> 
									 	>
											<img class="img-visuel" src="
											<?php echo DOMAINE?>medias/chaine/id-<?php echo $tuto->getChaineIdChaine() ?>/tuto-<?php echo $tuto->getIdTuto() ?>/min-<?php echo $tuto->getVisuelTuto() ?>"
											>
										</a>
									</div>
									<div class="flex pb5 pt5 pl15 pr15">
										<div class="flex fdC">
											<div class="mbAuto">
												<div class="like-min flex p0 mb5">
													<?php $nb = 0; ?>
													<?php if(isset($result['note'])):?>
														<?php foreach ($result["note"] as $note): ?>
															<?php if($note->getTutoIdTuto() == $tuto->getIdTuto()): ?>
																<?php 
																$nb++;
																	$moy = $note->sumNote / $note->countNote;
																	$moy = (is_float($moy))?number_format($moy, 1, '.', ''):$moy;
																?>
																<div class="mAuto0 flex">
																	<?php 
																	if($note->countNote > 1){
																		echo '<p class="mAuto txt12 cGris">'.$note->countNote.' notes</p>';
																	}else{
																		echo '<p class="mAuto txt12 cGris">'.$note->countNote.' note</p>';
																	}
																	?>
																	<p class="mAuto txt14 ml5 cBleu bold"><?php echo $moy; ?></p>
																	<p class="cGris txt12 mAuto">/10</p>			
																</div>
															<?php endif; ?>
														<?php endforeach; ?>
													<?php endif; ?>
													<?php if($nb == 0): ?>
														<div class="mAuto0 flex">
															<p class="cGris txt12 mAuto">Aucune Note</p>
														</div>
													<?php endif; ?>
												</div>
												<div>
													<button modale="btn-depostTuto" class="opacity07 cRouge dpB a-link mb10 supprVisu" title="Supprimer le visuel"><p class="mb0 txt12" <?php echo "id=\"deposte-tuto-".$tuto->getIdTuto()."\""; ?>>Dépublier</p></button>
												</div>
											</div>
											<div class="">
												<p class="txt12 cGris mb0"><?php echo $transformDate->transformDateTime($tuto->getDatePostTuto()); ?></p>
											</div>
										</div>
									</div>
									<div class="flex mlAuto fdC posR">
										<?php 
										$Com = 0;
										$newCom = 0;
										if(isset($result["comTuto"])){
											foreach ($result["comTuto"] as $comTuto) {
												if(!is_null($comTuto)){
													foreach ($comTuto as $com) {
														if($com->getTutoIdTuto() == $tuto->getIdTuto()){
															$Com++;
															
															if($com->getNewPostCommentaire() == 1){
																$newCom++;
															}
														}
													}
												}
											}
										}
										?>
										<?php if($newCom > 0): ?>
											<div class="pointNews"></div>
										<?php endif; ?>
										<div class="flex fdC mAuto">
											<div class="flex" title="<?php if($Com > 1){echo $Com." commentaires";}else{echo $Com." commentaire";} ?>">
												<p class="cGris txt14 mb5 bold dpIB"><?php echo $Com; ?></p>
												<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve" class="commentVC">
													<path class="st0" d="M22.3,4.7H2.8c-0.6,0-1.1,0.5-1.1,1.1v13.3c0,0.4,0.2,0.8,0.6,1c0.2,0.1,0.3,0.1,0.5,0.1c0.4,0,0.5,0,0.5-0.1
													L3.4,20l4.2-3.3h14.7c0.6,0,1.1-0.5,1.1-1.1V5.8C23.4,5.2,22.9,4.7,22.3,4.7z M21.2,14.5H7.3c-0.3,0-0.5,0.1-0.7,0.3l-2.7,2V6.9
													h17.3V14.5z"/>
												</svg>
											</div>
											
											<a class="btnB p5-15 mb5" 
											<?php if($newCom > 0): ?>
												href="<?php echo DOMAINE ?>tuto-<?php echo $tuto->getIdTuto(); ?>-<?php echo $tuto->getTitreTuto(); ?>#bloc-com"
											<?php else: ?>
												href="<?php echo DOMAINE ?>tuto-<?php echo $tuto->getIdTuto(); ?>-<?php echo $tuto->getTitreTuto(); ?>"
											<?php endif; ?>
											>
												<p class="txt12">Afficher</p>
											</a>
											<p class="cOrange txt10 mb5">
												<?php if($newCom > 1): ?>
													<span class="txt12"><?php echo $newCom; ?></span> nouveaux
												<?php elseif($newCom > 0): ?>
													<span class="txt12"><?php echo $newCom; ?></span> nouveau
												<?php endif; ?>
											</p>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<p class="cGris alignCenter"><?php echo $result["tutos"]; ?></p>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="flex viewCcontainMP">
			<div class="flex fdC mr60 w100">
				<p class="txt12 pb5 cGris borderB">Membres</p>
				<div class="flex containMembers">
					<?php foreach ($result['membres'] as $membre): ?>
						<div class="flex mr20">
							<div class="container-avatar-min3" 
								<?php 
								if(is_null($membre->getAvatarUser())){
									echo "style=\"background-image:url(".DOMAINE."templates/front/img/pimentC.jpg)\""; 
								}else{
									echo "style=\"background-image:url(".DOMAINE."medias/user/id-".$membre->getIdUser()."/avatars/".$membre->getAvatarUser().")\""; 
								}
								?>
							>
							</div>
							<p class="ml10 mAuto0"><?php echo $membre->getNomUser(); ?>&nbsp;<?php echo $membre->getPrenomUser(); ?></p>
						</div>
					<?php endforeach; ?>
					<a class="posR flex moreMembersCont pl60" href="<?php echo DOMAINE ?>ajouter-membre">
						<div class="moreMembers">
							<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve">
								<g>
									<g>
										<rect x="8.5" y="14" class="st0" width="15" height="2.1"/>
										<rect x="8.5" y="9" transform="matrix(1.061078e-10 1 -1 1.061078e-10 26 -1)" class="st0" width="15" height="2.1"/>
									</g>
								</g>
							</svg>
						</div>
						<p class="txt12 cGris mAuto0">Ajouter&nbsp;un&nbsp;membre</p>
					</a>
				</div>
			</div>
			<div class="flex fdC">
				<p class="txt12 pb5 cGris borderB">Paramètres</p>
				<button class="dpB a-link mb10" modale="btn-selectFile2" title="Modifier avatar"><p class="mb0 alignLeft">Avatar&nbsp;de&nbsp;la&nbsp;chaine</p></button>
				<button class="dpB a-link mb10" modale="btn-selectFile" title="Modifier Bandeau de présentation de la chaine"><p class="mb0 alignLeft">Image&nbsp;d'entête</p></button>
				<a href="<?php echo DOMAINE ?>modifier-infos-chaine" class="dpB a-link mb10" title="Modifier la description et les lien aux réseaux sociaux"><p class="mb0">Informations&nbsp;de&nbsp;la&nbsp;chaine</p></a>
				<button class="dpB a-link mb0" modale="btn-supprChaine" title="Supprimer ma chaine"><p class="mb0 alignLeft">Supprimer&nbsp;la&nbsp;chaine</p></button>
			</div>
		</div>
	</div>
	<div id="modale-selectFile">
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
				<p class="titre2 mb40 alignCenter">Modifier mon bandeau</p>
				<p class="mb5">Sélèctionner un fichier .jpg ou .png (max 2mo) et charger l'image.</p>
				<p class="mb80">Taile de l'image conseillé <span class="bold">2100x350<span></p>
				<?php 	echo $result["form"][1]->getForm(); ?>
			</div>
		</div>
	</div>
	<div id="modale-selectFile2">
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
				<p class="titre2 mb40 alignCenter">Modifier mon avatar de chaine</p>
				<p class="mb5">Sélèctionner un fichier .jpg ou .png (max 2mo) et charger l'image.</p>
				<p class="mb80">Taile de l'image conseillé est un <span class="bold">Format carré<span></p>
				<?php 	echo $result["form"][2]->getForm(); ?>
			</div>
		</div>
	</div>
	<div id="modale-supprVisu">
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
				<p class="titre2 mb40 alignCenter">Supprimer le visuel ?</p>
				<ul class="mb40">
					<li class="txt14 mb10">Celui-ci sera supprimer ainsi que les commentaires associés</li>
				</ul>
					<a href="" title="Je souhaite supprimer définitivement se visuel et toutes les informations le concernant" class="a-link cRouge alignCenter mb20 txt14">Confirmer</a>
					<button title="Je ne souhaite pas supprimer se post" class="annul btnV"><p>Annuler la suppression</p></button>
			</div>
		</div>
	</div>
	<div id="modale-depostTuto">
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
				<p class="titre2 mb40 alignCenter">Dépublier le tutoriel ?</p>
				<ul class="mb40">
					<li class="txt14 mb10">Celui-ci sera placer dans vos brouillons afin de pouvoir le modifier ou le supprimer</li>
				</ul>
					<a href="" title="Je souhaite dépublier se tutoriel" class="a-link cRouge alignCenter mb20 txt14">Confirmer</a>
					<button title="Je ne souhaite pas dépublier se tutoriel" class="annul btnV"><p>Annuler</p></button>
			</div>
		</div>
	</div>
	<div id="modale-supprChaine">
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
				<p class="titre2 mb40 alignCenter">Supprimer la chaine ?</p>
				<ul class="mb40">
					<li class="txt14 mb10">L'enssemble des visuels et tutoriaux posté ou non seront supprimer.</li>
					<li class="txt14 mb10">Vous ne pourez pas récupérer les informations concernant la chaine, néanmoins il sera possible de créer une nouvelle chaine.</li>
				</ul>
					<a href="<?php echo DOMAINE ?>supprimer-chaine" title="Je souhaite supprimer définitivement la chaine et toutes les informations la concernant" class="a-link cRouge alignCenter mb20 txt14">Confirmer</a>
					<button title="Je ne souhaite pas supprimer la chaine pour le moment" class="annul btnV"><p>Annuler la suppression</p></button>
			</div>
		</div>
	</div>
<?php endif; ?>
<script src="<?php echo DOMAINE; ?>templates/front/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/toggle-nav.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/scroll-anim.js"></script>