<?php
/**
 * This only for recruitment test purpose.
 *
 * @package   App
 * @author    Bambang Adrian S <bambang.adrian@gmail.com>
 * @copyright 2016 Proprietary Software
 * @license   No License
 * @link      https://github.com/bambangadrian/recruitmentTest
 */
namespace App\Model\RecruitmentTest;

/**
 * Class CurrencyConversion.
 * This class using command string to execute all the currency rate conversion
 *
 * @package    App
 * @subpackage Model\RecruitmentTest
 * @author     Bambang Adrian S <bambang.adrian@gmail.com>
 */
class CurrencyConversion extends \App\Model\AbstractBaseModel
{

    /**
     * Command list pattern property.
     *
     * @var array $CommandListPattern
     */
    private static $CommandListPattern = [
        'add'       => '/^\s*(ADD)\s+([A-Z]{2,3})\s+([A-Z]{2,3})\s+([-+]?[0-9]{1}\.?[0-9]{1,})\s*$/',
        'calculate' => '/^\s*(CALC)\s+([A-Z]{2,3})\s+([A-Z]{2,3})\s+([-+]?[0-9]{1}\.?[0-9]*)\s*$/',
        'end'       => '/^\s*(END)\s*$/'
    ];

    /**
     * Command input string property.
     *
     * @var array $Commands
     */
    private $Commands = [];

    /**
     * Command segment array data property.
     *
     * @var array $CommandSegments
     */
    private $CommandSegments = [];

    /**
     * Conversion rate property.
     *
     * @var array $ConversionRate
     */
    private $ConversionRate = [];

    /**
     * Command result array property.
     *
     * @var array $CommandResult
     */
    private $CommandResult = [];

    /**
     * Class constructor.
     *
     * @param array $commands Command array collection data parameter.
     */
    public function __construct(array $commands = [])
    {
        parent::__construct();
        if (count($commands) > 0) {
            $this->setCommands($commands);
        }
    }

