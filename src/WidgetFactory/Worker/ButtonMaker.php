<?php

namespace Sirius\FormsRenderer\WidgetFactory\Worker;


use Sirius\FormsRenderer\Html\Button;
use Sirius\FormsRenderer\WidgetFactory\Task;
use Sirius\FormsRenderer\WidgetFactory\WorkerInterface;

class ButtonMaker implements WorkerInterface {

    /**
     * Process a widget factory task
     *
     * @param Task $task
     */
    function processTask(Task $task)
    {
        if (!$this->canHandleTask($task)) {
            return;
        }
        /* @var $element \Sirius\FormsRenderer\Element */
        $element = $task->getElement();
        $button = new Button();
        $button->setAttributes($element->getAttributes());
        $button->setText($element->getLabel());
        $task->setResult($button);
    }

    protected function canHandleTask(Task $task)
    {
        return !is_object($task->getResult()) && $task->getElement() && $task->getElement()->getWidget() == 'button';
    }
}
