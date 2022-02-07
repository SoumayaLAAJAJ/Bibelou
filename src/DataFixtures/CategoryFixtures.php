<?php

namespace App\DataFixtures;

use App\Entity\Category;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    // ______________
    // PROPRIETES   
    // ______________
    public const CATEGORY_HAUT = "category-hauts-vestes";
    public const CATEGORY_PANT = "category-pantalons-shorts";
    public const CATEGORY_JUPE = "category-jupes-robes";
    public const ACC = "category-accessoires";
    // ______________
    // METHODES
    // ______________
    public function load(ObjectManager $manager): void
    {
        $cat = new Category();
        $cat->setName("Hauts et Vestes");
        $cat->setSlug("HautsEtVestes");
        $cat->setUpdatedAt(new DateTimeImmutable());
        $manager->persist($cat);
        $this->addReference(self::CATEGORY_HAUT, $cat);

        $cat = new Category();
        $cat->setName("Pantalons et Shorts");
        $cat->setSlug("PantalonsEtShorts");
        $cat->setUpdatedAt(new DateTimeImmutable());
        $manager->persist($cat);
        $this->addReference(self::CATEGORY_PANT, $cat);

        $cat = new Category();
        $cat->setName("Jupes et Robes");
        $cat->setSlug("JupesEtRobes");
        $cat->setUpdatedAt(new DateTimeImmutable());
        $manager->persist($cat);
        $this->addReference(self::CATEGORY_JUPE, $cat);

        $cat = new Category();
        $cat->setName("Accessoires");
        $cat->setSlug("Accessoires");
        $cat->setUpdatedAt(new DateTimeImmutable());
        $manager->persist($cat);
        $this->addReference(self::ACC, $cat);


        $manager->flush();
    }
}
