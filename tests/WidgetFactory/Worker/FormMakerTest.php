<?php
/**
 * Created by PhpStorm.
 * User: Florin
 * Date: 4/26/2014
 * Time: 12:40 PM
 */

namespace Sirius\Forms\WidgetFactory\Worker;


use Sirius\Forms\Form;
use Sirius\Forms\WidgetFactory\Task;

class FormMakerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Form
     */
    protected $form;
    /**
     * @var FormMaker
     */
    protected $worker;

    /**
     * @var \Sirius\Forms\WidgetFactory\Base
     */
    protected $widgetFactory;

    function setUp() {
        $this->form = new Form;
        $this->form->setAttributes(array(
            'method' => 'post',
            'action' => 'url'
        ));
        $this->form->setData('key', 'value');

        $this->widgetFactory = \Mockery::mock('\Sirius\Forms\WidgetFactory\Base');

        $this->worker = new FormMaker();
    }


    function testProcessTask() {
        $task = new Task($this->widgetFactory, $this->form);
        $this->worker->processTask($task);
        $widget = $task->getResult();

        $this->assertEquals($widget->getAttributes(), $this->form->getAttributes());
        $this->assertEquals($widget->getData(), $this->form->getData());
    }

    function testFormWidgetNotCreatedIfTheTaskHasAlreadyAResult()
    {
        $task = new Task($this->widgetFactory, $this->form);
        $firstWidget = new \Sirius\Forms\Widget\Form();
        $task->setResult($firstWidget);
        $this->worker->processTask($task);
        $widget = $task->getResult();

        $this->assertEquals($firstWidget, $widget);
    }

}
