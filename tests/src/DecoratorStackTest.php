<?php

namespace Sirius\FormRenderer;

use Sirius\FormRenderer\Tag\Label;
use Sirius\Html\Tag;

class DecoratorA implements TagDecoratorInterface
{

    public function __invoke(Tag $tag, Renderer $renderer)
    {
        $tag->before('A');

        return $tag;
    }

}

class DecoratorB implements TagDecoratorInterface
{

    public function __invoke(Tag $tag, Renderer $renderer)
    {
        $tag->before('B');

        return $tag;
    }

}

class DecoratorC implements TagDecoratorInterface
{

    public function __invoke(Tag $tag, Renderer $renderer)
    {
        $tag->before('C');

        return $tag;
    }

}


class DecoratorStackTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var DecoratorStack;
     */
    protected $stack;

    function setUp()
    {
        $this->stack = new DecoratorStack();
    }

    function testDefaultDecoratorOrder()
    {
        // if the decorators have the same priority
        // the first one applied is the first added
        $this->stack->add(new DecoratorA, 10);
        $this->stack->add(new DecoratorB, 10);

        $tag = new Label();
        $tag = $this->stack->apply($tag, new Renderer());

        $this->assertTrue(false !== strpos($tag, "A" . PHP_EOL . "B"));
    }

    function testDecoratorOrder()
    {
        $this->stack->add(new DecoratorA, 10);
        $this->stack->add(new DecoratorB, 0);
        $this->stack->add(new DecoratorC, 20);

        $tag = new Label();
        $tag = $this->stack->apply($tag, new Renderer());

        $this->assertTrue(false !== strpos($tag, "C" . PHP_EOL . "A" . PHP_EOL . "B"));
    }
}