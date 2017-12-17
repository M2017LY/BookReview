<?php

namespace Book\ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\VarDumper\Cloner\Data;

/**
 * Cover
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="cover")
 * @ORM\Entity(repositoryClass="Book\ReviewBundle\Repository\CoverRepository")
 */
class Cover
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var \Book\ReviewBundle\Entity\Book
     * @ORM\OneToOne(targetEntity="Book\ReviewBundle\Entity\Book", inversedBy="covers" )
     * @ORM\JoinColumn(name="book", referencedColumnName="id" , onDelete="CASCADE")
     */
    private $book;
     /**
     * @var string
     * @ORM\Column(name="pic", type="string", length=255)
     * @Assert\NotBlank(message="Please, upload the Book Cover as a jpg file.")
     * @Assert\File( maxSize="10M", mimeTypes={"image/jpeg" ,"image/jpg", "image/png"} )
     */
    private $cover;

    public function __toString()
    {
        if(is_null($this->cover)) {
            return 'NULL';
        }
        return $this->cover;
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
     * Set cover
     *
     * @param string $cover
     *
     * @return Cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set book
     *
     * @param \Book\ReviewBundle\Entity\Book $book
     *
     * @return Cover
     */
    public function setBook(\Book\ReviewBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \Book\ReviewBundle\Entity\Book
     */
    public function getBook()
    {
        return $this->book;
    }
}
