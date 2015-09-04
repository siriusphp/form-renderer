<?php
namespace Sirius\FormsRenderer\Widget;

use Sirius\FormsRenderer\Form\Element\Specs;
use Sirius\FormsRenderer\Html\ExtendedTag;
use Sirius\FormsRenderer\Widget\Traits\HasChildrenTrait;
use Sirius\FormsRenderer\Widget\Traits\HasHintTrait;
use Sirius\FormsRenderer\Widget\Traits\HasLabelTrait;

class Fieldset extends ExtendedTag
{
    use HasLabelTrait;
    use HasHintTrait;
    use HasChildrenTrait;

    protected $tag = 'fieldset';

    function render()
    {
        $children = '';
        foreach ($this->children as $child) {
            $children .= $child;
        }
        $hint = $this->getHint() && $this->getHint()->getText() ? $this->getHint() : '';
        $label = $this->getLabel() && $this->getLabel()->getText() ? $this->getLabel() : '';
        $this->setText("{$label}{$hint}{$children}");
        return parent::render();
    }
}
