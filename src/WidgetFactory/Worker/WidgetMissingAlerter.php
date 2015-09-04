<?php
namespace Sirius\FormsRenderer\WidgetFactory\Worker;


use Sirius\FormsRenderer\WidgetFactory\Task;
use Sirius\FormsRenderer\WidgetFactory\WorkerInterface;

class WidgetMissingAlerter implements WorkerInterface{

    /**
     * Process a widget factory task
     * It will throw an exception if there is no result on the task so it should be put at the bottom of the
     * worker's chain
     *
     * @param Task $task
     * @throws \RuntimeException
     */
    function processTask(Task $task)
    {
        if (!$task->getResult()) {
            throw new \RuntimeException('The widget factory has not produced a result for the task it received');
        }
    }

}
