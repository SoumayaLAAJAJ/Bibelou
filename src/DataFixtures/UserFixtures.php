<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class UserFixtures extends Fixture
{
    // PROPRIETES
    private $encoder;

    // CONSTRUCTEURS
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->encoder = $userPasswordHasherInterface;
    }

    // METHODES
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstname("Soum");
        $user->setName("Ljj");
        $user->setEmail("souyaya19@hotmail.fr");
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $password = $this->encoder->hashPassword($user, "admin");
        $user->setPassword($password);
        $user->setIsVerified(true);
        $manager->persist($user);

        // 

        $user = new User();
        $user->setFirstname("Jean");
        $user->setName("Neymar");
        $user->setEmail("test@test.fr");
        $user->setRoles(["ROLE_USER"]);
        $password = $this->encoder->hashPassword($user, "admin");
        $user->setPassword($password);
        $user->setIsVerified(true);
        $manager->persist($user);

        $manager->flush();
    }
}
