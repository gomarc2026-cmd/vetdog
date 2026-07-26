$(function(){

	// Lista de docente
	$.post( '../funciones/tipo.php' ).done( function(respuesta)
	{
		$( '#tipo' ).html( respuesta );
	});
	
	
	// Lista de Ciudades
	$( '#tipo' ).change( function()
	{
		var el_continente = $(this).val();
		// Lista de Paises
		$.post( '../funciones/raza.php', { continente: el_continente} ).done( function( respuesta )
		{
			$( '#raza' ).html( respuesta );
		});

	});



})
