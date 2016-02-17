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
 * Class RotatingEncryption
 *
 * @package    App
 * @subpackage Model\RecruitmentTest
 * @author     Bambang Adrian S <bambang.adrian@gmail.com>
 */
class RotatingEncryption extends \App\Model\AbstractBaseModel
{

    /**
     * Left rotate number property.
     *
     * @var integer $LeftRotate .
     */
    private $LeftRotate;

    /**
     * Right rotate number property.
     *
     * @var integer $RightRotate
     */
    private $RightRotate;

    /**
     * Input string that want to encrypt.
     *
     * @var string $InputString
     */
    private $InputString;

    /**
     * Cipher as encryption result.
     *
     * @var string $Cipher
     */
    private $Cipher;

    /**
     * Encrypted status flag property.
     *
     * @var boolean $HasEncrypted
     */
    private $HasEncrypted = false;

    /**
     * Class constructor.
     *
     * @param string  $inputString Input string parameter.
     * @param integer $leftRotate  Left rotate number parameter.
     * @param integer $rightRotate Right rotate number parameter.
     *
     * @throws \Exception If any error raised.
     */
    public function __construct($inputString = '', $leftRotate = 1, $rightRotate = 1)
    {
        try {
            parent::__construct();
            $this->setInputString($inputString);
            $this->setLeftRotate($leftRotate);
            $this->setRightRotate($rightRotate);
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
    }

    /**
     * Do update model.
     *
     * @return boolean
     */
    public function doUpdate()
    {
        try {
            $this->setLeftRotate($this->getPostValue('leftRotate'));
            $this->setRightRotate($this->getPostValue('rightRotate'));
            $this->setInputString($this->getPostValue('inputString'));
            $this->doEncrypt($this->getPostValue('algorithmMethod'));
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
        return true;
    }

    /**
     * Load model form.
     *
     * @return string
     */
    public function loadForm()
    {
        return 'solution7';
    }

    /**
     * Get left rotate number property.
     *
     * @return integer
     */
    public function getLeftRotate()
    {
        return $this->LeftRotate;
    }

    /**
     * Set left rotate number property.
     *
     * @param integer $leftRotate Left rotate number parameter.
     *
     * @throws \Exception If invalid left rotate number given.
     * @return void
     */
    public function setLeftRotate($leftRotate)
    {
        # Validate the left rotate number, it must be positive integer type < 10
        if ($leftRotate >= 10 or is_numeric($leftRotate) === false or (integer)$leftRotate != $leftRotate) {
            throw new \Exception('Invalid left rotate number, it must be positive integer type < 10');
        }
        if ($leftRotate !== $this->getLeftRotate()) {
            $this->setHasEncrypted(false);
        }
        $this->LeftRotate = $leftRotate;
    }

    /**
     * Get right rotate number property.
     *
     * @return integer
     */
    public function getRightRotate()
    {
        return $this->RightRotate;
    }

    /**
     * Set right rotate number property.
     *
     * @param integer $rightRotate Right rotate number parameter.
     *
     * @throws \Exception If invalid right rotate number given.
     * @return void
     */
    public function setRightRotate($rightRotate)
    {
        # Validate the left rotate number, it must be positive integer type < 10
        if ($rightRotate >= 10 or is_numeric($rightRotate) === false or (integer)$rightRotate != $rightRotate) {
            throw new \Exception('Invalid right rotate number, it must be positive integer type < 10');
        }
        if ($rightRotate !== $this->getRightRotate()) {
            $this->setHasEncrypted(false);
        }
        $this->RightRotate = $rightRotate;
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
     * Set input string property.
     *
     * @param string $inputString Input string parameter.
     *
     * @return void
     */
    public function setInputString($inputString)
    {
        if ($inputString !== $this->getInputString()) {
            $this->setHasEncrypted(false);
        }
        $this->InputString = $inputString;
    }

    /**
     * Get cipher text property.
     *
     * @return string
     */
    public function getCipher()
    {
        if ($this->isHasEncrypted() === false) {
            $this->doEncrypt();
        }
        return $this->Cipher;
    }

    /**
     * Do the rotating encryption.
     *
     * @param string $algorithmMethod Algorithm method that will be used to encrypt the input string.
     *                                'str': using string manipulation (function substr()).
     *                                'arr': using array manipulation and index key rotate.
     *
     * @return void
     */
    public function doEncrypt($algorithmMethod = 'str')
    {
        try {
            if ($this->isHasEncrypted() === false) {
                $cipherText = '';
                if ($algorithmMethod === 'str') {
                    $cipherText = $this->doEncryptUsingSubString();
                } elseif ($algorithmMethod === 'arr') {
                    $cipherText = $this->doEncryptUsingArray();
                }
                $this->setCipher($cipherText);
                $this->setHasEncrypted(true);
            }
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
    }

    /**
     * Do the rotating decryption.
     *
     * @return void
     */
    public function doDecrypt()
    {
        # @todo Decrypt process.
    }

    /**
     * Get has encrypted status flag property.
     *
     * @return boolean
     */
    public function isHasEncrypted()
    {
        return $this->HasEncrypted;
    }

    /**
     * Set has encrypted status flag property.
     *
     * @param boolean $hasEncrypted Has encrypted status flag parameter.
     *
     * @return void
     */
    protected function setHasEncrypted($hasEncrypted)
    {
        $this->HasEncrypted = $hasEncrypted;
    }

    /**
     * Do rotating encryption using array manipulation algorithm method.
     *
     * @return string
     */
    private function doEncryptUsingArray()
    {
        # Run the rotating encryption.
        $inputStringArray = str_split($this->getInputString());
        $this->Data['charLength'] = count($inputStringArray);
        $this->Data['firstOddPosition'] = 1;
        if ($this->isOddNumber($this->Data['charLength']) === true) {
            $this->Data['lastOddPosition'] = $this->Data['charLength'];
            $this->Data['lastEvenPosition'] = $this->Data['charLength'] - 1;
        } else {
            $this->Data['lastEvenPosition'] = $this->Data['charLength'];
            $this->Data['lastOddPosition'] = $this->Data['charLength'] - 1;
        }
        $rotatedStringArray = [];
        foreach ($inputStringArray as $key => $char) {
            $rotatedPosition = $this->getRotatePosition($key + $this->Data['firstOddPosition']);
            $rotatedStringArray[$rotatedPosition] = $char;
        }
        ksort($rotatedStringArray, SORT_NUMERIC);
        return implode('', $rotatedStringArray);
    }

    /**
     * Do rotating encryption using substring function.
     *
     * @return string
     */
    private function doEncryptUsingSubString()
    {
        $oddCharArr = [];
        $evenCharArr = [];
        $inputStringArray = str_split($this->getInputString());
        foreach ($inputStringArray as $key => $char) {
            if ($this->isOddNumber($key + 1)) {
                $oddCharArr[] = $char;
            } else {
                $evenCharArr[] = $char;
            }
        }
        $oddString = implode('', $oddCharArr);
        $evenString = implode('', $evenCharArr);
        $leftRotate = $this->getLeftRotate();
        $rightRotate = $this->getRightRotate();
        $oddString = substr($oddString, $leftRotate, strlen($oddString) - $leftRotate).substr($oddString, 0, $leftRotate);
        $evenString = substr($evenString, strlen($evenString) - $rightRotate).substr($evenString, 0, strlen($evenString) - $rightRotate);
        $oddCharArr = str_split($oddString);
        $evenCharArr = str_split($evenString);
        $cipherArr = [];
        foreach ($oddCharArr as $key => $val) {
            $cipherArr[(2 * $key) + 1] = $val;
        }
        foreach ($evenCharArr as $key => $val) {
            $cipherArr[(2 * $key) + 2] = $val;
        }
        ksort($cipherArr, SORT_NUMERIC);
        return implode('', $cipherArr);
    }

    /**
     * Get rotate position.
     *
     * @param integer $position The position that want to be rotated.
     *
     * @return integer The rotate position.
     */
    private function getRotatePosition($position)
    {
        # Decrement/Increment n formula : 2n
        if ($this->isOddNumber($position) === true) {
            $newPosition = $position - (2 * $this->getLeftRotate());
            if ($newPosition < $this->Data['firstOddPosition']) {
                $lastPosition = $this->Data['lastOddPosition'] + 1;
                $newPosition = ($newPosition % $lastPosition) + $lastPosition;
            }
        } else {
            $newPosition = $position + (2 * $this->getRightRotate());
            if ($newPosition > $this->Data['lastEvenPosition']) {
                $newPosition = $newPosition % $this->Data['lastEvenPosition'];
                if ($newPosition === 0) {
                    $newPosition = $this->Data['lastEvenPosition'];
                }
            }
        }
        return $newPosition;
    }

    /**
     * Check is odd number.
     *
     * @param integer $number Number parameter.
     *
     * @return boolean
     */
    private function isOddNumber($number)
    {
        return (boolean)($number & 1);
    }

    /**
     * Set cipher text property
     *
     * @param string $cipher The chipper text as encryption result.
     *
     * @return void
     */
    private function setCipher($cipher)
    {
        $this->Cipher = $cipher;
    }
}
