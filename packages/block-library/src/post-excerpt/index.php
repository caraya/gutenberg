<?php
/**
 * Server-side rendering of the `core/post-excerpt` block.
 *
 * @package WordPress
 */

/**
 * Renders the `core/post-excerpt` block on the server.
 *
 * @param WP_Block $block Block instance.
 *
 * @return string Returns the filtered post excerpt for the current post wrapped inside "p" tags.
 */
function render_block_core_post_excerpt( $block ) {
	if ( ! isset( $block->context['postId'] ) ) {
		return '';
	}

	$attributes = $block->attributes;
	$more_text  = isset( $attributes['moreText'] ) ? '<a href="' . esc_url( get_the_permalink( $block->context['postId'] ) ) . '">' . $attributes['moreText'] . '</a>' : '';

	$filter_excerpt_length = function() use ( $attributes ) {
		return isset( $attributes['wordCount'] ) ? $attributes['wordCount'] : 55;
	};
	add_filter(
		'excerpt_length',
		$filter_excerpt_length
	);

	$output = '<p>' . get_the_excerpt( $block->context['postId'] );
	if ( ! isset( $attributes['showMoreOnNewLine'] ) || $attributes['showMoreOnNewLine'] ) {
		$output .= '</p>' . '<p>' . $more_text . '</p>';
	} else {
		$output .= ' ' . $more_text . '</p>';
	}

	remove_filter(
		'excerpt_length',
		$filter_excerpt_length
	);

	return $output;
}

/**
 * Registers the `core/post-excerpt` block on the server.
 */
function register_block_core_post_excerpt() {
	register_block_type_from_metadata(
		__DIR__ . '/post-excerpt',
		array(
			'render_callback' => 'render_block_core_post_excerpt',
		)
	);
}
add_action( 'init', 'register_block_core_post_excerpt' );
