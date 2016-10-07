<?php

namespace Tests\PickMeUp\Core\Model;

use PickMeUp\Core\Model\ExpirationMinutes;

class ExpirationMinutesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider invalidExpirationMinutesProvider
     * @expectedException \InvalidArgumentException
     */
    public function test_it_cannot_be_initialized_when_invalid_expiration_minutes_is_passed($invalidExpirationMinutesValue)
    {
        new ExpirationMinutes($invalidExpirationMinutesValue);
    }

    /**
     * @return array
     */
    public function invalidExpirationMinutesProvider()
    {
        return [
            ["0"],
            [new \StdClass()],
            [new \DateTime()],
            [-10],
            [-0.01],
        ];
    }

    public function test_it_stores_expiration_minutes_value()
    {
        $expirationMinutes = new ExpirationMinutes(10);
        static::assertSame(10, $expirationMinutes->getValue());
    }
}
