<?php

namespace Book\ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Review
 *@Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="review")
 * @ORM\Entity(repositoryClass="Book\ReviewBundle\Repository\ReviewRepository")
 */
class Review
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
     * @ORM\Column(name="review", type="text")
     */
    private $review;

    /**
     * @Serializer\Expose()
     * @var \Book\ReviewBundle\Entity\Rate ,NotNull()
     * @ORM\ManyToOne(targetEntity="Book\ReviewBundle\Entity\Rate", inversedBy="reviews")
     * @ORM\JoinColumn(name="rate", referencedColumnName="id")
     */
    private $rate;


    /**
     * @Serializer\Expose()
     * @var \DateTime
     * @ORM\Column(name="timestamp", type="datetime")
     */
    private $timestamp;

    /**
     *  @Serializer\Expose()
     * @var \Book\ReviewBundle\Entity\Book
     * @ORM\ManyToOne(targetEntity="Book\ReviewBundle\Entity\Book", inversedBy="reviews" )
     * @ORM\JoinColumn(name="book", referencedColumnName="id" , onDelete="CASCADE")
     */
    private $book;


    /**
     * @var \Book\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="Book\UserBundle\Entity\User", inversedBy="reviews")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @Serializer\Expose()
     * @var string
     * @ORM\Column(name="reviewer", type="string")
     */
    private $reviewer;

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
     * Set review
     *
     * @param string $review
     *
     * @return Review
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return Review
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
     * Set reviewer
     *
     * @param string $reviewer
     *
     * @return Review
     */
    public function setReviewer($reviewer)
    {
        $this->reviewer = $reviewer;

        return $this;
    }

    /**
     * Get reviewer
     *
     * @return string
     */
    public function getReviewer()
    {
        return $this->reviewer;
    }

    /**
     * Set rate
     *
     * @param \Book\ReviewBundle\Entity\Rate $rate
     *
     * @return Review
     */
    public function setRate(\Book\ReviewBundle\Entity\Rate $rate = null)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return \Book\ReviewBundle\Entity\Rate
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set book
     *
     * @param \Book\ReviewBundle\Entity\Book $book
     *
     * @return Review
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

    /**
     * Set user
     *
     * @param \Book\UserBundle\Entity\User $user
     *
     * @return Review
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
}
