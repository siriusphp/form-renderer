<?php

namespace Sirius\FormsRenderer\WidgetFactory;

interface WorkerInterface
{

    /**
     * Process a widget factory task
     *
     * @param Task $task
     */
    function processTask(Task $task);
}
