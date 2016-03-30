<?php

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Title trait
 *
 * @category Trait
 * @package  AppBundle\Entity\Traits
 * @author   Anton Serra <aserratorta@gmail.com>
 */
Trait TitleTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $title;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
