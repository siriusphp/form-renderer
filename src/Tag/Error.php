<?php
namespace Sirius\FormRenderer\Tag;

use Sirius\Html\Tag\Div;

class Error extends Div
{

    protected $tag = 'div';

    public function render()
    {
        $this->addClass('error');

        return parent::render();
    }

}