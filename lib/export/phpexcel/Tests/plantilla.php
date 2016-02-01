<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2011 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2011 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.6, 2011-02-27
 */

/** Error reporting */
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once '../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();



// Read from Excel5 (.xls) template
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load("templates/factura.xls");

// proceso

//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 8, 'Some value');
//$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 8)->getCalculatedValue();
//$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 8)->getValue();

//$objReader->setReadDataOnly(true);

$objWorksheet = $objPHPExcel->getActiveSheet();

$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

for ($row = 1; $row <= $highestRow; ++$row) {

  for ($col = 0; $col <= $highestColumnIndex; ++$col) {

    $valor=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
    $svalor=substr($valor,0,6);
    if (strncmp($svalor,"%%DET_",6)==0 ) {

      $len=strlen($valor)-8;
      $itemname=substr($valor,6,$len);
    //  $itemval=leerValor($itemname);
       $objWorksheet->setCellValueByColumnAndRow($col, $row,9 );

    }

  }
}




// grabar
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="facturaprocesada.xls"');
header('Cache-Control: max-age=0');


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

?>