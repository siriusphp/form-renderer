<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\FormRenderer\Renderer;
use Sirius\Input\Specs;

class FormTest extends BaseTest
{

    /**
     * @var Form
     */
    protected $widget;

    /**
     * @var Renderer
     */
    protected $renderer;

    function setUp()
    {
        parent::setUp();
        $this->form->addElement('upper-group', [
            Specs::TYPE  => 'group',
            Specs::LABEL => 'Upper Group',
        ]);
        $this->form->addElement('login', [
            Specs::TYPE  => 'group',
            Specs::LABEL => 'Credentials',
            Specs::GROUP => 'upper-group'
        ]);
        $this->form->addElement('username', [
            Specs::WIDGET     => 'text',
            Specs::LABEL      => 'Username',
            Specs::VALIDATION => [ 'required' ],
            Specs::GROUP      => 'login'
        ]);

        $this->form->addElement('password', [
            Specs::WIDGET     => 'password',
            Specs::LABEL      => 'Password',
            Specs::VALIDATION => [ 'required' ],
            Specs::GROUP      => 'login'
        ]);

        $this->renderer = new Renderer();

    }

    function testInputPresent()
    {
        $this->widget = $this->renderer->render($this->form);
        $this->assertEquals(2, substr_count($this->widget->render(), 'name="'));
        $this->assertEquals(1, substr_count($this->widget->render(), 'type="text"'));
        $this->assertEquals(1, substr_count($this->widget->render(), 'type="password"'));
    }

    function testErrorsPresent()
    {
        $this->form->populate(array());
        $this->form->isValid();
        $this->widget = $this->renderer->render($this->form);
        $this->assertEquals(2, substr_count($this->widget->render(), 'class="error"'));
    }

}