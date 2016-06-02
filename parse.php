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

function ParseDxf($File,$SectionsToCheck){
	dxfLOG(1,array($File));
	global $Gcode;
	global $Gvalue;
	global $DXF;
	global $Errors;
	global $LineNo;
	global $Filename;
	global $handle;
	$Gvalue="";
	$LineNo=0;
	$DXF=array();
	$handle = @fopen($File, "r");
//	echo $File."\n";
//	return;
	while(!($Gcode==0 && $Gvalue=="EOF") && !feof($handle)){
		getGcodeGvalue();
		while($Gcode==0 && $Gvalue=="SECTION"){
			do{
				getGcodeGvalue();
				if($Gcode==2 && in_array($Gvalue,$SectionsToCheck)){
					switch($Gvalue){
						case "HEADER":
						parseHEADER();
						break;
						case "CLASSES":
						parseCLASSES();
						break;
						case "TABLES":
						parseTABLES();
						break;
						case "BLOCKS":
						parseBLOCKS();
						break;
						case "ENTITIES":
						parseENTITIES();
						break;
						case "OBJECTS":
						parseOBJECTS();
						break;
					}
				}
			}while(!($Gcode==0 && $Gvalue=="ENDSEC"));
		}
	}
	fclose($handle);
	dxfLOG(2,array($File));
	return $DXF;
}
function parseHEADER(){
	global $Gcode;
	global $Gvalue;
	global $DXF;
	$Header=array();
	$VariableName;
	$ValueArray=array();
	getGcodeGvalue();
	while($Gcode==9){
		$ValueArray=array();
		do{
			if($Gcode==9){$VariableName=$Gvalue;}else{
				SetGvalue($ValueArray[$Gcode],$Gvalue);
			}
			getGcodeGvalue();
			if($Gcode==0 && $Gvalue=="ENDSEC"){break;}
		}while($Gcode!=9);		
		if(count($ValueArray)==1){
			SetGvalue($Header[$VariableName],reset($ValueArray));
		}else{
			SetGvalue($Header[$VariableName],$ValueArray);
		}
		if($Gcode==0 && $Gvalue=="ENDSEC"){break;}
	}
	$DXF['HEADER']=$Header;
}
function parseCLASSES(){
	global $Gcode;
	global $Gvalue;
	global $DXF;
	$Classes=array();
	$ClassName;
	$ValueArray=array();
	getGcodeGvalue();
	while($Gcode==0 && $Gvalue=="CLASS"){
		$ValueArray=array();
		do{
			getGcodeGvalue();
			if($Gcode==1){$ClassName=$Gvalue;}else{
				if($Gcode!=0){
					SetGvalue($ValueArray[$Gcode],$Gvalue);
				}
			}
			if($Gcode==0 && $Gvalue=="ENDSEC"){break;}
		}while(!($Gcode==0 && $Gvalue=="CLASS"));		
		$Classes[$ClassName]=$ValueArray;
		if($Gcode==0 && $Gvalue=="ENDSEC"){break;}
	}
	$DXF['CLASSES']=$Classes;
}
function parseTABLES(){
	global $Gcode;
	global $Gvalue;
	global $DXF;
	$Tables=array();
	$TableName;$EntryHandle;$SubclassNo=0;$TableExtGroup=FALSE;$TableExtGroupDataCount=1;
	$ValueArray=array();
	$EntriesArray=array();
	getGcodeGvalue();

	while($Gcode==0 && $Gvalue=="TABLE"){
		$ValueArray=array();
		$EntriesArray=array();
		$TableName="";
		$TableRegAppCount=0;
		do{
			getGcodeGvalue();
			if($Gcode==2 && $TableName==""){
				$TableName=$Gvalue;
			}else{
				while($Gcode==0 && $Gvalue==$TableName){
					do{
						getGcodeGvalue();
						if($Gcode==5 || $Gcode==105){
							$EntryHandle=$Gvalue;
						}else{
							if($Gcode==0 && $Gvalue=="ENDTAB"){$SubclassNo=0;break;}
							if(!($Gcode==0 && $Gvalue==$TableName)){
								switch($Gcode){
									case 100:
									SetGvalue($EntriesArray[$EntryHandle][$Gcode][$SubclassNo],$Gvalue,$SubclassNo);
									$SubclassNo++;
									break;

									case 102:
									if($TableExtGroup){ $TableExtGroup = "";}else{ $TableExtGroup =$Gvalue;}
									break;

									case 330:
									if($TableExtGroup){SetGvalue($EntriesArray[$EntryHandle][$TableExtGroup][$Gcode],$Gvalue);}
									break;

									case 1001:
										$TableRegAppCount++;
										$TableRegAppSeperator="RegApp".$TableRegAppCount;
										SetGvalue($EntriesArray[$EntryHandle][$TableRegAppSeperator][$Gcode],$Gvalue);
									break;

									case 1002:
									if($TableExtGroup){ $TableExtGroup = "";$TableExtGroupDataCount=1;}else{
										if($Gvalue=="{"){$TableExtGroup="ExtnGroup";}else{$TableExtGroup =$Gvalue;}
									}
									break;

									case 1070:
									if($TableExtGroup){
										SetGvalue($EntriesArray[$EntryHandle][$TableExtGroup][$TableExtGroupDataCount][$Gcode],$Gvalue);
										$TableExtGroupDataCount++;
									}
									break;

									default:
									SetGvalue($EntriesArray[$EntryHandle][$Gcode],$Gvalue,"here");
								}
							}
						}
					}while(!($Gcode==0 && $Gvalue==$TableName));
					if($Gcode==0 && $Gvalue=="ENDTAB"){break;}
				}
				if(count($EntriesArray)){$ValueArray['TABLEENTRIES']=$EntriesArray;}
				if($Gcode==0 && $Gvalue=="ENDTAB"){break;}
				switch($Gcode){
					case 100:
					SetGvalue($ValueArray[$Gcode][$SubclassNo],$Gvalue);
					$SubclassNo++;
					break;

					case 102:
					if($TableExtGroup){ $TableExtGroup = "";}else{ $TableExtGroup =$Gvalue;}
					break;

					case 330:
					if($TableExtGroup){SetGvalue($ValueArray[$TableExtGroup][$Gcode],$Gvalue);}
					break;

					default:
					SetGvalue($ValueArray[$Gcode],$Gvalue);
				}
			}
		}while(!($Gcode==0 && $Gvalue=="ENDTAB"));
		$Tables[$TableName]=$ValueArray;
		getGcodeGvalue();
	}
	$DXF['TABLES']=$Tables;
}
function parseBLOCKS(){
	global $Gcode;
	global $Gvalue;
	global $DXF;
	$Blocks=array();
	$ValueArray=array();
	$BlockHandle;$SubclassNo=0;
	getGcodeGvalue();
	while($Gcode==0 && $Gvalue=="BLOCK"){
		do{
	getGcodeGvalue();
			if($Gcode==5){
				$BlockHandle=$Gvalue;
			}else{
				if(!($Gcode==0 && $Gvalue=="ENDBLK")){
					switch($Gcode){
						case 100:
						SetGvalue($Blocks[$BlockHandle][$Gcode][$SubclassNo],$Gvalue);
						$SubclassNo++;
						break;

						case 102:
						if($BlockExtGroup){ $BlockExtGroup = "";}else{ $BlockExtGroup =$Gvalue;}
						break;
/*
						case 330:
						if($BlockExtGroup){SetGvalue($ValueArray[$BlockExtGroup][$Gcode],$Gvalue);}
						break;
*/

						default:
						SetGvalue($Blocks[$BlockHandle][$Gcode],$Gvalue);

					}
				}
			}
		}while(!($Gcode==0 && $Gvalue=="ENDBLK"));
		do{
			getGcodeGvalue();
			if($Gcode==0 && $Gvalue=="ENDSEC"){break;}
			if(!($Gcode==0 && $Gvalue=="BLOCK")){
				switch($Gcode){
					case 100:
					SetGvalue($Blocks[$BlockHandle]['ENDBLOCK'][$Gcode][$SubclassNo],$Gvalue);
					$SubclassNo++;
					break;

					case 102:
					if($BlockExtGroup){ $BlockExtGroup = "";}else{ $BlockExtGroup =$Gvalue;}
					break;
	/*
					case 330:
					if($BlockExtGroup){SetGvalue($ValueArray[$BlockExtGroup][$Gcode],$Gvalue);}
					break;
	*/

					default:
					SetGvalue($Blocks[$BlockHandle]['ENDBLOCK'][$Gcode],$Gvalue);
				}
			}
		}while(!($Gcode==0 && $Gvalue=="BLOCK"));
	}
	$DXF['BLOCKS']=$Blocks;
}
function parseENTITIES(){
	global $Gcode;
	global $Gvalue;
	global $DXF;
	$Entities=array();
	$EntityName;$EntityHandle;$EntityExtGroup="";$SubclassNo=0;
	do {
		getGcodeGvalue();
		switch($Gcode){
			case 0:
			$EntityName=$Gvalue;
			break;

			case 5:
			$EntityHandle=$Gvalue;
			break;

			case 100:
			SetGvalue($Entities[$EntityName][$EntityHandle][$Gcode][$SubclassNo],$Gvalue);
			$SubclassNo++;
			break;

			case 102:
			if($EntityExtGroup){ $EntityExtGroup = "";}else{ $EntityExtGroup =$Gvalue;}
			break;

			default:
			SetGvalue($Entities[$EntityName][$EntityHandle][$Gcode],$Gvalue);
			break;
		}
	} while(!($Gcode==0 && $Gvalue=="ENDSEC"));
	$DXF['ENTITIES']=$Entities;
}
function parseOBJECTS(){
	global $Gcode;
	global $Gvalue;
	global $DXF;
	$Objects=array();
	$ObjectName;$ObjectHandle;$ObjectACDBDICTIONARYWDFLT;$ObjectMLINESTYLEElements;$ObjectAcadReactor=FALSE;$ObjectAcDbPlotSettings=FALSE;
	do {
		getGcodeGvalue();
		if($ObjectName="XRECORD" && $Gcode > 0 && $Gcode < 370 && $Gcode != 5 && $Gcode != 115){
			if(isset($Objects[$ObjectName][$ObjectHandle][$Gcode])){
SetMultiGvalue($Objects[$ObjectName][$ObjectHandle][$Gcode],$Gvalue);
/*
				array_push($Objects[$ObjectName][$ObjectHandle][$Gcode],$Gvalue);
			}else{
				SetGvalue($Objects[$ObjectName][$ObjectHandle][$Gcode][0],$Gvalue);
*/
			}
		}else{
			switch($Gcode){
				case 0:
				$ObjectName=$Gvalue;
				$ObjectMLINESTYLEElements=FALSE;$Entry=0;$ObjectOtherHandles=FALSE;
				break;

				case 5:
				$ObjectHandle=$Gvalue;
				break;

				case 3:
				$ObjectEntry=$Gvalue;
				break;

				case 49:
					$Entry++;

				case 62:
				case 6:
				if($ObjectMLINESTYLEElements){
					SetGvalue($Objects[$ObjectName][$ObjectHandle]['ENTRIES'][$Entry][$Gcode],$Gvalue);
				}
				break;

				case 71:
				if($ObjectName=="MLINESTYLE"){$ObjectMLINESTYLEElements = TRUE;}
				break;

				case 76:
				SetGvalue($Objects[$ObjectName][$ObjectHandle][$Gcode],$Gvalue);
				if($ObjectName=="LAYOUT"){$ObjectOtherHandles = TRUE;}
				break;

				case 100:
				if($Gvalue=="AcDbDictionaryWithDefault" && $ObjectName=="ACDBDICTIONARYWDFLT")
					{$ObjectACDBDICTIONARYWDFLT = TRUE;}
				if($Gvalue=="AcDbPlotSettings" && $ObjectName=="LAYOUT")
					{$ObjectAcDbPlotSettings = TRUE;}
				if($Gvalue=="AcDbLayout" && $ObjectName=="LAYOUT")
					{$ObjectAcDbPlotSettings = FALSE;}
				break;

				case 102:
				if($ObjectAcadReactor == TRUE){ $ObjectAcadReactor = FALSE;}else{ $ObjectAcadReactor =TRUE;}
				break;

				case 330:
				if ($ObjectAcadReactor){
					SetGvalue($Objects[$ObjectName][$ObjectHandle]['AcadReactor'][$Gcode],$Gvalue);
				}else{
					if($ObjectOtherHandles){SetGvalue($Objects[$ObjectName][$ObjectHandle]['Otherhandles'][$Gcode],$Gvalue); }
				}

				break;

				case 331:
				case 345:
				case 346:
				if($ObjectOtherHandles){ SetGvalue($Objects[$ObjectName][$ObjectHandle]['Otherhandles'][$Gcode],$Gvalue); }
				break;

				case 340:
				if ($ObjectACDBDICTIONARYWDFLT){
					SetGvalue($Objects[$ObjectName][$ObjectHandle]['ACDBDICTIONARYWDFLT'][$Gcode],$Gvalue);
					$ObjectACDBDICTIONARYWDFLT = TRUE;
				}else{
					SetGvalue($Objects[$ObjectName][$ObjectHandle][$Gcode],$Gvalue);
				}
				break;

				case 350:
				case 360:
					SetGvalue($Objects[$ObjectName][$ObjectHandle]['ENTRIES'][$Gvalue],$ObjectEntry);
				break;
				case 1000:
				case 1001:
				case 1070:
					SetMultiGvalue($Objects[$ObjectName][$ObjectHandle][$Gcode],$Gvalue);
				break;
				default:
				if($ObjectName=="LAYOUT" && $ObjectAcDbPlotSettings == TRUE){
					SetGvalue($Objects[$ObjectName][$ObjectHandle]['plotstyle'][$Gcode],$Gvalue);
				}else{
					SetGvalue($Objects[$ObjectName][$ObjectHandle][$Gcode],$Gvalue);
				}
				break;
			}
		}
	} while(!($Gcode==0 && $Gvalue=="ENDSEC"));
	$DXF['OBJECTS']=$Objects;
}

?>
