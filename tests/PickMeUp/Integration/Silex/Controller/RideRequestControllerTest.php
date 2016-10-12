<?php

namespace Tests\PickMeUp\Integration\Silex\Controller;

use PickMeUp\App\Command\RideRequestCommand;
use PickMeUp\App\CommandHandler\RideRequestHandler;
use PickMeUp\Integration\Silex\Controller\RideRequestController;
use PickMeUp\Integration\Silex\Factory\RideRequestCommandFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RideRequestControllerTest extends \PHPUnit_Framework_TestCase
{
    public function test_ride_request_factory_should_be_called()
    {
        $request = $this->getRequestMockWithInvalidParams();
        $handler = $this->getMockBuilder(RideRequestHandler::class)->disableOriginalConstructor()->getMock();
        $factory = $this->getMockBuilder(RideRequestCommandFactory::class)->disableOriginalConstructor()->getMock();
        $factory->method('create')->willThrowException($this->getMockBuilder('\InvalidArgumentException')->getMock());

        $controller = new RideRequestController($handler, $factory);
        $controller->post($request);
    }

    public function test_it_returns_400_http_code_when_input_request_params_are_not_valid()
    {
        $request = $this->getRequestMockWithInvalidParams();
        $handler = $this->getMockBuilder(RideRequestHandler::class)->disableOriginalConstructor()->getMock();
        $factory = $this->getMockBuilder(RideRequestCommandFactory::class)->disableOriginalConstructor()->getMock();
        $factory->method('create')->willThrowException($this->getMockBuilder('\InvalidArgumentException')->getMock());

        $controller = new RideRequestController($handler, $factory);
        $response = $controller->post($request);
        static::assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function test_ride_request_handler_should_be_called_when_ride_request_is_successfully_created()
    {
        $request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $rideRequest = $this->getMockBuilder(RideRequestCommand::class)->disableOriginalConstructor()->getMock();
        $factory = $this->getMockBuilder(RideRequestCommandFactory::class)->disableOriginalConstructor()->getMock();
        $factory->expects(static::once())->method('create')->willReturn($rideRequest);

        $handler = $this->getMockBuilder(RideRequestHandler::class)->disableOriginalConstructor()->getMock();
        $handler->expects(self::once())->method('handle');

        $controller = new RideRequestController($handler, $factory);
        $controller->post($request);
    }

    public function test_it_returns_200_http_code_when_ride_request_is_successfully_handled()
    {
        $request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $rideRequest = $this->getMockBuilder(RideRequestCommand::class)->disableOriginalConstructor()->getMock();
        $factory = $this->getMockBuilder(RideRequestCommandFactory::class)->disableOriginalConstructor()->getMock();
        $factory->expects(static::once())->method('create')->willReturn($rideRequest);

        $handler = $this->getMockBuilder(RideRequestHandler::class)->disableOriginalConstructor()->getMock();
        $handler->expects(self::once())->method('handle')->with($rideRequest);

        $controller = new RideRequestController($handler, $factory);
        $response = $controller->post($request);
        static::assertSame(Response::HTTP_OK, $response->getStatusCode());
    }

    public function test_it_returns_ride_id_when_ride_request_is_successfully_handled()
    {
        $request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $rideRequest = $this->getMockBuilder(RideRequestCommand::class)->disableOriginalConstructor()->getMock();
        $factory = $this->getMockBuilder(RideRequestCommandFactory::class)->disableOriginalConstructor()->getMock();
        $factory->expects(static::once())->method('create')->willReturn($rideRequest);

        $handler = $this->getMockBuilder(RideRequestHandler::class)->disableOriginalConstructor()->getMock();
        $handler->expects(self::once())->method('handle')->with($rideRequest);

        $controller = new RideRequestController($handler, $factory);
        $response = $controller->post($request);
        $content = json_decode($response->getContent(), true);
        static::assertTrue(isset($content['ride']));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getRequestMockWithInvalidParams()
    {
        $request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $params = [
            RideRequestController::KEY_USER_UUID,
            RideRequestController::KEY_EXPIRATION_MINUTES,
            RideRequestController::KEY_LATITUDE_START,
            RideRequestController::KEY_LONGITUDE_START,
            RideRequestController::KEY_LATITUDE_END,
            RideRequestController::KEY_LONGITUDE_END,
        ];

        foreach ($params as $i => $param) {
            $request->expects(self::at($i))->method('get')->with($param)->willReturn('');
        }

        return $request;
    }
}