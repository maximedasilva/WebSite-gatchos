<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<?php
		/**********Vérification du titre...*************/
		
		if(isset($titre) && trim($titre) != '')
		$titre = $titre.' : '.TITRESITE;
		
		else
		$titre = "La bandas Los Gatchos de La Musicale des Gaves";
		
		/***********Fin vérification titre...************/
		?>
		<title><?php echo $titre; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="language" content="fr" />
		<meta name="description" content="La Musicale des Gaves - Ecole de musique de Peyrehorade" />
		<meta name="keywords" content="la musicale des gaves, bandas, gatchos, gatchos kids, orchestre, peyrehorade, musique, orchestre, music tour, association de musique" />
		<meta name="title" content="La Musicale des Gaves" /> 
		<link rel="stylesheet" title="Design" href="<?php echo ROOTPATH; ?>/style/css/bandas.css" type="text/css" media="screen" />
		<link rel="stylesheet" title="Design" href="<?php echo ROOTPATH; ?>/style/css/slimbox2.css" type="text/css" media="screen" />
		<script type="text/javascript" src="<?php echo ROOTPATH; ?>/javascript/jquery-1.4.2.js"></script>
		<script type="text/javascript" src="<?php echo ROOTPATH; ?>/javascript/slimbox2.js"></script>
		<script type="text/javascript">
			// Gestion du slide galeries
			$(document).ready(function () {
				$("div.show_galeries").hide();
				$('img.show').click(function () {
					$('div.show_galeries').slideToggle('fast');
				});
			});
			
			// Gestion du slide archives
			$(document).ready( function () {
				$(".navigation ul.subMenu").hide();
				$(".navigation ul.show").show();
				$(".navigation li.toggleSubMenu span").each( function () {
					var TexteSpan = $(this).text();
					$(this).replaceWith('<a href="" title="Afficher le sous-menu"><h2>' + TexteSpan + '<\/h2><\/a>') ;
				} ) ;
					
				$(".navigation li.toggleSubMenu > a").click( function () {
					if ($(this).next("ul.subMenu:visible").length != 0) {
						$(this).next("ul.subMenu").slideUp("normal");
					}
					else {
						$(".navigation ul.subMenu").slideUp("normal");
						$(this).next("ul.subMenu").slideDown("normal");
					}
					return false;
				});    
			} ) ;
		</script>
	</head>
	
	<body>
		<div id="main_conteneur_bandas">
			<div id="header_bandas">
				<div id="top_bandas">
					<div id="banniere_bandas">
						<img src="<?php echo ROOTPATH; ?>/style/images/bandas/banniere_bandas.png" alt="Les Bandas"/>
					</div>
				</div>
				<div id="menu_bandas">
					<ul>
						<li><a href="<?php echo ROOTPATH; ?>/index-2.php" class="ciel"></a></li>						
						<li><a href="<?php echo ROOTPATH; ?>/gatchos/sorties.php" class="rouge"></a></li>
						<li><a href="<?php echo ROOTPATH; ?>/gatchos/news.php" class="jaune"></a></li>
                                                <li class="img_gal"><img src="<?php echo ROOTPATH; ?>/style/images/btn_gal.png" class="show" /></li>
<!--                                                <li class="img_con"><a href="/inscription/index.php"></a><img src="<?php //echo ROOTPATH; ?>/style/images/accueil/btn_con_acc.png" class="show"></img></li>-->
					<li><a href="/Inscription/index.php" class="test"></a></li>
                                        </ul>
                                    
				</div>
				<div id="galeries_bandas">
					<div id="galeries" class="show_galeries">
						<ul>
							<li><a href="<?php echo ROOTPATH; ?>/gatchos/galeries/photos.php" class="btn_photos"></a></li>
							<li><a href="<?php echo ROOTPATH; ?>/gatchos/galeries/videos.php" class="btn_videos"></a></li>
							<li><a href="<?php echo ROOTPATH; ?>/gatchos/galeries/musiques.php" class="btn_musiques"></a></li>
						</ul>
					</div>
				</div>
			</div>