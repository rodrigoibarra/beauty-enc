@extends('layouts.admin_layout')


@section('content')

<section class="row">

	<div class="col-md-12 brands">

		<!-- START: Title -->
		<h2 class="text-center">Marcas</h2>
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
				data-target="#addBrandModal">
				<i class="fa fa-plus" aria-hidden="true"></i> Añadir Marca
			</button>
		</div>
		<!-- END: Actions -->

		<!-- START: Brands table -->
		<table class="table table-striped text-center">

			<!-- START: Brands table headers -->
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">División</th>
					<th class="text-center">Marca</th>
					<th class="text-center">Tipo</th>
					<th class="text-center">Acciones</th>
				</tr>
			</thead>
			<!-- END: Brands table headers -->

			<!-- START: Brands table body -->
			<tbody>
				@foreach($brands as $brand)
				<tr>
					<td>{{ $brand->id }}</td>
					<td>{{ $brand->division }}</td>
					<td>{{ $brand->brand }}</td>
					<td>{{ $brand->type }}</td>
					<td>
						<a href="#"><i class="fa fa-pencil edit-btn" data-id="{{ $brand->id }}" aria-hidden="true"></i></a>
						&nbsp;
						<a href="/admin/brands/{{ $brand->id }}/confirmation"><i class="fa fa-trash delete-btn" data-id="{{ $brand->id }}" aria-hidden="true"></i></a>
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
			{{ $brands->links() }}
		</div>
	</div>
</section>

<!-- START: Modal add brand -->
<div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Añadir Marca</h4>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label for="division_id">División</label>
						<input type="text" class="form-control" id="division_id" name="division">
					</div>

					<div class="form-group">
						<label for="brand_id">Marca</label>
						<input type="text" class="form-control" id="brand_id" name="brand">
					</div>

					<div class="form-group">
						<label for="type_id">Tipo</label>
						<input type="text" class="form-control" id="type_id" name="type">
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Añadir Marca</button>
				</div>
			</form>
			<!-- END: Add brand form -->

		</div>
	</div>
</div>
<!-- END: Modal add brand -->

<!-- START: Modal edit brand -->
<div class="modal fade" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post" id="brandEditForm">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Editar Marca</h4>
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
<script type="text/template" id="editBrandTemplate">
	<div class="form-group">
		<label for="division_id">División</label>
		<input type="text" class="form-control" id="division_id" name="division" value="<%= division %>">
	</div>

	<div class="form-group">
		<label for="brand_id">Marca</label>
		<input type="text" class="form-control" id="brand_id" name="brand" value="<%= brand %>">
	</div>

	<div class="form-group">
		<label for="type_id">Tipo</label>
		<input type="text" class="form-control" id="type_id" name="type" value="<%= type %>">
	</div>
</script>
<!-- END: Template edit brand -->
@stop

@section('scripts_bottom')

<!-- Underscore JS 1.8.3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

<script>

	$(document).ready(function(){

		var $form             = $('#brandEditForm'),
			$modalBody        = $form.find('.modal-body'),
			editBrandTemplate = _.template($('#editBrandTemplate').html());


		$('body').on('click', '.edit-btn', function(evt){

			var $this = $(this),
				$modal = $('#editBrandModal');

			$form.attr('action', '/admin/brands/' + $this.data('id'));

			$.ajax({
				method : 'get',
				url    : '/admin/brands/' + $this.data('id'),
			}).done(function(data){
				$modalBody.html(editBrandTemplate(data));
			});

			$modal.modal('toggle');

		});

	});

</script>

@stop
