<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Log\Formatter;

/**
 * Formats a log message into a single line of text.
 */
class LineMessageFormatter extends Formatter
{
    /**
     * The log message format string that turns a tag name, date-time and message into
     * one string to log.
     *
     * @var string
     */
    private $logMessageFormat;

    public function __construct($logMessageFormat)
    {
        $this->logMessageFormat = $logMessageFormat;
    }

    public function format(array $record)
    {
        $record['message'] = str_replace(
            array("%tag%", "%message%", "%datetime%", "%level%"),
            array($record['extra']['class'], trim($record['message']), $record['datetime']->format('Y-m-d H:i:s'), $record['level_name']),
            $this->logMessageFormat
        );

        return $this->next($record);
    }
}