$(function(){

	// Lista de docente
	$.post( '../../vista/funciones/provee.php' ).done( function(respuesta)
	{
		$( '#provee' ).html( respuesta );
	});
	
	
	// Lista de Ciudades
	$( '#provee' ).change( function()
	{
		var el_continente = $(this).val();

	});


})
