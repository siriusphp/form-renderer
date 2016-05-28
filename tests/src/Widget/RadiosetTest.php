<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\FormRenderer\Renderer;
use Sirius\Input\Specs;

class RadiosetTest extends BaseTest
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

        $this->widget = new Radioset([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('gender')
        ], $this->form->getValue('gender'), new Renderer());
        //print_r($this->widget->getInput());
    }

    function testInputName()
    {
        // 2 radio buttons
        $this->assertEquals(2, substr_count($this->widget->render(), 'name="gender"'));
        $this->assertEquals(2, substr_count($this->widget->render(), 'type="radio"'));
    }

    function testInputValue()
    {
        // one radio button checked
        $this->assertEquals(1, substr_count($this->widget->render(), 'checked="checked"'));
    }
}