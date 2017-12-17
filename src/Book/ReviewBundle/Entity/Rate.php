<?php

namespace Book\ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Rate
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="rate")
 * @ORM\Entity(repositoryClass="Book\ReviewBundle\Repository\RateRepository")
 */
class Rate
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
     * @ORM\Column(name="rate", type="string", length=255, unique=true, nullable=true)
     */
    private $rate;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Book\ReviewBundle\Entity\Review", mappedBy="rate")
     */
    protected $reviews;

    /**
     * Constructor
     */

    public function __toString()
    {
        if(is_null($this->rate)) {
            return 'NULL';
        }
        return $this->rate;
    }




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
     * Set rate
     *
     * @param string $rate
     *
     * @return Rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Add review
     *
     * @param \Book\ReviewBundle\Entity\Review $review
     *
     * @return Rate
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
