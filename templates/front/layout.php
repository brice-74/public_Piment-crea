<?php 
use OCFram\HTTPRequest;
if(!defined('DOMAINE')) die();
$http = new HTTPRequest();
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php if(isset($description)) echo "<meta name=\"description\"  content=\"".$description."\">"?>
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/front/css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/front/css/style.css">
	<link rel="icon" type="image/png" href="<?php echo DOMAINE; ?>templates/front/img/logoFond-icon.png" />
	<title><?php if(isset($title)) echo $title ?></title>
</head>

<body id="noJs" class="body <?php if(isset($body_class)) echo $body_class ?>">
<?php 
use Vendors\Flash\Flash;
$flash = new FLash(); 
echo $flash->getFlash(); 
?>
<header class="header">
	<div class="burger">
		<button><div></div></button>
		<a href="<?php echo DOMAINE; ?>" title="Accueil du site" class="logo"></a>
	</div>
	<?php if(isset($vue)) include($vue["vueFormSearch"]); ?>
	<?php if(isset($_SESSION["auth"])): ?>
		<div class="img-avatar">
		<button
		<?php 
			if(is_null($_SESSION["auth"]["avatar"])){
				echo "style=\"background-image:url(".DOMAINE."templates/front/img/pimentC.jpg)\""; 
			}else{
				echo "style=\"background-image:url(".DOMAINE."medias/user/id-".$_SESSION["auth"]["id"]."/avatars/".$_SESSION["auth"]["avatar"].")\""; 
			}
		?>>
		</button>
		</div>
		<div class="account close-profil">
			<div class="p20 flex">
				<div class="img-avatar-min flex">
					<div
					<?php 
						if(is_null($_SESSION["auth"]["avatar"])){
							echo "style=\"background-image:url(".DOMAINE."templates/front/img/pimentC.jpg)\""; 
						}else{
							echo "style=\"background-image:url(".DOMAINE."medias/user/id-".$_SESSION["auth"]["id"]."/avatars/".$_SESSION["auth"]["avatar"].")\""; 
						}
					?>>
					</div>
				</div>
				<div class="ml10">
					<p class="mb0 cutBox1 bold"><?php echo $_SESSION['auth']['nom']." ".$_SESSION['auth']['prenom'] ?></p>
					<p class="mb0 txt12"><?php echo $_SESSION['auth']['email'] ?></p>
				</div>
			</div>
			<nav>
				<ul>
					<li class="accountLi1">
						<a href="<?php echo DOMAINE; ?>profil" title="Mon profil"
						<?php 
						$tableau = array(
							"/profil"
						);
						foreach ($tableau as $value) {
							if(preg_match("/^".str_replace("/","\/",$http->getUri())."$/",$value)){echo " activ-page";}
						}
						?>
						>
							<p>Mon profil</p>
						</a>
					</li>
					<li class="accountLi2">
						<a href="<?php echo DOMAINE; ?>deconnexion" title="Déconnexion">
							<p>Déconnexion</p>
						</a>
					</li>
				</ul>
			<nav>
		</div>	
	<?php else: ?>
		<div class="create-account">
			<button class="coReg" modale="btn-coReg" title="Se connecter ou créer un compte"
				<?php 
				$tableau = array(
					"/connexion",
					"/creation-compte",
				);
				foreach ($tableau as $value) {
					if(preg_match("/^".str_replace("/","\/",$http->getUri())."$/",$value)){echo " activ-page";}
				}
				?>
				>
				<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve">
					<g>
						<circle class="st1" cx="15" cy="15" r="15"/>
						<g>
							<rect x="7.5" y="13" class="st0" width="15" height="2.1"/>
							<rect x="7.5" y="10" transform="matrix(1.061078e-10 1 -1 1.061078e-10 26 -1)" class="st0" width="15" height="2.1"/>
						</g>
					</g>
				</svg>
				<p>Connexion</p>
			</button>
		</div>
	<?php endif; ?>
