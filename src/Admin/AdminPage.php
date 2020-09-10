<?php
/**
 * Admin Page
 *
 * @package     Ihbaf\Admin
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2020, Francesco Taurino
 * @link        https://profiles.wordpress.org/francescotaurino/
 * @license     https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Ihbaf\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

use \Ihbaf\Inc\ActionHookSubscriberInterface;
use \Ihbaf\Inc\FilterHookSubscriberInterface;

class AdminPage implements ActionHookSubscriberInterface, FilterHookSubscriberInterface
{
    /**
     * Get the action hooks Plugin subscribes to.
     *
     * @return array
     */
    public static function get_actions()
    {
        return array(
            'admin_menu'            => 'admin_menu',
            'admin_init'            => 'admin_init',
            'admin_enqueue_scripts' => 'admin_enqueue_scripts'
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

    /**
    * Aggiunge il pannello di amministazione e il relativo sottomenu 
    * in Settings > WP Head Footer Script
    */
    public function admin_menu($context) 
    {
        add_options_page(
            \Ihbaf\PLUGIN_NAME . ' ( Site-Wide )',
            \Ihbaf\PLUGIN_NAME,
            \Ihbaf\REQUIRED_CAPABILITIES[0],
            \Ihbaf\META_KEY,
            array($this, 'template' )
        );
    }

    /**
    * Eliminato . vedi sopra $admin_page->configure();
    * Registra le impostazioni per il pannello di amministrazione
    * Lascio come nota mnemonica.
    */
    public function admin_init() 
    {
        register_setting( \Ihbaf\META_KEY, \Ihbaf\META_KEY.'_header', 'trim' );
        register_setting( \Ihbaf\META_KEY, \Ihbaf\META_KEY.'_body', 'trim' );
        register_setting( \Ihbaf\META_KEY, \Ihbaf\META_KEY.'_footer', 'trim' );
        register_setting( \Ihbaf\META_KEY, \Ihbaf\META_KEY.'_header_priority', 'intval' );
        register_setting( \Ihbaf\META_KEY, \Ihbaf\META_KEY.'_body_priority', 'intval' );
        register_setting( \Ihbaf\META_KEY, \Ihbaf\META_KEY.'_footer_priority', 'intval' );
    }


    /**
    * Output del pannello di amministrazione
    */
    public static function template() 
    {
        include_once( \Ihbaf\DIR. '/src/Templates/admin/page.php' );
    }


    /**
    * Aggiunge gli script solo nel pannello ed in edit/post/page...
    */
    public function admin_enqueue_scripts($context) 
    {      

        if( ! in_array( $context, [ 'settings_page_'.\Ihbaf\META_KEY, 'post.php', 'post-new.php' ] ) ) {
           return;
        }

        wp_enqueue_style( 
            \Ihbaf\PLUGIN_SLUG.'-css', 
            plugins_url( 'assets/admin/admin.css', \Ihbaf\FILE ), 
            [], 
            get_plugin_data(\Ihbaf\FILE)['Version']
        );  

        /*
        wp_enqueue_script( 
            \Ihbaf\PLUGIN_SLUG.'-js', 
            plugins_url( 'assets/admin/admin.js', \Ihbaf\FILE ), 
            ['jquery'], 
            get_plugin_data(\Ihbaf\FILE)['Version']
        );
        */
       
    }
        

}