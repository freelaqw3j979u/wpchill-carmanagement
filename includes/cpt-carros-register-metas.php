<?php

#cpt-carros-register-metas.php

register_post_meta(
	'carro',
	'testimonial',
	array(
		'show_in_rest'       => true,
		'single'             => true,
		'type'               => 'string',
		'sanitize_callback'  => 'wp_kses_post',
	)
);