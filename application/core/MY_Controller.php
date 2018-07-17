<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $site_data;

	function __construct() {
		parent::__construct();
		$this->site_data = $this->common_model->getWhere('seo', array('id' => 1));
	}
}