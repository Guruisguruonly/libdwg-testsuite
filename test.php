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

include('parse.php');
include('common.php');
include('ignore.php');
try {
	if (! @include_once( 'Console/Table.php' ))
	  throw new Exception ("Libdwg-testsuite requires Pear package Console_Table 1.3.0\nUse command sudo pear install Console_Table-1.3.0\n");
}
	catch(Exception $e) {    
	  echo "Dependency Error : " . $e->getMessage();
}
global $Gcode;
global $Gvalue;
global $DXF;
global $Errors;
global $Log;
global $LineNo;
global $Filename;
global $handle;
global $tbl;
$VerboseLevel=0;
$filepathdwg;$filepathdxf;$filedxfLD;
$Sections=array("h"=>"HEADER","c"=>"CLASSES","t"=>"TABLES","b"=>"BLOCKS","e"=>"ENTITIES","o"=>"OBJECTS");
$SectionsToCheck=$Sections;
$options = getopt("v::i:e:g:x:");
if(empty($options)){echo $Helptext;exit;}
if(isset($options['i']) && isset($options['e'])){echo "Both -i ans -e options can not be used together.\n";exit;}  
if(isset($options['i'])){
	$include=str_split($options['i']);
	$SectionsToCheck=array();
	foreach ($include as $val){
		$SectionsToCheck[$val]=$Sections[$val];
	}
}
if(isset($options['e'])){
	$exclude=str_split($options['e']);
	$SectionsToCheck=$Sections;
	foreach ($exclude as $val){
		unset($SectionsToCheck[$val]);
	}
}
if(isset($options['g'])){
	$filetype=substr($options['g'],-4);
	if(strtolower($filetype)==".dwg"){
		if(file_exists(trim($options['g']))){
			$filepathdwg=trim($options['g']);
			$filenamedwg=basename($filepathdwg);
			$filename=basename($filepathdwg,$filetype);
		}else{
			echo $options['g']." not found.\n"; exit();
		}
	}else{
		echo "option -g should contain dwg file with .dwg extension.\n";exit();
	}
}else{
	echo "option -g is mandatory. Option -g should contain dwg file with .dwg extension.\n";exit();
}
if(isset($options['x'])){
	if(strtolower(substr($options['x'],-4))==".dxf"){
		if(file_exists(trim($options['x']))){
			$filepathdxf=trim($options['x']);
			$filenamedxf=basename($filepathdxf);
		}else{
			echo $options['x']." not found.\n";exit;
		}

	}else{
		echo "option -x should contain dxf file with .dxf extension.\n";exit;
	}
}else{
	echo "option -x is mandatory. Option -x should contain dxf file with .dxf extension.\n";exit;
}
if(isset($options['v'])){
	$VerboseLevel=1;
}
exec("mkdir -p temp");
exec("cp $filepathdwg temp/$filenamedwg");
exec("dwg-dxf temp/$filenamedwg");
exec("mv temp/$filename.dxf temp/$filename-LD.dxf");
exec("cp $filepathdxf temp/$filenamedxf");
$ErrorHandle = fopen("errors.log", "w");
$Filename="temp/$filenamedxf";
$dxfAC=ParseDxf($Filename,$SectionsToCheck);
$Filename="temp/$filename-LD.dxf";
$dxfLD=ParseDxf($Filename,$SectionsToCheck);
$tbl = new Console_Table();
$tbl->setHeaders(array('Path', 'Result','Cad Value','LibDwg Value'));
Compare($dxfAC,$dxfLD);
echo $tbl->getTable();
fclose($ErrorHandle);
if($VerboseLevel){echo $Log;}
?>
