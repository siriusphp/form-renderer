<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\Input\Specs;

class GroupTest extends BaseTest
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
            Specs::VALIDATION => [ 'required' ],
            Specs::GROUP      => 'login'
        ]);
        $this->form->addElement('login', [
            Specs::WIDGET => 'group',
            Specs::LABEL  => 'Credentials'
        ]);

        $this->widget = new Group([
            '_form'     => $this->form,
            '_element'  => $this->form->getElement('login'),
            '_children' => [
                'username' => [
                    '_form'    => $this->form,
                    '_element' => $this->form->getElement('username')
                ]
            ]
        ]);
    }

    function testLegendPresent()
    {
        $this->assertTrue(false !== strpos($this->widget->render(), '<legend'));
    }

    function testInputPresent()
    {
        $this->assertTrue(false !== strpos($this->widget->render(), 'name="username"'));
    }
}