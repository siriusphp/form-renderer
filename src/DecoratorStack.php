<?php
namespace Sirius\FormRenderer;

use \Sirius\Html\Tag;

class DecoratorStack
{

    protected $index = PHP_INT_MAX;

    protected $stack = [];

    /**
     * Add a decorator to the stack
     *
     * @param callable $decorator
     * @param int $priority
     * @return $this
     */
    public function add(callable $decorator, $priority = 0)
    {
        $this->stack[] = array(
            'decorator' => $decorator,
            'priority' => $priority,
            'index' => $this->index
        );
        $this->index--;
        uasort($this->stack, array($this, 'compareStackItems'));

        return $this;
    }

    protected function compareStackItems($a, $b)
    {
        if ($a['priority'] < $b['priority']) {
            return -1;
        } else if ($a['priority'] > $b['priority']) {
            return 1;
        }
        if ($a['index'] < $b['index']) {
            return -1;
        } else if ($a['index'] > $b['index']) {
            return 1;
        }

        return 0;
    }

    /**
     * Apply the decorators to a tag produced by a renderer
     *
     * @param Tag $tag
     * @param Renderer $renderer
     * @return Tag
     */
    public function apply(Tag $tag, Renderer $renderer)
    {
        foreach ($this->stack as $item) {
            $result = $item['decorator']($tag, $renderer);
            // in case a decorator returns something unexpected
            if ($result instanceof Tag) {
                $tag = $result;
            } else {
                trigger_error(sprintf('%s does not return an instance of Sirius\\Html\\Tag',
                    get_class($item['decorator'])), E_USER_WARNING);
            }
        }

        return $tag;
    }

}