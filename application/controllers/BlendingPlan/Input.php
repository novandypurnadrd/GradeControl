
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input extends CI_Controller {

	public function Input(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		
		$this->load->model('ClosingStock_model');
    	$this->load->model('BlendingPlan_model');
		
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
		$data['main'] = "DailyBlendingPlan";
	

        $date = date('Y-m-d');

        $NextDate = date('Y-m-d', strtotime('+1 day', strtotime($date)));

        $data['BlendingToday'] = $this->BlendingPlan_model->GetBlendingToday($NextDate);


    
		    $this->load->view('BlendingPlan/Input', $data);
    }else {
      redirect(base_url());
    }
	}


	public function Insert(){
		$data['main'] = "DailyBlendingPlan";

		$Blending = strtoupper($this->input->post('Blending'));
		$Augt = $this->input->post('Augt');
		$Aggt = $this->input->post('Aggt');
		$AuEq75 = $this->input->post('AuEq75');
		$Date = $this->input->post('Date');
		$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];

		$BlendingPlan =  array(

			'Blending' => $Blending,
			'Augt' => $Augt,
			'Aggt' => $Aggt,
			'AuEq75' => $AuEq75,
			'Date' => $Date,
		);

		$this->BlendingPlan_model->InsertBlendingPlan($BlendingPlan);

		redirect('BlendingPlan/Input');

	}


	public function Update($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$data['main'] = "DailyBlendingPlan";
			$data['id'] = $id;
			$data['Table'] = $this->BlendingPlan_model->GetBlendingbyId($id);

			$this->load->view('BlendingPlan/Update',$data);
		}
		else {
			redirect(base_url());
		}
	}


	public function UpdateValue($id)
	{
		if ($this->session->userdata('GradeControl')) {

		$Blending = strtoupper($this->input->post('Blending'));
		$Augt = $this->input->post('Augt');
		$Aggt = $this->input->post('Aggt');
		$AuEq75 = $this->input->post('AuEq75');
		$Date = $this->input->post('Date');
		$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];

		$BlendingPlan =  array(

			'Blending' => $Blending,
			'Augt' => $Augt,
			'Aggt' => $Aggt,
			'AuEq75' => $AuEq75,
			'Date' => $Date,
		);

		$this->BlendingPlan_model->UpdateValue($BlendingPlan,$id);

		redirect('BlendingPlan/Input');
		}
		else {
			redirect(base_url());
		}
	}






}
?>
