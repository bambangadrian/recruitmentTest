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
 * Class BankInterest
 *
 * @package    App
 * @subpackage Model\RecruitmentTest
 * @author     Bambang Adrian S <bambang.adrian@gmail.com>
 */
class BankInterest extends \App\Model\AbstractBaseModel
{

    /**
     * Interest rate property.
     *
     * @var float $InterestRate
     */
    private $InterestRate;

    /**
     * Period length property on year.
     *
     * @var integer $PeriodLength
     */
    private $PeriodLength;

    /**
     * Initial balance property.
     *
     * @var float $InitialBalance
     */
    private $InitialBalance;

    /**
     * End balance property.
     *
     * @var float $EndBalance
     */
    private $EndBalance;

    /**
     * Balance sheet property.
     *
     * @var array $BalanceSheet .
     */
    private $BalanceSheet = [];

    /**
     * Calculation state property
     *
     * @var boolean $Calculated
     */
    private $Calculated = false;

    /**
     * Class constructor.
     *
     * @param float   $interestRate   The interest rate parameter.
     * @param integer $periodLength   The period length parameter.
     * @param float   $initialBalance The initial balance parameter.
     */
    public function __construct($interestRate = 12.0, $periodLength = 12, $initialBalance = 1000000.0)
    {
        try {
            parent::__construct();
            $this->setInterestRate($interestRate);
            $this->setPeriodLength($periodLength);
            $this->setInitialBalance($initialBalance);
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
    }

    /**
     * Get calculated state flag property.
     *
     * @return boolean
     */
    public function isCalculated()
    {
        return $this->Calculated;
    }

    /**
     * Get end balance property.
     *
     * @return float
     */
    public function getEndBalance()
    {
        $this->doCalculate();
        return $this->EndBalance;
    }

    /**
     * Do update model.
     *
     * @return boolean
     */
    public function doUpdate()
    {
        try {
            $this->setInitialBalance($this->getPostValue('initialBalance'));
            $this->setPeriodLength($this->getPostValue('periodLength'));
            $this->setInterestRate($this->getPostValue('interestRate'));
            $this->doCalculate();
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
        return true;
    }

    /**
     * Get balance sheet property.
     *
     * @return array
     */
    public function getBalanceSheet()
    {
        $this->doCalculate();
        return $this->BalanceSheet;
    }

    /**
     * Get interest rate property.
     *
     * @return float
     */
    public function getInterestRate()
    {
        return $this->InterestRate;
    }

    /**
     * Set interest rate property.
     *
     * @param float $interestRate The interest rate parameter.
     *
     * @throws \Exception If invalid interest rate given.
     * @return void
     */
    public function setInterestRate($interestRate)
    {
        if ($interestRate < 0) {
            throw new \Exception('Not valid interest rate, must greater than 0');
        }
        # Set calculated flag to false if any change apply on interest rate number.
        if ($interestRate !== $this->getInterestRate()) {
            $this->setCalculated(false);
        }
        $this->InterestRate = $interestRate;
    }

    /**
     * Get period length property.
     *
     * @return integer
     */
    public function getPeriodLength()
    {
        return $this->PeriodLength;
    }

    /**
     * Set period length property.
     *
     * @param integer $periodLength The period length parameter.
     *
     * @throws \Exception If invalid period length given.
     * @return void
     */
    public function setPeriodLength($periodLength)
    {
        if ($periodLength < 0) {
            throw new \Exception('Invalid period length, must be greater than 0');
        }
        # Set calculated flag to false if any change apply on period length.
        if ($periodLength !== $this->getPeriodLength()) {
            $this->setCalculated(false);
        }
        $this->PeriodLength = (integer)$periodLength;
    }

    /**
     * Get initial balance property.
     *
     * @return float
     */
    public function getInitialBalance()
    {
        return $this->InitialBalance;
    }

    /**
     * Set initial balance property.
     *
     * @param float $initialBalance The initial balance parameter.
     *
     * @throws \Exception If invalid initial balance given.
     * @return void
     */
    public function setInitialBalance($initialBalance)
    {
        if ($initialBalance < 0) {
            throw new \Exception('Invalid initial balance, must be greater than 0');
        }
        # Set calculated flag to false if any change apply on initial balance amount.
        if ($initialBalance !== $this->getInitialBalance()) {
            $this->setCalculated(false);
        }
        $this->InitialBalance = $initialBalance;
        $this->BalanceSheet = [$this->getInitialBalance()];
    }

    /**
     * Do calculate the end balance.
     *
     * @return void
     */
    public function doCalculate()
    {
        # Check if the calculation has run, so its not double run.
        if ($this->isCalculated() === false) {
            $rate = $this->getInterestRate() / 100;
            # Optimize the for loop without calling any function.
            $periodLength = $this->getPeriodLength();
            for ($i = 1; $i < $periodLength; $i++) {
                $currentBalance = $this->getBalanceSheet()[$i - 1];
                # Round the floating number to 0 decimal place.
                $this->setBalanceSheet(round(($rate * $currentBalance) + $currentBalance, 0), $i);
            }
            # Set the end balance from balance sheet array.
            $this->setEndBalance($this->getBalanceSheet()[$this->getPeriodLength() - 1]);
            # Set the calculated status flag.
            $this->setCalculated(true);
        }
    }

    /**
     * Set calculated flag state property.
     *
     * @param boolean $state Calculated state flag parameter.
     *
     * @return void
     */
    protected function setCalculated($state)
    {
        $this->Calculated = $state;
    }

    /**
     * Set end balance property.
     *
     * @param float $endBalance The ending balance parameter.
     *
     * @return void
     */
    protected function setEndBalance($endBalance)
    {
        $this->EndBalance = $endBalance;
    }

    /**
     * Set balance sheet property.
     *
     * @param float   $balanceAmount The balance amount parameter.
     * @param integer $monthIndex    The month index parameter.
     *
     * @return void
     */
    protected function setBalanceSheet($balanceAmount, $monthIndex)
    {
        $this->BalanceSheet[$monthIndex] = $balanceAmount;
    }
}
