<?php

namespace Sirius\FormRenderer\Utils;

use Sirius\Input\Element;
use Sirius\Input\InputFilter;

class TreeBuilder
{

    /**
     * @var InputFilter
     */
    protected $form;


    public function __construct(InputFilter $form, Element $root = null)
    {
        if ( ! $root) {
            $root = $form;
        }
        $this->form = $form;
        $this->root = $root;
    }

    function getTree()
    {
        return $this->createNode($this->root);
    }


    protected function createNode($element, $name = null)
    {
        $node = [
            '_form'     => $this->form,
            '_name'     => $name,
            '_element'  => $element,
            '_children' => (method_exists($element,
                'getElements')) ? $this->getChildrenTree($element->getElements()) : null
        ];

        return $node;
    }

    protected function getChildrenTree($elements)
    {
        $parents = [ ];
        foreach ($elements as $name => $element) {
            $group             = ($element === $this->root || ! $element->getGroup()) ? '____root' : $element->getGroup();
            $parents[$group][] = $this->createNode($element, $name);
        }

        return $this->createBranch($parents, $parents['____root']);;
    }

    function createBranch(&$parents, $children)
    {
        $tree = array();
        foreach ($children as $child) {
            $childName = $child['_name'];
            if (isset($parents[$childName])) {
                $child['_children'] = $this->createBranch($parents, $parents[$childName]);
            }
            $tree[$childName] = $child;
        }

        return $tree;
    }

}