<?php

namespace App\EventSubscriber;

use App\Controller\AccessTokenController;
use Firebase\JWT\JWT;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class TokenSubscriber implements EventSubscriberInterface
{
    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        // when a controller class defines multiple action methods, the controller
        // is returned as [$controllerInstance, 'methodName']
        if (is_array($controller)) {
            $controller = $controller[0];
        }

        if ($controller instanceof AccessTokenController) {
            $authorization = $event->getRequest()->headers->get('Authorization');
            $jwt = substr($authorization, 7);
            try {
                $decoded = JWT::decode($jwt, getenv('JWT_SECRET'), ['HS256']);
            } catch (\Exception $e) {
                throw new AccessDeniedHttpException('Whoops! Access denied.');
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
