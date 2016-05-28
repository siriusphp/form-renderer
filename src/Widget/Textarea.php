<?php

namespace Sirius\FormRenderer\Widget;

class Textarea extends AbstractWidget
{

    protected $inputTag = 'textarea';

    protected function getInputProps()
    {
        $props = parent::getInputProps();
        return $props;
    }
}