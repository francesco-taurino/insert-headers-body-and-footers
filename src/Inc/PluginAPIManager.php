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
 * Gestisce la registrazione di azioni e filtri
 */
class PluginAPIManager
{
    /**
     * Registra un oggetto
     *
     * @param mixed $object
     */
    public function register($object)
    {
        if ($object instanceof ActionHookSubscriberInterface) {
            $this->register_actions($object);
        }
        if ($object instanceof FilterHookSubscriberInterface) {
            $this->register_filters($object);
        }
    }

    /**
     * Registra un oggetto con uno specifico hook di azione
     *
     * @param ActionHookSubscriberInterface $object
     * @param string                        $name
     * @param mixed                         $parameters
     */
    private function register_action(ActionHookSubscriberInterface $object, $name, $parameters)
    {
        if (is_string($parameters)) {
            add_action($name, array($object, $parameters));
        } elseif (is_array($parameters) && isset($parameters[0])) {
            add_action($name, array($object, $parameters[0]), isset($parameters[1]) ? $parameters[1] : 10, isset($parameters[2]) ? $parameters[2] : 1);
        }
    }

    /**
     * Registra un oggetto con tutti i suoi hook di azione.
     *
     * @param ActionHookSubscriberInterface $object
     */
    private function register_actions(ActionHookSubscriberInterface $object)
    {
        foreach ($object->get_actions() as $name => $parameters) {
            $this->register_action($object, $name, $parameters);
        }
    }

    /**
     * Registra un oggetto con uno specifico hook di filtro
     *
     * @param FilterHookSubscriberInterface $object
     * @param string                        $name
     * @param mixed                         $parameters
     */
    private function register_filter(FilterHookSubscriberInterface $object, $name, $parameters)
    {
        if (is_string($parameters)) {
            add_filter($name, array($object, $parameters));
        } elseif (is_array($parameters) && isset($parameters[0])) {
            add_filter($name, array($object, $parameters[0]), isset($parameters[1]) ? $parameters[1] : 10, isset($parameters[2]) ? $parameters[2] : 1);
        }
    }

    /**
     * Registra un oggetto con tutti i suoi hook di filtro.
     *
     * @param FilterHookSubscriberInterface $object
     */
    private function register_filters(FilterHookSubscriberInterface $object)
    {
        foreach ($object->get_filters() as $name => $parameters) {
            $this->register_filter($object, $name, $parameters);
        }
    }
}
