<?php

namespace Sirius\FormRenderer\Widget;

use Sirius\Input\InputFilter;
use Sirius\Input\Specs;

class FieldsetTest extends BaseTest
{

    /**
     * @var Text
     */
    protected $widget;

    function setUp()
    {
        parent::setUp();
        $this->form->addElement('address', [
            Specs::TYPE  => 'fieldset',
            Specs::LABEL => 'Address'
        ]);
        $address = $this->form->getElement('address');
        $address->addElement('city_zip', [
            Specs::TYPE => 'group'
        ]);
        $address->addElement('street', [
            Specs::WIDGET     => 'text',
            Specs::LABEL      => 'Address',
            Specs::VALIDATION => [ 'required' ]
        ]);
        $address->addElement('city', [
            Specs::WIDGET     => 'text',
            Specs::LABEL      => 'City',
            Specs::VALIDATION => [ 'required' ],
            Specs::GROUP      => 'city_zip'
        ]);
        $address->addElement('zip', [
            Specs::WIDGET     => 'text',
            Specs::LABEL      => 'Zip code',
            Specs::VALIDATION => [ 'required' ],
            Specs::GROUP      => 'city_zip'
        ]);

        $this->form->populate(array(
            'address' => [
                'street' => 'street'
            ]
        ));

        $this->form->isValid();

        $this->widget = new Fieldset([
            '_form'    => $this->form,
            '_element' => $this->form->getElement('address')
        ]);
    }

    function testLegendPresent()
    {
        $this->assertTrue(false !== strpos($this->widget->render(), '<legend'));
    }

    function testInputPresent()
    {
        $this->assertEquals(3, substr_count($this->widget->render(), 'type="text"'));
        $this->assertEquals(3, substr_count($this->widget->render(), 'name="address['));
    }

    function testFieldValues()
    {
        // only the street field has a value
        $this->assertEquals(1, substr_count($this->widget->render(), 'value="street"'));
    }

    function testErrorMessages()
    {
        // city and zip_code are required
        $this->assertEquals(2, substr_count($this->widget->render(), 'class="error"'));
    }
}