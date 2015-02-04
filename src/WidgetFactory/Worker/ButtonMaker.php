<?php

namespace Sirius\Forms\WidgetFactory\Worker;


use Sirius\Forms\Html\Button;
use Sirius\Forms\WidgetFactory\Task;
use Sirius\Forms\WidgetFactory\WorkerInterface;

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
        /* @var $element \Sirius\Forms\Element */
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
