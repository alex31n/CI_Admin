<?php
function ax_input($type, $name, $value='', $place_holder = '', $error_enable = false, $extra=array())
{
	$atr = array(
		'type' => $type,
		'name' => $name,
		'id' => $name,
		//'value' => set_value($value),
		'value' => $value,
		'class' => 'form-control ',
		'placeholder' => $place_holder,
	);

	if ($error_enable && form_error($name)){
		$atr['class']= $atr['class']. ' is-invalid';
	}

	$str= form_input($atr, '', $extra);

	if ($error_enable && form_error($name)) {
		$str .= '<div class="invalid-feedback">' . form_error($name) . '</div>';
	}

	return $str;
}

function ax_hidden($name, $value){
	return form_hidden($name, $value);
}

function ax_text($name, $value, $place_holder = '', $error_enable = false){
	return ax_input('text', $name, $value, $place_holder, $error_enable);
}

function ax_password($name, $value, $error_enable = false){
	return ax_input('password', $name, $value, '', $error_enable);
}
function ax_email($name, $value, $place_holder = '', $error_enable = false){
	return ax_input('email', $name, $value, $place_holder, $error_enable);
}
function ax_phone($name, $value, $place_holder = '', $error_enable = false){
	$extra = array(
		'pattern'=>"[0-9]+",
		/*'title'=>'Phone Number (Format: +99(99)9999-9999)',*/
		'oninvalid'=>"this.setCustomValidity('Enter phone number')"
	);
	return ax_input('tel', $name, $value, $place_holder, $error_enable, $extra);
}


/*function ax_textarea($name, $value, $place_holder = '', $error_enable = false){
	$atr = array(
		'name'=>$name,
		'value'=>$value,
		'class' => 'form-control ',
		'placeholder' => $place_holder,

	);
	if ($error_enable && form_error($name)){
		$atr['class']= $atr['class']. ' is-invalid';
	}

	$str= form_textarea($name);

	if ($error_enable && form_error($name)) {
		$str .= '<div class="invalid-feedback">' . form_error($name) . '</div>';
	}
	return $str;
}*/




