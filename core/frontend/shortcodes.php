<?php

namespace Markutos\Core\Frontend;

use FilterPlus\Utils\Singleton;

/**
 * Base Class
 *
 * @since 1.0.0
 */
class Shortcodes {

	use Singleton;

	/**
	 * Initialize all modules.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init() {
		$shortcode_arr = array(
			'team_members' 	=> 'team_members',
		);

		// add short code
		if ( ! empty( $shortcode_arr ) ) {
			foreach ( $shortcode_arr as $key => $value ) {
				add_shortcode( $key, [$this, $value] );
			}
		}
	}

	/**
	 * Filter products
	 *
	 * @param [type] $atts
	 */
	public function team_members( $atts ) {
		$atts = extract(
			shortcode_atts(
				array(
					'limit'       		=> '2',
					'position'          => 'center',
					'see_all'           => 'yes',
				), $atts )
		);

		ob_start();

		?>
		<div class="wrapper">
			<?php 
				if ( file_exists( \Markutos::core_dir() . "templates/team-members/template-1.php" ) ) {
					include_once \Markutos::core_dir() . "templates/team-members/template-1.php";
				}
			?>
		</div>
		<?php
		
		return ob_get_clean();
	}
}
