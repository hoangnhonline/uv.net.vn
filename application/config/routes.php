<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] 						= 		'HomeController';
$route['404_override'] 								= 		'';
$route['translate_uri_dashes']						= 		TRUE;

$route['admin'] 									= 		'admin/Administrator/index/dashboard';
$route['admin/login']								=		'admin/Login/index';
$route['admin/signout']								=		'admin/Administrator/signout';
$route['admin/(:any)'] 								= 		'admin/Administrator/index/$1';
$route['get-controller/add-point'] 					= 		'Get_controller/add_point';
$route['get-controller/add-point'] 					= 		'Get_controller/add_point';

$route['get-controller/admin/add/(:any)'] 			= 		'Get_controller/admin/$1/add';
$route['get-controller/admin/del/(:any)'] 			= 		'Get_controller/admin/$1/del';


$route['get-controller/ftp'] 						= 		'Get_controller/ftp';
$route['get-controller/image/(:num)'] 				= 		'Get_controller/get_shop_image/$1';
$route['get-controller/select'] 					= 		'Get_controller/select';
$route['get-controller/search/(:any)'] 				= 		'Get_controller/search/$1';
$route['get-controller/custom-search']				= 		'Get_controller/custom-search';
$route['get-controller/(:any)'] 					= 		'Get_controller/index/$1';
$route['get-controller/(:any)/(:any)'] 				= 		'Get_controller/index/$1/$2';
$route['get-controller/(:any)/(:any)/(:any)'] 		= 		'Get_controller/index/$1/$2/$3';
$route['get-company/(:num)']						= 		'Get_controller/get_company_info/$1';
$route['get-user/(:num)']							= 		'Get_controller/get_user_info/$1';
$route['get-shop/(:num)']							= 		'Get_controller/get_shop_info/$1';
$route['get-group/(:num)']							= 		'Get_controller/get_group_info/$1';

$route['admin/action/(:any)/(:any)']				=		'admin/Action_controller/index/$1/$2';