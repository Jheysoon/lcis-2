<?php

use Illuminate\Http\Request;

if (! function_exists('set_value')) {
    // for testing
    function set_value($field, $default = '')
	{
        return \Request::get($field, $default);
	}
}

// for testing
if ( ! function_exists('set_select')) {

	function set_select($field, $value = '', $default = FALSE)
	{
        $input = \Request::get($field);

		if ($input === NULL) {
			return ($default === TRUE) ? ' selected="selected"' : '';
		}

		$value = (string) $value;

		if (is_array($input)) {
			// Note: in_array('', array(0)) returns TRUE, do not use it
			foreach ($input as &$v) {

				if ($value === $v) {
					return ' selected="selected"';
				}
			}

			return '';
		}

		return ($input === $value) ? ' selected="selected"' : '';
	}
}

// for testing
if ( ! function_exists('set_checkbox')) {

	function set_checkbox($field, $value = '', $default = FALSE)
	{
        $input = \Request::get($field);

		if ($input === NULL) {
			return ($default === TRUE) ? ' checked="checked"' : '';
		}

		$value = (string) $value;

		if (is_array($input)) {
			// Note: in_array('', array(0)) returns TRUE, do not use it
			foreach ($input as &$v) {

				if ($value === $v) {
					return ' checked="checked"';
				}
			}

			return '';
		}

		return ($input === $value) ? ' checked="checked"' : '';
	}
}

if ( ! function_exists('htmlAlert')) {

	function htmlAlert($message, $type = 'danger')
	{
		return '<div class="alert alert-'.$type.' text-center">'.$message.'</div>';
	}
}

if (! function_exists('intersectCheck')) {

	// 1:00-3:00 / 2:00-5:00

	//$from = 1:00,	$from_compare 	= 2:00
	//$to 	= 3:00,	$to_compare 	= 5:00
    function intersectCheck($from, $from_compare, $to, $to_compare)
	{
        if ($from == $from_compare AND $to == $to_compare)
            return true;

        $from 			= strtotime($from);
        $from_compare 	= strtotime($from_compare);
        $to 			= strtotime($to);
        $to_compare 	= strtotime($to_compare);
        $intersect 		= min($to, $to_compare) - max($from, $from_compare);

        if ( $intersect < 0 ) $intersect = 0;
        $overlap = $intersect / 3600;
        if ( $overlap <= 0 ):
            // There are no time conflicts
            return false;
            else:
            // There is a time conflict
            // echo '<p>There is a time conflict where the times overlap by ' , $overlap , ' hours.</p>';
            return true;
        endif;
    }
}
