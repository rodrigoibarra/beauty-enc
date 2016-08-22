@extends('layouts.admin_layout')

@section('content')
<div class="row">
	<div class="col-md-12 text-center">
		<h2>Confirmación</h2>
		<form action="/admin/retailer-fields/{{ $retailer_field->id }}" method="post">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<p>
				¿Esta seguro de querer eliminar el campo {{ $retailer_field->name }}?
			</p>
			<p>
				<a href="/admin/categories" class="btn btn-default">Cancelar</a>
				<input class="btn btn-danger" type="submit" name="submit" value="Eliminar">
			</p>
		</form>
	</div>
</div>
@stop
