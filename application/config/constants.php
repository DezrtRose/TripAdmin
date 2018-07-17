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
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

// my constants
define('FRONTEND', 'frontend/include/template');
define('BACKEND', 'admin/include/template');
define('SITE_NAME', 'Black Diamond Expedition P. Ltd.');
define('SITE_EMAIL', 'info@blackdiamondexpedition.com');
//define('SITE_EMAIL', 'blackdiamond@thirdeyesystem.com');
define('SITE_REPLY_TO_EMAIL', 'info@blackdiamondexpedition.com');
define('NUMBER', '+977-01-4412922');
define('LANDLINE', '+977-01-4412922');
define('FAX', '+977-01-4412922');
define('STREET', 'Some Street');
define('SITE', 'http://blackdiamondexpedition.com/');
define('SITE_ADDRESS', 'Thamel, Kathmandu, Nepal');
define('FB_LINK', 'https://www.facebook.com/BlackDiamondExpedition');
define('TWITTER_LINK', 'https://twitter.com/BDExTrek');
define('GP_LINK', 'https://plus.google.com/u/0/107230115122757396326');
define('SKYPE_LINK', 'blackdiamondexpedition');
define('LINKED_LINK', 'https://www.linkedin.com/in/blackdiamondexpedition/');
define('INSTA_LINK', 'https://www.instagram.com/blackdiamondexpeditions/');
define('PINTEREST_LINK', 'https://www.pinterest.com/blackdiamondexpeditions/');
define('FILENAME_REDIRECTS_CACHE', 'redirect_cache.txt');

/* End of file constants.php */
/* Location: ./application/config/constants.php */