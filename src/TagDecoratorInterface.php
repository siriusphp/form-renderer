<?php

namespace Sirius\FormRenderer;

use Sirius\Html\Tag;


interface TagDecoratorInterface
{

    /**
     * Modify a tag produced by a renderer
     *
     * @param Tag $tag
     * @param Renderer $renderer
     * @return mixed
     */
    public function __invoke(Tag $tag, Renderer $renderer);
}