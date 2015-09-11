<?php

namespace Sirius\FormRenderer\Widget;

class Reset extends Button
{

    public function render()
    {
        $this->set('type', 'reset');

        return parent::render();
    }
}