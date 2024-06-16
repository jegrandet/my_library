<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
#[Vich\Uploadable]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titreVo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titreTraduit = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombreTomeVo = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombreTomeVf = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statutVo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statutVf = null;

    #[ORM\Column()]
    private ?bool $complete = false;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $resume = null;
    
    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $source = null;

    #[Vich\UploadableField(mapping: 'image_manga_serie', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;
    
    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;
    
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(targetEntity: Livre::class, mappedBy: 'serie')]
    private Collection $livres;

    #[ORM\ManyToOne(inversedBy: 'series')]
    private ?EditeurVo $editeurVo = null;

    #[ORM\ManyToOne(inversedBy: 'series')]
    private ?EditeurVf $editeurVf = null;

    #[ORM\ManyToOne(inversedBy: 'series')]
    private ?Collections $collection = null;

    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'series')]
    private Collection $types;

    #[ORM\ManyToOne(inversedBy: 'series')]
    private ?TypeOuvrage $typeOuvrage = null;

    #[ORM\ManyToMany(targetEntity: self::class)]
    private Collection $relation;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
        $this->types = new ArrayCollection();
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTitreVo(): ?string
    {
        return $this->titreVo;
    }

    public function setTitreVo(string $titreVo): static
    {
        $this->titreVo = $titreVo;

        return $this;
    }

    public function getTitreTraduit(): ?string
    {
        return $this->titreTraduit;
    }

    public function setTitreTraduit(?string $titreTraduit): static
    {
        $this->titreTraduit = $titreTraduit;

        return $this;
    }

    public function getNombreTomeVo(): ?int
    {
        return $this->nombreTomeVo;
    }

    public function setNombreTomeVo(?int $nombreTomeVo): static
    {
        $this->nombreTomeVo = $nombreTomeVo;

        return $this;
    }

    public function getNombreTomeVf(): ?int
    {
        return $this->nombreTomeVf;
    }

    public function setNombreTomeVf(int $nombreTomeVf): static
    {
        $this->nombreTomeVf = $nombreTomeVf;

        return $this;
    }

    public function getStatutVo(): ?string
    {
        return $this->statutVo;
    }

    public function setStatutVo(string $statutVo): static
    {
        $this->statutVo = $statutVo;

        return $this;
    }

    public function getStatutVf(): ?string
    {
        return $this->statutVf;
    }

    public function setStatutVf(string $statutVf): static
    {
        $this->statutVf = $statutVf;

        return $this;
    }

    public function isComplete(): ?bool
    {
        return $this->complete;
    }

    public function setComplete(bool $complete): static
    {
        $this->complete = $complete;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): static
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return Collection<int, Livre>
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): static
    {
        if (!$this->livres->contains($livre)) {
            $this->livres->add($livre);
            $livre->setSerie($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): static
    {
        if ($this->livres->removeElement($livre)) {
            // set the owning side to null (unless already changed)
            if ($livre->getSerie() === $this) {
                $livre->setSerie(null);
            }
        }

        return $this;
    }

    public function getEditeurVo(): ?EditeurVo
    {
        return $this->editeurVo;
    }

    public function setEditeurVo(?EditeurVo $editeurVo): static
    {
        $this->editeurVo = $editeurVo;

        return $this;
    }

    public function getEditeurVf(): ?EditeurVf
    {
        return $this->editeurVf;
    }

    public function setEditeurVf(?EditeurVf $editeurVf): static
    {
        $this->editeurVf = $editeurVf;

        return $this;
    }

    public function getCollection(): ?Collections
    {
        return $this->collection;
    }

    public function setCollection(?Collections $collection): static
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
        }

        return $this;
    }

    public function removeType(Type $type): static
    {
        $this->types->removeElement($type);

        return $this;
    }

    public function getTypeOuvrage(): ?TypeOuvrage
    {
        return $this->typeOuvrage;
    }

    public function setTypeOuvrage(?TypeOuvrage $typeOuvrage): static
    {
        $this->typeOuvrage = $typeOuvrage;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(self $relation): static
    {
        if (!$this->relation->contains($relation)) {
            $this->relation->add($relation);
        }

        return $this;
    }

    public function removeRelation(self $relation): static
    {
        $this->relation->removeElement($relation);

        return $this;
    }
    
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    
    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
}
