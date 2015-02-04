<?php
namespace Sirius\Forms\Widget;

use Sirius\Forms\Form\Element\Specs;
use Sirius\Forms\Html\ExtendedTag;
use Sirius\Forms\Widget\Traits\HasChildrenTrait;
use Sirius\Forms\Widget\Traits\HasHintTrait;
use Sirius\Forms\Widget\Traits\HasLabelTrait;

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
