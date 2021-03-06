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
    public function __construct($props = null, $content = null, Renderer $builder = null)
    {
        if (!$builder) {
            throw new \InvalidArgumentException('The forms renderer widgets require a Renderer object');
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

    public function isForm()
    {
        return $this->getElement() === $this->getForm();
    }

    /**
     * Creates the input's label
     */
    protected function createLabel()
    {
        if ($this->getElement()->getLabel()) {
            $this->label = $this->builder->make('label', $this->getElement()->getLabelAttributes(), $this->getElement()->getLabel());
        }
    }

    /**
     * Creates the hint tag
     */
    protected function createHint()
    {
        if ($this->getElement()->getHint()) {
            $this->hint = $this->builder->make('hint', $this->getElement()->getHintAttributes(), $this->getElement()->getHint());
        }
    }

    /**
     * Creates the error tag
     */
    protected function createError()
    {
        $error = $this->getForm()->getValidator()->getMessages($this->getElement()->getName());
        if ($error) {
            $this->error = $this->builder->make('error', [], $error);
        }
    }

    /**
     * Creates the input tag/widget
     */
    protected function createInput()
    {
        $props = $this->getInputProps();
        $value = $this->getForm()->getValue($props['name']);
        $this->input = $this->builder->make($this->inputTag, $props, $value);
    }

    /**
     * Returns the list of properties for the tag.
     * Since tags prefixed with _ are not displayed it includes other data needed for rendering
     *
     * @return array
     */
    protected function getInputProps()
    {
        $props = (array)$this->getElement()->getAttributes();
        $props['name'] = $this->get('_element')->get('name');
        $props['_form'] = $this->getForm();
        $props['_element'] = $this->getElement();

        return $props;
    }


    /**
     * Returns the HTML tag that will display the error
     *
     * @return Error
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Returns the HTML tag that will display the hint
     *
     * @return Hint
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * Returns the HTML tag that will display the input field
     *
     * @return Tag
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Returns the HTML tag that will display the label
     *
     * @return Label
     */
    public function getLabel()
    {
        return $this->label;
    }

    public function getInnerHtml()
    {
        return implode("\n", [$this->error, $this->label, $this->input, $this->hint]);
    }

}