<?php

namespace Sirius\FormRenderer;

use Sirius\FormRenderer\Utils\TreeBuilder;
use Sirius\Html\Builder;
use Sirius\Input\InputFilter;

class Renderer extends Builder
{

    /**
     * @var DecoratorStack
     */
    private $decorators;

    /**
     * @param array $options
     */
    public function __construct($options = array())
    {
        parent::__construct($options);
        $this->decorators = new DecoratorStack();
        $this->registerTags();
        $this->registerDecorators();
    }

    /**
     * Registers a list of default tags to be used by the renderer
     */
    protected function registerTags()
    {
        // register the "normal" tags, ie tags that are not form controls (widgets, see below)
        $tags = array('error', 'hint', 'label', 'radioset', 'checkboxset');
        foreach ($tags as $tag) {
            $tagClass = str_replace(' ', '', ucwords(str_replace('-', ' ', $tag)));
            $this->registerTag($tag, __NAMESPACE__ . '\Tag\\' . $tagClass);
        }

        // register the "widget" tags, ie tags that are inputs
        $widgets = array(
            'text',
            'file',
            'textarea',
            'radio',
            'checkbox',
            'select',
            'multiselect',
            'checkboxset',
            'radioset',
            'email',
            'password',
            'radioset',
            'checkboxset',
            // buttons
            'button',
            'submit',
            'reset',
            // containers
            'group',
            'fieldset',
            'collection',
            'form'
        );
        foreach ($widgets as $widget) {
            $widgetClass = str_replace(' ', '', ucwords(str_replace('-', ' ', $widget)));
            $this->registerTag('widget-' . $widget, __NAMESPACE__ . '\Widget\\' . $widgetClass);
        }
    }

    /**
     * Adds a list of default decorators to the stack
     *
     */
    protected function registerDecorators()
    {
        $decorators = array('AutoId');
        foreach ($decorators as $decoratorClass) {
            $decoratorClass = '\\Sirius\FormRenderer\\Decorator\\' . $decoratorClass;
            $this->addDecorator(new $decoratorClass);
        }
    }

    /**
     * Add a tag decorator to the stack
     *
     * @param TagDecoratorInterface $decorator
     * @param int $priority
     *
     * @return self
     */
    public function addDecorator(TagDecoratorInterface $decorator, $priority = 0)
    {
        $this->decorators->add($decorator, $priority);
        return $this;
    }

    /**
     * Returns a Tag object
     *
     * @param string $tag
     * @param null|array $props
     * @param null|array $content
     * @return \Sirius\Html\Tag|string
     */
    public function make($tag, $props = null, $content = null)
    {
        $tag = parent::make($tag, $props, $content);
        $tag = $this->decorators->apply($tag, $this);

        return $tag;
    }

    /**
     * Renders a complete InputFilter object into a form
     * @param InputFilter $inputFilter
     * @return \Sirius\Html\Tag|string
     */
    public function render(InputFilter $inputFilter)
    {
        $inputFilter->prepare(); // ensure it is prepare
        $props = $inputFilter->getAttributes();
        $treeBuilder = new TreeBuilder($inputFilter);
        $props = array_merge($props, $treeBuilder->getTree());

        return $this->make('widget-form', $props);
    }

}