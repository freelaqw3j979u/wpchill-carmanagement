<?php

add_filter( 'parse_query', 'fix1693416443_filter_in_admin' );
function fix1693416443_filter_in_admin( $query ){
    global $pagenow;
    // global $fix166941cpt;
    
    $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
    if($post_type<>'carro') return;

    // die($post_type);
    if ( is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_NAME']) && $_GET['ADMIN_FILTER_FIELD_NAME'] != '') {
        $query->query_vars['meta_key'] = $_GET['ADMIN_FILTER_FIELD_NAME'];
        $query->query_vars['meta_compare'] = 'LIKE';

        if (isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != ''){
            $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
        }
    }
}

add_action( 'restrict_manage_posts', 'fix1693416443_restrict_manage_posts' );
function fix1693416443_restrict_manage_posts(){
    global $wpdb;
    // global $fix166941cpt;
    // $post_type = get_post_type();
    
    $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
    if($post_type<>'carro') return;

    $sql = "SELECT DISTINCT meta_key FROM ".$wpdb->postmeta." WHERE meta_key LIKE 'fix1693416443%' ";
    $fields = $wpdb->get_results($sql, ARRAY_N);

    // echo $post_type;
        ?>
        <select name="ADMIN_FILTER_FIELD_NAME">
            <option value=""><?php _e('-- Filtrar campos --', 'baapf'); ?></option>
            <?php
            $current = isset($_GET['ADMIN_FILTER_FIELD_NAME'])? $_GET['ADMIN_FILTER_FIELD_NAME']:'';
            $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
            foreach ($fields as $field) {
                if (substr($field[0],0,1) != "_"){
                    printf(
                        '<option value="%s"%s>%s</option>',
                        $field[0],
                        $field[0] == $current? ' selected="selected"':'',
                        strtoupper( substr($field[0], 14) )
                    );
                }
            }
        ?>
        </select>
        <?php 
            _e('Value:', 'wpchill-carmanagement'); 
        ?>
            <input type="TEXT" name="ADMIN_FILTER_FIELD_VALUE" value="<?php echo $current_v; ?>" />
        <?php
}
