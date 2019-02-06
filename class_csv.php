<?php
class exportCsv
{
	public function toFile($data)
	{
		$csv = "";
		foreach($data as $row) {
			$csv .= $this->arrayToCsv($row, ',') . "\n";
		}
		return $csv;
	}
	
	public function arrayToCsv(array &$fields, $delimiter) {
	    $enclosure = '"';
	    $delimiter_esc = preg_quote($delimiter, '/');
	    $enclosure_esc = preg_quote($enclosure, '/');
	    $output = array();
	    foreach ( $fields as $field ) {
	        // Enclose fields containing $delimiter, $enclosure or whitespace
	        if ( preg_match( "/(?:${delimiter_esc}|${enclosure_esc}|\s)/", $field ) ) 
	        {
	            $output[] = $enclosure . str_replace($enclosure, $enclosure . $enclosure, $field) . $enclosure;
	        }
	        else 
	        {
	            $output[] = $field;
	        }
	    }
	    return implode( $delimiter, $output );
	}
}
