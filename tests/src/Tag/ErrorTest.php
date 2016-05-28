<?php

namespace Sirius\FormRenderer\Tag;

use Sirius\FormRenderer\Renderer;

class ErrorTest extends \PHPUnit_Framework_TestCase
{

    function testHasClassError()
    {
        $error = new Error([], null, new Renderer());
        $this->assertTrue(false !== strpos($error->render(), ' class="error"'));
    }

}