<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1693416443cpt_single", "fix1693416443cpt_single");
function fix1693416443cpt_single($param, $content = null){
	// global $fix1693416443cpt_tax;
	ob_start();

	$vai = 0;
	// // if(current_user_can('fix-associado')) $vai = 1;
	// if(current_user_can('administrator')) $vai = 1;
	// if(current_user_can('fix-administrativo')) $vai = 1;
	// if(!$vai) return ;

	global $post;
	$post_id = $post->ID;
	$values = get_post_custom( $post->ID );

	$fix1693416443_modelo = isset( $values['fix1693416443_modelo'] ) ? esc_attr( $values['fix1693416443_modelo'][0] ) : '';
	$fix1693416443_fuel = isset( $values['fix1693416443_fuel'] ) ? esc_attr( $values['fix1693416443_fuel'][0] ) : '';
	$fix1693416443_preco = isset( $values['fix1693416443_preco'] ) ? esc_attr( $values['fix1693416443_preco'][0] ) : '';
	$fix1693416443_cor = isset( $values['fix1693416443_cor'] ) ? esc_attr( $values['fix1693416443_cor'][0] ) : '';

	$fix1693416443_key = isset( $values['fix1693416443_key'] ) ? esc_attr( $values['fix1693416443_key'][0] ) : '';

	// wp_get_post_terms( int $post_id, string|string[] $taxonomy = 'post_tag', array $args = array() ): array|WP_Error
	$categorias = wp_get_post_terms( $post_id, 'fabricante', array( 'fields' => 'names' ) );
	?>
	<style type="text/css" media="screen">
		#fix1666704754 {
			width: 100%;
		}
		#fix1666704754 th {
			text-align: right;
			width: 200px;
		}	
		.fix1666925239 {
			border: 1px solid gray;
			padding: 10px;
			margin: 10px;
			border-radius: 10px;
		}
		@media only screen and (max-width: 400px) {
			#fix1666704754 {
				width: 80vw;
			}
			#fix1666704754 th {
				width: 90vw;
				display: block; 
				text-align: left;
				font-style: italic;
				font-size: 12px;
				margin: 0px;
				padding: 0px;
			}
			#fix1666704754 td {
				width: 900vw;
				display: block;
				margin: 0px;
				padding: 0px; 
			}
		}
		.fix_background_img {
			background-repeat: no-repeat;
			background-position: center center;
			background-size: cover;
			height: 400px;
		}
	</style>
	<div class="fix1666925239">


<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>

<div class="fix_background_img" style="background-image: url(<?php echo $url ?>) ;">
	
</div>

		<table id="fix1666704754">
			<tr>
				<th>ID:</th>
				<td>
					<?php echo $post_id ?>
				</td>
			</tr>
			<tr>
				<th>Tipo de combustível:</th>
				<td>
					<?php echo $fix1693416443_fuel ?>
				</td>
			</tr>
			<tr>
				<th>Modelo:</th>
				<td>
					<?php echo $fix1693416443_modelo ?>
				</td>
			</tr>
			<tr>
				<th>Preco:</th>
				<td>
					<?php echo $fix1693416443_preco ?>
				</td>
			</tr>
			<tr>
				<th>Cor:</th>
				<td>
					<?php echo $fix1693416443_cor ?>
				</td>
			</tr>
			<tr>
				<th>Fabricante:</th>
				<td>
					<?php
					$ii=0;
					foreach ($categorias as $key => $categoria) {
						if($ii){
							echo ", ";
						}
						echo $categoria;
						$ii++;
					}
					?>
				</td>	
			</tr>


		</table>
	</div>
	<?php
	return ob_get_clean();
}