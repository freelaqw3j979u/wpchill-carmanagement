<?php

add_filter( 'manage_carro_posts_columns', 'fix1677965212cpt_cols_title' );
function fix1677965212cpt_cols_title( $columns ) {
    $columns = array(
     'cb' => $columns['cb'],
     'title' => __( 'Key', 'wpchill-carmanagement' ),
     'fix1693416443_modelo' => __('Model'),
     'fix1693416443_fuel' => __('Fuel'),
     'fix1693416443_cor' => __('Color'),
     'fix1693416443_preco' => __('Price'),
     'tax_fabricante' => __('Manufacturer','wpchill-carmanagement'),
    );

    $post_new_columns = array(
        'post_thumbs' => esc_html__( 'Thumbs', 'wpchill-carmanagement' ),
    );
    return array_merge( $post_new_columns, $columns  );


    // return $columns;
}

// function remove_img_attr ($html)
// {
//     return preg_replace('/(width|height)="\d+"\s/', "", $html);
// }

add_action( 'manage_carro_posts_custom_column', 'fix1677965212cpt_cols_fields', 10, 2);
function fix1677965212cpt_cols_fields( $column, $post_id ) {
    
    if ( 'post_thumbs' === $column ) {
        echo '<a href="' . get_edit_post_link() . '">';
        echo '<div style="widht:100px;height:100px;overflow: hidden;">';
        echo the_post_thumbnail();
        echo "</div>";
        echo '</a>';
    }

    if ( 'fix1693416443_modelo' === $column ) {
        $fix1693416443_modelo = get_post_meta( $post_id, 'fix1693416443_modelo', true );
        echo $fix1693416443_modelo;
    }

    if ( 'fix1693416443_fuel' === $column ) {
        $fix1693416443_fuel = get_post_meta( $post_id, 'fix1693416443_fuel', true );
        echo $fix1693416443_fuel;
    }

    if ( 'fix1693416443_cor' === $column ) {
        $fix1693416443_cor = get_post_meta( $post_id, 'fix1693416443_cor', true );
        echo $fix1693416443_cor;
    }
    if ( 'fix1693416443_preco' === $column ) {
        $fix1693416443_preco = get_post_meta( $post_id, 'fix1693416443_preco', true );
        echo $fix1693416443_preco;
    }
    if ( 'tax_fabricante' === $column ) {
        echo $cat = strip_tags(get_the_term_list($post_id, 'fabricante', '', ', ','')); 
    }
}