<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\Html\Builder;

class Button extends \Sirius\Html\Tag\Button
{

    public function __construct($props = null, $content = null, Builder $builder = null)
    {
        $content = $props['_element']->get('label');
        $props['type'] = 'button';

        return parent::__construct($props, $content, $builder);
    }

}