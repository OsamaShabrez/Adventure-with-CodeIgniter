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
/* Default Routes */
$route['default_controller']        = 'catalog/view';
/* Admin Route */
$route['admin']                     = 'admin/index';
$route['admin/index']               = 'admin/index';
$route['admin/check-status']        = 'admin/checkstatus';
$route['admin/manage-products']     = 'admin/manageProducts';
$route['admin/manage-stock']        = 'admin/manageStock';
$route['admin/manage-orders']       = 'admin/manageOrders';
$route['admin/profile']             = 'admin/profile';
$route['admin/logout']              = 'admin/lognout';
/* Static Pages Routes */
$route['page/processcontactform']   = 'staticpages/processcontactform';
$route['page/contact-us']           = 'staticpages/showcontactform';
$route['page/sign-in']              = 'staticpages/signin';
$route['page/sign-up']              = 'staticpages/signup';
$route['page/logout']               = 'staticpages/signout';
$route['page/(:any)']               = 'staticpages/page/$1';
/* Catalog Pages Routes */
$route['category/(:any)']           = 'catalog/category/$1';
$route['(:any)']                    = 'catalog/view/$1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
