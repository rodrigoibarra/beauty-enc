

				<h1><span>Productos</span></h1>
				<div class="contenedor_resultados">

                    @foreach($products as $product)

					<a title="<b>{{ $product->item_name }}</b> <br> STATUS:
						@if($product->status == '00') Concepción
						@elseif ($product->status == '03') Lanzamiento
						@elseif ($product->status == '03') Lanzamiento
						@elseif ($product->status == '05') Línea
						@elseif ($product->status == '06') Vías de abandono
						@elseif ($product->status == 'Y1') Ofertas armadas
						@endif
						<br><span class='precio'>${{ $product->cost_per_unit }}</span>" href="/products/{{ $product->id }}">
						<span class="large-3 medium-4 small-6 columns producto">
							<div class="inner">
							<div class="imagen"><img onerror="this.src='/img/broken.png'" src="/uploads/{{ $product->image }}"></div>
							<div class="titulo">{{ $product->item_name }}</div>
							<div class="firma"> {{ $product->category->name }} </div>
							</div>
						</span>
					</a>
                    @endforeach

				</div>
