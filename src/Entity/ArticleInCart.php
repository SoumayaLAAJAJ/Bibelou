<?php

namespace App\Entity;

use App\Repository\ArticleInCartRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleInCartRepository::class)
 */
class ArticleInCart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Article::class, inversedBy="articleInCart")
     */
    private $article;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $dateType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getDateType(): ?\DateTimeImmutable
    {
        return $this->dateType;
    }

    public function setDateType(\DateTimeImmutable $dateType): self
    {
        $this->dateType = $dateType;

        return $this;
    }
}
