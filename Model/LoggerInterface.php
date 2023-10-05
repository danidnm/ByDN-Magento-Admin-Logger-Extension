<?php

namespace Bydn\Logger\Model;

/**
 * Interface LoggerInterface
 */
interface LoggerInterface extends \Psr\Log\LoggerInterface
{
    /**
     * @param string $method
     * @param int $line
     * @param array|string $message
     */
    public function writeInfo($method, $line, $message);

    /**
     * @param string $method
     * @param int $line
     * @param array|string $message
     */
    public function writeWarning($method, $line, $message);

    /**
     * @param string $method
     * @param int $line
     * @param array|string $message
     */
    public function writeError($method, $line, $message);
}
