<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . "libraries/Curl.php";

class Products extends CI_Controller {

	public function __construct(){
		parent::__construct();

	}

	public function index()
	{
		$data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');
		$this->load->view('product_list',$data);
	}

	function get_all_curl()
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'http://localhost/ci_api_linkswatch/api/get_items/');

		$buffer = curl_exec($ch);

	    curl_close($ch);
	     
	    $result['list2'] = json_decode($buffer);
	    //echo $result;
   		$this->load->view('product_list',$result);
	}
}
