<?php
namespace Vaniusa\ProductsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

 /**
  *@ORM\Entity
  *@ORM\Table(name="products")
  */

     class Products
     {
         /**
          * @ORM\Column(type="integer")
          * @ORM\Id
          * @ORM\GeneratedValue(strategy="AUTO")
          */
         private $id;

         /**
          * @ORM\Column(type="string", length=65)
          * @Assert\NotBlank()
          * @Assert\Length(min = 3, minMessage = "El nombre tiene un minimo de   caracteres")
          */
         private $nombre;

         /**
          * @ORM\Column(type="string", length=65)
          * @Assert\NotBlank()
          */
         private $category;

         /**
          * @ORM\Column(type="string", length=255)
          * @Assert\NotBlank()
          * @Assert\Length(min = 3, minMessage = "La descripcion tiene un minimo de caracteres")
          */
         private $description;

         /**
          * @ORM\Column(type="integer")
          * @Assert\NotBlank()
          */
         private $price;
     
    /**
     * Get Id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Products
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Products
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Products
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Products
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }
}
