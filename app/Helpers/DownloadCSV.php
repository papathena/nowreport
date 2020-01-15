<?php
namespace App\Helpers;

class DownloadCSV {
	public static function downloadCSV($record) {
		$fh = fopen( 'php://output', 'w' );
 		$heading = false;
 		if(!empty($records)) {
   			foreach($records as $row) {
 				if(!$heading) {
   					// output the column headings
   					fputcsv($fh, array_keys($row));
   					$heading = true;
 				}
 				// loop over the rows, outputting them
 				fputcsv($fh, array_values($row));
 
   			}
   			fclose($fh);
   		}
	}
}