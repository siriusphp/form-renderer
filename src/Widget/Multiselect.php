<?php
namespace Sirius\FormRenderer\Widget;

use \Sirius\Input\Specs;
use \Sirius\Html\Tag\MultiSelect as MultiselectTag;

class Multiselect extends Select
{

    protected $inputTag = 'multiselect';

    public function getInputProps()
    {
        $props = parent::getInputProps();
        $props['multiple'] = 'multiple';

        return $props;
    }

}