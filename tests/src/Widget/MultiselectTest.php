<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\Input\Specs;
use Sirius\Multiselect;

class MultiselectTest extends BaseTest
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
            Specs::FIRST_OPTION => 'select from list',
            Specs::OPTIONS      => array( 'pizza' => 'Pizza', 'burgers' => 'Burgers', 'brocolli' => 'Brocolli' )
        ]);

        $this->form->populate(array(
            'foods' => [ 'pizza', 'brocolli' ]
        ));

        $this->widget = new \Sirius\FormRenderer\Widget\Multiselect([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('foods')
        ], $this->form->getValue('foods'));
    }

    function testInputName()
    {
        $this->assertTrue(strpos($this->widget->render(), 'name="foods[]"') !== false);
    }

    function testMultipleAttribute()
    {
        $this->assertTrue(strpos($this->widget->render(), 'multiple="multiple"') !== false);
    }

    function testInputValue()
    {
        $this->assertTrue(false !== strpos($this->widget->render(), 'value="pizza" selected'));
        $this->assertTrue(false !== strpos($this->widget->render(), 'value="brocolli" selected'));
        $this->assertTrue(false === strpos($this->widget->render(), 'value="burgers" selected'));
    }
}