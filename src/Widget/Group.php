<?php

namespace Sirius\FormRenderer\Widget;


class Group extends AbstractWidget
{

    protected $tag = 'fieldset';

    protected function createLabel()
    {
        if ($this->getElement()->getLabel()) {
            $this->label = $this->builder->make('legend', $this->getElement()->getLabelAttributes(),
                $this->getElement()->getLabel());
        }
    }

    protected function createInput()
    {
        // do nothing
    }

    protected function getGroupChildren()
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

    public function getInnerHtml()
    {
        return implode("\n", [$this->label, $this->hint, implode("\n", $this->getGroupChildren())]);
    }

}