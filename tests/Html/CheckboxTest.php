<?php
namespace Sirius\FormsTest\Renderer\Widget;

use Sirius\Forms\Html\Checkbox;

class CheckboxTest extends \PHPUnit_Framework_TestCase
{

    function setUp()
    {
        $this->input = new Checkbox(
            array(
                'name' => 'agree_to_terms',
                'attrs' => array(
                    'value' => 'yes'
                ),
                'value' => 'yes'
            )
        );
    }

    function testRender()
    {
        $this->assertEquals(
            '<input checked="checked" name="agree_to_terms" type="checkbox" value="yes">',
            (string)$this->input
        );

        // change value
        $this->input->setValue('no');
        $this->assertEquals('<input name="agree_to_terms" type="checkbox" value="yes">', (string)$this->input);
    }

    function testMultipleValues()
    {
        $this->input->setValue(
            array(
                'yes',
                'maybe'
            )
        );
        $this->assertEquals(
            '<input checked="checked" name="agree_to_terms" type="checkbox" value="yes">',
            (string)$this->input
        );

        $this->input->setValue(
            array(
                'no',
                'maybe'
            )
        );
        $this->assertEquals('<input name="agree_to_terms" type="checkbox" value="yes">', (string)$this->input);
    }
}
