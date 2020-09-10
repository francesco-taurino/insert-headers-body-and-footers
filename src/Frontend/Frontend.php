<?php
/**
 * Frontend
 *
 * @package     Ihbaf\Frontend
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2020, Francesco Taurino
 * @link        https://profiles.wordpress.org/francescotaurino/
 * @license     https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Ihbaf\Frontend;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

use \Ihbaf\Inc\ActionHookSubscriberInterface;
use \Ihbaf\Inc\FilterHookSubscriberInterface;
use \Ihbaf\Helpers\Utils;

class Frontend implements ActionHookSubscriberInterface, FilterHookSubscriberInterface
{
    /**
     * Get the action hooks Plugin subscribes to.
     *
     * @return array
     */
    public static function get_actions()
    {	
    	if ( is_admin() || is_feed() || is_robots() || is_trackback() ) 
			return array();

        return array(
            'wp_head'       => array( 'wp_head',        Utils::get_script( 'site', 'header_priority') ),
            'wp_body_open'  => array( 'wp_body_open',   Utils::get_script( 'site', 'body_priority') ),
            'wp_footer'     => array( 'wp_footer',      Utils::get_script( 'site', 'footer_priority') )

        );
    }

     /**
     * Get the filter hooks Plugin subscribes to.
     *
     * @return array
     */
    public static function get_filters()
    {
        return array();
    }

	public function wp_head() {
        self::scripts('header');
	}

	public function wp_body_open() {
        self::scripts('body');
	}

	public function wp_footer() {
        self::scripts('footer');
	}

    public static function scripts( string $key = '' ) {
        $site = Utils::get_script( 'site', $key) ;
        if ( !empty($site) ):
            echo PHP_EOL;
            echo '<!-- ' . \Ihbaf\PLUGIN_NAME . ' [' . $key . '] [Site-wide] -->';
            echo PHP_EOL . $site . PHP_EOL;
            echo '<!-- /' . \Ihbaf\PLUGIN_NAME . ' [/' . $key . '] [/Site-wide] -->';
            echo PHP_EOL;
        endif;

        if ( is_singular() ):
            $single = Utils::get_script( get_the_ID(), $key) ;
            if ( !empty($single) ){
                echo PHP_EOL;
                echo '<!-- ' . \Ihbaf\PLUGIN_NAME . ' [' . $key . '] [Singular] -->';
                echo PHP_EOL . $single . PHP_EOL;
                echo '<!-- /' . \Ihbaf\PLUGIN_NAME . ' [/' . $key . '] [/Singular] -->';
                echo PHP_EOL;
            }
        endif;
    }

}