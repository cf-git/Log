<?php
/**
 * IT Systems of ukraine
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2016, Ukraine, Ltd. "MYKOLAIV TECH SPEC".
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
 * @author       : Dooit Dev Team
 * @user         : ZpVs
 * @copyright    : Copyright (c) 2016, Ltd. "MYKOLAIV TECH SPEC" DOOIT™. (http://dooit.com.ua/)
 * @license      : http://opensource.org/licenses/MIT	MIT License
 * @link         : http://dooit.com.ua
 * @since        : Version 2.0.0 (last revision: 26-10-2016)
 */

namespace CF\Log;

trait TLogger
{
    protected $cfTLogJournal = [];
    protected $cfTLogJournalByLevel = [];
    protected $cfTLogListenLevels = [];
    protected static $cfTLogLevelList = [
        ILogLevel::EMERGENCY,
        ILogLevel::ALERT,
        ILogLevel::CRITICAL,
        ILogLevel::ERROR,
        ILogLevel::WARNING,
        ILogLevel::NOTICE,
        ILogLevel::INFO,
        ILogLevel::DEBUG,
    ];

    abstract public function log($level, $message, array $context = []);

    protected function __construct($logLevel = ILogLevel::WARNING, array $listenList = [])
    {
        $this->cfTLogListenLevels += $listenList;
        for ($i = 0, $c = count(static::$cfTLogLevelList); $i < $c; $i++) {
            array_push($this->cfTLogListenLevels, static::$cfTLogLevelList[$i]);
            if ($logLevel === static::$cfTLogLevelList[$i]) {
                return true;
            }
        }
        return $this->cfTLogListenLevels;
    }

    protected function checkLevel($level)
    {
        return in_array($level, $this->cfTLogListenLevels);
    }

    public function cfTLog($level, $message)
    {
        if ($this->checkLevel($level)) {
            $this->cfTLogJournalByLevel[$level] = $this->cfTLogJournalByLevel[$level] ?? [];
            array_push($this->cfTLogJournalByLevel[$level], $message);
            array_push($this->cfTLogJournal, $message);
            return true;
        }
        return false;
    }

    public function getLogs($level = null)
    {
        if (is_null($level)) {
            return $this->cfTLogJournal;
        } else {
            return $this->cfTLogJournalByLevel[$level];
        }
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function auth($message, array $context = array())
    {
        $this->log(ILogLevel::AUTH, $message, $context);
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function access($message, array $context = array())
    {
        $this->log(ILogLevel::ACCESS, $message, $context);
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function system($message, array $context = array())
    {
        $this->log(ILogLevel::SYSTEM, $message, $context);
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function user($message, array $context = array())
    {
        $this->log(ILogLevel::USER, $message, $context);
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function edit($message, array $context = array())
    {
        $this->log(ILogLevel::EDIT, $message, $context);
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function load($message, array $context = array())
    {
        $this->log(ILogLevel::LOAD, $message, $context);
    }

    /**
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function data($message, array $context = array())
    {
        $this->log(ILogLevel::DATA, $message, $context);
    }
}
