<?php
/**
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2018, Ukraine, Sergei Shubin <is.captain.fail@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * @package      : ${PRODUCT}
 * @author       : Shubin Sergei
 * @user         : CF
 * @copyright    : Copyright (c) 2018, Ukraine, Sergei Shubin <is.captain.fail@gmail.com>
 * @license      : http://opensource.org/licenses/MIT	MIT License
 * @since        : Version 1.0.0 (last revision: 2018-01-03)
 */

namespace CF\Log;


trait TLogImplement
{
    /** @var \CF\Log\Logger|\Psr\Log\LoggerInterface $logger */
    protected static $logger = null;

    /**
     * @param $logger
     * @param bool $replace
     * @return bool
     */
    public static function setLogger($logger, $replace = false)
    {
        if (is_null(static::$logger) || $replace) {
            static::$logger = $logger;
            return true;
        }
        throw new \RuntimeException("Logger already exists");
    }

    /**
     * @return \CF\Log\Logger||null
     */
    public static function log()
    {
        /** @var \Psr\Log\LoggerInterface static::$logger */
        return static::$logger;
    }
}