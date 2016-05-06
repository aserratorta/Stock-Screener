<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TickerTrait;
use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Stock Entity Class
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StockRepository")
 */
class Stock extends Base
{
    use TickerTrait;
    use TitleTrait;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $exchange;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $capAmount;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $capCategory;

    /**
     * @var Sector
     *
     * @ORM\ManyToOne(targetEntity="Sector", inversedBy="stocks")
     */
    private $sector;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Screener", mappedBy="stock")
     */
    private $screeners;

    /**
     *
     *
     * Methods
     *
     *
     */

    /**
     * @return string
     */
    public function getExchange()
    {
        return $this->exchange;
    }

    /**
     * @param string $exchange
     * @return Stock
     */
    public function setExchange($exchange)
    {
        $this->exchange = $exchange;

        return $this;
    }

    /**
     * @return float
     */
    public function getCapAmount()
    {
        return $this->capAmount;
    }

    /**
     * @param float $capAmount
     * @return Stock
     */
    public function setCapAmount($capAmount)
    {
        $this->capAmount = $capAmount;

        return $this;
    }

    /**
     * @return int
     */
    public function getCapCategory()
    {
        return $this->capCategory;
    }

    /**
     * @param int $capCategory
     * @return Stock
     */
    public function setCapCategory($capCategory)
    {
        $this->capCategory = $capCategory;

        return $this;
    }

    /**
     * @return Sector
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * @param Sector $sector
     * @return Stock
     */
    public function setSector($sector)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getScreeners()
    {
        return $this->screeners;
    }

    /**
     * @param ArrayCollection $screeners
     * @return Stock
     */
    public function setScreeners(ArrayCollection $screeners)
    {
        $this->screeners = $screeners;

        return $this;
    }

    /* @param Screener $screener
     *
     * @return $this
     */
    public function addScreener(Screener $screener)
    {
        $screener->setStock($this);
        $this->screeners->add($screener);

        return $this;
    }

    /* @param Screener $screener
     *
     * @return $this
     */
    public function removeScreener(Screener $screener)
    {
        $this->screeners->removeElement($screener);

        return $this;
    }

    public function __toString()
    {
        return $this->getTitle() ? $this->getTitle() : '---';
    }
}
