@extends('layouts.admin_layout')

@section('content')
<div class="row">
	<div class="col-md-12 text-center">
		<h2>Confirmación</h2>
		<form action="/admin/key-words/{{ $key_word->id }}" method="post">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<p>
				¿Esta seguro de querer eliminar la palabra clave {{ $key_word->name }}?
			</p>
			<p>
				<a href="/admin/key-words" class="btn btn-default">Cancelar</a>
				<input class="btn btn-danger" type="submit" name="submit" value="Eliminar">
			</p>
		</form>
	</div>
</div>
@stop
