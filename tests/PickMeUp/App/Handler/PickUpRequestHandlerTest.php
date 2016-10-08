<?php

namespace Tests\PickMeUp\App\Handler;

use PickMeUp\App\Command\PickUpRequest;
use PickMeUp\App\DAL\PickUpRequest\Storage;
use PickMeUp\App\Handler\PickUpRequestHandler;

class PickUpRequestHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_saves_user_pick_up_request_in_storage()
    {
        $pickUpRequest = self::getMockBuilder(PickUpRequest::class)->disableOriginalConstructor()->getMock();
        $storage = self::getMockBuilder(Storage::class)->disableOriginalConstructor()->getMock();
        $storage->expects(self::once())->method('save')->with($pickUpRequest);

        $handler = new PickUpRequestHandler($storage);
        $handler->handle($pickUpRequest);
    }
}