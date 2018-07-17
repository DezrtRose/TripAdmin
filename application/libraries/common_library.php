<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Common_Library
{
    public $CI;

    public function __construct()
    {
        $this->CI = & get_instance();
    }

    function upload_image($fld_name, $full_image_path, $file_name, $resize_detail = '')
    {
        if (!file_exists($full_image_path)) {
            mkdir($full_image_path, DIR_WRITE_MODE, true);
        }
        $this->CI->load->library('upload');
        $this->CI->load->library('image_lib');
        $config['allowed_types'] = 'png|gif|jpeg|bmp|jpg|pdf';
        $config['allowed_types'] = '*';
        $config['upload_path'] = $full_image_path;
        $config['max_size'] = '30720';
        $config['overwrite'] = TRUE;
        if(count($_FILES[$fld_name]['name']) <= 1)
            $config['file_name'] = $file_name;
        $files = $_FILES[$fld_name];

        $this->CI->upload->initialize($config);
        if(is_array($_FILES[$fld_name]['name'])) {
            $file_names = array();
            $count = count($files['name']);
            for ($key = 0; $key < $count; $key++) {
                $config['file_name'] = $file_name.'-'.generateString();
                $this->CI->upload->initialize($config);
                $_FILES[$fld_name]['name']= $files['name'][$key];
                $_FILES[$fld_name]['type']= $files['type'][$key];
                $_FILES[$fld_name]['tmp_name']= $files['tmp_name'][$key];
                $_FILES[$fld_name]['error']= $files['error'][$key];
                $_FILES[$fld_name]['size']= $files['size'][$key];
                if ($this->CI->upload->do_upload($fld_name)) {
                    $uploaded_image = $this->CI->upload->data();
                    if (is_array($resize_detail)) {
                        foreach ($resize_detail as $resize_item) {
                            if (!file_exists($resize_item['new_path'])) {
                                mkdir($resize_item['new_path'], DIR_WRITE_MODE, true);
                            }
                            if (($resize_item["crop"] == "true")) {
                                list($width, $height) = getimagesize($full_image_path . "/" . $uploaded_image['file_name']);
                                list($resize_width, $resize_height) = $this->get_precrop_size($width, $height, $resize_item["width"], $resize_item["height"]);
                            } else {
                                list($width, $height) = getimagesize($full_image_path . "/" . $uploaded_image['file_name']);
                                if ($width > $resize_item["width"] || $height > $resize_item["height"]) {
                                    if ($width > $height) {
                                        $resize_width = $resize_item["width"];
                                        $resize_height = (($resize_item["width"] / $width) * $height);
                                    } else {
                                        $resize_height = $resize_item["height"];
                                        $resize_width = (($resize_item["height"] / $height) * $width);
                                    }
                                } else {
                                    $resize_width = $width;
                                    $resize_height = $height;
                                }
                            }
    
                            $resize_config['image_library'] = 'gd2';
                            $resize_config['source_image'] = $full_image_path . "/" . $uploaded_image["file_name"];
                            $resize_config['new_image'] = $resize_item["new_path"];
                            $resize_config['maintain_ratio'] = FALSE;
                            $resize_config['width'] = $resize_width;
                            $resize_config['height'] = $resize_height;
    
                            $this->CI->image_lib->initialize($resize_config);
                            if (!$this->CI->image_lib->resize()) {
                                echo 'resize';
                                print_r($this->CI->image_lib->display_errors());exit;
                                //return array("status" => "error", "error_string" => $this->CI->image_lib->display_errors());
                            }
    
                            if ($resize_item["crop"] == "true") {
                                list($width, $height) = getimagesize($full_image_path . "/" . $uploaded_image['file_name']);
                                switch ($resize_item["crop_type"]) {
                                    case "center":
                                        $center_crop_coordinates = $this->get_center_crop_coordinates($resize_width, $resize_height, $resize_item["width"], $resize_item["height"]);
                                        $x = $center_crop_coordinates["x"];
                                        $y = $center_crop_coordinates["y"];
                                        break;
                                    case "top_left":
                                        $x = 0;
                                        $y = 0;
                                        break;
                                }
                                //$this->CI->image_lib->clear();
    
                                $crop_config['image_library'] = 'gd2';
                                $crop_config['source_image'] = $resize_item["new_path"] . "/" . $uploaded_image["file_name"];
                                //$config['new_image'] = $resize_item["new_path"];
                                $crop_config['x_axis'] = $x;
                                $crop_config['y_axis'] = $y;
                                $crop_config['height'] = $resize_item["height"];
                                $crop_config['width'] = $resize_item["width"];
    
                                $crop_config['maintain_ratio'] = FALSE;
                                $this->CI->image_lib->initialize($crop_config);
                                if (!$this->CI->image_lib->crop()) {
                                    echo 'crop';
                                    print_r($this->CI->image_lib->display_errors());exit;
                                    //return array("status" => "error", "error_string" => $this->CI->image_lib->display_errors());
                                }
                            }
                        }
                    }
                    array_push($file_names, $uploaded_image["file_name"]);
                } else {
                    echo 'upload';
                    print_r($this->CI->upload->display_errors());exit;
                }
                $this->CI->image_lib->clear();
            }
            return $file_names;
        } else {
            if ($this->CI->upload->do_upload($fld_name)) {
                $uploaded_image = $this->CI->upload->data();
                if (is_array($resize_detail)) {
                    foreach ($resize_detail as $resize_item) {
                        if (!file_exists($resize_item['new_path'])) {
                            mkdir($resize_item['new_path'], DIR_WRITE_MODE, true);
                        }
                        if (($resize_item["crop"] == "true")) {
                            list($width, $height) = getimagesize($full_image_path . "/" . $uploaded_image['file_name']);
                            list($resize_width, $resize_height) = $this->get_precrop_size($width, $height, $resize_item["width"], $resize_item["height"]);
                        } else {
                            list($width, $height) = getimagesize($full_image_path . "/" . $uploaded_image['file_name']);
                            if ($width > $resize_item["width"] || $height > $resize_item["height"]) {
                                if ($width > $height) {
                                    $resize_width = $resize_item["width"];
                                    $resize_height = (($resize_item["width"] / $width) * $height);
                                } else {
                                    $resize_height = $resize_item["height"];
                                    $resize_width = (($resize_item["height"] / $height) * $width);
                                }
                            } else {
                                $resize_width = $width;
                                $resize_height = $height;
                            }
                        }

                        $resize_config['image_library'] = 'gd2';
                        $resize_config['source_image'] = $full_image_path . "/" . $uploaded_image["file_name"];
                        $resize_config['new_image'] = $resize_item["new_path"];
                        $resize_config['maintain_ratio'] = FALSE;
                        $resize_config['width'] = $resize_width;
                        $resize_config['height'] = $resize_height;

                        $this->CI->image_lib->initialize($resize_config);
                        if (!$this->CI->image_lib->resize()) {
                            echo 'resize';
                            print_r($this->CI->image_lib->display_errors());exit;
                            //return array("status" => "error", "error_string" => $this->CI->image_lib->display_errors());
                        }

                        if ($resize_item["crop"] == "true") {
                            list($width, $height) = getimagesize($full_image_path . "/" . $uploaded_image['file_name']);
                            switch ($resize_item["crop_type"]) {
                                case "center":
                                    $center_crop_coordinates = $this->get_center_crop_coordinates($resize_width, $resize_height, $resize_item["width"], $resize_item["height"]);
                                    $x = $center_crop_coordinates["x"];
                                    $y = $center_crop_coordinates["y"];
                                    break;
                                case "top_left":
                                    $x = 0;
                                    $y = 0;
                                    break;
                            }
                            //$this->CI->image_lib->clear();

                            $crop_config['image_library'] = 'gd2';
                            $crop_config['source_image'] = $resize_item["new_path"] . "/" . $uploaded_image["file_name"];
                            //$config['new_image'] = $resize_item["new_path"];
                            $crop_config['x_axis'] = $x;
                            $crop_config['y_axis'] = $y;
                            $crop_config['height'] = $resize_item["height"];
                            $crop_config['width'] = $resize_item["width"];

                            $crop_config['maintain_ratio'] = FALSE;
                            $this->CI->image_lib->initialize($crop_config);
                            if (!$this->CI->image_lib->crop()) {
                                echo 'crop';
                                print_r($this->CI->image_lib->display_errors());exit;
                                //return array("status" => "error", "error_string" => $this->CI->image_lib->display_errors());
                            }
                        }
                    }
                }
                return array("status" => "success", "filename" => $uploaded_image["file_name"]);
            } else {
                echo 'upload';
                print_r($this->CI->upload->display_errors());exit;
                //return array("status" => "error", "error_string" => strip_tags(html_entity_decode($this->CI->upload->display_errors())));
            }
        }
    }

    function get_precrop_size($width, $height, $resize_width, $resize_height) {
        if ($width < $height) {
            $new_width = $resize_width;
            $new_height = ($new_width / $width) * $height;
            if ($new_height > $height) {
                $new_height = $height;
                $new_width = ($new_height / $height) * $width;
            }
        } else if ($width == $height) {
            if ($resize_width > $resize_height) {
                $new_width = $resize_width;
                $new_height = ($new_width / $width) * $height;
            } else {
                $new_height = $resize_height;
                $new_width = ($new_height / $height) * $width;
            }
        } else {
            $new_height = $resize_height;
            $new_width = ($new_height / $height) * $width;
            if ($new_width < $resize_width) {
                $new_height = ($resize_width / $new_width) * $new_height;
                $new_width = $resize_width;
            }
        }
        return array($new_width, $new_height);
    }

    function get_center_crop_coordinates($width, $height, $rwidth, $rheight) {
        if ($width > $height) {
            $x = ($width / 2) - ($rwidth / 2);
            $y = 0;
        } else {
            $y = ($height / 2) - ($rheight / 2);
            $x = 0;
        }
        return array("x" => $x, "y" => $y);
    }

    function send_email($from, $from_name, $to, $msg, $config = '')
    {
        $this->CI->load->library('email');
        if($config != '') {
            $this->CI->email->initialize($config);
        }
        $this->CI->email->subject('Contact From Website');
        $this->CI->email->from($from, $from_name);
        $this->CI->email->to($to);
        $this->CI->email->message($msg);
        if($this->CI->email->send())
            return true;
        else 
            die($this->CI->email->print_debugger());
    }
}