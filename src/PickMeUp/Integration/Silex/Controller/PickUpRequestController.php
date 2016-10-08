<?php

namespace PickMeUp\Integration\Silex\Controller;

use PickMeUp\App\Handler\PickUpRequestHandler;
use PickMeUp\Integration\Silex\Factory\PickUpRequestCommandFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PickUpRequestController
{
    const KEY_USER_UUID = 'user_uuid';
    const KEY_EXPIRATION_MINUTES = 'exp_min';

    const KEY_LATITUDE_START  = 'lat_start';
    const KEY_LONGITUDE_START = 'lat_start';

    const KEY_LATITUDE_END    = 'lng_end';
    const KEY_LONGITUDE_END   = 'lng_end';

    /**
     * @var PickUpRequestHandler
     */
    private $handler;

    /**
     * @var PickUpRequestCommandFactory
     */
    private $factory;

    /**
     * PickUpRequestController constructor.
     * @param PickUpRequestHandler $handler
     * @param PickUpRequestCommandFactory $factory
     */
    public function __construct(PickUpRequestHandler $handler, PickUpRequestCommandFactory $factory)
    {
        $this->handler = $handler;
        $this->factory = $factory;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function post(Request $request)
    {
        try {
            $command = $this->factory->create(
                $request->get(PickUpRequestController::KEY_USER_UUID),
                $request->get(PickUpRequestController::KEY_EXPIRATION_MINUTES),
                $request->get(PickUpRequestController::KEY_LATITUDE_START),
                $request->get(PickUpRequestController::KEY_LONGITUDE_START),
                $request->get(PickUpRequestController::KEY_LATITUDE_END),
                $request->get(PickUpRequestController::KEY_LONGITUDE_END)
            );
            $this->handler->handle($command);

            return new Response();
        } catch (\InvalidArgumentException $e) {
            return new Response('', Response::HTTP_BAD_REQUEST);
        }
    }
}