<?php

namespace Tests\PickMeUp\App\Command;

use PickMeUp\App\Command\RideExpireCommand;
use PickMeUp\App\Model\RideId;
use PickMeUp\CQRS\Command\Command;

class RideExpireCommandTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_instance_of_command()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        $command = new RideExpireCommand($rideId);
        static::assertInstanceOf(Command::class, $command);
    }

    public function test_it_stores_ride_id()
    {
        $rideId = $this->getMockBuilder(RideId::class)->disableOriginalConstructor()->getMock();
        $command = new RideExpireCommand($rideId);
        static::assertSame($rideId, $command->getRideId());
    }
}
