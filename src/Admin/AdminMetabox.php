<?php
/**
 * Metabox
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

class AdminMetabox implements ActionHookSubscriberInterface, FilterHookSubscriberInterface
{
    /**
     * Get the action hooks Plugin subscribes to.
     *
     * @return array
     */
    public static function get_actions()
    {
        return array(
            'add_meta_boxes'    => array('add_meta_boxes', 10,2 ),
            'save_post'         => array('save_post', 10,3 )
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
    * Aggiunge un metabox per tutti i tipi di post
    */
    public function add_meta_boxes( $post_type, $post ) 
    {   
        // Non aggiunge il metabox se l'utente non è un amministratore
        if( ! \Ihbaf\Helpers\Utils::is_user_authorized() ){
            return;
        }

        add_meta_box(
            \Ihbaf\PLUGIN_NAME . '-' . $post_type,
            \Ihbaf\PLUGIN_NAME . ' ( MetaBox )',
            array( $this , 'template' ),
            $post_type,
            'advanced',
            'default'
           // array( '__block_editor_compatible_meta_box' => false, '__back_compat_meta_box' => true )
        );
    }


    /**
    * Salva i dati del metabox
    */
    public function save_post( $post_id = 0, $post_object = null, $update = false  )
    {

        // esci se non c'è il nonce
        if ( !isset( $_POST[ \Ihbaf\META_KEY.'_nonce' ] ) || empty( $_POST[ \Ihbaf\META_KEY.'_nonce' ] ) ) 
            return $post_id;
        
        // esci se il nonce non è corretto
        if ( !wp_verify_nonce( $_POST[ \Ihbaf\META_KEY.'_nonce' ], __FILE__  ) ) 
            return $post_id;
        
        // esci se è un autosave
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return $post_id;

        // esci se è una revisione
        if( wp_is_post_revision( $post_id ) )
            return $post_id;

        // esci se l'utente non ha la capacità di salvare o modificare un post o una pagina
        if ( 'page' == $post_object->post_type ) {
            if ( !current_user_can( 'edit_page', $post_id) )
                return $post_id;
        } else {
            if ( !current_user_can('edit_post', $post_id) )
                return $post_id;
        }

        // esci se l'utente non è un amministratore
        if( ! \Ihbaf\Helpers\Utils::is_user_authorized() ){
            return;
        }


        // Le priorità vengono mostrate e salvate solo nel pannello di amministrazione del plugin
        foreach (['_header','_body','_footer'] as $key ) :

            // ottengo i dati e mi assicuro 
            $value = isset( $_POST[ \Ihbaf\META_KEY . $key ] ) ? (string) $_POST[ \Ihbaf\META_KEY . $key ] : null;
            
            /**
             * Aggiorna o elimina i dati dal database
             * 
             * NOTE: $_POST has already been slashed by wp_magic_quotes 
             * in wp-settings so do nothing before saving
             * @see wp_magic_quotes() in WP 4.8.2 -> wp-settings.php;
             */     
            if ( empty( $value ) ) {
                if( get_post_meta( $post_id, \Ihbaf\META_KEY . $key ) )
                    delete_post_meta( $post_id, \Ihbaf\META_KEY . $key );
            } else {
                update_post_meta( $post_id, \Ihbaf\META_KEY . $key, trim($value) );
            }
        endforeach;

    }
    

    /**
    *  il template del Metabox in edit screen
    */
    public function template() 
    { 
        global $post;
        $optmeta_id = $post->ID;    
        include_once( \Ihbaf\DIR. '/src/Templates/admin/metabox.php' );
        // Crea il nonce
        echo '<input type="hidden" name="' . \Ihbaf\META_KEY . '_nonce'.'" value="' . wp_create_nonce( __FILE__ ) . '" />';
    }

}