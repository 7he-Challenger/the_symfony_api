<?php
/**
 * @author <julienrajerison5@gmail.com>
 */

namespace App\Tests;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EndpointTest extends WebTestCase
{
    private ?string $token = '';
    private $client;

    public function testUserEndpoint()
    {
        $this->getToken();
        $headers = array(
            'HTTP_AUTHORIZATION' => "Bearer {$this->token}",
            'CONTENT_TYPE' => 'application/json',
        );

        // test without token
        $this->client->request('GET', '/api/users', [], []);
        self::assertResponseStatusCodeSame(401);

        // test authorized token
        $this->client->request('GET', '/api/users', [], [], $headers);

        $this->assertResponseIsSuccessful();
    }

    public function testActivityEndpoint()
    {
        $this->getToken();
        $headers = array(
            'HTTP_AUTHORIZATION' => "Bearer {$this->token}",
            'CONTENT_TYPE' => 'application/json',
        );

        // test without token
        $this->client->request('GET', '/api/activities', [], []);
        self::assertResponseStatusCodeSame(401);

        // test authorized token
        $this->client->request('GET', '/api/activities', [], [], $headers);

        $this->assertResponseIsSuccessful();
    }

    public function testPresenceEndpoint()
    {
        $this->getToken();
        $headers = array(
            'HTTP_AUTHORIZATION' => "Bearer $this->token",
            'CONTENT_TYPE' => 'application/json',
        );

        // test without token
        $this->client->request('GET', '/api/presences', [], []);
        self::assertResponseStatusCodeSame(401);

        // test authorized token
        $this->client->request('GET', '/api/presences', [], [], $headers);

        $this->assertResponseIsSuccessful();
    }

    public function getToken(): void
    {
        $this->client = self::createClient();

        // retrieve a token
        $this->client->request(
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

        $data = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertTrue(isset($data['token']));

        $this->token = $data['token'];
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
