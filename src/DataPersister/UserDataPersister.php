<?php
/**
 * @author <julienrajerison5@gmail.com>/**
 *
 * This file is part of techzara_platform | all right reserve to the_challengers https://github.com/7he-Challenger
 */

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserDataPersister.
 */
class UserDataPersister implements DataPersisterInterface
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->entityManager = $entityManager;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function supports($data): bool
    {
        return $data instanceof User;
    }

    public function persist($data)
    {
        if ($data->getPlainPassword()) {
            $data->setPassword($this->userPasswordHasher->hashPassword($data, $data->getPlainPassword()));
            $data->eraseCredentials();
        }

        $this->updateRole($data);
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data)
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }

    public function updateRole($data)
    {
        if ($data instanceof User && $data->getRoleInt()){
            if (1 === $data->getRoleInt()){
                $data->setRoles(['ROLE_MEMBER']);
            }

            if (32 === $data->getRoleInt()){
                $data->setRoles(['ROLE_ADMIN']);
            }
        }
    }
}
