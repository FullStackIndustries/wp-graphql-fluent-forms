<?php

/**
 * GraphQL Object Type - Fluent Forms Form
 *
 *
 * @package WPGraphQL\FluentForms\Type\WPObject\Form
 */

declare(strict_types=1);

namespace WPGraphQL\FluentForms\Type\WPObject;

use WPGraphQL\FluentForms\Vendor\AxeWP\GraphQL\Abstracts\ObjectType;

class FormField extends ObjectType
{
    /**
     * {@inheritDoc}
     */
    public static function type_name(): string
    {
        return 'FormField';
    }

    /**
     * {@inheritDoc}
     */
    public static function get_description(): string
    {
        return __('Fluent Forms form field.', 'wp-graphql-fluent-forms');
    }

    /**
     * {@inheritDoc}
     */
    public static function get_fields(): array
    {
        return [
            'index'                 => [
                'type'              => 'Int',
                'description'       => __('The index of the form field.', 'wp-graphql-fluent-forms'),
            ],
            'elementType'           => [
                'type'              => 'String',
                'description'       => __('Form field element type.', 'wp-graphql-fluent-forms'),
            ],
            'type'                  => [
                'type'              => 'String',
                'description'       => __('Form field type.', 'wp-graphql-fluent-forms'),
            ],
            'placeholder'           => [
                'type'              => 'String',
                'description'       => __('Form field placeholder.', 'wp-graphql-fluent-forms'),
            ],
        ];
    }
}
