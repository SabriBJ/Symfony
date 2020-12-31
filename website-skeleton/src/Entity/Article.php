<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\Length(min=5, max=255, minMessage="Titre trop court")
     */
    private $title;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $image;


    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=5, minMessage="Contenu trop court")
     */
    private $content;


    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\Length(min=5, max=255, minMessage="Apercu trop court")
     */
    private $apercu;


    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\Length(min=5, max=255, minMessage="Nom de l'auteur trop court")
     */
    private $auteur;


    /**
     * @ORM\Column(type="datetime")
     */
    private $dateatt;



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $contenu
     */
    public function setContent($contenu): void
    {
        $this->content = $contenu;
    }

    /**
     * @return mixed
     */
    public function getApercu()
    {
        return $this->apercu;
    }

    /**
     * @param mixed $apercu
     */
    public function setApercu($apercu): void
    {
        $this->apercu = $apercu;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur): void
    {
        $this->auteur = $auteur;
    }

    /**
     * @return mixed
     */
    public function getDateatt()
    {
        return $this->dateatt;
    }

    /**
     * @param mixed $date
     */
    public function setDateatt($date): void
    {
        $this->dateatt = $date;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }
}
