<?php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class CsrfSubscriber implements EventSubscriberInterface
{

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }


        /**
         * Put to POST attribute _token value of xcsrf token
         */
        $token = $event->getRequest()->headers->get('X-CSRF-Token');
        if($token){
            if ($event->getRequest()->getMethod() == 'POST'
                && !isset($_POST['_token'])) {
                //$event->getRequest()->attributes->set('_token', $token);
                $event->getRequest()->request->set('_token',$token);
                $_POST['_token'] = $token;
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