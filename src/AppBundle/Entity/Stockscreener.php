<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TickerTrait;
use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Stockscreener Entity Class
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StockscreenerRepository")
 */
class Stockscreener extends Base
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
     * @var Stock
     *
     * @ORM\ManyToOne(targetEntity="Stock", inversedBy="stockScreeners")
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
     *
     * @return Stockscreener
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
     *
     * @return Stockscreener
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    function __toString()
    {
        return $this->getTitle();
    }
}