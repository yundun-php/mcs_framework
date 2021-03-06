<?php

/**
 * This file is part of the YundunMcs framework.
 *
 * @author    Qingshan Luo <shanshan.lqs@gmail.com>
 * @copyright 2017 - 2018 Qingshan Luo
 * @license   GNU Lesser General Public License 3.0
 */

namespace YundunMcs\Logger\Handlers;

use Closure;
use YundunMcs\Logger\Log;
use YundunMcs\Logger\Levels;
use YundunMcs\Logger\AbstractHandler;
use YundunMcs\Logger\Contracts\Formatter;
use YundunMcs\Logger\Formatter\LineFormatter;

class FileHandler extends AbstractHandler
{
    /**
     * The log file path name.
     *
     * @var string
     */
    protected $file;

    /**
     * The lowest processing log level.
     *
     * @var int
     */
    protected $level;

    /**
     * The log formatter.
     *
     * @var YundunMcs\Logger\Contracts\Formatter|null
     */
    protected $formatter;

    /**
     * Whether to automatically interrupt handler stack.
     *
     * @var bool
     */
    protected $autoInterrupt;

    /**
     * The file handler constructor.
     *
     * @param string                            $file          The log file path name.
     * @param int                               $level         The lowest processing log level.
     * @param YundunMcs\Logger\Contracts\Formatter $formatter     The log formatter.
     * @param bool                              $autoInterrupt Whether to automatically interrupt handler stack.
     *
     * @return void
     */
    public function __construct(string $file, int $level = Levels::DEBUG, Formatter $formatter = null, bool $autoInterrupt = false)
    {
        $this->file          = $file;
        $this->level         = $level;
        $this->formatter     = $formatter;
        $this->autoInterrupt = $autoInterrupt;
    }

    /**
     * Get the log formatter.
     *
     * @return YundunMcs\Logger\Contracts\Formatter
     */
    protected function getFormatter(): Formatter
    {
        if (is_null($this->formatter)) {
            $this->formatter = new LineFormatter();
        }

        return $this->formatter;
    }

    /**
     * Write log message to the log file.
     *
     * @param string $message The log message.
     *
     * @return bool
     */
    protected function write(string $message): bool
    {
        return false !== @file_put_contents($this->file, $message, FILE_APPEND);
    }

    /**
     * Handle a log.
     *
     * @param string            $channel The logger channel name.
     * @param YundunMcs\Logger\Log $log     The log body instance.
     * @param Closure           $next    The trigger for the next log handler.
     *
     * @return bool
     */
    public function handle(string $channel, Log $log, Closure $next): bool
    {
        if ($log->getLevel() >= $this->level) {
            $success = $this->write($this->getFormatter()->format($channel, $log));

            // Automatic interrupt log handler stack.
            if (!$success && $this->autoInterrupt) {
                return false;
            }
        }

        return $next();
    }
}
