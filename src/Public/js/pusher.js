( function( $, pusher, addItem ) {

var itemActionChannel = pusher.subscribe( 'itemAction' );

itemActionChannel.bind( "App\\Events\\ItemCreated", function( data ) {

    addItem( data, false );

} );

} )( jQuery, pusher, addItem);