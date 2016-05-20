<?php

namespace MLA\Commons;

use \BP_Component;
use \RecursiveDirectoryIterator;
use \RecursiveIteratorIterator;

class Profile extends BP_Component {
	protected static $instance;

	public $plugin_dir;
	public $plugin_templates_dir;
	public $template_files;

	public function __construct() {
		$this->plugin_dir = plugin_dir_path( __DIR__ . '/../..' );
		$this->plugin_templates_dir = trailingslashit( $this->plugin_dir . 'templates' );
		$this->template_files = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $this->plugin_templates_dir ), RecursiveIteratorIterator::SELF_FIRST );

		add_filter( 'load_template', [ $this, 'filter_load_template' ] );
	}

	public static function get_instance() {
		return self::$instance = ( null === self::$instance ) ? new self : self::$instance;
	}

	public function filter_load_template( $path ) {
		$their_slug = str_replace( trailingslashit( STYLESHEETPATH ), '', $path );

		foreach( $this->template_files as $name => $object ){
			$our_slug = str_replace( $this->plugin_templates_dir, '', $name );

			if ( $our_slug === $their_slug ) {
				return $name;
			}
		}

		return $path;
	}
}