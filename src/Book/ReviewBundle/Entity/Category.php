<?php

namespace Book\ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Category
 *@Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Book\ReviewBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @Serializer\Expose()
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Serializer\Expose()
     * @var string
     * @ORM\Column(name="category", type="string", length=255, unique=true,options={"default"="General"}, nullable =false )
     */
    private $category;


    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Book\ReviewBundle\Entity\Book", mappedBy="category")
     */
    protected $books;

    public function __construct()
    {
           $this->books = new \Doctrine\Common\Collections\ArrayCollection();

    }

    public function __toString()
    {
        if(is_null($this->category))
        {
            return 'cat';
        }
        return $this->category;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Category
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
     * Add book
     *
     * @param \Book\ReviewBundle\Entity\Book $book
     *
     * @return Category
     */
    public function addBook(\Book\ReviewBundle\Entity\Book $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \Book\ReviewBundle\Entity\Book $book
     */
    public function removeBook(\Book\ReviewBundle\Entity\Book $book)
    {
        $this->books->removeElement($book);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }
}
