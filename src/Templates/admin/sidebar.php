<?php
/**
 * Sidebar
 *
 * @package     Ihbaf\Templates\Admin
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2020, Francesco Taurino
 * @link        https://profiles.wordpress.org/francescotaurino/
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

use \Ihbaf\Helpers\Utils;
?>

<div id="postbox-container-1" class="postbox-container">


<div class="postbox ft-plugin-info">
  <h3 class="hndle"><span>Plugin</span></h3>
  <div class="inside">
    <ul>
     
      <li class="plugin_name">
        <span class="dashicons dashicons-admin-plugins"></span> 
        <?php echo esc_html_x( 'Name', 'Name of the plugin', 'ihbaf' ); ?>:
        <strong><?php echo ( get_plugin_data(\Ihbaf\FILE)['Name'] ); ?></strong>
      </li> 

      <li class="version">
        <span class="dashicons dashicons-admin-generic"></span> 
        <?php echo esc_html_x( 'Version', 'Plugin version', 'ihbaf' ); ?>:  
        <strong><?php list( $__Major, $__Minor, $__Patch ) = explode('.',  get_plugin_data(\Ihbaf\FILE)['Version'] ); ?>
        <span title="Major version" style="color:red"><?php echo esc_html( $__Major ); ?></span>.
        <span title="Minor version" style="color:orange"><?php echo esc_html( $__Minor ); ?></span>.
        <span title="Patch version" style="color:green"><?php echo esc_html( $__Patch ); ?></span></strong>
      </li> 

      <li>
        <span class="dashicons dashicons-admin-users"></span>
        <?php echo esc_html_x('Created by', 'Author\'s name', 'ihbaf' ); ?> 
        <strong><a href="<?php echo esc_attr( get_plugin_data(\Ihbaf\FILE)['AuthorURI'] ); ?>" target="_blank" title="<?php echo esc_attr( get_plugin_data(\Ihbaf\FILE)['AuthorURI'] ); ?>">
          <?php echo esc_html( get_plugin_data(\Ihbaf\FILE)['AuthorName'] ); ?> 
        </a></strong>

        <strong><a title="<?php echo esc_attr( get_plugin_data(\Ihbaf\FILE)['AuthorName'] ); ?> - WordPress" style="color:green; padding-left: 10px;" href="https://profiles.wordpress.org/francescotaurino/" target="_blank">
        </a></strong>
      </li>
    
      <li>
        <span class="dashicons dashicons-media-text"></span> 
        <strong><a target="_blank" href="https://plugins.svn.wordpress.org/<?php echo get_plugin_data(\Ihbaf\FILE)['TextDomain']; ?>/trunk/CHANGELOG.md">
          <?php echo esc_html_x( 'Changelog', 'Changelog of the plugin', 'ihbaf' ); ?>
        </a></strong>
      </li>

    </ul>

  </div>

</div>
<!-- /.postbox -->
 
  <div class="postbox">
    <h3 class="hndle"><?php esc_html_e( 'Scripts are not shown?', 'insert-headers-body-and-footers'); ?></h3>
    <div class="inside">

      <p><?php /* translators: %s: The `<head>` tag */ 
        printf(esc_html__( 'Ensure your theme %s is using %s %s %s.', 'insert-headers-body-and-footers' ),
          
          '('.wp_get_theme()->Name.')',

          '<a style="text-decoration:none" target="_blank" href="https://developer.wordpress.org/reference/functions/wp_head/">wp_head();<a>',
          
          '<a style="text-decoration:none" target="_blank" href="https://developer.wordpress.org/reference/functions/wp_body_open/">wp_body_open();<a>',
          
          '<a style="text-decoration:none" target="_blank" href="https://developer.wordpress.org/reference/functions/wp_footer/">wp_footer();<a>'
        ); ?>


      </p>
    </div>
  </div>

  <div class="postbox">
    <h3 class="hndle"><?php esc_html_e( 'Need Help?', 'insert-headers-body-and-footers'); ?></h3>
    <div class="inside">
      <p><?php esc_html_e( 'Got something to say? Need help?', 'insert-headers-body-and-footers'); ?></p>
      <p><strong><a target="_blank" href="<?php echo esc_url( 'https://wordpress.org/support/plugin/'.get_plugin_data(\Ihbaf\FILE)['TextDomain'] ); ?>" class="button"><?php esc_html_e('View support forum', 'insert-headers-body-and-footers'); ?></a></strong></p>
    </div>
  </div>

  <div class="postbox">
    <h3 class="hndle"><?php esc_html_e( 'Donate', 'insert-headers-body-and-footers'); ?></h3>
    <div class="inside">
      <p><?php esc_html_e( 'We would appreciate a small donation that will help us to continue improving this plugin and create more plugins totally free for the entire WordPress community', 'insert-headers-body-and-footers'); ?></p>
      <p><a target="_blank" href="<?php echo str_replace(' ', '', 'h t t p s : / / w w w . p a y p a l . m e / f r a n c e s c o t a u r i n o' ) ?>" class="button"><?php esc_html_e( 'Donate', 'insert-headers-body-and-footers'); ?> <span style="color: red" class="dashicons dashicons-heart"></span> </a></p>
    </div>
  </div>

  <div class="postbox">
    <h3 class="hndle"><?php esc_html_e( 'Rate 5 Stars', 'insert-headers-body-and-footers'); ?></h3>
    <div class="inside">
      <p><?php esc_html_e( 'Find this plugin useful rate it 5 stars and leave a nice little comment at wordpress.org. I would really appreciate that.', 'insert-headers-body-and-footers'); ?></p>
      <p><a target="_blank" href="<?php echo esc_url( 'https://wordpress.org/support/plugin/'.get_plugin_data(\Ihbaf\FILE)['TextDomain'].'/reviews/?filter=5#new-post' ); ?>" class="button"><?php esc_html_e( 'Rate 5 Stars', 'insert-headers-body-and-footers'); ?></a></p>
    </div>
  </div>


</div>
