<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter 301 Redirect Hook library
 *
 * Allows a user to specify uri_strings that should be redirected and where
 *
 * @location	application/hooks
 * @updated		08/02/2011
 * @package		CodeIgniter
 * @subpackage	Redirect
 * @version		1.0
 * @author		Mike Saville <http://mikesaville.net>
 * @author		Saville Resources <http://savilleresources.com>
 * @copyright	2011 Saville Resources
 * @license		Apache License v2.0
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * @usage
 * Specify a post_controller_constructor hook in ./application/config/hooks.php
 *
 * (example)
 * $hook['post_controller_constructor'][] = array(
 *	'class'    => 'Redirect',
 *	'function' => 'redirect',
 *	'filename' => 'Redirect.php',
 *	'filepath' => 'hooks',
 *	'params'   => array()
 * );
 *
 */

class Redirect {

	/**
	 * @var	string
	 * The name of the database table that holds redirects if the config file isn't used
	 *
	 * Example Table structure
	 * id				int
	 * from_url	varchar(255)
	 * to_url		varchar(255)
	 */
	protected $_redirects_table = 'tbl_redirections';

	/**
	 * @var	string
	 * Name of the redirect cache file stored in APPPATH/cache/
	 */
	protected $_redirect_cache_file;

	/**
	 * @var	array
	 * Contains all redirects found in either the redirect cache file specified above, the redirects config file,
	 * or in the redirects table in the database
	 */
	protected $_redirects;

	/**
	 * CI Super global
	 */
	var $CI;

	/**
	 * Set it all up
	 */
	public function __construct()
	{
		$redirects = [];
		$this->CI =& get_instance();
		$query = $this->CI->db
			->select('from_url, to_url')
			->get($this->_redirects_table);

		if ( $query->num_rows() > 0 ){
			foreach( $query->result() as $row ){
				$redirects[$row->from_url] = $row->to_url;
			}
		}

		$this->_redirects = $redirects;
	}

	/**
	 * Does the actual redirection
	 */
	public function redirect()
	{
		$uri_string = current_url();
		if ( array_key_exists($uri_string, $this->_redirects) ){
			redirect($this->_redirects[$uri_string], 'location', 301);
		}
	}

}

/* End of ./application/hooks/Redirect.php */
/* Mike Saville, Saville Resources */