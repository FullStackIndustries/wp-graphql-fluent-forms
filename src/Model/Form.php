<?php

/**
 * Form Model class
 *
 * @package \WPGraphQL\FluentForms\Model
 * @since   0.10.0
 */

declare(strict_types=1);

namespace WPGraphQL\FluentForms\Model;

use Exception;
use WPGraphQL\FluentForms\Utils\FFUtils;
use WPGraphQL\Model\Model;

/**
 * Class - Form
 *
 * @property array<string,mixed> $form The underlying form to be modeled.
 * @property int                 $databaseId The database ID of the form.
 */
class Form extends Model
{
    /**
     * Stores the incoming form to be modeled.
     *
     * @var array<string,mixed> $data;
     */
    protected $data;

    /**
     * Constructor.
     *
     * @param int $form_id .
     * @throws \Exception .
     */
    public function __construct(int $form_id)
    {
        $form = FFUtils::getForm($form_id);

        if (empty($form)) {
            throw new Exception(esc_html__('The Fluent Form ID specified cannot be found', 'wp-graphql-fluent-forms'));
        }

        $this->data = $form;

        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function init(): void
    {
        if (empty($this->fields)) {
            $this->fields = [
                'databaseId'                => fn (): int => $this->data->id,
                'title'                     => fn (): ?string => $this->data->title,
                'createdAt'                 => fn (): string => FFUtils::getIsoDateTime($this->data->created_at),
                'updatedAt'                 => fn (): string => FFUtils::getIsoDateTime($this->data->updated_at),
                'status'                    => fn (): string => $this->data->status,
                'inputs'                    => fn (): array => $this->getInputs($this->data->inputs()),
            ];
        }
    }

    private function getInputs(array $inputs): array
    {
        $formInputs = [];
        foreach ($inputs as $input) {
            $inputRaw = $input['raw'];
            $formInputs[] = [
                'index'                 => $inputRaw['index'],
                'elementType'           => $inputRaw['element'],
                'type'                  => $inputRaw['attributes']['type'],
                'placeholder'           => $inputRaw['attributes']['placeholder'],
                'label'                 => $inputRaw['settings']['label'],
            ];
        }
        return $formInputs;
    }
}
