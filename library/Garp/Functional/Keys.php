<?php
/**
 * @package  Garp\Functional
 * @author   Harmen Janssen <harmen@grrr.nl>
 * @license  https://github.com/grrr-amsterdam/garp-functional/blob/master/LICENSE.md BSD-3-Clause
 */
namespace Garp\Functional;

/**
 * Returns the keys of a list. Accepts arrays as well as iterable objects and strings.
 *
 * @param mixed $collection
 * @return mixed
 */
function keys($collection) {
    if (is_array($collection)) {
        return array_keys($collection);
    }
    if (is_string($collection)) {
        return range(0, strlen($collection)-1);
    }
    if ($collection instanceof \Traversable) {
        $out = array();
        foreach ($collection as $key => $value) {
            $out[] = $key;
        }
        return $out;
    }
    if (is_object($collection)) {
        return array_keys(get_object_vars($collection));
    }
    throw new \InvalidArgumentException(
        __FUNCTION__ . ' expects argument 1 to be a collection'
    );
}
