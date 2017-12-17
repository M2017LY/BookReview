<?php

namespace Book\ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Book
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="Book\ReviewBundle\Repository\BookRepository")
 */
class Book 
{
    /**
     * @var int
     * @Serializer\Expose()
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Serializer\Expose()
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @Serializer\Expose()
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @Serializer\Expose()
     * @var string
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;

    /**
     * @Serializer\Expose()
     * @var \DateTime
     * @ORM\Column(name="timestamp", type="datetime")
     */
    private $timestamp;

    /**
     * @Serializer\Expose()
     * @var \Book\ReviewBundle\Entity\Category ,NotNull()
     * @ORM\ManyToOne(targetEntity="Book\ReviewBundle\Entity\Category", inversedBy="books" )
     * @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=false )
     */
    private $category;

    /**
     * @var \Book\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="Book\UserBundle\Entity\User", inversedBy="books")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @Serializer\Expose()
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Book\ReviewBundle\Entity\Review", mappedBy="book")
     */
    protected $reviews;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToOne(targetEntity="Book\ReviewBundle\Entity\Cover", mappedBy="book" )
     */
    protected $covers;




    public function __construct()
    {
       $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();

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
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set summary
     *
     * @param string $summary
     *
     * @return Book
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return Book
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set category
     *
     * @param \Book\ReviewBundle\Entity\Category $category
     *
     * @return Book
     */
    public function setCategory(\Book\ReviewBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Book\ReviewBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set user
     *
     * @param \Book\UserBundle\Entity\User $user
     *
     * @return Book
     */
    public function setUser(\Book\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Book\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add review
     *
     * @param \Book\ReviewBundle\Entity\Review $review
     *
     * @return Book
     */
    public function addReview(\Book\ReviewBundle\Entity\Review $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \Book\ReviewBundle\Entity\Review $review
     */
    public function removeReview(\Book\ReviewBundle\Entity\Review $review)
    {
        $this->reviews->removeElement($review);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * Add cover
     *
     * @param \Book\ReviewBundle\Entity\Cover $cover
     *
     * @return Book
     */
    public function addCover(\Book\ReviewBundle\Entity\Cover $cover)
    {
        $this->covers[] = $cover;

        return $this;
    }

    /**
     * Remove cover
     *
     * @param \Book\ReviewBundle\Entity\Cover $cover
     */
    public function removeCover(\Book\ReviewBundle\Entity\Cover $cover)
    {
        $this->covers->removeElement($cover);
    }

    /**
     * Get covers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCovers()
    {
        return $this->covers;
    }
}
