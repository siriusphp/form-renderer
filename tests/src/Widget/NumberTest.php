<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\Input\Specs;

class NumberTest extends BaseTest
{

    /**
     * @var Number
     */
    protected $widget;

    function setUp()
    {
        parent::setUp();
        $this->form->addElement('age', [
            Specs::WIDGET => 'number',
            Specs::LABEL  => 'Age',
        ]);

        $this->widget = new Number([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('age')
        ], $this->form->getValue('age'));
    }

    function testButtonName()
    {
        $this->assertTrue(false !== strpos($this->widget->render(), 'name="age"'));
        $this->assertTrue(false !== strpos($this->widget->render(), 'type="number"'));
    }
}