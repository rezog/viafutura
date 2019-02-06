<?php 
class available_dates 
{
	public function set_range($start,$end,$interval){
		$dateRange = $this->getDatesFromRange($start, $end);
		$countInterval = 0;
		$data = Array();
		// counter for 
		$d = 0;
		// datums in daterange
		for($i = 0; $i < count($dateRange); ++$i) {
			
			$datum = Array();
			if(!$this->isWeekend($dateRange[$i])){++$countInterval;} 
			
			// only dates on interval
			if($countInterval == $interval)
			{
				// remove weekends
				if(!$this->isWeekend($dateRange[$i]))
				{
					$date = new DateTime($dateRange[$i]);
					// format date to day month year
					$dateFormatted = $date->format('d-m-Y ');

					// check if date is not a forbidden date 
					if(!$this->dateUnusable($dateFormatted)== 1)
					{
						++$d;
						$data[] = Array($d, $dateFormatted);
					}
				}
				$countInterval = 1;
			}
		}
		return $data;
	}
	
	private function isWeekend($date) {
		return (date('N', strtotime($date)) >= 6);
	}
	
	private function getDatesFromRange($start, $end, $format = 'Y-m-d') {
		$array = array();
		$interval = new DateInterval('P1D');
		$realEnd = new DateTime($end);
		$realEnd->add($interval);
		$period = new DatePeriod(new DateTime($start), $interval, $realEnd);
		
		foreach($period as $date) {
			$array[] = $date->format($format);
		}
		return $array;
	}

	private function dateUnusable($itemDate){

		if(substr($itemDate, 0, 2)=="05"){return true;}
		if(substr($itemDate, 0, 2)=="15"){return true;}
		if(substr($itemDate, 0, 5)=="25-12"){return true;} 
		if(substr($itemDate, 0, 5)=="01-01"){return true;}
		return false;
	}
}
