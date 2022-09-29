<?php
namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class UserUnityController extends AbstractController
{

    public function __invoke(UserRepository $user, int $id):User
    {
        return $user->findOneById($id);
    }
}
?>