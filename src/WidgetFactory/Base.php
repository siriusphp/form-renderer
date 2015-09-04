<?php
namespace Sirius\FormsRenderer\WidgetFactory;

use Sirius\FormsRenderer\Element\AbstractElement;
use Sirius\FormsRenderer\Element;
use Sirius\FormsRenderer\Form;
use Sirius\FormsRenderer\Util\PriorityList;

class Base implements FactoryInterface
{

    /**
     *
     * @var PriorityList
     */
    protected $workers;

    function __construct()
    {
        $this->workers = new PriorityList();
    }

    /**
     * Adds a worker on the list of workers that will process tasks
     *
     * @param WorkerInterface $worker
     * @param integer $priority
     * @return self
     */
    function addWorker(WorkerInterface $worker, $priority = 0)
    {
        $this->workers->add($worker, $priority);
        return $this;
    }

    /*
     * (non-PHPdoc) @see \Sirius\FormsRenderer\WidgetFactory\FactoryInterface::createWidget()
     */
    function createWidget(Form $form, Element $element = null)
    {
        $task = $this->createTask($form, $element);
        foreach ($this->workers as $worker) {
            /* @var $worker \Sirius\FormsRenderer\WidgetFactory\WorkerInterface */
            $worker->processTask($task);
        }
        return $task->getResult();
    }

    /**
     * Composes a task that is be passed to workers for processing
     *
     * @param Form $form
     * @param Element $element
     * @return \Sirius\FormsRenderer\WidgetFactory\Task
     */
    protected function createTask(Form $form, Element $element = null)
    {
        return new Task($this, $form, $element);
    }
}
