<?php
/**
 * Metabox
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

if( get_current_screen()->parent_base == 'options-general' ){
	$optmeta_id = 'site';    
} else{
	$optmeta_id = isset($post->ID) ? $post->ID : null;    
}
?>

<div class="ihbaf-metabox">




<label class="ihbaf-label" for="<?php echo \Ihbaf\META_KEY.'_header'; ?>">
	<?php esc_html_e( 'Header', 'insert-headers-body-and-footers'); ?>
	<p><em>
		<?php printf( esc_html__( 'These scripts will be printed in the %s section.', 'insert-headers-body-and-footers' ),'<code>&lt;head&gt;</code>'); ?>
	</em></p>
</label>

	<?php Utils::textarea( [ 
			'id'=> \Ihbaf\META_KEY.'_header', 
			'value' => Utils::get_script( $optmeta_id, 'header')
			] 
		);
	?>

<?php if ( get_current_screen()->parent_base == 'options-general' ): ?>
	<label class="ihbaf-label" for="<?php echo \Ihbaf\META_KEY.'_header_priority'; ?>">
	<p>
		<?php esc_html_e('Priority', 'insert-headers-body-and-footers'); ?>
		
		<?php Utils::input( [ 
				'type'=> 'number', 
				'id'=> \Ihbaf\META_KEY.'_header_priority', 
				'value' => Utils::get_script( $optmeta_id, 'header_priority')
				] 
			);
		?>
		<?php esc_html_e('Default', 'insert-headers-body-and-footers'); ?>: 10
	</p>
</label>	

<hr />

<?php endif; ?>






<?php //______________________BODY____________________________ ?>

<label class="ihbaf-label" for="<?php echo \Ihbaf\META_KEY.'_body'; ?>">
	<?php esc_html_e( 'Body', 'insert-headers-body-and-footers'); ?>
	<p><em>
		<?php printf( esc_html__( 'These scripts will be printed just below the opening %s tag.', 'insert-headers-body-and-footers' ), '<code>&lt;body&gt;</code>' ); ?>
	</em></p>
</label>

	<?php Utils::textarea( [ 
			'id'=> \Ihbaf\META_KEY.'_body', 
			'value' => Utils::get_script( $optmeta_id, 'body')
			] 
		);
	?>


<?php if ( get_current_screen()->parent_base == 'options-general' ): ?>
	<label class="ihbaf-label" for="<?php echo \Ihbaf\META_KEY.'_body_priority'; ?>">
	<p>
		<?php esc_html_e('Priority', 'insert-headers-body-and-footers'); ?>
		
		<?php Utils::input( [ 
				'type'=> 'number', 
				'id'=> \Ihbaf\META_KEY.'_body_priority', 
				'value' => Utils::get_script( $optmeta_id, 'body_priority')
				] 
			);
		?>
		<?php esc_html_e('Default', 'insert-headers-body-and-footers'); ?>: 10
	</p>
</label>	

<hr />

<?php endif; ?>
<?php //______________________\BODY_________________________ ?>






<?php //______________________FOOTER____________________________ ?>

<label class="ihbaf-label" for="<?php echo \Ihbaf\META_KEY.'_footer'; ?>">
	<?php esc_html_e( 'Body', 'insert-headers-body-and-footers'); ?>
	<p><em>
		<?php printf( esc_html__( 'These scripts will be printed in the %s section.', 'insert-headers-body-and-footers' ),'<code>&lt;head&gt;</code>'); ?>
	</em></p>
</label>	
	<?php Utils::textarea( [ 
			'id'=> \Ihbaf\META_KEY.'_footer', 
			'value' => Utils::get_script( $optmeta_id, 'footer')
			] 
		);
	?>


<?php if ( get_current_screen()->parent_base == 'options-general' ): ?>
	<label class="ihbaf-label" for="<?php echo \Ihbaf\META_KEY.'_footer_priority'; ?>">
	<p>
		<?php esc_html_e('Priority', 'insert-headers-body-and-footers'); ?>
		
		<?php Utils::input( [ 
				'type'=> 'number', 
				'id'=> \Ihbaf\META_KEY.'_footer_priority', 
				'value' => Utils::get_script( $optmeta_id, 'footer_priority')
				] 
			);
		?>
		<?php esc_html_e('Default', 'insert-headers-body-and-footers'); ?>: 10
	</p>
</label>	

<hr />

<?php endif; ?>
<?php //______________________\FOOTER_________________________ ?>






</div> <!-- ihbaf-metabox -->