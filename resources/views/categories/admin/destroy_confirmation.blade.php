@extends('layouts.admin_layout')

@section('content')
<div class="row">
	<div class="col-md-12 text-center">
		<h2>Confirmación</h2>
		<form action="/admin/categories/{{ $category->id }}" method="post">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<p>Los productos asociados a la categoría serán eliminados.</p>
			<p>
				¿Esta seguro de querer eliminar la categoría {{ $category->name }}?
			</p>
			<p>
				<a href="/admin/categories" class="btn btn-default">Cancelar</a>
				<input class="btn btn-danger" type="submit" name="submit" value="Eliminar">
			</p>
		</form>
	</div>
</div>
@stop
