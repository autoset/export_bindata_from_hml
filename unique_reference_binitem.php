<?php

/**
 * ��ũ��Ʈ�� ���� ���۱� ����
 * 
 * �� ��ũ��Ʈ�� �ѱ۰���ǻ�Ϳ��� ���� HWP�� XML ����� ���� ������
 * HWPML(HML)���� �����ϴ� BinItem�� �����Ͽ� ���� ������ BinItem ID�� �߷����ϴ�.
 * 
 * ��ũ��Ʈ�� Ư���� ���۱��� �����ϰ� ���� ������ ������,
 * HML�� �̿��Ͻ� �� �����Ͻø� �� �� �����ϴ�.
 * 
 * ��ũ��Ʈ �ۼ� : ������ <caoy@autoset.org>
 * ��ũ��Ʈ �ۼ��� : 2016�� 03�� 11��
 * ��� : ��ũ��Ʈ �Ұ� ������ �ѱ۷� ���� ������ HWP�� �ѱ������� ����ϹǷ�...
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

$arrBinItemId = array();

foreach ($arrBinItem as $binItem) {
	$arrBinItemId[] = $binItem['BinItem'];
}

$arrBinItemId = array_map('intval', $arrBinItemId);
$arrBinItemId = array_unique($arrBinItemId, SORT_NUMERIC );
sort($arrBinItemId);

echo implode(PHP_EOL, $arrBinItemId);
