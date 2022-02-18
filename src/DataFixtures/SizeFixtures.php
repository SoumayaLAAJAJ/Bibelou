<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{
    // ______________
    // PROPRIETES   
    // ______________
    public const XXS = "XXS";
    public const XS = "XS";
    public const S = "S";
    public const M = "M";
    public const L = "L";
    public const XL = "XL";
    public const XXL = "2XL";
    public const XXXL = "3XL";


    // ______________
    // METHODES
    // ______________
    public function load(ObjectManager $manager): void
    {
        $size = new Size();
        $size->setName("XXS");
        $manager->persist($size);
        $this->addReference(self::XXS, $size);

        $size = new Size();
        $size->setName("XS");
        $manager->persist($size);
        $this->addReference(self::XS, $size);

        $size = new Size();
        $size->setName("S");
        $manager->persist($size);
        $this->addReference(self::S, $size);


        $size = new Size();
        $size->setName("M");
        $manager->persist($size);
        $this->addReference(self::M, $size);


        $size = new Size();
        $size->setName("L");
        $manager->persist($size);
        $this->addReference(self::L, $size);


        $size = new Size();
        $size->setName("XL");
        $manager->persist($size);
        $this->addReference(self::XL, $size);


        $size = new Size();
        $size->setName("2XL");
        $manager->persist($size);
        $this->addReference(self::XXL, $size);


        $size = new Size();
        $size->setName("3XL");
        $manager->persist($size);
        $this->addReference(self::XXXL, $size);


        $manager->flush();
    }
}
