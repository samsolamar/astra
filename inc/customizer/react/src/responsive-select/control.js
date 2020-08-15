import ResponsiveSelectComponent from './responsive-select-component.js';

export const responsiveSelectControl = wp.customize.astraControl.extend( {
	renderContent: function renderContent() {
		let control = this;
	ReactDOM.render( <ResponsiveSelectComponent control={ control } />, control.container[0] );
	},
	ready: function() {

		'use strict';

		let device = jQuery('.wp-full-overlay-footer .devices button.active').attr('data-device')

		jQuery( '.customize-control-ast-responsive-select .input-wrapper input' ).removeClass( 'active' );

		jQuery( '.customize-control-ast-responsive-select .input-wrapper input.' + device ).addClass( 'active' );

		jQuery( '.customize-control-ast-responsive-select .ast-responsive-btns li' ).removeClass( 'active' );

		jQuery( '.customize-control-ast-responsive-select .ast-responsive-btns li.' + device ).addClass( 'active' );

		jQuery('.wp-full-overlay-footer .devices button').on('click', function() {

			var device = jQuery(this).attr('data-device');

			jQuery( '.customize-control-ast-responsive-select .input-wrapper input, .customize-control .ast-responsive-btns > li' ).removeClass( 'active' );
			jQuery( '.customize-control-ast-responsive-select .input-wrapper input.' + device + ', .customize-control .ast-responsive-btns > li.' + device ).addClass( 'active' );

		});

		this.container.find( '.ast-responsive-btns button' ).on( 'click', function( event ) {

			var device = jQuery(this).attr('data-device');
			if( 'desktop' == device ) {
				device = 'tablet';
			} else if( 'tablet' == device ) {
				device = 'mobile';
			} else {
				device = 'desktop';
			}

			jQuery( '.wp-full-overlay-footer .devices button[data-device="' + device + '"]' ).trigger( 'click' );
		});
	},
} );