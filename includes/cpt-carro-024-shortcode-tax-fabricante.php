<?php 

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1693416443cpt_tax_categoria", "fix1693416443cpt_tax_categoria");
function fix1693416443cpt_tax_categoria($param, $content = null){
    // global $fix1693416443cpt;
    // global $fix1693416443cpt_tax;


	// $vai = 0;
	// if(current_user_can('administrator')) $vai = 1;
	// if(current_user_can('fix-administrativo')) $vai = 1;
	// if(!$vai) {
	// 	// ob_start();
	// 	// echo "<div>Permissão de acesso insuficiente</div>";
	// 	// return ob_get_clean();
	// 	return;
	// }

    $plural = 'Fabricantes';


    $post_type = get_post_type();
    if($post_type<>'carro') return;

    

	$terms = get_terms( array(
	    'taxonomy' => 'fabricante',
	    'hide_empty' => true,
	) );

    ?>
    <style type="text/css">
    	.fix1667298393 {
    		border: 0px solid gray;
    		padding: 10px;
            margin: 0px;
            border-radius: 0px;
    	}
    </style>
    <div class="fix1667298393">
        <?php
        foreach ($terms as $key => $term) {
        	?>
            <div>
                <a href="<?php echo site_url() ?>/<?php echo $term->taxonomy ?>/<?php echo $term->slug ?>/"><?php echo $term->name ?> - <?php echo $term->count ?></a>    
            </div>
        	
        	<?php 
        }
        ?>
        <div style="height:10px"></div>
    </div>
    <?php
}