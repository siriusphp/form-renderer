<?php

namespace Sirius\FormRenderer\Widget;

use \Sirius\Input\Specs;
use \Sirius\Html\Tag\Select as SelectTag;

class Select extends AbstractWidget
{

    protected $inputTag = 'select';

    protected function getInputProps()
    {
        $props                  = parent::getInputProps();
        $props['_first_option'] = $this->get('_element')->get(Specs::FIRST_OPTION);
        $props['_options']      = $this->get('_element')->get(Specs::OPTIONS);

        return $props;
    }

}