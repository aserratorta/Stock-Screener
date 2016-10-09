<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class StockscreenerRepository
 *
 * @category Repository
 * @package  AppBundle\Repository
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class StockscreenerRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findAllSectorsValueBiggerThanZero()
    {
        $query = $this->createQueryBuilder('sc')
            ->where('sc.value = :value' )
            ->setParameter('value', true)
            ->orderBy('sc.value', 'ASC');

        return $query->getQuery()->getResult();
    }
}
