<?php

namespace App\Entity;

use App\Repository\ObstacleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObstacleRepository::class)
 */
class Obstacle
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
    private $nom;

    /**
     * @ORM\Column(type="blob")
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeObstacle;

    /**
     * @ORM\Column(type="integer")
     */
    private $Echec;

    /**
     * @ORM\Column(type="time")
     */
    private $tempsPassage;

    /**
     * @ORM\ManyToMany(targetEntity=PositionObstacle::class, inversedBy="obstacles")
     */
    private $positionObstacle;

    public function __construct()
    {
        $this->positionObstacle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTypeObstacle(): ?string
    {
        return $this->typeObstacle;
    }

    public function setTypeObstacle(string $typeObstacle): self
    {
        $this->typeObstacle = $typeObstacle;

        return $this;
    }

    public function getEchec(): ?int
    {
        return $this->Echec;
    }

    public function setEchec(int $Echec): self
    {
        $this->Echec = $Echec;

        return $this;
    }

    public function getTempsPassage(): ?\DateTimeInterface
    {
        return $this->tempsPassage;
    }

    public function setTempsPassage(\DateTimeInterface $tempsPassage): self
    {
        $this->tempsPassage = $tempsPassage;

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
