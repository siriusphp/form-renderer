<?php
namespace Sirius\FormRenderer\Tag;

use Sirius\Html\Builder;
use \Sirius\Html\Tag\Select;
use \Sirius\Input\Specs;


class Radioset extends Select
{

    protected $tag = 'ul';

    protected $isSelfClosing = false;

    protected function getValidAttributes()
    {
        $attrs = parent::getValidAttributes();
        unset($attrs['name']);

        return $attrs;
    }

    public function getInnerHtml()
    {
        $items = array();
        $name = $this->get('_element')->get('name');
        $value = $this->getValue();
        foreach ($this->get('_options') as $k => $v) {
            $items[] = '<li><label>' . $this->builder->make('radio', [
                    'name' => $name,
                    'value' => $k,
                ], $value) . $v . '</label></li>';
        }

        return implode("\n", $items);
    }

}