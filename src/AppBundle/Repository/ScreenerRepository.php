<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ScreenerRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class ScreenerRepository extends EntityRepository
{
    public function filterScreenersSortedByValue()
    {
        $query = $this
            ->createQueryBuilder('sc')
//            ->join('sc.stock', 'st')
            ->join('sc.sector', 'se')
            ->orderBy('sc.value', 'DESC')
        ;

        return $query->getQuery()->getResult();
    }
}
