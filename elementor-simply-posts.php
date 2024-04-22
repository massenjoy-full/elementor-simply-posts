<?php
/**
 * Plugin Name: Elementor Simply Posts
 * Plugin URI: https://github.com/massenjoy-full/elementor-simply-posts
 * Description: Elementor Simply Posts - offers seamless post display in Elementor. Choose between list and block layouts for effortless content presentation.
 * Author: Maxim Bryk
 * Author URI: https://github.com/massenjoy-full/
 * Version: 1.0.0
 * Requires at least: 5.6
 * Text Domain: elementor-simply-posts
 * Domain Path: /languages
 * Tested up to: 6.5.2
 * Elementor tested up to: 3.20.4
 * Elementor Pro tested up to: 3.20.0
 * License: GPL2
 *
 * @package Elementor_Simply_Posts
 */

defined( 'ABSPATH' ) || exit;

define( 'SIMPLYPOSTS_PATH', plugin_basename( __FILE__ ) );

/**
 * Localization
 *
 * @return void
 */
function simplyposts_textdomain() {
	load_plugin_textdomain( 'elementor-simply-posts', false, dirname( SIMPLYPOSTS_PATH ) . '/languages' );
}
add_action( 'plugins_loaded', 'simplyposts_textdomain' );

/**
 * Register new Elementor widgets.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_new_widgets( $widgets_manager ) {

	require_once __DIR__ . '/widgets/class-simplypostswidget.php';

	$widgets_manager->register( new \SimplyPostsWidget() );
}
add_action( 'elementor/widgets/register', 'register_new_widgets', 10, 1 );
