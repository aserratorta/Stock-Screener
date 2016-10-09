<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TickerTrait;
use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sectorscreener Entity Class
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SectorscreenerRepository")
 */
class Sectorscreener extends Base
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
     * @ORM\ManyToOne(targetEntity="Sector", inversedBy="sectorScreeners")
     */
    private $sector;

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
     * @return Sectorscreener
     */
    public function setValue($value)
    {
        $this->value = $value;

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
     *
     * @return Sectorscreener
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