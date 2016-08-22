@extends('layouts.admin_layout')

@section('content')
<div class="row">
	<div class="col-md-12 text-center">
		<h2>Confirmación</h2>
		<form action="/admin/brands/{{ $brand->id }}" method="post">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<p>Los productos asociados a la marca serán eliminados.</p>
			<p>
				¿Está seguro de querer eliminar la marca {{ $brand->brand }}?
			</p>
			<p>
				<a href="/admin/brands" class="btn btn-default">Cancelar</a>
				<input class="btn btn-danger" type="submit" name="submit" value="Eliminar">
			</p>
		</form>
	</div>
</div>
@stop
