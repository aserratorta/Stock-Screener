<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TickerTrait;
use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


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
     * @ORM\ManyToOne(targetEntity="SuperSector", inversedBy="sectors")
     * @ORM\JoinColumn(name="superSector_id", referencedColumnName="id")
     */
    private $superSector;

    /**
     * @return mixed
     */
    public function getSuperSector()
    {
        return $this->superSector;
    }

    /**
     * @param mixed $superSector
     * @return Sector
     */
    public function setSuperSector($superSector)
    {
        $this->superSector = $superSector;
        return $this;
    }


}