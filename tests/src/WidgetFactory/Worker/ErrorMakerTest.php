<?php
namespace Sirius\FormsRenderer\WidgetFactory\Worker;


use Sirius\FormsRenderer\Element\Input\Text;
use Sirius\FormsRenderer\Form;
use Sirius\FormsRenderer\Widget\Input;
use Sirius\FormsRenderer\WidgetFactory\Task;

class ErrorMakerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Form
     */
    protected $form;
    /**
     * @var ErrorMaker
     */
    protected $worker;

    /**
     * @var \Sirius\FormsRenderer\WidgetFactory\Base
     */
    protected $widgetFactory;

    function setUp()
    {
        $this->form = new Form();
        $this->form->setAttributes(
            array(
                'method' => 'post',
                'action' => 'url'
            )
        );
        $this->form->setData('key', 'value');

        $this->widgetFactory = \Mockery::mock('\Sirius\FormsRenderer\WidgetFactory\Base');

        $this->worker = new ErrorMaker();
    }

    function testErrorElementAttached()
    {
        $widget = new Input();
        $task = new Task($this->widgetFactory, $this->form, new Text('email'));
        $task->setResult($widget);
        $this->form->getValidator()->addMessage('email', 'Email is not valid');

        $this->assertNull($widget->getError());
        $this->worker->processTask($task);
        $this->assertEquals('Email is not valid', $widget->getError()->getText());
    }

    function testErrorElementNotAttachedWhenThereIsNoError()
    {
        $widget = new Input();
        $task = new Task($this->widgetFactory, $this->form, new Text('email'));
        $task->setResult($widget);

        $this->worker->processTask($task);
        $this->assertNull($widget->getError());
    }

}
