@extends('main_app.main_layout')

@section('content')

	<div class="contenedor row">
		<div class="inner">

			<!--SLIDER-->
			<section>
			<ul class="slider">
				<li>
					<a target="_blank" href="#">
						<img src="img/sliders/slider_general/slide1.jpg">
					</a>
				</li>
				<li>
					<a target="_blank" href="#">
						<img src="img/sliders/slider_general/slide2.jpg">
					</a>
				</li>
				<li>
					<a target="_blank" href="#">
						<img src="img/sliders/slider_general/slide3.jpg">
					</a>
				</li>
			</ul>
			<br style="clear:both;">
			</section>
			<!--SLIDER-->

			<section class="row">
				<div class="large-12 columns busqueda_wrap">
					<form id="busqueda_formulario" method="GET" action="/products">
					<input id="busqueda_home" class="autocompletar" type="text"  name="search" placeholder="BUSCAR:" autocomplete="off">
					</form>
					<div class="resultados"></div>
					<img class="busqueda_lupa" src="img/lupa_dorada.png">
				</div>
				<!-- <div class="large-4 columns botones_home">
					<a href="firmas.php"><div class="inner"><div class="interior"><img src="img/home_ico_firma.png" width="50" alt=""/><br>MARCAS</div></div></a>
				</div>
				<div class="large-4 columns botones_home">
					<a href="categorias.php"><div class="inner"><div class="interior"><img src="img/home_ico_categoria.png" width="30" alt=""/><br>CATEGORÍAS</div></div></a>
				</div>
				<div class="large-4 columns botones_home">
					<a href="contacto.php"><div class="inner"><div class="interior"><img src="img/home_ico_contacto.png" width="40" alt=""/><br>CONTACTO</div></div></a>
				</div> -->
			</section>

			<section>
			<h2><span>LOS MÁS VISTOS</span></h2>

				<div class="row">
                    @foreach($products as $product)
					<a title="<b>{{ $product->item_name }}</b> <br> STATUS: 
						@if($product->status == '00') Concepción 
						@elseif ($product->status == '03') Lanzamiento 
						@elseif ($product->status == '03') Lanzamiento 
						@elseif ($product->status == '05') Línea 
						@elseif ($product->status == '06') Vías de abandono 
						@elseif ($product->status == 'Y1') Ofertas armadas 
						@endif
					 	<br><span class='precio'>${{ $product->cost_per_unit }}</span>" href="/products/{{ $product->id }}">
						<span class="large-2 medium-4 small-6 columns producto">
							<div class="inner">
								<div class="imagen"><img onerror="this.src='img/broken.png'" src="/uploads/{{ $product->image }}"></div>
								<div class="titulo">{{ $product->item_name }}</div>
								<div class="firma"> {{ $product->brand->brand }}</div>
							</div>
						</span>
					</a>
                    @endforeach

					<!-- <a title="<b>Nombre del producto</b> <br> STATUS: En línea <br><span class='precio'>$20</span>" href="producto.php?id=32&title=nombre_del_producto">
						<span class="large-2 medium-4 small-6 columns producto">
							<div class="inner">
								<div class="imagen"><img onerror="this.src='img/broken.png'" src="img/productos/thumbs/50715.jpg"></div>
								<div class="titulo">Nombre del Producto</div>
								<div class="firma"> Firma / Categoría</div>
							</div>
						</span>
					</a>

					<a title="<b>Nombre del producto</b> <br> STATUS: En línea <br><span class='precio'>$20</span>" href="producto.php?id=32&title=nombre_del_producto">
						<span class="large-2 medium-4 small-6 columns producto">
							<div class="inner">
								<div class="imagen"><img onerror="this.src='img/broken.png'" src="img/productos/thumbs/53522.jpg"></div>
								<div class="titulo">Nombre del Producto</div>
								<div class="firma"> Firma / Categoría</div>
							</div>
						</span>
					</a>


					<a title="<b>Nombre del producto</b> <br> STATUS: En línea <br><span class='precio'>$20</span>" href="producto.php?id=32&title=nombre_del_producto">
						<span class="large-2 medium-4 small-6 columns producto">
							<div class="inner">
								<div class="imagen"><img onerror="this.src='img/broken.png'" src="img/productos/thumbs/67074.jpg"></div>
								<div class="titulo">Nombre del Producto</div>
								<div class="firma"> Firma / Categoría</div>
							</div>
						</span>
					</a>

					<a title="<b>Nombre del producto</b> <br> STATUS: En línea <br><span class='precio'>$20</span>" href="producto.php?id=32&title=nombre_del_producto">
						<span class="large-2 medium-4 small-6 columns producto">
							<div class="inner">
								<div class="imagen"><img onerror="this.src='img/broken.png'" src="img/productos/thumbs/45610.jpg"></div>
								<div class="titulo">Nombre del Producto</div>
								<div class="firma"> Firma / Categoría</div>
							</div>
						</span>
					</a>

					<a title="<b>Nombre del producto</b> <br> STATUS: En línea <br><span class='precio'>$20</span>" href="producto.php?id=32&title=nombre_del_producto">
						<span class="large-2 medium-4 small-6 columns producto">
							<div class="inner">
								<div class="imagen"><img onerror="this.src='img/broken.png'" src="img/productos/thumbs/111505.jpg"></div>
								<div class="titulo">Nombre del Producto</div>
								<div class="firma"> Firma / Categoría</div>
							</div>
						</span>
					</a> -->
				</div>
			</section>

@stop
