<?php

namespace App\DataFixtures;

use App\Entity\Autorius;
use App\Entity\Knyga;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class KnygaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $knyga = new Knyga();
            $knyga->setPavadinimas('knyga ' . $i);
            $knyga->setIsleidimoMetai(new \DateTime('now'));
            $knyga->setAutorius($this->getReference('autorius' . mt_rand(0, AutoriusFixtures::AUTHORS - 1), Autorius::class));
            $knyga->setIsbn('978-0-07-1626' . 10 + $i . '-5');
            $manager->persist($knyga);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            Autorius::class
        ];
    }
}
