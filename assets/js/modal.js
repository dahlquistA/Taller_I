$('.galeria_img').click(function(e){
	var img = e.target.src;
	var modal1 = '<div class="modal_contenedor" id="modal1"><img src="'+ img + '" class="modal_img"><div class="modal_boton" id="modal_boton">X</div></div>';
	$('nav').append(modal1);
	$('#modal_boton').click(function() {
		$('#modal1').remove();
	})
});

$(document).keyup(function(e) {
	if (e.which==27){
		$('#modal1').remove();
	}
});