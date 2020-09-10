<?php  
/**
 * Insert Headers, Body and Footers
 * 
 * @package     Ihbaf
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2020, Francesco Taurino
 * @license     https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * 
 * @wordpress-plugin
 * Plugin Name:       Insert Headers, Body and Footers
 * Plugin URI:        https://wordpress.org/plugins/insert-headers-body-and-footers
 * Description:       Allows you to add extra scripts/codes to the header, after the body tag and the footer of an individual post (or any post type) and/or site-wide, without touching your theme files.
 * Version:           1.0.0
 * Requires at least: 5.2.0
 * Tested up to:      5.5.1
 * Requires PHP:      7.2
 * Author:            Francesco Taurino
 * Author URI:        https://profiles.wordpress.org/francescotaurino/
 * Text Domain:       insert-headers-body-and-footers
 * License:           GPL2+
 * License URI:       https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 */

namespace Ihbaf;

// Il nome del plugin
const PLUGIN_NAME = 'Insert Headers, Body and Footers';
// Lo slug del plugin
const PLUGIN_SLUG = 'insert-headers-body-and-footers';
// Il prefisso delle opzioni (meta_key & option_name) dei campi nel form . . .
const META_KEY = '_ihbaf';
// Le Capacità richieste all'utente per usare il plugin 
const REQUIRED_CAPABILITIES = ['manage_options','unfiltered_html'];
// Il percorso di questo file
const FILE = __FILE__;
// Il percorso di questa directory
const DIR = __DIR__;

add_action( 'plugins_loaded', function() {
	
	require_once('vendor/autoload.php');
	
	$manager = new \Ihbaf\Inc\PluginAPIManager(); 

	// Non carica la parte amministrativa se l'utente non ha le capacità definite in REQUIRED_CAPABILITIES
	if( \Ihbaf\Helpers\Utils::is_user_authorized() ){
		$manager->register( new \Ihbaf\Admin\AdminPage);
		$manager->register( new \Ihbaf\Admin\AdminMetabox );
		$manager->register( new \Ihbaf\Admin\CodeMirror );
	}

	$manager->register( new \Ihbaf\Frontend\Frontend);

}, 10, 1 );