<?php

/**
 * 스크립트에 대한 저작권 고지
 * 
 * 이 스크립트는 한글과컴퓨터에서 만든 HWP의 XML 기반의 파일 포맷인
 * HWPML(HML)에서 BINDATA를 추출하여, 파일로 저장하는 기능을 가지고 있습니다.
 * 
 * 스크립트에 특별한 저작권을 주장하고 싶은 생각은 없으며,
 * HML을 이용하실 때 참고하시면 될 것 같습니다.
 * 
 * 스크립트 작성 : 차오이 <caoy@autoset.org>
 * 스크립트 작성일 : 2016년 03년 11월
 * 비고 : 스크립트 소개 내용을 한글로 적은 이유는 HWP는 한국에서만 사용하므로...
 * 
 */

if (sizeof($_SERVER['argv']) != 2) {
	echo "Usage: ".$_SERVER['SCRIPT_FILENAME']." YourHmlFile.hml";
	exit;
}

$hmlFileName = $_SERVER['argv'][1];

if (!file_exists($hmlFileName)) {
	echo "File not fund: ".$hmlFileName;
	exit;
}
$outputDir = array_shift(explode('.',basename($hmlFileName)));

if (!file_exists($outputDir)) {
	mkdir($outputDir, 0777, true);
}

$xml = simplexml_load_file($hmlFileName);

$arrBinItem = $xml->xpath('//@BinItem/..');

echo "Total: ".sizeof($arrBinItem).PHP_EOL;

$idx = 0;

foreach ($arrBinItem as $binItem) {
	echo "[".($idx++)."]";
	echo $binItem->saveXML().PHP_EOL;
	echo str_repeat("-", 75).PHP_EOL;
}

echo "Done".PHP_EOL;
