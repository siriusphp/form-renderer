<?php
namespace Sirius\FormsRenderer\WidgetFactory\Worker;


use Sirius\FormsRenderer\Element\Input;
use Sirius\FormsRenderer\Form;
use Sirius\FormsRenderer\Html\Text;
use Sirius\FormsRenderer\WidgetFactory\Base;
use Sirius\FormsRenderer\WidgetFactory\Task;

class LabelMakerTest  extends \PHPUnit_Framework_TestCase
{

    /**
     * @var LabelMaker
     */
    protected $maker;

    /**
     * @var \Sirius\FormsRenderer\Widget\Input
     */
    protected $widget;

    /**
     * @var \Sirius\FormsRenderer\Element\Input
     */
    protected $element;

    function setUp() {
        $this->maker = new LabelMaker();
        $this->element = new Input('email', array(
            'label' => 'Your email',
            'label_attributes' => array('class' => 'required', 'for' => 'email')
        ));
        $this->widget = new \Sirius\FormsRenderer\Widget\Input();
        $this->widget->setInput(new Text());
    }

    function testLabelIsAttachedToTaskResult() {
        $task = new Task(new Base(), new Form(), $this->element);
        $task->setResult($this->widget);
        $this->maker->processTask($task);

        $label = $this->widget->getLabel();
        $this->assertEquals($this->element->getLabel(), $label->getText());
        $this->assertEquals($this->element->getLabelAttribute('class'), $label->getAttribute('class'));
        $this->assertEquals($this->element->getLabelAttribute('for'), $label->getAttribute('for'));
    }

}
