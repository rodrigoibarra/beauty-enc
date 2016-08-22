@extends('layouts.admin_layout')


@section('content')

<section class="row">

	<div class="col-md-12 brands">

		<!-- START: Title -->
		<h2 class="text-center">Retailers</h2>
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
				data-target="#addRetailerModal">
				<i class="fa fa-plus" aria-hidden="true"></i> Añadir Retailer
			</button>
		</div>
		<!-- END: Actions -->

		<!-- START: Brands table -->
		<table class="table table-striped text-center">

			<!-- START: Brands table headers -->
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Retailer</th>
					<th class="text-center">Acciones</th>
				</tr>
			</thead>
			<!-- END: Brands table headers -->

			<!-- START: Brands table body -->
			<tbody>
				@foreach($retailers as $retailer)
				<tr>
					<td>{{ $retailer->id }}</td>
					<td>{{ $retailer->name }}</td>
					<td>
						<a href="#"><i class="fa fa-pencil edit-btn" data-id="{{ $retailer->id }}" aria-hidden="true"></i></a>
						&nbsp;
						<a href="/retailers/{{ $retailer->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
						&nbsp;
						<a href="/admin/retailers/{{ $retailer->id }}/confirmation"><i class="fa fa-trash delete-btn" data-id="{{ $retailer->id }}" aria-hidden="true"></i></a>
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
			{{ $retailers->links() }}
		</div>
	</div>
</section>

<!-- START: Modal add brand -->
<div class="modal fade" id="addRetailerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Añadir Retailer</h4>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label for="nombre_id">Retailer</label>
						<input type="text" class="form-control" id="nombre_id" name="name">
					</div>

					<div class="form-group">
						<label for="nombre_id">País</label>
						<select name="country_id" class="form-control">
							@foreach($countries as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="nombre_id">Campos Retailer</label>
						<select multiple="multiple" name="retailer_fields[]" class="form-control">
							@foreach($retailer_fields as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="nombre_id">Productos</label>
						<select multiple="multiple" name="products[]" class="form-control">
							@foreach($products as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Añadir Retailer</button>
				</div>
			</form>
			<!-- END: Add brand form -->

		</div>
	</div>
</div>
<!-- END: Modal add brand -->

<!-- START: Modal edit brand -->
<div class="modal fade" id="editRetailerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post" id="retailerEditForm">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Editar Retailer</h4>
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
<!-- END: Modal edit brand -->

<!-- START: Template edit brand -->
<script type="text/template" id="editRetailerTemplate">
	<div class="form-group">
		<label for="nombre_id">Retailer</label>
		<input type="text" class="form-control" id="nombre_id" name="name" value="<%= retailer.name %>">
	</div>

	<div class="form-group">
		<label for="nombre_id">País</label>
		<select name="country_id" class="form-control">
			<% _.each(countries, function(value, key){ %>
			<option value="<%= key %>" <% if(retailer.country_id == key){ %> selected <% } %> ><%= value %></option>
			<% }) %>
		</select>
	</div>

	<div class="form-group">
		<label for="nombre_id">Campos Retailer</label>
		<select multiple="multiple" name="retailer_fields[]" class="form-control">
			<% _.each(retailer_fields, function(value, key){ %>
			<option value="<%= key %>" <% if(_.contains(retailer_fields_selected, parseInt(key))){ %> selected <% } %> ><%= value %></option>
			<% }) %>
		</select>
	</div>

	<div class="form-group">
		<label for="nombre_id">Productos</label>
		<select multiple="multiple" name="products[]" class="form-control">
			<% _.each(products, function(value, key){ %>
			<option value="<%= key %>" <% if(_.contains(products_selected, parseInt(key))){ %> selected <% } %> ><%= value %></option>
			<% console.log(products_selected) %>
			<% }) %>
		</select>
	</div>
</script>
<!-- END: Template edit brand -->
@stop

@section('scripts_bottom')

<!-- Underscore JS 1.8.3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

<script>

	$(document).ready(function(){

		var $form                = $('#retailerEditForm'),
			$modalBody           = $form.find('.modal-body'),
			editRetailerTemplate = _.template($('#editRetailerTemplate').html());


		$('body').on('click', '.edit-btn', function(evt){

			var $this = $(this),
				$modal = $('#editRetailerModal');

			$form.attr('action', '/admin/retailers/' + $this.data('id'));

			$.ajax({
				method : 'get',
				url    : '/admin/retailers/' + $this.data('id'),
			}).done(function(data){
				$modalBody.html(editRetailerTemplate(data));
				console.log(data);
			});

			$modal.modal('toggle');
			console.log($modal);

		});

	});

</script>

@stop
