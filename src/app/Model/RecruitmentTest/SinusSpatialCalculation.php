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
     * Area wide property.
     *
     * @var float $AreaWide
     */
    private $AreaWide;

    /**
     * Iteration number property.
     *
     * @var integer $Iteration
     */
    private $Iteration = 100;

    /**
     * Method that will be used for calculation.
     *
     * @var string $Method
     */
    private $Method = 'parallelogram';

    /**
     * Has calculated flag status property.
     *
     * @var boolean $HasCalculated
     */
    private $HasCalculated = false;

    /**
     * Class constructor.
     *
     * @param float $lowerLimit Lower limit degree number parameter.
     * @param float $upperLimit Upper limit degree number parameter.
     */
    public function __construct($lowerLimit = 0.0, $upperLimit = 90.0)
    {
        parent::__construct();
        $this->setLowerLimit($lowerLimit);
        $this->setUpperLimit($upperLimit);
    }

    /**
     * Do update model.
     *
     * @return boolean
     */
    public function doUpdate()
    {
        $this->setLowerLimit($this->getPostValue('lowerLimit'));
        $this->setUpperLimit($this->getPostValue('upperLimit'));
        $this->setIteration($this->getPostValue('iteration'));
        $this->setMethod($this->getPostValue('calculationMethod'));
        $this->doSpaciousCalculation();
        return true;
    }

    /**
     * Load model form.
     *
     * @return string
     */
    public function loadForm()
    {
        return 'solution5';
    }

    /**
     * Do the area spatial calculation.
     *
     * @return void
     */
    public function doSpaciousCalculation()
    {
        try {
            if ($this->isHasCalculated() === false) {
                $areaWide = 0;
                if ($this->getMethod() === 'rectangle') {
                    $areaWide = $this->doCalculateUsingRectangle();
                } elseif ($this->getMethod() === 'parallelogram') {
                    $areaWide = $this->doCalculationUsingParallelogram();
                }
                $this->setAreaWide($areaWide);
                $this->setHasCalculated(true);
            }
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
    }

    /**
     * Do spacious calculation using rectangle.
     *
     * @return float
     */
    public function doCalculateUsingRectangle()
    {
        # Calculate using rectangle (formula : length x height).
        # Start iteration.
        $sumOfRectangleArea = 0;
        for ($startPointX = $this->getLowerLimit(); $startPointX <= $this->getUpperLimit(); $startPointX += $this->getDelta()) {
            $rectangleHeight = abs(sin(deg2rad($startPointX)));
            $sumOfRectangleArea += $this->getDelta() * $rectangleHeight;
        }
        return $sumOfRectangleArea;
    }

    /**
     * Do spacious calculation using parallelogram.
     *
     * @return float
     */
    public function doCalculationUsingParallelogram()
    {
        # Calculate using parallelogram (formula: sum of parallel sides * height /2 ).
        # Start iteration.
        $sumOfParallelogramArea = 0;
        for ($startPointX = $this->getLowerLimit(); $startPointX <= $this->getUpperLimit(); $startPointX += $this->getDelta()) {
            $endPointX = $startPointX + $this->getDelta();
            $sideHeight1 = abs(sin(deg2rad($startPointX)));
            $sideHeight2 = abs(sin(deg2rad($endPointX)));
            $parallelogramAreaWide = ($this->getDelta() * ($sideHeight1 + $sideHeight2)) / 2;
            $sumOfParallelogramArea += $parallelogramAreaWide;
        }
        return $sumOfParallelogramArea;
    }

    /**
     * Get area width property.
     *
     * @return float
     */
    public function getAreaWide()
    {
        if ($this->isHasCalculated() === false) {
            $this->doSpaciousCalculation();
        }
        return $this->AreaWide;
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
        if ($lowerLimit !== $this->getLowerLimit()) {
            $this->setHasCalculated(false);
        }
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
        if ($upperLimit !== $this->getUpperLimit()) {
            $this->setHasCalculated(false);
        }
        $this->UpperLimit = $upperLimit;
    }

    /**
     * Get has calculated flag status property.
     *
     * @return boolean
     */
    public function isHasCalculated()
    {
        return $this->HasCalculated;
    }

    /**
     * Get iteration number property.
     *
     * @return integer
     */
    public function getIteration()
    {
        return $this->Iteration;
    }

    /**
     * Set iteration number property.
     *
     * @param integer $iteration Iteration number parameter.
     *
     * @return void
     */
    public function setIteration($iteration)
    {
        if ($iteration !== $this->getIteration()) {
            $this->setHasCalculated(false);
        }
        $this->Iteration = $iteration;
    }

    /**
     * Get delta number based on iteration number.
     *
     * @return float
     */
    public function getDelta()
    {
        return ($this->getUpperLimit() - $this->getLowerLimit()) / $this->getIteration();
    }

    /**
     * Get method property.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->Method;
    }

    /**
     * Set method property.
     *
     * @param string $method Method parameter.
     *
     * @return void
     */
    public function setMethod($method)
    {
        $this->Method = $method;
    }

    /**
     * Set area width property.
     *
     * @param float $areaWide Area width parameter.
     *
     * @return void
     */
    protected function setAreaWide($areaWide)
    {
        $this->AreaWide = $areaWide;
    }

    /**
     * Set has calculated flag status property.
     *
     * @param boolean $hasCalculated Has calculated flag status parameter.
     *
     * @return void
     */
    protected function setHasCalculated($hasCalculated)
    {
        $this->HasCalculated = $hasCalculated;
    }
}
