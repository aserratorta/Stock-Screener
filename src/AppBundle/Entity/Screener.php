<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TickerTrait;
use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Screener Entity Class
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScreenerRepository")
 */
class Screener extends Base
{
    use TitleTrait;
    use TickerTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="float")
     */
    private $value;

    /**
     * @var Sector
     *
     * @ORM\ManyToOne(targetEntity="Sector", inversedBy="screeners")
     */
    private $sector;

    /**
     * @var Stock
     *
     * @ORM\ManyToOne(targetEntity="Stock", inversedBy="screeners")
     */
    private $stock;

    /**
     *
     *
     * Methods
     *
     *
     */

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return Screener
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param Stock $stock
     * @return Screener
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

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
     * @return Screener
     */
    public function setSector($sector)
    {
        $this->sector = $sector;

        return $this;
    }

    function __toString()
    {
        return $this->getTitle();
    }


}