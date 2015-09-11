<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\Input\Specs;

class PasswordTest extends BaseTest
{

    /**
     * @var Text
     */
    protected $widget;

    function setUp()
    {
        parent::setUp();
        $this->form->addElement('password', [
            Specs::WIDGET     => 'password',
            Specs::LABEL      => 'Password',
            Specs::VALIDATION => [ 'required' ]
        ]);

        $this->form->populate(array(
            'password' => 'asdf'
        ));

        $this->widget = new Password([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('password')
        ], $this->form->getValue('password'));
    }

    function testInputName()
    {
        $this->assertTrue(false !== strpos($this->widget->render(), ' name="password"'));
    }

    function testInputValueNotPresent()
    {
        $this->assertTrue(false === strpos($this->widget->render(), ' value="'));
    }
}