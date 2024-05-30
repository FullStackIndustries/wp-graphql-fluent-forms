<?php

use WPGraphQL\FluentForms\CoreSchemaFilters;

/**
 * Tests CoreSchemaFilters.
 */
class CoreSchemaFiltersTest extends \Codeception\TestCase\WPTestCase {

	/**
	 * Tests graphql_seo_get_setting
	 */
	public function testGetTypePrefix() {
		$actual = CoreSchemaFilters::get_type_prefix();
		$this->assertEquals( 'FluentForms', $actual );

		$expected = 'somePrefix';
		$actual   = CoreSchemaFilters::get_type_prefix( $expected );
		$this->assertEquals( $expected, $actual );
	}

}
