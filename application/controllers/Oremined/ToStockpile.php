
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ToStockpile extends CI_Controller {

	public function ToStockpile(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
    $this->load->model('Stockpile_model');
		$this->load->model('Pit_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "ToStockpile";
				$data['selectedstockpile'] = '';
	   			$data['selectedyear'] = '0000-00-00';
				$selectedstockpile = "";
				$selectedyear ="0000-00-00";
				$date = "0000-00-00";
				$data['date'] = '';
				$data['Table'] = $this->Stockpile_model->getActivityStockpile($selectedstockpile,$selectedyear);
				$data['Table2'] = $this->Stockpile_model->TotalToStockpile($selectedstockpile,$date);
				$data['TableOrefeed'] = $this->Stockpile_model->getOrefeedStockpileByStockpile($selectedstockpile,$date);
				//$data['Table'] = $this->Stockpile_model->getToStockpile($data['selectedstockpile'],$data['selectedyear']);
				$data['Year'] = $this->Stockpile_model->getYear();
        $data['Stockpile'] = $this->Stockpile_model->getStockpile();
		    $this->load->view('Oremined/ToStockpile', $data);
    }else {
      redirect(base_url());
    }
	}

  public function Filter(){
		if ($this->session->userdata('GradeControl')) {
			$data['main'] = "ToStockpile";
			$selectedstockpile = $this->input->post('Stockpile');
			$selectedyear = $this->input->post('Year');

			$data['date'] = $this->input->post('Date');

			$data['selectedstockpile'] = $this->input->post('Stockpile');

			if($data['date'] == null){

				$data['Table'] = $this->Stockpile_model->getActivityStockpileByStockpile($selectedstockpile);
				$data['Table2'] = $this->Stockpile_model->TotalToStockpileByStockpile($selectedstockpile);
				$data['TableOrefeed'] = $this->Stockpile_model->getOrefeedStockpileByStockpile($selectedstockpile);

			}
			else{
				$Date = explode('/', $data['date'])[2].'-'.explode('/', $data['date'])[0].'-'.explode('/', $data['date'])[1];
				$data['Table'] = $this->Stockpile_model->getActivityStockpileByStockpileByDate($selectedstockpile,$Date);
				$data['Table2'] = $this->Stockpile_model->TotalToStockpileByStockpilebyDate($selectedstockpile,$Date);
				$data['TableOrefeed'] = $this->Stockpile_model->getOrefeedStockpileByStockpile($selectedstockpile,$Date);

			}
	   	
			
			//$data['Year'] = $this->Stockpile_model->getYear();
			$data['Stockpile'] = $this->Stockpile_model->getStockpile();
			
			$this->load->view('Oremined/ToStockpile', $data);
		}else {
			redirect(base_url());
		}
	}

}
?>
