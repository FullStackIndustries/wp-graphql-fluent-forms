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

class Form extends ObjectType
{
    /**
     * {@inheritDoc}
     */
    public static function type_name(): string
    {
        return 'Form';
    }

    /**
     * {@inheritDoc}
     */
    public static function get_description(): string
    {
        return __('Fluent Forms form.', 'wp-graphql-fluent-forms');
    }

    /**
     * {@inheritDoc}
     */
    public static function get_fields(): array
    {
        return [
            'databaseId'                  => [
                'type'              => 'ID',
                'description'       => __('The database ID of the form.', 'wp-graphql-fluent-forms'),
            ],
            'title'                       => [
                'type'              => 'String',
                'description'       => __('Form title.', 'wp-graphql-fluent-forms'),
            ],
            'createdAt'                   => [
                'type'              => 'String',
                'description'       => __('Form creation date.', 'wp-graphql-fluent-forms'),
            ],
            'updatedAt'                   => [
                'type'              => 'String',
                'description'       => __('Form last update date.', 'wp-graphql-fluent-forms'),
            ],
            'status'                      => [
                'type'              => 'String',
                'description'       => __('Form status.', 'wp-graphql-fluent-forms'),
            ],
            'inputs'                      => [
                'type'              => ['list_of' => FormField::get_type_name()],
                'description'       => __('Array of Form inputs.', 'wp-graphql-fluent-forms'),
            ],
        ];
    }
}
