<?php

namespace Sirius\FormRenderer\Decorator;

use Sirius\FormRenderer\TagDecoratorInterface;
use Sirius\FormRenderer\Renderer;
use Sirius\FormRenderer\Widget\AbstractWidget;
use Sirius\Html\Tag;

/**
 * This is an example of a Decorator which automatically adds the `id` attribute
 * on elements that don't have one already specified
 */
class AutoId implements TagDecoratorInterface
{

    protected $idPrefix = 'f0';

    public function __invoke(Tag $tag, Renderer $renderer)
    {
        if ($tag instanceof AbstractWidget && $tag->getInput()) {
            $this->addInputIdAttribute($tag, $renderer);
            $this->addLabelForAttribute($tag, $renderer);
        }
        return $tag;
    }

    protected function getFormIdPrefix(AbstractWidget $tag, Renderer $renderer)
    {
        $fieldName = $tag->get('_element')->get('name');
        $fieldName = preg_replace('/[^a-zA-Z0-9\{\}]+/', '-', $fieldName);
        $fieldName = trim($fieldName, '-');

        return ($renderer->getOption('id_prefix') ?: 'f0') . '-' . $fieldName;
    }

    protected function addLabelForAttribute(AbstractWidget $tag, Renderer $renderer)
    {
        if (!$tag->getLabel()->get('for')) {
            $tag->getLabel()->set('for', $this->getFormIdPrefix($tag, $renderer));
        }
    }

    protected function addInputIdAttribute(AbstractWidget $tag, Renderer $renderer)
    {
        if (!$tag->getInput()->get('id')) {
            $tag->getInput()->set('for', $this->getFormIdPrefix($tag, $renderer));
        }
    }

}