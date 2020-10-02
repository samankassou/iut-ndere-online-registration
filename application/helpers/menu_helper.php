<?php

function active_menu($menu){
	$CI =& get_instance();
	$classname = $CI->router->fetch_class();
	return $classname == $menu?'active':'';
}