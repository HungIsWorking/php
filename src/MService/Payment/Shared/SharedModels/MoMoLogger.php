<?php


namespace MService\Payment\MService\Payment\Shared\SharedModels;

use Bramus\Monolog\Formatter\ColoredLineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MoMoLogger extends Logger
{
    protected $loggingOff;

    public function __construct($name = 'MoMoDefault', bool $loggingOff = false, array $handlers = array(), array $processors = array())
    {
        $this->loggingOff = $loggingOff;

        if ($loggingOff === false && count($handlers) === 0) {
            $consoleHandler = new StreamHandler("php://stdout");
            $consoleHandler->setFormatter(new ColoredLineFormatter());

            $handlers = array($consoleHandler);
        }
        parent::__construct($name, $handlers, $processors);
    }

    /**
     * @return mixed
     */
    public function getLoggingOff()
    {
        return $this->loggingOff;
    }

    /**
     * @param mixed $loggingOff
     */
    public function setLoggingOff($loggingOff): void
    {
        $this->loggingOff = $loggingOff;
    }

    public function addRecord($level, $message, array $context = array())
    {
        if (!$this->loggingOff) {
            return parent::addRecord($level, $message, $context);
        }
    }

}