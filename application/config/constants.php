<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE',    0644);
define('FILE_WRITE_MODE',   0666);
define('DIR_READ_MODE',     0755);
define('DIR_WRITE_MODE',    0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',				'rb');
define('FOPEN_READ_WRITE',			'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',	'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',			'ab');
define('FOPEN_READ_WRITE_CREATE',		'a+b');
define('FOPEN_WRITE_CREATE_STRICT',		'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',	'x+b');


/*
|--------------------------------------------------------------------------
| Sitewide Constants
|--------------------------------------------------------------------------
|
| These constants are used in place of hardcoded strings or variables
| when and where ever possible
|
*/
define('SITENAME',              'GreenTel');
define('EMAILRECEIVER',         'contact@osamashabrez.com');
define('IMAGEPATH',             'images');
define('JAVASRIPT',             'javascript');
define('ADMINHOMEPAGE',         'Admin Panel');
define('MANAGEPRODUCTS',        'Manage Products');
define('ADDNEWPRODUCT',         '+ Add New Product');
define('ADDNEWCATEGORY',        '+ Manage Categories');
define('DELETECATEGORY',        'x');
define('DELETECATEGORYWARNING', '<strong>Warning:</strong> Removing category will make all its products removed from your inventory. Double check before you proceed.');
define('PRODUCTIMAGE',          '/products/');
define('EDITPRODUCT',           '+ Edit');
define('DELETEPRODUCT',         '- Remove Product');
define('CKEDITOR',              '/ckeditor/ckeditor.js');
define('UPLOADPATH',            './images/products');
define('MANAGEPAGES',           'Manage Static Pages');
define('ADDNEWPAGE',            'Add New Page');
/* End of file constants.php */
/* Location: ./application/config/constants.php */