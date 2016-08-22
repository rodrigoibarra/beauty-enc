@extends('layouts.admin_layout')


@section('content')

<section class="row">

	<div class="col-md-12 brands">

		<!-- START: Title -->
		<h2 class="text-center">Productos</h2>
		<hr>
		<!-- END: Title -->

		<!-- START: Errors -->
		@if(!$errors->isEmpty())
		@foreach($errors->all() as $error)
		<div class="alert alert-danger" role="alert">
			{{ $error }}
		</div>
		@endforeach
		@endif
		<!-- END: Errors -->

		<!-- START: Actions -->
		<div class="col-md-12 actions">
			<button
				type="button"
				class="btn btn-default pull-right"
				data-toggle="modal"
				data-target="#addProductModal">
				<i class="fa fa-plus" aria-hidden="true"></i> Añadir Producto
			</button>
		</div>
		<!-- END: Actions -->

		<!-- START: search -->
		<div class="col-md-12">
			<form action="" method="get" class="form-inline">
				<div class="form-group text-right">
					<div class="input-group">
						<input type="text" class="form-control" name="search">
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Buscar</button>
			</form>
		</div>
		<!-- END: search -->

		<!-- START: Brands table -->
		<table class="table table-striped text-center">

			<!-- START: Brands table headers -->
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Producto</th>
					<th class="text-center">Categoría</th>
					<th class="text-center">Familia</th>
					<th class="text-center">Marca</th>
					<th class="text-center">Acciones</th>
				</tr>
			</thead>
			<!-- END: Brands table headers -->

			<!-- START: Brands table body -->
			<tbody>
				@foreach($products as $product)
				<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->item_name }}</td>
					<td>{{ $product->category->name }}</td>
					<td>{{ $product->family->name }}</td>
					<td>{{ $product->brand->brand }}</td>
					<td>
						<a href="#"><i class="fa fa-pencil edit-btn" data-id="{{ $product->id }}" aria-hidden="true"></i></a>
						&nbsp;
						<a href="/products/{{ $product->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
						&nbsp;
						@if(Auth::user()->is_superuser or in_array('Administradores', Auth::user()->roles->lists('name')->toArray()))
						<a href="/admin/products/{{ $product->id }}/confirmation"><i class="fa fa-trash delete-btn" data-id="{{ $product->id }}" aria-hidden="true"></i></a>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
			<!-- END: Brands table body -->

		</table>
		<!-- END: Brands table -->
	</div>
	<div class="row pagination">
		<div class="col-md-12">
			{{ $products->links() }}
		</div>
	</div>
</section>

