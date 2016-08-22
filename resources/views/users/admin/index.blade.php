@extends('layouts.admin_layout')


@section('content')

<section class="row">

	<div class="col-md-12 brands">

		<!-- START: Title -->
		<h2 class="text-center">Usuarios</h2>
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
				data-target="#addGroupModal">
				<i class="fa fa-plus" aria-hidden="true"></i> Añadir Usuario
			</button>
		</div>
		<!-- END: Actions -->

		<!-- START: Brands table -->
		<table class="table table-striped text-center">

			<!-- START: Brands table headers -->
			<thead>
				<tr>
					<th class="text-center">Id</th>
					<th class="text-center">Usuario</th>
					<th class="text-center">País</th>
					<th class="text-center">Marca</th>
					<th class="text-center">Roles</th>
					<th class="text-center">¿Superusuario?</th>
					<th class="text-center">Acciones</th>
				</tr>
			</thead>
			<!-- END: Brands table headers -->

			<!-- START: Brands table body -->
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->profile->country->country or 'n\a' }}</td>
					<td>{{ $user->profile->brand->brand or 'n\a'}}</td>
					<td>{{ implode(', ', $user->roles->lists('name')->toArray()) }}</td>
					<td>
						@if($user->is_superuser == 1)
						<i class="fa fa-check-circle" aria-hidden="true"></i>
						@else
						<i class="fa fa-times-circle" aria-hidden="true"></i>
						@endif
					</td>
					<td>
						<a href="#">
							<i class="fa fa-pencil edit-btn" data-id="{{ $user->id }}" aria-hidden="true"></i>
						</a>
						&nbsp;
						<a href="#">
							<i class="fa fa-key password-btn" data-id="{{ $user->id }}" aria-hidden="true"></i>
						</a>
						&nbsp;
						<a href="/admin/users/{{ $user->id }}/confirmation">
							<i class="fa fa-trash delete-btn" data-id="{{ $user->id }}" aria-hidden="true"></i>
						</a>
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
			{{ $users->links() }}
		</div>
	</div>
</section>

<!-- START: Modal add brand -->
<div class="modal fade" id="addGroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Añadir Usuario</h4>
				</div>

				<div class="modal-body">

					<div class="from-group">
						<label for="name">Usuario</label>
						<input class="form-control" type="text" name="name" id="name">
					</div>

					<div class="form-group">
						<label for="first_name">Nombre(s)</label>
						<input class="form-control" type="text" name="first_name">
					</div>

					<div class="form-group">
						<label for="last_name">Apellido(s)</label>
						<input class="form-control" type="text" name="last_name">
					</div>

					<div class="form-group">
						<label for="email">Correo Electrónico</label>
						<input class="form-control" type="text" name="email" id="email">
					</div>

					<div class="form-group">
						<label for="password">Contraseña</label>
						<input class="form-control" type="password" name="password" id="password">
					</div>

					<div class="form-group">
						<label for="password">Repetir Contraseña</label>
						<input class="form-control" type="password" name="password_confirmation" id="password">
					</div>

					<div class="form-group">
						<label for="is_superuser">
							<input type="checkbox" name="is_superuser" value="1"> ¿Super Usuario?
						</label>
					</div>

					<div class="form-group">
						<label for="grupo">Grupos</label>
						<select name="groups[]" id="grupo" class="form-control" multiple="multiple">
							@foreach($groups as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="grupo">Marca</label>
						<select name="brand_id" id="grupo" class="form-control">
							@foreach($brands as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="grupo">País</label>
						<select name="country_id" id="grupo" class="form-control">
							@foreach($countries as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Añadir Usuario</button>
				</div>
			</form>
			<!-- END: Add brand form -->

		</div>
	</div>
</div>
<!-- END: Modal add brand -->

<!-- START: Change Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post" id="passwordForm">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Modificar Contraseña</h4>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label for="password">Contraseña</label>
						<input class="form-control" type="password" name="password" id="password">
					</div>

					<div class="form-group">
						<label for="password">Repetir Contraseña</label>
						<input class="form-control" type="password" name="password_confirmation" id="password">
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-success">Editar Usuario</button>
				</div>
			</form>
			<!-- END: Add brand form -->

		</div>
	</div>
</div>
<!-- END: Change Password Modal -->

<!-- START: Modal edit brand -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<!-- START: Add brand form -->
			<form action="" method="post" id="userEditForm">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
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
<script type="text/template" id="editUserTemplate">
	<div class="from-group">
		<label for="name">Usuairo</label>
		<input class="form-control" type="text" name="name" id="name" value="<%= name %>">
	</div>

	<div class="form-group">
		<label for="first_name">Nombre(s)</label>
		<input class="form-control" type="text" name="first_name" value="<%= profile.first_name %>">
	</div>

	<div class="form-group">
		<label for="last_name">Apellido(s)</label>
		<input class="form-control" type="text" name="last_name" value="<%= profile.last_name %>">
	</div>

	<div class="form-group">
		<label for="email">Correo Electrónico</label>
		<input class="form-control" type="text" name="email" id="email" value="<%= email %>">
	</div>

	<div class="form-group">
		<label for="is_superuser">
			<input
				type="checkbox"
				name="is_superuser"
				value="1"
				<% if(is_superuser == '1'){ %> checked <% } %>> ¿Super Usuario?
		</label>
	</div>

	<div class="form-group">
		<label for="grupo">Grupos</label>
			<select multiple="multiple" name="groups[]" class="form-control">
				<% _.each(groups, function(value, key){ %>
				<option value="<%= key %>" <% if(_.contains(groups_selected, parseInt(key))){ %> selected <% } %> ><%= value %></option>
				<% }) %>
			</select>
		</select>
	</div>

	<div class="form-group">
		<label for="grupo">Marca</label>
		<select name="brand_id" id="grupo" class="form-control">
			<% _.each(brands, function(value, key){ %>
			<option value="<%= key %>" <% if(profile.brand_id == key){ %> selected <% } %> ><%= value %></option>
			<% }) %>
		</select>
	</div>

	<div class="form-group">
		<label for="grupo">País</label>
		<select name="country_id" id="grupo" class="form-control">
			<% _.each(countries, function(value, key){ %>
			<option value="<%= key %>" <% if(profile.country_id == key){ %> selected <% } %> ><%= value %></option>
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

		var $form                = $('#userEditForm'),
			$modalBody           = $form.find('.modal-body'),
			editUserTemplate = _.template($('#editUserTemplate').html());


		$('body').on('click', '.edit-btn', function(evt){

			var $this  = $(this),
				$modal = $('#editUserModal');

			$form.attr('action', '/admin/users/' + $this.data('id'));

			$.ajax({
				method : 'get',
				url    : '/admin/users/' + $this.data('id'),
			}).done(function(data){
				$modalBody.html(editUserTemplate(data));
				console.log(data);
			});

			$modal.modal('toggle');

		});

		$('body').on('click', '.password-btn', function(evt){

			var $passwordModal = $('#passwordModal'),
				$passwordForm  = $passwordModal.find('#passwordForm');
				userId         = $(this).data('id');

			$passwordForm.attr('action', '/admin/users/' + userId +  '/change-password');
			// admin/users/{user}/change-password
			$passwordModal.modal('toggle');

		});

	});

</script>

@stop
