<?php
/**
 * @author <julienrajerison5@gmail.com>
 */

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Registration;
use Doctrine\ORM\EntityManagerInterface;

class RegistrationDataPersister implements DataPersisterInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports($data): bool
    {
        return $data instanceof Registration;
    }

    /**
     * @param Registration $data
     *
     * @return void
     */
    public function persist($data)
    {
        if ($data->getEvent()) {
            $data->getEvent()->decreaseSeats();
        }
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data)
    {
        if ($data->getEvent()) {
            $data->getEvent()->increaseSeats();
        }

        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}
