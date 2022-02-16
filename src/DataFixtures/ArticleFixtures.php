<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $article = new Article();
        $article = new Article();
        $article->setName("Chemise Delta");
        $article->setDescription("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.");
        $article->setImageName("chemise1.jpg");
        $article->setUpdatedAt(new DateTimeImmutable());
        // $article->setColor("noir");
        $article->setCategory($this->getReference(CategoryFixtures::CATEGORY_HAUT));
        $manager->persist($article);
        

        $article = new Article();
        $article->setName("Jupe Coco");
        $article->setDescription("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.");
        $article->setImageName("jupe1.jpg");
        $article->setUpdatedAt(new DateTimeImmutable());
        $article->setCategory($this->getReference(CategoryFixtures::CATEGORY_JUPE));
        $manager->persist($article);

        $article = new Article();
        $article->setName("Pantalon Fleau");
        $article->setDescription("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.");
        $article->setImageName("pantalon1.jpg");
        $article->setUpdatedAt(new DateTimeImmutable());
        $article->setCategory($this->getReference(CategoryFixtures::CATEGORY_PANT));
        $manager->persist($article);


        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            CategoryFixtures::class
        ];
    }
}