<?php
function get_age($birthDate)
{
    $birthDate = explode("/", $birthDate);
    //get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
        ? ((date("Y") - $birthDate[2]) - 1)
        : (date("Y") - $birthDate[2]));
    return $age;
}

function flash()
{
    $ci = & get_instance();
    if ($ci->session->flashdata('msg')) {
        echo
            '<div class="alert alert-info alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'
            . $ci->session->flashdata('msg') .
            '</div>';
    }
}

function check_user($check_index = 'current_user')
{
    $ci = & get_instance();
    return ($ci->session->userdata($check_index)) ? $ci->session->userdata($check_index) : false;
}

function check_front_user()
{
    $ci = & get_instance();
    return ($ci->session->userdata('front_user')) ? $ci->session->userdata('front_user') : false;
}

function get_userdata($index)
{
    $ci = & get_instance();
    return $ci->session->userdata($index) ? $ci->session->userdata($index) : false;
}

function php_thumb_image($url, $file, $width, $height, $crop = false, $class = '', $alt_tag = '', $return = false)
{
    $path = $file != '' && file_exists($url . $file) ? base_url(substr($url, 2) . $file) : base_url('images/no-image.jpg');
    echo !$return ?
        '
        <img '.$alt_tag.' '.$class.' src="' . base_url() . 'assets/phpthumb/phpThumb.php?src=' . urlencode($path) . '&amp;w=' . $width . '&amp;h=' . $height . '&amp;zc=' . $crop . '">
    ' :
	    base_url() . 'assets/phpthumb/phpThumb.php?src=' . urlencode($path) . '&amp;w=' . $width . '&amp;h=' . $height . '&amp;zc=' . $crop;
}

function php_thumb_image1($url, $width, $height, $crop = false, $class = '')
{
    $path = $url != '' && file_exists('./'.$url) ? base_url($url) : base_url('img/no-image.jpg');
    echo
        '
        <img '.$class.' src="' . base_url() . 'assets/phpthumb/phpThumb.php?src=' . urlencode($path) . '&amp;w=' . $width . '&amp;h=' . $height . '&amp;zc=' . $crop . '">
    ';
}

function debug($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die;
}

function sendemail($params)
{
    //Filtering @params
    $params['from_name'] = (!isset($params['from_name'])) ? '' : $params['from_name'];
    $params['replytoname'] = (!isset($params['replytoname'])) ? '' : $params['replytoname'];

    $ci = & get_instance();

    //Loading email library
    $ci->load->library('email');
    $mail = $ci->email;
    $mail->initialize(array('mailtype' => 'html'));

    //Set who the message is to be sent from
    $mail->from($params['from'], $params['from_name']);

    //Set an alternative reply-to address
    $mail->reply_to($params['replyto'], $params['replytoname']);

    //Set who the message is to be sent to
    $mail->to($params['sendto']);

    if (isset($params['bcc'])) {
        //Set the BCC address
        $mail->bcc($params['bcc']);
    }

    if (isset($params['cc'])) {
        //Set the CC address
        $mail->bcc($params['cc']);
    }

    //Set the subject line
    $mail->subject($params['subject']);

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->message($params['message']);

    //send the message, check for errors
    if (!$mail->send()) {
        echo $mail->print_debugger();
        die;
    } else {
        return true;
    }
}

function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }

    return array(
        'userAgent' => $u_agent,
        'name' => $bname,
        'version' => $version,
        'platform' => $platform,
        'pattern' => $pattern
    );
}

function get_user($id)
{
    $ci = & get_instance();
    $q = $ci->db->get_where('tbl_user', array('id' => $id))->result_array();
    if ($q)
        return $q[0];
    else
        return false;
}

function segment($seg)
{
    $ci = & get_instance();
    return $ci->uri->segment($seg);
}

function get_care_detail($care_type)
{
    $ci = & get_instance();
    $q = $ci->db->get_where('tbl_care', array('id' => $care_type))->result_array();
    return $q[0];
}

function get_care()
{
    $ci = & get_instance();
    $ci->db->order_by('service_by ASC');
    $q = $ci->db->get_where('tbl_care')->result_array();
    return $q;
}

function get_unread_ticket_count()
{
    $ci = & get_instance();
    $ci->db->like('view', '0');
    $ci->db->from('tbl_tickets_history');
    return $ci->db->count_all_results();
}

function encrypt_decrypt($action, $string)
{
    $output = false;

    $key = '!@#$%^&*';

    // initialization vector
    $iv = md5(md5($key));

    if ($action == 'encrypt') {
        $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
        $output = rtrim($output, "");
    }
    return $output;
}

function home_flash()
{
    $ci = & get_instance();
    if ($ci->session->flashdata('msg')) {
        echo '<script>$.jGrowl("' . $ci->session->flashdata('msg') . '")</script>';
    }
}

function set_flash($index, $msg)
{
    $ci = & get_instance();
    $ci->session->set_flashdata($index, $msg);
}

function generateString()
{
    $number = base64_encode(random_string('alnum', 20));
    $newstr = preg_replace('/[^a-zA-Z0-9\']/', '', $number);
    return substr($newstr, 0, 10); // return string of 10 random character
}

