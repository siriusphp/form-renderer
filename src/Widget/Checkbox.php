<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\Input\Specs;

class Checkbox extends AbstractWidget
{

    protected $inputTag = 'checkbox';

    protected function getInputProps()
    {
        $props = parent::getInputProps();
        $props['value'] = $this->get('_element')->get(Specs::CHECKED_VALUE);

        return $props;
    }

    protected function getHiddenField()
    {
        return $this->builder->make('hidden', array(
            'name' => $this->get('_element')->get('name'),
            'value' => $this->get('_element')->get(Specs::UNCHECKED_VALUE)
        ), $this->get('_element')->get(Specs::UNCHECKED_VALUE));
    }

    public function getInnerHtml()
    {
        $hiddenInput = $this->getHiddenField();

        return implode("\n", [$this->error, $hiddenInput, $this->input, $this->label, $this->hint]);
    }

}