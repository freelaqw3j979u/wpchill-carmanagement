<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("fix1693416443cpt_archive", "fix1693416443cpt_archive");
function fix1693416443cpt_archive($param, $content = null){

	$vai = 0;
	// // if(current_user_can('fix-associado')) $vai = 1;
	// if(current_user_can('administrator')) $vai = 1;
	// if(current_user_can('fix-administrativo')) $vai = 1;
	// if(!$vai) return ;

	// global $fix1693416443cpt;
	// global $fix1693416443cpt_tax;
	// global $fix1693416443cpt_tax2;
	global $query;

	ob_start();
	$sql_term = "";
	$sql_term_join = "";
	$current_term = get_queried_object();
	if(isset($current_term->term_id) ){
		echo "<div>Fabricante: ".$current_term->name."</div>";
		$sql_term = "and t2.term_id = ".$current_term->term_id;
		$sql_term_join = "
	    left join ".$GLOBALS['wpdb']->prefix."term_relationships t1 on t1.object_id = p.ID
	    left join ".$GLOBALS['wpdb']->prefix."terms t2 on t2.term_id = t1.term_taxonomy_id
		";
	}
	


	$busca = isset($_GET['busca']) ? sanitize_text_field($_GET['busca']) : '';
	$sql_busca = '';
	if($busca){
		$sql_busca .= ' and (';
		$sql_busca .= ' m01.meta_value LIKE "%'.$busca.'%"';
		$sql_busca .= ' or m02.meta_value LIKE "%'.$busca.'%"';
		$sql_busca .= ' or m03.meta_value LIKE "%'.$busca.'%"';
		$sql_busca .= ' or m04.meta_value LIKE "%'.$busca.'%"';
		$sql_busca .= ' or m05.meta_value LIKE "%'.$busca.'%"';

		$sql_busca .= ' or p.post_content LIKE "%'.$busca.'%"';
		$sql_busca .= ') ';
	}



	$sql = "
	SELECT 
	    p.ID,
	    p.post_name,
	    p.post_title,
	    p.post_date,
	    p.post_content,
	    p.guid,
	    m01.meta_value as fix1693416443_fabricante,
	    m02.meta_value as fix1693416443_modelo,
	    m03.meta_value as fix1693416443_fuel,
	    m04.meta_value as fix1693416443_preco,
	    m05.meta_value as fix1693416443_cor,
	    m06.meta_value as fix1693416443_key
	    
	    
	FROM ".$GLOBALS['wpdb']->prefix."posts p
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m01 on m01.post_id = p.ID and m01.meta_key = 'fix1693416443_fabricante'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m02 on m02.post_id = p.ID and m02.meta_key = 'fix1693416443_modelo'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m03 on m03.post_id = p.ID and m03.meta_key = 'fix1693416443_fuel'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m04 on m04.post_id = p.ID and m04.meta_key = 'fix1693416443_preco'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m05 on m05.post_id = p.ID and m05.meta_key = 'fix1693416443_cor'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m06 on m06.post_id = p.ID and m06.meta_key = 'fix1693416443_key'
	    ".$sql_term_join."
	where 
	    p.post_status = 'publish' 
	    and p.post_type = 'carro' 
	    ".$sql_busca."
	    ".$sql_term."
	";

	// echo "<pre>";
	// echo $sql;
	// echo "</pre>";	

	$rows = $GLOBALS['wpdb']->get_results($sql, 'ARRAY_A');

	// echo "<pre>";
	// echo count($rows);
	// echo "</pre>";

	// echo "<pre>";
	// print_r($rows);
	// echo "</pre>";

	$site_url = site_url();

	?>

	<style type="text/css">
		.fix1667408457 {
			display: grid;
			grid-template-columns: 15fr 10fr;
			grid-gap: 10px;


		}
		.fix1667408548 {
			border: 0px solid silver;
			padding: 0px 2px;
			/*color: #000000; */
			font-weight: 800;
			font-size: 14px;
		}
		.fix1667408548 a {
			/*color: #000000; */

		}
		#fix1667471935 {
			position: absolute;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.4);
			z-index: 10000;
		}
		#fix1667473719 {
			position: absolute;
			width: 95vw;
			top: 200px;
			left: 0px;
			margin: 10px;
			padding: 10px;
			min-height: 30px;
			background-color: #ffffff;
			z-index: 10001;
			border-radius: 10px;
		}
		.fix1667998512 {
			font-size: 12px;
			line-height: 16px;
			font-style: italic;
		}
		.fix_background_img {
			height: 400px;
			background-repeat: no-repeat;
			background-position: center center;
			background-size: cover;

		}
		.fix_label {
			font-size: 12px;
			font-style: italic;
			line-height: 5px;
		}
		.fix_field {
			font-size: 20px;
			margin-bottom: 20px;
			line-height: 20px;
			min-height: 20px;
		}
		.fix_descri {
			margin: 20px 0px;
			font-style: italic;
		}
		@media only screen and (max-width: 400px) {
			.fix1667408457 {
				display: block;
				margin-bottom: 50px;
			}
			.fix1667998512 {
				display: none;
			}
			.fix1667408548 {
				height: 50px;
			}
		}
	</style>




<?php $fix_color_situacao = ''; ?>

<?php 
/*
<a target="_self" href="<?php echo $site_url ?>/?p=<?php echo $row['ID'] ?>"><?php echo $row['ID'] ?></a>
*/
?>

<?php foreach ($rows as $key => $row): ?>
<div class="fix1667408457 <?php echo $fix_color_situacao ?>">
	<?php $url = wp_get_attachment_url( get_post_thumbnail_id($row['ID']), 'thumbnail' ); ?>
	<div class="fix1667408548 " >

		<a href="?p=<?php echo $row['ID'] ?>">
			<div class="fix_background_img" style="background-image: url(<?php echo $url ?>) ;"></div>
		</a>

	</div>
	<div class="fix1667408548" style="text-align: left;">
		<div class="fix_label">Modelo:</div>
		<div class="fix_field_"><h2><a href="?p=<?php echo $row['ID'] ?>"><?php echo $row['fix1693416443_modelo'] ?></a></h2></div>
		
		<div class="fix_descri"><?php echo $row['post_content'] ?></div>
		
		<div class="fix_label">Combustível:</div>
		<div class="fix_field"><?php echo $row['fix1693416443_fuel'] ?></div>

		<div class="fix_label">Cor:</div>
		<div class="fix_field"><?php echo $row['fix1693416443_cor'] ?></div>

		<div class="fix_label">Preço:</div>
		<div class="fix_field"><?php echo $row['fix1693416443_preco'] ?></div>
		<div class="fix_label">Fabricante:</div>
		<div>
			<?php
				$terms = wp_get_post_terms( $row['ID'], 'fabricante', array( 'fields' => 'names' ) ); 
				$ii=0;
				foreach ($terms as $key => $term) {
					if($ii){
						echo ", ";
					}
					echo $term;
					$ii++;
				}
			?>
		</div>
	</div>
</div>
<hr>
<?php endforeach ?>
	<?php
	return ob_get_clean();
}