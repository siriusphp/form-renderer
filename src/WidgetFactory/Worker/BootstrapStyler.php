<?php

namespace Sirius\Forms\WidgetFactory\Worker;

use Sirius\Forms\Widget\Form;
use Sirius\Forms\Widget\Input;
use Sirius\Forms\Widget\Traits\HasChildrenTrait;
use Sirius\Forms\WidgetFactory\Task;
use Sirius\Forms\WidgetFactory\WorkerInterface;

class BootstrapStyler implements WorkerInterface {
    const CONTAINER_CLASS = 'form-group';
    const ERROR_CLASS = 'has-error';
    const HINT_CLASS = 'help-block';
    const INPUT_CLASS = 'form-control';
    const HORIZONTAL_FORM_CLASS = 'form-horizontal';
    const INLINE_FORM_CLASS = 'form-inline';

    /**
     * Process a widget factory task
     *
     * @param Task $task
     */
    function processTask(Task $task)
    {
        $currentResult = $task->getResult();
        if ($currentResult instanceof Form) {
            $this->applyFormStyles($currentResult);
        } else if ($currentResult instanceof Input) {
            $this->applyInputStyles($currentResult);
        }
    }

    protected function applyFormStyles(Form $form) {
        if (!$form->hasClass(static::INLINE_FORM_CLASS) && !$form->hasClass(static::HORIZONTAL_FORM_CLASS)) {
            $form->addClass(static::HORIZONTAL_FORM_CLASS);
        }
    }

    protected function applyInputStyles(Input $widget) {
        $widget->addClass(static::CONTAINER_CLASS);
        if ($widget->getHint()) {
            $widget->getHint()->addClass(static::HINT_CLASS);
        }
        if ($widget->getError()) {
            $widget->addClass(static::ERROR_CLASS);
        }
        if ($widget->getLabel()) {
            $widget->getLabel()->addClass('control-label col-sm-2');
        }
        $widget->getInput()->addClass(static::INPUT_CLASS);
        $widget->getInput()->before('<div class="col-sm-10">');
        if ($widget->getHint() && $widget->getHint()->getText()) {
            $widget->getHint()->after('</div>');
        } else {
            $widget->getInput()->after('</div>');
        }
    }

}
