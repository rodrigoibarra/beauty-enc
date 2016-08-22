<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<title>Beauty Encyclopedia</title>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">

	<!-- Bootrap CSS -->
	<link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">

</head>
<body>

	<!-- START: Navigation -->
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container-fluid">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/admin">Beauty Encyclopedia</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							Menú <span class="caret"></span>
						</a>
						@if(Auth::guest())
						<ul class="dropdown-menu">
							<li><a href="/login">Login</a></li>
						</ul>
						@else
						<ul class="dropdown-menu">
							<li><a href="/admin">Dashboard</a></li>
							@if(Auth::user()->is_superuser)
							<li><a href="/admin/brands">Marcas</a></li>
							<li><a href="/admin/categories">Categorias</a></li>
							<li><a href="/admin/families">Familias</a></li>
							<li><a href="/admin/countries">Paises</a></li>
							<li><a href="/admin/key-words">Palabras Clave</a></li>
							<li><a href="/admin/retailer-fields">Campos Retailer</a></li>
							@endif
							<li><a href="/admin/retailers">Retailers</a></li>
							<li><a href="/admin/products">Productos</a></li>
							@if(Auth::user()->is_superuser)
							<li role="separator" class="divider"></li>
							<li><a href="/admin/users">Usuarios</a></li>
							<li><a href="/admin/groups">Grupos</a></li>
							@endif
							<li role="separator" class="divider"></li>
							<li><a href="/logout">Logout</a></li>
						</ul>
						@endif
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->

		</div><!-- /.container-fluid -->
	</nav>
	<!-- END: Navigation -->

	<!-- START: Content -->
	<div class="container">
		@yield('content')
	</div>
	<!-- END: Content -->

	<!-- START: Footer -->
	<footer class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<hr>
				<p class="text-center text-muted small">
					Beauty Encyclopedia &copy2016
				</p>
			</div>
		</div>
	</footer>
	<!-- END: Footer -->

	<!-- START: Scripts bottom -->

	<!-- jQuery 2.2.4 -->
	<script src="/vendor/jquery/dist/jquery.min.js"></script>

	<!-- Bootrsap JS -->
	<script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

	@yield('scripts_bottom')

	<!-- END: Scripts bottom -->
</body>
</html>
