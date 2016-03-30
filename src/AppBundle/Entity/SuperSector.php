<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TickerTrait;
use AppBundle\Entity\Traits\TitleTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Sector", mappedBy="superSector")
     */
    private $sectors;

    /**
     *
     *
     * Methods
     *
     *
     */

    public function __construct() {
        $this->sectors = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getSectors()
    {
        return $this->sectors;
    }

    /**
     * @param ArrayCollection $sectors
     * @return SuperSector
     */
    public function setSectors(ArrayCollection $sectors)
    {
        $this->sectors = $sectors;
        return $this;
    }
}