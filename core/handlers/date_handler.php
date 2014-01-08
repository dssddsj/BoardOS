<?PHP

class date {
	
	var $date;
	
	function __construct() {
		// Sets default time zone
       date_default_timezone_set('Israel');
	   global $date;
	   $date = date("m.d.y H:i:s");

   }

	
function timepassed($date) {
	$current_month = date("m");
	$current_year = date("y");
	$nu_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
	$nu_of_days_in_month = 30;
		$current_day = date("d");

	$current_hour = date("H");
	$current_minute = date("i");
	$current_second = date("s");
	
	$current_day = 60 * 60 * 24 * $current_day;
	$current_month = 60 * 60 * 24 * $nu_of_days_in_month * $current_month;
	$current_year = 60 * 60 * 24 * 365 * $current_year;
	$current_hour = 60 * 60 * $current_hour;
	$current_minute = 60 * $current_minute;
	
	
	
	$date_split = explode(" ", $date);
	$mdy = $date_split[0];
	$mdy = explode(".", $mdy);
	$month = $mdy[0];
	$day = $mdy[1];
	$year = $mdy[2];
	$nu_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	$nu_of_days_in_month = 30;
	
	if (!isset($date_split[1])) { $hour = 0; $minute = 0; $second = 0;}
	else {$his = $date_split[1];
	$his = explode(":", $his);
	$hour = $his[0];
	$minute = $his[1];
	$second = $his[2];
	}
	
	
	$year = 60 * 60 * 24 * 365 * $year;
	$day = 60 * 60 * 24 * $day;
	$month = 60 * 60 * 24 * $nu_of_days_in_month * $month;
	$hour = 60 * 60 * $hour;
	$minute = 60 * $minute;
	
	$year_left = $current_year - $year;
	$month_left = $current_month - $month;
	$day_left = $current_day - $day;
	$hour_left = $current_hour - $hour;
	$minutes_left = $current_minute - $minute;
	$seconds_left = $current_second - $second;
	
	$overall = $year_left + $month_left + $day_left + $hour_left + $minutes_left + $seconds_left;



	return $overall;

	
	}
	
	function datetostring($date) {
		
		$current_time = date("H-i-s");
	$current_month = date("m");
	$current_year = date("y");
	$nu_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
	$nu_of_days_in_month = 30;
	$current_day = date("d");

	$current_hour = date("H");
	$current_minute = date("i");
	$current_second = date("s");
	
	$current_day = 60 * 60 * 24 * $current_day;
	$current_month = 60 * 60 * 24 * $nu_of_days_in_month * $current_month;
	$current_year = 60 * 60 * 24 * 365 * $current_year;
	$current_hour = 60 * 60 * $current_hour;
	$current_minute = 60 * $current_minute;
	
	
	
	$date_split = explode(" ", $date);
	$mdy = $date_split[0];
	$mdy = explode(".", $mdy);
	$month = $mdy[0];
	$day = $mdy[1];
	$year = $mdy[2];
	$nu_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	$nu_of_days_in_month = 30;
	
	if (!isset($date_split[1])) { $hour = 0; $minute = 0; $second = 0;}
	else {$his = $date_split[1];
	$his = explode(":", $his);
	$hour = $his[0];
	$minute = $his[1];
	$second = $his[2];
	}
	
	
	$year = 60 * 60 * 24 * 365 * $year;
	$day = 60 * 60 * 24 * $day;
	$month = 60 * 60 * 24 * $nu_of_days_in_month * $month;
	$hour = 60 * 60 * $hour;
	$minute = 60 * $minute;
	
	$year_left = $current_year - $year;
	$month_left = $current_month - $month;
	$day_left = $current_day - $day;
	$hour_left = $current_hour - $hour;
	$minutes_left = $current_minute - $minute;
	$seconds_left = $current_second - $second;
	
	$overall = $year_left + $month_left + $day_left + $hour_left + $minutes_left + $seconds_left;
	
	$minutes = $overall / 60;
	$minutes = ceil($minutes);
	
	$ago = "לפני";
	
	if ($overall < 60) {
		
		if ($overall == 1) {
			return "שנייה";
		}
		
		else {return $overall." שניות";}
	}
	
	else {
	// דקות
	if ($minutes < 60) {
		if ($minutes == 1) {
		return "דקה";
		}
		else {return $minutes." דקות";}
	}
	
	else {
		$hours = $minutes / 60;
		$hours = ceil($hours);
		
		if ($hours < 24) {
			
		if ($hours == 1) {
		return "שעה";
		}
		
		else if ($hours == 2) {
		return "שעתיים";
		}
		
	    else {return $hours." שעות";}
		}
		
		else {
		$days = $hours / 24;
		$days = ceil($days);
		
		if ($days < 7) {
			
		if ($days == 1) {
			return "יום";
		}
		
		else if ($days == 2) {
			return "יומיים";
		}
		
	    else {return $days." ימים";}
		}
		
		else {
		$weeks = $days / 7;
		$weeks = ceil($weeks);	
		
		if ($weeks < 5) {
			if ($weeks == 1) {
			return "שבוע";
		}
		
		else if ($weeks == 2) {
			return "שבועיים";
		}
		
	    else {return $weeks." שבועות";}
		}
				
		else {
		$months = $weeks / 4;
		$months = ceil($months);
		
		if ($months < 12) {
			
			if ($months == 1) {
			return "חודש";
		}
		
		else if ($months == 2) {
			return "חודשיים";
		}
			
	    else {return $months." חודשים";}
		}
		
		
		
		else {
		$years = $months / 12;
		$years = ceil($years);
		
		if ($years == 1) {
			return "שנה";
		}
		
		else if ($years == 2) {
			return "שנתיים";
		}
		
		else {return $months." שנים";}
			
		}
		}
			
		}
		}
	}
	}



	

	

	
	}	
}

?>
