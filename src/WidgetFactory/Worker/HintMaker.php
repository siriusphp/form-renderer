<?php
namespace Sirius\FormsRenderer\WidgetFactory\Worker;

use Sirius\FormsRenderer\Html\Div;
use Sirius\FormsRenderer\Widget\Traits\HasHintTrait;
use Sirius\FormsRenderer\WidgetFactory\Task;
use Sirius\FormsRenderer\WidgetFactory\WorkerInterface;

/**
 * This worker attaches a hint HTML tag to the form element
 */
class HintMaker implements WorkerInterface
{

    function processTask(Task $task)
    {
        if (!$this->canHandleTask($task)) {
            return;
        }
        /* @var $element \Sirius\FormsRenderer\Element */
        $element = $task->getElement();
        if (!$element || !$element->getHint()) {
            return;
        }
        $hint = new Div();
        $hint->setAttributes($element->getHintAttributes());
        $hint->setText($element->getHint());
        $task->getResult()->setHint($hint);
    }

    protected function canHandleTask(Task $task)
    {
        return is_object($task->getResult()) && method_exists($task->getResult(), 'setHint');
    }
}
