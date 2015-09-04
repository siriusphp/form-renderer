<?php
namespace Sirius\FormsRenderer\Widget;

use Sirius\FormsRenderer\Form\Element\Specs;
use Sirius\FormsRenderer\Html\ExtendedTag;
use Sirius\FormsRenderer\Widget\Traits\HasChildrenTrait;
use Sirius\FormsRenderer\Widget\Traits\HasHintTrait;

class Group extends ExtendedTag
{
    use HasHintTrait;
    use HasChildrenTrait;

    protected $tag = 'div';

    function render()
    {
        $children = '';
        foreach ($this->children as $child) {
            $children .= $child;
        }
        $hint = $this->getHint() && $this->getHint()->getText() ? $this->getHint() : '';
        $this->setText("{$hint}{$children}");
        return parent::render();
    }
}