</header>
<div class="left-bar bar-open">
	<nav>
		<ul>
			<li class="navLi1">
				<a href="<?php echo DOMAINE; ?>" class="aleft"  title="Pourquoi utiliser Piment Créa"
					<?php 
					$tableau = array(
						"/",
						"/index",
						"/index.php"
					);
					foreach ($tableau as $value) {
						if(preg_match("/^".str_replace("/","\/",$http->getUri())."$/",$value)){echo " activ-page";}
					}
					?>
					>
					<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
						<g>
							<g>
								<g>
									<path class="st0" d="M23.9,10.5c-0.2,0-0.3,0-0.5-0.1L12.5,5.1L1.7,10.4c-0.6,0.3-1.2,0-1.5-0.5c-0.3-0.6,0-1.2,0.5-1.5L12,2.8
										c0.3-0.2,0.7-0.2,1,0l11.4,5.5c0.6,0.3,0.8,1,0.5,1.5C24.7,10.3,24.3,10.5,23.9,10.5z"/>
								</g>
								<g>
									<path class="st0" d="M5.1,22.8c-0.6,0-1.1-0.5-1.1-1.1V11.5c0-0.6,0.5-1.1,1.1-1.1s1.1,0.5,1.1,1.1v10.1
										C6.3,22.3,5.8,22.8,5.1,22.8z"/>
								</g>
								<g>
									<path class="st0" d="M19.9,22.8c-0.6,0-1.1-0.5-1.1-1.1V11.5c0-0.6,0.5-1.1,1.1-1.1s1.1,0.5,1.1,1.1v10.1
										C21,22.3,20.5,22.8,19.9,22.8z"/>
								</g>
							</g>
						</g>
					</svg>
					<p>Accueil</p>
				</a>
			</li>
			<li class="navLi2">
				<a href="<?php echo DOMAINE; ?>visuels" class="aleft"  title="Tous les visuels"
				<?php 
				$tableau = array(
					"/visuels",
					"/visuels(.*)"
				);
				foreach ($tableau as $value) {
					if(preg_match("/^".str_replace("/","\/",$value)."/",$http->getUri())){echo " activ-page";}
				}
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
					<p>Visuels</p>
				</a>
			</li>
			<li class="navLi3">
				<a href="<?php echo DOMAINE; ?>tutoriaux" class="aleft"  title="Tous les tuto"
				<?php 
				$tableau = array(
					"/tutoriaux"
				);
				foreach ($tableau as $value) {
					if(preg_match("/^".str_replace("/","\/",$http->getUri())."$/",$value)){echo " activ-page";}
				}
				?>>
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
					<p>Tutos</p>
				</a>
			</li>
			<?php if(isset($_SESSION["auth"])): ?>
				<li class="navLi4">
					<a href="<?php echo DOMAINE; ?>abonnements" class="aleft"  title="Mes abonnements"
						<?php 
						$tableau = array(
							"/abonnements"
						);
						foreach ($tableau as $value) {
							if(preg_match("/^".str_replace("/","\/",$http->getUri())."$/",$value)){echo " activ-page";}
						}
						?>>
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
						<p>Abonnements</p>
					</a>
				</li>
				<li  class="navLi5">
					<a href="<?php echo DOMAINE; ?>favoris" class="aleft"  title="Mes favoris"
						<?php 
							$tableau = array(
								"/favoris"
							);
							foreach ($tableau as $value) {
								if(preg_match("/^".str_replace("/","\/",$http->getUri())."$/",$value)){echo " activ-page";}
							}
							?>
						>
						<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
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
						<p>Favoris</p>
					</a>
				</li>
				<!--<li class="navLi6">
					<a href="<?php echo DOMAINE; ?>commentaires" class="aleft"  title="Mes commentaires">
						<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve">
							<path class="st0" d="M22.3,4.7H2.8c-0.6,0-1.1,0.5-1.1,1.1v13.3c0,0.4,0.2,0.8,0.6,1c0.2,0.1,0.3,0.1,0.5,0.1c0.4,0,0.5,0,0.5-0.1
							L3.4,20l4.2-3.3h14.7c0.6,0,1.1-0.5,1.1-1.1V5.8C23.4,5.2,22.9,4.7,22.3,4.7z M21.2,14.5H7.3c-0.3,0-0.5,0.1-0.7,0.3l-2.7,2V6.9
							h17.3V14.5z"/>
						</svg>
						<p>Commentaires</p>
					</a>
				</li>-->
				<?php if($_SESSION["auth"]["statut"] > 1): ?>
					<li class="navLi7">
						<a href="<?php echo DOMAINE; ?>chaine-<?php echo $_SESSION['authChaine']['id'] ?>-<?php echo $_SESSION['authChaine']['nom'] ?>/visuels" class="aleft"  title="Ma chaine"
							<?php 
							$tableau = array(
								"/chaine-".$_SESSION["authChaine"]["id"].'-'.$_SESSION["authChaine"]["nom"]."/visuels",
								"/chaine-".$_SESSION["authChaine"]["id"].'-'.$_SESSION["authChaine"]["nom"]."/description",
								"/chaine-".$_SESSION["authChaine"]["id"].'-'.$_SESSION["authChaine"]["nom"]."/tutos"
							);
							foreach ($tableau as $value) {
								if(preg_match("/^".str_replace("/","\/",urldecode($http->getUri()))."$/",$value)){echo " activ-page";}
							}
							?>
							>
							<div class="container-avatar-min"
							<?php if(is_null($_SESSION["authChaine"]["avatar"])): ?>
								style="background-image:url(<?php echo DOMAINE ?>templates/front/img/piment.jpg);"
							<?php else: ?>
								style="background-image:url(<?php echo DOMAINE ?>medias/chaine/id-<?php echo $_SESSION['authChaine']["id"]?>/avatars/<?php echo $_SESSION['authChaine']["avatar"]?>);"
							<?php endif; ?> 
							>
								<img class="img-visuel" 
								<?php if(is_null($_SESSION["authChaine"]["avatar"])): ?>
									src="<?php echo DOMAINE ?>templates/front/img/piment.jpg"
								<?php else: ?>
									src="<?php echo DOMAINE ?>medias/chaine/id-<?php echo $_SESSION['authChaine']["id"]?>/avatars/<?php echo $_SESSION['authChaine']["avatar"]?>"
								<?php endif; ?> 
								alt="Image de chaine">
							</div>
							<p>Ma chaine</p>
						</a>
					</li>
					<li class="navLi8">
						<a href="<?php echo DOMAINE; ?>poster-visuel" class="aleft"  title="Poster un visuel"
							<?php 
							$tableau = array(
								"/poster-visuel",
							);
							foreach ($tableau as $value) {
								if(preg_match("/^".str_replace("/","\/",$http->getUri())."$/",$value)){echo " activ-page";}
							}
							?>
							>
							<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve">
								<g>
									<g>
										<g>
											<g>
												<path class="st0" d="M20.7,14.1c-1.7,0-3.1-1.4-3.1-3.1s1.4-3.1,3.1-3.1s3.1,1.4,3.1,3.1S22.4,14.1,20.7,14.1z M20.7,9.4
													c-0.9,0-1.6,0.7-1.6,1.6c0,0.9,0.7,1.6,1.6,1.6s1.6-0.7,1.6-1.6C22.4,10.1,21.6,9.4,20.7,9.4z"/>
											</g>
											<g>
												<path class="st0" d="M23.5,23.6c-0.2,0-0.5-0.1-0.6-0.3l-2.3-3.1l-1.5,1.9c-0.1,0.2-0.4,0.3-0.6,0.3c-0.2,0-0.5-0.2-0.6-0.4
													l-5.4-9.3l-4,6.4c-0.2,0.3-0.7,0.5-1,0.2c-0.3-0.2-0.5-0.7-0.2-1l4.6-7.5c0.1-0.2,0.4-0.4,0.6-0.4c0.3,0,0.5,0.1,0.6,0.4
													l5.5,9.4l1.4-1.9c0.1-0.2,0.4-0.3,0.6-0.3c0.2,0,0.5,0.1,0.6,0.3l2.8,3.9c0.2,0.3,0.2,0.8-0.2,1C23.8,23.6,23.6,23.6,23.5,23.6z
													"/>
											</g>
										</g>
									</g>
									<g>
										<path class="st0" d="M16,0.9c8.3,0,15.1,6.8,15.1,15.1S24.3,31.1,16,31.1S0.9,24.3,0.9,16S7.7,0.9,16,0.9 M16,0C7.2,0,0,7.2,0,16
											s7.2,16,16,16s16-7.2,16-16S24.8,0,16,0L16,0z"/>
									</g>
								</g>
							</svg>
							<p>Poster un visuel</p>
						</a>
					</li>
					<li class="navLi9">
						<a href="<?php echo DOMAINE; ?>ajout-tuto" class="aleft"  title="Créer un tutoriel"
							<?php 
							$tableau = array(
								"/creation-tuto-([0-9]+)",
							);
							foreach ($tableau as $value) {
								if(preg_match("/^".str_replace("/","\/",$value)."$/",$http->getUri())){echo " activ-page";}
							}
							?>>
							<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve">
								<g>
									<g>
										<g>
											<path class="st0" d="M22.1,21.8c-0.4,0-0.7-0.3-0.7-0.7v-6.3c-1.1,0.1-3.2,0.6-4.8,2.2c-0.3,0.3-0.7,0.3-1,0
												c-1.6-1.6-3.7-2-4.8-2.2v6.3c0,0.4-0.3,0.7-0.7,0.7c-0.4,0-0.7-0.3-0.7-0.7V14c0-0.4,0.3-0.7,0.7-0.7c0.2,0,3.5,0,6.1,2.2
												c2.7-2.1,5.9-2.2,6-2.2c0.4,0,0.7,0.3,0.7,0.7v7.1C22.8,21.5,22.5,21.8,22.1,21.8z"/>
										</g>
										<g>
											<ellipse class="st0" cx="10" cy="17.6" rx="0.9" ry="1.4"/>
											<path class="st0" d="M10,19.7c-0.9,0-1.6-0.9-1.6-2.1c0-1.2,0.7-2.1,1.6-2.1s1.6,0.9,1.6,2.1C11.6,18.8,10.9,19.7,10,19.7z
												 M10,18.2L10,18.2L10,18.2z M10,17c-0.1,0.1-0.2,0.3-0.2,0.6s0.1,0.5,0.2,0.6c0.1-0.1,0.2-0.3,0.2-0.6S10.1,17.1,10,17z"/>
										</g>
										<g>
											<ellipse class="st0" cx="22.1" cy="17.6" rx="0.9" ry="1.4"/>
											<path class="st0" d="M22.1,19.7c-0.9,0-1.6-0.9-1.6-2.1c0-1.2,0.7-2.1,1.6-2.1s1.6,0.9,1.6,2.1C23.7,18.8,23,19.7,22.1,19.7z
												 M22.1,18.2L22.1,18.2L22.1,18.2z M22.1,17c-0.1,0.1-0.2,0.3-0.2,0.6s0.1,0.5,0.2,0.6c0.1-0.1,0.2-0.3,0.2-0.6S22.2,17.1,22.1,17
												z"/>
										</g>
										<g>
											<path class="st0" d="M19.8,13.1c-0.4,0-0.7-0.3-0.7-0.7c0-1.6-1.3-2.9-2.9-2.9s-2.9,1.3-2.9,2.9c0,0.4-0.3,0.7-0.7,0.7
												c-0.4,0-0.7-0.3-0.7-0.7c0-2.4,2-4.4,4.4-4.4s4.4,2,4.4,4.4C20.5,12.8,20.2,13.1,19.8,13.1z"/>
										</g>
									</g>
									<g>
										<path class="st0" d="M16,0.9c8.3,0,15.1,6.8,15.1,15.1S24.3,31.1,16,31.1S0.9,24.3,0.9,16S7.7,0.9,16,0.9 M16,0C7.2,0,0,7.2,0,16
											s7.2,16,16,16s16-7.2,16-16S24.8,0,16,0L16,0z"/>
									</g>
								</g>
							</svg>
							<p>Créer un tuto</p>
						</a>
					</li>
					<li class="navLi10">
						<a href="<?php echo DOMAINE; ?>brouillons"  class="aleft" title="Tutos non posté"
							<?php 
							$tableau = array(
								"/brouillons",
							);
							foreach ($tableau as $value) {
								if(preg_match("/^".str_replace("/","\/",$value)."$/",$http->getUri())){echo " activ-page";}
							}
							?>>
							<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve">
								<g>
									<g>
										<g>
											<g>
												<path class="st0" d="M16,0.9c8.3,0,15.1,6.8,15.1,15.1S24.3,31.1,16,31.1S0.9,24.3,0.9,16S7.7,0.9,16,0.9 M16,0
													C7.2,0,0,7.2,0,16s7.2,16,16,16s16-7.2,16-16S24.8,0,16,0L16,0z"/>
											</g>
										</g>
										<g>
											<path class="st0" d="M19.9,10.9h-9.7c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7h9.7c0.4,0,0.7,0.3,0.7,0.7S20.2,10.9,19.9,10.9z"/>
										</g>
										<g>
											<path class="st0" d="M23.3,16.7H10.2c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7h13.2c0.4,0,0.7,0.3,0.7,0.7S23.7,16.7,23.3,16.7z"
												/>
										</g>
										<g>
											<path class="st0" d="M19.9,22.5h-9.7c-0.4,0-0.7-0.3-0.7-0.7c0-0.4,0.3-0.7,0.7-0.7h9.7c0.4,0,0.7,0.3,0.7,0.7
												C20.6,22.2,20.2,22.5,19.9,22.5z"/>
										</g>
									</g>
								</g>
							</svg>
							<p>Brouillons</p>
						</a>
					</li>
					<li class="navLi11">
						<a href="<?php echo DOMAINE; ?>vue-chaine/<?php echo $_SESSION['authChaine']['nom'] ?>"  class="aleft" title="Statistiques et paramètres de la chaine"
						<?php 
						$tableau = array(
							"/vue-chaine/".$_SESSION["authChaine"]["nom"],
							"/vue-chaine/modifier-infos-chaine"
						);
						
						foreach ($tableau as $value) {
							if(preg_match("/^".str_replace("/","\/",urldecode($http->getUri()))."$/",$value)){echo " activ-page";}
						}
						?>
						>
							<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve">
								<g>
									<g>
										<path class="st0" d="M16,0.9c8.3,0,15.1,6.8,15.1,15.1S24.3,31.1,16,31.1S0.9,24.3,0.9,16S7.7,0.9,16,0.9 M16,0C7.2,0,0,7.2,0,16
											s7.2,16,16,16s16-7.2,16-16S24.8,0,16,0L16,0z"/>
									</g>
									<g>
										<path class="st0" d="M5.7,22.8c-0.2,0-0.4-0.1-0.5-0.2c-0.3-0.3-0.3-0.8,0-1.1l8.8-8.8c0.3-0.3,0.8-0.3,1.1,0l2.3,2.3l6.4-6.4
											c0.3-0.3,0.8-0.3,1.1,0l2.4,2.4c0.3,0.3,0.3,0.8,0,1.1c-0.3,0.3-0.8,0.3-1.1,0l-1.9-1.9l-6.4,6.4c-0.3,0.3-0.8,0.3-1.1,0l-2.3-2.3
											l-8.3,8.3C6.1,22.7,5.9,22.8,5.7,22.8z"/>
									</g>
								</g>
							</svg>
							<p>Vue sur la chaine</p>
						</a>
					</li>
					<?php if($_SESSION["auth"]["statut"] > 2): ?>
						<li class="navLi12">
							<a href="<?php echo DOMAINE; ?>vue-admin"  class="aleft"  title="Vue sur la plateforme"
								<?php 
								$tableau = array(
									"/vue-admin"
								);
								foreach ($tableau as $value) {
									if(preg_match("/^".str_replace("/","\/",urldecode($http->getUri()))."$/",$value)){echo " activ-page";}
								}
								?>
								>
								<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve">
									<g>
										<path class="st0" d="M12.4,20.2l-5.8-4.4l5.9-4.5c0.2-0.1,0.3-0.3,0.3-0.5s-0.1-0.4-0.3-0.5C12.2,10.1,12,10,11.7,10
											c-0.3,0-0.5,0.1-0.7,0.2l-6.6,5c-0.2,0.1-0.3,0.3-0.3,0.5s0.1,0.4,0.3,0.5l6.5,5c0.4,0.3,1,0.3,1.4,0c0.2-0.1,0.3-0.3,0.3-0.5
											S12.6,20.4,12.4,20.2z"/>
										<path class="st0" d="M27.8,15.7c0-0.2-0.1-0.4-0.3-0.5l-6.5-5c-0.2-0.1-0.4-0.2-0.7-0.2s-0.5,0.1-0.7,0.2s-0.3,0.3-0.3,0.5
											s0.1,0.4,0.3,0.5l5.8,4.4l-5.9,4.5c-0.2,0.1-0.3,0.3-0.3,0.5s0.1,0.4,0.3,0.5c0.4,0.3,1,0.3,1.4,0l6.6-5
											C27.7,16.1,27.8,15.9,27.8,15.7z"/>
									</g>					
								</svg>
								<p>Vue admin</p>
							</a>
						</li>
					<?php endif; ?>
				<?php else: ?>	
					<li>
						<a href="<?php echo DOMAINE; ?>creation-chaine" class="aleft" title="Créer une chaine"
						<?php 
							$tableau = array(
								"/creation-chaine"
							);
							foreach ($tableau as $value) {
								if(preg_match("/^".str_replace("/","\/",$http->getUri())."$/",$value)){echo " activ-page";}
							}
							?>
						>
							<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve">
								<g>
									<circle class="st1" cx="15" cy="15" r="15"/>
									<g>
										<rect x="7.5" y="13" class="st0" width="15" height="2.1"/>
										<rect x="7.5" y="10" transform="matrix(1.061078e-10 1 -1 1.061078e-10 26 -1)" class="st0" width="15" height="2.1"/>
									</g>
								</g>
							</svg>
							<p>Créer une chaine</p>
						</a>
					</li>
				<?php endif; ?>
			<?php else: ?>
				<li>
					<button class="aleft" modale="btn-coReg" title="Se connecter ou créer un compte"
					<?php 
					$tableau = array(
						"/connexion",
						"/creation-compte",
					);
					foreach ($tableau as $value) {
						if(preg_match("/^".str_replace("/","\/",$http->getUri())."$/",$value)){echo " activ-page";}
					}
					?>
					>
						<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve">
							<g>
								<circle class="st1" cx="15" cy="15" r="15"/>
								<g>
									<rect x="7.5" y="13" class="st0" width="15" height="2.1"/>
									<rect x="7.5" y="10" transform="matrix(1.061078e-10 1 -1 1.061078e-10 26 -1)" class="st0" width="15" height="2.1"/>
								</g>
							</g>
						</svg>
						<p>Connexion</p>
					</button>
				</li>	
			<?php endif; ?>
		</ul>
	</nav>
	<footer>
			<a href="<?php echo DOMAINE; ?>rgpd" title="Mentions légales - CGU - Politique de Confidentialité">RGPD</a>
	</footer>
