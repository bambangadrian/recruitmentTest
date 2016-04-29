<?php
# Testing for bank interest application.
require_once '../vendor/autoload.php';
//$appBankInterestCalculation = new \Project\App\Base\Model\Solutions\BankInterest();
//$appBankInterestCalculation->setPeriodLength(15);
//echo $appBankInterestCalculation->getEndBalance();
# -------------------------------------------------
# Testing for recursive multiplication application.
//$appRecursiveMultiplication = new \Project\App\Base\Model\Solutions\RecursiveMultiplication(9, 3);
//var_dump($appRecursiveMultiplication->getResultTable());
//var_dump($appRecursiveMultiplication->getCalculationResult());
# -------------------------------------------------
# Testing for encoding decoding application.
//$appEncodingDecoding = new \Project\App\Base\Model\Solutions\EncodingDecoding('bambang_adrian_sitompul');
//var_dump(\Project\App\Base\Model\Solutions\EncodingDecoding::getCodeTable());
//var_dump($appEncodingDecoding->getEncodeResult());
# -------------------------------------------------
# Testing for shortest path problem application.
//$appShortestPathProblem = new \Project\App\Base\Model\Solutions\ShortestPathProblem();
//$distanceArr = array();
//$distanceArr[1][2] = 7;
//$distanceArr[1][3] = 9;
//$distanceArr[1][6] = 14;
//$distanceArr[2][1] = 7;
//$distanceArr[2][3] = 10;
//$distanceArr[2][4] = 15;
//$distanceArr[3][1] = 9;
//$distanceArr[3][2] = 10;
//$distanceArr[3][4] = 11;
//$distanceArr[3][6] = 2;
//$distanceArr[4][2] = 15;
//$distanceArr[4][3] = 11;
//$distanceArr[4][5] = 6;
//$distanceArr[5][4] = 6;
//$distanceArr[5][6] = 9;
//$distanceArr[6][1] = 14;
//$distanceArr[6][3] = 2;
//$distanceArr[6][5] = 9;
//$appShortestPathProblem->setNodes($distanceArr);
//$appShortestPathProblem->setStartNode(1);
//$appShortestPathProblem->setTargetNode(5);
//var_dump($appShortestPathProblem->getShortestPath());
//echo $appShortestPathProblem->getShortestPathRouteString();
# -------------------------------------------------
# Test for currency conversion application.
//$appCurrencyConversion = new \Project\App\Base\Model\Solutions\CurrencyConversion();
# Each command will separate by new line feed (\n\r)
# All the command will be converted to uppercase letter.
# Multiple command & sequence applied.
//$appCurrencyConversion->addCommand('ADD USD IDR 14000'); # Return success / true if success.
//$appCurrencyConversion->addCommand('CALC IDR USD 150000'); # Return float number as the conversion result.
//$appCurrencyConversion->addCommand('END');
# --------------------------------------------------
# Testing for rotating encryption application.
//$appRotatingEncryption = new \Project\App\Base\Model\Solutions\RotatingEncryption();
//$appRotatingEncryption->setInputString('fritzgamaliel');
//$appRotatingEncryption->setLeftRotate(5);
//$appRotatingEncryption->setRightRotate(8);
//echo $appRotatingEncryption->getCipher();
# --------------------------------------------------
# Testing for sinus spatial calculation application.
//$appSinusSpatialCalculation = new \Project\App\Base\Model\Solutions\SinusSpatialCalculation();
//$appSinusSpatialCalculation->setLowerLimit(0);
//$appSinusSpatialCalculation->setUpperLimit(90);
//$appSinusSpatialCalculation->setIteration(100);
//echo $appSinusSpatialCalculation->getAreaWide();
# --------------------------------------------------

