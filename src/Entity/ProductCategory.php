<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductCategoryRepository")
 */
class ProductCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ProductType", mappedBy="category", cascade={"persist", "remove"})
     */
    private $productType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getProductType(): ?ProductType
    {
        return $this->productType;
    }

    public function setProductType(ProductType $productType): self
    {
        $this->productType = $productType;

        // set the owning side of the relation if necessary
        if ($productType->getCategory() !== $this) {
            $productType->setCategory($this);
        }

        return $this;
    }
}
