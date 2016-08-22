@extends('layouts.admin_layout')

@section('content')
<div class="row">
	<div class="col-md-12 text-center">
		<h2>Confirmación</h2>
		<form action="/admin/products/{{ $product->id }}" method="post">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<p>
				¿Esta seguro de querer eliminar el producto {{ $product->name }}?
			</p>
			<p>
				<a href="/admin/products" class="btn btn-default">Cancelar</a>
				<input class="btn btn-danger" type="submit" name="submit" value="Eliminar">
			</p>
		</form>
	</div>
</div>
@stop
