<?php

namespace Tests\PickMeUp\AppG\Handler;

use PickMeUp\App\Command\PickUpRequestCommand;
use PickMeUp\App\DAL\Ride\Storage;
use PickMeUp\App\Factory\RideFactory;
use PickMeUp\App\Handler\PickUpRequestHandler;
use PickMeUp\App\Model\Ride;

class PickUpRequestHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_saves_user_pick_up_request_in_storage()
    {
        $pickUpRequest = $this->getMockBuilder(PickUpRequestCommand::class)->disableOriginalConstructor()->getMock();

        $ride = $this->getMockBuilder(Ride::class)->disableOriginalConstructor()->getMock();

        $factory = $this->getMockBuilder(RideFactory::class)->getMock();
        $factory->expects(self::once())->method('createFromPickUpRequestCommand')->with($pickUpRequest)->willReturn($ride);

        $storage = $this->getMockBuilder(Storage::class)->disableOriginalConstructor()->getMock();
        $storage->expects(self::once())->method('save')->with($ride);

        $handler = new PickUpRequestHandler($storage, $factory);
        $handler->handle($pickUpRequest);
    }
}