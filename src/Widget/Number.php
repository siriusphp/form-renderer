<?php

namespace Sirius\FormRenderer\Widget;

class Number extends Text
{

    protected $inputTag = 'text';

    protected function getInputProps()
    {
        $props         = parent::getInputProps();
        $props['type'] = 'number';

        return $props;
    }
}