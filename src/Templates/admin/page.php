<?php
/**
 * Settings Page
 *
 * @package     Ihbaf\Templates\Admin
 * @author      Francesco Taurino <dev.francescotaurino@gmail.com>
 * @copyright   Copyright (c) 2020, Francesco Taurino
 * @link        https://profiles.wordpress.org/francescotaurino/
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * 
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

?>
<div class="wrap">
  <h2><?php echo get_admin_page_title(); ?></h2>
  <hr />

  <div id="poststuff">
  <div id="post-body" class="metabox-holder columns-2">
    <div id="post-body-content">
      <div class="postbox">
        <div class="inside">
          <form name="dofollow" action="options.php" method="post">
            <?php settings_fields( \Ihbaf\META_KEY ); ?>
             <?php include_once( 'metabox.php' ); ?>
            <p class="submit">
              <input class="button button-primary" type="submit" name="Submit" value="<?php esc_html_e( 'Save settings', 'insert-headers-body-and-footers'); ?>" />
            </p>
          </form>
        </div>
    </div>
    </div> 
     <?php include_once( 'sidebar.php' ); ?>
     </div>
  </div>
</div>

