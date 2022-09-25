<?php
/**
 * @author <julienrajerison5@gmail.com>
 */

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ThePlatformTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = self::createClient();
        $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
