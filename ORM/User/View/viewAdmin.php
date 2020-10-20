<?php 
use Vendors\DateTime\DateTimeTransform;
use OCFram\Connexion;

use ORM\Chaine\Entity\Chaine;
use ORM\Chaine\Model\ManagerChaine;
use ORM\Commentaire\Entity\Commentaire;
use ORM\Commentaire\Model\ManagerCommentaire;
use ORM\Visuel\Entity\Visuel;
use ORM\Visuel\Model\ManagerVisuel;
use ORM\Tuto\Entity\Tuto;
use ORM\Tuto\Model\ManagerTuto;

$cx = new Connexion();
$managerCommentaire = new ManagerCommentaire($cx);
$managerVisuel = new ManagerVisuel($cx);
$managerTuto = new ManagerTuto($cx);
$managerChaine = new ManagerChaine($cx);
$transformDate = new DateTimeTransform();  
?>
<?php if(isset($result)):?>
 <div class="main-container-max">
 	<div class="flex mb60">
 		<div class="w100 mr60">
	 		<p class="cGris borderB txt12 pb5 posR">Proposition catégorie tuto<span id="togglePropT"></span></p>
	 		<div class="containSign">
			 	<?php if(is_array($result['propTuto'])): ?>
					<?php foreach ($result['propTuto'] as $propT):?>
						<div class="pt10 pb5 divSign flex" <?php if($propT->getActifPropostion() == 0){echo 'noActifPropT';} ?>>
							<a class="eyeSvgContain flex" href="
								<?php 
									echo 'add-actif-prop-'.$propT->getIdProposition();
								?>"
							>
								<svg version="1.1" viewBox="0 0 576 512" xml:space="preserve">
									<path class="st0" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path>
								</svg>
							</a>
							<p class="mb5"><?php echo $propT->getTitreProposition(); ?></p>
							<a href="ajout-categorie-by-proposition-<?php echo $propT->getIdProposition(); ?>" class="btnB p5-15 mr0"><p class="txt12">Ajouter</p></a>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<p class="cGris alignCenter"><?php echo $result['propTuto']; ?></p>
				<?php endif; ?>
			</div>
 		</div>
 		<div class="w100">
	 		<p class="cGris borderB txt12 pb5 posR">Proposition catégorie visuel<span id="togglePropV"></span></p>
	 		<div class="containSign">
			 	<?php if(is_array($result['propVisu'])): ?>
					<?php foreach ($result['propVisu'] as $propV):?>
						<div class="pt10 pb5 divSign flex" <?php if($propV->getActifPropostion() == 0){echo 'noActifPropV';} ?>>
							<a class="eyeSvgContain flex" href="
								<?php 
									echo 'add-actif-prop-'.$propV->getIdProposition();
								?>"
							>
								<svg version="1.1" viewBox="0 0 576 512" xml:space="preserve">
									<path class="st0" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path>
								</svg>
							</a>
							<p class="mb5"><?php echo $propV->getTitreProposition(); ?></p>
							<a href="ajout-categorie-by-proposition-<?php echo $propV->getIdProposition(); ?>" class="btnB p5-15 mr0"><p class="txt12">Ajouter</p></a>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<p class="cGris alignCenter"><?php echo $result['propVisu']; ?></p>
				<?php endif; ?>
			</div>
 		</div>
	</div>
 	<div class="flex fdC">
 		<p class="cGris borderB txt12 pb5 posR">Signalements<span id="toggleSign"></span></p>
 		<div class="containSign">
 			<?php if(is_array($result['signals'])): ?>
				<?php foreach ($result['signals'] as $signal):?>
					<div class="mb10 pb10 divSign flex" <?php if($signal->getActifSignal() == 0){echo 'noActif';} ?>>
						<a class="eyeSvgContain flex" href="
							<?php 
								echo 'add-actif-signal-'.$signal->getIdSignal();
							?>"
						>
							<svg version="1.1" viewBox="0 0 576 512" xml:space="preserve">
								<path class="st0" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path>
							</svg>
						</a>
						
						<div class="comSign">
							<?php echo $signal->getCommentaireSignal(); ?>
							<p class="cOrange txt12 mb0">
							<?php 
								if(!is_null($signal->getChaineIdChaine())){
									echo 'Chaine';
								}
								if(!is_null($signal->getCommentaireIdCommentaire())){
									$com = $managerCommentaire->selectCom($signal->getCommentaireIdCommentaire());
									if(!is_null($com->getVisuelIdVisuel())){
										echo 'Commentaire Visuel';
									}
									if(!is_null($com->getTutoIdTuto())){
										echo 'Commentaire Tuto';
									}
								}
								if(!is_null($signal->getTutoIdTuto())){
									echo 'Tuto';
								}
								if(!is_null($signal->getVisuelIdVisuel())){
									echo 'Visuel';
								}
							?>
							</p>
						</div>
						<div class="mlAuto flex">
							<div class="pr10 flex contentSign">
								<div class="mbAuto">
									<a class="a-link p5-15 mb5"
									<?php
										if(!is_null($signal->getChaineIdChaine())){
											$chaine = $managerChaine->selectChaine($signal->getChaineIdChaine());
											echo 'href="'.DOMAINE.'toggle-actif-chaine-'.$chaine->getIdChaine().'"';
											if($chaine->getActifChaine() == 0){
												echo '><p class="txt12"><span class="bold txt16 mr10">+ </span> Ajouter</p></a>';
											}else{
												echo '><p class="txt12 cRouge"><span class="bold txt16 mr10">- </span> Retirer</p></a>';
											}
										}
										if(!is_null($signal->getCommentaireIdCommentaire())){
											$com = $managerCommentaire->selectCom($signal->getCommentaireIdCommentaire());
											echo 'href="'.DOMAINE.'toggle-actif-commentaire-'.$com->getIdCommentaire().'"';

											if($com->getActifCommentaire() == 0){
												echo '><p class="txt12"><span class="bold txt16 mr10">+ </span> Ajouter</p></a>';
											}else{
												echo '><p class="txt12 cRouge"><span class="bold txt16 mr10">- </span> Retirer</p></a>';
											}
										}
										if(!is_null($signal->getTutoIdTuto())){
											$tuto = $managerTuto->selectTuto($signal->getTutoIdTuto());
											echo 'href="'.DOMAINE.'toggle-actif-tuto-'.$tuto->getIdTuto().'"';
											if($tuto->getActifTuto() == 0){
												echo '><p class="txt12"><span class="bold txt16 mr10">+ </span> Ajouter</p></a>';
											}else{
												echo '><p class="txt12 cRouge"><span class="bold txt16 mr10">- </span> Retirer</p></a>';
											}
										}
										if(!is_null($signal->getVisuelIdVisuel())){
											$visu = $managerVisuel->selectVisuel($signal->getVisuelIdVisuel());
											echo 'href="'.DOMAINE.'toggle-actif-visuel-'.$visu->getIdVisuel().'"';
											if($visu->getActifVisuel() == 0){
												echo '><p class="txt12"><span class="bold txt16 mr10">+ </span> Ajouter</p></a>';
											}else{
												echo '><p class="txt12 cRouge"><span class="bold txt16 mr10">- </span> Retirer</p></a>';
											}
										}
									?>
								</div>
							</div>
							<div class="pl10 goViewSign">
								<a class="btnB p5-15 mb5"
								<?php 
									if(!is_null($signal->getChaineIdChaine())){
										$chaine = $managerChaine->selectChaine($signal->getChaineIdChaine());
										echo 'href="'.DOMAINE.'chaine-'.$chaine->getIdChaine().'-'.$chaine->getNomChaine().'/visuels"';
									}
									if(!is_null($signal->getCommentaireIdCommentaire())){
										$com = $managerCommentaire->selectCom($signal->getCommentaireIdCommentaire());

										if(!is_null($com->getVisuelIdVisuel())){
											$visu = $managerVisuel->selectVisuel($com->getVisuelIdVisuel());
											echo 'href="'.DOMAINE.'visuel-'.$visu->getIdVisuel().'-'.preg_replace("/.jpg$|.jpeg$|.png$/", '', $visu->getVisuelVisuel()).'#commentaire-'.$com->getIdCommentaire().'"';
										}
										if(!is_null($com->getTutoIdTuto())){
											$tuto = $managerTuto->selectTuto($com->getTutoIdTuto());
											echo 'href="'.DOMAINE.'tuto-'.$tuto->getIdTuto().'-'.$tuto->getTitreTuto().'#commentaire-'.$com->getIdCommentaire().'"';
										}
									}
									if(!is_null($signal->getTutoIdTuto())){
										$tuto = $managerTuto->selectTuto($signal->getTutoIdTuto());
										echo 'href="'.DOMAINE.'tuto-'.$tuto->getIdTuto().'-'.$tuto->getTitreTuto().'"';
									}
									if(!is_null($signal->getVisuelIdVisuel())){
										$visu = $managerVisuel->selectVisuel($signal->getVisuelIdVisuel());
										echo 'href="'.DOMAINE.'visuel-'.$visu->getIdVisuel().'-'.preg_replace("/.jpg$|.jpeg$|.png$/", '', $visu->getVisuelVisuel()).'"';
									}
								?>
								><p class="txt12">Voir</p></a>
								<p class="cGris txt12 mb0"><?php  echo  $transformDate->transformDateTime($signal->getDateSignal());?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
 			<?php else: ?>
				<p class="cGris alignCenter"><?php echo $result['signals']; ?></p>
 			<?php endif; ?>
 		</div>
 	</div>
 </div>
<?php endif; ?>
<script src="<?php echo DOMAINE; ?>templates/front/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo DOMAINE; ?>templates/front/js/toggle-nav.js"></script>
<?php $cx->close(); ?>