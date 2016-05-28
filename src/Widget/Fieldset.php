<?php

namespace Sirius\FormRenderer\Widget;


use Sirius\FormRenderer\Utils\TreeBuilder;
use Sirius\Input\Element\Group;

class Fieldset extends AbstractWidget
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

    protected function createChildrenTree()
    {
        $treeBuilder = new TreeBuilder($this->get('_form'), $this->get('_element'));
        $tree = $treeBuilder->getTree();
        $this->set('_children', $tree['_children']);
    }

    protected function getChildInputElements()
    {
        $content = [];
        if (!$this->get('_children')) {
            $this->createChildrenTree();
        }
        foreach ($this->get('_children') as $name => $props) {
            /* @var $element \Sirius\Input\Element */
            $element = $props['_element'];
            $value = $props['_form']->getValue($element->get('name'));
            $content[] = $this->builder->make('widget-' . $element->getWidget(), $props, $value);
        }

        return $content;
    }

    public function getInnerHtml()
    {
        return implode("\n",
            [$this->label, $this->hint, $this->error, implode("\n", $this->getChildInputElements())]);
    }

}