<!-- START: Modal add product -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}


				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Añadir Producto</h4>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label for="status_id">Status:</label>
						<select name="status" class="form-control">
							<option value="00">Concepción</option>
							<option value="03">Lanzamiento</option>
							<option value="05">Línea</option>
							<option value="06">Vías de abandono</option>
							<option value="Y1">Ofertas armadas</option>
						</select>
					</div>

					<div class="form-group">
						<label for="vendor_code_id">Código del Vendedor</label>
						<input type="text" class="form-control" id="vendor_code_id" name="vendor_code">
					</div>

					<!-- el nombre del proveedor siempre va a ser Frabel S.A. de C.V., se puede hardcodear??????!!!!! -->
					<div class="form-group">
						<label for="supplier_id">Nombre del proveedor</label>
						<input type="text" class="form-control" id="supplier_id" name="supplier">
					</div>

					<div class="form-group">
						<label for="sku_vendor_id">SKU vendedor</label>
						<input type="text" class="form-control" id="sku_vendor_id" name="sku_vendor">
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="variation" value="1"> ¿Es una variación?

								</label>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="variation_type_id">Nombre del Tipo de Variación</label>
								<input type="text" class="form-control" id="variation_type_id" name="variation_type">
							</div>
						</div>

					</div>

					<div class="form-group">
						<label for="family_id">Familia</label>
						<select name="family_id" class="form-control">
							@foreach($families as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="brand_id">Marca</label>
						<select name="brand_id" class="form-control">
							@foreach($brands as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="item_name_id">Nombre del Producto</label>
						<input type="text" class="form-control" id="item_name_id" name="item_name">
					</div>

					<div class="form-group">
						<label for="sku_id">SKU - Número de modelo para mostrar en sitio web</label>
						<input type="text" class="form-control" id="sku_id" name="sku">
					</div>

					<div class="form-group">
						<label for="currency_id">Tipo Moneda</label>
						<input type="text" class="form-control" id="currency_id" name="currency">
					</div>

					<div class="form-group">
						<label for="cost_per_unit_id">Costo Unitario en Factura</label>
						<input type="text" class="form-control" id="cost_per_unit_id" name="cost_per_unit">
					</div>

					<div class="form-group">
						<label for="mesurement_unit_id">Unidad de Medida PPU</label>
						<input type="text" class="form-control" id="mesurement_unit_id" name="mesurement_unit">
					</div>

					<div class="form-group">
						<label for="mesurement_unit_n_id">Contenido PPU</label>
						<input type="text" class="form-control" id="mesurement_unit_n_id" name="mesurement_unit_n">
					</div>

					<div class="form-group">
						<label for="origin_id">País de Origen</label>
						<input type="text" class="form-control" id="origin_id" name="origin">
					</div>

					<div class="checkbox">
						<label>
							<input type="checkbox" name="included_expiration_date" value="1"> ¿El producto incluye fecha de expiración?
						</label>
					</div>

					<div class="form-group">
						<label for="life_span">Vida útil del producto (días)</label>
						<input type="text" class="form-control" id="life_span" name="life_span">
					</div>

					<div class="form-group">
						<label for="recomended_retail_price_id">Precio Recomendado de Venta</label>
						<input type="text" class="form-control" id="recomended_retail_price_id" name="recomended_retail_price">
					</div>

					<div class="form-group">
						<label for="external_id_type_id">Tipo de ID Externo</label>
						<input type="text" class="form-control" id="external_id_type_id" name="external_id_type">
					</div>

					<div class="form-group">
						<label for="external_id">External ID</label>
						<input type="text" class="form-control" id="external_id" name="external_id">
					</div>

					<div class="form-group">
						<label for="width_id">Ancho del producto</label>
						<input type="text" class="form-control" id="width_id" name="width">
					</div>

					<div class="form-group">
						<label for="height_id">Alto del producto</label>
						<input type="text" class="form-control" id="height_id" name="height">
					</div>

					<div class="form-group">
						<label for="length_id">Longitud del producto</label>
						<input type="text" class="form-control" id="length_id" name="length">
					</div>

					<div class="form-group">
						<label for="weight_id">Peso (No Contenido)</label>
						<input type="text" class="form-control" id="weight_id" name="weight">
					</div>

					<div class="form-group">
						<label for="package_width_id">Ancho Paquete</label>
						<input type="text" class="form-control" id="package_width_id" name="package_width">
					</div>

					<div class="form-group">
						<label for="package_height_id">Alto Paquete</label>
						<input type="text" class="form-control" id="package_height_id" name="package_height">
					</div>

					<div class="form-group">
						<label for="package_length_id">Longitud Paquete</label>
						<input type="text" class="form-control" id="package_length_id" name="package_length">
					</div>

					<div class="form-group">
						<label for="mass_id">Mass</label>
						<input type="text" class="form-control" id="mass_id" name="mass">
					</div>

					<!-- Tipo de producto -->

					<div class="form-group">
						<label for="category_id">Categoria</label>
						<select name="category_id" class="form-control">
							@foreach($categories as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>

					<!-- FALTA SUBCATEGORÍA -->

					<!-- FALTA SUBCATEGORÍA -->


					<div class="form-group">
						<label for="short_description_id">Descipción Corta</label>
						<textarea name="short_description" id="short_description_id" class="form-control"></textarea>
					</div>

					<div class="form-group">
						<label for="feature_1_id">Característica 1</label>
						<textarea name="feature_1" id="feature_1_id" class="form-control"></textarea>
					</div>

					<div class="form-group">
						<label for="feature_2_id">Característica 2</label>
						<textarea name="feature_2" id="feature_2_id" class="form-control"></textarea>
					</div>

					<div class="form-group">
						<label for="feature_3_id">Característica 3</label>
						<textarea name="feature_3" id="feature_3_id" class="form-control"></textarea>
					</div>


					<div class="form-group">
						<label for="nombre_id">Palabras Clave</label>
						<select multiple="multiple" name="key_words[]" class="form-control">
							@foreach($key_words as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="safety_warnings_id">Advertencias de Seguridad</label>
						<textarea name="safety_warnings" id="safety_warnings_id" class="form-control"></textarea>
					</div>

					<div class="checkbox">
						<label>
							<input type="checkbox" name="spray_gas" value="1"> ¿Es el producto un aerosol o gas comprimido?
						</label>
					</div>

					<div class="form-group">
						<label for="provenance_id">País de Origen</label>
						<input type="text" class="form-control" id="provenance_id" name="provenance">
					</div>

					<div class="form-group">
						<label for="labeling_contry_id">País donde fue Etiquetado</label>
						<input type="text" class="form-control" id="labeling_country_id" name="labeling_contry">
					</div>

					<div class="form-group">
						<label for="number_of_parts_id">Número de Piezas Contenidas</label>
						<input type="text" class="form-control" id="number_of_parts_id" name="number_of_parts">
					</div>

					<div class="form-group">
						<label for="request_multiple_id">Multiplo de Pedido</label>
						<input type="text" class="form-control" id="request_multiple_id" name="request_multiple">
					</div>

					<div class="form-group">
						<label for="video_id">Video (Youtube Link)</label>
						<input type="text" class="form-control" id="video_id" name="video">
					</div>

					<div class="form-group">
						<label for="image_id">Imagen</label>
						<input type="file" class="form-control" id="image_id" name="image">
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Añadir Producto</button>
				</div>
			</form>
			<!-- END: Add brand form -->

		</div>
	</div>
</div>
<!-- END: Modal add brand -->

<!-- START: Modal edit brand -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post" id="productEditForm">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Editar Producto</h4>
				</div>

				<div class="modal-body">
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Guardar Cambios</button>
				</div>
			</form>
			<!-- END: edit brand form -->

		</div>
	</div>
</div>
<!-- END: Modal edit product -->

<!-- START: Template edit product -->
<script type="text/template" id="editProductTemplate">
	<div class="form-group">
		<label for="status_id">Status:</label>
		<select name="status" class="form-control" disabled>
			<option value="00">Concepción</option>
			<option value="03">Lanzamiento</option>
			<option value="05">Línea</option>
			<option value="06">Vías de abandono</option>
			<option value="Y1">Ofertas armadas</option>
		</select>
	</div>

	<div class="form-group">
		<label for="vendor_code_id">Código del Vendedor</label>
		<input type="text" class="form-control" id="vendor_code_id" name="vendor_code" value="<%= product.vendor_code %>">
	</div>

	<!-- el nombre del proveedor siempre va a ser Frabel S.A. de C.V., se puede hardcodear??????!!!!! -->
	<div class="form-group">
		<label for="supplier_id">Nombre del proveedor</label>
		<input type="text" class="form-control" id="supplier_id" name="supplier" value="<%= product.supplier %>">
	</div>

	<div class="form-group">
		<label for="sku_vendor_id">SKU vendedor</label>
		<input type="text" class="form-control" id="sku_vendor_id" name="sku_vendor" value="<%= product.sku_vendor %>" disabled>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="variation" value="1" <% if(product.variation == 1){ %> checked <% } %> disabled> ¿Es una variación?
				</label>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="variation_type_id">Nombre del Tipo de Variación</label>
				<input type="text" class="form-control" id="variation_type_id" name="variation_type" value="<%= product.variation_type %>" disabled>
			</div>
		</div>

	</div>

	<div class="form-group">
		<label for="family_id">Familia</label>
		<select name="family_id" class="form-control" disabled>
			@foreach($families as $key => $value)
			<option value="{{ $key }}">{{ $value }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="brand_id">Marca</label>
		<select name="brand_id" class="form-control" disabled>
			@foreach($brands as $key => $value)
			<option value="{{ $key }}">{{ $value }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="item_name_id">Nombre del Producto</label>
		<input type="text" class="form-control" id="item_name_id" name="item_name" value="<%= product.item_name %>" disabled>
	</div>

	<div class="form-group">
		<label for="sku_id">SKU - Número de modelo para mostrar en sitio web</label>
		<input type="text" class="form-control" id="sku_id" name="sku" value="<%= product.sku %>" disabled>
	</div>

	<div class="form-group">
		<label for="currency_id">Tipo Moneda</label>
		<input type="text" class="form-control" id="currency_id" name="currency" value="<%= product.currency %>" disabled>
	</div>

	<div class="form-group">
		<label for="cost_per_unit_id">Costo Unitario en Factura</label>
		<input type="text" class="form-control" id="cost_per_unit_id" name="cost_per_unit" value="<%= product.cost_per_unit %>">
	</div>

	<div class="form-group">
		<label for="mesurement_unit_id">Unidad de Medida PPU</label>
		<input type="text" class="form-control" id="mesurement_unit_id" name="mesurement_unit" value="<%= product.mesurement_unit %>" disabled>
	</div>

	<div class="form-group">
		<label for="mesurement_unit_n_id">Contenido PPU</label>
		<input type="text" class="form-control" id="mesurement_unit_n_id" name="mesurement_unit_n" value="<%= product.mesurement_unit_n %>" disabled>
	</div>

	<div class="form-group">
		<label for="origin_id">País de Origen</label>
		<input type="text" class="form-control" id="origin_id" name="origin" value="<%= product.origin %>">
	</div>

	<div class="checkbox">
		<label>
			<input type="checkbox" name="included_expiration_date" value="1" <% if(product.included_expiration_date == 1){ %> checked <% } %>> ¿El producto incluye fecha de expiración?
		</label>
	</div>

	<div class="form-group">
		<label for="life_span">Vida útil del producto (días)</label>
		<input type="text" class="form-control" id="life_span" name="life_span" value="<%= product.life_span %>">
	</div>

	<div class="form-group">
		<label for="recomended_retail_price_id">Precio Recomendado de Venta</label>
		<input type="text" class="form-control" id="recomended_retail_price_id" name="recomended_retail_price" value="<%= product.recomended_retail_price %>">
	</div>

	<div class="form-group">
		<label for="external_id_type_id">Tipo de ID Externo</label>
		<input type="text" class="form-control" id="external_id_type_id" name="external_id_type" value="<%= product.external_id_type %>" disabled>
	</div>

	<div class="form-group">
		<label for="external_id">External ID</label>
		<input type="text" class="form-control" id="external_id" name="external_id" value="<%= product.external_id %>" disabled>
	</div>

	<div class="form-group">
		<label for="width_id">Ancho del producto</label>
		<input type="text" class="form-control" id="width_id" name="width" value="<%= product.width %>" disabled>
	</div>

	<div class="form-group">
		<label for="height_id">Alto del producto</label>
		<input type="text" class="form-control" id="height_id" name="height" value="<%= product.height %>" disabled>
	</div>

	<div class="form-group">
		<label for="length_id">Longitud del producto</label>
		<input type="text" class="form-control" id="length_id" name="length" value="<%= product.length %>" disabled>
	</div>

	<div class="form-group">
		<label for="weight_id">Peso (No Contenido)</label>
		<input type="text" class="form-control" id="weight_id" name="weight" value="<%= product.weight %>" disabled>
	</div>

	<div class="form-group">
		<label for="package_width_id">Ancho Paquete</label>
		<input type="text" class="form-control" id="package_width_id" name="package_width" value="<%= product.package_width %>" disabled>
	</div>

	<div class="form-group">
		<label for="package_height_id">Alto Paquete</label>
		<input type="text" class="form-control" id="package_height_id" name="package_height" value="<%= product.package_height %>" disabled>
	</div>

	<div class="form-group">
		<label for="package_length_id">Longitud Paquete</label>
		<input type="text" class="form-control" id="package_length_id" name="package_length" value="<%= product.package_length %>" disabled>
	</div>

	<div class="form-group">
		<label for="mass_id">Mass</label>
		<input type="text" class="form-control" id="mass_id" name="mass" value="<%= product.mass %>" disabled>
	</div>

	<!-- Tipo de producto -->

	<div class="form-group">
		<label for="category_id">Categoria</label>
		<select name="category_id" class="form-control" disabled>
			@foreach($categories as $key => $value)
			<option value="{{ $key }}">{{ $value }}</option>
			@endforeach
		</select>
	</div>

	<!-- FALTA SUBCATEGORÍA -->

	<!-- FALTA SUBCATEGORÍA -->


	<div class="form-group">
		<label for="short_description_id">Descipción Corta</label>
		<textarea name="short_description" id="short_description_id" class="form-control"><%= product.short_description %></textarea>
	</div>

	<div class="form-group">
		<label for="feature_1_id">Característica 1</label>
		<textarea name="feature_1" id="feature_1_id" class="form-control"><%= product.feature_1 %></textarea>
	</div>

	<div class="form-group">
		<label for="feature_2_id">Característica 2</label>
		<textarea name="feature_2" id="feature_2_id" class="form-control"><%= product.feature_2 %></textarea>
	</div>

	<div class="form-group">
		<label for="feature_3_id">Característica 3</label>
		<textarea name="feature_3" id="feature_3_id" class="form-control"><%= product.feature_3 %></textarea>
	</div>

	<div class="form-group">
		<label for="nombre_id">Palabras Clave</label>
		<select multiple="multiple" name="key_words[]" class="form-control">
			<% _.each(keywords, function(value, key){ %>
			<option value="<%= key %>" <% if(_.contains(keywords_selected, parseInt(key))){ %> selected <% } %> ><%= value %></option>
			<% }) %>
		</select>
	</div>

	<div class="form-group">
		<label for="safety_warnings_id">Advertencias de Seguridad</label>
		<textarea name="safety_warnings" id="safety_warnings_id" class="form-control"><%= product.safety_warnings %></textarea>
	</div>

	<div class="checkbox">
		<label>
			<input type="checkbox" name="spray_gas" value="1"<% if(product.spray_gas == 1){ %> checked <% } %>> ¿Es el producto un aerosol o gas comprimido?
		</label>
	</div>

	<div class="form-group">
		<label for="provenance_id">País de Origen</label>
		<input type="text" class="form-control" id="provenance_id" name="provenance" value="<%= product.provenance %>">
	</div>

	<div class="form-group">
		<label for="labeling_contry_id">País donde fue Etiquetado</label>
		<input type="text" class="form-control" id="labeling_country_id" name="labeling_contry" value="<%= product.labeling_country %>">
	</div>

	<div class="form-group">
		<label for="number_of_parts_id">Número de Piezas Contenidas</label>
		<input type="text" class="form-control" id="number_of_parts_id" name="number_of_parts" value="<%= product.number_of_parts %>">
	</div>

	<div class="form-group">
		<label for="request_multiple_id">Multiplo de Pedido</label>
		<input type="text" class="form-control" id="request_multiple_id" name="request_multiple" value="<%= product.request_multiple %>" disabled>
	</div>

	<div class="form-group">
		<label for="video_id">Video (Youtube Link)</label>
		<input type="text" class="form-control" id="video_id" name="video" value="<%= product.video %>">
	</div>

	<div class="form-group">
		<label for="image_id">Imagen</label>
		<input type="file" class="form-control" id="image_id" name="image" disabled>
	</div>
</script>
<!-- END: Template edit product -->
@stop

@section('scripts_bottom')

<!-- Underscore JS 1.8.3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

<script>

	$(document).ready(function(){

		var $form                = $('#productEditForm'),
			$modalBody           = $form.find('.modal-body'),
			editProductTemplate = _.template($('#editProductTemplate').html());


		$('body').on('click', '.edit-btn', function(evt){

			var $this = $(this),
				$modal = $('#editProductModal');

			$form.attr('action', '/admin/products/' + $this.data('id'));

			$.ajax({
				method : 'get',
				url    : '/admin/products/' + $this.data('id'),
			}).done(function(data){
				$modalBody.html(editProductTemplate(data));
				console.log(data);
			});

			$modal.modal('toggle');

		});

	});

</script>

<script>
	$(document).ready(function(){
		function getParameterByName(name, url){

			if (!url) url = window.location.href;

			name = name.replace(/[\[\]]/g, "\\$&");

			var regex   = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
				results = regex.exec(url);

			if (!results) return null;
			if (!results[2]) return '';

			return decodeURIComponent(results[2].replace(/\+/g, " "));

		}

		var productID = getParameterByName('id');

		if(productID){

			var $form                = $('#productEditForm'),
				$modalBody           = $form.find('.modal-body'),
				editProductTemplate = _.template($('#editProductTemplate').html()),
				$modal = $('#editProductModal');

			$form.attr('action', '/admin/products/' + productID);

			$.ajax({
				method : 'get',
				url    : '/admin/products/' + productID,
			}).done(function(data){
				$modalBody.html(editProductTemplate(data));
				console.log(data);
			});

			$modal.modal('toggle');
		}

	});
</script>

@stop
