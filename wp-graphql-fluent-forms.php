<?php

/**
 * Plugin Name: WPGraphQL Fluent Forms
 * Plugin URI: https://github.com/FullStackIndustries/wp-graphql-fluent-forms
 * GitHub Plugin URI: https://github.com/FullStackIndustries/wp-graphql-fluent-forms
 * Description: Adds Fluent Forms Functionality to WPGraphQL schema.
 * Author: Full Stack Industries
 * Author URI: https://www.fullstackindustries.com/
 * Update URI: https://github.com/FullStackIndustries/wp-graphql-fluent-forms
 * Version: 0.0.1
 * Text Domain: wp-graphql-fluent-forms
 * Domain Path: /languages
 * Requires at least: 5.4.1
 * Tested up to: 6.5
 * Requires PHP: 7.4+
 * Requires Plugins: wp-graphql, fluentform
 * WPGraphQL requires at least: 1.8.0
 * Fluent Forms requires at least: 5.1.18
 * License: GPL-3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package WPGraphQL\FluentForms
 * @author FullStackIndustries
 * @license GPL-3
 * @version 0.0.1
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

// If the codeception remote coverage file exists, require it.
// This file should only exist locally or when CI bootstraps the environment for testing.
if (file_exists(__DIR__ . '/c3.php')) {
	require_once __DIR__ . '/c3.php';
}

// Run this function when the plugin is activated.
if (file_exists(__DIR__ . '/activation.php')) {
	require_once __DIR__ . '/activation.php';
	register_activation_hook(__FILE__, 'graphql_ff_activation_callback');
}

// Run this function when the plugin is deactivated.
if (file_exists(__DIR__ . '/deactivation.php')) {
	require_once __DIR__ . '/deactivation.php';
	register_activation_hook(__FILE__, 'graphql_ff_deactivation_callback');
}

/**
 * Define plugin constants.
 */
function graphql_ff_constants(): void
{
	// Plugin version.
	if (!defined('WPGRAPHQL_FF_VERSION')) {
		define('WPGRAPHQL_FF_VERSION', '0.0.1');
	}

	// Plugin Folder Path.
	if (!defined('WPGRAPHQL_FF_PLUGIN_DIR')) {
		define('WPGRAPHQL_FF_PLUGIN_DIR', plugin_dir_path(__FILE__));
	}

	// Plugin Folder URL.
	if (!defined('WPGRAPHQL_FF_PLUGIN_URL')) {
		define('WPGRAPHQL_FF_PLUGIN_URL', plugin_dir_url(__FILE__));
	}

	// Plugin Root File.
	if (!defined('WPGRAPHQL_FF_PLUGIN_FILE')) {
		define('WPGRAPHQL_FF_PLUGIN_FILE', __FILE__);
	}

	// Whether to autoload the files or not.
	if (!defined('WPGRAPHQL_FF_AUTOLOAD')) {
		define('WPGRAPHQL_FF_AUTOLOAD', true);
	}
}

/**
 * Checks if all the the required plugins are installed and activated.
 *
 * @return string[]
 */
function graphql_ff_dependencies_not_ready(): array
{
	$deps = [];

	if (!class_exists('\WPGraphQL')) {
		$deps[] = 'WPGraphQL';
	}

	return $deps;
}

/**
 * Initializes plugin.
 */
function graphql_ff_init(): void
{
	graphql_ff_constants();

	$not_ready = graphql_ff_dependencies_not_ready();

	if (empty($not_ready) && defined('WPGRAPHQL_FF_PLUGIN_DIR')) {
		require_once WPGRAPHQL_FF_PLUGIN_DIR . 'src/Main.php';
		\WPGraphQL\FluentForms\Main::instance();
		return;
	}

	foreach ($not_ready as $dep) {
		add_action(
			'admin_notices',
			static function () use ($dep) {
?>
			<div class="error notice">
				<p>
					<?php
					printf(
						/* translators: dependency not ready error message */
						esc_html__('%1$s must be active for WPGraphQL Fluent Forms to work.', 'wp-graphql-fluent-forms'),
						esc_html($dep)
					);
					?>
				</p>
			</div>
<?php
			}
		);
	}
}

add_action('graphql_init', 'graphql_ff_init');
