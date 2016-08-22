$(document).foundation();

/***********************EMPIEZA: PRELOADER*************************/ 
$(window).load(function() { 
	$('#status').fadeOut(); 
	$('#preloader').delay(350).fadeOut('slow'); 
	$('body').delay(350).css({'overflow':'visible'});
});
/***********************TERMINA: PRELOADER*************************/ 

/********************EMPIEZA: FUNCIONES MENÚ PRINCIPAL***************************/
abierto 	  = false;
abierto_login = false;

// $(".submenu_firmas_click").click(function(){
// 	if(abierto==false){
// 		$("#submenu_login").animate({"height":"0px"});
// 		$("#submenu_firmas_marcas").animate({"height":"430px"});
// 		abierto=true;
// 		abierto_login=false;
		
// 	}else{
// 		$("#submenu_firmas_marcas").animate({"height":"0px"});
// 		abierto=false
// 	}
// });
	
$(".login_button,.usuario_nombre").click(function(){
	if(abierto_login==false){
		$("#submenu_firmas_marcas").animate({"height":"0px"});
		$("#submenu_login").animate({"height":"100px"}, "fast");
		abierto_login=true;
		abierto=false;
		
	}else{
		$("#submenu_login").animate({"height":"0px"},"fast");
		abierto_login=false
	}
});
	
$(".contenedor").click(function(){
	$("#submenu_login").animate({"height":"0px"});
	abierto_login=false;
	$("#submenu_firmas_marcas").animate({"height":"0px"});
	abierto=false
});

$(".submenu_login img").click(function(){
	alert("funciona");
	if(abierto_login==true){
		$("#submenu_login").css("display","none");
		abierto_login=false;	
	}	
})
	
	
$( window ).resize(function() {
		$( "#menu_off" ).css( {"display":"block"});
});
  
$(function() {
		// Invoke the plugin
		$('input, textarea').placeholder();

});
/********************TERMINA: FUNCIONES MENÚ PRINCIPAL***************************/

 
/*********************EMPIEZA: SLIDER DE PRECIO ***************************/
$(function() {
$( "#rango_precio" ).slider({
  range: true,
  min: 0,
  max: 2000,
  values: [ 100, 1000 ],
  slide: function( event, ui ) {
    $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    $("#min").val($("#rango_precio").slider("values")[0]);
    $("#max").val($("#rango_precio").slider("values")[1]);
  }
});
	$( "#amount" ).val( "$" + $( "#rango_precio" ).slider( "values", 0 ) +
  " - $" + $( "#rango_precio" ).slider( "values", 1 ) );
	});
/*********************TERMINA: SLIDER DE PRECIO ***************************/	 

/********TOOL TIPS*********/ 

$(function() {
	$(document).tooltip({
		track: true,
		tooltipClass: "tooltip_producto",
		content: function () {
			return $(this).prop('title');
		},
	});
	});

/********FIN TOOL TIPS*********/ 
	
/**********EMPIEZA: SLIDER HOME***************/ 
$(document).ready(function() {
	
	$('.slider').pgwSlider({
		transitionEffect:"sliding",
	});
	
	
	$(".sidebar_filtros .busqueda_input").click(function(){
		$(this).val("");
	});
	
	$(".busqueda_lupa").click(function(){
		$("#busqueda_formulario").submit();
		
	});		
});
/**********EMPIEZA: SLIDER HOME***************/ 
			
		
// $(".firmas_cat").change(function(){
// 	$.ajax({
// 	type: 'POST',
//  	data: { id: $(this).val()},
// 		url: 'includes/get_marcas.php',
// 		success:function(data){
// 	$(".catch_marcas").html(data);
// 		}
// 	});
// });


/******************EMPIEZA:ABREVIAR TEXTO LARGO EN PRODUCTO DETAIL**************************/
largo = false;

$(".largo").prepend('<span class="mas"><img src="/img/mas.png" title="Ver más"></span> ' );

$(".largo").click(function(){
	if(largo == false){
		$(this).animate({"max-height":"500px"});
		$(this).find('.mas').html("<img src='/img/menos.png'>");
		largo = true;
	}else{
		$(this).animate({"max-height":"88px"});
		$(this).find('.mas').html("<img src='/img/mas.png'>");
		largo = false;
	}
	
});
/******************TERMINA:ABREVIAR TEXTO LARGO EN PRODUCTO DETAIL**************************/
		
/******************EMPIEZA: BOTONES PERFILES************************************/
	$('body').on("click", ".descargar", function() {
		alto = $(".descargar_info_opciones .descargar_inner").height();
		$(".descargar_info_opciones").animate({height:alto});
	});

	$('body').on("click", ".cerrar", function() {
			$(".descargar_info_opciones").animate({height:"0"});
	});

	$('body').on("click", ".descargar-csv", function() {
			$("#perfil").val($(this).data("perfil"));
			$("#form_filtros").submit();
			$(".descargar_info_opciones").animate({height:"0"});
	});
/******************TEMINA: BOTONES PERFILES************************************/


/******************EMPIEZA: FANCYBOX************************************/
$(document).ready(function() {
	  	$(".fancybox").fancybox();
});
/******************TERMINA: FANCYBOX************************************/

/******************EMPIEZA: ACORDEON************************************/
$(function() {
	$( ".accordion" ).accordion({
	  heightStyle: "content",
	  collapsible: "true",
	  active: false
	});
});
/******************TERMINA: ACORDEON************************************/
		
		

	  