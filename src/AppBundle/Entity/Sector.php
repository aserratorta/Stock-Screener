<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TickerTrait;
use AppBundle\Entity\Traits\TitleTrait;
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
     * @ORM\JoinColumn(name="superSector_id", referencedColumnName="id")
     */
    private $superSector;

    /**
     *
     *
     * Methods
     *
     *
     */

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
}