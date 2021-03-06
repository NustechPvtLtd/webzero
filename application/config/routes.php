<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "login/login";
$route['404_override'] = '';
$route['forgot-password'] = 'login/forgot-password';
$route['reset-password/(:any)'] = 'login/reset-password/$1';
$route['register'] = 'login/register';
$route['recruiter'] = 'login/registerEmployer';
$route['create-user'] = 'login/create_user';
$route['create-group'] = 'login/create_group';
$route['choose-plan/(:any)'] = 'login/choose_plan/$1';
$route['update-plan'] = 'login/update_plan';
$route['payment-success'] = 'login/payment_success';
$route['payment-failed'] = 'login/payment_failed';
$route['payment-cancel'] = 'login/payment_cancel';
$route['invite-user'] = 'user/invite';
$route['logout'] = 'login/logout';
$route['ajaxLogin'] = 'login/ajaxLogin';
$route['privacy'] = 'login/privacy_policy';
$route['terms-and-condition'] = 'login/terms_and_condition';
$route['assets/(:any)'] = "sites/assets/$1";
$route['account/upgrades'] = "account/account/account_upgrade_list";
$route['account/plans'] = 'account/account/plans';
$route['plans'] = 'account/plans/index';
$route['plans/update/(:any)'] = 'account/plans/editPlans/$1';
$route['plans/delete/(:any)'] = 'account/plans/deletePlans/$1';
$route['plans/create'] = 'account/plans/editPlans';
$route['plans/(:any)'] = 'account/plans/$1';
$route['api/login'] = 'api/generate_key/index';
$route['api/(:any)'] = 'api/$1';
$route['resume-settings'] = 'sites/resumeSearchSettings';
$route['templates/preview/(:any)/(:any)']='templates/preview/$1/$2';
$route['products/buynow/(:any)']='products/buynow/$1';
//$route['plans/recommends/(:any)/(:any)'] = 'account/plans/recommends/$1/$2';
//$route['plans/status/(:any)/(:any)'] = 'account/plans/status/$1/$2';
/* End of file routes.php */
/* Location: ./application/config/routes.php */