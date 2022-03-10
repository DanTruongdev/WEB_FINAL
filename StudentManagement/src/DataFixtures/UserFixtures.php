<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        //Add Admin Account
        $admin = new User();
        $admin->setUsername('Admin');
        $admin->setPassword($this->hasher->hashPassword($admin, "adminPass1"));
        $admin->setRoles(['ROLE_MANAGER']);
        $manager->persist($admin);

        //Add Manager Account
        for ($i = 0; $i <= 4; $i++) {
            $man = new User();
            $man->setUsername("manager$i");
            $man->setPassword($this->hasher->hashPassword($admin, "managerPass$i"));
            $man->setRoles(['ROLE_ADMIN']);
            $manager->persist($man);
        }
        $manager->flush();
    }
}
