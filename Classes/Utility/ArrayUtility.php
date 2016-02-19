<?php
namespace PatrickBroens\Pbsurvey\Utility;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Utilities for arrays
 */
class ArrayUtility
{
    /**
     * Filter array where keys start with keyword
     *
     * @param array $array The array to filter
     * @param string $keyword
     * @return array The filtered array
     * @TODO: PHP 5.6 >= will allow shorter method, since array_filter knows ARRAY_FILTER_USE_KEY flag
     */
    public static function filterArrayWhereKeyStartsWithKeyword(array $array, $keyword)
    {
        return array_intersect_key(
            $array,
            array_flip(
                array_filter(
                    array_keys($array),
                    function($key) use ($keyword)
                    {
                        return stristr($key, $keyword);
                    }
                )
            )
        );
    }

    /**
     * Remove a prefix from array keys
     *
     * @param array $array The array
     * @param string $prefix The prefix
     * @return array
     */
    public static function removePrefixFromKey(array $array, $prefix)
    {
        $newArray = [];

        array_walk(
            $array,
            function($value, $key) use ($prefix, &$newArray)
            {
                $key = preg_replace('/^' . preg_quote($prefix, '/') . '/', '', $key);
                $newArray[$key] = $value;
            }
        );

        return $newArray;
    }
}

