<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 04/12/16
 * Time: 13:39
 */

namespace Book\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */

class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Book\ReviewBundle\Entity\Book", mappedBy="user")
     */
    protected $books;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Book\ReviewBundle\Entity\Review", mappedBy="user")
     */
    protected $reviews;

    public function __construct()
    {
        parent::__construct();
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();

    }


    /**
     * Add book
     *
     * @param \Book\ReviewBundle\Entity\Book $book
     *
     * @return User
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

    /**
     * Add review
     *
     * @param \Book\ReviewBundle\Entity\Review $review
     *
     * @return User
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
}
