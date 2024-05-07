<?php

namespace App\Entity;

use App\Repository\PersonnalityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnalityRepository::class)
 */
class Personnality
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $music;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $movie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $book;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $favorite_activity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMusic(): ?string
    {
        return $this->music;
    }

    public function setMusic(string $music): self
    {
        $this->music = $music;

        return $this;
    }

    public function getMovie(): ?string
    {
        return $this->movie;
    }

    public function setMovie(string $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function getBook(): ?string
    {
        return $this->book;
    }

    public function setBook(string $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getFavoriteActivity(): ?string
    {
        return $this->favorite_activity;
    }

    public function setFavoriteActivity(string $favorite_activity): self
    {
        $this->favorite_activity = $favorite_activity;

        return $this;
    }
}
