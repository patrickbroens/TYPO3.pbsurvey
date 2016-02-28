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
     * Count the keyword in an array
     *
     * @param array $array The haystack
     * @param mixed $keyword The needle
     * @return int
     */
    public static function countByKeyword(array $array, $keyword)
    {
        return count(
            array_filter(
                $array,
                function($value) use ($keyword)
                {
                    return $value === $keyword;
                }
            )
        );
    }

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
     * Find a key by its position within an array
     *
     * @param array $array The haystack
     * @param int $key The needle
     * @return mixed
     */
    public static function findKeyByPosition(array $array, $key)
    {
        return array_keys($array)[$key];
    }

    /**
     * Find objects within an array of objects by a property value
     *
     * @param array $array The haystack
     * @param string $property The property to look in
     * @param mixed $value The needle
     * @return array
     */
    public static function findObjectByPropertyValue(array $array, $property, $value)
    {
        return array_filter(
            $array,
            function ($object) use (&$value) {
                return $object->{$property} === $value;
            }
        );
    }

    /**
     * Find the position of a key within an array
     *
     * @param array $array The haystack
     * @param mixed $key The needle
     * @return mixed
     */
    public static function findPositionByKey(array $array, $key)
    {
        return array_search($key, array_keys($array), true);
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

    /**
     * Set a property within an array of objects
     *
     * @param array $array The array
     * @param string $propertyName The property to change
     * @param mixed $newValue The new value
     */
    public static function setProperty(array $array, $propertyName, $newValue)
    {
        array_walk(
            $array,
            function (&$value, $key) use ($propertyName, $newValue)
            {
                $method = 'set' . ucfirst($propertyName);

                if (is_callable([$value, $method])) {
                    $value->$method($newValue);
                }
            }
        );
    }

    /**
     * Shuffle an array preserving its keys
     *
     * @param array $array The array
     * @return array The shuffled array
     */
    public static function shuffleArrayPreserveKeys(array $array)
    {
        $shuffledArray = [];
        $shuffledKeys = array_keys($array);
        shuffle($shuffledKeys);

        foreach ($shuffledKeys AS $shuffledKey) {
            $shuffledArray[$shuffledKey] = $array[$shuffledKey];
        }

        return $shuffledArray;
    }
}

