<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\FormRenderer\Renderer;
use Sirius\Input\Specs;

class SelectTest extends BaseTest
{

    /**
     * @var Select
     */
    protected $widget;

    function setUp()
    {
        parent::setUp();
        $this->form->addElement('gender', [
            Specs::WIDGET       => 'select',
            Specs::LABEL        => 'Gender',
            Specs::VALIDATION   => [ 'required' ],
            Specs::FIRST_CHOICE => 'select from list',
            Specs::CHOICES      => array( 'male' => 'Male', 'female' => 'Female' )
        ]);

        $this->form->populate(array(
            'gender' => 'female'
        ));

        $this->widget = new Select([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('gender')
        ], $this->form->getValue('gender'), new Renderer());
    }

    function testInputName()
    {
        $this->assertTrue(strpos($this->widget->render(), 'name="gender"') !== false);
    }

    function testInputValue()
    {
        $this->assertTrue(strpos($this->widget->render(), 'value="female" selected') !== false);
    }
}