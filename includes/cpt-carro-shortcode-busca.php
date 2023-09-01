<?php 

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1693416443cpt_busca", "fix1693416443cpt_busca");
function fix1693416443cpt_busca($param, $content = null){

	// $vai = 0;
	// // if(current_user_can('fix-associado')) $vai = 1;
	// if(current_user_can('administrator')) $vai = 1;
	// if(current_user_can('fix-administrativo')) $vai = 1;
	// if(!$vai) return ;

	$post_type = get_post_type();
	// if($post_type<>'romsllji') return;
	ob_start();
	$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
	?>
<style type="text/css">
	.fix1666736355 {
		border: 0px solid gray;
		border-radius: 0px;
		padding: 10px;
		margin: 0px;
	}
</style>
<div class="fix1666736355">
<form role="search" method="get" action="<?php echo site_url() ?>/carro/" class="wp-block-search__button-outside wp-block-search__text-button wp-block-search">

<div class="wp-block-search__inside-wrapper ">
<input type="search" id="fix1666726557" class="wp-block-search__input " name="busca" value="<?php echo $busca ?>" placeholder="" autocomplete="off">
<button type="submit" class="wp-block-search__button  ">Pesquisar</button>
</div>
</form>
</div>
	<?php

	return ob_get_clean();
}

