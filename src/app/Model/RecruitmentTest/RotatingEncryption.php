<?php
/**
 * This only for recruitment test purpose.
 *
 * @package   App
 * @author    Bambang Adrian S <bambang.as@optilog-global.com>
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
     * Class constructor.
     *
     * @param string  $inputString Input string parameter.
     * @param integer $leftRotate  Left rotate number parameter.
     * @param integer $rightRotate Right rotate number parameter.
     *
     * @throws \Exception If any error raised.
     */
    public function __construct($inputString, $leftRotate = 1, $rightRotate = 1)
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
     * @param integer $leftRotate Left rotate
     */
    public function setLeftRotate($leftRotate)
    {
        $this->LeftRotate = $leftRotate;
    }

    /**
     * @return int
     */
    public function getRightRotate()
    {
        return $this->RightRotate;
    }

    /**
     * @param int $RightRotate
     */
    public function setRightRotate($RightRotate)
    {
        $this->RightRotate = $RightRotate;
    }

    /**
     * @return string
     */
    public function getInputString()
    {
        return $this->InputString;
    }

    /**
     * @param string $InputString
     */
    public function setInputString($InputString)
    {
        $this->InputString = $InputString;
    }

    /**
     * @return string
     */
    public function getCipher()
    {
        return $this->Cipher;
    }

    /**
     * @param string $Cipher
     */
    public function setCipher($Cipher)
    {
        $this->Cipher = $Cipher;
    }
}