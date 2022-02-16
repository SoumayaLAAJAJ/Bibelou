<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Carousel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CarouselFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $carousel = new Carousel();
        $carousel->setImageName("hands.png");
        $carousel->setUpdatedAt(new DateTimeImmutable());
        $carousel->setTitle("Bienvenu.e.s sur Bibelou");
        $carousel->setTexte("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vestibulum mauris ut diam vulputate, nec scelerisque magna maximus. Suspendisse sit amet ex vestibulum, semper nunc quis, consequat arcu. a aliquam.");
        $manager->persist($carousel);

        $carousel = new Carousel();
        $carousel->setImageName("hands2.png");
        $carousel->setUpdatedAt(new DateTimeImmutable());
        $carousel->setTitle("Qu'est-ce que le upcycling ?");
        $carousel->setTexte("Lorem ipsum dolor sit amet, magna maximus. Suspendisse sit amet ex vestibulum, semper nunc quis, consequat arcu. a aliquam.");
        $manager->persist($carousel);

        $carousel = new Carousel();
        $carousel->setImageName("recycle.png");
        $carousel->setUpdatedAt(new DateTimeImmutable());
        $carousel->setTitle("Inclusivité et accessibilité");
        $carousel->setTexte("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vestibulum mauris ut diam vulputate, nec scelerisque magna maximus. Suspendisse sit amet ex vestibulum, semper nunc quis, consequat arcu. a aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vestibulum mauris ut diam vulputate, nec scelerisque magna maximus. Suspendisse sit amet ex vestibulum, semper nunc quis, consequat arcu. a aliquam.");
        $manager->persist($carousel);

        $manager->flush();
    }
}
