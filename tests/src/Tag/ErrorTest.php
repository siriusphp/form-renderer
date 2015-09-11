<?php

namespace Sirius\FormRenderer\Tag;

class ErrorTest extends \PHPUnit_Framework_TestCase
{

    function testHasClassError()
    {
        $error = new Error;
        $this->assertTrue(false !== strpos($error->render(), ' class="error"'));
    }

}