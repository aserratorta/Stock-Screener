<?php

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Ticker trait
 *
 * @category Trait
 * @package  AppBundle\Entity\Traits
 * @author   Anton Serra <aserratorta@gmail.com>
 */
Trait TickerTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, unique=true)
     */
    private $ticker;

    /**
     * @return string
     */
    public function getTicker()
    {
        return $this->ticker;
    }

    /**
     * @param string $ticker
     * @return TickerTrait
     */
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;
        return $this;
    }

}
