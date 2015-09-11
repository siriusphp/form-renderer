<?php
namespace Sirius\FormRenderer;

include(__DIR__ . '/Widget/BaseTest.php');

use Sirius\FormRenderer\Widget\BaseTest;
use Sirius\Input\Specs;

class RendererTest extends BaseTest
{
    /**
     * @var Renderer
     */
    protected $renderer;

    function setUp()
    {
        parent::setUp();
        $this->renderer = new Renderer;

        $this->form->addElement('username', [
            Specs::WIDGET => 'text',
            Specs::LABEL  => 'Username'
        ]);

        $this->form->populate(array(
            'username' => 'nick'
        ));

    }

    function testTextWidget()
    {
        $output = $this->renderer->make('widget-text', [
            '_form'    => $this->form,
            '_element' => $this->form->getElement('username')
        ], $this->form->getValue('username'));


        $this->assertTrue(false !== strpos($output->render(), 'name="username"'));
        $this->assertTrue(false !== strpos($output->render(), 'value="nick"'));
    }

    function testFormRender()
    {
        $output = $this->renderer->render($this->form);

        $this->assertTrue(false !== strpos($output->render(), 'name="username"'));
        $this->assertTrue(false !== strpos($output->render(), 'value="nick"'));
    }

}