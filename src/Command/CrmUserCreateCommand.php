<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Utils\Validator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class CrmUserCreateCommand extends Command
{
    protected static $defaultName = 'crm-user:create';


    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var UserRepository
     */
    private $user;

    /**
     * @var Validator
     */
    private $validator;

    /**
     * CrmUserCreateCommand constructor.
     *
     * @param EntityManagerInterface       $em
     * @param UserPasswordEncoderInterface $encoder
     * @param UserRepository               $user
     * @param Validator                    $validator
     */
    public function __construct(
        EntityManagerInterface $em,
        UserPasswordEncoderInterface $encoder,
        UserRepository $user,
        Validator $validator
    ) {
        parent::__construct();
        $this->entityManager = $em;
        $this->passwordEncoder = $encoder;
        $this->user = $user;
        $this->validator = $validator;
    }

    protected function configure()
    {
        $this
            ->setDescription('Create new user')
            ->addArgument('email', InputArgument::REQUIRED, 'User email')
            ->addArgument('name', InputArgument::REQUIRED, 'User name')
            ->addArgument('lastName', InputArgument::REQUIRED, 'User last name')
            ->addArgument('password', InputArgument::REQUIRED, 'User password')
            ->addOption('roles', null,  InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                'User role',
                ['ROLE_SUPER_ADMIN', 'ROLE_ADMIN']);
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        // SymfonyStyle is an optional feature that Symfony provides so you can
        // apply a consistent look to the commands of your application.
        // See https://symfony.com/doc/current/console/style.html
        $this->io = new SymfonyStyle($input, $output);
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (null !== $input->getArgument('email') &&
            null !== $input->getArgument('name') &&
            null !== $input->getArgument('lastName') &&
            null !== $input->getArgument('password') &&
            null !== $input->getOption('roles')

        ) {
            return;
        }
        $this->io->title('Add User Command Interactive Wizard');
        $this->io->text([
            'If you prefer to not use this interactive wizard, provide the',
            'arguments required by this command as follows:',
            '',
            ' $ php bin/console crm-user:create email, password email@example.com',
            '',
            'Now we\'ll ask you for the value of all the missing command arguments.',
        ]);

        $email = $input->getArgument('email');
        if (null !== $email) {
            $this->io->text(' > <info>Email</info>: '.$email);
        } else {
            $email = $this->io->ask('Email', null, [$this->validator, 'validateEmail']);
            $input->setArgument('email', $email);
        }

        $name = $input->getArgument('name');
        if (null !== $name) {
            $this->io->text(' > <info>Name</info>: '.$name);
        } else {
            $name = $this->io->ask('Name', null, [$this->validator, 'validateName']);
            $input->setArgument('name', $name);
        }

        $lastName = $input->getArgument('lastName');
        if (null !== $lastName) {
            $this->io->text(' > <info>LastName</info>: '.$lastName);
        } else {
            $lastName = $this->io->ask('LastName', null, [$this->validator, 'validateLastName']
            );
            $input->setArgument('lastName', $lastName);
        }

        $password = $input->getArgument('password');
        if (null !== $password) {
            $this->io->text(' > <info>Password</info>: '.('*')(($password)));
        } else {
            $password = $this->io->askHidden('Password (your type will be hidden)',
                [$this->validator, 'validatePassword']);
            $input->setArgument('password', $password);
        }

        $roles = $input->getOption('roles');
        if (null !== $roles) {
           $role = $this->io->choice('Whom role  is', array_values($roles));
            $input->setOption('roles', $role);
        } else {
            $roles = $this->io->ask('roles', null, [$this->validator, 'roles']);
            $input->setOption('roles', $roles);
        }

    }

    /**
     * This method is executed after interact() and initialize(). It usually
     * contains the logic to execute to complete this command task.
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('crm-user:create');
        $email = $input->getArgument('email');
        $name = $input->getArgument('name');
        $lastName = $input->getArgument('lastName');
        $plainPassword = $input->getArgument('password');
        $role = $input->getOption('roles');

        $this->validateUserData($email, $name, $lastName, $plainPassword, $role);

        $user = new User();
        $user->setEmail($email);
        $user->setName($name);
        $user->setLastName($lastName);
        $user->setRoles([$role]);
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $this->io->success(sprintf('%s was successfully created: %s (%s)','User', $user->getUsername(), $user->getEmail()));
        $event = $stopwatch->stop('crm-user:create');
        if ($output->isVerbose()) {
            $this->io->comment(sprintf('New user database id: %d / Elapsed time: %.2f ms / Consumed memory: %.2f MB', $user->getId(), $event->getDuration(), $event->getMemory() / (1024 ** 2)));
        }
        return 0;
    }

    /**
     * @param $email
     * @param $name
     * @param $lastName
     * @param $plainPassword
     * @param $role
     */
    private function validateUserData($email, $name, $lastName, $plainPassword, $role): void
    {

        $existingUser = $this->user->findOneBy(['email' => $email]);
        if (null !== $existingUser) {
            throw new RuntimeException(sprintf('There is already a user registered with the "%s" email.', $email));
        }

        $this->validator->validateEmail($email);
        $this->validator->validateName($name);
        $this->validator->validateLastName($lastName);
        $this->validator->validatePassword($plainPassword);
        $this->validator->validateRole($role);

    }

}