<?php

namespace Sirius\FormRenderer\Widget;

class Text extends AbstractWidget
{

    protected $inputTag = 'text';

    protected function getInputProps()
    {
        $props         = parent::getInputProps();
        $props['type'] = 'text';

        return $props;
    }
}