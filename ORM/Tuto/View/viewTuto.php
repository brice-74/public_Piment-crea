<?php 
use Vendors\LandingPage\LandingPage;
use Vendors\DateTime\DateTimeTransform;
$transformDate = new DateTimeTransform();
if(isset($result)): ?>
	<div class="visuel-container">
		<div style="background-image: url('medias/chaine/id-<?php echo $result['chaine']->getIdChaine(); ?>/tuto-<?php echo $result['tuto']->getIdTuto(); ?>/<?php echo $result['tuto']->getVisuelTuto(); ?>')">
			<img class="img-visuel"  src="medias/chaine/id-<?php echo $result['chaine']->getIdChaine(); ?>/tuto-<?php echo $result['tuto']->getIdTuto(); ?>/<?php echo $result['tuto']->getVisuelTuto(); ?>" alt="">
		</div>
	</div>
	<?php 
		$page = new LandingPage();
		if($page->existPage()){
			$direction = $page->getPage();
		}else{
			$direction = "index";
		}
	?>
	<a href="<?php echo DOMAINE.$direction ?>" class="retour3 cWhite bold Iflex pl10">
		<svg class="mr10" version="1.1" viewBox="0 0 512.011 512.011" xml:space="preserve">
			<g>
				<g>
					<path d="M505.755,123.592c-8.341-8.341-21.824-8.341-30.165,0L256.005,343.176L36.421,123.592c-8.341-8.341-21.824-8.341-30.165,0
						s-8.341,21.824,0,30.165l234.667,234.667c4.16,4.16,9.621,6.251,15.083,6.251c5.462,0,10.923-2.091,15.083-6.251l234.667-234.667
						C514.096,145.416,514.096,131.933,505.755,123.592z"/>
				</g>
			</g>
		</svg>
		<p class="mAuto txt12 ml0">Retour</p>
	</a>
	<div class="main-container-maxxx">
		<div class="flex pt15 pb15">
			<a href="chaine-<?php echo $result['chaine']->getIdChaine() ?>-<?php echo $result['chaine']->getNomChaine() ?>/tutos" class="p0 container-avatar-moy"
				<?php if(is_null($result["chaine"]->getAvatarChaine())): ?>
					style="background-image:url(templates/front/img/piment.jpg);"
				<?php else: ?>
					style="background-image:url(medias/chaine/id-<?php echo $result['chaine']->getIdChaine(); ?>/avatars/<?php echo $result['chaine']->getAvatarChaine(); ?>);"
				<?php endif; ?> 
			>
				<img class="img-visuel mb5" 
				<?php if(is_null($result["chaine"]->getAvatarChaine())): ?>
					src="templates/front/img/piment.jpg"
				<?php else: ?>
					src="medias/chaine/id-<?php echo $result['chaine']->getIdChaine(); ?>/avatars/<?php echo $result['chaine']->getAvatarChaine(); ?>"
				<?php endif; ?> 
				alt="Image de chaine">
			</a>
			<div class="mAuto0 ml20 nameChannel">
				<p class="txt16 mb5 bold"><?php echo $result["chaine"]->getNomChaine(); ?></p>
				<p class="txt12 cGris mb0"><?php echo $transformDate->transformDateTime($result["tuto"]->getDatePostTuto()); ?></p>
			</div>
			<div class="mlAuto flex" moynote>
				<?php if(isset($result['moy'])):?>
					<div class="mAuto flex">
						<p class="cGris txt12 mAuto">Note</p>
						<p class="mAuto ml10 txt14 cBleu bold"><?php echo $result['moy']; ?></p>
						<p class="cGris txt12 mAuto">/10</p>			
					</div>
				<?php else: ?>
					<p class="cGris mAuto txt12">Aucune note</p>
				<?php endif; ?>
			</div>
			<div class="posR ml10 flex">
				<button class="point3 mAuto">
				<svg version="1.1" viewBox="0 0 3 25" xml:space="preserve">
					<g>
						<circle class="st0" cx="2.5" cy="2.5" r="2.5"/>
						<circle class="st0" cx="2.5" cy="11.5" r="2.5"/>
						<circle class="st0" cx="2.5" cy="20.6" r="2.5"/>
					</g>
				</svg>
			</button>
			<div class="optionPost">
				<button class="fav flex
				<?php if(isset($result["favoris"])){
					foreach ($result["favoris"] as $fav) {
						if($fav->getTutoIdTuto() == $result['tuto']->getIdTuto()){
							echo 'favorited';
						}
					}
				}
				?>" title="
				<?php if(isset($result["favoris"])){
						$nb = 0;
						foreach ($result["favoris"] as $fav) {
							if($fav->getTutoIdTuto() == $result['tuto']->getIdTuto()){
								echo 'Retirer des favoris';
								$nb ++;
							}
						}
						if($nb == 0){
							echo 'Ajouter aux favoris';
						}
					} else{
						echo 'Ajouter aux favoris';
					}
					?>"
					ajax="favorisTuto" datas="<?php echo $result['tuto']->getIdTuto(); ?>"
				>
					<svg class="ml5" version="1.1" viewBox="0 0 25 25" xml:space="preserve">
						<g>
							<g>
								<g>
									<path class="st0" d="M5.6,24.5c-0.3,0-0.5-0.1-0.7-0.2c-0.4-0.3-0.6-0.7-0.5-1.2l1.2-7l-5.1-5C0.1,10.7,0,10.2,0.2,9.8
										C0.3,9.3,0.7,9,1.2,9l7.1-1l3.2-6.4c0.2-0.4,0.6-0.7,1.1-0.7c0.5,0,0.9,0.3,1.1,0.7l3.2,6.4l7.1,1c0.5,0.1,0.8,0.4,1,0.8
										c0.1,0.4,0,0.9-0.3,1.3l-5.1,5l1.2,7c0.1,0.5-0.1,0.9-0.5,1.2c-0.4,0.3-0.9,0.3-1.3,0.1l-6.3-3.3l-6.3,3.3
										C6,24.5,5.8,24.5,5.6,24.5z M12.5,18.4c0.2,0,0.4,0,0.6,0.1l4.7,2.5l-0.9-5.2c-0.1-0.4,0.1-0.8,0.4-1.1L21,11l-5.2-0.8
										c-0.4-0.1-0.7-0.3-0.9-0.7l-2.3-4.8l-2.3,4.8C10,10,9.6,10.2,9.2,10.3L4,11l3.8,3.7c0.3,0.3,0.4,0.7,0.4,1.1l-0.9,5.2l4.7-2.5
										C12.1,18.5,12.3,18.4,12.5,18.4z"/>
								</g>
							</g>
						</g>
					</svg>
					<p txt-fav class="cWhite txt12 ml10 mr10 mbAuto mtAuto">
					<?php if(isset($result["favoris"])){
						$nb = 0;
						foreach ($result["favoris"] as $fav) {
							if($fav->getTutoIdTuto() == $result['tuto']->getIdTuto()){
								echo 'Retirer&nbspdes&nbspfavoris';
								$nb ++;
							}
						}
						if($nb == 0){
							echo 'Ajouter&nbspaux&nbspfavoris';
						}
					} else{
						echo 'Ajouter&nbspaux&nbspfavoris';
					}
					?>
				</p>
				</button>
				<button class="sig flex" modale="btn-signal" title="signaler un abus" datas="tuto-<?php echo $result['tuto']->getIdTuto() ?>">
					<svg class="ml5" version="1.1" viewBox="0 0 25 25" xml:space="preserve">
						<g>
							<g>
								<path class="st0" d="M7,23c-0.7,0-1.3-0.6-1.3-1.3V3.9c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3v17.8C8.3,22.4,7.7,23,7,23z"/>
							</g>
							<g>
								<path class="st0" d="M18.8,16c-1,0-2.4-0.2-4-1c-1.4-0.7-3.7-0.2-4.4,0.1c-0.7,0.2-1.4-0.1-1.7-0.8c-0.2-0.7,0.1-1.4,0.8-1.7
									c0.4-0.1,3.9-1.4,6.5,0.1c0.8,0.5,1.7,0.6,2.3,0.7v-6c-0.9-0.1-2.2-0.3-3.5-1c-1.4-0.7-3.7-0.2-4.4,0.1C9.8,6.7,9,6.3,8.8,5.7
									C8.5,5,8.9,4.3,9.5,4c0.4-0.1,3.9-1.4,6.5,0.1c1.7,0.9,3.3,0.7,3.3,0.7c0.4-0.1,0.8,0,1.1,0.3c0.3,0.2,0.5,0.6,0.5,1v8.6
									c0,0.6-0.4,1.1-1,1.3C19.8,15.9,19.4,16,18.8,16z"/>
							</g>
						</g>
					</svg>
					<p class="cWhite txt12 ml10 mr5 mbAuto mtAuto">Signaler&nbsple&nbsptuto</p>
				</button>
			</div>
		</div>
	</div>
	<?php if(isset($result['themes'])): ?>
		<div class="ml70 mb5 categs">
		<div class="W100 dpIB">
			<p class="cGris txt12 mb0">THÈME(S)</p>
		</div>
		<?php foreach($result['themes'] as $theme): ?>
			<a href="<?php echo 'tutoriaux+themes_'.$theme->getIdTheme().'+logiciels_+languages_' ?>" class="a-link txt12 catName posR">
				<?php echo $theme->getTitreTheme(); ?>
			</a>
		<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php if(isset($result['logiciels'])): ?>
		<div class="ml70 mb5 categs">
		<div class="W100 dpIB">
			<p class="cGris txt12 mb0">LOGICIEL(S)</p>
		</div>
		<?php foreach($result['logiciels'] as $logiciel): ?>
			<a href="<?php echo 'tutoriaux+themes_+logiciels_'.$logiciel->getIdLogiciel().'+languages_' ?>" class="a-link txt12 catName posR">
				<?php echo $logiciel->getTitreLogiciel(); ?>
			</a>
		<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php if(isset($result['languages'])): ?>
		<div class="ml70 categs">
		<div class="W100 dpIB">
			<p class="cGris txt12 mb0">LANGUAGE(S)</p>
		</div>
		<?php foreach($result['languages'] as $language): ?>
			<a href="<?php echo 'tutoriaux+themes_+logiciels_+languages_'.$language->getIdLanguage() ?>" class="a-link txt12 catName posR">
				<?php echo $language->getTitreLanguage(); ?>
			</a>
		<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<div class="blocContenuTuto mt25 pt20 mb40">
		<?php 
			echo "<h1 class='bold txt22 cBleu mb50'>".$result['tuto']->getTitreTuto()."</h1>";
			$html = preg_replace('/data-text=".*?"|spellcheck=".*?"|style=".*?"|<div class="removeCol"><\/div>/', '', $result['tuto']->getHtmlTuto());
			$html = preg_replace('/<div class="moreCol" >(.*?)<\/div>/', '', $html);
			$html = preg_replace('/contenteditable="true"/', 'contenteditable="false"', $html);
			echo $html;
		?>
	</div>
	<div class="mb60">
		<div txtNote>
			<?php if(isset($result['note'])):?>
				<p class="alignCenter cGris mb10">Tutoriel noté</p>
			<?php else: ?>
				<p class="alignCenter cOrange mb10">Noter se tutoriel</p>
			<?php endif; ?>
		</div>
		<div class="flex">
			<div class="dpIB notes mAuto" ajax="note" datas="<?php echo $result['tuto']->getIdTuto(); ?>">
				<?php
					$btn = 0;
					while($btn < 10):
						$btn++;
				?>
					<button val="<?php echo $btn ?>"
						<?php 
							if(isset($result['note'])){
								if($result['note'][0]->getPostNote() == $btn){
									echo 'selected';
								}
							}
						?>
					><?php echo $btn ?></button>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
	<div id="bloc-com" class="blocCommentaire pt10 pb10">
		<p class="cGris txt16 alignRight" count-com>
		<?php if($result['countCom']['nb_com'] > 1): ?>
			<?php echo $result['countCom']['nb_com']; ?> commentaires</p>
		<?php else: ?>
			<?php echo $result['countCom']['nb_com']; ?> commentaire</p>
		<?php endif; ?>
		<div class="flex">
			<div class="p0 container-avatar-min2 mr10"
			<?php if(isset($_SESSION["auth"])): ?>
				<?php if(is_null($_SESSION["auth"]["avatar"])): ?>
					style="background-image:url(templates/front/img/piment.jpg);"
				<?php else: ?>
					style="background-image:url(medias/user/id-<?php echo $_SESSION['auth']['id']; ?>/avatars/<?php echo $_SESSION['auth']['avatar']; ?>);"
				<?php endif; ?>
			<?php else: ?> 
				style="background-image:url(templates/front/img/pimentC.jpg);"
			<?php endif; ?>
			></div>
			<div editCom class="mb0 p5 pl0" spellcheck="false" contenteditable="true" data-text="Laisser un commentaire"></div>
		</div>
		<div class="flex pt5 pb5 mb10" ajax="commentaire" datas="<?php echo $result['tuto']->getIdTuto(); ?>">
			<button class="p5-15 m0 mlAuto a-link"><p class="txt12 mb0" annulCom>ANNULER</p></button>
			<button class="btnB m0 p5-15"><p class="txt12 mb0" postCom>POSTER</p></button>
		</div>
		<div class="commentList">
			<?php if(!is_null($result['commentaires'])): ?>
				<?php foreach ($result['commentaires'] as $commentaire):?>
					<div id="commentaire-<?php echo $commentaire->getIdCommentaire(); ?>" 
					<?php 
					if(isset($_SESSION['authChaine'])){
						if(($result['chaine']->getIdChaine() == $_SESSION['authChaine']['id'])&&($commentaire->getNewPostCommentaire() == 1)){
							echo "new";
						}
					}
					?>
					>
						<div class="signalCom">
							<?php if(isset($_SESSION['auth'])): ?>
								<?php if($_SESSION['auth']['id'] == $commentaire->getUserIdUser()): ?>
									<button class="suppC s2 mAuto0 ml10" title="supprimer le commentaire">
										<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
											<g>
												<path class="st0" d="M21.8,4.8h-4.1V3.5c0-1.1-0.9-1.9-1.9-1.9H9.3c-1.1,0-1.9,0.9-1.9,1.9v1.4H3.2c-0.8,0-1.4,0.6-1.4,1.4
												c0,0.8,0.6,1.4,1.4,1.4H4l1.3,14.6c0.1,1,1,1.8,1.9,1.8h10.5c1,0,1.8-0.8,1.9-1.8L21,7.6h0.8c0.8,0,1.4-0.6,1.4-1.4
												C23.1,5.4,22.5,4.8,21.8,4.8z M10.1,4.8V4.2h4.8v0.6H10.1z M18.2,7.6L17,21.2H8L6.8,7.6H18.2z"/>
										</svg>
									</button>
								<?php else: ?>
									<button class="signal mAuto0 ml10" modale="btn-signal" title="signaler un abus" datas="commentaire-<?php echo $commentaire->getIdCommentaire() ?>">
										<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
											<g>
												<g>
													<path class="st0" d="M7,23c-0.7,0-1.3-0.6-1.3-1.3V3.9c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3v17.8C8.3,22.4,7.7,23,7,23z"/>
												</g>
												<g>
													<path class="st0" d="M18.8,16c-1,0-2.4-0.2-4-1c-1.4-0.7-3.7-0.2-4.4,0.1c-0.7,0.2-1.4-0.1-1.7-0.8c-0.2-0.7,0.1-1.4,0.8-1.7
														c0.4-0.1,3.9-1.4,6.5,0.1c0.8,0.5,1.7,0.6,2.3,0.7v-6c-0.9-0.1-2.2-0.3-3.5-1c-1.4-0.7-3.7-0.2-4.4,0.1C9.8,6.7,9,6.3,8.8,5.7
														C8.5,5,8.9,4.3,9.5,4c0.4-0.1,3.9-1.4,6.5,0.1c1.7,0.9,3.3,0.7,3.3,0.7c0.4-0.1,0.8,0,1.1,0.3c0.3,0.2,0.5,0.6,0.5,1v8.6
														c0,0.6-0.4,1.1-1,1.3C19.8,15.9,19.4,16,18.8,16z"/>
												</g>
											</g>
										</svg>
									</button>
								<?php endif; ?>
							<?php else: ?>
								<button class="signal mAuto0 ml10" modale="btn-signal" title="signaler un abus" datas="commentaire-<?php echo $commentaire->getIdCommentaire() ?>">
									<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
										<g>
											<g>
												<path class="st0" d="M7,23c-0.7,0-1.3-0.6-1.3-1.3V3.9c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3v17.8C8.3,22.4,7.7,23,7,23z"/>
											</g>
											<g>
												<path class="st0" d="M18.8,16c-1,0-2.4-0.2-4-1c-1.4-0.7-3.7-0.2-4.4,0.1c-0.7,0.2-1.4-0.1-1.7-0.8c-0.2-0.7,0.1-1.4,0.8-1.7
													c0.4-0.1,3.9-1.4,6.5,0.1c0.8,0.5,1.7,0.6,2.3,0.7v-6c-0.9-0.1-2.2-0.3-3.5-1c-1.4-0.7-3.7-0.2-4.4,0.1C9.8,6.7,9,6.3,8.8,5.7
													C8.5,5,8.9,4.3,9.5,4c0.4-0.1,3.9-1.4,6.5,0.1c1.7,0.9,3.3,0.7,3.3,0.7c0.4-0.1,0.8,0,1.1,0.3c0.3,0.2,0.5,0.6,0.5,1v8.6
													c0,0.6-0.4,1.1-1,1.3C19.8,15.9,19.4,16,18.8,16z"/>
											</g>
										</g>
									</svg>
								</button>
							<?php endif; ?>
						</div>
						<div class="flex mb5">
							<div class="p0 container-avatar-min2 mr10"
								<?php if(is_null($commentaire->avatar_user)): ?>
									style="background-image:url(templates/front/img/piment.jpg);"
								<?php else: ?>
									style="background-image:url(medias/user/id-<?php echo $commentaire->id_user ?>/avatars/<?php echo $commentaire->avatar_user ?>);"
								<?php endif; ?>
							></div>
							<div>
								<p class="txt12 bold"><?php echo $commentaire->nom_user." ".$commentaire->prenom_user ?></p>
								<p class="cGris txt12"><?php echo $transformDate->transformDateTime($commentaire->getDateCommentaire()); ?></p>
							</div>
						</div>
						<div class="ml42"><?php echo $commentaire->getContenuCommentaire(); ?></div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<div id="modale-signal" datas="no">
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
			<p class="titre2 mb60 alignCenter">Décrivez ce qui vous a choqué</p>
			
				<div editSig class="mb10 p5 pl0" spellcheck="false" contenteditable="true" data-text="Objet du signalement"></div>

				<button subSig class="btnB w100"><p class="txt16">Signaler</p></button>
			
		</div>
	</div>
</div>
<?php endif; ?>
<script src="<?php echo DOMAINE; ?>templates/front/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/toggle-nav.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxNote.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxFavorisTuto.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxCommentaireTuto.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxSignal.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/scroll-anim.js"></script>