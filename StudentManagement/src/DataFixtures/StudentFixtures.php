<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $student = new Student();
            $student->setName("Student $i");
            $student->setDob(\DateTime::createFromFormat("Y-m-d", "2002-08-11"));
            $student->setAddress("Hanoi");
            $student->setSchoolYear(2020);
            $student->setImage("https://cdn.ila-france.com/wp-content/uploads/2015/02/our-students.jpg");
            $student->setPhone("093457839$i");
            $manager->persist($student);
        }
        $manager->flush();
    }
}
