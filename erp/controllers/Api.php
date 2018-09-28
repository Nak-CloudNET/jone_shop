<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->load->model('api_model');
        $this->load->library('ion_auth');
    }

    function aeon($start_date, $start_time=NULL,$end_date,$end_time=NULL, $biller_id = null)
    {
		$data = json_encode($this->api_model->getPaymentData($start_date,$start_time,$end_date,$end_time, $biller_id), JSON_NUMERIC_CHECK);
		echo $data;
    }

}
