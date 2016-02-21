
#Recruitment Test - Solutions

By: *[Bambang Adrian S] <bambang.adrian@gmail.com> 

## Features and Support:
- PSR1,2 Standard and PSR4 Autoloader
- All the solution/answer models located on `src\App\Base\Model\RecruitmentTest`

## Requirements : 
- PHP 5.6
- Composer
- Rewrite Module Enabled

Open the path via : http://{your-local/domain}/public

Sorry for your uncovenience, because it's build under simple route system.

## 1. Bank Interest Calculation (Bunga Bank)
### Testing for bank interest application.
`$appBankInterestCalculation = new \Project\App\Base\Model\RecruitmentTest\BankInterest();`

`$appBankInterestCalculation->setPeriodLength(-15);`

`echo $appBankInterestCalculation->getEndBalance();`


## 2. Recursion Multiplication (Perkalian Rekursif)
### Testing for recursive multiplication application.

`$appRecursiveMultiplication = new \Project\App\Base\Model\RecruitmentTest\RecursiveMultiplication(9, 3);`

`var_dump($appRecursiveMultiplication->getResultTable());`

`var_dump($appRecursiveMultiplication->getCalculationResult());`

## 3. Encoding/Decoding
### Testing for encoding decoding application.

`$appEncodingDecoding = new \Project\App\Base\Model\RecruitmentTest\EncodingDecoding('bambang_adrian_sitompul');`

`var_dump(\Project\App\Base\Model\RecruitmentTest\EncodingDecoding::getCodeTable());`

`var_dump($appEncodingDecoding->getEncodeResult());`

## 4. Shortest Path Problem (Using Djikstra Algorithm - Doubly Linked List)
### Testing for shortest path problem application.

Set first the node path length array (2 dimension)

`$appShortestPathProblem = new \Project\App\Base\Model\RecruitmentTest\ShortestPathProblem();`

`$appShortestPathProblem->setNodes($distanceArr);`

`$appShortestPathProblem->setStartNode(1);`

`$appShortestPathProblem->setTargetNode(5);`

`var_dump($appShortestPathProblem->getShortestPath());`

`echo $appShortestPathProblem->getShortestPathRouteString();`


## 5. Sinus Graph Spatial Calculation (Menghitung Luas Fungsi Sin)
### Testing for sinus spatial calculation application.

`$appSinusSpatialCalculation = new \Project\App\Base\Model\RecruitmentTest\SinusSpatialCalculation();`

`$appSinusSpatialCalculation->setLowerLimit(0);`

`$appSinusSpatialCalculation->setUpperLimit(90);`

`$appSinusSpatialCalculation->setIteration(100);`

`echo $appSinusSpatialCalculation->getAreaWide();`


## 6. Currency Rate Conversion (Konversi Mata Uang)
### Test for currency rate conversion application.

- Each command will separate by new line feed (\n\r)
- All the command will be converted to uppercase letter.
- Multiple command & sequence applied.

`$appCurrencyConversion = new \Project\App\Base\Model\RecruitmentTest\CurrencyConversion();`
    
`$appCurrencyConversion->addCommand('ADD USD IDR 14000'); # Return success / true if success.`

`$appCurrencyConversion->addCommand('CALC IDR USD 150000'); # Return float number as the conversion result.`

`$appCurrencyConversion->addCommand('END');`


## 7. Rotating Encryption
### Testing for rotating encryption application.

`$appRotatingEncryption = new \Project\App\Base\Model\RecruitmentTest\RotatingEncryption();`

`$appRotatingEncryption->setInputString('fritzgamaliel');`

`$appRotatingEncryption->setLeftRotate(5);`

`$appRotatingEncryption->setRightRotate(8);`

`echo $appRotatingEncryption->getCipher();`



