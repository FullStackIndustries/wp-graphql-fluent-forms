<?php
/**
 * Deactivation Hook
 *
 * @package WPGraphql\FluentForms
 */

/**
 * Runs when WPGraphQL is de-activated.
 *
 * This cleans up data that WPGraphQL stores.
 */
function graphql_ff_deactivation_callback(): callable {
	return static function (): void {

		// Fire an action when WPGraphQL is de-activating.
		do_action( 'graphql_ff_deactivate' );

		// Delete data during activation.
		graphql_ff_delete_data();
	};
}

/**
 * Delete data on deactivation.
 */
function graphql_ff_delete_data(): void {

	// Check if the plugin is set to delete data or not.
	$delete_data = graphql_ff_get_setting( 'delete_data_on_deactivate' );

	// Bail if not set to delete.
	if ( 'on' !== $delete_data ) {
		return;
	}

	// Delete plugin version.
	delete_option( 'wp_graphql_ff_version' );

	// Initialize the settings API.
	$settings = new \WPGraphQL\FluentForms\Admin\Settings\Settings();
	$settings::register_settings();

	// Get all the registered settings fields.
	$fields = $settings::get_settings_api()->get_settings_fields();

	// Loop over the registered settings fields and delete the options.
	if ( ! empty( $fields ) && is_array( $fields ) ) {
		foreach ( $fields as $group => $fields ) {
			delete_option( $group );
		}
	}

	do_action( 'graphql_ff_delete_data' );
}
