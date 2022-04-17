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
        $carousel->setTexte("Premier site de upcycling 100% inclusif et accessible. Pour en savoir plus, vous pouvez visiter notre page 'à Propos' ou nous contacter via la page 'Contact'.
        ");
        $manager->persist($carousel);

        $carousel = new Carousel();
        $carousel->setImageName("hands2.png");
        $carousel->setUpdatedAt(new DateTimeImmutable());
        $carousel->setTitle("Qu'est-ce que le upcycling ?");
        $carousel->setTexte("L'upcycling est un concept récent qui a pour enjeu de réutiliser les matériaux pour augmenter la valeur de l’objet. Ici nous vous présentons des articles faits à partir d'anciens vêtements. Et qui permettront non seulement de leur donner une seconde vie mais aussi d’éviter qu’il soit jeté.");
        $manager->persist($carousel);

        $carousel = new Carousel();
        $carousel->setImageName("recycle.png");
        $carousel->setUpdatedAt(new DateTimeImmutable());
        $carousel->setTitle("Inclusivité et accessibilité");
        $carousel->setTexte("Les vêtements proposés sont inclusifs contrairement à la fast-fashion car nous faisons en sorte que le plus de taille soit proposer et pour tous les genres. Mais aussi les articles proposés sont vintages et assez atypiques. Et chaque pièce est conçue de manière qu’elle soit unique en leur genre.");
        $manager->persist($carousel);

        $manager->flush();
    }
}
