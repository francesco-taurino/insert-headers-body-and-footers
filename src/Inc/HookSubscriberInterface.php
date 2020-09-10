<?php 
/**
 * PluginAPIManager
 *
 * @package     Ihbaf\Inc
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2020, Francesco Taurino
 * @link        https://profiles.wordpress.org/francescotaurino/
 * @license     https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Ihbaf\Inc;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * 
 * HookSubscriberInterface viene utilizzato da un oggetto 
 * che deve registrarsi alle azioni e/o ai filtri di WordPress
 * 
 * Gestirà la registrazione delle azioni e/o filtri per qualsiasi classe. 
 * 
 * . . . Divido questa interfaccia in due e lascio la classe qui per progetti futuri.
 * @see         FilterHookSubscriberInterface
 * @see         ActionHookSubscriberInterface
 */
interface HookSubscriberInterface
{
    /**
     * Returns an array of actions that the object needs to be subscribed to.
     *
     * The array key is the name of the action hook. The value can be:
     *
     *  * The method name
     *  * An array with the method name and priority
     *  * An array with the method name, priority and number of accepted arguments
     *
     * For instance:
     *
     *  * array('action_name' => 'method_name')
     *  * array('action_name' => array('method_name', $priority))
     *  * array('action_name' => array('method_name', $priority, $accepted_args))
     *
     * @return array
     */
    public static function get_actions();

    /**
     * Returns an array of filters that the object needs to be subscribed to.
     *
     * The array key is the name of the filter hook. The value can be:
     *
     *  * The method name
     *  * An array with the method name and priority
     *  * An array with the method name, priority and number of accepted arguments
     *
     * For instance:
     *
     *  * array('filter_name' => 'method_name')
     *  * array('filter_name' => array('method_name', $priority))
     *  * array('filter_name' => array('method_name', $priority, $accepted_args))
     *
     * @return array
     */
    public static function get_filters();
}
