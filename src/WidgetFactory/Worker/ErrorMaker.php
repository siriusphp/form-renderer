<?php
namespace Sirius\FormsRenderer\WidgetFactory\Worker;

use Sirius\FormsRenderer\Html\Div;
use Sirius\FormsRenderer\Widget\Traits\HasErrorTrait;
use Sirius\FormsRenderer\WidgetFactory\Task;
use Sirius\FormsRenderer\WidgetFactory\WorkerInterface;

/**
 * This worker attaches an HTML error tag to the element
 */
class ErrorMaker implements WorkerInterface
{

    function processTask(Task $task)
    {
        if (!$this->canHandleTask($task)) {
            return;
        }
        /* @var $element \Sirius\FormsRenderer\Element */
        $element = $task->getElement();
        $errorMessages = $task->getForm()->getValidator()->getMessages($element->getName());
        if (!$errorMessages) {
            return;
        }
        $error = new Div();
        $error->addClass('error');
        $error->setData('messages', $errorMessages);
        $error->setText(implode('<br>', $errorMessages));
        $task->getResult()->setError($error);
    }

    protected function canHandleTask(Task $task)
    {
        return is_object($task->getResult()) && method_exists($task->getResult(), 'setError');
    }
}
