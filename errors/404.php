<?php if(!defined('DOMAINE')) include_once("../config/settings.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>404</title>
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/front/css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAINE; ?>templates/front/css/404.css">
</head>
<body>
	<div class="bg-img">
		<div class="div1">
			<h1>Page introuvable</h1>
			<h2><span>Erreur</span> 404</h2>
		</div>
		<div class="div2">
			<div>
				<p>Oups !</p> 
				<p>C'est chaud, il semblerait que cette page soit introuvable</p>
			</div>
			<a class="btnB" href="<?php echo DOMAINE; ?>" title="Retourner au site">Retourner au site</a>
		</div>
	</div>
</body>
</html>