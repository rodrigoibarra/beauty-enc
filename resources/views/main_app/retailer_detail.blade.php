@extends('main_app.main_layout')

@section('content')

	<div class="contenedor row">


		<div class="inner">

			<div class="row">

				<div class="large-12 columns" >
					<div class="contenedor_resultados">
						<div class="large-12 columns">
							<h1>{{$retailer->name}}</h1>
						</div>

						<div class="large-12 columns info" >
							<span class="negritas">CREADO:</span> {{$retailer->created_at}}
						</div>

						<div class="large-12 columns info" >
							<span class="negritas">MODIFICADO:</span> {{$retailer->updated_at}}
						</div>
					</div>
				</div>
				<div class="large-12 columns">
					<h2><span>Productos</span></h2>
					<table>
						<thead>
							<tr>
								<th width="200">NOMBRE</th>
								<th>SKU</th>
								<th width="150">ID EXTERNO</th>
							</tr>
						</thead>
						<tbody>
							@foreach($retailer->products as $product)
							<tr>
								<td>
									<a href="/retailers/{{ $retailer->id }}">
										{{ $product->item_name }}
									</a>
								</td>
								<td>{{ $product->sku }}</td>
								<td>{{ $product->external_id }}</td>
							</tr>
							@endforeach

						</tbody>
					</table>
					<a href="?csv=1" class="btn">Exportar CSV</a>
				</div>
			</div>



@stop
