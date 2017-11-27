<?php
$installer = $this;
$installer->startSetup();
$installer->run(
	"create table `{$installer->getTable('lifeloc_distributors/distributors')}` (
		`list_id` int NOT NULL auto_increment,
		`location_id` int NOT NULL,
		`location_name` text,
		`distributor` text,
		`email` text,
		PRIMARY KEY (`list_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	");
//echo "create table";
$sourcefile = "/".'var/'.'www/'.'mage1_2/'.'Silk/'.'distributors.csv';
$inputData = parseSourceFile($sourcefile);
//echo "parsed file";
foreach($inputData as $singleData) {
	$sql = "insert into {$installer->getTable('lifeloc_distributors/distributors')}";
	if(count($singleData) < 3){
		$sql = $sql . ' (location_id, location_name) values (' . $singleData["location_id"] . ', "'.
			$singleData["location_name"] . '");';
	}
	elseif(count($singleData) < 4) {
		$sql = $sql . ' (location_id, location_name, distributor) values (' . $singleData["location_id"] . ', "'.
			$singleData["location_name"] . '", "'. $singleData["distributor"].'");';
	}
	else{
		$sql = $sql. ' (location_id, location_name, distributor, email) values (' . $singleData["location_id"] . ', "'.
			$singleData["location_name"] . '", "'. $singleData["distributor"].'", "'.$singleData["email"]. '");';
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
			$info["location_id"] = (int)$data[$i][1];
			$info["location_name"] = $data[$i][2];
			if(count($data[$i])>3) {
				$info["distributor"] = $data[$i][3];
			}
			if(count($data[$i]>4)) {
				$info["email"] = $data[$i][4];
			}
			$tableData[] = $info;
		}
		return $tableData;
	}
	catch (Exception $e){
		Mage::log('Csv: ' . $filename . '-getCsvData() error'.
		$e->getMessage(), Zend_Log::ERR, 'Lifeloc_Distributors_install.log', true);
		return false;
	}
}
