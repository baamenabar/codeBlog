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
				<meta charset="utf-8">

				<title>Code Médula &ndash; Blog de código</title>
				<meta name="description" content="Artículos relacionados con el desarrollo de página, aplicacciones y temas web en general.">
				<meta name="author" content="B. Agustín Amenabar L.">

				<meta name="viewport" content="width=device-width">

				<link rel="stylesheet" href="css/styles.css">

				<script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
				<script type="text/javascript" src="http://use.typekit.com/zod4yoy.js"></script>
				<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
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
					<header>
						<img src="img/content/logo-blog-medula-code.png" alt="Logotipo Médula Diseño Code Blog"></header>
					<div class="wrapper clearfix">

						<article>
							<header>
								<hgroup>
									<h1>
										Git + github + Service Hooks = renovado flujo de trabajo en PHP
									</h1>
									<h2>Reemplazando el uso de FTP por Git + github</h2>
									<h3>&hellip;or Bitbucket</h3>
								</hgroup>
								<p>yyy-mm-dd: 2012-05-28 | servidor, DNS | Por: Agutín Amenabar</p>
							</header>
							<p>
								Finalmente me he sentado a aprender cómo usar Git y particularmente cómo conectar git a mi servidor, para que se vayan publicando inmediatamente los cambios hechos.
							</p>
							<p>La verdad me ha tomado varios intentos y fracasos.</p>
							<p>
								La mayor parte la logré siguiendo el tutorial
								<a href="http://net.tutsplus.com/tutorials/other/the-perfect-workflow-with-git-github-and-ssh/" title="visitar el artículo" target="_blank">The Perfect Workflow, with Git, GitHub, and SSH</a>
								de net tut+ que tiene hasta un video.
							</p>
							<p>
								Sólo lo he traducido y he agregado algunas cosas que me complicaron al seguir el tutorial.
							</p>

							<p>
								Hace tiempo tengo una cuenta en github, pero más que nada la usaba para estar pendiente de algunos proyectos y reportar <i>bugs</i>
								, lo mismo con la línea de comando y SSH, siempre con un ojo en el tutorial y el otro en la consola. Pero hace un par de días estoy batallando con las múltiples cosas que hay que echar a andar y finalmente lo he logrado, no fue tan terrible como pensé originalmente, dado que Chris Coyier había comentado lo complicado que era hacer esto.
							</p>

							<p>
								Debo aclarar que soy un diseñador, que hasta hace un mes no tenía idea sobre:
							</p>
							<ul>
								<li>SSH</li>
								<li>Línea de comando</li>
								<li>PuTTY</li>
								<li>GIT</li>
							</ul>

							<p>
								Y aunque aún entiendo muy poco de esas cosas esotéricas han pasado a ser parte de mi flujo de trabajo y no entiendo cómo vivía sin ellos. todo es mucho más rápido y lo mejorde todo es que son gratis!
							</p>

							<p>
								Voy a hacer el ejemplo con el código de este mismo blog mientras lo construyo.
							</p>
							<p>Paso por paso.</p>
							<h2>Repositorio local</h2>
							<p>
								OK, asumiendo que ya está GIT instalado, corriendo localmente (con tortoise en mi caso) y tenemos una cuenta github, hacemos un nuevo repositorio en la carpeta del sitio, agregamos los archivos del sitio y hacemos el primer commit.
							</p>
							<figure>
								<blockquote>
									<kbd>
										<pre>
