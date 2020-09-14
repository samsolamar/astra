<?php
/**
 * Template part for displaying the a row of the header
 *
 * @package Astra Builder
 */

$row = get_query_var( 'row' );

if ( Astra_Builder_helper::is_row_empty( $row, 'header', 'desktop' ) ) {

	$customizer_editor_row        = 'section-' . esc_attr( $row ) . '-header-builder';
	$is_transparent_header_enable = astra_get_option( 'transparent-header-enable' );

	if ( 'primary' === $row && $is_transparent_header_enable ) {
		$customizer_editor_row = 'section-transparent-header';
	}

	$row_label = ( 'primary' === $row ) ? 'main' : $row;

	?>
		<div class="ast-<?php echo esc_attr( $row_label ); ?>-header-wrap">
		<div class="<?php echo esc_attr( 'ast-' . $row . '-header-bar ast-' . $row . '-header' ); ?> <?php echo 'primary' === $row ? 'main-header-bar' : ''; ?>">
			<div class="site-<?php echo esc_attr( $row ); ?>-header-wrap ast-builder-grid-row-container site-header-focus-item ast-container" data-section="<?php echo esc_attr( $customizer_editor_row ); ?>">
				<div class="ast-builder-grid-row-container-inner">
					<?php
					if ( is_customize_preview() ) {
						Astra_Builder_UI_Controller::render_grid_row_customizer_edit_button( 'Header', $row );
					}
					?>
					<div class="site-container">
						<div class="site-<?php echo esc_attr( $row ); ?>-header-inner-wrap ast-builder-grid-row <?php echo ( Astra_Builder_helper::has_side_columns( $row ) ? 'ast-builder-grid-row-has-sides' : 'ast-grid-center-col-layout-only' ); ?> <?php echo ( Astra_Builder_helper::has_center_column( $row ) ? 'ast-grid-center-col-layout' : 'ast-builder-grid-row-no-center' ); ?>">
							<?php if ( Astra_Builder_helper::has_side_columns( $row ) ) { ?>
								<div class="site-header-<?php echo esc_attr( $row ); ?>-section-left site-header-section site-header-section-left">
									<?php
										/**
										 * Astra Render Header Column
										 */
										do_action( 'astra_render_header_column', $row, 'left' );
									if ( Astra_Builder_helper::has_center_column( $row ) ) {
										?>
												<div class="site-header-<?php echo esc_attr( $row ); ?>-section-left-center site-header-section ast-grid-left-center-section">
											<?php
											/**
											 * Astra Render Header Column
											 */
											do_action( 'astra_render_header_column', $row, 'left_center' );
											?>
												</div>
											<?php
									}
									?>
								</div>
							<?php } ?>
							<?php if ( Astra_Builder_helper::has_center_column( $row ) ) { ?>
								<div class="site-header-<?php echo esc_attr( $row ); ?>-section-center site-header-section grid-section-center">
									<?php
									/**
									 * Astra Render Header Column
									 */
									do_action( 'astra_render_header_column', $row, 'center' );
									?>
								</div>
							<?php } ?>
							<?php if ( Astra_Builder_helper::has_side_columns( $row ) ) { ?>
								<div class="site-header-<?php echo esc_attr( $row ); ?>-section-right site-header-section ast-grid-right-section">
									<?php
									if ( Astra_Builder_helper::has_center_column( $row ) ) {
										?>
										<div class="site-header-<?php echo esc_attr( $row ); ?>-section-right-center site-header-section ast-grid-right-center-section">
											<?php
											/**
											 * Astra Render Header Column
											 */
											do_action( 'astra_render_header_column', $row, 'right_center' );
											?>
										</div>
										<?php
									}
									/**
									 * Astra Render Header Column
									 */
									do_action( 'astra_render_header_column', $row, 'right' );
									?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	<?php
}