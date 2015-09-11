<?php
namespace Sirius\FormRenderer\Tag;

use \Sirius\Html\Tag\Select;
use \Sirius\Input\Specs;


class Checkboxset extends Radioset
{

    protected $tag = 'ul';

    public function getInnerHtml()
    {
        $items = array();
        $name  = $this->get('_element')->get('name');
        $value = $this->getValue();
        foreach ($this->get('_element')->get(Specs::OPTIONS) as $k => $v) {
            $items[] = '<li><label>' . $this->builder->make('checkbox', [
                    'name'  => $name . '[]',
                    'value' => $k,
                ], $value) . '</label></li>';
        }

        return implode("\n", $items);
    }

}