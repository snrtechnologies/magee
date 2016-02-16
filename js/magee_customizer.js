jQuery(document).ready(function() {

	

	jQuery( '.ui-state-default' ).on( 'mousedown', function() {
		jQuery( '#customize-header-actions #save' ).trigger( 'click' );

	});


	/* Move our team widgets in the our team panel */
	wp.customize.section( 'sidebar-widgets-sidebar-ourteam' ).panel( 'panel_ourteam' );
	wp.customize.section( 'sidebar-widgets-sidebar-ourteam' ).priority( '2' );
        
        wp.customize.section( 'sidebar-widgets-sidebar-features' ).panel( 'panel_features' );
	wp.customize.section( 'sidebar-widgets-sidebar-features' ).priority( '2' );
	
        wp.customize.section( 'sidebar-widgets-sidebar-default' ).panel( 'widgets' );
	wp.customize.section( 'sidebar-widgets-sidebar-default' ).priority( '1' );
	
	
});