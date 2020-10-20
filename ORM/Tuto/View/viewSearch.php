<?php 
use Vendors\DateTime\DateTimeTransform;
use Vendors\LandingPage\LandingPage;

$transformDate = new DateTimeTransform();
$page = new LandingPage();
if($page->existPage()){
	$direction = $page->getPage();
}else{
	$direction = "index";
}
$page->setPage(str_replace('/', '', $http->getUri()));
if(isset($result)): ?>
	<div class="main-container-min">
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
		<div class="main-container-maxxx maxW1200">
			<?php if(isset($result['chaines'])): ?>
				<p class="cGris borderB pb5 mb40 posR">chaines<span id="toggleChaine"></span></p>
				<div id="slideChaine">
					<?php foreach ($result['chaines'] as $chaine):?>
						<div class="flex mb40 containSearchItems">
							<div class="mr20 W150">
								<a href="chaine-<?php echo $chaine->getIdChaine() ?>-<?php echo $chaine->getNomChaine() ?>/tutos" class="p0 container-avatar-max posR t0 l0 mAuto"
									<?php if(is_null($chaine->getAvatarChaine())): ?>
										style="background-image:url(templates/front/img/piment.jpg)"
									<?php else: ?>
										style="background-image:url(medias/chaine/id-<?php echo $chaine->getIdChaine(); ?>/avatars/<?php echo $chaine->getAvatarChaine(); ?>)"
									<?php endif; ?> 
								></a>
							</div>
							<div class="flex">
								<div class="mAuto">
									<p class="txt20 mb10 bold"><?php echo $chaine->getNomChaine() ?></p>
									<p class="txt14 mb0 cutBox2"><?php echo $chaine->getDescriptionChaine() ?></p>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			<?php endif; ?>
			<?php if(isset($result['tutos'])): ?>
				<p class="cGris borderB pb5 mb40 posR">tutos<span id="toggleTuto"></span></p>
				<div id="slideTuto">
					<?php foreach ($result['tutos'] as $tuto):?>
						<div class="flex mb40 containSearchItems">
							<div class="container-visuels W150 posR mr20">
							 	<a class="p0" href="<?php echo DOMAINE ?>tuto-<?php echo $tuto->getIdTuto(); ?>-<?php echo $tuto->getTitreTuto(); ?>"
							 		<?php echo "style=\"background-image:url(".DOMAINE."medias/chaine/id-".$tuto->id_chaine."/tuto-".$tuto->getIdTuto()."/min-".$tuto->getVisuelTuto().")\""?> 
							 	>
									<img class="img-visuel" src="
									<?php echo DOMAINE?>medias/chaine/id-<?php echo $tuto->id_chaine ?>/tuto-<?php echo $tuto->getIdTuto() ?>/min-<?php echo $tuto->getVisuelTuto() ?>"
									>
								</a>
								<a href="<?php echo DOMAINE ?>tuto-<?php echo $tuto->getIdTuto(); ?>-<?php echo $tuto->getTitreTuto(); ?>" class="titreTuto bgDeg">
									<div class="flex pl10 pr10 pt20 mb10">
										<p class="mb0 cWhite"><?php echo $tuto->getTitreTuto() ?></p>
									</div>
								</a>
							</div>
							<div class="flex fdC">
								<p class="cutBox2 txt16 bold mb5"><?php echo $tuto->getTitreTuto() ?></p>
								<div class="mtAuto">
									<p class="cutBox2 mb0 txt14"><?php echo $tuto->nom_chaine ?></p>
									<p class="txt12 cGris mb0"><?php echo $transformDate->transformDateTime($tuto->getDatePostTuto()); ?></p>
								</div>	
							</div>
						</div>
					<?php endforeach ?>
				</div>
			<?php endif; ?>
			<?php if(isset($result['no'])): ?>
				<p class="cGris alignCenter"><?php echo $result['no'] ?></p>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
<script src="<?php echo DOMAINE; ?>templates/front/js/jquery-3.3.1.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>-->
<script src="<?php echo DOMAINE; ?>templates/front/js/toggle-nav.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/scroll-anim.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/select.js"></script>
