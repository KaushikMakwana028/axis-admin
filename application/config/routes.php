<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Authentication
$route['login'] = 'login/index';
$route['logout'] = 'login/logout';

// Dashboard
$route['dashboard'] = 'dashboard/index';

// Category
$route['category'] = 'category/index';
$route['category/add'] = 'category/add';
$route['category/edit/(:num)'] = 'category/edit/$1';
$route['category/delete/(:num)'] = 'category/delete/$1';
$route['category/status/(:num)'] = 'category/status/$1';

// Subcategory
$route['sub_category'] = 'sub_category/index';
$route['sub_category/add'] = 'sub_category/add';
$route['sub_category/edit/(:num)'] = 'sub_category/edit/$1';
$route['sub_category/delete/(:num)'] = 'sub_category/delete/$1';
$route['sub_category/status/(:num)'] = 'sub_category/status/$1';

// Aliases for Subcategory
$route['subcategory'] = 'sub_category/index';
$route['subcategory/(:any)'] = 'sub_category/$1';
$route['sub-category'] = 'sub_category/index';
$route['sub-category/(:any)'] = 'sub_category/$1';

// Profile
$route['profile'] = 'profile/index';

// Backwards compatibility aliases for /admin routes
$route['admin'] = 'dashboard/index';
$route['admin/login'] = 'login/index';
$route['admin/logout'] = 'login/logout';
$route['admin/dashboard'] = 'dashboard/index';
$route['admin/categories'] = 'category/index';
$route['admin/category_add'] = 'category/add';
$route['admin/category_edit/(:num)'] = 'category/edit/$1';
$route['admin/category_delete/(:num)'] = 'category/delete/$1';
$route['admin/category_status/(:num)'] = 'category/status/$1';
$route['admin/subcategories'] = 'sub_category/index';
$route['admin/subcategory_add'] = 'sub_category/add';
$route['admin/subcategory_edit/(:num)'] = 'sub_category/edit/$1';
$route['admin/subcategory_delete/(:num)'] = 'sub_category/delete/$1';
$route['admin/subcategory_status/(:num)'] = 'sub_category/status/$1';
$route['admin/profile'] = 'profile/index';

// API Routes
$route['api/login'] = 'api/login';
$route['api/register'] = 'api/register';
$route['api/profile'] = 'api/get_profile';
$route['api/get_profile'] = 'api/get_profile';
$route['api/get_category_list'] = 'api/get_category_list';
$route['api/get_category_detail'] = 'api/get_category_detail';
$route['api/get_subcategory_list'] = 'api/get_subcategory_list';
$route['api/get_subcategory_detail'] = 'api/get_subcategory_detail';
$route['api/get_subcategory_by_category'] = 'api/get_subcategory_by_category';
$route['api/get_product_list'] = 'api/get_product_list';
$route['api/get_product_detail'] = 'api/get_product_detail';
$route['api/get_file_type_list'] = 'api/get_file_type_list';


