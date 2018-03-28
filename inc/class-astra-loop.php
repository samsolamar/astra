<?php
/**
 * Astra Loop
 *
 * @package Astra
 * @since 1.2.7
 */

if ( ! class_exists( 'Astra_Loop' ) ) :

	/**
	 * Astra_Loop
	 *
	 * @since 1.2.7
	 */
	class Astra_Loop {

		/**
		 * Instance
		 *
		 * @since 1.2.7
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.2.7
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.2.7
		 */
		public function __construct() {
			// Loop.
			add_action( 'astra_content_loop', array( $this, 'loop_markup' ) );

			// Template Parts.
			add_action( 'astra_template_parts_content', array( $this, 'template_parts_page' ) );
			add_action( 'astra_template_parts_content', array( $this, 'template_parts_post' ) );
			add_action( 'astra_template_parts_content', array( $this, 'template_parts_search' ) );
			add_action( 'astra_template_parts_content', array( $this, 'template_parts_default' ) );
			add_action( 'astra_template_parts_content', array( $this, 'template_parts_comments' ), 15 );

			// Template None.
			add_action( 'astra_template_parts_content_none', array( $this, 'template_parts_none' ) );
			add_action( 'astra_template_parts_content_none', array( $this, 'template_parts_404' ) );

			// Content top and bottom.
			add_action( 'astra_template_parts_content_top', array( $this, 'template_parts_content_top' ) );
			add_action( 'astra_template_parts_content_bottom', array( $this, 'template_parts_content_bottom' ) );

			// Add closing and ending div 'ast-row'.
			add_action( 'astra_template_parts_content_top', array( $this, 'astra_templat_part_wrap_open' ), 25 );
			add_action( 'astra_template_parts_content_bottom', array( $this, 'astra_templat_part_wrap_close' ), 5 );
		}

		/**
		 * Template part none
		 *
		 * @since 1.2.7
		 * @return void
		 */
		function template_parts_none() {
			if ( is_archive() || is_search() ) {
				get_template_part( 'template-parts/content', 'none' );
			}
		}

		/**
		 * Template part 404
		 *
		 * @since 1.2.7
		 * @return void
		 */
		function template_parts_404() {
			if ( is_404() ) {
				get_template_part( 'template-parts/content', '404' );
			}
		}

		/**
		 * Template part page
		 *
		 * @since 1.2.7
		 * @return void
		 */
		function template_parts_page() {
			if ( is_page() ) {
				get_template_part( 'template-parts/content', 'page' );
			}
		}

		/**
		 * Template part single
		 *
		 * @since 1.2.7
		 * @return void
		 */
		function template_parts_post() {
			if ( is_single() ) {
				get_template_part( 'template-parts/content', 'single' );
			}
		}

		/**
		 * Template part search
		 *
		 * @since 1.2.7
		 * @return void
		 */
		function template_parts_search() {
			if ( is_search() ) {
				get_template_part( 'template-parts/content', 'blog' );
			}
		}

		/**
		 * Template part comments
		 *
		 * @since 1.2.7
		 * @return void
		 */
		function template_parts_comments() {
			if ( is_single() || is_page() ) {
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			}
		}

		/**
		 * Template part default
		 *
		 * @since 1.2.7
		 * @return void
		 */
		function template_parts_default() {
			if ( ! is_page() && ! is_single() && ! is_search() ) {
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', astra_get_post_format() );
			}
		}

		/**
		 * Template part loop
		 *
		 * @since 1.2.7
		 * @return void
		 */
		function loop_markup() {
			?>
			<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) : ?>

					<?php do_action( 'astra_template_parts_content_top' ); ?>

					<?php
					while ( have_posts() ) :
						the_post();

						do_action( 'astra_template_parts_content' );
						?>

					<?php endwhile; ?>

					<?php do_action( 'astra_template_parts_content_bottom' ); ?>

				<?php else : ?>

					<?php do_action( 'astra_template_parts_content_none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->
			<?php
		}

		/**
		 * Template part content top
		 *
		 * @since 1.2.7
		 * @return void
		 */
		function template_parts_content_top() {
			if ( is_archive() ) {
				astra_content_while_before();
			}
		}

		/**
		 * Template part content bottom
		 *
		 * @since 1.2.7
		 * @return void
		 */
		function template_parts_content_bottom() {
			if ( is_archive() ) {
				astra_content_while_after();
			}
		}

		/**
		 * Add wrapper div 'ast-row' for Astra template part.
		 *
		 * @since  1.2.7
		 * @return void
		 */
		public function astra_templat_part_wrap_open() {
			if ( is_archive() || is_search() || is_home() ) {
				echo '<div class="ast-row">';
			}
		}

		/**
		 * Add closing wrapper div for 'ast-row' after Astra template part.
		 *
		 * @since  1.2.7
		 * @return void
		 */
		public function astra_templat_part_wrap_close() {
			if ( is_archive() || is_search() || is_home() ) {
				echo '</div>';
			}
		}

	}

	/**
	 * Initialize class object with 'get_instance()' method
	 */
	Astra_Loop::get_instance();

endif;
