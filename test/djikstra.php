<?php
$distanceArr = array();
$distanceArr[1][2] = 7;
$distanceArr[1][3] = 9;
$distanceArr[1][6] = 14;
$distanceArr[2][1] = 7;
$distanceArr[2][3] = 10;
$distanceArr[2][4] = 15;
$distanceArr[3][1] = 9;
$distanceArr[3][2] = 10;
$distanceArr[3][4] = 11;
$distanceArr[3][6] = 2;
$distanceArr[4][2] = 15;
$distanceArr[4][3] = 11;
$distanceArr[4][5] = 6;
$distanceArr[5][4] = 6;
$distanceArr[5][6] = 9;
$distanceArr[6][1] = 14;
$distanceArr[6][3] = 2;
$distanceArr[6][5] = 9;
//the start and the end
$a = 1;
$b = 5;
//initialize the array for storing
$S = array();//the nearest path with its parent and weight
$Q = array();//the left nodes without the nearest path
var_dump($distanceArr);
foreach (array_keys($distanceArr) as $val) {
    $Q[$val] = 99999;
}
$Q[$a] = 0;
var_dump($Q);
//start calculating
while (!empty($Q)) {
    $min = array_search(min($Q), $Q);//the most min weight
    var_dump($min);
    if ($min == $b) {
        break;
    }
    var_dump($distanceArr[$min]);
    foreach ($distanceArr[$min] as $key => $val) {
        if (!empty($Q[$key]) && $Q[$min] + $val < $Q[$key]) {
            $Q[$key] = $Q[$min] + $val;
            $S[$key] = array($min, $Q[$key]);
            var_dump($Q);
        }
    }
    unset($Q[$min]);
    var_dump($Q);
}
//list the path
$path = array();
$pos = $b;
if (!array_key_exists($b, $S)) {
    echo "Found no way.";
    return;
}
while ($pos != $a) {
    $path[] = $pos;
    $pos = $S[$pos][0];
}
$path[] = $a;
$path = array_reverse($path);

