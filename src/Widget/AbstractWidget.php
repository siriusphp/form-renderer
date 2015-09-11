<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\FormRenderer\Renderer;
use \Sirius\Html\Tag;

abstract class AbstractWidget extends Tag
{

    protected $tag = 'div';

    protected $inputTag = 'text';

    /**
     * @var Label
     */
    protected $label;

    /**
     * @var Hint
     */
    protected $hint;

    /**
     * @var Error
     */
    protected $error;

    /**
     * @var Tag
     */
    protected $input;

    /**
     * @param mixed $props
     * @param mixed $content
     * @param Renderer $builder
     */
    function __construct($props = null, $content = null, Renderer $builder = null)
    {
        if ( ! $builder) {
            $builder = new Renderer();
        }
        parent::__construct($props, $content, $builder);
        $this->createLabel();
        $this->createHint();
        $this->createError();
        $this->createInput();
    }

    /**
     * @return \Sirius\Input\Element
     */
    protected function getElement()
    {
        return $this->props['_element'];
    }

    /**
     * @return \Sirius\Input\InputFilter;
     */
    protected function getForm()
    {
        return $this->props['_form'];
    }

    /**
     * Create the input's label
     */
    protected function createLabel()
    {
        if ($this->getElement()->getLabel()) {
            $this->label = $this->builder->make('label', $this->getElement()->getLabelAttributes(),
                $this->getElement()->getLabel());
        }
    }

    /**
     * Create the hint tag
     */
    protected function createHint()
    {
        if ($this->getElement()->getHint()) {
            $this->hint = $this->builder->make('hint', $this->getElement()->getHintAttributes(),
                $this->getElement()->getHint());
        }
    }

    /**
     * Create the error tag
     */
    protected function createError()
    {
        $error = $this->getForm()->getValidator()->getMessages($this->getElement()->getName());
        if ($error) {
            $this->error = $this->builder->make('error', [ ], $error);
        }
    }

    /**
     * Create the input tag/widget
     */
    protected function createInput()
    {
        $props       = $this->getInputProps();
        $value       = $this->getForm()->getValue($props['name']);
        $this->input = $this->builder->make($this->inputTag, $props, $value);
    }

    protected function getInputProps()
    {
        $props             = $this->getElement()->getAttributes();
        $props['name']     = $this->get('_element')->get('name');
        $props['_form']    = $this->getForm();
        $props['_element'] = $this->getElement();

        return $props;
    }


    /**
     * @return Error
     */
    function getError()
    {
        return $this->error;
    }

    /**
     * @return Hint
     */
    function getHint()
    {
        return $this->hint;
    }

    /**
     * @return Tag
     */
    function getInput()
    {
        return $this->input;
    }

    /**
     * @return Label
     */
    function getLabel()
    {
        return $this->label;
    }

    function getInnerHtml()
    {
        return implode("\n", [ $this->error, $this->label, $this->input, $this->hint ]);
    }

}