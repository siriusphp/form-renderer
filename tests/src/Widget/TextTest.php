<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\Input\Specs;

class TextTest extends BaseTest
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

        $this->form->populate(array(
            'username' => 'nick'
        ));

        $this->widget = new Text([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('username')
        ], $this->form->getValue('username'));
    }

    function testInputName()
    {
        $this->assertTrue(strpos($this->widget->render(), 'name="username"') !== false);
    }

    function testInputValue()
    {
        $this->assertTrue(strpos($this->widget->render(), 'value="nick"') !== false);
    }
}