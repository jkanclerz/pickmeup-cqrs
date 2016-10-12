<?php

namespace PickMeUp\Integration\Silex\Controller;

use PickMeUp\App\CommandHandler\RideRequestHandler;
use PickMeUp\App\Model\RideId;
use PickMeUp\Integration\Silex\Factory\RideRequestCommandFactory;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RideRequestController
{
    const KEY_USER_UUID = 'user_uuid';
    const KEY_EXPIRATION_MINUTES = 'exp_min';

    const KEY_LATITUDE_START  = 'lat_start';
    const KEY_LONGITUDE_START = 'lat_start';

    const KEY_LATITUDE_END    = 'lng_end';
    const KEY_LONGITUDE_END   = 'lng_end';

    /**
     * @var RideRequestHandler
     */
    private $handler;

    /**
     * @var RideRequestCommandFactory
     */
    private $factory;

    /**
     * RideRequestController constructor.
     * @param RideRequestHandler $handler
     * @param RideRequestCommandFactory $factory
     */
    public function __construct(RideRequestHandler $handler, RideRequestCommandFactory $factory)
    {
        $this->handler = $handler;
        $this->factory = $factory;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function post(Request $request)
    {
        try {
            $rideId = new RideId(Uuid::uuid4());
            $command = $this->factory->create(
                $rideId,
                $request->get(RideRequestController::KEY_USER_UUID),
                $request->get(RideRequestController::KEY_EXPIRATION_MINUTES),
                $request->get(RideRequestController::KEY_LATITUDE_START),
                $request->get(RideRequestController::KEY_LONGITUDE_START),
                $request->get(RideRequestController::KEY_LATITUDE_END),
                $request->get(RideRequestController::KEY_LONGITUDE_END)
            );
            $this->handler->handle($command);

            return new JsonResponse(['ride' => $rideId->getUuid()]);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        }
    }
}