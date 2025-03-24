<?php defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['public'] = "login";
$route['no_access/([^/]+)'] = 'no_access/index/$1';
$route['no_access/([^/]+)/([^/]+)'] = 'no_access/index/$1/$2';

$route['reports/brand_inventory'] = 'reports/brand_inventory_input';
$route['reports/brand_inventory/(any)'] = 'reports/brand_inventory_input/$1';

$route['sales/index/([^/]+)'] = 'sales/manage/$1';
$route['sales/index/([^/]+)/([^/]+)'] = 'sales/manage/$1/$2';
$route['sales/index/([^/]+)/([^/]+)/([^/]+)'] = 'sales/manage/$1/$2/$3';


$route['reports/(summary_:any)/([^/]+)/([^/]+)'] = 'reports/$1/$2/$3/$4';
$route['reports/summary_expenses_categories'] = 'reports/date_input_only';
$route['reports/summary_payments'] = 'reports/date_input_only';
$route['reports/summary_discounts'] = 'reports/summary_discounts_input';
$route['reports/summary_:any'] = 'reports/date_input';

$route['reports/(graphical_:any)/([^/]+)/([^/]+)'] = 'reports/$1/$2/$3/$4';
$route['reports/graphical_summary_expenses_categories'] = 'reports/date_input_only';
$route['reports/graphical_summary_discounts'] = 'reports/summary_discounts_input';
$route['reports/graphical_:any'] = 'reports/date_input';


$route['reports/(inventory_:any)/([^/]+)'] = 'reports/$1/$2';
$route['reports/inventory_summary'] = 'reports/inventory_summary_input';
$route['reports/(inventory_summary)/([^/]+)/([^/]+)/([^/]+)'] = 'reports/$1/$2';

$route['reports/(detailed_:any)/([^/]+)/([^/]+)/([^/]+)'] = 'reports/$1/$2/$3/$4';
$route['reports/detailed_sales'] = 'reports/date_input_sales';
$route['reports/detailed_receivings'] = 'reports/date_input_recv';

$route['reports/(specific_:any)/([^/]+)/([^/]+)/([^/]+)'] = 'reports/$1/$2/$3/$4';
$route['reports/specific_customer'] = 'reports/specific_customer_input';
$route['reports/specific_employee'] = 'reports/specific_employee_input';
$route['reports/specific_discount'] = 'reports/specific_discount_input';
$route['reports/specific_supplier'] = 'reports/specific_supplier_input';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
