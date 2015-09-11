<?php

namespace Sirius\FormRenderer;

use Sirius\Html\Tag;


abstract class AbstractDecorator
{

    abstract function __invoke(Tag $tag, Renderer $renderer);
}