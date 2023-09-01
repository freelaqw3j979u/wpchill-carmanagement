<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


add_action( 'parse_request', 'fix1693448657_parse_request');
function fix1693448657_parse_request( &$wp ) {
	if($wp->request == 'import-cpt-carro-from-json'){
		if(!current_user_can('administrator')) die('--somente admins--');
		fix1693448657();
		exit;
	}
}

function fix1693448657($op=''){

	if(!$op){
		$op= isset($_GET['op']) ? sanitize_text_field($_GET['op']): '';
	}
	if(!$op) return;

	// die($op);

	/**
	 * 
	 * 
	 */
	$json = file_get_contents(__DIR__."/sample/carro-sample.json");
	$rows = json_decode($json, true);
	
	// echo "<pre>";
	// print_r($rows);
	// echo "</pre>";
	// die();

	foreach ($rows as $key => $row) {

		// echo "<pre>";
		// print_r($row);
		// echo "</pre>";
		// die();

		############################
		### VERIFICA SE EXISTE
		############################
		$args = array(
			'post_type'  => 'carro',
			'meta_query' => array(
				array(
					'key'   => 'fix1693416443_key',
					'value' => $row['fix1693416443_key'],
				)
			)
		);
		// echo "<pre>";
		// print_r($args);
		// echo "</pre>";
		// die();

		$postslist = get_posts( $args );

			// print_r($postslist);
			// die('---=---');


		$post_id = 0;
		// die();

		if($op=='delete'){
			
			if($postslist){
				$post_id = $postslist[0]->ID;	
				wp_delete_post( $post_id, true );
			}	
			// return;
		}




		############################
		### SE EXISTE... atualiza!
		############################
		if(($postslist) && ($op=='update')){
			$post_id = $postslist[0]->ID;
			$data = array(
				'ID' => $post_id,
				'post_content' 	=> $row['post_content'],
				'post_status' 	=> 'publish',
				'meta_input' 	=> array(
					'fix1693416443_modelo' => $row['fix1693416443_modelo'], 
					'fix1693416443_fuel' => $row['fix1693416443_fuel'], 
					'fix1693416443_preco' => $row['fix1693416443_preco'], 
					'fix1693416443_cor' => $row['fix1693416443_cor'], 
					'fix1693416443_key' => $row['fix1693416443_key'], 
					'fix1693416443_data_sample' => '1', 
				)
			);
			wp_update_post( $data );
			$term_result = wp_set_object_terms( $post_id, $row['fabricante'], 'fabricante');
		}





		############################
		### SE NÃO EXISTE... cadastra!
		############################
		if((!$post_id) && ($op=='insert')){
			$post_args = array(
				'post_title'    => $row['post_title'],
				'post_type'    	=> 'carro',
				'post_status'   => 'publish',
				'post_content'  => $row['post_content'],
				'meta_input'   	=> array(
					'fix1693416443_modelo' => $row['fix1693416443_modelo'], 
					'fix1693416443_fuel' => $row['fix1693416443_fuel'], 
					'fix1693416443_preco' => $row['fix1693416443_preco'], 
					'fix1693416443_cor' => $row['fix1693416443_cor'], 
					'fix1693416443_key' => $row['fix1693416443_key'], 
					'fix1693416443_data_sample' => '1', 
				),
			);
			$post_id = wp_insert_post( $post_args );
			$term_result = wp_set_object_terms( $post_id, $row['fabricante'], 'fabricante');
		}



		############################################
		### IMAGEM DESTACADA - cadastra ou atualiza
		############################################
		if(($op=='insert') || ($op=='update')){

			$img_origem = __DIR__."/sample/".$row['fix1693416443_key'].".jpg";
			$filename = basename($img_origem);
			$wp_filetype = wp_check_filetype($filename, null );
		    $attachment = array(
		        'post_mime_type' => $wp_filetype['type'],
		        'post_title' => sanitize_file_name($filename),
		        'post_content' => '',
		        'post_status' => 'inherit'
		    );
			$upload_dir = wp_upload_dir();
			if(wp_mkdir_p($upload_dir['path'])){
				$file = $upload_dir['path'] . '/' . $filename;
			} else {
				$file = $upload_dir['basedir'] . '/' . $filename;
			}

			if(is_file($img_origem) ){
				$image_data = file_get_contents($img_origem);
				$file_size = file_put_contents($file, $image_data);
				if($file_size){
					$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
					update_post_meta( $post_id, '_thumbnail_id', $attach_id );
				}
			}
		}



	}
}
