<!doctype html>
<html class="no-js" lang="en">
  <head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Catálogo L'Olréal</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="/css/foundation.css" />
	<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox.css">
	<link rel="stylesheet" type="text/css" href="/css/estilos.css">
	<link rel="stylesheet" type="text/css" href="/css/pgwslider.min.css">
	<script src="/js/vendor/modernizr.js"></script>
	<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="/css/addtohomescreen.css">


  </head>
  <body>

	<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>

	<!-- EMPIEZA MENÚ TOP-->
	<div id="menu_top" class="show-for-large-up">
		<div class="row">
				<div class="large-2 columns"><a href="/"><img class="logo" src="/img/logo_blanco.png" alt=""/></a></div>
				<div class="large-10 columns">
					<div class="large-1 columns menu_item"></div>
					<div class="large-1 columns menu_item"><a href="/">HOME</a></div>
					<div class="large-2 columns menu_item"><a href="/products">PRODUCTOS</a></div>
					<div class="large-2 columns menu_item"><a href="/retailers">RETAILERS</a></div>
					<!-- <div class="large-3 columns menu_item submenu_firmas_click">MARCAS Y CATEGORÍAS <img src="img/flecha_abajo.png" width="9" height="4" alt=""/></div> -->
					<div class="large-2 columns menu_item .busqueda_wrap_top"><form id="busqueda_formulario" method="GET" action="/products"><input name="search" class="autocompletar"><img class="busqueda_lupa busqueda_lupa_top" width="20" src="/img/lupa_gris.png"></form></div>
					<div class="large-4 columns menu_item">
                        <!-- PAIS!! -->
						<span class="usuario_nombre">{{ Auth::user()->name }} @if(Auth::user()->profile) -- {{ Auth::user()->profile->country->country }} @endif</span>
						<!-- <img class="login_button" src="/img/login.png" alt=""/> -->
						<div id="submenu_login">
							<ul>
                                @if(in_array('Administradores', Auth::user()->roles->lists('name')->toArray()) or Auth::user()->is_superuser)
                                <a href="/admin"><li>ADMIN</li></a>
                                @endif
								<a href="/logout" class="logout"><li>LOGOUT</li></a>
							</ul>
						</div>
					</div>
				</div>
		</div>
	</div>


	<!-- TERMINA MENÚ TOP-->

	<!--EMPIEZA OFF CANVAS MENU -->
	<div id="menu_off" class="off-canvas-wrap" data-offcanvas>
		<div class="inner-wrap">

			<nav class="tab-bar show-for-medium-down" >
				<section class="middle tab-bar-section">
					 <img src="/img/logo_blanco.png" alt="" height="20" class="logo"/>
				</section>

				<section class="left-small">
					<a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
				</section>
			</nav>

			<!-- Off Canvas Menu -->
			<aside class="left-off-canvas-menu">

					<ul>
						<a href="#"><li>ADMIN</li></a>
						<a href="/products"><li>PRODUCTOS</li></a>
						<a href="/retailers"><li>RETAILERS</li></a>
						<a class="/logout"><li>LOG OUT</li></a>

					</ul>
			</aside>

			@yield('content')
	<!--TERMINA PRIMERA PARTE OFF CANVAS MENU -->
			<footer class="footer">
				“©Copyright 2014 Beauty Encyclopedia de Frabel, S.A. de C.V. (en adelante L´ORÉAL). Tanto el Sitio como los elementos que lo componen (marcas, logotipos, fotografías, imágenes, ilustraciones, textos, clips de vídeo, etc.) constituyen la propiedad exclusiva de L´ORÉAL, y se encuentran protegidos por los derechos de autor y la Ley de Propiedad Industrial. El acceso a la página no otorga ninguna licencia ni otro tipo de derecho, exceptuando el de consultar el Sitio en el marco de su uso con fines estrictamente privados”
			</footer>

		</div><!--INNER-->
	</div><!--CONTENEDOR-->



<!-- CIERRE OFF CANVAS MENU -->

	<a class="exit-off-canvas"></a>

	</div><!--inner-wrap -->
	</div><!--off-canvas-wrap -->

	<!-- CIERRE OFF CANVAS MENU -->



	<script src="/js/vendor/jquery.js"></script>
	<script src="/fancybox/jquery.fancybox.js"></script>
	<script src="/js/foundation.min.js"></script>
	<script src="/js/funciones.js"></script>
	<script src="/js/jquery-ui.js"></script>
	<script src="/js/jquery.placeholder.js"></script>
	<script src="/js/pgwslider.min.js"></script>
	<script src="/owl-carousel/owl.carousel.js"></script>
	<script src="/js/slider-multimedia.js"></script>

    @yield('scripts')


	</body>
</html>
