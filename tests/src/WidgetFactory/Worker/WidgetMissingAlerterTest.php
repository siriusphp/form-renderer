<?php

namespace Sirius\FormsRenderer\WidgetFactory\Worker;


use Sirius\FormsRenderer\Form;
use Sirius\FormsRenderer\WidgetFactory\Base;
use Sirius\FormsRenderer\WidgetFactory\Task;

class WidgetMissingAlerterTest extends \PHPUnit_Framework_TestCase
{
    function testExceptionThrownIfTaskDoesNotHaveAResult() {
        $task = new Task(new Base(), new Form());
        $this->setExpectedException('\RuntimeException');
        $worker = new WidgetMissingAlerter();
        $worker->processTask($task);
    }
}
