<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

#cpt-carro-026-shortcode-view.php
add_shortcode("wpchill_carmanagement_view", "wpchill_carmanagement_view");
function wpchill_carmanagement_view($atts, $content = null){

	global $post;
	$post_id = $post->ID;
	$values = get_post_custom( $post->ID );

	$fix1693416443_model = isset( $values['fix1693416443_model'] ) ? esc_attr( $values['fix1693416443_model'][0] ) : '';
	$fix1693416443_fuel = isset( $values['fix1693416443_fuel'] ) ? esc_attr( $values['fix1693416443_fuel'][0] ) : '';
	$fix1693416443_price = isset( $values['fix1693416443_price'] ) ? esc_attr( $values['fix1693416443_price'][0] ) : '';
	$fix1693416443_color = isset( $values['fix1693416443_color'] ) ? esc_attr( $values['fix1693416443_color'][0] ) : '';
	ob_start();
	?>

	<table id="fix-table">
        <tr>
            <th><?php echo __('Model') ?>:</th>
            <td>
                <?php echo $fix1693416443_model ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Fuel') ?>:</th>
            <td>
                <?php echo $fix1693416443_fuel ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Color') ?>:</th>
            <td>
                <?php echo $fix1693416443_color ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Price') ?>:</th>
            <td>
                <?php echo $fix1693416443_price ?>
            </td>
        </tr>
	</table>	
	<?php
	return ob_get_clean();
}