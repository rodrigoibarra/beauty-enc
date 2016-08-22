@extends('layouts.admin_layout')

@section('content')
<div class="row">
	<div class="col-md-12 text-center">
		<h2>Confirmación</h2>
		<form action="/admin/countries/{{ $country->id }}" method="post">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<p>Los productos asociados al país serán eliminados.</p>
			<p>
				¿Esta seguro de querer eliminar el país {{ $country->country }}?
			</p>
			<p>
				<a href="/admin/countries" class="btn btn-default">Cancelar</a>
				<input class="btn btn-danger" type="submit" name="submit" value="Eliminar">
			</p>
		</form>
	</div>
</div>
@stop
