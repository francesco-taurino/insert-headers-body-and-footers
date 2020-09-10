<?php 
/**
 * Utils
 *
 * @package     Ihbaf\Helpers
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2020, Francesco Taurino
 * @link        https://profiles.wordpress.org/francescotaurino/
 * @license     https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Ihbaf\Helpers;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

if( !class_exists('Utils') ) :

	class Utils {

		/**
		 * Verifica che l'utente abbia tutte le Capacità definite nella costante REQUIRED_CAPABILITIES
		 *
		 * @return bool true se ha le Capacità, false se non le ha.
		 *
		 */
		public static function is_user_authorized() {
			
			foreach ( \Ihbaf\REQUIRED_CAPABILITIES as $cap ) { 	
			  if( ! current_user_can( $cap ) ) {
				return false;
			  }
			}

			return true;
		}


		/**
		 * Ottiene i dati memorizzati
		 * 
		 * @param  int|string $post_id PostID|"site"
		 * @param  string $key head|body|footer|head_priority|body_priority|footer_priority
		 *
		 * @return mixed
		 */
		public static function get_script( $post_id = null, $key = null ) {
			
			if( $post_id == 'site' ){
				// Aggiungo il valore di default per le chiavi _priority
				$default = strpos($key, 'priority') !== false ? 10 : null;
				return get_option( \Ihbaf\META_KEY . '_' . $key , $default );
			} else {
				return get_post_meta( $post_id, \Ihbaf\META_KEY.'_'.$key , true );
			}
		}


		// Restituiscece le informazioni sul plugin
		public static function get_plugin_data( string $key = null ){
			return $key ? get_plugin_data( \Ihbaf\FILE )[$key] : \get_plugin_data( \Ihbaf\FILE );
		}


		/**
		 * Create Textarea field
		 * 
		 * @param  array  $args 
		 * @return void
		 */
		public static function textarea( $args = array() ) {
			if( !isset( $args['id'] ) || empty( $args['id'] ) ) return;
 			echo '<textarea ';
 			echo 'id="'.esc_attr( isset( $args['id'] ) ? $args['id'] : '' ).'" ';
 			echo 'name="'.esc_attr( isset( $args['name'] ) ? $args['name'] : $args['id'] ).'" ';
 			echo 'class="'.esc_attr(isset( $args['class'] ) ? $args['class'] : 'ihbaf-textarea').'" ';
			echo 'rows="'.esc_attr( isset( $args['rows'] ) ? $args['rows'] : '12' ).'" ';
			echo 'cols="'.esc_attr( isset( $args['cols'] ) ? $args['cols'] : '57' ).'" ';
 			echo '>';
 			echo esc_textarea( isset( $args['value'] ) ? $args['value'] : '' );
 			echo '</textarea>';
		}
		

		/**
		 * Create input field
		 * 
		 * @param  array  $args 
		 * @return void
		 */
		public static function input($args = array() ) {
			if( !isset( $args['id'] ) || empty( $args['id'] ) ) return;
			$default = isset( $args['default'] ) ? esc_attr( $args['default'] ) : '';
			echo '<input ';
			echo 'type="'.esc_attr( isset( $args['type'] ) ? $args['type'] : 'text' ).'" ';
 			echo 'id="'.esc_attr( isset( $args['id'] ) ? $args['id'] : '' ).'" ';
 			echo 'name="'.esc_attr( isset( $args['name'] ) ? $args['name'] : $args['id'] ).'" ';
 			echo 'value="'.esc_attr( isset( $args['value'] ) ? $args['value'] : $default ).'" ';
 			echo 'class="'.esc_attr(isset( $args['class'] ) ? $args['class'] : 'ihbaf-input').'" ';
 			echo '/> ';

		}
	}

endif;  






 