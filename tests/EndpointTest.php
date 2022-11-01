<?php
/**
 * @author <julienrajerison5@gmail.com>
 */

namespace App\Tests;

use App\Entity\User;
use Generator;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class EndpointTest.
 *
 * This class ensure that all HTTP Get will return 200.
 */
class EndpointTest extends WebTestCase
{
    private ?string $token = '';
    private ?KernelBrowser $client = null;

    /**
     * @dataProvider routesProvider
     *
     * @param array $payload
     */
    public function testEndpointGroups(array $payload)
    {
        $method = $payload[0];
        $route = $payload[1];

        // generate client and token
        $this->getToken();

        // test without token
        $this->client->request($method, $route, [], []);
        self::assertResponseStatusCodeSame(401);

        $headers = [
            'HTTP_AUTHORIZATION' => "Bearer $this->token",
            'CONTENT_TYPE' => 'application/json',
        ];

        // test authorized token
        $this->client->request($method, $route, [], [], $headers);
        $this->assertResponseIsSuccessful();
    }

    /**
     * @return Generator
     */
    public function routesProvider(): Generator
    {
        yield [
            ['GET', '/api/presences'],
            ['GET', '/api/activities'],
            ['GET', '/api/certificates'],
            ['GET', '/api/users'],
            ['GET', '/api/media_objects'],
        ];
    }

    public function getToken(): void
    {
        $this->client = self::createClient();
        $this->createUser();

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
