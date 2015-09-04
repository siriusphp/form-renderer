<?php
namespace Sirius\FormsRenderer\WidgetFactory\Worker;


use Sirius\FormsRenderer\Widget\Form;
use Sirius\FormsRenderer\WidgetFactory\Task;
use Sirius\FormsRenderer\WidgetFactory\WorkerInterface;

class FormMaker implements WorkerInterface{
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
        $widget = new Form();
        $form = $task->getForm();
        $widget->setAttributes($form->getAttributes());
        $widget->setData($form->getData());
        $task->setResult($widget);
    }


    protected function canHandleTask(Task $task)
    {
        // nobody created the form before and the task is not tied to an element
        return !is_object($task->getResult()) && !$task->getElement();
    }
}
