<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cinema extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-G9aehKBKb4BtBndGVjBVabhv', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);

        $this->load->library('veritrans');
		$this->veritrans->config($params);

		$this->load->helper('url');	
		$this->load->model('cinema_m');
    }

    public function index()
    {
        $data['movies'] =  $this->cinema_m->selectMovies();
    	$data['transactions'] = $this->cinema_m->select();
    	$this->load->view('cinema_v', $data);
    }

    public function movie($id = '')
    {
        $data['movie'] = $this->cinema_m->selectMoviesId($id);
        $this->load->view('movie_v', $data);   
    }
    
    public function history()
    {
        $data['transactions'] = $this->cinema_m->select();
        $this->load->view('history_v', $data);   
    }
    
    public function historyDetail($orderId = '')
    {
        echo 'RESULT <br><pre>';
        print_r ($this->veritrans->status($orderId) );
    	echo '</pre>' ;
    }

    public function token()
    {
		$amount = $this->input->post('amount');
		$name = $this->input->post('name');
		$movieId = $this->input->post('movieId');

        $movie = $this->cinema_m->selectMoviesId($movieId);
		
        $gross_amount = $movie->price * $amount;
		
		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => $gross_amount, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
		  'id' => 'a1',
		  'price' => $movie->price,
		  'quantity' => $amount,
		  'name' => $movie->title
		);

		// Optional
		$item_details = array ($item1_details);

		// Optional
		$customer_details = array(
		  'first_name'    => $name,
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 1
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
        $name = $this->input->post('namePay');
        $email = $this->input->post('emailPay');
        $dateWatch = $this->input->post('dateWatchPay');
        $amount = $this->input->post('amountPay');
        $movieId = $this->input->post('movieId');
    
    	$result = json_decode($this->input->post('result_data'), true);
    	// echo 'RESULT <br><pre>';
    	// var_dump($result);
    	// echo '</pre>' ;

        $checkUser = $this->cinema_m->selectUserEmail($email);
        if ($checkUser) {
        }else{
            $dataUser = array(
                'name' => $name,
                'email' => $email
            );
		    $status = $this->cinema_m->insertUser($dataUser);
            if ($status == FALSE) {
                redirect('cinema/history?=failed-user');
            }else {
                $checkUser = $this->cinema_m->selectUserEmail($email);
            }
        }

        $data = array(
            'order_id' => $result['order_id'],
            'transaction_id' => $result['transaction_id'],
            'gross_amount' => $result['gross_amount'],
            'payment_type' => $result['payment_type'],
            'transaction_time' => $result['transaction_time'],
            'status_code' => $result['status_code'],
            'amount' => $amount,
            'watch_date' => $dateWatch,
            'movie_id' => $movieId,
            'user_id' => $checkUser->id
        );
        $status = $this->cinema_m->insert($data);
		
		if($status){
			redirect('cinema/history?=success');
		}else{
			redirect('cinema/history?=failed');
		}

    }

}

/* End of file Cinema.php */
