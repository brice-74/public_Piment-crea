<?php 
use Vendors\DateTime\DateTimeTransform;
$transformDate = new DateTimeTransform(); 

if(isset($result)): ?>
	<div class="main-container-min m-10">
		<div id="trieSelect" class="close">
			<div id="filtrage">
				<div></div>
				<div></div>
			</div>
			<?php echo $result["form"][1]->getForm(); ?>
		</div>
		<div class="flex flex-wrap"  id="myapp">
			<?php if(isset($result["visuels"])):?>
				<?php if(is_array($result["visuels"])):?>
					<?php foreach ($result["visuels"] as $visuel): ?>
					 	<div class="container-bloc p10 dpIB">
						 	<div class="container-visuels">
							 	<a class="p0" href="<?php echo DOMAINE ?>visuel-<?php echo $visuel->getIdVisuel(); ?>-<?php echo preg_replace("/.jpg$|.jpeg$|.png$/", '', $visuel->getVisuelVisuel()) ?>"
							 		<?php echo "style=\"background-image:url(".DOMAINE."medias/chaine/id-".$visuel->id_chaine."/visuel/min-".$visuel->getVisuelVisuel().")\""?> 
							 	>
									<img class="img-visuel" src="
									<?php echo DOMAINE?>medias/chaine/id-<?php echo $visuel->id_chaine ?>/visuel/min-<?php echo $visuel->getVisuelVisuel() ?>"
									>
								</a>
							</div>
							<div class="flex pb5 pt5">
								<a href="chaine-<?php echo $visuel->id_chaine ?>-<?php echo $visuel->nom_chaine ?>/visuels" class="p0 container-avatar-min posR t0 l0"
									<?php if(is_null($visuel->avatar_chaine)): ?>
										style="background-image:url(templates/front/img/piment.jpg);"
									<?php else: ?>
										style="background-image:url(medias/chaine/id-<?php echo $visuel->id_chaine; ?>/avatars/<?php echo $visuel->avatar_chaine; ?>);"
									<?php endif; ?> 
								>
									<img class="img-visuel mb5" 
									<?php if(is_null($visuel->avatar_chaine)): ?>
										src="templates/front/img/piment.jpg"
									<?php else: ?>
										src="medias/chaine/id-<?php echo $visuel->id_chaine; ?>/avatars/<?php echo $visuel->avatar_chaine; ?>"
									<?php endif; ?> 
									alt="Image de chaine">
								</a>
								<div class="mAuto0 ml10 cutBox1">
									<p class="mb0 bold"><?php echo $visuel->nom_chaine; ?></p>


									<p class="txt12 cGris mb0"><?php echo $transformDate->transformDateTime($visuel->getDatePostVisuel()); ?></p>
								</div>
								<div class="mt5 mlAuto">
									<button class="like-min mlAuto mAuto0 flex p0 
										<?php if(isset($result["likes"])){
											foreach ($result["likes"] as $like) {
												if($like->getVisuelIdVisuel() == $visuel->getIdVisuel()){
													echo 'liked';
												}
											}
										} 
										?>" ajax="like" datas="<?php echo $visuel->getIdVisuel(); ?>">
										<p class="cGris bold mtAuto mb0 mr10" count-like><?php 
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
										?></p>
										<svg version="1.1" viewBox="0 0 35 35" xml:space="preserve">
											<g>
												<g>
													<path class="st0" d="M2.3,31.1c-0.7,0-1.3-0.6-1.3-1.3V13.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3v16.7C3.6,30.5,3,31.1,2.3,31.1
														z"/>
												</g>
												<path class="st0" d="M26.9,11.9H16.6c0.8-5.4,0.2-8.8-1.7-10.4c-1.2-1.1-2.7-0.9-3.4-0.7c-0.4,0.1-0.7,0.4-0.8,0.8L6.8,12.7
													c0,0.1-0.1,0.3-0.1,0.4v16.9c0,0.1,0,0.1,0,0.2c0,0.7,0.6,1.3,1.3,1.3H8h11.2h0.1c3,0,5.5-1,7.4-2.9c3.6-3.6,4.1-9.6,4-12.9
													C30.8,13.6,29,11.9,26.9,11.9z M24.9,26.9c-1.3,1.3-3.1,2-5.2,2.1H9.3V13.4l3.6-10.2c0.1,0,0.3,0.1,0.4,0.2
													c0.4,0.4,1.8,2.2,0.5,9.5c-0.1,0.4,0,0.8,0.3,1.1c0.2,0.3,0.6,0.5,1,0.5h11.8c0.7,0,1.3,0.6,1.3,1.3C28.2,18.7,27.8,24,24.9,26.9z"
													/>
											</g>
										</svg>
									</button>
								</div>
								<div class="posR">
									<button class="point3">
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
												if($fav->getVisuelIdVisuel() == $visuel->getIdVisuel()){
													echo 'favorited';
												}
											}
										}
										?>" title="
										<?php if(isset($result["favoris"])){
												$nb = 0;
												foreach ($result["favoris"] as $fav) {
													if($fav->getVisuelIdVisuel() == $visuel->getIdVisuel()){
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
											ajax="favoris" datas="<?php echo $visuel->getIdVisuel(); ?>"
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
													if($fav->getVisuelIdVisuel() == $visuel->getIdVisuel()){
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
										<button class="sig flex" modale="btn-signal" title="signaler un abus" datas="visuel-<?php echo $visuel->getIdVisuel(); ?>">
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
											<p class="cWhite txt12 ml10 mr5 mbAuto mtAuto">Signaler&nbsple&nbspvisuel</p>
										</button>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<p class="cGris"><?php echo $result["visuels"]; ?></p>
				<?php endif; ?>
			<?php endif; ?>
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
<!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>-->
<script src="<?php echo DOMAINE; ?>templates/front/js/toggle-nav.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxScrollLoadVisu.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxLike.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxFavoris.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxSignal.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/scroll-anim.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/select.js"></script>
