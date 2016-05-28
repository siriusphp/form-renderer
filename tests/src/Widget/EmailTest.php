<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\FormRenderer\Renderer;
use Sirius\Input\Specs;

class EmailTest extends BaseTest
{

    /**
     * @var Email
     */
    protected $widget;

    function setUp()
    {
        parent::setUp();
        $this->form->addElement('email', [
            Specs::WIDGET => 'email',
            Specs::LABEL  => 'Email',
        ]);

        $this->widget = new Email([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('email')
        ], $this->form->getValue('email'), new Renderer());
    }

    function testInputName()
    {
        $this->assertTrue(false !== strpos($this->widget->render(), 'name="email"'));
        $this->assertTrue(false !== strpos($this->widget->render(), 'type="email"'));
    }
}