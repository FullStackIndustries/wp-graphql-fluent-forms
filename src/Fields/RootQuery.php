<?php

/**
 * Registers fields to RootQuery
 *
 * @package WPGraphQL\Fields
 */

declare(strict_types=1);

namespace WPGraphQL\FluentForms\Fields;

use WPGraphQL\FluentForms\Type\WPObject\Form;
use WPGraphQL\FluentForms\Model\Form as ModelForm;
use WPGraphQL\FluentForms\Vendor\AxeWP\GraphQL\Abstracts\FieldsType;

/**
 * Class - RootQuery
 */
class RootQuery extends FieldsType
{
    /**
     * {@inheritDoc}
     */
    protected static function type_name(): string
    {
        return 'RootQuery';
    }

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public static function get_type_name(): string
    {
        return static::type_name();
    }

    /**
     * {@inheritDoc}
     */
    public static function get_fields(): array
    {
        return [
            'ffForm' => [
                'type'        => Form::get_type_name(),
                'description' => __('A single Fluent Form', 'wp-graphql-fluent-forms'),
                'args'        => [
                    'id'     => [
                        'type'        => ['non_null' => 'ID'],
                        'description' => __('Database ID of the form.', 'wp-graphql-fluent-forms'),
                    ],
                ],
                'resolve'     => static fn ($source, $args) => new ModelForm((int) $args['id']),
            ],
        ];
    }
}
