<?php
/**
 * @author <julienrajerison5@gmail.com>
 *
 * This file is part of techzara_platform | all right reserve to the_challengers https://github.com/7he-Challenger
 */
declare(strict_types=1);

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserCommand.
 */
class UserCommand extends Command
{
    protected static $defaultName = 'the:user';
    private UserPasswordHasherInterface $passwordHasherEncoder;
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface      $entityManager
     * @param UserPasswordHasherInterface $passwordHasherEncoder
     * @param string|null                 $name
     */
    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasherEncoder, string $name = null)
    {
        parent::__construct($name);
        $this->passwordHasherEncoder = $passwordHasherEncoder;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->addOption('default', null, InputOption::VALUE_NONE, 'Create default user');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $symfonyStyle = new SymfonyStyle($input, $output);
        $symfonyStyle->note("Create user test");
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => 'test'])? : new User();
        $password = $this->passwordHasherEncoder->hashPassword($user, '123456');
        $user->setUsername('test');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $symfonyStyle->note("Create user test");

        exit(0);
    }
}
