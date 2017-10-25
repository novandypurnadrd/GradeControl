
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FaceSample extends CI_Controller {

	public function FaceSample(){
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
				$data['main'] = "Face Sample";
				$data['date'] = '';
				$data['Prospect'] = $this->Prospect_model->GetProspect();
				$data['Location'] = $this->Location_model->GetLocation();
				$data['Table'] = $this->OtherSampling_model->GetFaceSample();
        		
		    $this->load->view('OtherSampling/FaceSample', $data);
    }else {
      redirect(base_url());
    }
	}

	public function InputFaceSample()
	{
    	if ($this->session->userdata('GradeControl')) {
    		$Date =  $this->input->post('Date');

			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];

			$Prospect = $this->input->post("prospect");
    		$Location = $this->input->post("location");
    		$FromHoleID = $this->input->post("fromholeid");
    		$ToHoleID = $this->input->post("toholeid");
    		$TotalHole = $this->input->post("totalhole");
    		$FromSample = $this->input->post("fromsample");
    		$ToSample = $this->input->post("tosample");
    		$TotalSample = $this->input->post("totalsample");
    		$Remarks = $this->input->post("remarks");

    		$FaceSample = array(
    			'Date' => $Date,
    			'Prospect' => $Prospect,
    			'Location' => $Location,
    			'FromHoleID' => $FromHoleID,
    			'ToHoleID' => $ToHoleID,
    			'TotalHole' => $TotalHole,
    			'FromSample' => $FromSample,
    			'ToSample' => $ToSample,
    			'TotalSample' => $TotalSample,
    			'Remarks' => $Remarks,
    			'usrid' => $this->session->userdata('usernameGradeControl'),
    			);

    		$this->OtherSampling_model->InputFaceSample($FaceSample);
    			$data['main'] = "Face Sample";
    			$data['date'] = $this->input->post('Date');
				$data['Prospect'] = $this->Prospect_model->GetProspect();
				$data['Location'] = $this->Location_model->GetLocation();
				$data['Table'] = $this->OtherSampling_model->GetFaceSample();
    		 $this->load->view('OtherSampling/FaceSample', $data);
		}
		else {
			redirect(base_url());
		}

	}

	public function DeleteFaceSample($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->OtherSampling_model->DeleteFaceSample($id);
			redirect('OtherSampling/FaceSample');
		}
		else {
			redirect(base_url());
		}
	}

	public function Delete_multiple()
	{
		if ($this->session->userdata('GradeControl')) {
			
			$this->OtherSampling_model->DeleteMultipleFaceSample();

			redirect('OtherSampling/FaceSample');
		}else {
			redirect(base_url());
		}
	}


}
?>
