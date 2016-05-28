<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\FormRenderer\Renderer;
use Sirius\Input\Specs;

class ResetTest extends BaseTest
{

    /**
     * @var Text
     */
    protected $widget;

    function setUp()
    {
        parent::setUp();
        $this->form->addElement('button', [
            Specs::TYPE => 'button'
        ]);


        $this->widget = new Reset([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('button')
        ], $this->form->getValue('username'), new Renderer());
    }

    function testButtonName()
    {
        $this->assertTrue(false !== strpos($this->widget->render(), '<button'));
        $this->assertTrue(false !== strpos($this->widget->render(), 'type="reset"'));
    }
}