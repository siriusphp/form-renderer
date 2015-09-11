<?php

namespace Sirius\FormRenderer\Widget;

class Submit extends Button
{

    public function render()
    {
        $this->set('type', 'submit');

        return parent::render();
    }
}