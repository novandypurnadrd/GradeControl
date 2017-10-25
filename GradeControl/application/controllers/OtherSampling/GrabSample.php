
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GrabSample extends CI_Controller {

	public function GrabSample(){
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
				$data['main'] = "Grab Sample";
				$data['date'] = '';
				$data['Prospect'] = $this->Prospect_model->GetProspect();
				$data['Location'] = $this->Location_model->GetLocation();
				$data['Table'] = $this->OtherSampling_model->GetGrabSample();
        		
		    $this->load->view('OtherSampling/GrabSample', $data);
    }else {
      redirect(base_url());
    }
	}

	public function InputGrabSample()
	{
    	if ($this->session->userdata('GradeControl')) {
    		$Date =  $this->input->post('Date');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];
			$Prospect = $this->input->post("prospect");
    		$Location = $this->input->post("location");
    		$FromGS = $this->input->post("fromgs");
    		$ToGS = $this->input->post("togs");
    		$TotalSample = $this->input->post("totalsample");
    		$Remarks = $this->input->post("remarks");

    		$GrabSample = array(
    			'Date' => $Date,
    			'Prospect' => $Prospect,
    			'Location' => $Location,
    			'FromGS' => $FromGS,
    			'ToGS' => $ToGS,
    			'TotalSample' => $TotalSample,
    			'Remarks' => $Remarks,
    			'usrid' => $this->session->userdata('usernameGradeControl'),
    			);

    		$this->OtherSampling_model->InputGrabSample($GrabSample);

    		redirect('OtherSampling/GrabSample');
		}
		else {
			redirect(base_url());
		}

	}

	public function DeleteGrabSample($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->OtherSampling_model->DeleteGrabSample($id);
			redirect('OtherSampling/GrabSample');
		}
		else {
			redirect(base_url());
		}
	}

	public function Delete_multiple()
	{
		if ($this->session->userdata('GradeControl')) {
			
			$this->OtherSampling_model->DeleteMultipleGrabSample();

			redirect('OtherSampling/GrabSample');
		}else {
			redirect(base_url());
		}
	}


}
?>
