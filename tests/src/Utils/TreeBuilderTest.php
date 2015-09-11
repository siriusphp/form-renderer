<?php

namespace Sirius\FormRenderer\Utils;

use Sirius\Input\InputFilter;
use Sirius\Input\Specs;

class TreeBuilderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var InputFilter
     */
    protected $form;


    function setUp()
    {
        $this->form = new InputFilter();
        $this->form->addElement('group_1', [ Specs::TYPE => 'group' ]);
        $this->form->addElement('group_2', [ Specs::TYPE => 'group', Specs::GROUP => 'group_1' ]);
        $this->form->addElement('input_a', [ Specs::TYPE => 'text', Specs::GROUP => 'group_2' ]);
        $this->form->addElement('input_b', [ Specs::TYPE => 'text', Specs::GROUP => 'group_2' ]);
        $this->form->addElement('fieldset', [ Specs::TYPE => 'fieldset', Specs::GROUP => 'group_1' ]);
        $fieldset = $this->form->getElement('fieldset');
        $fieldset->addElement('fieldset_group', [ Specs::TYPE => 'group' ]);
        $fieldset->addElement('fieldset_input_a', [ Specs::TYPE => 'text', Specs::GROUP => 'fieldset_group' ]);
        $fieldset->addElement('fieldset_input_b', [ Specs::TYPE => 'text', Specs::GROUP => 'fieldset_group' ]);
    }

    function testTreeBuilder()
    {
        $treeBuilder = new TreeBuilder($this->form);
        $tree        = $treeBuilder->getTree();

        // tree starts with the form
        $this->assertEquals($this->form, $tree['_form']);
        $this->assertEquals($this->form, $tree['_element']);

        // form has 1 child (group_1)
        $this->assertEquals(1, count($tree['_children']));
        // group_1 has 2 children (group_2 and fieldset)
        $this->assertEquals(2, count($tree['_children']['group_1']['_children']));
        // group_2 has 2 children (input_a and input_b)
        $this->assertEquals(2, count($tree['_children']['group_1']['_children']['group_2']['_children']));

    }

}