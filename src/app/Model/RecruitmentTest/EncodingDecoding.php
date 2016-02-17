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
 * Class EncodingDecoding
 *
 * @package    App
 * @subpackage Model\RecruitmentTest
 * @author     Bambang Adrian S <bambang.adrian@gmail.com>
 */
class EncodingDecoding extends \App\Model\AbstractBaseModel
{

    /**
     * Code table list property.
     *
     * @var array $CodeTable
     */
    private static $CodeTable = [];

    /**
     * Input string property.
     *
     * @var string $InputString
     */
    private $InputString;

    /**
     * Encoding result property.
     *
     * @var string $EncodeResult
     */
    private $EncodeResult;

    /**
     * Use code table list option flag property.
     *
     * @var boolean $UseCodeTable
     */
    private $UseCodeTable;

    /**
     * Already encoded option flag property.
     *
     * @var boolean $AlreadyEncoded
     */
    private $AlreadyEncoded;

    /**
     * Class constructor.
     *
     * @param string  $inputString  Input string parameter.
     * @param boolean $useCodeTable Use code table option flag parameter.
     */
    public function __construct($inputString = '', $useCodeTable = true)
    {
        parent::__construct();
        $this->setInputString($inputString);
        $this->setUseCodeTable($useCodeTable);
        if ($this->isUseCodeTable() === true) {
            static::getCodeTable();
        }
    }

    /**
     * Get code table.
     *
     * @return array
     */
    public static function getCodeTable()
    {
        if (count(static::$CodeTable) === 0) {
            for ($i = 64; $i <= 79; $i++) {
                $ordEncodeChar = (integer)($i + 16);
                $encodeChar = chr($ordEncodeChar);
                $decodeChar = chr($i);
                static::$CodeTable[$encodeChar] = $decodeChar;
                static::$CodeTable[$decodeChar] = $encodeChar;
            }
        }
        return static::$CodeTable;
    }

    /**
     * Do update model.
     *
     * @return boolean
     */
    public function doUpdate()
    {
        try {
            $this->setInputString($this->getPostValue('inputString'));
            $this->doEncode();
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
        return true;
    }

    /**
     * Set input string property.
     *
     * @param string $inputString Input string parameter.
     *
     * @return void
     */
    public function setInputString($inputString)
    {
        if ($inputString !== $this->getInputString()) {
            $this->setAlreadyEncoded(false);
        }
        $this->InputString = $inputString;
    }

    /**
     * Get input string property.
     *
     * @return string
     */
    public function getInputString()
    {
        return $this->InputString;
    }

    /**
     * Do the encoding process.
     *
     * @throws \Exception If any error raised.
     * @return void
     */
    public function doEncode()
    {
        try {
            if ($this->isAlreadyEncoded() === false) {
                $inputStringArray = $this->getInputStringToArray();
                $encodeResult = '';
                foreach ($inputStringArray as $char) {
                    if ($this->isUseCodeTable() === true) {
                        # Using Code table.
                        # ----------------
                        $encodeResult .= static::$CodeTable[$char];
                    } else {
                        # ATTENTION - If not using code table (ONLY ADDITIONAL PURPOSE).
                        # --------------------------------------------------------------
                        $ordChar = ord($char);
                        $charChange = 0;
                        if ($ordChar >= 64 and $ordChar <= 79) {
                            $charChange = 1;
                        } elseif ($ordChar >= 80 and $ordChar <= 95) {
                            $charChange = -1;
                        }
                        $ordChar += ($charChange * 16);
                        $encodeResult .= chr($ordChar);
                    }
                }
                $this->setEncodeResult($encodeResult);
                $this->setAlreadyEncoded(true);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get use code table flag status property.
     *
     * @return boolean
     */
    public function isUseCodeTable()
    {
        return $this->UseCodeTable;
    }

    /**
     * Set use code table flag status property.
     *
     * @param boolean $useCodeTable Use code table option flag parameter.
     *
     * @return void
     */
    public function setUseCodeTable($useCodeTable)
    {
        $this->UseCodeTable = $useCodeTable;
    }

    /**
     * Get encode result.
     *
     * @return string
     */
    public function getEncodeResult()
    {
        try {
            $this->doEncode();
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
        return $this->EncodeResult;
    }

    /**
     * Get already encoded flag status property.
     *
     * @return boolean
     */
    public function isAlreadyEncoded()
    {
        return $this->AlreadyEncoded;
    }

    /**
     * Set encode result.
     *
     * @param string $encodeResult Encode result parameter.
     *
     * @return void
     */
    protected function setEncodeResult($encodeResult)
    {
        $this->EncodeResult = $encodeResult;
    }

    /**
     * Set already encoded flag status property.
     *
     * @param boolean $alreadyEncoded Already encoded option flag status parameter.
     *
     * @return void
     */
    protected function setAlreadyEncoded($alreadyEncoded)
    {
        $this->AlreadyEncoded = $alreadyEncoded;
    }

    /**
     * Get input string to array.
     *
     * @return array
     */
    private function getInputStringToArray()
    {
        return str_split(strtoupper($this->getInputString()));
    }
}
