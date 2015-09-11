<?php
namespace Sirius\FormRenderer\Widget;

use \Sirius\Input\InputFilter;

abstract class BaseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var InputFilter
     */
    protected $form;

    function setUp()
    {
        $this->form = new InputFilter;
    }

}