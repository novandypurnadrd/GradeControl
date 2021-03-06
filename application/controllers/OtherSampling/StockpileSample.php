
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class StockpileSample extends CI_Controller {

	public function StockpileSample(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		$this->load->model('Oreline_model');
		$this->load->model('OreInventory_model');
    	$this->load->model('Stockpile_model');
    	$this->load->model('OtherSampling_model');
    	$this->load->model('ClosingStock_model');
    	$this->load->model('Prospect_model');
    	$this->load->model('Location_model');
		$this->load->model('Pit_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "Stockpile Sample";
			
				$data['date'] = '';
				$data['dateStart'] = '';
				$data['dateEnd'] = '';
				$data['Prospect'] = $this->Prospect_model->GetProspect();
				$data['Location'] = $this->Location_model->GetLocation();
				$data['Table'] = $this->OtherSampling_model->GetStockpileSample();
        		
		    $this->load->view('OtherSampling/StockpileSample', $data);
    }else {
      redirect(base_url());
    }
	}

	public function InputStockpileSample()
	{
    	if ($this->session->userdata('GradeControl')) {
    		$Date =  $this->input->post('Date');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];
		
    		$FromST = $this->input->post("fromst");
    		$ToST = $this->input->post("tost");
    		$TotalSample = $this->input->post("totalsample");
    		$Remarks = $this->input->post("remarks");

    		$StockpileSample = array(
    			'Date' => $Date,
    			'FromST' => $FromST,
    			'ToST' => $ToST,
    			'TotalSample' => $TotalSample,
    			'Remarks' => $Remarks,
    			'usrid' => $this->session->userdata('usernameGradeControl'),
    			);

    		$this->OtherSampling_model->InputStockpileSample($StockpileSample);

    		redirect('OtherSampling/StockpileSample');
		}
		else {
			redirect(base_url());
		}

	}

	public function DeleteStockpileSample($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->OtherSampling_model->DeleteStockpileSample($id);
			redirect('OtherSampling/StockpileSample');
		}
		else {
			redirect(base_url());
		}
	}

	 public function Delete_multiple()
    {
        if ($this->session->userdata('GradeControl')) {
            
            $this->OtherSampling_model->DeleteMultipleStockpileSample();

            redirect('OtherSampling/StockpileSample');
        }else {
            redirect(base_url());
        }
    }



	public function Filter(){
		if ($this->session->userdata('GradeControl')) {
	  $data['main'] = "Face Sample";
      $data['dateStart'] = $this->input->post('start');
      $data['dateEnd'] = $this->input->post('end');
      $data['date'] = '';
      $data['Prospect'] = $this->Prospect_model->GetProspect();
	  $data['Location'] = $this->Location_model->GetLocation();

      $dateStart = explode('/',$data['dateStart'])[2].'-'.explode('/',$data['dateStart'])[0].'-'.explode('/',$data['dateStart'])[1];
      $dateEnd = explode('/',$data['dateEnd'])[2].'-'.explode('/',$data['dateEnd'])[0].'-'.explode('/',$data['dateEnd'])[1];
    
      $data['Table'] = $this->OtherSampling_model->GetStockpileSampleRangeDate($dateStart,$dateEnd);

      
      
      
			$this->load->view('OtherSampling/StockpileSample', $data);
		}else {
			redirect(base_url());
		}
	}


}
?>
