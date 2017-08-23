<?php
/*
 * ----------------------------------------------------------------------------
 * This file is part of the Redfox PHP Framework
 * and is subject to the MIT license that is bundled with this source code.
 *
 * @copyright (c) 2017 Cyberfox Software Solutions e.U.
 * ----------------------------------------------------------------------------
 */

namespace Redfox\Container\Support;

trait ValidatesOffsetTrait
{
    /**
     * Validates the designated offset:
     *  -  is a integer
     *  - or  is a string.
     *
     * @param string|int $offset
     *
     * @return bool
     *
     * @throws \InvalidArgumentException if the designated offset is invalid
     */
    protected function validateOffset($offset)
    {
        if (!is_integer($offset) && !is_string($offset)) {
            throw new \InvalidArgumentException('The offset should be either a string or an integer!');
        }

        return true;
    }
}
