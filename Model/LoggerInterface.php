<?php

namespace Bydn\Logger\Model;

/**
 * Interface LoggerInterface
 *
 * @author Víctor Jurado Usón
 *
 */
interface LoggerInterface extends \Psr\Log\LoggerInterface
{
    /**
     * Writes info to the log
     *
     * @param string $method
     * @param int $line
     * @param array|string $message
     */
    public function writeInfo($method, $line, $message);

    /**
     * Writes a warning to the log
     *
     * @param string $method
     * @param int $line
     * @param array|string $message
     */
    public function writeWarning($method, $line, $message);

    /**
     * Writes an error to the log
     *
     * @param string $method
     * @param int $line
     * @param array|string $message
     */
    public function writeError($method, $line, $message);
}