cd carpeta/de/proyecto
git init
git add .
git commit -m 'primer commit'
									</pre>
									</kbd>

								</blockquote>
								<figcaption>Cómo hacerlo desde la línea de comando.</figcaption>
							</figure>
							<figure>
								<img src="img/content/git-workflow-01.png" alt="Menú contextual, Crear repositorio aquí">
								<figcaption>Nuevo repositorio con tortoise.</figcaption>
							</figure>

							<h2>Subirlo a github</h2>
							<p>Ahora a hacer un nuevo repositorio en github.</p>
							<figure>
								<img src="img/content/git-workflow-03.png">
								<figcaption>Clic en "nuevo Repositorio"</figcaption>
							</figure>
							<figure>
								<img src="img/content/git-workflow-04.png">
								<figcaption>Se llena el simple formulario y se crea el proyecto.</figcaption>
							</figure>
							<p>
								En la página que aparece luego sale la dirección HTTP del proyecto, hay que buscar la dirección SSH.
							</p>
							<figure>
								<img src="img/content/git-workflow-05.png">
								<figcaption>
									El formato de la dirección es: git@github.com:nombreUsuario/nombreProyecto.git
								</figcaption>
							</figure>
							<p>
								Esta dirección es útil porque nos permitirá hacer push desde nuestro repositorio local, como siempre se puede hacer de 2 maneras:
							</p>
							<h3>SSH</h3>
							<figure>
								<pre>
