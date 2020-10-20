<?php 
use Vendors\Flash\Flash;
$flash = new FLash(); 
echo $flash->getFlash(); 
?>
<?php if(isset($result)):?>
	<div class="main-container-max maxW1200">
		<div class="flex fdC">
			<div class="flex fdC">
				<div class="flex mb50 containProfilAcc">
					<div class="flex mAuto">
						<button class="mr40 img-avatar-profil" modale="btn-selectFile"
						<?php 
						if(is_null($_SESSION["auth"]["avatar"])){
							echo "style=\"background-image:url(templates/front/img/pimentC.jpg)\""; 
						}else{
							echo "style=\"background-image:url(medias/user/id-".$_SESSION["auth"]["id"]."/avatars/".$_SESSION["auth"]["avatar"].")\""; 
						}
						?>>
						</button>
						<div class="mAuto">
							<?php echo  "<p class=\"mb0 bold txt22 dpIB\">".$_SESSION["auth"]["nom"]."</p>";?>
							<?php echo  "<p class=\"mb0 bold txt22 dpIB\">".$_SESSION["auth"]["prenom"]."</p>";?>
							<?php $date = new DateTime($_SESSION["auth"]["date"]); ?>
							<?php echo  "<p class=\"mb5\">".$_SESSION["auth"]["email"]."</p>";?>
							<?php echo  "<p class=\"mb0 txt10 cGris\">Compte créé le ".$date->format("d/m/Y")."</p>";?>
						</div>
					</div>
				</div>
				<div class="mb50 flex containProfilMod">
					<div class="flex fdC mr60 w100">
						<p class="cGris txt12 borderB pb5">Modifier mon profil</p>
						<div class="flex fdC">
							<button class="a-link alignLeft mb10" modale="btn-selectFile" title="Modifier avatar"><p class="mb0">Avatar</p></button>
							<a href="modifier-profil" class="a-link alignLeft mb10" title="Modifier nom et prenom"><p class="mb0">Nom&nbsp;et&nbsp;prenom</p></a>
							<a href="mot-passe-oublie" class="a-link alignLeft mb10" title="Modifier mot de passe"><p class="mb0">Mot&nbsp;de&nbsp;passe</p></a>
							<button class="a-link alignLeft" modale="btn-supprCompte" title="Supprimer mon compte"><p class="bold mb0">Supprimer&nbsp;mon&nbsp;compte</p></button>
						</div>
					</div>
					<div class="m0Auto w100">
						<p class="cGris txt12 borderB pb5">Ma chaine</p>
						<?php if(!isset($result['chaine'])): ?>
							<div class="flex fdC">
								<p class="mb5 txt18 bold">Créez une chaîne pour mettre en ligne vos propres visuels et tutoriaux.</p>
								<p class="mb20">Forgez une communauté dès maintenant tout seul ou à plusieurs.</p>
								<a href="creation-chaine" class="btnB ml0"><p class="txt14">Créer une chaine</p></a>
							</div>
						<?php else: ?>
							<div>
								<p class="txt22 bold mb0"><?php echo $result['chaine']->getNomChaine(); ?></p>
								<?php $date = new DateTime($result['chaine']->getDateCreaChaine()); ?>
								<p class="txt10 cGris mb20">Chaine créé le <?php echo $date->format("d/m/Y"); ?></p>
								<button class="dpB a-link alignLeft" modale="btn-quitteChaine" title="Quitter la chaine"><p class="bold mb5 txt14">Quitter&nbsp;la&nbsp;chaine</p></button>
								<a href="vue-chaine/<?php echo $result['chaine']->getNomChaine() ?>" class="dpB a-link alignLeft mb10" title="Vue sur la chaine"><p class="mb0">Autres&nbsp;paramètres</p></a>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="flex fdC infoProfil w100">
					<?php
						$like = $result['counter'][1]->countLikes;
						if(is_null($like)){$like = 0;}
						$favV = $result['counter'][2]->countFavVisu;
						if(is_null($favV)){$favV = 0;}
						$comV = $result['counter'][5]->countComVisu;
						if(is_null($comV)){$comV = 0;}
						$note = $result['counter'][0]->countNote;
						if(is_null($note)){$note = 0;}
						$favT = $result['counter'][3]->countFavTuto;
						if(is_null($favT)){$favT = 0;}
						$comT = $result['counter'][6]->countComTuto;
						if(is_null($comT)){$comT = 0;}
						$abos = $result['counter'][4]->countAbonnements;
						if(is_null($abos)){$abos = 0;}
					?>
					<div class="flex">
						<div class="flex fdC mb30">
							<div class="flex">
								<div class="mAuto flex mb20">
									<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
										<g>
											<g>
												<g>
													<path class="st5" d="M19.9,10.4c-2.5,0-4.6-2-4.6-4.6s2-4.6,4.6-4.6s4.6,2,4.6,4.6S22.4,10.4,19.9,10.4z M19.9,3.4
														c-1.3,0-2.4,1.1-2.4,2.4c0,1.3,1.1,2.4,2.4,2.4s2.4-1.1,2.4-2.4C22.3,4.5,21.2,3.4,19.9,3.4z"/>
												</g>
												<g>
													<path class="st5" d="M23.9,24.3c-0.3,0-0.7-0.2-0.9-0.4l-3.3-4.5l-2.2,2.8c-0.2,0.3-0.6,0.4-0.9,0.4c-0.4,0-0.7-0.2-0.9-0.5
														L7.9,8.5l-5.8,9.4c-0.3,0.5-1,0.7-1.5,0.4c-0.5-0.3-0.7-1-0.4-1.5L7,5.8c0.2-0.3,0.6-0.5,0.9-0.5c0.4,0,0.7,0.2,0.9,0.5l8,13.7
														l2.1-2.7c0.2-0.3,0.5-0.4,0.9-0.4c0.3,0,0.7,0.2,0.9,0.4l4.1,5.7c0.4,0.5,0.2,1.2-0.2,1.5C24.3,24.2,24.1,24.3,23.9,24.3z"/>
												</g>
											</g>
										</g>
									</svg>
									<div>
										<p class="hideShow">visuels</p>
									</div>
								</div>
							</div>
							<div class="flex bgWhite">
								<p class="cGris mb0"><?php if($like > 1){
									echo '<span>'.$like.'</span> Likes';
								}else{
									echo '<span>'.$like.'</span> Like';	
								}
								?></p>
								<p class="cGris mb0"><span><?php echo $favV ?></span> Favoris</p>
								<p class="cGris mb0"><?php if($comV > 1){
									echo '<span>'.$comV.'</span> Commentaires';
								}else{
									echo '<span>'.$comV.'</span> Commentaire';	
								}
								?></p>
							</div>
						</div>
						<div class="flex fdC mb30">
							<div class="flex">
								<div class="mAuto flex mb20">
									<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
										<g>
											<g>
												<g>
													<path class="st5" d="M22.2,23.5c-0.6,0-1.2-0.5-1.2-1.2V12.3c-1.7,0.2-5.1,1-7.7,3.5c-0.5,0.4-1.2,0.4-1.6,0
														c-2.5-2.5-5.9-3.2-7.7-3.4v10.1c0,0.6-0.5,1.2-1.2,1.2S1.7,23,1.7,22.4V11c0-0.6,0.5-1.2,1.2-1.2c0.2,0,5.6,0,9.7,3.5
														c4.3-3.4,9.4-3.5,9.7-3.5c0.6,0,1.2,0.5,1.2,1.2v11.4C23.4,23,22.9,23.5,22.2,23.5z"/>
												</g>
												<g>
													<ellipse class="st5" cx="2.9" cy="16.8" rx="1.5" ry="2.2"/>
													<path class="st5" d="M2.9,20.1c-1.5,0-2.6-1.5-2.6-3.3s1.1-3.3,2.6-3.3s2.6,1.5,2.6,3.3S4.3,20.1,2.9,20.1z M2.9,17.8L2.9,17.8
														L2.9,17.8z M2.9,15.8c-0.1,0.1-0.3,0.5-0.3,1s0.2,0.8,0.3,1c0.1-0.1,0.3-0.5,0.3-1S3,16,2.9,15.8z"/>
												</g>
												<g>
													<ellipse class="st5" cx="22.2" cy="16.8" rx="1.5" ry="2.2"/>
													<path class="st5" d="M22.2,20.1c-1.5,0-2.6-1.5-2.6-3.3s1.1-3.3,2.6-3.3s2.6,1.5,2.6,3.3S23.7,20.1,22.2,20.1z M22.3,17.8
														L22.3,17.8L22.3,17.8z M22.2,15.8c-0.1,0.1-0.3,0.5-0.3,1s0.2,0.8,0.3,1c0.1-0.1,0.3-0.5,0.3-1S22.3,16,22.2,15.8z"/>
												</g>
												<g>
													<path class="st5" d="M18.6,9.6c-0.6,0-1.2-0.5-1.2-1.2c0-2.6-2.1-4.6-4.6-4.6S8.1,5.9,8.1,8.4c0,0.6-0.5,1.2-1.2,1.2
														S5.8,9.1,5.8,8.4c0-3.8,3.1-7,7-7s7,3.1,7,7C19.7,9.1,19.2,9.6,18.6,9.6z"/>
												</g>
											</g>
										</g>
									</svg>
									<div>
										<p class="hideShow">tutoriaux</p>
									</div>
								</div>
							</div>
							<div class="flex bgWhite">
								<p class="cGris mb0"><?php if($note > 1){
									echo '<span>'.$note.'</span> Notes';
								}else{
									echo '<span>'.$note.'</span> Note';	
								}
								?></p>
								<p class="cGris mb0"><span><?php echo $favT ?></span> Favoris</p>
								<p class="cGris mb0"><?php if($comV > 1){
									echo '<span>'.$comT.'</span> Commentaires';
								}else{
									echo '<span>'.$comT.'</span> Commentaire';	
								}
								?></p>
							</div>
						</div>
						
						<div class="flex fdC mb30">
							<div class="flex">
								<div class="mAuto flex mb20">
									<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
										<g>
											<g>
												<g>
													<path class="st5" d="M21.9,22.6H3.2c-0.7,0-1.2-0.5-1.2-1.2v-9.6c0-0.7,0.5-1.2,1.2-1.2h18.7c0.7,0,1.2,0.5,1.2,1.2v9.7
														C23,22.1,22.5,22.6,21.9,22.6z M4.4,20.3h16.4V13H4.4V20.3z"/>
												</g>
												<g>
													<path class="st5" d="M19.3,8.7H5.7C5,8.7,4.5,8.2,4.5,7.5S5,6.3,5.7,6.3h13.5c0.7,0,1.2,0.5,1.2,1.2S20,8.7,19.3,8.7z"/>
												</g>
												<g>
													<path class="st5" d="M15.8,4.7H9.2C8.6,4.7,8,4.2,8,3.5s0.5-1.2,1.2-1.2h6.7c0.7,0,1.2,0.5,1.2,1.2S16.5,4.7,15.8,4.7z"/>
												</g>
											</g>
										</g>
									</svg>
									<div>
										<p class="hideShow">abonnements</p>
									</div>
								</div>
							</div>
							<div class="flex bgWhite">
								<p class="cGris mAuto mb0"><?php if($abos > 1){
									echo '<span>'.$abos.'</span> Abonnements';
								}else{
									echo '<span>'.$abos.'</span> Abonnement';	
								}
								?></p>
							</div>
						</div>
						
					</div>
				</div>
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
				<p class="titre2 mb40 alignCenter">Modifier mon avatar</p>
				<p class="mb80">Sélèctionner un fichier .jpg ou .png (max 2mo) et charger l'image.</p>
				<?php echo $result["form"][1]->getForm(); ?>
			</div>
		</div>
	</div>
	<?php if(isset($result['chaine'])): ?>
		<div id="modale-quitteChaine">
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
					<p class="titre2 mb40 alignCenter">Souhaitez-vous réellement quitter la chaine <?php echo $result['chaine']->getNomChaine() ?> ?</p>
					<ul class="mb40">
						<li class="txt14 mb10">En quittant la chaine, vous ne pourrez plus accéder aux fonctionnalités lié à celle-ci et perdrez l'enssemble des contenu postés.</li>
						<li class="txt14 mb10">Si, dans le futur, vous souhaitiez créer une nouvelle chaine, cela restera possible. Mais vous ne pourriez pas retrouver d'informations concernant votre ancienne chaine.</li>
					</ul>
						<a href="quitter-chaine" title="Je souhaite quitter la chaine <?php echo $result['chaine']->getNomChaine() ?> et toutes les informations la concernant" class="a-link cRouge alignCenter mb20 txt14">Confirmer</a>
						<button title="Je ne souhaite pas quitter la chaine pour le moment" class="annul btnV"><p>Annuler</p></button>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div id="modale-supprCompte">
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
				<p class="titre2 mb40 alignCenter">Souhaitez-vous réellement supprimer votre compte ?</p>
				<ul class="mb40">
					<li class="txt14 mb10">La suppression de votre compte sera définitive.</li>
					<li class="txt14 mb10">En supprimant votre compte, vous ne pourrez donc plus accéder aux fonctionnalités d'utilisateur authentifié.</li>
					<li class="txt14 mb10">Si, dans le futur, vous souhaitiez vous réinscrire, cela restera possible. Mais vous ne pourriez pas retrouver d'informations concernant votre ancien compte.</li>
				</ul>
					<a href="supprimer-compte" title="Je souhaite supprimer définitivement mon compte et toutes les informations le concernant" class="a-link cRouge alignCenter mb20 txt14">Confirmer la suppression</a>
					<button title="Je ne souhaite pas supprimer mon compte pour le moment" class="annul btnV"><p>Annuler la suppression</p></button>
			</div>
		</div>
	</div>
<?php endif; ?>
<script src="<?php echo DOMAINE; ?>templates/front/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/toggle-nav.js"></script>