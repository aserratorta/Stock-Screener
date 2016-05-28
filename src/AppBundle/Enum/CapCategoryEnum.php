<?php

namespace AppBundle\Enum;

/**
 * CapCategoryEnum class
 *
 * @category Enum
 * @package  AppBundle\Enum
 * @author   David Romaní <david@flux.cat>
 */
class CapCategoryEnum
{
    const SMALL_CAP = 0;
    const MEDIUM_CAP = 1;
    const LARGE_CAP = 2;

    /**
     * @return array
     */
    public static function getEnumArray()
    {
        return array(
            self::SMALL_CAP => 'Small Cap',
            self::MEDIUM_CAP => 'Medium Cap',
            self::LARGE_CAP => 'Large Cap',
        );
    }
}
