<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\Input\Specs;

class SubmitTest extends BaseTest
{

    /**
     * @var Text
     */
    protected $widget;

    function setUp()
    {
        parent::setUp();
        $this->form->addElement('button', [
            Specs::TYPE  => 'button',
            Specs::LABEL => 'Submit',
        ]);


        $this->widget = new Submit([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('button')
        ], $this->form->getValue('username'));
    }

    function testButtonName()
    {
        $this->assertTrue(false !== strpos($this->widget->render(), '<button'));
        $this->assertTrue(false !== strpos($this->widget->render(), 'type="submit"'));
        $this->assertTrue(false !== strpos($this->widget->render(), '>Submit<'));
    }
}