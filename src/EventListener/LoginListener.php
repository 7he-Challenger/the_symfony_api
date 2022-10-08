<?php
/**
 * @author <julienrajerison5@gmail.com>
 */

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

/**
 * Class LoginListener.
 * This file is part of techzara_platform | all right reserve to the_challengers https://github.com/7he-Challenger
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

        $payload['user'] = ['id' => $user->getId(), 'username' => $user->getUsername(), 'firstname' => $user->getFirstname(), 'lastname' => $user->getLastname()];
        $authenticationSuccessEvent->setData($payload);
    }
}
