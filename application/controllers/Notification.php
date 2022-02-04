<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-G9aehKBKb4BtBndGVjBVabhv', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
		$this->load->model('cinema_m');
		
    }

	public function index()
	{
		echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result, true);

		$orderId = $result['order_id'];

		$status_code = $result['status_code'];
		if ($status_code == 200 || $status_code == 201 || $status_code == 202 || $status_code == 407) {
			$data['status_code'] = $status_code;
			$this->cinema_m->update($orderId, $data);
		}

	}
}
