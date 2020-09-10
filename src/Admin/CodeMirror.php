<?php
/**
 * CodeMirror scripts
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

class CodeMirror implements ActionHookSubscriberInterface, FilterHookSubscriberInterface
{
    /**
     * Get the action hooks Plugin subscribes to.
     *
     * @return array
     */
    public static function get_actions()
    {
        return array(
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
    * Aggiunge gli script solo nel pannello ed in edit/post/page...
    * 
    * NOTE: Ho disabilitato codemirror in post perché c'è un qualche conflitto con js.
    * Il testo inserito nel text editor non viene passato alla textarea e di conseguenza 
    * i dati non vengono salvati nel post meta.
    */
    public function admin_enqueue_scripts($context) 
    {      

        ///* , 'post.php', 'post-new.php' */
        if( ! in_array( $context, [ 'settings_page_'.\Ihbaf\META_KEY ] ) ) {
           return;
        }
        
        wp_enqueue_script( 
            \Ihbaf\PLUGIN_SLUG.'-codemirror-editor-js', 
            plugins_url( 'assets/admin/codemirror-editor.js', \Ihbaf\FILE ), 
            ['jquery'], 
            get_plugin_data(\Ihbaf\FILE)['Version']
        );
  
        wp_enqueue_script( 
            \Ihbaf\PLUGIN_SLUG.'-codemirror', 
            plugins_url( 'vendor/codemirror/lib/codemirror.js', \Ihbaf\FILE ), 
            [ \Ihbaf\PLUGIN_SLUG.'-codemirror-editor-js' ], 
            get_plugin_data(\Ihbaf\FILE)['Version']
        ); 

        wp_enqueue_style( 
            \Ihbaf\PLUGIN_SLUG.'-codemirror', 
            plugins_url( 'vendor/codemirror/lib/codemirror.css',  \Ihbaf\FILE ), 
            [], 
            get_plugin_data(\Ihbaf\FILE)['Version']
        );  

        foreach ([ 'xml','htmlmixed','htmlembedded','css','javascript' ] as $key ) {
            wp_enqueue_script( 
                \Ihbaf\PLUGIN_SLUG.'-codemirror-'.$key, 
                plugins_url( 'vendor/codemirror/mode/'.$key.'/'.$key.'.js', \Ihbaf\FILE ), 
                [ \Ihbaf\PLUGIN_SLUG.'-codemirror' ], 
                get_plugin_data(\Ihbaf\FILE)['Version']
            );
        }
       
    }
        

}