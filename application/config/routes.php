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

$route['default_controller'] = "index";
$route['404_override'] = 'page';

// custom routing
$route['admin'] = 'admin/index';
$route['admin/team'] = 'admin/team/index';
$route['admin/team/add-update'] = 'admin/team/add_update';
$route['admin/team/delete/(:num)'] = 'admin/team/delete_team/$1';
$route['admin/team/add-update/(:num)'] = 'admin/team/add_update';
$route['admin/logout'] = 'admin/index/logout';
$route['admin/content/add-update'] = 'admin/content/add_update';
$route['admin/content/add-update/(:num)'] = 'admin/content/add_update';
$route['admin/content/pages/(:num)'] = 'admin/content/pages/$1';
$route['admin/content/delete-page/(:num)'] = 'admin/content/delete_page/$1';
$route['admin/content/delete-banner/(:num)'] = 'admin/content/delete_banner/$1';
$route['admin/content/add-update-banner'] = 'admin/content/add_update_banner';
$route['admin/content/add-update-banner/(:num)'] = 'admin/content/add_update_banner';
$route['admin/subscriber/delete/(:num)'] = 'admin/subscriber/delete_subscriber/$1';
$route['admin/testimonial'] = 'admin/testimonial/index';
$route['admin/testimonial/(:num)'] = 'admin/testimonial/index/$1';
$route['admin/testimonial/add-update'] = 'admin/testimonial/add_update';
$route['admin/testimonial/add-update/(:num)'] = 'admin/testimonial/add_update';
$route['admin/testimonial/delete/(:num)'] = 'admin/testimonial/delete_testimonial/$1';
$route['admin/discount/(:num)'] = 'admin/discount/index/$1';
$route['admin/trip/(:num)'] = 'admin/trip/index/$1';
$route['admin/departure/(:num)'] = 'admin/departure/index/$1';
$route['admin/subscriber/(:num)'] = 'admin/subscriber/index/$1';

$route['admin/seo'] = 'admin/seo/save';

$route['admin/tripslider/(:num)'] = 'admin/tripslider/index/$1';
$route['admin/tripmenu/(:num)'] = 'admin/tripmenu/index/$1';
$route['admin/destination/(:num)'] = 'admin/destination/index/$1';
$route['admin/activity/(:num)'] = 'admin/activity/index/$1';

$route['admin/why-travel-with-us'] = 'admin/whyTravelWithUs/index';
$route['admin/why-travel-with-us/form'] = 'admin/whyTravelWithUs/addUpdate';
$route['admin/why-travel-with-us/delete/(:num)'] = 'admin/whyTravelWithUs/delete/$1';
$route['admin/why-travel-with-us/edit/(:num)'] = 'admin/whyTravelWithUs/edit/$1';

$route['admin/redirections'] = 'admin/redirections/index';
$route['admin/redirections/(:num)'] = 'admin/redirections/index/$1';
$route['admin/redirections/form'] = 'admin/redirections/addUpdate';
$route['admin/redirections/delete/(:num)'] = 'admin/redirections/delete/$1';
$route['admin/redirections/edit/(:num)'] = 'admin/redirections/edit/$1';


$route['search'] = 'trips/search';
$route['async-trip-search'] = "trips/asyncTripSearch";
$route['search/(:num)'] = 'trips/search/$1';
$route['trips/booking/(:any)'] = 'trips/booking';
$route['print/(:any)'] = 'trips/print_trip/$1';
$route['trips/quick_book'] = 'trips/quick_book';
$route['trips/review'] = 'trips/review';
$route['trips/review/(:any)'] = 'trips/review';
$route['trips/(:num)'] = 'trips/index/$1';

$route['trip-all'] = 'TripController/allTrip';
$route['trip-all/(:any)'] = 'TripController/allTrip/$1';
$route['trip-dest/(:any)'] = 'TripController/destination/$1';
$route['trip-act/(:any)'] = 'TripController/activity/$1';
$route['trip-dest-act/(:any)'] = 'TripController/destinationActivity/$1';



//$route['trips/(:any)'] = 'trips/index';
$route['destinations/(:any)'] = 'destinations/index';
$route['activities/(:any)'] = 'activities/index';
$route['about-us'] = 'page/index';
$route['contact-us'] = 'page/index';
$route['thank-you'] = 'welcome/thankyou';
$route['blog/(:any)'] = 'blog/index';
$route['destinations/(:any)/(:any)'] = 'destinations/index';
$route['ask-expert'] = 'page/ask_expert';
$route['send-to-friend'] = 'page/send_to_friend';
$route['page/contact'] = 'page/contact';
$route['gallery'] = 'gallery/index';
$route['gallery/(:any)'] = 'gallery/index/$1';
$route['welcome/add_subscriber'] = 'welcome/add_subscriber';

$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
if($uri_segments[1] != 'admin')
	$route['(:any)/(:any)'] = 'trips/index';
/* End of file routes.php */
/* Location: ./application/config/routes.php */