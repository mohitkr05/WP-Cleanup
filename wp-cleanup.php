<?php
/**
 * ==========================================================================
 * WordPress Cleanup
 * File-Name - wp-cleanup.php 
 * Include this file in your theme for the cleaning up of the WordPress theme options
 * 
 * Git Location : 
 * Version      : Version 0.1 
 * 
 * List of Functions 	
 * 1. wpcleanup_head_cleanup  										- The clean up function to remove all the mess from WordPress head
 * 2. wpcleanup_rss_version   										- Remove RSS version
 * 3. wpcleanup_remove_wp_ver_css_js 								- Remove WP version from scripts
 * 4. wpcleanup_remove_wp_widget_recent_comments_style				- Remove injected CSS for recent comments widget
 * 5. wpcleanup_gallery_style 										- Clear Gallery Style
 * 6. wpcleanup_filter_ptags_on_images								- Remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
 * 7. wpcleanup_excerpt_more										- This removes the annoying […] to a Read More link
 *==========================================================================
 */


/**
 * ==========================================================================
 * @function  - wpcleanup_head_cleanupwpcleanup_excerpt_more
 * @package wpcleanup
 * @since 0.1
 * The clean up function to remove all the mess from WordPress head
 * ==========================================================================
 */wpcleanup_rss_version
function wpcleanup_head_cleanup() {
	// category feeds
	 remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	 remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );This removes the annoying […] to a Read More link
	// remove WP version from css
	add_filter( 'style_loader_src', 'wpcleanup_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'wpcleanup_remove_wp_ver_css_js', 9999 );

} // end wpcleanup_head_cleanup

/**
 * ==========================================================================
 * @function  - wpcleanup_rss_version
 * @package wpcleanup
 * @since 0.1
 * Remove RSS version
 * ===========================================================================
 */


function wpcleanup_rss_version() {
	return '';
	} // end remove rss version


/**
 * ==========================================================================
 * @function  - wpcleanup_remove_wp_ver_css_js
 * @package wpcleanup
 * @since 0.1
 * Remove WP version from scripts
 * ===========================================================================
 */

function wpcleanup_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
} //end wpcleanup_remove_wp_ver_css_js


/**
 * ==========================================================================
 * @function  - wpcleanup_remove_wp_widget_recent_comments_style
 * @package wpcleanup
 * @since 0.1
 * Remove injected CSS for recent comments widget
 * ===========================================================================
 */
function wpcleanup_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
} //end wpcleanup_remove_wp_widget_recent_comments_style
 

/**
 * ==========================================================================
 * @function  - wpcleanup_gallery_style
 * @package wpcleanup
 * @since 0.1
 * Remove injected CSS from gallery
 * ===========================================================================
 */
function wpcleanup_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
} //end wpcleanup_gallery_style


/**
 * ==========================================================================
 * @function  - wpcleanup_filter_ptags_on_images
 * @package wpcleanup
 * @since 0.1
 * Remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
 * ===========================================================================
 */
function wpcleanup_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
} //wpcleanup_filter_ptags_on_images



/**
 * ==========================================================================
 * @function  - wpcleanup_excerpt_more
 * @package wpcleanup
 * @since 0.1
 * This removes the annoying […] to a Read More link
 * ===========================================================================
 */
function wpcleanup_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read ', 'wpcleanuptheme' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'wpcleanuptheme' ) .'</a>';
} //end wpcleanup_excerpt_more

 
 
/**
 * ==========================================================================
 * @function  - wpcleanup_remove_recent_comments_style
 * @package wpcleanup
 * @since 0.1
 * Remove injected CSS from recent comments widget
 * ===========================================================================
 */
function wpcleanup_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
} //end wpcleanup_remove_recent_comments_style

/**
 * ==========================================================================
 * @function  - wpcleanup_gallery_style
 * @package wpcleanup
 * @since 0.1
 * Remove injected CSS from gallery
 * ===========================================================================
 */
function wpcleanup_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
} //end wpcleanup_gallery_style


/**
 * ==========================================================================
 * @function  - wpcleanup_filter_ptags_on_images
 * @package wpcleanup
 * @since 0.1
 * Remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
 * ===========================================================================
 */
function wpcleanup_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
} //wpcleanup_filter_ptags_on_images



/**
 * ==========================================================================
 * @function  - wpcleanup_excerpt_more
 * @package wpcleanup
 * @since 0.1
 * This removes the annoying […] to a Read More link
 * ===========================================================================
 */
function wpcleanup_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read ', 'wpcleanuptheme' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'wpcleanuptheme' ) .'</a>';
} //end wpcleanup_excerpt_more

?>
