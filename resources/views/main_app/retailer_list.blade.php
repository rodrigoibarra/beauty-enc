@extends('main_app.main_layout')

@section('content')

	<div class="contenedor row">


		<div class="inner">

			<div class="row">

			<div class="large-12 columns" >

				<h1><span>Retailers</span></h1>
				<div class="contenedor_resultados">

				<table>
					<thead>
						<tr>
							<th width="200">Retailer</th>
							<th>T# Productos</th>
							<th width="150">País</th>
						</tr>
					</thead>
					<tbody>
						@foreach($retailers as $retailer)
						<tr>
							<td>
								<a href="/retailers/{{ $retailer->id }}">
									{{ $retailer->name }}
								</a>
							</td>
							<td>{{ $retailer->products->count() }}</td>
							<td>{{ $retailer->country->country }}</td>
						</tr>
						@endforeach

					</tbody>
				</table>
				</div>
			</div>
			</div>



@stop
