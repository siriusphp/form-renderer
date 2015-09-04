<?php
namespace Sirius\FormsRenderer\Widget;

use Sirius\FormsRenderer\Html\ExtendedTag;
use Sirius\FormsRenderer\Widget\Traits\HasErrorTrait;
use Sirius\FormsRenderer\Widget\Traits\HasHintTrait;
use Sirius\FormsRenderer\Widget\Traits\HasInputTrait;
use Sirius\FormsRenderer\Widget\Traits\HasLabelTrait;
use Sirius\FormsRenderer\Widget\Traits\HasValueTrait;

class Input extends ExtendedTag
{
    use HasLabelTrait;
    use HasHintTrait;
    use HasErrorTrait;
    use HasInputTrait;
    use HasValueTrait;

    function render()
    {
        $error = $this->getError() && $this->getError()->getText() ? $this->getError() : '';
        $label = $this->getLabel() && $this->getLabel()->getText() ? $this->getLabel() : '';
        $hint = $this->getHint() && $this->getHint()->getText() ? $this->getHint() : '';
        $input = $this->getInput();
        $input->setValue($this->getRawValue());
        $this->setText("{$error}{$label}{$input}{$hint}");
        return parent::render();
    }
}
