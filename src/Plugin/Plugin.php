<?php
/**
 * Class for plugin intialization.
 *
 * @category Class
 * @package  Awsm\WP_Wrapper\Plugin
 * @author   Sven Wagener
 * @license  https://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://awesome.ug
 */

namespace Awsm\WP_Wrapper\Plugin;

use Awsm\WP_Wrapper\Building_Plans\Actions;
use Awsm\WP_Wrapper\Tasks\Task_Runner;

/**
 * Class Plugin.
 *
 * Main plugin controller class that hooks the plugin's functionality into the WordPress request lifecycle.
 *
 * @since   1.0.0
 * @package Awsm\WP_Wrapper\Plugin\
 * @author  Sven Wagener <support@awesome.ug>
 */
class Plugin implements Actions {

	use Task_Runner;

	/**
	 * Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string Plugin name.
	 */
	protected $name = null;

	/**
	 * Plugin version.
	 *
	 * @since 1.0.0
	 *
	 * @var string Plugin name.
	 */
	protected $version = null;

	/**
	 * Textdomain
	 *
	 * @since 1.0.0
	 *
	 * @var string $textdomain Textdomain
	 */
	protected $textdomain = '';


	/**
	 * Path to translation folder
	 *
	 * @since 1.0.0
	 *
	 * @var string $translation_path Path to translations
	 */
	protected $translation_path = '';

	/**
	 * Running the plugin object.
	 *
	 * @since 1.0.0
	 *
	 * @return Plugin Plugin object.
	 */
	public function __construct() {
		return $this;
	}

	/**
	 * Register the plugin with the WordPress system.
	 *
	 * @return Plugin Plugin object.
	 * @since 1.0.0
	 */
	public function boot() {
		$this->add_actions();

		return $this;
	}

	/**
	 * Adding actions.
	 *
	 * @since 1.0.0
	 */
	public function add_actions() {
		add_action( 'plugins_loaded', array( $this, 'run_tasks' ) );
		add_action( 'plugins_loaded', array( $this, 'load_translation' ) );
	}

	/**
	 * Set a textdomain.
	 *
	 * @since 1.0.0
	 *
	 * @param string $textdomain Textdomain.
	 * @param string $translation_path Path to translation folder.
	 *
	 * @return Plugin Plugin object.
	 */
	public function add_translation( $textdomain, $translation_path ): Plugin {
		$this->textdomain = $textdomain;
		$this->translation_path = $translation_path;

		return $this;
	}


	/**
	 * Load translation
	 *
	 * @since 1.0.0
	 *
	 * @return bool If translation is loaded.
	 */
	public function load_translation() {
		return \load_plugin_textdomain( $this->textdomain, false, $this->translation_path );
	}
}
