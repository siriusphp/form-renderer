<?php
namespace Sirius\FormsRenderer\WidgetFactory\Worker;

use Sirius\FormsRenderer\Element\Fieldset;
use Sirius\FormsRenderer\Html\Label;
use Sirius\FormsRenderer\Html\ExtendedTag;
use Sirius\FormsRenderer\Widget\Traits\HasLabelTrait;
use Sirius\FormsRenderer\WidgetFactory\Task;
use Sirius\FormsRenderer\WidgetFactory\WorkerInterface;

/**
 * This worker attaches a label HTML tag to the widget
 */
class LabelMaker implements WorkerInterface
{

    function processTask(Task $task)
    {
        if (!$this->canHandleTask($task)) {
            return;
        }
        /* @var $element \Sirius\FormsRenderer\Element */
        $element = $task->getElement();
        if (!$element->getLabel()) {
            return;
        }
        $label = new Label();
        // for fieldsets we need a LEGEND attribute
        if ($element instanceof Fieldset) {
            $label = ExtendedTag::create(array(), 'legend', false);
        }
        $label->setAttributes($element->getLabelAttributes());
        $label->setText($element->getLabel());
        $task->getResult()->setLabel($label);
    }

    protected function canHandleTask(Task $task)
    {
        return is_object($task->getResult()) && method_exists($task->getResult(), 'setLabel');
    }
}