function swiftsend($param)
{
    include_once APPPATH.'third_party/swiftmailer/swift_required.php';

    $numSent = 0; // Var to store the number of successful email recipients

    if($_SERVER['HTTP_HOST'] == 'localhost') {
        ini_set("SMTP","ssl://smtp.gmail.com");
        ini_set("smtp_port","465");
        $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', '465', 'ssl')
            ->setUsername('digital.design.satish@gmail.com')
            ->setPassword('n3v3rs@ydi3');
    } else {
        $transport = Swift_SendmailTransport::newInstance();
    }

    $mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance($param['subject'])
        ->setFrom($param['from'])
        ->setReplyTo($param['reply'])
        ->setBody($param['msg'], 'text/html');

    // Sending bulk email such that the people in the list will not be aware of eachother
    foreach ($param['recipients'] as $address => $name)
    {
        if (is_int($address)) {
            $message->setTo($name);
        } else {
            $message->setTo(array($address => $name));
        }

        $numSent += $mailer->send($message, $failedRecipients);
    }
    $return = array('sent' => $numSent, 'failed' => $failedRecipients);

    return (isset($param['return']) && $param['return']) ? $return : true;
}

function uniqueid($prefix, $length = 4, $search_table, $search_column)
{
    $ci = &get_instance();
    $id = $prefix.substr(rand(1111111111, 9999999999), 0, $length);
    $checks = $ci->db->get_where($search_table, array($search_column => $id));
    if($checks->num_rows() > 0)
        uniqueid($prefix, $length, $search_table, $search_column);
    else
        return $id;
}

function calDistance($inLatitude, $inLongitude, $outLatitude, $outLongitude, $unit)
{
    if (empty($inLatitude) || empty($inLongitude) || empty($outLatitude) || empty($outLongitude))
        return 0;
    $url = "http://maps.googleapis.com/maps/api/directions/json?origin=$inLatitude,$inLongitude&destination=$outLatitude,$outLongitude&sensor=false";
    $c = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_URL, $url);
    $jsonResponse = curl_exec($c);
    curl_close($c);

    $dataset = json_decode($jsonResponse);
    if (!$dataset)
        return 0;
    if (!isset($dataset->routes[0]->legs[0]->distance->value))
        return 0;
    $distance = $dataset->routes[0]->legs[0]->distance->value;
    if ($unit == "K") {
        return round(($distance / 1000), 2); //kilometer
    } else if ($unit == "M") {
        return round(($distance * 0.000621371), 2); //miles
    } else {
        return round($distance, 2); //meter
    }
}

function getNearby($lat, $lng, $table_name, $fromdate, $todate, $distance = 50, $type = 'cities', $limit = 50, $unit = 'km')
{
    // radius of earth; @note: the earth is not perfectly spherical, but this is considered the 'mean radius'
    if ($unit == 'km') $radius = 6371.009; // in kilometers
    elseif ($unit == 'mi') $radius = 3958.761; // in miles

    // latitude boundaries
    $maxLat = (float) $lat + rad2deg($distance / $radius);
    $minLat = (float) $lat - rad2deg($distance / $radius);

    // longitude boundaries (longitude gets smaller when latitude increases)
    $maxLng = (float) $lng + rad2deg($distance / $radius / cos(deg2rad((float) $lat)));
    $minLng = (float) $lng - rad2deg($distance / $radius / cos(deg2rad((float) $lat)));

    $ci = &get_instance();
    // get results ordered by distance (approx)
    $nearby = $ci->common_model->get_where($table_name, array('lat >' => $minLat, 'lat <' => $maxLat, 'long >' => $minLng, 'long <' => $maxLng, 'pickup_date >=' => $fromdate, 'pickup_date <=' => $todate, 'lead_price !=' => '', 'status' => 1));

    return $nearby;
}

function count_trips($column, $id)
{
    if($column == 'act_id')
        $table = 'tbl_trip_activity';
    else
        $table = 'tbl_trips';
    $ci = &get_instance();
    $result = $ci->db->get_where($table, array($column => $id))->result_array();

    return count($result);
}

function get_trip_name($review_id)
{
	$ci = &get_instance();
	$trip_id = $ci->common_model->get_where('tbl_trip_review', array('review_id' => $review_id), '', '', true)->trip_id;
	$trip_name = $ci->common_model->get_where('tbl_trips', array('id' => $trip_id), '', '', true)->name;
	echo $trip_name;
}

function get_review_count($trip_id)
{
	$ci = &get_instance();
	$query = "select count(r.id) as reviews from tbl_reviews r join tbl_trip_review tr on r.id = tr.review_id where tr.trip_id = " . $trip_id . " and r.status = 1";
	$reviews = $ci->common_model->run_query($query);
	echo $reviews[0]['reviews'];
}

function verify_captcha($response_code)
{
	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => array(
			'secret'  => '6LdbG0sUAAAAABo1XsTRyWFJnpOQMA-DvK71qRgc',
			'response' => $response_code
		)
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);
	return json_decode($resp, true);
}