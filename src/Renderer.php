<?php
namespace Sirius\Forms;

use Sirius\FormsRenderer\Decorator\DecoratorInterface;
use Sirius\FormsRenderer\Form;
use Sirius\FormsRenderer\Html\ExtendedTag;
use Sirius\FormsRenderer\WidgetFactory\Base as BaseFactory;
use Sirius\FormsRenderer\WidgetFactory\Worker\BootstrapStyler;
use Sirius\FormsRenderer\WidgetFactory\Worker\ButtonMaker;
use Sirius\FormsRenderer\WidgetFactory\Worker\ChildrenComposer;
use Sirius\FormsRenderer\WidgetFactory\Worker\ErrorMaker;
use Sirius\FormsRenderer\WidgetFactory\Worker\FormMaker;
use Sirius\FormsRenderer\WidgetFactory\Worker\HintMaker;
use Sirius\FormsRenderer\WidgetFactory\Worker\IdAttributeAttacher;
use Sirius\FormsRenderer\WidgetFactory\Worker\InputMaker;
use Sirius\FormsRenderer\WidgetFactory\Worker\LabelMaker;
use Sirius\FormsRenderer\WidgetFactory\Worker\WidgetMaker;
use Sirius\FormsRenderer\WidgetFactory\Worker\WidgetMissingAlerter;

class Renderer
{

    /**
     *
     * @var \Sirius\FormsRenderer\WidgetFactory\FactoryInterface
     */
    protected $widgetFactory;

    /**
     *
     * @var \Sirius\FormsRenderer\Util\PriorityList
     */
    protected $decoratorsList;

    function __construct(BaseFactory $widgetFactory = null)
    {
        if (!$widgetFactory) {
            $widgetFactory = new BaseFactory();
        }
        $this->widgetFactory = $widgetFactory;
        $this->init();
    }

    function init() {
        $this->widgetFactory->addWorker(new FormMaker(), PHP_INT_MAX - 1000);
        $this->widgetFactory->addWorker(new InputMaker(), PHP_INT_MAX - 1500);
        $this->widgetFactory->addWorker(new ButtonMaker(), PHP_INT_MAX - 1600);
        $this->widgetFactory->addWorker(new LabelMaker(), PHP_INT_MAX - 2000);
        $this->widgetFactory->addWorker(new ErrorMaker(), PHP_INT_MAX - 3000);
        $this->widgetFactory->addWorker(new HintMaker(), PHP_INT_MAX - 4000);
        $this->widgetFactory->addWorker(new ChildrenComposer(), PHP_INT_MAX - 5000);
        $this->widgetFactory->addWorker(new BootstrapStyler());
        $this->widgetFactory->addWorker(new IdAttributeAttacher());
        $this->widgetFactory->addWorker(new WidgetMissingAlerter(), -PHP_INT_MAX + 1000); // close to the bottom
    }

    /**
     *
     * @param Form $form
     * @return Ambigous <\Sirius\FormsRenderer\WidgetFactory\false, \Sirius\Form\Renderer\Widget\WidgetInterface>
     */
    function render(Form $form)
    {
        return $this->getFormWidget($form);
    }

    /**
     * Returns the widget associated with the form
     *
     * @param Form $form
     * @return NULL|\Sirius\FormsRenderer\Html\ExtendedTag
     */
    function getFormWidget(Form $form)
    {
        $widget = $this->widgetFactory->createWidget($form);
        return $widget;
    }

    /**
     * Returns the widget associated with an element from the form
     *
     * @param Form $form
     * @param string $elementName
     * @throws \RuntimeException
     * @return NULL|\Sirius\FormsRenderer\Html\ExtendedTag
     */
    function getElementWidget(Form $form, $elementName)
    {
        $element = $form->get($elementName);
        if (!$element) {
            throw new \RuntimeException(sprintf('Input "%s" is not registered to this form'));
        }
        $widget = $this->widgetFactory->createWidget($form, $element);
        return $widget;
    }
}
