## libdwg-testsuite
### Need for Testsuite
libdwg can read DWG files but with few errors. This testsuite can locate errors and create benchmarks for accuracy in reading DWG files.

### Basic Working of Testsuite
libdwg has a program dwg-dxf which converts dwg files to dxf files.
Testsuite requires two input files. First a DWG file and second a corresponding DXF file created using any popular CAD software. Testsuite will convert DWG file to its own DXF file using dwg-dxf program bundled along with libdwg and it will compare the two dxf files.

### Install libdwg
Visit https://sourceforge.net/projects/libdwg/files/latest/download and download the latest tar.bz2 file.
Install as per the instructions given by libdwg.

### Allowing access to dwg-dxf from any location
sudo ln -s /path/to/libdwg-code/programs/dwg-dxf /usr/local/bin/

### Install Dependencies
sudo apt-get install php5 php-pear
sudo pear install Console_Table-1.3.0

### Download libdwg-testsuite
Visit libdwg-testsuite-x.x.tar.bz2 file.

### Install & Use libdwg-testsuite
tar xjf libdwg-testsuite-x.x.tar.bz2

cd libdwg-testsuite

php test.php -g /path/to/dwg/file -x /path/to/dxf/file

/path/to/dwg/file refers to a .dwg extension file created using any CAD software.

/path/to/dxf/file refers to a .dxf extension file created by exporting the .dwg file as .dxf using any CAD software.
