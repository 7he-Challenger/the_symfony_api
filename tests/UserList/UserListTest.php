<?php
namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserListTest extends KernelTestCase
{
    public function testUserList()
    {
        self::bootKernel();
        $users = self::getContainer()->get(UserRepository::class)->count([]);
        $this->assertEquals(0, $users);
    }
}
?>