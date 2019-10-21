<?php
namespace App\EventListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AuthenticationSuccessListener
{

    private $request;
    private $container;

    public function __construct(RequestStack $requestStack, Container $container)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->container = $container;
    }

    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        $data['username'] = $user->getUsername();

        $event->setData($data);

        //
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->container->get('security.token_storage')->setToken($token);

        // If the firewall name is not main, then the set value would be instead:
        // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
        $this->container->get('session')->set('_security_main', serialize($token));
        
        // Fire the login event manually
        // $event = new InteractiveLoginEvent($this->request, $token);
        // $this->request->container->get("event_dispatcher")->dispatch("security.interactive_login", $event);
    }
}