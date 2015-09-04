<?php
namespace Sirius\FormsRenderer\WidgetFactory;

use Sirius\FormsRenderer\Element;
use Sirius\FormsRenderer\Form;
use Sirius\FormsRenderer\Html\ExtendedTag;

class Task
{

    /**
     * @var FactoryInterface
     */
    protected $widgetFactory;

    /**
     * @var Form
     */
    protected $form;

    /**
     * @var Element
     */
    protected $element;

    function __construct(FactoryInterface $widgetFactory, Form $form, Element $element = null)
    {
        $this->widgetFactory = $widgetFactory;
        $this->form = $form;
        $this->element = $element;
        $this->result = null;
    }

    /**
     * Get the widget factory associated with this task
     *
     * @return \Sirius\FormsRenderer\WidgetFactory\FactoryInterface
     */
    function getWidgetFactory()
    {
        return $this->widgetFactory;
    }

    /**
     * Return the form that is going to be handled during the execution of this task
     *
     * @return \Sirius\FormsRenderer\Form
     */
    function getForm()
    {
        return $this->form;
    }

    /**
     * Return the element that is going to be handled during the execution of this task
     *
     * @return \Sirius\FormsRenderer\Element\AbstractElement
     */
    function getElement()
    {
        return $this->element;
    }

    /**
     * Sets the result of the task
     *
     * @param ExtendedTag $result
     */
    function setResult(ExtendedTag $result)
    {
        $this->result = $result;
    }

    /**
     * Returns the result of the execution of the task
     *
     * @return NULL|ExtendedTag
     */
    function getResult()
    {
        return $this->result;
    }
}
