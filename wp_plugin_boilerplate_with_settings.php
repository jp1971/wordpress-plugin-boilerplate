<?php
/*
Plugin Name: 
Plugin URI: 
Description: 
Version: 
Author: 
Author URI: 
License: GPL2
*/

/*  Copyright 20xx [name/orgainzation] ([email address])

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

class CamelCaseClassName {

	private static $instance = false;

	public static function get_instance() {
	  if ( ! self::$instance ) {
	    self::$instance = new self();
	  }
	  return self::$instance;
	}

	private function __construct() {
		//Define plugin specific variables

		// add_options_page variables
		$this->options_page_title = '';
		$this->options_page_menu_title = '';
		$this->options_page_menu_slug ='';

		// add_settings_section variables
		$this->section_id = '';
		$this->section_title = '';
		$this->section_callback = '';
		$this->section_page = '';

		// register_setting/register_settings_fields variables
		$this->option_group = '';

		// Add action hooks
		add_action( 'admin_menu', array( $this, 'add_plugin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_plugin_settings' ) );
	}

	public function add_plugin_menu() {
		// Add options page
		// http://codex.wordpress.org/Function_Reference/add_options_page
		add_options_page( 
			$this->options_page_title,
			$this->options_page_menu_title,
			'manage_options',
			$this->options_page_menu_slug,
			array( $this, 'render_options_page' )
		);
	}

	public function register_plugin_settings() {
		// Add settings section(s)
		// http://codex.wordpress.org/Function_Reference/add_settings_section
		add_settings_section(
			$this->section_id,
			$this->section_title,
			$this->section_callback,
			$this->options_page_menu_slug
		);

		// Add settings field(s)
		// e.g. add_settings_field( $id, $title, $callback, $page, $section, $args );
		// http://codex.wordpress.org/Function_Reference/add_settings_field

		// Register plugin settings
		// register_setting( $option_group, $option_name, $sanitize_callback );
		// http://codex.wordpress.org/Function_Reference/register_setting		
	}

	public function example_section_callback() {
		echo 'Explain the settings here.';
	}

	public function render_options_page() {
	?>
		<div class="wrap">
			<h2><?php echo $this->options_page_menu_title; ?></h2>
			<form action="options.php" method="POST">
				<?php settings_fields( $this->option_group ); ?>
				<?php do_settings_sections( $this->options_page_menu_slug ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
	<?php
	}
}
$underscore_class_name = CamelCaseClassName::get_instance();