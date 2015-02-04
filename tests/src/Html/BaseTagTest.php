<?php
namespace Sirius\FormsTest\Html;

use Sirius\Forms\Html\BaseTag;

class BaseTagTest extends \PHPUnit_Framework_TestCase
{

    function setUp()
    {
        $this->element = new BaseTag();
    }

    function testConstructor()
    {
        $element = new BaseTag(
            array(
                'name' => 'email'
            )
        );
        $this->assertEquals('email', $element->getAttribute('name'));
    }

    function testAttributeIsSet()
    {
        $this->element->setAttribute('name', 'email');
        $this->assertEquals('email', $this->element->getAttribute('name'));
    }

    function testAttributeListIsRetrieved()
    {
        $attrs = array(
            'name' => 'email',
            'value' => 'me@domain.com',
            'id' => 'form-email'
        );
        $this->element->setAttributes($attrs);
        $this->assertEquals(
            array(
                'name' => 'email',
                'value' => 'me@domain.com'
            ),
            $this->element->getAttributes(
                array(
                    'name',
                    'value'
                )
            )
        );
    }

    function testAllAttributesAreRetrieved()
    {
        $attrs = array(
            'name' => 'email',
            'value' => 'me@domain.com'
        );
        $this->element->setAttributes($attrs);
        $this->assertEquals($attrs, $this->element->getAttributes());
    }

    function testAttributeIsUnset()
    {
        $attrs = array(
            'name' => 'email',
            'value' => 'me@domain.com'
        );
        $this->element->setAttributes($attrs);
        $this->element->setAttribute('value', null);
        $this->assertEquals(
            array(
                'name' => 'email'
            ),
            $this->element->getAttributes()
        );
    }

    function testAddClass()
    {
        $this->element->addClass('active');
        $this->assertEquals('active', $this->element->getAttribute('class'));

        $this->element->addClass('disabled');
        $this->assertEquals('active disabled', $this->element->getAttribute('class'));
    }

    function testHasClass()
    {
        $this->element->setAttribute('class', 'active disabled even');
        $this->assertTrue($this->element->hasClass('active'));
        $this->assertTrue($this->element->hasClass('disabled'));
        $this->assertTrue($this->element->hasClass('even'));
        $this->assertFalse($this->element->hasClass('xdisabled'));
    }

    function testRemoveClass()
    {
        $this->element->setAttribute('class', 'active disabled even');
        $this->element->removeClass('disabled');
        $this->assertFalse($this->element->hasClass('disabled'));
    }

    function testToggleClass()
    {
        $this->assertFalse($this->element->hasClass('active'));
        $this->element->toggleClass('active');
        $this->assertTrue($this->element->hasClass('active'));
        $this->element->toggleClass('active');
        $this->assertFalse($this->element->hasClass('active'));
    }

    function testTextIsSet()
    {
        $this->assertNull($this->element->getText());
        $this->element->setText('cool');
        $this->assertEquals('cool', $this->element->getText());
    }

    function testDataIsSet()
    {
        // no data at the begining
        $this->assertEquals(array(), $this->element->getData());
        $this->element->setData('string', 'cool');
        $this->assertEquals('cool', $this->element->getData('string'));
    }

    function testDataIsUnset()
    {
        $this->element->setData('string', 'cool');
        $this->element->setData('string', null);
        $this->assertNull($this->element->getData('string'));
    }

    function testBulkDataIsSet()
    {
        $data = array(
            'k1' => 'v1',
            'k2' => 'v2'
        );
        $this->element->setData($data);
        $this->assertEquals($data, $this->element->getData());
    }

    function testDataListIsRetrieved()
    {
        $data = array(
            'k1' => 'v1',
            'k2' => 'v2',
            'k3' => 'v3'
        );
        $this->element->setData($data);
        $this->assertEquals(
            array(
                'k1' => 'v1',
                'k3' => 'v3',
                'k4' => null
            ),
            $this->element->getData(
                array(
                    'k1',
                    'k3',
                    'k4'
                )
            )
        );
    }

}
