<?php

namespace Bydn\AdminLogger\Handler;

use Monolog\Logger;

class Notification extends \Monolog\Handler\AbstractHandler
{
    /**
     * Log minimul handling level
     * @var int
     */
    protected $level = Logger::ERROR;

    /**
     * @var bool
     */
    protected $bubble = true;

    /**
     * @var \Bydn\AdminLogger\Helper\Config
     */
    private $loggerConfig;

    /**
     * @var \Bydn\AdminLogger\Model\Telegram
     */
    private $telegramSender;

    /**
     * @param \Bydn\AdminLogger\Helper\Config $loggerConfig
     */
    public function __construct(
        \Bydn\AdminLogger\Helper\Config $loggerConfig,
        \Bydn\AdminLogger\Model\Telegram $telegramSender
    ) {
        $this->loggerConfig = $loggerConfig;
        $this->telegramSender = $telegramSender;
    }

    /**
     * @param array $record
     * @return bool
     */
    public function handle(array $record): bool
    {
        $text = $record['message'];
        if (isset($record['context'])) {
            foreach ($record['context'] as $key => $value) {
                $text = $text . " | " . $key . ' => ' . (!is_array($value) ? $value : 'array');
            }
        }
        $this->telegramSender->sendTelegramMessage($text);
        $this->telegramSender->sendTelegramMessage($text);

        return $this->bubble;
    }
}
