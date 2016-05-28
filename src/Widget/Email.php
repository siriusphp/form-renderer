<?php

namespace Sirius\FormRenderer\Widget;

class Email extends Text
{

    protected $inputTag = 'text';

    protected function getInputProps()
    {
        $props = parent::getInputProps();
        $props['type'] = 'email';

        return $props;
    }
}