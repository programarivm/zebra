<?php

namespace App\EventSubscriber;

use App\Controller\AccessTokenController;
use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\JWT;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class TokenSubscriber implements EventSubscriberInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        // when a controller class defines multiple action methods, the controller
        // is returned as [$controllerInstance, 'methodName']
        if (is_array($controller)) {
            $controller = $controller[0];
        }

        if ($controller instanceof AccessTokenController) {
            $jwt = substr($event->getRequest()->headers->get('Authorization'), 7);

            try {
                $decoded = JWT::decode($jwt, getenv('JWT_SECRET'), ['HS256']);
            } catch (\Exception $e) {
                throw new AccessDeniedHttpException('Whoops! Access denied.');
            }

            $user = $this->em->getRepository('App:User')
                        ->findOneBy(['id' => $decoded->sub]);

            $identity = $this->em->getRepository('EasyAclBundle:Identity')
                            ->findBy(['user' => $user]);

            $rolename = $identity[0]->getRole()->getName();
            $routename = $event->getRequest()->get('_route');

            $isAllowed = $this->em->getRepository('EasyAclBundle:Permission')
                            ->isAllowed($rolename, $routename);

            if (!$isAllowed) {
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
