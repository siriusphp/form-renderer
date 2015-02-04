<?php
namespace Sirius\Forms\Html;

class Textarea extends Input
{

    protected $tag = 'textarea';

    protected $isSelfClosing = false;

    function render()
    {
        $this->setText($this->getValue());
        return parent::render();
    }
}
