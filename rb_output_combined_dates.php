<?
	/*
	 * Intelligently outputs a date format of two combined dates
	 * Input date format is yyyy-mm-dd
	 * Outputs things like:
	 *		December 10, 2012 (if the two dates are the same)
	 *		November 1 - 10, 2012 (if the dates are in the same month and year)
	 *		October 30 - November 2, 2012 (if dates span more than one month)
	 *		December 31, 2012 - January 1, 2013 (if the dates span more than one year)
	 *
	 * @param string $date_start
	 * @param string $date_end
	 * @return string
	 *
	 */
	function rb_output_combined_dates( $date_start, $date_end )
	{
		if( $date_start == $date_end ) { 
		// if they're the same day, just output that day
			$date_start = explode( "-", $date_start );
			$output = date("F j, Y", mktime(0, 0, 0, $date_start[1], $date_start[2], $date_start[0]));
		} else {
		// if they're different, start the fancy combination
		
			$date_start = explode( "-", $date_start );
			$time_start = mktime(0, 0, 0, $date_start[1], $date_start[2], $date_start[0]);
			$date_end = explode( "-", $date_end );
			$time_end = mktime(0, 0, 0, $date_end[1], $date_end[2], $date_end[0]);
			
			// generate month text
			$month_start = date( "F ", $time_start );
				if( $date_start[1] == $date_end[1] ):
					$month_end = ""; // month is the same, don't show the second one
				else:
					$month_end = date( "F ", $time_end );
				endif;
			
			// generate day text
			$day_start = date( "j", $time_start );
			$day_end = date( "j", $time_end );
			
			// generate year text
			$year_end = date( ", Y", $time_end );
				if( $date_start[0] == $date_end[0] ):
					$year_start = "";
				else:
					$year_start = date( ", Y", $time_end );
					$month_end = date( "F ", $time_end ); // different years, force the end month to show
				endif;
			
			$output = $month_start . $day_start . $year_start. " - " . $month_end . $day_end . $year_end;
		}
		
		return $output;
	}

?>