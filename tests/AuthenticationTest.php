<?php
/**
 * @author <julienrajerison5@gmail.com>
 */

namespace App\Tests;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticationTest extends WebTestCase
{
    public function testTokenGenerator(): void
    {
        $client = self::createClient();

        // retrieve a token
        $client->request(
            'POST',
            '/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'username' => 'test@techzara.org',
                'password' => '$3CR3T',
            ])
        );

        $this->assertResponseIsSuccessful();
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertTrue(isset($data['token']));
    }

    public function createUser()
    {
        $container = self::getContainer();
        $user = $container->get('doctrine')->getRepository(User::class)->findOneBy(['username' => 'test@techzara.org']) ?? new User();
        $user->setUsername('test@techzara.org');
        $user->setPassword(
            $container->get('security.user_password_hasher')->hashPassword($user, '$3CR3T')
        );
        $user->setRoles(['ROLE_ADMIN']);

        $manager = $container->get('doctrine')->getManager();
        $manager->persist($user);
        $manager->flush();
    }
}
