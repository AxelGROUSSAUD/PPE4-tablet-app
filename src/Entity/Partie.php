<?php

namespace App\Entity;

use App\Repository\PartieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartieRepository::class)
 */
class Partie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $jour;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbJoueurs;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbObstacles;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reussite;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="partie")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="partie")
     */
    private $salle;

    /**
     * @ORM\OneToMany(targetEntity=PhotoClient::class, mappedBy="partie")
     */
    private $photoClient;

    /**
     * @ORM\ManyToMany(targetEntity=PositionObstacle::class, inversedBy="parties")
     */
    private $positionObstacle;

    public function __construct()
    {
        $this->photoClient = new ArrayCollection();
        $this->positionObstacle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?\DateTimeInterface
    {
        return $this->jour;
    }

    public function setJour(\DateTimeInterface $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getNbJoueurs(): ?int
    {
        return $this->nbJoueurs;
    }

    public function setNbJoueurs(int $nbJoueurs): self
    {
        $this->nbJoueurs = $nbJoueurs;

        return $this;
    }

    public function getNbObstacles(): ?int
    {
        return $this->nbObstacles;
    }

    public function setNbObstacles(int $nbObstacles): self
    {
        $this->nbObstacles = $nbObstacles;

        return $this;
    }

    public function getReussite(): ?bool
    {
        return $this->reussite;
    }

    public function setReussite(bool $reussite): self
    {
        $this->reussite = $reussite;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * @return Collection|PhotoClient[]
     */
    public function getPhotoClient(): Collection
    {
        return $this->photoClient;
    }

    public function addPhotoClient(PhotoClient $photoClient): self
    {
        if (!$this->photoClient->contains($photoClient)) {
            $this->photoClient[] = $photoClient;
            $photoClient->setPartie($this);
        }

        return $this;
    }

    public function removePhotoClient(PhotoClient $photoClient): self
    {
        if ($this->photoClient->removeElement($photoClient)) {
            // set the owning side to null (unless already changed)
            if ($photoClient->getPartie() === $this) {
                $photoClient->setPartie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PositionObstacle[]
     */
    public function getPositionObstacle(): Collection
    {
        return $this->positionObstacle;
    }

    public function addPositionObstacle(PositionObstacle $positionObstacle): self
    {
        if (!$this->positionObstacle->contains($positionObstacle)) {
            $this->positionObstacle[] = $positionObstacle;
        }

        return $this;
    }

    public function removePositionObstacle(PositionObstacle $positionObstacle): self
    {
        $this->positionObstacle->removeElement($positionObstacle);

        return $this;
    }
}
