<?php

namespace Tests\PickMeUp\Integration\Silex\Controller;

use PickMeUp\App\Command\PickUpRequestCommand;
use PickMeUp\App\Handler\PickUpRequestHandler;
use PickMeUp\Integration\Silex\Controller\PickUpRequestController;
use PickMeUp\Integration\Silex\Factory\PickUpRequestCommandFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PickUpRequestControllerTest extends \PHPUnit_Framework_TestCase
{
    public function test_pick_up_request_factory_should_be_called()
    {
        $request = $this->getRequestMockWithInvalidParams();
        $handler = $this->getMockBuilder(PickUpRequestHandler::class)->disableOriginalConstructor()->getMock();
        $factory = $this->getMockBuilder(PickUpRequestCommandFactory::class)->disableOriginalConstructor()->getMock();
        $factory->method('create')->willThrowException($this->getMockBuilder('\InvalidArgumentException')->getMock());

        $controller = new PickUpRequestController($handler, $factory);
        $controller->post($request);
    }

    public function test_it_returns_400_http_code_when_input_request_params_are_not_valid()
    {
        $request = $this->getRequestMockWithInvalidParams();
        $handler = $this->getMockBuilder(PickUpRequestHandler::class)->disableOriginalConstructor()->getMock();
        $factory = $this->getMockBuilder(PickUpRequestCommandFactory::class)->disableOriginalConstructor()->getMock();
        $factory->method('create')->willThrowException($this->getMockBuilder('\InvalidArgumentException')->getMock());

        $controller = new PickUpRequestController($handler, $factory);
        $response = $controller->post($request);
        static::assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function test_pick_up_request_handler_should_be_called_when_pickuprequest_is_succesfuly_created()
    {
        $request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $pickUpRequest = $this->getMockBuilder(PickUpRequestCommand::class)->disableOriginalConstructor()->getMock();
        $factory = $this->getMockBuilder(PickUpRequestCommandFactory::class)->disableOriginalConstructor()->getMock();
        $factory->expects(static::once())->method('create')->willReturn($pickUpRequest);

        $handler = $this->getMockBuilder(PickUpRequestHandler::class)->disableOriginalConstructor()->getMock();
        $handler->expects(self::once())->method('handle');

        $controller = new PickUpRequestController($handler, $factory);
        $controller->post($request);
    }

    public function test_it_returns_200_http_code_when_pick_up_request_is_successfuly_handled()
    {
        $request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $pickUpRequest = $this->getMockBuilder(PickUpRequestCommand::class)->disableOriginalConstructor()->getMock();
        $factory = $this->getMockBuilder(PickUpRequestCommandFactory::class)->disableOriginalConstructor()->getMock();
        $factory->expects(static::once())->method('create')->willReturn($pickUpRequest);

        $handler = $this->getMockBuilder(PickUpRequestHandler::class)->disableOriginalConstructor()->getMock();
        $handler->expects(self::once())->method('handle')->with($pickUpRequest);

        $controller = new PickUpRequestController($handler, $factory);
        $response = $controller->post($request);
        static::assertSame(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getRequestMockWithInvalidParams()
    {
        $request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $params = [
            PickUpRequestController::KEY_USER_UUID,
            PickUpRequestController::KEY_EXPIRATION_MINUTES,
            PickUpRequestController::KEY_LATITUDE_START,
            PickUpRequestController::KEY_LONGITUDE_START,
            PickUpRequestController::KEY_LATITUDE_END,
            PickUpRequestController::KEY_LONGITUDE_END,
        ];

        foreach ($params as $i => $param) {
            $request->expects(self::at($i))->method('get')->with($param)->willReturn('');
        }

        return $request;
    }
}