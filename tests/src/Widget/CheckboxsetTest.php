<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\Input\Specs;
use Sirius\FormRenderer\Renderer;

class CheckboxsetTest extends BaseTest
{

    /**
     * @var Select
     */
    protected $widget;

    function setUp()
    {
        parent::setUp();
        $this->form->addElement('foods', [
            Specs::WIDGET       => 'multiselect',
            Specs::LABEL        => 'Preferred foods',
            Specs::VALIDATION   => [ 'required' ],
            Specs::FIRST_CHOICE => 'select from list',
            Specs::CHOICES      => array( 'pizza' => 'Pizza', 'burgers' => 'Burgers', 'brocolli' => 'Brocolli' )
        ]);

        $this->form->populate(array(
            'foods' => [ 'pizza', 'brocolli' ]
        ));

        $this->widget = new Checkboxset([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('foods')
        ], $this->form->getValue('foods'), new Renderer());
    }

    function testInputName()
    {
        // there should be 3 checkboxes
        $this->assertEquals(3, substr_count($this->widget->render(), 'name="foods[]"'));
        $this->assertEquals(3, substr_count($this->widget->render(), 'type="checkbox"'));
    }


    function testInputValue()
    {
        // 2 checkboxes must be checked
        $this->assertEquals(2, substr_count($this->widget->render(), 'checked="checked"'));
    }
}