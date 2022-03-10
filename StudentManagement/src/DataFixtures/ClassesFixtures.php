<?php

namespace App\DataFixtures;

use App\Entity\Classes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClassesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $class = new Classes();
            $class->setName("Class $i");
            $class->setSubject("Subject $i");
            $class->setTotalLesson(rand(40, 60));
            $class->setLecturer("Lecture $i");
            $manager->persist($class);
        }
        $manager->flush();
    }
}
