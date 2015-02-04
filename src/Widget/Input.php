<?php
namespace Sirius\Forms\Widget;

use Sirius\Forms\Html\ExtendedTag;
use Sirius\Forms\Widget\Traits\HasErrorTrait;
use Sirius\Forms\Widget\Traits\HasHintTrait;
use Sirius\Forms\Widget\Traits\HasInputTrait;
use Sirius\Forms\Widget\Traits\HasLabelTrait;
use Sirius\Forms\Widget\Traits\HasValueTrait;

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