<kbd>
git remote add origin git@github.com:nombreUsuario/nombreProyecto.git
git push -u origin master
</kbd>
</pre>
							</figure>
							<h3>GUI, como TortoiseGIT</h3>
							<p>
								Haciendo click derecho en la carpeta del proyecto se abre TortoiseGIT &rquo; Push...
							</p>
							<p>
								En la ventana que aparece, en el grupo
								<q>Destination</q>
								haceer click en
								<q class="boton">Manage</q>
								.
							</p>
							<figure>
								<img src="img/content/git-workflow-06.png"></figure>
							<p>
								Ojo que en el primer push hay que marcar la opción
								<q> <i>Force Overwrite Existing Branch (May discard changes)</i>
								</q>
								para que no entre en conflicto con la versión del repositorio que tiene github.
							</p>
							<p>
								En la ventana que aparece hay que llenar los campos con: el nombre del proyecto, la URL de SSH que copiamos de Github y cargamos la
								<i>putty key, navegando hasta donde esté guardada.</i>
							</p>
							<figure>
								<img src="img/content/git-workflow-07.png">
								<figcaption>
									Esta configuración es práctico guardarla apretando el botón:
									<q class="boton">Add new/Save</q>
								</figcaption>
							</figure>
							<p>
								Ahora sólo hay que apretar
								<q class="boton">OK</q>
								, probablemente va a pedir la contraseña de la llave putty.
							</p>
							<p>Si revisamos en github, está todo arriba.</p>

							<h2>Actualizar el servidor desde GIT</h2>
							<p>
								Hasta ahora no hay nada nuevo, ninguna ventaja sobre FTP (aparte del versionamiento), pero ahora haremos que el servidor cargue los archivos desde github, o sea que haga un
								<i>pull</i>
								.
							</p>
							<h3>Requisitos</h3>
							<ul>
								<li>Conectarse al servidor via SSH. Personalmente uso PuTTY</li>
								<li>
									Tener Git instalado en el servidor. Media Temple viene con Git instalado
								</li>
								<li>
									<a href="http://oreilly.com/pub/h/66" target="_blank" title="Cómo autenticar un servidor con llaves ssh y sin clave.">Tener autentificado el servidor con github</a>
									<a href="http://www.endreywalder.com/blog/authenticate-github-on-mediatemple-grid-shared-server/" title="Ver artículo de cómo hacerlo en Mediatemple">Aqí un tutorial para Media Temple</a>
								</li>
							</ul>
							<h3>Empecemos</h3>
							<figure>
								<img src="img/content/git-workflow-08.png">
								<figcaption>Entrando por SSH con PuTTY</figcaption>
							</figure>
							<p>
								Luego navegamos hasta nuestro directorio, que en este caso es
								<kbd>cd domains/code.medula.cl/html</kbd>
							</p>
							<p>Desde ahí podemos clonar el repositorio de github.</p>
							<figure>
								<img src="img/content/git-workflow-09.png">
								<figcaption>
									<kbd>git clone git@github.com:nombreUsuario/nombreProyecto.git</kbd>
								</figcaption>
							</figure>
							<p>
								Toma unos segundos y ya tenemos una carpeta con el nombre del repositorio.
							</p>
							<p>
								En este caso eso es un problema, yo quería que el index quedara directo en el sub-dominio
								<q>
									<code>code.medula.cl</code>
								</q>
								y no dentro de la carpeta
								<q>
									<code>code.medula.cl/codeBlog</code>
								</q>
								.
							</p>
							<p>
								Al hacer una búsqueda en Google por &ldquo;git clone empty directory&rdquo; llegué a un grupo de Google donde se toca el tema, y <b>Lee Henson</b>
								<a href="https://groups.google.com/group/github/browse_thread/thread/1c9a5d6c823607aa?pli=1#msg_99022fb5dd2b2bb4">da la respuesta que necesitaba</a>
							</p>
							<figure>
								<img src="img/content/git-workflow-10.png">
								<figcaption>
									<kbd>git clone git@github.com:nombreUsuario/nombreProyecto.git ./</kbd>
								</figcaption>
							</figure>
							<p>
								Al parecer el comando
								<q>
									<kbd>git clone</kbd>
								</q>
								acepta un segundo parámetro que es la dirección donde clonar (estoy suponiendo).
							</p>
							<p>
								De aquí en adelante no hay que hacer
								<q>
									<kbd>git clone git@github...</kbd>
								</q>
								si no que usaremos
								<q>
									<kbd>git pull</kbd>
								</q>
							</p>
							<h2>Automatizar</h2>
							<p>
								Todo esto está muy bien, pero sigue siendo bastante más aparatoso que FTP ¿no?
							</p>
							<p>
								Bueno, aquí viene la magia, vamos a automatizar el proceso para que cada vez que hagamos un push a Github queden inmediatamente publicados los cambios en el servidor con el sitio.
							</p>
							<h3>En github</h3>
							<p>
								En la página del proyecto en github, hay que apretar el botón admin.
							</p>
							<figure>
								<img src="img/content/git-workflow-11.png">
								<figcaption>Este botón nos llevará a la página de admin del proyecto.</figcaption>
							</figure>
							<p>
								En la página de admin hay que apretar <strong>Service Hooks</strong>
								.
							</p>
							<figure>
								<img src="img/content/git-workflow-12.png">
								<figcaption>
									En el campo URL hay que poner la dirección del archivo que ejecutará el
									<i>pull</i>
									<q>
										<kbd>http://code.medula.cl/gitpull.php</kbd>
									</q>
									(no lo hemos hecho aún, pero le inventamos el nombre ahora)
								</figcaption>
							</figure>
							<p>
								Esto hará que Github envíe un POST a la dirección escrita ahí, en el post irá info asociada al push, pero en este caso no nos interesa.
							</p>
							<p>
								Apretamos
								<q class="boton">Update Settings</q>
								y estamos con github.
							</p>

							<h3>En Bitbucket</h3>
							<p>
								En la página del repositorio ir a la pestaña
								<q class="boton">Admin</q>
								, apretar
								<i>Services</i>
								a la izquierda y en el select que aparece, seleccionar
								<i>POST</i>
								de la lista, y apretar
								<q class="boton">Add Service</q>
								donde aparecerá un campo para llenar con una URL, se usa la misma que usaríamos en github
								<q>
									<kbd>http://code.medula.cl/gitpull.php</kbd>
								</q>
								.
							</p>

							<h3>El archivo PHP</h3>
							<p>
								Ahora, en la raíz del proyecto haremos un nuevo archivo
								<q>
									<code>gitpull.php</code>
								</q>
								y lo agregamos a git.
							</p>
							<figure>
								<img src="img/content/git-workflow-13.png">
								<figcaption>
									Los iconitos delatan que aún tengo a Dreamweaver como editor predeterminado para PHP :$
								</figcaption>
							</figure>
							<p>Abrimos el archivo y escribilos lo siguiente:</p>
							<figure>
								<pre><code>
 		&lt;?php
 		`git pull`;
 		?>
 	</code></pre>
								<figcaption>Si, eso es todo.</figcaption>
							</figure>
							<p>
								Ojo que no es una cadena, el caracter que lo envuekve no es
								<q>
									<kbd>&#39;</kbd>
								</q>
								la típica comilla simple, si no que es
								<q>
									<kbd>&#96;</kbd>
								</q>
								un tilde grave (al revés del normal). Cuando se usan esas comillas es lo mismo que meter una cadena dentro de
								<q>
									<code>bash_exec(); </code>
								</q>
								.
							</p>
							<p>Se hace un nuevo commit y push a Github.</p>
							<p>
								Entramos una última vez al servidor por SSH, navegamos hasta la carpeta y hacemos un último
								<q>
									<kbd>git pull</kbd>
								</q>
							</p>
							<p>
								En mi caso el servidor me pide el
								<i>pass phrase</i>
								de la llave, pero igual funciona automáticamente, creo que es porque tengo otra llave sin clave para Github (eso lo veré en otro artículo).
							</p>
							<p>
								Y eso es todo, ya podemos ver los cambios reflejados en este sitio a penas hago un push a Github o Bitbucket.
							</p>
							<h2>Fuentes:</h2>
							<ul>
								<li>
									http://net.tutsplus.com/tutorials/other/the-perfect-workflow-with-git-github-and-ssh/ (+comment from Todd)
								</li>
								<li>
									http://www.endreywalder.com/blog/authenticate-github-on-mediatemple-grid-shared-server/
								</li>
								<li>
									http://douglasjarquin.com/post/1273916314/git-on-media-temple
								</li>
								<li>
									http://blog.newgoldleaf.com/post/187406428/git-on-mediatemple (con (gs))
								</li>

								<li>
									http://www.geekgumbo.com/2010/05/16/removing-deleted-files-from-your-git-working-directory/ (sacar arhivos eliminados)//git add -A && git add -u
								</li>
							</ul>
							<footer>
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
						</article>

						<aside>
							<section>
								<h2>Recomendados</h2>
								<ul>
									<li>
										<a href="#">
											<h4>Cómo hostear sólo un sub-dominio en tu servidor</h4>
										<p>Una buena opción para mini sitios cuando no podemos trabajar en el servidor oficial.</p>
										</a>
									</li>
									<li>

										<a href="#">
											<h4>Primeros pasos con Sencha Touch 2</h4>
	<p>Y los típicos errores con los que uno se encuentra.</p>
										</a>
									</li>
									<li>

										<a href="#">
											<h4>Integración webpay de transbank</h4>
	<p>Para el Kit de Conexión de Comercio v. 6.0</p>
										</a>
									</li>
									<li>

										<a href="#">
											<h4>Git + github + Service Hooks = new workflow in PHP</h4>
	<p>Replacing FTP for GIT+github (noob tutorial for noobs by a noob)</p>
										</a>
									</li>
								</ul>
							</section>
							<div class="grupo">
								<section>
									<h2>Anteriores</h2>
									<ul>
										<li>
											<a href="#">
												Cómo hostear sólo un sub-dominio en tu servidor
											</a>
										</li>
										<li>

											<a href="#">
												Primeros pasos con Sencha Touch 2
											</a>
										</li>
										<li>

											<a href="#">
												Integración webpay de transbank
											</a>
										</li>
										<li>

											<a href="#">
												Git + github + Service Hooks = new workflow in PHP
											</a>
										</li>
									</ul>
								</section>
								<section>
									<h2>Acerca de&hellip;</h2>
									<p>En este blog publicamos cosas que descubrimos trabajando en proyectos de <a href="http://medula.cl" target="_blank">Médula Diseño</a>  y nos gustaría compartir.</p>
<p>El tema principal es código en los diferentes sabores que trabajamos o vamos descubriendo.</p>
<p>Este blog en particular lo llevamos como sitio estático (o casi) y está publicado en Github, así que si cometo un error  se puede hacer un “bug report” en el pryecto del sitio.</p>
								</section>
							</div>
						</aside>

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

			<script src="js/script.js"></script>
			<script>
/*	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));*/
</script>

</body>
		</html>