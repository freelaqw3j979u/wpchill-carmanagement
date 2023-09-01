<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

#cpt-carro-shortcode-view.php
add_shortcode("wpchill_carmanagement_view", "wpchill_carmanagement_view");
function wpchill_carmanagement_view($atts, $content = null){

	global $post;
	$post_id = $post->ID;
	$values = get_post_custom( $post->ID );

	$fix1693416443_modelo = isset( $values['fix1693416443_modelo'] ) ? esc_attr( $values['fix1693416443_modelo'][0] ) : '';
	$fix1693416443_fuel = isset( $values['fix1693416443_fuel'] ) ? esc_attr( $values['fix1693416443_fuel'][0] ) : '';
	$fix1693416443_preco = isset( $values['fix1693416443_preco'] ) ? esc_attr( $values['fix1693416443_preco'][0] ) : '';
	$fix1693416443_cor = isset( $values['fix1693416443_cor'] ) ? esc_attr( $values['fix1693416443_cor'][0] ) : '';
	ob_start();
	?>

	<table id="fix-table">
        <tr>
            <th><?php echo __('Model') ?>:</th>
            <td>
                <?php echo $fix1693416443_modelo ?>
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
                <?php echo $fix1693416443_cor ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Price') ?>:</th>
            <td>
                <?php echo $fix1693416443_preco ?>
            </td>
        </tr>
	</table>	
	<?php
	return ob_get_clean();
}