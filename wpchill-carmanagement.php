<?php
/**
 * Plugin Name:     WP Chill - Car Management
 * Plugin URI:      https://github.com/naldovieira/
 * Description:     
 * Author:          naldovieira
 * Author URI:      https://github.com/
 * Text Domain:     wpchill-carmanagement
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Wpchill_Carmanagement
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

include "includes/cpt-carro.php";

include "includes/cpt-carro-tax-fabricante.php";
include "includes/cpt-carros-register-metas.php";
include "includes/cpt-carro-meta-boxes.php";
include "includes/cpt-carro-admin-cols.php";
include "includes/cpt-carro-admin-filters.php";

include "includes/cpt-carro-shortcode-archive.php";
include "includes/cpt-carro-shortcode-single.php";
include "includes/cpt-carro-shortcode-busca.php";
include "includes/cpt-carro-shortcode-tax-fabricante.php";
include "includes/cpt-carro-shortcode-list.php";
include "includes/cpt-carro-shortcode-view.php";


include "includes/cpt-carro-content-modo-2.php";
// include "includes/cpt-carro-content.php";
// include "includes/cpt-carro-template.php";

include "includes/cpt-carro-export-to-json.php";
include "includes/cpt-carro-import-from-json.php";




register_activation_hook( __FILE__, 'fix1693452517' );
function fix1693452517() {
	# NA ATIVAÇÃO DO PLUGIN, INSERE OS DADOS DE EXEMPLOS
	fix1693448657();
}







