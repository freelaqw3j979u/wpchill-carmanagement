<?php

add_filter( 'the_content', 'fix1693416443_the_content', -1 );
function fix1693416443_the_content( $content ) {
    global $plugin_file;
    $post_type = get_post_type();
    global $post;
    $post_id = $post->ID;
    // if ( ( is_single() || is_page() ) && in_the_loop() && is_main_query() && ($post_type=='romsllji') ) {
    

    $path_img = plugin_dir_path( $plugin_file )."add-inc/cartao/images/bg.jpg";
    if ( ( is_single() || is_page() ) && is_main_query() && ($post_type=='carro') ) {
        ob_start();
        ?>

        <script type="text/javascript">
            jQuery(function($){
                $('#pagetitle').html('');
            });
        </script>
        <?php

        ?>
            <div id="fix1667385801">
                <h2><a href="<?php echo site_url()."/carro" ?>">Carro</a></h2>
                <div id="fix1667388807">
                    <div>
                        <?php
                        // echo $content;
                        echo do_shortcode('[fix1693416443cpt_single]');
                    ?>
                    </div>
                    <div>
                        <?php echo do_shortcode('[fix1693416443cpt_busca]') ?>
                        <?php echo do_shortcode('[fix1693416443cpt_tax_categoria]') ?>
                    </div>
                </div>
            </div>
        <?php
        return ob_get_clean();
    }







	if ( ( is_archive() || is_page() ) && is_main_query() && ($post_type=='carro') ) {
        ob_start();
        ?>
        <style type="text/css">
            /*body {
                min-height: 100vh;
                background-image: url("<?php echo plugins_url( 'images/bg.jpg', __FILE__ ) ?>") ;
                background-repeat: no-repeat;
                background-position: center bottom;
                background-size: cover;
                background-color: rgba(117, 190, 218, 0.5); /* 50% transparent */
            }*/

            #pagetitle {
                display: none;
            }
            #fix1667385801 {
                max-width: 1200px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 50px;
                background-color: rgba(255, 255, 255, 0.8) !important;
                padding: 5px;
                border-radius: 5px;
            }
            #fix1667388807 {
                display: grid;
                grid-template-columns: 2fr 1fr;
            }
            #fix1667390129 {
                border: 0px solid gray;
                margin: 5px;
                border-radius: 5px;
                padding: 10px;
            }
            #fix1669161745 {
                border: 0px solid gray;
                margin: 5px;
                border-radius: 5px;
                padding: 10px;

            }
            @media only screen and (max-width: 400px) {
                #fix1667388807 {
                    display: block;
                }
            }
        </style>
        <?php
        ?>
            <div id="fix1667385801">
                <h2><a href="<?php echo site_url()."/carro" ?>">Carro</a></h2>
                <div id="fix1667388807">
                    <div id="fix1667390129">
                        <?php echo do_shortcode('[fix1693416443cpt_archive]'); ?>
                    </div>
                    <div id="fix1669161745">
                        <?php echo do_shortcode('[fix1693416443cpt_busca]') ?>
                        <?php echo do_shortcode('[fix1693416443cpt_tax_categoria]') ?>
                    </div>
                </div>
            </div>
        <?php

        return ob_get_clean();
	}

    return $content;
}





// add_filter( "get_the_archive_title_prefix", "fix1693416443_archive_title_prefix", 10, 1 );
function fix1693416443_archive_title_prefix($prefix) { 
    $post_type = get_post_type();
    if($post_type=='romsllji') {
    	return ''; 	
    }
    return $prefix; 
}

// add_filter( 'the_title', 'fix1693416443_the_title' );
function fix1693416443_the_title( $title ) {

    if ( (is_archive() || is_page() ) && in_the_loop() && is_main_query() && (get_post_type()=='romsllji') ) {
        $title = '';
    }
    if ( ( is_single() || is_page() ) && in_the_loop() && is_main_query() && (get_post_type()=='romsllji') ) {
        $title = '<span><a href="'.site_url().'/carro/">::</a><span> <span>Carro</span> ';
        // $title = '';
    }

    return $title;
}

