<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TickerTrait;
use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * SuperSector Entity Class
 *
 * @category Entity
 * @package  AppBundle\Entity
 * @author   Anton Serra <aserratorta@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SuperSectorRepository")
 */
class SuperSector extends Base
{
    use TickerTrait;

    use TitleTrait;

    /**
     * @ORM\OneToMany(targetEntity="Sector", mappedBy="superSector")
     */
    private $sectors;

    public function __construct() {
        $this->sectors = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getSectors()
    {
        return $this->sectors;
    }

    /**
     * @param mixed $sectors
     * @return SuperSector
     */
    public function setSectors($sectors)
    {
        $this->sectors = $sectors;
        return $this;
    }


}