<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\FormRenderer\Renderer;
use Sirius\FormRenderer\Tag\Error;
use Sirius\Input\Specs;

class ErrorIncludedTest extends BaseTest
{

    /**
     * @var Text
     */
    protected $widget;

    function setUp()
    {
        parent::setUp();
        $this->form->addElement('username', [
            Specs::WIDGET     => 'text',
            Specs::LABEL      => 'Username',
            Specs::VALIDATION => [ 'required' ]
        ]);

        $this->form->populate(array());
        $this->form->isValid(); //to initiate the validation process

        $this->widget = new Text([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('username')
        ], $this->form->getValue('username'));
    }

    function testInputValue()
    {
        $this->assertTrue(false !== strpos($this->widget->render(), 'is required'));
    }
}