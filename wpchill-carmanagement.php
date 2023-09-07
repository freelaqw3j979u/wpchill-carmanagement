<?php
/**
 * Plugin Name:     WP Chill - Car Management
 * Plugin URI:      https://github.com/seu-nome/seuplugin
 * Description:     Cadastro de veículo
 * Author:          Seu Nome
 * Author URI:      https://github.com/seu-nome
 * Text Domain:     wpchill-carmanagement
 * Domain Path:     /languages
 * Version:         0.2.1
 *
 * @package         Wpchill_Carmanagement
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Carbon_Fields\Block;
use Carbon_Fields\Field;
 
defined( 'ABSPATH' ) || exit;
 
function filmes_load() {
	require_once( 'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}
add_action( 'after_setup_theme', 'filmes_load' );
 
function filmes_attach_theme_options() {
	Block::make( 'Carro' )
		->add_fields( array(
			
			Field::make( 'text', 'fix1693416443_modelo', 'Modelo' ),
			Field::make( 'text', 'fix1693416443_marca', 'Marca' ),
			Field::make( 'text', 'fix1693416443_fuel', 'Combustível' ),
			Field::make( 'text', 'fix1693416443_preco', 'Preço' ),
			Field::make( 'text', 'fix1693416443_cor', 'Côr' ),
			Field::make( 'image', 'fix1693416443_foto', 'Foto' ),
		) )
		->set_render_callback( function ( $block ) {
 
			ob_start();
			?>
 
			<div class="block">
				<div class="block__heading">
					Modelo:
					<h1><?php echo esc_html( $block['fix1693416443_modelo'] ); ?></h1>
				</div><!-- /.block__heading -->

				<div class="block__heading">
					<h2><?php echo esc_html( $block['fix1693416443_marca'] ); ?></h2>
				</div><!-- /.block__heading -->
 				<div class="block__heading">
					<?php echo esc_html( $block['fix1693416443_fuel'] ); ?>
				</div><!-- /.block__heading -->
 				<div class="block__heading">
					<?php echo esc_html( $block['fix1693416443_preco'] ); ?>
				</div><!-- /.block__heading -->
 				<div class="block__heading">
					<?php echo esc_html( $block['fix1693416443_cor'] ); ?>
				</div><!-- /.block__heading -->


				<div class="block__image">
					<?php echo wp_get_attachment_image( $block['fix1693416443_foto'], 'full' ); ?>
				</div><!-- /.block__image -->
 
			</div><!-- /.block -->
 
			<?php
 
			return ob_get_flush();
		} );
}
add_action( 'carbon_fields_register_fields', 'filmes_attach_theme_options' );



include "includes/cpt-carro-001.php";

include "includes/cpt-carro-002-tax-fabricante.php";
include "includes/cpt-carro-003-register-metas.php";
include "includes/cpt-carro-004-meta-boxes.php";
include "includes/cpt-carro-005-admin-cols.php";
include "includes/cpt-carro-006-admin-filters.php";

include "includes/cpt-carro-021-shortcode-archive.php";
include "includes/cpt-carro-022-shortcode-single.php";
include "includes/cpt-carro-023-shortcode-busca.php";
include "includes/cpt-carro-024-shortcode-tax-fabricante.php";
include "includes/cpt-carro-025-shortcode-list.php";
include "includes/cpt-carro-026-shortcode-view.php";
include "includes/cpt-carro-027-shortcode-show-thumbs.php";

include "includes/cpt-carro-031-content-modo-2.php";
// include "includes/cpt-carro-032-content.php";
// include "includes/cpt-carro-033-template.php";


include "includes/cpt-carro-041-export-to-json.php";
include "includes/cpt-carro-042-import-from-json.php";
