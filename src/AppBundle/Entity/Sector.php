<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TickerTrait;
use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sector Entity Class
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SectorRepository")
 */
class Sector extends Base
{
    use TickerTrait;
    use TitleTrait;

    /**
     * @var SuperSector
     *
     * @ORM\ManyToOne(targetEntity="SuperSector", inversedBy="sectors")
     */
    private $superSector;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Stock", mappedBy="sector")
     */
    private $stocks;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Screener", mappedBy="sector")
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
     * Sector constructor.
     */
    public function __construct()
    {
        $this->stocks = new ArrayCollection();
        $this->screeners = new ArrayCollection();
    }

    /**
     * @return SuperSector
     */
    public function getSuperSector()
    {
        return $this->superSector;
    }

    /**
     * @param SuperSector $superSector
     * @return Sector
     */
    public function setSuperSector($superSector)
    {
        $this->superSector = $superSector;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * @param ArrayCollection $stocks
     * @return Sector
     */
    public function setStocks(ArrayCollection $stocks)
    {
        $this->stocks = $stocks;

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
     * @return Sector
     */
    public function setScreeners(ArrayCollection $screeners)
    {
        $this->screeners = $screeners;

        return $this;
    }

    /* @param Stock $stock
     *
     * @return $this
     */
    public function addStock(Stock $stock)
    {
        $stock->setSector($this);
        $this->stocks->add($stock);

        return $this;
    }

    /* @param Stock $stock
     *
     * @return $this
     */
    public function removeStock(Stock $stock)
    {
        $this->stocks->removeElement($stock);

        return $this;
    }

    /* @param Screener $screener
     *
     * @return $this
     */
    public function addScreener(Screener $screener)
    {
        $screener->setSector($this);
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
