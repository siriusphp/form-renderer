<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\Input\Specs;

class CheckboxTest extends BaseTest
{

    /**
     * @var Select
     */
    protected $widget;

    function setUp()
    {
        parent::setUp();
        $this->form->addElement('newsletter', [
            Specs::WIDGET          => 'checkbox',
            Specs::LABEL           => 'Subscribe to newsletter',
            Specs::HINT            => 'No SPAM',
            Specs::UNCHECKED_VALUE => 'no',
            Specs::CHECKED_VALUE   => 'yes'
        ]);

        $this->form->populate(array(
            'newsletter' => 'yes'
        ));

        $this->widget = new Checkbox([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('newsletter')
        ], $this->form->getValue('newsletter'));
    }

    function testInputName()
    {
        $this->assertTrue(false !== strpos($this->widget->render(), 'name="newsletter"'));
    }

    function testInputValue()
    {
        $this->assertTrue(false !== strpos($this->widget->render(), 'type="hidden" value="no"'));
        $this->assertTrue(false !== strpos($this->widget->render(), 'type="checkbox" value="yes"'));
        $this->assertTrue(false !== strpos($this->widget->render(), 'checked="checked"'));
    }
}