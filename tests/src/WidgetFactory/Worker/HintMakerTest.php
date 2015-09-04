<?php
namespace Sirius\FormsRenderer\WidgetFactory\Worker;


use Sirius\FormsRenderer\Element\Input;
use Sirius\FormsRenderer\Form;
use Sirius\FormsRenderer\Html\Text;
use Sirius\FormsRenderer\WidgetFactory\Base;
use Sirius\FormsRenderer\WidgetFactory\Task;

class HintMakerTest  extends \PHPUnit_Framework_TestCase
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
        $this->maker = new HintMaker();
        $this->element = new Input('email', array(
            'hint' => 'Enter your email address where you want to receive notifications',
            'hint_attributes' => array('class' => 'help-block')
        ));
        $this->widget = new \Sirius\FormsRenderer\Widget\Input();
        $this->widget->setInput(new Text());
    }

    function testHintIsAttachedToTaskResult() {
        $task = new Task(new Base(), new Form(), $this->element);
        $task->setResult($this->widget);
        $this->maker->processTask($task);

        $hint = $this->widget->getHint();
        $this->assertEquals($this->element->getHint(), $hint->getText());
        $this->assertEquals($this->element->getHintAttribute('class'), $hint->getAttribute('class'));
    }

}
