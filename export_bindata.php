<?php

/**
 * ��ũ��Ʈ�� ���� ���۱� ����
 * 
 * �� ��ũ��Ʈ�� �ѱ۰���ǻ�Ϳ��� ���� HWP�� XML ����� ���� ������
 * HWPML(HML)���� BINDATA�� �����Ͽ�, ���Ϸ� �����ϴ� ����� ������ �ֽ��ϴ�.
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

$arrBinData = $xml->TAIL->BINDATASTORAGE->BINDATA;
$arrBinMappingTable = $xml->HEAD->MAPPINGTABLE->BINDATALIST->BINITEM;

$idx = 0;
foreach ($arrBinData as $binData)
{
	$filename = $outputDir.'/'.$binData['Id'].'.'.$arrBinMappingTable[$idx]['Format'];
	$data = (string)$binData;
	
	echo $filename.PHP_EOL;

	file_put_contents($filename, base64_decode($data) );
	
	$idx++;
}

echo "DONE".PHP_EOL;