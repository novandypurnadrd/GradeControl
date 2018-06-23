
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RCDrilling extends CI_Controller {

	public function RCDrilling(){
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
				$data['main'] = "RC Drilling";
				$data['date'] = '';
                $data['dateStart'] = '';
                $data['dateEnd'] = '';
				$data['Prospect'] = $this->Prospect_model->GetProspect();
				$data['Location'] = $this->Location_model->GetLocation();
				$data['Table'] = $this->OtherSampling_model->GetRCDrilling();
        		
		    $this->load->view('OtherSampling/RCDrilling', $data);
    }else {
      redirect(base_url());
    }
	}

	public function InputRCDrilling()
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
    		$TotalMeter = $this->input->post("totalmeter");
    		$Drill = $this->input->post("drill");
            $Remarks = $this->input->post("remarks");

    		$RCDrilling = array(
    			'Date' => $Date,
    			'Prospect' => $Prospect,
    			'Location' => $Location,
    			'FromHoleID' => $FromHoleID,
    			'ToHoleID' => $ToHoleID,
    			'TotalHole' => $TotalHole,
    			'FromSample' => $FromSample,
    			'ToSample' => $ToSample,
    			'TotalSample' => $TotalSample,
    			'TotalMeter' => $TotalMeter,
    			'Drill' => $Drill,
                'Remarks' => $Remarks,
    			'usrid' => $this->session->userdata('usernameGradeControl'),
    			);

    		$this->OtherSampling_model->InputRCDrilling($RCDrilling);

    		redirect('OtherSampling/RCDrilling');
		}
		else {
			redirect(base_url());
		}

	}

	public function DeleteRCDrilling($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->OtherSampling_model->DeleteRCDrilling($id);
			redirect('OtherSampling/RCDrilling');
		}
		else {
			redirect(base_url());
		}
	}

    public function Delete_multiple()
    {
        if ($this->session->userdata('GradeControl')) {
            
            $this->OtherSampling_model->DeleteMultipleRCDrilling();

            redirect('OtherSampling/RCDrilling');
        }else {
            redirect(base_url());
        }
    }


    public function Filter(){
        if ($this->session->userdata('GradeControl')) {
      $data['main'] = "RC Drilling";
      $data['dateStart'] = $this->input->post('start');
      $data['dateEnd'] = $this->input->post('end');
      $data['date'] = '';

      $dateStart = explode('/',$data['dateStart'])[2].'-'.explode('/',$data['dateStart'])[0].'-'.explode('/',$data['dateStart'])[1];
      $dateEnd = explode('/',$data['dateEnd'])[2].'-'.explode('/',$data['dateEnd'])[0].'-'.explode('/',$data['dateEnd'])[1];
    
      $data['Table'] = $this->OtherSampling_model->GetRCDrillingRangeDate($dateStart,$dateEnd);

      
      
      
      $this->load->view('OtherSampling/RCDrilling', $data);
        }else {
            redirect(base_url());
        }
    }


}
?>
