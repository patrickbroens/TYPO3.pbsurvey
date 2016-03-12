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

class Reflection extends \ReflectionClass
{
    /**
     * Get a property tag by name from the doc comment
     *
     * @param \ReflectionProperty $property The property
     * @param string $tagName The tag name
     * @return string
     */
    public function getPropertyTag(\ReflectionProperty $property, $tagName)
    {
        $propertyDocComment = $property->getDocComment();
        $tags = $this->parseDocumentComments($propertyDocComment);

        return $tags[$tagName];
    }

    /**
     * Parse document comments
     *
     * @param string $comments The comments
     * @return array
     */
    protected function parseDocumentComments($comments)
    {
        $comments = explode("\n", $comments);
        $commentsOut = $parameters = [];

        foreach ($comments as $comment) {
            if (preg_match('/@/', $comment)) {
                $comment = preg_replace('/\* /', '', $comment);
                $comment = preg_replace('/@([a-zA-Z]*)( *)(.*)/', '$1|$3', $comment);
                $comment = explode('|', $comment);

                if (trim($comment[0]) == 'param') {
                    $comment[1] = $this->parseParamTag(trim($comment[1]));
                    array_push($parameters, $comment[1]);
                    $comment[1] = $parameters;
                    $comment[0] = 'params';
                }

                if (trim($comment[0]) == 'return') {
                    $comment[1] = $this->parseReturnTag(trim($comment[1]));
                }

                $commentsOut[trim($comment[0])] = $comment[1];
            }
        }

        return $commentsOut;
    }

    /**
     * Parse a (at)param tag
     *
     * @param string $string The param string
     * @return array
     */
    protected function parseParamTag($string)
    {
        $out = [];

        $data = explode(' ', $string, 3);

        if (count($data) == 2) {
            $out['type'] = $data[0];
            $out['name'] = preg_replace('/\$/', '', $data[1]);
        } elseif (count($data) == 3) {
            $out['type'] = $data[0];
            $out['name'] = preg_replace('/\$/', '', $data[1]);
            $out['docs'] = $data[2];
        } else {
            $out = $string;
        }

        return $out;
    }

    /**
     * Parse a (at)return tag
     *
     * @param string $string
     * @return array
     */
    protected function parseReturnTag($string)
    {
        $out = [];

        $data = explode(' ', $string, 2);

        if (count($data) == 1) {
            $out['type'] = $data[0];
        } elseif (count($data) == 2) {
            $out['type'] = $data[0];
            $out['docs'] = $data[1];
        } else {
            $out = $string;
        }

        return $out;
    }
}

