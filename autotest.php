<?php
/*
    Libdwg-Testsuite - Testuite for LibDWG
    Copyright (C) 2016  Guruprasad Rane 

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
try {
	if (! @include_once( 'Console/Table.php' ))
	  throw new Exception ("Libdwg-testsuite requires Pear package Console_Table 1.3.0\nUse command sudo pear install Console_Table-1.3.0\n");
}
	catch(Exception $e) {    
	  echo "Dependency Error : " . $e->getMessage();
}
$option_list="";
$options = getopt("i::e::l::t::c::");
if(isset($options['i']) && isset($options['e'])){echo "Both -i ans -e options can not be used together.\n";exit;}
if(isset($options['i'])){ $option_list="-i".$options['i'];}
if(isset($options['e'])){ $option_list="-e".$options['e'];}
if(isset($options['l'])){ $limitString=$options['l'];}else{$limitString="";}



$CurWorkingDir = getcwd();
$AutoTestFilesFolder=$CurWorkingDir . DIRECTORY_SEPARATOR . "autotestfiles";
$iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($AutoTestFilesFolder, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST, RecursiveIteratorIterator::CATCH_GET_CHILD);
$paths = array();
foreach ($iter as $path => $dir) {
    if ($dir->isFile()) {
		if(strtolower ($dir->getExtension()) == "dwg"){
			if(file_exists (substr($path,0,-4) . ".dxf") || file_exists (substr($path,0,-4) . ".DXF" )){
				$paths[] = $path;
			}
		}
    }
}
	if($limitString){
		echo "Test result for $limitString\n";
		$tbl = new Console_Table();
		if(isset($options['c'])){
			$tbl->setHeaders(array('File Name', 'ODA','LibDWG','Comparison'));
		}else{
			$tbl->setHeaders(array('File Name', 'ODA','LibDWG'));
		}
	}

foreach ($paths as $path) {
	if(file_exists (substr($path,0,-4) . ".dxf")){$dxfpath=substr($path,0,-4) . ".dxf";}else{$dxfpath=substr($path,0,-4) . ".DXF";}
	$TestResult=shell_exec("php test.php ".$option_list." -g \"" . $path . "\" -x \"" . $dxfpath ."\"");
	if($limitString){
		$TestResultLines=explode("\n",$TestResult);
		foreach ($TestResultLines as $Row) {
			$Cells=explode( "|",$Row);
			if(count($Cells)>4){
				if(trim($Cells[1]) == trim($limitString) ){
					if(isset($options['c'])){
						if(isset($options['t'])){
							switch($options['t']){
								case "hex":
								case "hexadecimal":
									$ODAvalue=hexdec($Cells[3]);
									$LibDWGvalue=hexdec($Cells[4]);
									break;
									
								default:
									echo "Option -t can be \"hex\".\n";exit();
							}
						}
						switch($options['c']){
							case "difference":
							case "diff":
								$tbl->addRow(array( basename($path),trim($Cells[3]), hexdec(trim($Cells[4])),$ODAvalue-$LibDWGvalue));
								break;
								
							default:
								echo "Option -c can be \"diff\".\n";exit();
						}
						
					}else{
						$tbl->addRow(array( basename($path),trim($Cells[3]), trim($Cells[4])));
					}
				}
			}
		}

	}else{
		echo "\033[1;35mTesting " . basename($path)."\033[0m \n";
		echo $TestResult;
	}
}
	if($limitString){
		echo $tbl->getTable();
	}
?>