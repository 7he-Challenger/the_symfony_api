<?php
/**
 * @author <julienrajerison5@gmail.com>
 */

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

/**
 * Class LoginListener.
 */
class LoginListener
{
    /**
     * @param AuthenticationSuccessEvent $authenticationSuccessEvent
     */
    public function onLoginSuccess(AuthenticationSuccessEvent $authenticationSuccessEvent)
    {
        $user = $authenticationSuccessEvent->getUser();
        $payload = $authenticationSuccessEvent->getData();

        if (!$user instanceof User) {
            return;
        }

        $payload['user'] = ['id' => $user->getId(), 'username' => $user->getUsername()];
        $authenticationSuccessEvent->setData($payload);
    }
}
