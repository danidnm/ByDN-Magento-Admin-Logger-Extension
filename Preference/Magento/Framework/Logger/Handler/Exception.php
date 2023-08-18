<?php

namespace Bydn\Logger\Preference\Magento\Framework\Logger\Handler;

class Exception extends \Magento\Framework\Logger\Handler\Exception
{
    /**
     * @var \Bydn\Logger\Helper\Config
     */
    private $alertsConfig;

    /**
     * @var \Bydn\Logger\Model\Logger
     */
    private $alertsLogger;

    /**
     * @param \Magento\Framework\Filesystem\DriverInterface $filesystem
     * @param string|null $filePath
     * @param string|null $fileName
     */
    public function __construct(
        \Magento\Framework\Filesystem\DriverInterface $filesystem,
        \Bydn\Logger\Helper\Config $alertsConfig,
        \Bydn\Logger\Model\Logger $alertsLogger,
        ?string $filePath = null,
        ?string $fileName = null
    ) {
        $this->alertsConfig = $alertsConfig;
        $this->alertsLogger = $alertsLogger;
        parent::__construct($filesystem, $filePath, $fileName);
    }

    /**
     * Remove dots from file name
     *
     * @param string $fileName
     * @return string
     */
    private function sanitizeFileName(string $fileName): string
    {
        $parts = explode('/', $fileName);
        $parts = array_filter($parts, function ($value) {
            return !in_array($value, ['', '.', '..']);
        });

        return implode('/', $parts);
    }

    /**
     * @inheritDoc
     */
    protected function write(array $record): void
    {
        $formatted = $record['formatted'] ?? null;
        $message = $record['message'] ?? null;
        $text = ($formatted != null) ? $formatted : $message;
        $text = $text ?? 'New unknown exception. Please see the exception.log file';

        if ($this->alertsConfig->isEmailExceptionsEnabled()) {
            $this->alertsLogger->sendAlertEmail('Exception', $message);
        }
        if ($this->alertsConfig->isTelegramExceptionsEnabled()) {
            $this->alertsLogger->sendAlertTelegram($message);
        }
        parent::write($record);
    }
}
