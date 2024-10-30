<?php

/**
 * BLOCK: Profile
 *
 * Gutenberg Custom Profile Block assets.
 *
 * @since   1.0.0
 * @package OPB
 */
defined('ABSPATH') || exit;
/**
 * Enqueue the block's assets for the editor.
 *
 * `wp-blocks`: Includes block type registration and related functions.
 * `wp-element`: Includes the WordPress Element abstraction for describing the structure of your blocks.
 * `wp-i18n`: To internationalize the block's text.
 *
 * @since 1.0.0
 */
function bukazu_portal_block()
{
    if (!function_exists('register_block_type')) {
        // Gutenberg is not active.
        return;
    }
    // Scripts.
    wp_register_script(
        'bukazu-portal-block-script', // Handle.
        plugins_url('block.js', __FILE__), // Block.js: We register the block here.
        array('wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor'), // Dependencies, defined above.
        filemtime(plugin_dir_path(__FILE__) . 'block.js'),
        true // Load script in footer.
    );
    // Styles.
    wp_register_style(
        'bukazu-portal-block-editor-style', // Handle.
        plugins_url('editor.css', __FILE__), // Block editor CSS.
        array('wp-edit-blocks'), // Dependency to include the CSS after it.
        filemtime(plugin_dir_path(__FILE__) . 'editor.css')
    );
    // wp_register_style(
    //     'bukazu-portal-block-frontend-style', // Handle.
    //     plugins_url('style.css', __FILE__), // Block editor CSS.
    //     array(), // Dependency to include the CSS after it.
    //     filemtime(plugin_dir_path(__FILE__) . 'style.css')
    // );    
    // Here we actually register the block with WP, again using our namespacing.
    // We also specify the editor script to be used in the Gutenberg interface.
    register_block_type('profile/block', array(
        'editor_script' => 'bukazu-portal-block-script',
        'editor_style'  => 'bukazu-portal-block-editor-style',
        // 'style'         => 'bukazu-portal-block-frontend-style',
    ));
} // End function organic_profile_block().
// Hook: Editor assets.
add_action('init', 'bukazu_portal_block');
