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
 * Class SinusSpatialCalculation
 *
 * @package    App
 * @subpackage Model\RecruitmentTest
 * @author     Bambang Adrian S <bambang.adrian@gmail.com>
 */
class SinusSpatialCalculation extends \App\Model\AbstractBaseModel
{

    /**
     * Lower limit number property.
     *
     * @var float $LowerLimit
     */
    private $LowerLimit;

    /**
     * Upper limit number property.
     *
     * @var float UpperLimit
     */
    private $UpperLimit;

    /**
     * Class constructor.
     *
     * @param float $lowerLimit Lower limit degree number parameter.
     * @param float $upperLimit Upper limit degree number parameter.
     */
    public function __construct($lowerLimit, $upperLimit)
    {
        parent::__construct();
        $this->setLowerLimit($lowerLimit);
        $this->setUpperLimit($upperLimit);
    }

    /**
     * Get lower limit number property.
     *
     * @return float
     */
    public function getLowerLimit()
    {
        return $this->LowerLimit;
    }

    /**
     * Set lower limit number property.
     *
     * @param float $lowerLimit Lower limit number parameter.
     *
     * @return void
     */
    public function setLowerLimit($lowerLimit)
    {
        $this->LowerLimit = $lowerLimit;
    }

    /**
     * Get upper limit number property.
     *
     * @return float
     */
    public function getUpperLimit()
    {
        return $this->UpperLimit;
    }

    /**
     * Set upper limit number property.
     *
     * @param float $upperLimit Upper limit number parameter.
     *
     * @return void
     */
    public function setUpperLimit($upperLimit)
    {
        $this->UpperLimit = $upperLimit;
    }
}
