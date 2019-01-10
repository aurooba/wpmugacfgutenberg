<?php

/**
 * Register the block once ACF has initialized
 */
add_action('acf/init', 'aa_acf_block_init');
function aa_acf_block_init() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a testimonial block
		acf_register_block(array(
			'name'				=> 'testimonial',
			'title'				=> __('Testimonial'),
			'description'		=> __('A custom testimonial block.'),
			'render_callback'	=> 'aa_acf_testimonial_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'testimonial', 'quote', 'acf' ),
		));
	}
}

/**
 * Render Callback for the block. This is what is output in the Theme AND
 * in the preview within Gutenberg
 *
 * @param $block
 */
function aa_acf_testimonial_callback( $block ) {
    $block_id = $block['id'];
	$testimonial = get_field('testimonial');
    $avatar = get_field('image');
	$avatar_url = ! empty( $avatar['url'] ) ? $avatar['url'] : 'https://placehold.it/100x100';;
	$name = get_field('name');
    $style = get_field('style');
	?>
	<div id="<?php echo 'acf-testimonial-' . esc_attr( $block_id ); ?>" class="acf-testimonial <?php echo $style; ?>">
       <div class="testimonial-content-wrap">
            <div class="acf-testimonial-avatar-wrap">
                <img src="<?php echo esc_url( $avatar_url ); ?>"/>
            </div>
            <div class="acf-testimonial-text">
                <?php echo $testimonial; ?>
            </div>
		</div>
        <h3 class="acf-testimonial-avatar-name"><?php echo esc_html( $name ); ?></h3>
	</div>
	<?php
} 
