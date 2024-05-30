<?php
/**
 * Activation Hook
 *
 * @package WPGraphql\FluentForms
 */

/**
 * Runs when the plugin is activated.
 */
function graphql_ff_activation_callback(): callable {
	return static function (): void {
		do_action( 'graphql_ff_activate' );

		// store the current version of the plugin.
		update_option( 'wp_graphql_ff_version', WPGRAPHQL_FF_VERSION );
	};
}
