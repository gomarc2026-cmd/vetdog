$(function(){

	// Lista de docente
	$.post( '../../funciones/vet.php' ).done( function(respuesta)
	{
		$( '#vete' ).html( respuesta );
	});
	
	
	// Lista de Ciudades
	$( '#vete' ).change( function()
	{
		var el_continente = $(this).val();

	});


})
