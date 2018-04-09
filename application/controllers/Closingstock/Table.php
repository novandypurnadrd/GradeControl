
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table extends CI_Controller {

	public function Table(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
    	$this->load->model('Stockpile_model');
		$this->load->model('Pit_model');
		$this->load->model('Orefeed_model');
		$this->load->model('Closingstock_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "Closingstock";
				$data['selectedstockpile'] = '';
	   			$data['selectedyear'] = '0000-00-00';
	   			$data['date'] = '';
				$selectedstockpile = "";
				$selectedyear = '0000-00-00';
				$data['Table'] = $this->Closingstock_model->GetClosingStockIndex();
				//$data['Table'] = $this->Stockpile_model->getToStockpile($data['selectedstockpile'],$data['selectedyear']);
				$data['Year'] = $this->Stockpile_model->getYear();
        		$data['Stockpile'] = $this->Stockpile_model->getStockpile();
		    $this->load->view('Closingstock/Table', $data);
    }else {
      redirect(base_url());
    }
	}

  public function Filter(){
		if ($this->session->userdata('GradeControl')) {
			$data['main'] = "Closingstock";
			$data['date'] = $this->input->post('Date');
			$data['Stockpile'] = $this->Stockpile_model->getStockpile();
			$stockpile = $this->input->post('Stockpile');
			$data['selectedstockpile'] = $stockpile;
			$date = explode('/',$data['date'])[2].'-'.explode('/',$data['date'])[0].'-'.explode('/',$data['date'])[1];
			//$selectedyear = $date;
			//$data['tgl'] = date("d-F-Y", strtotime($this->input->post('Date')));

		

	   		if ($date == ""){
	   			$data['Table'] = $this->Closingstock_model->GetClosingStockByStockpileTable($stockpile);
	   		}
	   		else{
	   			$data['Table'] = $this->Closingstock_model->GetClosingStockGradeByStockpileandDateTableLast($stockpile,$date);
	   		}
	   		
			
		
			
			$this->load->view('Closingstock/Table', $data);
		}else {
			redirect(base_url());
		}
	}

}
?>
