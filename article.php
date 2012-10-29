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
			<html class="no-js<?php if(isset($theArticle->classes))echo ' '.$theArticle->classes ;?>" lang="en">
				<!--<![endif]-->
<head>
				<meta charset="utf-8">

				<title><?php echo $theArticle->title; ?>Code Médula &ndash; Blog de código</title>
				<?php if (isset($theArticle->subtitle)): ?>
					<meta name="description" content="<?php echo $theArticle->subtitle; ?>">
				<?php endif ?>
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
						<a href="./"><noscript>
							<img src="img/content/logo-blog-medula-code.png" alt="Logotipo Médula Diseño Code Blog">
						</noscript></a></header><article>
						<?php require $theArticle->path; ?>
							<footer>
								<?php if ( isset($theArticle->tags) && $theArticle->tags ): ?>
									<h2>Tags: <?php echo $theArticle->tags; ?></h2>
								<?php endif ?>
								<h2>Comments</h2>
								<div id="disqus_thread"></div>
								<script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'codeblogmedula'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
								<noscript>
									Please enable JavaScript to view the
									<a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
								</noscript>
								<a href="http://disqus.com" class="dsq-brlink">
									comments powered by
									<span class="logo-disqus">Disqus</span>
								</a>
							</footer>
						</article><?php include "inc/template/aside-gral.php"; ?>

					</div>
				<!-- #main-container -->

				<div id="footer-container">
					<footer class="wrapper">
						<h3>Artículos recientes</h3>
						<?php include "inc/template/recientes.php"; ?>
					</footer>
				</div>

				<script type="text/javascript" src="http://use.typekit.com/zod4yoy.js"></script>
				<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
				<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
				<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>')</script>

			<script src="js/script.js"></script>
			<script>

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