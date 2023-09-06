<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

add_action( 'add_meta_boxes', 'fix1693416443cpt_mb_ini' );
function fix1693416443cpt_mb_ini(){
	global $fix1693416443cpt;
	add_meta_box( 
		'fix1693416443cpt_mb_id', 
		'Parametros', 
		'fix1693416443cpt_mb_fields', 
		'carro', 
		'normal', 
		'high' 
	);
}

function fix1693416443cpt_mb_fields(){
	global $post;
	global $fix1693416443cpt;
	$post_id = $post->ID;
	$values = get_post_custom( $post->ID );

	$fix1693416443_model = isset( $values['fix1693416443_model'] ) ? esc_attr( $values['fix1693416443_model'][0] ) : '';
	$fix1693416443_fuel = isset( $values['fix1693416443_fuel'] ) ? esc_attr( $values['fix1693416443_fuel'][0] ) : '';
	$fix1693416443_price = isset( $values['fix1693416443_price'] ) ? esc_attr( $values['fix1693416443_price'][0] ) : '';
	$fix1693416443_color = isset( $values['fix1693416443_color'] ) ? esc_attr( $values['fix1693416443_color'][0] ) : '';

	$fix1693416443_key = isset( $values['fix1693416443_key'] ) ? esc_attr( $values['fix1693416443_key'][0] ) : '';

	wp_nonce_field( 'fix1665674048value', 'fix1665674070key' );
	?>
	<script type="text/javascript">
		jQuery(function($){
			var fixtitle = $('#title').val();
			if(!fixtitle) {
				fixtitle = '<?php echo strtolower( wp_generate_password( 16, false, false ) );?>';
				$('#title').val(fixtitle);
				$('#fix1693416443_key_reg').val(fixtitle);
				$('#fix1693416443_key').val(fixtitle);
			}
			// $( "#title" ).prop( "disabled", true );
		});
	</script>

	<style type="text/css" media="screen">
		#fix-table {
			width: 100%;
		}
		#fix-table th {
			text-align: right;
			width: 200px;
		}	
	</style>
	<table id="fix-table">
        <tr>
            <th><?php echo __('Model') ?>:</th>
            <td>
                <input style="min-width:100%" type="text" name="fix1693416443_model" id="fix1693416443_model" value="<?php echo $fix1693416443_model ?>" automplete="off" >
            </td>
        </tr>
        <tr>
            <th><?php echo __('Fuel') ?>:</th>
            <td>
                <input style="min-width:100%" type="text" name="fix1693416443_fuel" id="fix1693416443_fuel" value="<?php echo $fix1693416443_fuel ?>" automplete="off" >
            </td>
        </tr>
        <tr>
            <th><?php echo __('Color') ?>:</th>
            <td>
                <input style="min-width:100%" type="text" name="fix1693416443_color" id="fix1693416443_color" value="<?php echo $fix1693416443_color ?>" automplete="off" >
            </td>
        </tr>
        <tr>
            <th><?php echo __('Price') ?>:</th>
            <td>
                <input style="min-width:100%" type="text" name="fix1693416443_price" id="fix1693416443_price" value="<?php echo $fix1693416443_price ?>" automplete="off" >
            </td>
        </tr>
        <tr>
            <th><?php echo __( 'Key' ) ?>:</th>
            <td>
                <?php echo $fix1693416443_key ?>
            </td>
        </tr>

        


	</table>
	<?php
}

add_action( 'save_post', 'fix1693416443cpt_save_post' );
function fix1693416443cpt_save_post( $post_id ){
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if( !isset( $_POST['fix1665674070key'] ) || !wp_verify_nonce( $_POST['fix1665674070key'], 'fix1665674048value' ) ) return;
	// if( !current_user_can( 'edit_post' ) ) return;
	$allowed = array(
		'a' => array(
			'href' => array()
		)
	);


	if( isset( $_POST['fix1693416443_model'] ) )
	update_post_meta( $post_id, 'fix1693416443_model', wp_kses( $_POST['fix1693416443_model'], $allowed ) );

	if( isset( $_POST['fix1693416443_fuel'] ) )
	update_post_meta( $post_id, 'fix1693416443_fuel', wp_kses( $_POST['fix1693416443_fuel'], $allowed ) );

	if( isset( $_POST['fix1693416443_color'] ) )
	update_post_meta( $post_id, 'fix1693416443_color', wp_kses( $_POST['fix1693416443_color'], $allowed ) );

	if( isset( $_POST['fix1693416443_price'] ) )
	update_post_meta( $post_id, 'fix1693416443_price', wp_kses( $_POST['fix1693416443_price'], $allowed ) );

	if( isset( $_POST['fix1693416443_key'] ) )
	update_post_meta( $post_id, 'fix1693416443_key', wp_kses( $_POST['fix1693416443_key'], $allowed ) );



}
