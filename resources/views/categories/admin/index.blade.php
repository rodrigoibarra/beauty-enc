@extends('layouts.admin_layout')


@section('content')

<section class="row">

	<div class="col-md-12 brands">

		<!-- START: Title -->
		<h2 class="text-center">Categorias</h2>
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
				data-target="#addCategoryModal">
				<i class="fa fa-plus" aria-hidden="true"></i> Añadir Categoria
			</button>
		</div>
		<!-- END: Actions -->

		<!-- START: Brands table -->
		<table class="table table-striped text-center">

			<!-- START: Brands table headers -->
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Categoría</th>
					<th class="text-center">Acciones</th>
				</tr>
			</thead>
			<!-- END: Brands table headers -->

			<!-- START: Brands table body -->
			<tbody>
				@foreach($categories as $category)
				<tr>
					<td>{{ $category->id }}</td>
					<td>{{ $category->name }}</td>
					<td>
						<a href="#"><i class="fa fa-pencil edit-btn" data-id="{{ $category->id }}" aria-hidden="true"></i></a>
						&nbsp;
						<a href="/admin/categories/{{ $category->id }}/confirmation"><i class="fa fa-trash delete-btn" data-id="{{ $category->id }}" aria-hidden="true"></i></a>
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
			{{ $categories->links() }}
		</div>
	</div>
</section>

<!-- START: Modal add brand -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Añadir Categoría</h4>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<label for="nombre_id">Nombre</label>
						<input type="text" class="form-control" id="nombre_id" name="name">
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Añadir Categoría</button>
				</div>
			</form>
			<!-- END: Add brand form -->

		</div>
	</div>
</div>
<!-- END: Modal add brand -->

<!-- START: Modal edit brand -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post" id="categoryEditForm">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Editar Categoría</h4>
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
<script type="text/template" id="editCategoryTemplate">
	<div class="form-group">
		<label for="nombre_id">Nombre</label>
		<input type="text" class="form-control" id="nombre_id" name="name" value="<%= name %>">
	</div>
</script>
<!-- END: Template edit brand -->
@stop

@section('scripts_bottom')

<!-- Underscore JS 1.8.3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

<script>

	$(document).ready(function(){

		var $form                = $('#categoryEditForm'),
			$modalBody           = $form.find('.modal-body'),
			editCategoryTemplate = _.template($('#editCategoryTemplate').html());


		$('body').on('click', '.edit-btn', function(evt){

			console.log("hola!")

			var $this = $(this),
				$modal = $('#editCategoryModal');

			$form.attr('action', '/admin/categories/' + $this.data('id'));

			$.ajax({
				method : 'get',
				url    : '/admin/categories/' + $this.data('id'),
			}).done(function(data){
				$modalBody.html(editCategoryTemplate(data));
			});

			$modal.modal('toggle');

		});

	});

</script>

@stop
