<?php

namespace Tests\PickMeUp\Integration\Silex\Exception;

use PickMeUp\Integration\Silex\Exception\MissingParameterException;

class MissingParameterExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function it_is_exception()
    {
        $missingParameterException = new MissingParameterException();
        $this->assertInstanceOf('\Exception', $missingParameterException);
    }
}