    /**
     * Do update model.
     *
     * @return boolean.
     */
    public function doUpdate()
    {
        try {
            $commands = array_filter(explode("\r\n", $this->getPostValue('commands')));
            $this->setCommands($commands);
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
        return true;
    }

    /**
     * Set the command string property.
     *
     * @param array $commands Command data collection parameter.
     *
     * @return void
     */
    public function setCommands(array $commands)
    {
        try {
            foreach ($commands as $command) {
                $this->addCommand($command);
            }
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
    }

    /**
     * Add command to command property.
     *
     * @param string $command Command string parameter.
     *
     * @throws \Exception If invalid command string given.
     * @return void
     */
    public function addCommand($command)
    {
        $commandSegment = $this->doParseCommand($command);
        if (count($commandSegment) > 0) {
            $this->Commands[] = $command;
            $this->doExecuteCommand($commandSegment);
        } else {
            throw new \Exception('Invalid command string : '.$command);
        }
    }

    /**
     * Get the command collection property.
     *
     * @return array
     */
    public function getCommands()
    {
        return $this->Commands;
    }

    /**
     * Add item to conversion rate table list.
     *
     * @param string $sourceCurrency Source currency code parameter.
     * @param string $targetCurrency Target currency code parameter.
     * @param float  $rate           Conversion rate value parameter.
     *
     * @throws \Exception If source currency has already exists.
     * @return string
     */
    public function addConversionRate($sourceCurrency, $targetCurrency, $rate)
    {
        if (array_key_exists($sourceCurrency, $this->ConversionRate) === true) {
            return 'ERROR : RATE';
        }
        $this->ConversionRate[$sourceCurrency][$targetCurrency] = $rate;
        $this->ConversionRate[$targetCurrency][$sourceCurrency] = 1 / $rate;
        return 'SUCCESS';
    }

    /**
     * Do end command.
     *
     * @return string
     */
    public function doEndCommand()
    {
        $this->CommandSegments = [];
        $this->CommandResult = [];
        $this->Commands = [];
        return '';
    }

    /**
     * Get conversion rate table list data.
     *
     * @return array
     */
    public function getConversionRateTable()
    {
        return $this->ConversionRate;
    }

    /**
     * Get conversion rate value.
     *
     * @param string $sourceCurrency Source currency code parameter.
     * @param string $targetCurrency Target currency code parameter.
     * @param float  $value          Value parameter.
     *
     * @throws \Exception If conversion rate not found.
     * @return string
     */
    public function getConversionRate($sourceCurrency, $targetCurrency, $value = 1.0)
    {
        # Init the result message return.
        $result = 'ERROR: CONVERSION';
        # Save conversion rate table to variable.
        $conversionTableList = $this->getConversionRateTable();
        # Search on the conversion rate table list data.
        if (array_key_exists($sourceCurrency, $conversionTableList) === true) {
            if (array_key_exists($targetCurrency, $conversionTableList[$sourceCurrency]) === true) {
                $result = $conversionTableList[$sourceCurrency][$targetCurrency];
            }
            if ($value !== null and is_numeric($value) === true) {
                $result = $value * $result;
            }
            # Format number 2 digit decimal without rounding.
            $numberSegment = explode('.', number_format($result, 3));
            if (array_key_exists(1, $numberSegment) === true) {
                $result = $numberSegment[0].'.'.substr($numberSegment[1], 0, 2);
            }
        }
        return (string)$result;
    }

    /**
     * Get command segments array data property.
     *
     * @return array
     */
    public function getCommandSegments()
    {
        return $this->CommandSegments;
    }

    /**
     * Get command result array data property.
     *
     * @return array
     */
    public function getCommandResult()
    {
        return $this->CommandResult;
    }

    /**
     * Load model form.
     *
     * @return string
     */
    public function loadForm()
    {
        return 'solution6';
    }

    /**
     * Execute the command string.
     *
     * @param array $commandSegment Command segment parameter.
     *
     * @return void
     */
    protected function doExecuteCommand(array $commandSegment)
    {
        try {
            $resultMessage = '';
            switch (strtolower($commandSegment['action'])) {
                case 'add':
                    $resultMessage = $this->addConversionRate(
                        $commandSegment['sourceCurrency'],
                        $commandSegment['targetCurrency'],
                        $commandSegment['value']
                    );
                    break;
                case 'calc':
                    $resultMessage = $this->getConversionRate(
                        $commandSegment['sourceCurrency'],
                        $commandSegment['targetCurrency'],
                        $commandSegment['value']
                    );
                    break;
                case 'end':
                    # $resultMessage = $this->doEndCommand();
                    break;
            }
            # echo $resultMessage;
            $this->addCommandResult($commandSegment['sequence'], $resultMessage);
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
    }

    /**
     * Add command segment item data property.
     *
     * @param array $commandSegment Command segment array data parameter.
     *
     * @return void
     */
    protected function addCommandSegment(array $commandSegment)
    {
        $this->CommandSegments[] = $commandSegment;
    }

    /**
     * Add command result item data property
     *
     * @param integer $sequenceKey Command segment sequence index parameter.
     * @param string  $message     Command execution result message.
     *
     * @return void
     */
    protected function addCommandResult($sequenceKey, $message)
    {
        $this->CommandResult[$sequenceKey] = $message;
    }

    /**
     * Parse the input command string.
     *
     * @param string $command Command string parameter.
     *
     * @return array
     */
    private function doParseCommand($command)
    {
        $commandSegment = [];
        foreach (static::$CommandListPattern as $pattern) {
            if ((bool)preg_match($pattern, $command, $matches) === true) {
                $commandSegment['sequence'] = count($this->CommandSegments);
                $commandSegment['command'] = $matches[0];
                $commandSegment['action'] = $matches[1];
                if (count($matches) > 2) {
                    $commandSegment['sourceCurrency'] = $matches[2];
                    $commandSegment['targetCurrency'] = $matches[3];
                    $commandSegment['value'] = $matches[4];
                }
            }
        }
        $this->addCommandSegment($commandSegment);
        return $commandSegment;
    }
}
