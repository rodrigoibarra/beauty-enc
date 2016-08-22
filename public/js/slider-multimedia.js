// JavaScript Document
$(document).ready(function() {
	$("#multimedia").owlCarousel({
		navigation : false,
		slideSpeed : 300,
		paginationSpeed : 400,
		singleItem : true,
		autosize: true,
	
	});
			
	var owl = $("#multimedia");
	owl.owlCarousel();
	// Custom Navigation Events
	$(".next").click(function(){
		owl.trigger('owl.next');
	})
	$(".prev").click(function(){
		owl.trigger('owl.prev');
	})
});
