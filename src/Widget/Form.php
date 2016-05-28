<?php
namespace Sirius\FormRenderer\Widget;

use Sirius\Input\Element\Group;

class Form extends \Sirius\Html\Tag
{

    protected $tag = 'form';

    public function getInnerHtml()
    {
        return implode("\n", $this->getChildInputElements());

    }

    protected function getChildInputElements()
    {
        $content = [];
        foreach ($this->get('_children') as $name => $props) {
            /* @var $element \Sirius\Input\Element */
            $element = $props['_element'];
            $value = $props['_form']->getValue($name);
            $content[] = $this->builder->make('widget-' . $element->getWidget(), $props, $value);
        }

        return $content;
    }

}