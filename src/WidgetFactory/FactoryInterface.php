<?php
namespace Sirius\FormsRenderer\WidgetFactory;

use Sirius\FormsRenderer\Element;
use Sirius\FormsRenderer\Form;

interface FactoryInterface
{

    /**
     * Create a widget from a form element
     *
     * @param \Sirius\FormsRenderer\Form $form
     * @param \Sirius\FormsRenderer\Element $element
     * @return false|\Sirius\FormsRenderer\Html\ExtendedTag
     */
    function createWidget(Form $form, Element $element = null);
}
