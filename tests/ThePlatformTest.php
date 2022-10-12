<?php
/**
 * @author <julienrajerison5@gmail.com>
 */

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ThePlatformTest.
 */
class ThePlatformTest extends WebTestCase
{
    /**
     * Test main route
     */
    public function testHomePage()
    {
        $client = self::createClient();
        $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
