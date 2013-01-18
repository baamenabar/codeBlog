<?php header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache'); ?><!doctype html>
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
				<meta name="description" content="Artículos relacionados con el desarrollo de páginas web, aplicacciones y temas web en general.">
				<meta name="author" content="B. Agustín Amenabar L.">

				<meta name="viewport" content="width=device-width, initial-scale=1">

				<link rel="stylesheet" href="css/styles.css?ck=<?php echo filemtime("css/styles.css"); ?>">

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
						<a href="./"><noscript>
							<img src="img/content/logo-blog-medula-code.png" alt="Logotipo Médula Diseño Code Blog">
						</noscript></a></header><div class="corporis">
							<div class="articleGroup">
							<?php foreach ($articleList as $oneArticle): ?>
								<article>
									<header>
										<a href="./article_<?php echo urlencode( $oneArticle['cleanname'] ); ?>.html"><h1><?php echo $oneArticle['title']; ?></h1>
											<?php if (isset($oneArticle['subtitle'])): ?>
											<h2><?php echo $oneArticle['subtitle']; ?></h2>	
											<?php endif ?></a>
									</header>
									<?php if (isset($oneArticle['pubDate'])): ?>
										<p class="pubDate">Publicado: <time datetime="<?php echo $oneArticle['pubDate'] ?>"><?php echo $oneArticle['pubDate'] ?></time><?php if (isset($oneArticle['author'])): ?> | <?php echo $oneArticle['author'] ?> <?php endif ?></p>
									<?php endif ?>
									<p><?php if (isset($oneArticle['intro'])): ?>
										<?php echo $oneArticle['intro'] ?>
									<?php endif ?>
									<a href="./article_<?php echo urlencode( $oneArticle['cleanname'] ); ?>.html"><i lang="en">Read more</i> / Leer más</a></p>
								</article>
							<?php endforeach ?>
						</div><?php include "inc/template/aside-gral.php"; ?>
						</div>
					</div>
				<!-- #main-container -->

				<div id="footer-container">
					<footer>
						<?php include "inc/template/creditos.php"; ?>
					</footer>
				</div>

				<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
				<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>')</script>
				<script type="text/javascript" src="http://use.typekit.com/zod4yoy.js"></script>
				<script type="text/javascript">try{Typekit.load();}catch(e){}</script><!---->
			<script src="js/script.js"></script>
			<script>
/* testing what's available with modernizr
$(document).ready(function(){
$('.rtest').html('<ul><li>'+$('html').attr('class').split(' ').join('</li><li>')+'</li></ul>' );
});*/


  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23469330-1']);
  _gaq.push(['_setDomainName', 'medula.cl']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
		</html>