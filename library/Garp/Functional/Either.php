<?php
/**
 * @package  Garp\Functional
 * @author   Harmen Janssen <harmen@grrr.nl>
 * @license  https://github.com/grrr-amsterdam/garp-functional/blob/master/LICENSE.md BSD-3-Clause
 */
namespace Garp\Functional;

/**
 * Get either the left argument if true, otherwise the right argument.
 *
 * @param mixed $left
 * @param mixed $right
 * @return mixed
 */
function either($left, $right) {
    if (is_callable($left) || is_callable($right)) {
        return function () use ($left, $right) {
            $leftVal = is_callable($left) ? call_user_func_array($left, func_get_args()) : $left;
            return $leftVal ?:
                (is_callable($right) ? call_user_func_array($right, func_get_args()) : $right);
        };
    }
    return $left ?: $right;
}
