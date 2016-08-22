@extends('layouts.admin_layout')


@section('content')

<section class="row">

	<div class="col-md-12 brands">

		<!-- START: Title -->
		<h2 class="text-center">Paises</h2>
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
				data-target="#addCountryModal">
				<i class="fa fa-plus" aria-hidden="true"></i> Añadir País
			</button>
		</div>
		<!-- END: Actions -->

		<!-- START: Brands table -->
		<table class="table table-striped text-center">

			<!-- START: Brands table headers -->
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">País</th>
					<th class="text-center">Acciones</th>
				</tr>
			</thead>
			<!-- END: Brands table headers -->

			<!-- START: Brands table body -->
			<tbody>
				@foreach($countries as $country)
				<tr>
					<td>{{ $country->id }}</td>
					<td>{{ $country->country }}</td>
					<td>
						<a href="#"><i class="fa fa-pencil edit-btn" data-id="{{ $country->id }}" aria-hidden="true"></i></a>
						&nbsp;
						<a href="/admin/countries/{{ $country->id }}/confirmation"><i class="fa fa-trash delete-btn" data-id="{{ $country->id }}" aria-hidden="true"></i></a>
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
			{{ $countries->links() }}
		</div>
	</div>
</section>

<!-- START: Modal add brand -->
<div class="modal fade" id="addCountryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Añadir País</h4>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<label for="country_id">País</label>
						<input type="text" class="form-control" id="country_id" name="country">
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Añadir País</button>
				</div>
			</form>
			<!-- END: Add brand form -->

		</div>
	</div>
</div>
<!-- END: Modal add brand -->

<!-- START: Modal edit brand -->
<div class="modal fade" id="editCountryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post" id="countryEditForm">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Editar País</h4>
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
<script type="text/template" id="editCountryTemplate">
	<div class="form-group">
		<label for="country_id">País</label>
		<input type="text" class="form-control" id="country_id" name="country" value="<%= country %>">
	</div>
</script>
<!-- END: Template edit brand -->
@stop

@section('scripts_bottom')

<!-- Underscore JS 1.8.3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

<script>

	$(document).ready(function(){

		var $form                = $('#countryEditForm'),
			$modalBody           = $form.find('.modal-body'),
			editCountryTemplate  = _.template($('#editCountryTemplate').html());


		$('body').on('click', '.edit-btn', function(evt){

			var $this = $(this),
				$modal = $('#editCountryModal');

			$form.attr('action', '/admin/countries/' + $this.data('id'));

			$.ajax({
				method : 'get',
				url    : '/admin/countries/' + $this.data('id'),
			}).done(function(data){
				$modalBody.html(editCountryTemplate(data));
			});

			$modal.modal('toggle');

		});

	});

</script>

@stop
