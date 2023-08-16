<?php

namespace DanielNavarro\Logger\Model;

class Logger extends \Monolog\Logger implements \DanielNavarro\Logger\Model\LoggerInterface
{
    public const EMAIL_TEMPLATE = 'debug_email';
    public const XML_PATH_EMAIL_IDENTITY = 'contact/email/sender_email_identity';

    public const TELEGRAM_TOKEN = '6089710117:AAHrKiMs2Y4alNCsB-TrjEp52x56g6WUQbo';
    public const TELEGRAM_ID_GROUP = '-1001926424545';

    /**
     * @var \Magento\Framework\Translate\Inline\StateInterface
     */
    private $inlineTranslation;

    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    private $transportBuilder;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress
     */
    private $remoteAddress;

    /**
     * @var \Magento\Framework\HTTP\PhpEnvironment\ServerAddress
     */
    private $serverAddress;

    /**
     * @var string
     */
    private $remoteAddressIp;

    /**
     * @var string
     */
    private $serverAddressIp;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $jsonSerializer;

    /**
     * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remoteAddress
     * @param \Magento\Framework\HTTP\PhpEnvironment\ServerAddress $serverAddress
     * @param \Magento\Framework\Serialize\Serializer\Json $jsonSerializer
     * @param string $name
     * @param array $handlers
     * @param array $processors
     */
    public function __construct(
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remoteAddress,
        \Magento\Framework\HTTP\PhpEnvironment\ServerAddress $serverAddress,
        \Magento\Framework\Serialize\Serializer\Json $jsonSerializer,
        string $name = '',
        array $handlers = [],
        array $processors = []
    ) {
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
        $this->scopeConfig = $scopeConfig;
        $this->remoteAddress = $remoteAddress;
        $this->serverAddress = $serverAddress;
        $this->jsonSerializer = $jsonSerializer;

        $this->setIpAddresses();

        parent::__construct($name, $handlers, $processors);
    }

    /**
     * Writes info in log
     *
     * @param string $method
     * @param string $line
     * @param string $message
     * @return void
     */
    public function writeInfo($method, $line, $message)
    {
        $this->writeLog($method, $line, $message, 'info');
    }

    /**
     * Writes warning information in log
     *
     * @param string $method
     * @param string $line
     * @param string $message
     * @return void
     */
    public function writeWarning($method, $line, $message)
    {
        $this->writeLog($method, $line, $message, 'warning');
    }

    /**
     * Writes error information in log
     *
     * @param string $method
     * @param string $line
     * @param string $message
     * @return void
     */
    public function writeError($method, $line, $message)
    {
        $this->writeLog($method, $line, $message, 'error');
    }

    /**
     * Sends a telegram alert
     *
     * @param string $destination
     * @param string $message
     * @return void
     */
    public function sendAlertTelegram($destination, $message)
    {
        // Default destination if none
        if (empty($destination)) {
            $destination = self::TELEGRAM_ID_GROUP;
        }

        // Build API URL
        $apiUrl = 'https://api.telegram.org/bot' . self::TELEGRAM_TOKEN . '/sendMessage';

        try {
            // Send message
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$destination}&parse_mode=HTML&text=$message");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Sends an email alert
     *
     * @param string $destination
     * @param string $subject
     * @param string $message
     * @return void
     */
    public function sendAlertEmail($destination, $subject, $message)
    {

        $trace = (new \Exception())->getTraceAsString();
        $trace = nl2br($trace);

        try {
            $this->inlineTranslation->suspend();
            $transport = $this->transportBuilder
                ->setTemplateIdentifier(self::EMAIL_TEMPLATE)
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars([
                    'subject' => $subject,
                    'message' => $message,
                    'trace' => $trace
                ])
                ->setFromByScope(
                    $this->scopeConfig->getValue(
                        self::XML_PATH_EMAIL_IDENTITY,
                        \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                    )
                )
                ->addTo($destination)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Actual write in to the log file with specified parameters
     *
     * @param string $method
     * @param string $line
     * @param string $message
     * @param string $logMethod
     */
    private function writeLog($method, $line, $message, $logMethod)
    {
        if (is_array($message) || is_object($message)) {
            $message = $this->jsonSerializer->serialize($message);
        }
        $this->$logMethod(
            $this->serverAddressIp . '-' .
            $this->remoteAddressIp . ' - ' .
            $method . ':' .
            $line . ' - ' .
            $message
        );
    }

    /**
     * Stores IP addresses to be logged
     *
     * @return void
     */
    private function setIpAddresses()
    {
        $remoteAddressIp = $this->remoteAddress->getRemoteAddress();
        $serverAddressIp = $this->serverAddress->getServerAddress();
        $this->remoteAddressIp = $remoteAddressIp ?: '?';
        $this->serverAddressIp = $serverAddressIp ?: '?';
    }
}
