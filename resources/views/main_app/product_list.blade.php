@extends('main_app.main_layout')

@section('content')

	<div class="contenedor row">


		<div class="inner">

			<div class="row">
			<!-- EMPIEZA ASIDE -->
			<aside class="large-4 columns sidebar_filtros">
				<form action="" id="filterForm">
					<input name="id" type="hidden" value="">
					<input id="perfil" name="perfil" type="hidden" value="">
					<input name="cat" type="hidden" value="">
					<input name="registros" type="hidden" value="100">

					<h1><span>FILTROS</span></h1>

					<div class="large-6 columns">
						Marca:
						<select class="firmas_cat" name="brand_id">
                            <option value="">Selecciona...</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                            @endforeach
						</select>
					</div>

					<div class="large-6 columns">
						<div class="catch_marcas"></div>
					</div>

					<div class="divisor_3"></div>

					<h3>CATEGORÍA:</h3>

                    <div class="large-6 columns">
						<select class="firmas_cat" name="category_id">
                            <option value="">Selecciona...</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
						</select>
					</div>

					<!-- <div class="large-6 columns categoria_check">
					  <input type="checkbox" name="categorias[]" id="body"  class="css-checkbox categorias" value="Body" /><label for="body" class="css-label">Body</label>
					</div>

					<div class="large-6 columns categoria_check">
					  <input type="checkbox" name="categorias[]" id="coloracion"  class="css-checkbox categorias" value="Coloración"/><label for="coloracion" class="css-label">Coloración</label>
					</div>

					<div class="large-6 columns categoria_check">
					  <input type="checkbox" name="categorias[]" id="hair" class="css-checkbox categorias"  value="Hair Care" /><label for="hair" class="css-label">Hair Care</label>
					</div>

					<div class="large-6 columns categoria_check">
					  <input type="checkbox" name="categorias[]" id="makeup"  class="css-checkbox categorias" value="Make Up"/><label for="makeup" class="css-label">Make Up</label>
					</div>

					<div class="large-6 columns categoria_check">
					  <input type="checkbox" name="categorias[]" id="perfume"  class="css-checkbox categorias" value="Perfume"/><label for="perfume" class="css-label">Perfume</label>
					</div>

					<div class="large-6 columns categoria_check">
					  <input name="categorias[]" type="checkbox" class="css-checkbox categorias" id="skin" value="Skin Care" /><label for="skin" class="css-label">Skin Care</label>
					</div>

					<div class="large-6 columns categoria_check">
					  <input type="checkbox" name="categorias[]" id="style" class="css-checkbox categorias" value="Style"/><label for="style" class="css-label">Style</label>
					</div>

					<div class="large-6 columns categoria_check">
					  <input type="checkbox" name="categorias[]" id="toiletries" class="css-checkbox categorias"  value="Toiletries"/><label for="toiletries" class="css-label">Toiletries</label>
					</div> -->


					<div class="divisor_3"></div>
					<h3>ESTATUS:</h3>

					<div class="large-6 columns categoria_check">
					 	<input type="checkbox" name="status[]" id="linea" value="05" class="css-checkbox categoria" /><label for="linea" class="css-label">En línea</label>
					</div>
					<div class="large-6 columns categoria_check">
						<input type="checkbox" name="status[]" id="concepcion" value="00" class="css-checkbox categoria" /><label for="concepcion" class="css-label">Concepción</label>
					</div>
					<div class="large-6 columns categoria_check">
						<input type="checkbox" name="status[]" id="viasabandono" value="06" class="css-checkbox categoria" /><label for="viasabandono" class="css-label">V. abandono</label>
					</div>
					<div class="large-6 columns categoria_check">
						<input type="checkbox" name="status[]" id="inout" value="In & Out" class="css-checkbox categoria" /><label for="inout" class="css-label">In & Out</label>
					</div>
					<div class="large-6 columns categoria_check">
						<input type="checkbox" name="status[]" id="lanzamiento" value="03" class="css-checkbox categoria" /><label for="lanzamiento" class="css-label">Lanzamiento</label>
					</div>
					<div class="large-6 columns categoria_check">
						<input type="checkbox" name="status[]" id="muerto" value="Y1" class="css-checkbox categoria" /><label for="muerto" class="css-label">Ofertas Armadas</label>
					</div>

					<div class="divisor_3"></div>

					<h3>COSTO UNITARIO:</h3>

					<div id="rango_precio"></div>
					<input id="amount" class="rango" type="text" value="$0 - $1000" disabled>
					<input id="min" name="min" value="" type="hidden" >
					<input id="max" name="max"  value="" type="hidden" >
					<input id="pagina" name="pagina"  value="" type="hidden" >
					<input id="ordenar_hidden" name="ordenar_hidden"  value="" type="hidden" >


					<div class="divisor_3"></div>
					<!-- <div class="large-6 columns centrar"><span class="button transicion resetear">RESET</span></div>
					<div class="large-6 columns centrar"><span class="button transicion filtrar">FILTRAR</span></div> -->
					<input type="submit" class="btn button filtrar" name="submit" value="Filtrar">
				 </form>
			</aside>

			<!-- TERMINA ASIDE -->

			<div class="large-8 columns" id="productos">

				<h1><span>Productos</span></h1>
				<div class="contenedor_resultados">

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
						<span class="large-3 medium-4 small-6 columns producto">
							<div class="inner">
							<div class="imagen"><img onerror="this.src='/img/broken.png'" src="/uploads/{{ $product->image }}"></div>
							<div class="titulo">{{ $product->item_name }}</div>
							<div class="firma"> {{ $product->category->name }} </div>
							</div>
						</span>
					</a>
                    @endforeach

				</div>
			</div>
			</div>



@stop

@section('scripts')
<script>
	$(document).ready(function(){
		$('body').on('submit', '#filterForm', function(evt){

			evt.preventDefault();
			$this = $(this);

			console.log($this.serializeArray());

			$.ajax({
				url : $this.attr('action'),
				method : $this.attr('method'),
				data   : $this.serialize()
			}).done(function(data){
				$('#productos').html(data);
			})

		});
	});
</script>
@stop
