<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode("wpchill_carmanagement_list", "wpchill_carmanagement_list");
function wpchill_carmanagement_list($atts, $content = null){

  extract(shortcode_atts(array(
    "show_filter" => '',
    "fabricante" => '',

  ), $atts));




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
	

	# busca geral (não inclusa)
	$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
	$sql_busca = '';
	if($busca){
		$sql_busca .= ' and (';
		$sql_busca .= ' m01.meta_value LIKE "%'.$busca.'%"';
		$sql_busca .= ' or m02.meta_value LIKE "%'.$busca.'%"';
		$sql_busca .= ' or m03.meta_value LIKE "%'.$busca.'%"';
		$sql_busca .= ' or m04.meta_value LIKE "%'.$busca.'%"';
		$sql_busca .= ' or m05.meta_value LIKE "%'.$busca.'%"';
		$sql_busca .= ' or t08.name LIKE "%'.$busca.'%"';
		$sql_busca .= ') ';
	}



	if($fabricante){
		$sql_busca .= ' and (';
		$sql_busca .= ' t08.name LIKE "%'.$fabricante.'%"';
		$sql_busca .= ') ';
	}

	if ($show_filter):

		$fix1693416443_model = isset($_GET['fix1693416443_model']) ? sanitize_text_field($_GET['fix1693416443_model']) : ''; 
		if($fix1693416443_model){
			$sql_busca .= ' and (';
			$sql_busca .= ' m02.meta_value LIKE "%'.$fix1693416443_model.'%"';
			$sql_busca .= ') ';
		}

		$fix1693416443_fuel = isset($_GET['fix1693416443_fuel']) ? sanitize_text_field($_GET['fix1693416443_fuel']) : ''; 
		if($fix1693416443_fuel){
			$sql_busca .= ' and (';
			$sql_busca .= ' m03.meta_value LIKE "%'.$fix1693416443_fuel.'%"';
			$sql_busca .= ') ';
		}


		$fix1693416443_color = isset($_GET['fix1693416443_color']) ? sanitize_text_field($_GET['fix1693416443_color']) : ''; 
		if($fix1693416443_color){
			$sql_busca .= ' and (';
			$sql_busca .= ' m05.meta_value LIKE "%'.$fix1693416443_color.'%"';
			$sql_busca .= ') ';
		}

		$fix1693416443_price_ini = isset($_GET['fix1693416443_price_ini']) ? sanitize_text_field($_GET['fix1693416443_price_ini']) : ''; 
		if($fix1693416443_price_ini){
			$sql_busca .= ' and (';
			$sql_busca .= ' m04.meta_value >= '.$fix1693416443_price_ini;
			$sql_busca .= ') ';
		}


		$fix1693416443_price_end = isset($_GET['fix1693416443_price_end']) ? sanitize_text_field($_GET['fix1693416443_price_end']) : ''; 
		if($fix1693416443_price_end){
			$sql_busca .= ' and (';
			$sql_busca .= ' m04.meta_value <= '.$fix1693416443_price_end;
			$sql_busca .= ') ';
		}
	endif;



	$sql = "
	SELECT 
	    p.ID,
	    p.post_name,
	    p.post_title,
	    p.post_date,
	    p.post_content,
	    p.guid,
	    m01.meta_value as fix1693416443_fabricante,
	    m02.meta_value as fix1693416443_model,
	    m03.meta_value as fix1693416443_fuel,
	    m04.meta_value as fix1693416443_price,
	    m05.meta_value as fix1693416443_color,
	    m06.meta_value as fix1693416443_key,

	    t08.name as fabricante
	    
	    
	FROM ".$GLOBALS['wpdb']->prefix."posts p
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m01 on m01.post_id = p.ID and m01.meta_key = 'fix1693416443_fabricante'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m02 on m02.post_id = p.ID and m02.meta_key = 'fix1693416443_model'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m03 on m03.post_id = p.ID and m03.meta_key = 'fix1693416443_fuel'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m04 on m04.post_id = p.ID and m04.meta_key = 'fix1693416443_price'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m05 on m05.post_id = p.ID and m05.meta_key = 'fix1693416443_color'
	    left join ".$GLOBALS['wpdb']->prefix."postmeta m06 on m06.post_id = p.ID and m06.meta_key = 'fix1693416443_key'

	    left join ".$GLOBALS['wpdb']->prefix."term_relationships t06 on t06.object_id = p.ID 
	    left join ".$GLOBALS['wpdb']->prefix."term_taxonomy t07 on t07.term_id = t06.term_taxonomy_id
	    left join ".$GLOBALS['wpdb']->prefix."terms t08 on t08.term_id = t07.term_id

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








	$fix1693416443_model = isset($_GET['fix1693416443_model']) ? sanitize_text_field($_GET['fix1693416443_model']) : '';
	?>
	

		<style type="text/css">
			#fix1693960760 {
				border: 1px solid gray;
				padding: 10px;
				background-color: #ededed;
			}
			#fix1693530902 {
				display: grid;
				grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
				grid-gap: 5px;

			}
			#fix1693530902 input {
				max-width: 150px;	
			}
			#fix1693958100 th {
				border: 1px solid silver;
				background-color: #ededed;
				

			}
			#fix1693958100 td {
				border: 1px solid gray;
			}

		</style>
	

	<?php if ($show_filter): ?>
		<div id="fix1693960760">
			<form id="fix1693530902" method="GET" action="">
				<input type="hidden" name="busca" id="busca" value="<?php echo $busca ?>" placeholder="busca" autocomplete="off" >
				<div>
					<div><label for="fix1693416443_model">Model</label></div>
					<div><input type="text" name="fix1693416443_model" id="fix1693416443_model" value="<?php echo $fix1693416443_model ?>" placeholder="modelo" autocomplete="off" ></div>
				</div>

				<div>
					<div><label for="fix1693416443_fuel">Fuel</label></div>
					<div><input type="text" name="fix1693416443_fuel" id="fix1693416443_fuel" value="<?php echo $fix1693416443_fuel ?>" placeholder="Fuel" autocomplete="off"></div>
				</div>

				<div>
					<div><label for="fix1693416443_color">Color</label></div>
					<div><input type="text" name="fix1693416443_color" id="fix1693416443_color" value="<?php echo $fix1693416443_color ?>" placeholder="Color" autocomplete="off"></div>
				</div>

				<div>
					<div><label for="fix1693416443_price_ini">Price ini</label></div>
					<div><input type="number" name="fix1693416443_price_ini" id="fix1693416443_price_ini" value="<?php echo $fix1693416443_price_ini ?>" placeholder="Price ini" autocomplete="off"></div>
				</div>

				<div>
					<div><label for="fix1693416443_price_end">Price end</label></div>
					<div><input type="number" name="fix1693416443_price_end" id="fix1693416443_price_end" value="<?php echo $fix1693416443_price_end ?>" placeholder="Price end" autocomplete="off"></div>
				</div>

				<div>
					<div><button type="submit" style="width:100%">FILTER</button></div>
					<div style="text-align: center;"><a href="?">clean</a></div>
				</div>
				
			</form>
		</div>
	<?php endif ?>

	<div style="height: 30px;"></div>
	<table id="fix1693958100">
		<tr>
			<th><?php echo __('Model') ?></th>
			<th><?php echo __('Manufacturer') ?></th>
			<th><?php echo __('Fuel') ?></th>
			<th><?php echo __('Color') ?></th>
			<th><?php echo __('Price') ?></th>
		</tr>
	<?php foreach ($rows as $key => $row): ?>
		<tr>
			<td><a href="<?php echo site_url() ?>/carro/?p=<?php echo $row['ID']?>"><?php echo $row['fix1693416443_model'] ?></a></td>
			<td><?php echo $row['fabricante'] ?></td>
			<td><?php echo $row['fix1693416443_fuel'] ?></td>
			<td><?php echo $row['fix1693416443_color'] ?></td>
			<td><?php echo $row['fix1693416443_price'] ?></td>
		</tr>	
	<?php endforeach ?>
	</table>












	<?php
	return ob_get_clean();
}
