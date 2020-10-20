<?php use Vendors\DateTime\DateTimeTransform;
$transformDate = new DateTimeTransform(); 
if(isset($result)): ?>
	<div class="posR">
		<div class="img-bandeau open"
		<?php 
			if(!is_null($result["chaine"]->getVisuelChaine())) echo "style=\"background-image:url(".DOMAINE."medias/chaine/id-".$result["chaine"]->getIdChaine()."/bandeau/".$result["chaine"]->getVisuelChaine().");\""
		?>
		></div>
		<div class="reseaux">
			<?php if(!empty($result["chaine"]->getLienFbChaine())): ?>
				<a class="p10 dpIB" href="<?php echo $result["chaine"]->getLienFbChaine(); ?>">
					<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
						<path class="st0" d="M19.6,2.8H5.4c-1.4,0-2.6,1.2-2.6,2.6v14.2c0,1.4,1.2,2.6,2.6,2.6h7l0-7h-1.8c-0.2,0-0.4-0.2-0.4-0.4l0-2.2
						c0-0.2,0.2-0.4,0.4-0.4h1.8V10c0-2.5,1.5-3.9,3.8-3.9H18c0.2,0,0.4,0.2,0.4,0.4v1.9c0,0.2-0.2,0.4-0.4,0.4l-1.1,0
						c-1.2,0-1.5,0.6-1.5,1.4v1.9h2.7c0.3,0,0.5,0.2,0.4,0.5l-0.3,2.2c0,0.2-0.2,0.4-0.4,0.4h-2.4l0,7h4.2c1.4,0,2.6-1.2,2.6-2.6V5.4
						C22.2,3.9,21.1,2.8,19.6,2.8z"/>
					</svg>
				</a>
			<?php endif; ?>
			<?php if(!empty($result["chaine"]->getLienInChaine())): ?>
				<a class="p10 dpIB" href="<?php echo $result["chaine"]->getLienInChaine(); ?>">
					<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
						<path class="st0" d="M20.5,2.8H4.5c-1,0-1.8,0.8-1.8,1.8v15.9c0,1,0.8,1.8,1.8,1.8h15.9c1,0,1.8-0.8,1.8-1.8V4.5
						C22.2,3.6,21.4,2.8,20.5,2.8z M8.8,19.6c0,0.3-0.2,0.5-0.5,0.5H6.1c-0.3,0-0.5-0.2-0.5-0.5v-9.1c0-0.3,0.2-0.5,0.5-0.5h2.2
						c0.3,0,0.5,0.2,0.5,0.5V19.6z M7.2,9.1C6,9.1,5.1,8.1,5.1,7S6,4.9,7.2,4.9S9.3,5.8,9.3,7S8.3,9.1,7.2,9.1z M20.2,19.6
						c0,0.3-0.2,0.5-0.5,0.5h-2.3c-0.3,0-0.5-0.2-0.5-0.5v-4.3c0-0.6,0.2-2.8-1.7-2.8c-1.4,0-1.7,1.5-1.8,2.1v4.9c0,0.3-0.2,0.5-0.5,0.5
						h-2.3c-0.3,0-0.5-0.2-0.5-0.5v-9.2c0-0.3,0.2-0.5,0.5-0.5H13c0.3,0,0.5,0.2,0.5,0.5v0.8c0.5-0.8,1.3-1.4,3-1.4
						c3.7,0,3.7,3.5,3.7,5.4V19.6L20.2,19.6z"/>
					</svg>
				</a>
			<?php endif; ?>
			<?php if(!empty($result["chaine"]->getLienYtbChaine())): ?>
				<a class="p10 dpIB" href="<?php echo $result["chaine"]->getLienYtbChaine(); ?>">
					<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
						<path class="st0" d="M19.4,4.2H5.6c-2.7,0-4.9,2.2-4.9,4.9v6.9c0,2.7,2.2,4.9,4.9,4.9h13.7c2.7,0,4.9-2.2,4.9-4.9V9.1
						C24.2,6.4,22.1,4.2,19.4,4.2z M16.1,12.8l-6.4,3.1c-0.2,0.1-0.4,0-0.4-0.2V9.3c0-0.2,0.2-0.3,0.4-0.2l6.4,3.3
						C16.3,12.5,16.3,12.7,16.1,12.8z"/>
					</svg>
				</a>
			<?php endif; ?>
			<?php if(!empty($result["chaine"]->getLienTwChaine())): ?>
				<a class="p10 dpIB" href="<?php echo $result["chaine"]->getLienTwChaine(); ?>">
					<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
						<path class="st0" d="M22.6,5.8c-0.5,0.2-0.9,0.4-1.4,0.5c0.5-0.5,1-1.2,1.2-1.9l0,0C22.4,4.2,22.2,4,22,4.2l0,0
						c-0.7,0.4-1.4,0.7-2.2,0.9c0,0-0.1,0-0.1,0c-0.1,0-0.3-0.1-0.4-0.1c-0.8-0.7-1.9-1.1-3-1.1c-0.5,0-1,0.1-1.4,0.2
						c-1.5,0.5-2.6,1.7-2.9,3.1c-0.1,0.6-0.2,1.1-0.1,1.7c0,0.1,0,0.1,0,0.1c0,0-0.1,0.1-0.1,0.1c0,0,0,0,0,0C8.5,8.7,5.6,7.2,3.5,4.7
						l0,0c-0.1-0.1-0.3-0.1-0.4,0l0,0C2.7,5.4,2.5,6.2,2.5,7c0,1.2,0.5,2.4,1.3,3.2c-0.4-0.1-0.7-0.2-1-0.4l0,0c-0.2-0.1-0.3,0-0.4,0.2
						l0,0c0,1.8,1,3.4,2.6,4.2c0,0-0.1,0-0.1,0c-0.3,0-0.5,0-0.8-0.1l0,0C4.1,14,4,14.2,4,14.4l0,0c0.5,1.6,1.9,2.8,3.6,3.1
						c-1.4,0.9-3,1.4-4.7,1.4l-0.5,0c-0.2,0-0.3,0.1-0.3,0.3c0,0.2,0,0.3,0.2,0.4c1.9,1.1,4,1.7,6.2,1.7c1.9,0,3.7-0.4,5.3-1.1
						c1.5-0.7,2.8-1.7,3.9-2.9c1-1.2,1.8-2.5,2.4-4c0.5-1.4,0.8-2.9,0.8-4.4V8.7c0-0.2,0.1-0.4,0.3-0.6c0.7-0.6,1.3-1.2,1.8-2l0,0
						C23,6,22.8,5.7,22.6,5.8L22.6,5.8z"/>
					</svg>
				</a>
			<?php endif; ?>
			<?php if(!empty($result["chaine"]->getLienInstaChaine())): ?>
				<a class="p10 dpIB" href="<?php echo $result["chaine"]->getLienInstaChaine(); ?>">
					<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
						<path class="st0" d="M16.4,2.8H8.6c-3.2,0-5.8,2.6-5.8,5.8v7.9c0,3.2,2.6,5.8,5.8,5.8h7.9c3.2,0,5.8-2.6,5.8-5.8V8.6
							C22.2,5.4,19.6,2.8,16.4,2.8z M20.3,16.4c0,2.1-1.7,3.8-3.8,3.8H8.6c-2.1,0-3.8-1.7-3.8-3.8V8.6c0-2.1,1.7-3.8,3.8-3.8h7.9
							c2.1,0,3.8,1.7,3.8,3.8V16.4L20.3,16.4z"/>
						<path class="st0" d="M12.5,7.5c-2.8,0-5,2.3-5,5s2.3,5,5,5s5-2.3,5-5S15.3,7.5,12.5,7.5z M12.5,15.6c-1.7,0-3.1-1.4-3.1-3.1
							s1.4-3.1,3.1-3.1c1.7,0,3.1,1.4,3.1,3.1C15.6,14.2,14.2,15.6,12.5,15.6z"/>
						<circle class="st0" cx="17.5" cy="7.5" r="1.2"/>
					</svg>
				</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="bar-abonnement">
		<div class="main-container-min pt20 flex avatarNomChaine">
			<div class="flex1 flex">
				<div class="container-avatar-max"
				<?php if(is_null($result["chaine"]->getAvatarChaine())): ?>
					style="background-image:url(<?php echo DOMAINE ?>templates/front/img/piment.jpg);"
				<?php else: ?>
					style="background-image:url(<?php echo DOMAINE ?>medias/chaine/id-<?php echo $result['chaine']->getIdChaine(); ?>/avatars/<?php echo $result['chaine']->getAvatarChaine(); ?>);"
				<?php endif; ?> 
				>
					<img class="img-visuel mb5" 
					<?php if(is_null($result["chaine"]->getAvatarChaine())): ?>
						src="<?php echo DOMAINE ?>templates/front/img/piment.jpg"
					<?php else: ?>
						src="<?php echo DOMAINE ?>medias/chaine/id-<?php echo $result['chaine']->getIdChaine(); ?>/avatars/<?php echo $result['chaine']->getAvatarChaine(); ?>"
					<?php endif; ?> 
					alt="Image de chaine">
				</div>
				<div class="mAuto0 ml20">
					<p class="txt22 mb5 bold nameChaine"><?php echo $result["chaine"]->getNomChaine(); ?></p>
					<p class="txt12 cGris mb0">
						<?php 
						if($result['nbAbo']->nbAbo > 1){
							echo "<span class='nbAbo'>".$result['nbAbo']->nbAbo." abonnés / </span>";
						}else{
							echo "<span class='nbAbo'>".$result['nbAbo']->nbAbo." abonné / </span>";
						} 
						if($result['nbTuto']->nbTuto > 1){
							echo "<span class='nbTuto'>".$result['nbTuto']->nbTuto." tutoriaux / </span>";
						}else{
							echo "<span class='nbTuto'>".$result['nbTuto']->nbTuto." tutoriel / </span>";
						} 
						if($result['nbVisu']->nbVisu > 1){
							echo "<span class='nbVisu'>".$result['nbVisu']->nbVisu." visuels</span>";
						}else{
							echo "<span class='nbVisu'>".$result['nbVisu']->nbVisu." visuel</span>";
						} 
						?>
					</p>
				</div>
			</div>
			<div class="flex1 flex">
				<?php 
				$myChaine = false;
					if(isset($_SESSION["authChaine"])){
						if($_SESSION["authChaine"]["id"] == $result["chaine"]->getIdChaine()){
							$myChaine = true;
						}
					}
				?>
				<?php if($myChaine == false): ?>
					<?php if($result["abo"] == false): ?>
						<button ajax="abonnement" datas="<?php echo $result["chaine"]->getIdChaine(); ?>" class="btnO mr0 pl60 btnAbonnement" title="S'abonner à la chaine <?php echo $result['chaine']->getNomChaine(); ?>">
							<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
								<g>
									<g>
										<g>
											<path class="st0" d="M21.9,22.6H3.2c-0.7,0-1.2-0.5-1.2-1.2v-9.6c0-0.7,0.5-1.2,1.2-1.2h18.7c0.7,0,1.2,0.5,1.2,1.2v9.7
												C23,22.1,22.5,22.6,21.9,22.6z M4.4,20.3h16.4V13H4.4V20.3z"/>
										</g>
										<g>
											<path class="st0" d="M19.3,8.7H5.7C5,8.7,4.5,8.2,4.5,7.5S5,6.3,5.7,6.3h13.5c0.7,0,1.2,0.5,1.2,1.2S20,8.7,19.3,8.7z"/>
										</g>
										<g>
											<path class="st0" d="M15.8,4.7H9.2C8.6,4.7,8,4.2,8,3.5s0.5-1.2,1.2-1.2h6.7c0.7,0,1.2,0.5,1.2,1.2S16.5,4.7,15.8,4.7z"/>
										</g>
									</g>
								</g>
							</svg>
							<p class="txtUp">S'abonné</p>
						</button>
					<?php else: ?>
						<button ajax="abonnement" datas="<?php echo $result["chaine"]->getIdChaine(); ?>" class="btnNo mr0 pl60 btnAbonnement" title="Se désabonner de la chaine <?php echo $result['chaine']->getNomChaine(); ?>">
							<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
								<g>
									<g>
										<g>
											<path class="st0" d="M21.9,22.6H3.2c-0.7,0-1.2-0.5-1.2-1.2v-9.6c0-0.7,0.5-1.2,1.2-1.2h18.7c0.7,0,1.2,0.5,1.2,1.2v9.7
												C23,22.1,22.5,22.6,21.9,22.6z M4.4,20.3h16.4V13H4.4V20.3z"/>
										</g>
										<g>
											<path class="st0" d="M19.3,8.7H5.7C5,8.7,4.5,8.2,4.5,7.5S5,6.3,5.7,6.3h13.5c0.7,0,1.2,0.5,1.2,1.2S20,8.7,19.3,8.7z"/>
										</g>
										<g>
											<path class="st0" d="M15.8,4.7H9.2C8.6,4.7,8,4.2,8,3.5s0.5-1.2,1.2-1.2h6.7c0.7,0,1.2,0.5,1.2,1.2S16.5,4.7,15.8,4.7z"/>
										</g>
									</g>
								</g>
							</svg>
							<p class="txtUp">Abonné</p>
						</button>
					<?php endif; ?>
					<button class="signal mAuto0 ml10" modale="btn-signal" title="signaler un abus" datas="chaine-<?php echo $result['chaine']->getIdChaine(); ?>">
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
				<?php else: ?>
					<a href="<?php echo DOMAINE ?>vue-chaine/<?php echo $_SESSION['authChaine']['nom'] ?>" class="btnV mr0 pl60 btnAbonnementAuth" title="Voir les statistiques et les paramètres de la chaine <?php echo $result['chaine']->getNomChaine(); ?>">
						<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve">
							<g>
								<g>
									<path class="st0" d="M5.7,22.8c-0.2,0-0.4-0.1-0.5-0.2c-0.3-0.3-0.3-0.8,0-1.1l8.8-8.8c0.3-0.3,0.8-0.3,1.1,0l2.3,2.3l6.4-6.4
										c0.3-0.3,0.8-0.3,1.1,0l2.4,2.4c0.3,0.3,0.3,0.8,0,1.1c-0.3,0.3-0.8,0.3-1.1,0l-1.9-1.9l-6.4,6.4c-0.3,0.3-0.8,0.3-1.1,0l-2.3-2.3
										l-8.3,8.3C6.1,22.7,5.9,22.8,5.7,22.8z"/>
								</g>
							</g>
						</svg>
						<p>Vue sur la chaine</p>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="bar-nav-chaine pt20 pr80 pl80 flex">
		<nav class="mAuto">
			<ul class="flex">
				<li class="mr5">
					<a href="<?php echo DOMAINE; ?>chaine-<?php echo $result['chaine']->getIdChaine(); ?>-<?php echo $result['chaine']->getNomChaine(); ?>/visuels" class="aleft"  title="Visuels de la chaine"
					<?php 
						if(preg_match("/^\/chaine-(.*)\/visuels$/",$http->getUri())){echo " activ-page";}
					?>
					>
						<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
							<g>
								<g>
									<g>
										<path class="st0" d="M19.9,10.4c-2.5,0-4.6-2-4.6-4.6s2-4.6,4.6-4.6s4.6,2,4.6,4.6S22.4,10.4,19.9,10.4z M19.9,3.4
											c-1.3,0-2.4,1.1-2.4,2.4c0,1.3,1.1,2.4,2.4,2.4s2.4-1.1,2.4-2.4C22.3,4.5,21.2,3.4,19.9,3.4z"/>
									</g>
									<g>
										<path class="st0" d="M23.9,24.3c-0.3,0-0.7-0.2-0.9-0.4l-3.3-4.5l-2.2,2.8c-0.2,0.3-0.6,0.4-0.9,0.4c-0.4,0-0.7-0.2-0.9-0.5
											L7.9,8.5l-5.8,9.4c-0.3,0.5-1,0.7-1.5,0.4c-0.5-0.3-0.7-1-0.4-1.5L7,5.8c0.2-0.3,0.6-0.5,0.9-0.5c0.4,0,0.7,0.2,0.9,0.5l8,13.7
											l2.1-2.7c0.2-0.3,0.5-0.4,0.9-0.4c0.3,0,0.7,0.2,0.9,0.4l4.1,5.7c0.4,0.5,0.2,1.2-0.2,1.5C24.3,24.2,24.1,24.3,23.9,24.3z"/>
									</g>
								</g>
							</g>
						</svg>
						<p class="mr20">Visuels</p>
					</a>
				</li>
				<li class="mr5">
					<a href="<?php echo DOMAINE; ?>chaine-<?php echo $result['chaine']->getIdChaine(); ?>-<?php echo $result['chaine']->getNomChaine(); ?>/tutos" class="aleft"  title="Tutoriaux de la chaine"
					<?php 
						if(preg_match("/^\/chaine-(.*)\/tutos$/",$http->getUri())){echo " activ-page";}
					?>
					>
						<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
							<g>
								<g>
									<g>
										<path class="st0" d="M22.2,23.5c-0.6,0-1.2-0.5-1.2-1.2V12.3c-1.7,0.2-5.1,1-7.7,3.5c-0.5,0.4-1.2,0.4-1.6,0
											c-2.5-2.5-5.9-3.2-7.7-3.4v10.1c0,0.6-0.5,1.2-1.2,1.2S1.7,23,1.7,22.4V11c0-0.6,0.5-1.2,1.2-1.2c0.2,0,5.6,0,9.7,3.5
											c4.3-3.4,9.4-3.5,9.7-3.5c0.6,0,1.2,0.5,1.2,1.2v11.4C23.4,23,22.9,23.5,22.2,23.5z"/>
									</g>
									<g>
										<ellipse class="st0" cx="2.9" cy="16.8" rx="1.5" ry="2.2"/>
										<path class="st0" d="M2.9,20.1c-1.5,0-2.6-1.5-2.6-3.3s1.1-3.3,2.6-3.3s2.6,1.5,2.6,3.3S4.3,20.1,2.9,20.1z M2.9,17.8L2.9,17.8
											L2.9,17.8z M2.9,15.8c-0.1,0.1-0.3,0.5-0.3,1s0.2,0.8,0.3,1c0.1-0.1,0.3-0.5,0.3-1S3,16,2.9,15.8z"/>
									</g>
									<g>
										<ellipse class="st0" cx="22.2" cy="16.8" rx="1.5" ry="2.2"/>
										<path class="st0" d="M22.2,20.1c-1.5,0-2.6-1.5-2.6-3.3s1.1-3.3,2.6-3.3s2.6,1.5,2.6,3.3S23.7,20.1,22.2,20.1z M22.3,17.8
											L22.3,17.8L22.3,17.8z M22.2,15.8c-0.1,0.1-0.3,0.5-0.3,1s0.2,0.8,0.3,1c0.1-0.1,0.3-0.5,0.3-1S22.3,16,22.2,15.8z"/>
									</g>
									<g>
										<path class="st0" d="M18.6,9.6c-0.6,0-1.2-0.5-1.2-1.2c0-2.6-2.1-4.6-4.6-4.6S8.1,5.9,8.1,8.4c0,0.6-0.5,1.2-1.2,1.2
											S5.8,9.1,5.8,8.4c0-3.8,3.1-7,7-7s7,3.1,7,7C19.7,9.1,19.2,9.6,18.6,9.6z"/>
									</g>
								</g>
							</g>
						</svg>
						<p class="mr20">Tutos</p>
					</a>
				</li>
				<li>
					<a href="<?php echo DOMAINE; ?>chaine-<?php echo $result['chaine']->getIdChaine(); ?>-<?php echo $result['chaine']->getNomChaine(); ?>/description" class="aleft"  title="Description de la chaine"
					<?php 
						if(preg_match("/^\/chaine-(.*)\/description$/",$http->getUri())){echo " activ-page";}
					?>
					>
						<svg version="1.1" viewBox="0 0 24 30" xml:space="preserve">
							<g>
								<g>
									<path class="st0" d="M15.2,24.5c-0.9-0.2-1.8,0-2.4,0.7c-0.6,0.6-0.9,1.5-0.7,2.4c0.2,0.9,0.9,1.6,1.8,1.8c0.2,0,0.4,0.1,0.6,0.1
										c0.7,0,1.3-0.3,1.8-0.7c0.6-0.6,0.9-1.5,0.7-2.4C16.8,25.4,16.1,24.7,15.2,24.5z"/>
									<path class="st0" d="M15.8,3c-3.4,0-5.9,1.1-8,3.7C7.6,7,7.5,7.3,7.6,7.7c0,0.4,0.2,0.7,0.5,0.9l0.7,0.6c0.6,0.4,1.4,0.3,1.8-0.2
										c1.2-1.4,2.5-2.3,4.7-2.3c2.3,0,4.8,1.5,4.8,3.7c0,1.9-1.6,2.8-3.2,3.7l-0.1,0.1C14.6,15.4,13,16.4,13,19v2.6
										c0,0.7,0.6,1.3,1.3,1.3h1.1c0.7,0,1.3-0.6,1.3-1.3v-2.4c0-1.1,1.5-1.9,2.8-2.5c0.3-0.2,0.7-0.3,0.9-0.5c1.9-1.1,4.2-2.4,4.2-5.8
										C24.4,6.2,19.9,3,15.8,3z"/>
								</g>
						</svg>
						<p class="mr20">À propos</p>
					</a>
				</li>
			</ul>
		</nav>
	</div>
	<div class="main-container-min m-10 flex flex-wrap">
		<?php if(isset($result["visuels"])): ?>
			<?php if(is_array($result["visuels"])): ?>
				<?php foreach ($result["visuels"] as $visuel):?>
				 	<div class="container-bloc p10 dpIB">
					 	<div class="container-visuels">
						 	<a class="p0" href="<?php echo DOMAINE ?>visuel-<?php echo $visuel->getIdVisuel(); ?>-<?php echo preg_replace("/.jpg$|.jpeg$|.png$/", '', $visuel->getVisuelVisuel()) ?>"
						 		<?php echo "style=\"background-image:url(".DOMAINE."medias/chaine/id-".$result["chaine"]->getIdChaine()."/visuel/".$visuel->getVisuelVisuel().")\""?> 
						 	>
								<img class="img-visuel" src="
								<?php echo DOMAINE?>medias/chaine/id-<?php echo $result["chaine"]->getIdChaine() ?>/visuel/<?php echo $visuel->getVisuelVisuel() ?>"
								>
							</a>
						</div>
						<div class="flex pb5 pt5">
							<div class="mAuto0 ml10">
								<p class="txt12 cGris mb0"><?php echo $transformDate->transformDateTime($visuel->getDatePostVisuel()); ?></p>
							</div>
							<div class="mAuto0 mlAuto">
								<button class="like-min mlAuto mAuto0 flex p0 
								<?php if(isset($result["likes"])){
									foreach ($result["likes"] as $like) {
										if(!is_null($like)){
											if($like->getVisuelIdVisuel() == $visuel->getIdVisuel()){
												echo 'liked';
											}
										}
									}
								} 
								?>" ajax="like" datas="<?php echo $visuel->getIdVisuel(); ?>"
								>
									<p class="cGris bold mtAuto mb0 mr10" count-like>
									<?php 
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
									?>
									</p>
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
									?>"
									title="
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
									?>" ajax="favoris" datas="<?php echo $visuel->getIdVisuel(); ?>">
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

		<?php if(isset($result["tutos"])): ?>
			<?php if(is_array($result["tutos"])):?>
				<?php foreach ($result["tutos"] as $tuto): ?>
				 	<div class="container-bloc p10 dpIB">
					 	<div class="container-visuels posR">
						 	<a class="p0" href="<?php echo DOMAINE ?>tuto-<?php echo $tuto->getIdTuto(); ?>-<?php echo $tuto->getTitreTuto(); ?>"
						 		<?php echo "style=\"background-image:url(".DOMAINE."medias/chaine/id-".$result["chaine"]->getIdChaine()."/tuto-".$tuto->getIdTuto()."/min-".$tuto->getVisuelTuto().")\""?> 
						 	>
								<img class="img-visuel" src="
								<?php echo DOMAINE?>medias/chaine/id-<?php echo $result["chaine"]->getIdChaine(); ?>/tuto-<?php echo $tuto->getIdTuto() ?>/min-<?php echo $tuto->getVisuelTuto() ?>"
								>
							</a>
							<a href="<?php echo DOMAINE ?>tuto-<?php echo $tuto->getIdTuto(); ?>" class="titreTuto bgDeg">
								<div class="flex pl10 pr10 pt20 mb10 cutBox2">
									<p class="mb0 cWhite"><?php echo $tuto->getTitreTuto() ?></p>
								</div>
							</a>
						</div>
						<div class="flex pb5 pt5">
							<div class="mAuto0 ml10">
								<p class="txt12 cGris mb0"><?php echo $transformDate->transformDateTime($tuto->getDatePostTuto()); ?></p>
							</div>

							<div class="mt5 mlAuto">
								<?php if(isset($result['note'])):?>
									<?php foreach ($result["note"] as $note): ?>
										<?php if($note->getTutoIdTuto() == $tuto->getIdTuto()): ?>
											<?php 
												$moy = $note->sumNote / $note->countNote;
												$moy = (is_float($moy))?number_format($moy, 1, '.', ''):$moy;
											?>
											<div class="mAuto flex">
												<p class="mAuto ml10 txt14 cBleu bold"><?php echo $moy; ?></p>
												<p class="cGris txt12 mAuto">/10</p>			
											</div>
										<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>
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
									<?php if(isset($result["favorisTuto"])){
										foreach ($result["favorisTuto"] as $fav) {
											if($fav->getTutoIdTuto() == $tuto->getIdTuto()){
												echo 'favorited';
											}
										}
									}
									?>" title="
									<?php if(isset($result["favorisTuto"])){
											$nb = 0;
											foreach ($result["favorisTuto"] as $fav) {
												if($fav->getTutoIdTuto() == $tuto->getIdTuto()){
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
										ajax="favorisTuto" datas="<?php echo $tuto->getIdTuto(); ?>"
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
										<?php if(isset($result["favorisTuto"])){
											$nb = 0;
											foreach ($result["favorisTuto"] as $fav) {
												if($fav->getTutoIdTuto() == $tuto->getIdTuto()){
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
									<button class="sig flex" modale="btn-signal" title="signaler un abus" datas="tuto-<?php echo $tuto->getIdTuto(); ?>">
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
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<p class="cGris"><?php echo $result["tutos"]; ?></p>
			<?php endif; ?>
		<?php endif; ?>

		<?php if(isset($result["desc-chaine"])): ?>
			<div class="flex w100 containDesc">
				<div class="w100 pr40">
					<?php if(!empty($result["desc-chaine"]->getDescriptionChaine())): ?>
						<p class="txt12 cGris borderB pb5">Description</p>
						<p><?php echo $result["desc-chaine"]->getDescriptionChaine(); ?></p>
					<?php endif; ?>
				</div>
				<div class="pr20 pl40">
					<?php 
						$date = new DateTime($result["desc-chaine"]->getDateCreaChaine()); 
					?>	
					<p class="borderB cGris pb5 txt12">infos</p>
					<p class="txt12 mb10">Chaine&nbsp;créé&nbsp;le&nbsp;<span class="bold"><?php echo $date->format("d/m/Y"); ?></span></p>
					<p class="txt12 mb20"><?php 
						if($result['members'] > 1){
							echo 'Nombre&nbsp;de&nbsp;membres&nbsp;:&nbsp;<span class="bold">'.$result['members']."</span>";
						}else{
							echo 'Nombre&nbsp;de&nbsp;membre&nbsp;:&nbsp;<span class="bold">'.$result['members']."</span>";
						}
					?></p>
					<p class="borderB cGris pb5 txt12">liens</p>
					<?php if(!empty($result["desc-chaine"]->getLienInChaine())): ?>
						<a class="p0 txt12 mb5" <?php echo "href='".$result["desc-chaine"]->getLienInChaine()."'"; ?> title="lien linkedin">linkedin</a>
					<?php endif; ?>
					<?php if(!empty($result["desc-chaine"]->getLienFbChaine())): ?>
						<a class="p0 txt12 mb5" <?php echo "href='".$result["desc-chaine"]->getLienFbChaine()."'"; ?> title="lien facebook">facebook</a>
					<?php endif; ?>
					<?php if(!empty($result["desc-chaine"]->getLienInstaChaine())): ?>
						<a class="p0 txt12 mb5" <?php echo "href='".$result["desc-chaine"]->getLienInstaChaine()."'"; ?> title="lien instagram">instagram</a>
					<?php endif; ?>
					<?php if(!empty($result["desc-chaine"]->getLienYtbChaine())): ?>
						<a class="p0 txt12 mb5" <?php echo "href='".$result["desc-chaine"]->getLienYtbChaine()."'"; ?> title="lien youtube">youtube</a>
					<?php endif; ?>
					<?php if(!empty($result["desc-chaine"]->getLienTwChaine())): ?>
						<a class="p0 txt12 mb5" <?php echo "href='".$result["desc-chaine"]->getLienTwChaine()."'"; ?> title="lien twitter">twitter</a>
					<?php endif; ?>
				</div>
			</div>
			
		<?php endif; ?>
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
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxLike.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxAbonnement.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxFavoris.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/ajaxSignal.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/toggle-nav.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/scroll-anim.js"></script>
