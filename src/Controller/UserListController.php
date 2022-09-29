<?php
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class UserListController extends AbstractController 
{

    public function __invoke(UserRepository $users):array
    {
        return $users->findAll();
    }
}
?>