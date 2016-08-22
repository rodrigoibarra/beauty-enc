@extends('main_app.main_layout')

@section('content')

<div class="contenedor row product-detail">
	<div class="row">
		<!-- EMPIEZA: BOTONES DE IMPRESIÓN Y EDICIÓN  -->
		<div class="print"><a href="#"><img src="/img/print.png" title="Imprimir información"></a></div>
		@if(!in_array('ReadOnly', Auth::user()->roles->lists('name')->toArray()))
		<div class="edit"><a href="/admin/products?id={{ $product->id }}"><img src="/img/edit.png" title="Editar este producto"></a></div>
		@endif
		<!-- EMPIEZA: BOTONES DE IMPRESIÓN Y EDICIÓN  -->
	</div>
	<br>
	<br>
	<div class="inner">


        <img class="invisible" src="/img/menos.png">



        <section class="info-general">

            <div class="row">

			<article class="large-6 columns" style="padding:0;">
				<div class="large-12 columns nomargin">
					<div id="multimedia">
						<div><a class="fancybox" href=""><img class="imagen" src="/uploads/{{ $product->image }}" onerror="this.src='/img/broken_big.png'"></a></div>
					</div>
				</div>
			</article>

			<article class="large-6 columns general" style="padding-top:30px;">

				<div class="large-12 columns">
					<h1>{{$product->item_name}}</h1>
				</div>

				<div class="large-12 columns info" >
					<span class="negritas">Status:</span>
					@if($product->status == "00") Concepción
					@elseif ($product->status == "03") Lanzamiento
					@elseif ($product->status == "03") Lanzamiento
					@elseif ($product->status == "05") Línea
					@elseif ($product->status == "06") Vías de abandono
					@elseif ($product->status == "Y1") Ofertas armadas
					@endif
				</div>

				<div class="large-12 columns info" >
					<span class="negritas">CÓDIGO DE VENDEDOR:</span> {{$product->vendor_code}}
				</div>

				<div class="large-12 columns info" >
					<span class="negritas">PROVEEDOR:</span> {{$product->supplier}}
				</div>

				<div class="large-12 columns info" >
					<span class="negritas">SKU VENDEDOR:</span> {{$product->sku_vendor}}
				</div>

				<div class="large-12 columns info" >
					<span class="negritas">ES UNA VARIACIÓN:</span> {{$product->variation}}
				</div>

				<div class="large-12 columns info" >
					<span class="negritas">TIPO DE VARIACIÓN:</span> {{$product->variation_type}}
				</div>

				<div class="large-12 columns info" >
					<span class="negritas">FAMILIA:</span> {{$product->family->name}}
				</div>

				<div class="large-12 columns info" >
					<span class="negritas">MARCA:</span> {{$product->brand->brand}}
				</div>

			</article>

			</div>
        </section>



        <section class="info-complementaria">
			<h2><span>DATOS DE VENTAS</span></h2>

			<div class="row">
				<div class="medium-3 columns info"><div class="negritas">TIPO DE MONEDA:</div> <div class="data">{{$product->currency}}</div> </div>
				<div class="medium-3 columns info"><div class="negritas">COSTO UNITARIO EN FACTURA: </div><div class="data">{{$product->cost_per_unit}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">UNIDAD DE MEDIDA:</div> <div class="data">{{$product->mesurement_unit}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">CONTENIDO PPU:</div> <div class="data">{{$product->mesurement_unit_n}}</div></div>
			</div>

			<div class="row">

				<div class="medium-3 columns info"><div class="negritas">PAÍS DE ORIGEN:</div>  <div class="data">{{$product->origin}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">EL PRODUCTO INCLUYE FECHA DE EXPIRACIÓN:</div>  <div class="data">@if($product->included_expiration_date) Sí @else No @endif</div></div>
				<div class="medium-3 columns info"><div class="negritas">VIDA ÚTIL DEL PRODUCTO (DÍAS):</div>  <div class="data">{{$product->life_span}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">PRECIO RECOMENDADO DE VENTA:</div>  <div class="data">{{$product->recomended_retail_price}}</div></div>
			</div>

			<div class="row">
				<div class="medium-3 columns info"><div class="negritas">TIPO DE ID EXTERNO:</div>  <div class="data">{{$product->external_id_type}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">ID EXTERNO:</div>  <div class="data">{{$product->external_id}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">ANCHO DEL PRODUCTO:</div>  <div class="data">{{$product->width}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">ALTO DEL PRODUCTO:</div>  <div class="data">{{$product->height}}</div></div>
			</div>

			<h2><span>DATOS DE EMBALAJE Y CARACTERÍSTICAS</span></h2>
			<div class="row">
				<div class="medium-3 columns info"><div class="negritas">LONGITUD DEL PRODUCTO:</div>  <div class="data">{{$product->length}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">PESO DEL PRODUCTO:</div>  <div class="data">{{$product->weight}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">ANCHO PAQUETE:</div>  <div class="data">{{$product->package_width}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">ALTO PAQUETE:</div>  <div class="data">{{$product->package_height}}</div></div>
			</div>

			<div class="row">

				<div class="medium-3 columns info"><div class="negritas">LONGITUD PAQUETE:</div>  <div class="data">{{$product->package_length}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">TIPO DE PRODUCTO:</div><div class="data">@if(in_array($product->mass, ['10','11','13','14','15','16'])) Masivo @else Prestigio @endif</div></div>
				<div class="medium-3 columns info"><div class="negritas">CATEGORÍA:</div>  <div class="data">{{$product->category->name}}</div></div>
				<!-- ESTO ESTÁ PENDIENTE -->
				<!-- <span class="large-4 columns info"><span class="negritas">SUBCATEGORÍA:</span>  {{$product->category->name}}</span> -->
			</div>

			<div class="row">
				<div class="medium-4 columns info"><div class="negritas">CARACTERÍSTICA 1:</div>  <div class="data big">{{$product->feature_1}}</div></div>
				<div class="medium-4 columns info"><div class="negritas">CARACTERÍSTICA 2:</div>  <div class="data big">{{$product->feature_2}}</div></div>
				<div class="medium-4 columns info"><div class="negritas">CARACTERÍSTICA 3:</div>  <div class="data big">{{$product->feature_3}}</div></div>

			</div>

			<div class="row">
				<div class="medium-4 columns info"><div class="negritas">PALABRAS CLAVE:</div>  <div class="data">{{ implode(', ', $product->key_words->lists('name')->toArray()) }}</div></div>
				<div class="medium-8 columns info"><div class="negritas">ADVERTENCIAS DE SEGURIDAD:</div>  <div class="data big">{{$product->safety_warnings}}</div></div>
			</div>

			<div class="row">
				<div class="medium-3 columns info"><div class="negritas">PAÍS DE ORIGEN:</div>  <div class="data">{{$product->provenance}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">PAÍS DONDE FUE ETIQUETADO:</div>  <div class="data">{{$product->labeling_contry}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">NÚMERO DE PIEZAS CONTENIDAS:</div>  <div class="data">{{$product->number_of_parts}}</div></div>
				<div class="medium-3 columns info"><div class="negritas">MULTIPLO DE PEDIDO:</div>  <div class="data">{{$product->request_multiple}}</div></div>
			</div>
			<div class="row">
				<div class="medium-6 columns info"><div class="negritas">VIDEO (YOUTUBE LINK):</div><div class="data">{{$product->video}}</div></div>
			</div>


        </section>


@stop
