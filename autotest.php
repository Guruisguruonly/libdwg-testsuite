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

//print_r($paths);

foreach ($paths as $path) {
	if(file_exists (substr($path,0,-4) . ".dxf")){$dxfpath=substr($path,0,-4) . ".dxf";}else{$dxfpath=substr($path,0,-4) . ".DXF";}
	echo shell_exec("php test.php -g \"" . $path . "\" -x \"" . $dxfpath ."\"");
	//echo exec ("php test.php -g \"" . $path . "\" -x \"" . $dxfpath ."\"");
}



?>