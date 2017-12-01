<?php
$installer = $this;
$installer->startSetup();
$installer->run(
	"create table `{$installer->getTable('lifeloc_easycal/easycal')}` (
		`easycal_id` int NOT NULL auto_increment,
		`serial_no` text,
		`model` text,
		`message` text,
		PRIMARY KEY (`easycal_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	");
//echo "create table";
$sourcefile = "/".'var/'.'www/'.'silk/'.'cs_test.csv';
$inputData = parseSourceFile($sourcefile);
//echo "parsed file";
foreach($inputData as $singleData) {
	$sql = "insert into {$installer->getTable('lifeloc_easycal/easycal')}";
	if(count($singleData) < 3){
		$sql = $sql . ' (serial_no, model) values (' .'"'. $singleData["serial_no"] .'", "'.
			$singleData["model"] . '");';
	}
	else{
		$sql = $sql. ' (serial_no, model, message) values (' .'"'. $singleData["serial_no"] . '", "'.
			$singleData["model"] . '", "'. $singleData["message"] . '");';
	}
	//echo $sql;
	$installer->run($sql);
	$sql = "";
}

$installer -> endSetup();

//read csv file

function parseSourceFile($filename) {
	$csvObject = new Varien_File_Csv();
	try{
		$data = $csvObject -> getData($filename);
		$attributes = $data[0];
		$tableData = array();
		for ($i = 1; $i < count($data); $i++){
			$info = array();
			$info["serial_no"] = $data[$i][0];
			$info["model"] = $data[$i][1];
			if(count($data[$i])>2) {
				$info["message"] = $data[$i][2];
			}
			$tableData[] = $info;
		}
		return $tableData;
	}
	catch (Exception $e){
		Mage::log('Csv: ' . $filename . '-getCsvData() error'.
		$e->getMessage(), Zend_Log::ERR, 'Lifeloc_Easycal_install.log', true);
		return false;
	}
}
