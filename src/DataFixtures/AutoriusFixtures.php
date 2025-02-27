<?php

namespace App\DataFixtures;

use App\Entity\Autorius;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AutoriusFixtures extends Fixture
{
    const AUTHORS = 10;

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::AUTHORS; $i++) {
            $autorius = new Autorius();
            $autorius->setVardas('autorius ' . $i);
            $this->addReference('autorius' . $i , $autorius);
            $manager->persist($autorius);
        }

        $manager->flush();
    }
}
