(function( $ ) {
	$( 'input' ).on( 'click', function() {
		$( 'input' ).removeAttr('data-clicked');
		$( this ).attr('data-clicked', 'clicked');
	})
	$( 'form' ).on( 'submit', function( e ) {
		e.preventDefault();

		$.ajax({
			method: "POST",
			data: { control: $( '[data-clicked]' ).attr( 'name' ) }
		}).done(function( error ) {
			if( error ) {
				alert( error );
			} else {
				$.ajax({
					method: "POST",
					data: { refresh: 1 }
				}).done(function( sum ) {
					if( sum ) {
						$( 'div' ).html( sum );
					}
				});
			}
		});
	} );
})(jQuery);