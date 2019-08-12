<?php
define('ROOT', dirname(__FILE__));                      //root dir
function binarySearch($file, $znach)
{
	$handle = fopen($file, "r");                                    // open file for read
	while (!feof($handle)) {                                        // until and file
		$string = fgets($handle,4000);                              // len 4kb
		$str = mb_convert_encoding($string, 'UTF-8', 'cp1251');     // encoding to UTF-8 from cp1251
		$explodestr = explode('\x0A', $str);                        //get massive
		array_pop($explodestr); 	                                //remove last element
		foreach ($explodestr as $key => $value) {
			$arrMas[] = explode('\t', $value);                      //massive in massive
		}
		$start = 0;				                        //start value
		$end = count($arrMas)-1;                        //end define
        while ($start <= $end) {
			$center = floor(($start + $end) / 2);                   //middle
			$strnat = strnatcmp($arrMas[$center][0],$znach);        //get and find

			if ($strnat > 0) {
				$end = $center - 1;
			} elseif ($strnat < 0) {
				$start = $center + 1;
			} else {
				return $arrMas[$center][1];  		     //return value to key
			}
		}
	}
	return 'undef'; 					                 //return undef if not find
}
$znach = 'ключ42';                                       //find key
$file = ROOT.'/keynumber.txt';                           //file name
echo binarySearch($file, $znach)."</br>";
echo "Если значение не найдено: ";
$znach = 'ключ122';
echo binarySearch($file, $znach)."</br>";


