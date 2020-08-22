<?php

function displayAlert()
{
	if (Session::has('message'))
	{
		list($type, $message) = explode('|', Session::get('message'));

		$style = "";
		if ($type == 'error') 
		{
			$style = "danger";
			$mark = 'times';
		}
		else
		{
			$style ='success';
			$mark = 'check';
		}
		return sprintf('<div class="alert alert-'.$style.' alert-dismissible"><button type="button" aria-hidden="true" class="close"><i class="material-icons">close</i></button><h5><i class="icon fas fa-'.$mark.'"></i> %s !</h5> %s</div>', $style, $message);
	}
	
	return '';
}