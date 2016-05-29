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
function getGcodeGvalue(){
	global $handle;
	global $Gcode;
	global $Gvalue;
	global $LineNo;

	if ($handle) {
		if(feof($handle)){dxfERROR(2,"",$Gvalue);}else{$buffer = fgets($handle);$Gcode=trim($buffer);$LineNo++;}
		
		if(feof($handle)){dxfERROR(2,"",$Gvalue);}else{$buffer = fgets($handle);$Gvalue=trim($buffer);$LineNo++;}
	}
}
function echoGcodeGvalue(){
	global $Gcode;
	global $Gvalue;
	echo "\nGcode=$Gcode, Gvalue=$Gvalue";
}
function dxfLOG($intLogNo,$Contents){
	global $Log;
	switch($intLogNo){
		case 0:
		$Log=$Log."\n$Contents[0].";
		break;

		case 1:
		$Log=$Log."\nParsing of $Contents[0] Started.";
		break;

		case 2:
		$Log=$Log."\nParsing of $Contents[0] Complete.";
		break;
	}
}
function dxfERROR($intErrorNo,$Value="",$Testing=""){
	global $Errors;
	global $Gcode;
	global $LineNo;
	global $Filename;
	global $ErrorHandle;

	if($Gcode==340 && $Value=="E1"){return;}

	switch($intErrorNo){
		case 1:
		fwrite($ErrorHandle,"\n$Filename\tLine:$LineNo\tDouble Entry for $Gcode\t with value $Value");
		if($Testing){ fwrite($ErrorHandle," Testing:$Testing");}
		break;

		case 2:
		fwrite($ErrorHandle,"\n$Filename\tLine:$LineNo\tUnexpected End of File. Previous $Gcode\t with value $Value");
		if($Testing){ fwrite($ErrorHandle," Testing:$Testing");}
//		var_dump(debug_backtrace());
		break;

		default:
		fwrite($ErrorHandle,"\nUnknown ErrorNo");


	}

}

function SetGvalue(&$array,$Value,$Testing=""){
	if($array==""){
		$array=$Value;
	}else{
		dxfERROR(1,$Value,$Testing);
	}
}

function SetMultiGvalue(&$array,$Value,$Testing=""){
	if($array==""){
		$array[0]=$Value;
	}else{
		array_push($array,$Value);
	}
}
function Compare($a, $b,$parent="")
{
global $tbl;
global $ignore;
	foreach($a as $key=>$val){
		if(!isset($b[$key])){
			$tbl->addRow(array("$parent->$key", 'Missing'));
		}else{
			if(is_array($a[$key])){
				if(is_array($b[$key])){
					if($parent==""){Compare($a[$key], $b[$key],"$key");}else{Compare($a[$key], $b[$key],"$parent->$key");}
				}else{
					if(!in_array("$parent->$key",$ignore)){
						$tbl->addRow(array("$parent->$key", 'Miss matched type'));
					}
				}
			}else{
				if($a[$key] != $b[$key]){
					if(!in_array("$parent->$key",$ignore)){
						$tbl->addRow(array("$parent->$key", 'Not Equal',$a[$key],$b[$key]));
					}
				}
			}
		}
	}
}

$Helptext="****Testsuite for libdwg****\nUsage: Create a dwg file using any cad software and pass it to testsuite using -g option. Then convert the dwg file to dxf file using any cad software and pass it to testsuite using -x option.\nMandatory Options\n\t-g\tDwg file path\n\t-x\tDxf file path\n";

?>