</div>
	
	<a href="#main" class="goTop" title="Retour en haut de la page">
		<svg version="1.1" viewBox="0 0 512.011 512.011" xml:space="preserve">
			<g>
				<g>
					<path d="M505.755,123.592c-8.341-8.341-21.824-8.341-30.165,0L256.005,343.176L36.421,123.592c-8.341-8.341-21.824-8.341-30.165,0
						s-8.341,21.824,0,30.165l234.667,234.667c4.16,4.16,9.621,6.251,15.083,6.251c5.462,0,10.923-2.091,15.083-6.251l234.667-234.667
						C514.096,145.416,514.096,131.933,505.755,123.592z"/>
				</g>
			</g>
		</svg>
	</a>
	<?php if(!isset($_SESSION["auth"])): ?>
		<div id="modale-coReg">
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
				<div class="flex fdC mb80">
					<p class="titre2 mb40 alignCenter">Connexion</p>
					<p class="mb20">Connectez-vous avec vos identifiants pour avoir accès à des fonctionnalités supplémentaires</p>
					<a class="btnV" href="<?php echo DOMAINE; ?>connexion"><p class="txt18">Connexion</p></a>
				</div>
				<div class="flex fdC">
					<p class="titre2 mb40 alignCenter">Inscription</p>
					<p class="mb20">Vous n'avez toujours pas de compte ! N'hésitez pas à en créer un pour profiter plainement de la plateforme</p>
					<a class="btnV" href="<?php echo DOMAINE; ?>creation-compte"><p class="txt18">Inscription</p></a>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<main id="main">
		<?php if(isset($vue)) include($vue["vueMain"]); ?>
	</main>
</body>
<div id="blocNoJs">
	<div>
		<p class="titre2 mb20 alignCenter">JavaScript désactivé !</p>
		<p class="mb40">Veuillez activer JavaScript dans les paramètres de votre navigateur pour profiter plainement des fonctionnalités de l'application</p>
		<div class="flex fdC">
			<a class="btnV" href="https://support.google.com/admanager/answer/12654?hl=fr" title="lien vers Aide Google" target="_blank"><p class="txt18">Activer JavaScript</p></a>
		</div>
	</div>
</div>
</html>
