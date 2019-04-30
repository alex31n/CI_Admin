<?php


if(!function_exists('show_date'))
{
	function show_date($givenDate, $format='d M, Y')
	{
		return date($format, $givenDate);
	}
}
