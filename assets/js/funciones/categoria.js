$(function(){

	// Lista de docente
	$.post( '../../vista/funciones/categoria.php' ).done( function(respuesta)
	{
		$( '#categoria' ).html( respuesta );
	});
	
	
	// Lista de Ciudades
	$( '#categoria' ).change( function()
	{
		var el_continente = $(this).val();

	});


})
