<?php
/**
 * @package  Garp\Functional
 * @author   Harmen Janssen <harmen@grrr.nl>
 * @license  https://github.com/grrr-amsterdam/garp-functional/blob/master/LICENSE.md BSD-3-Clause
 */
namespace Garp\Functional;

/**
 * Drop items from a collection while the predicate function returns true.
 * Stop dropping at the first falsey value.
 *
 * @param callable $predicate
 * @param array $collection
 * @return array
 */
function drop_while($predicate, $collection = null) {
    if (!is_callable($predicate)) {
        throw new \InvalidArgumentException('drop_while expects the first argument to be callable');
    }
    $dropper = function ($collection) use ($predicate) {
        $collection = is_string($collection) ? str_split($collection) : $collection;
        if (!is_array($collection) && !$collection instanceof \Traversable) {
            throw new \InvalidArgumentException('drop_while expects argument 2 to be a collection');
        }
        $out = array();
        $gotSome = false;
        foreach ($collection as $key => $value) {
            if (!$gotSome && $predicate($value)) {
                continue;
            }
            $gotSome = true;
            $out[] = $value;
        }
        return $out;
    };
    return func_num_args() < 2 ? $dropper : $dropper($collection);
}
