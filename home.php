<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en">
	<![endif]-->
	<!--[if IE 7]>
	<html class="no-js lt-ie9 lt-ie8" lang="en">
		<![endif]-->
		<!--[if IE 8]>
		<html class="no-js lt-ie9" lang="en">
			<![endif]-->
			<!--[if gt IE 8]>
			<!-->
			<html class="no-js" lang="en">
				<!--<![endif]-->
<head>

				<title>Code Médula &ndash; Blog de código</title>
				<meta name="description" content="Artículos relacionados con el desarrollo de página, aplicacciones y temas web en general.">
				<meta name="author" content="B. Agustín Amenabar L.">

				<meta name="viewport" content="width=device-width">

				<link rel="stylesheet" href="css/styles.css">

				<script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
</head>
<body>
				<!--[if lt IE 7]>
				<p class=chromeframe>
					Your browser is <em>ancient!</em>
					<a href="http://browsehappy.com/">Upgrade to a different browser</a>
					or
					<a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a>
					to experience this site.
				</p>
				<![endif]-->

				<div class="mainContainer">
					<header class="contiene-logo">
						<img src="img/content/logo-blog-medula-code.png" alt="Logotipo Médula Diseño Code Blog"></header><div class="articleGroup">
							<?php foreach ($articleList as $oneArticle): ?>
								<article>
									<header>
										<a href="?t=article&a=<?php echo $oneArticle['filename']; ?>"><h1><?php echo $oneArticle['title']; ?></h1>
											<?php if (isset($oneArticle['subtitle'])): ?>
											<h2><?php echo $oneArticle['subtitle']; ?></h2>	
											<?php endif ?></a>
									</header>
									<?php if (isset($oneArticle['intro'])): ?>
										<p><?php echo $oneArticle['intro'] ?></p>
									<?php endif ?>
								</article>
							<?php endforeach ?>
						</div><?php include "inc/template/aside-gral.php"; ?>

					</div>
					<!-- #main -->
				</div>
				<!-- #main-container -->

				<div id="footer-container">
					<footer class="wrapper">
						<h3>footer</h3>
					</footer>
				</div>

				<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
				<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>')</script>
				<script type="text/javascript" src="http://use.typekit.com/zod4yoy.js"></script>
				<script type="text/javascript">try{Typekit.load();}catch(e){}</script><!---->
			<script src="js/script.js"></script>
			<script>
/*	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));*/
</script>

</body>
		</html>