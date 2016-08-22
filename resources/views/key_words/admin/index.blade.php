@extends('layouts.admin_layout')


@section('content')

<section class="row">

	<div class="col-md-12 brands">

		<!-- START: Title -->
		<h2 class="text-center">Palabras Clave</h2>
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
				data-target="#addKeyWordModal">
				<i class="fa fa-plus" aria-hidden="true"></i> Añadir Palabra Clave
			</button>
		</div>
		<!-- END: Actions -->

		<!-- START: Brands table -->
		<table class="table table-striped text-center">

			<!-- START: Brands table headers -->
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Palabra Clave</th>
					<th class="text-center">Acciones</th>
				</tr>
			</thead>
			<!-- END: Brands table headers -->

			<!-- START: Brands table body -->
			<tbody>
				@foreach($key_words as $key_word)
				<tr>
					<td>{{ $key_word->id }}</td>
					<td>{{ $key_word->name }}</td>
					<td>
						<a href="#"><i class="fa fa-pencil edit-btn" data-id="{{ $key_word->id }}" aria-hidden="true"></i></a>
						&nbsp;
						<a href="/admin/key-words/{{ $key_word->id }}/confirmation"><i class="fa fa-trash delete-btn" data-id="{{ $key_word->id }}" aria-hidden="true"></i></a>
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
			{{ $key_words->links() }}
		</div>
	</div>
</section>

<!-- START: Modal add brand -->
<div class="modal fade" id="addKeyWordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Añadir Palabra Clave</h4>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<label for="nombre_id">Nombre</label>
						<input type="text" class="form-control" id="nombre_id" name="name">
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Añadir Palabra Clave</button>
				</div>
			</form>
			<!-- END: Add brand form -->

		</div>
	</div>
</div>
<!-- END: Modal add brand -->

<!-- START: Modal edit brand -->
<div class="modal fade" id="editKeyWordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post" id="keyWordEditForm">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Editar Palabra Clave</h4>
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
<script type="text/template" id="editKeyWordTemplate">
	<div class="form-group">
		<label for="nombre_id">Nombre</label>
		<input type="text" class="form-control" id="nombre_id" name="name" value="<%= name %>">
	</div>
</script>
<!-- END: Template edit brand -->
@stop

@section('scripts_bottom')

<!-- Underscore JS 1.8.3 -->
<script src="/vendor/underscore/underscore-min.js"></script>
<script>

	$(document).ready(function(){

		var $form                = $('#keyWordEditForm'),
			$modalBody           = $form.find('.modal-body'),
			editKeyWordTemplate  = _.template($('#editKeyWordTemplate').html());


		$('body').on('click', '.edit-btn', function(evt){

			var $this = $(this),
				$modal = $('#editKeyWordModal');

			$form.attr('action', '/admin/key-words/' + $this.data('id'));

			$.ajax({
				method : 'get',
				url    : '/admin/key-words/' + $this.data('id'),
			}).done(function(data){
				console.log(editKeyWordTemplate(data));
				$modalBody.html(editKeyWordTemplate(data));
			});

			$modal.modal('toggle');

		});

	});

</script>

@stop
