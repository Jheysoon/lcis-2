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
