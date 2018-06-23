
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Record extends CI_Controller {

	public function Record(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		
		$this->load->model('ClosingStock_model');
    	$this->load->model('BlendingPlan_model');
		
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
		$data['main'] = "RecordBlendingPlan";
	

        $data['dateStart'] ="";
      	$data['dateEnd'] = "";

        $data['Table'] = $this->BlendingPlan_model->GetBlendingRecord($data['dateStart'], $data['dateEnd']);


    
		    $this->load->view('BlendingPlan/Record', $data);
    }else {
      redirect(base_url());
    }
	}


	public function DeleteBlending($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->BlendingPlan_model->DeleteBlending($id);
			redirect('BlendingPlan/Input');
		}
		else {
			redirect(base_url());
		}
	}

	public function Delete_multiple()
	{
		if ($this->session->userdata('GradeControl')) {
			
			$this->BlendingPlan_model->DeleteMultipleBlending();

			redirect('BlendingPlan/Record');
		}else {
			redirect(base_url());
		}
	}


	public function Filter(){
		if ($this->session->userdata('GradeControl')) {
	  $data['main'] = "RecordBlendingPlan";
      $data['dateStart'] = $this->input->post('start');
      $data['dateEnd'] = $this->input->post('end');
     


      $dateStart = explode('/',$data['dateStart'])[2].'-'.explode('/',$data['dateStart'])[0].'-'.explode('/',$data['dateStart'])[1];
      $dateEnd = explode('/',$data['dateEnd'])[2].'-'.explode('/',$data['dateEnd'])[0].'-'.explode('/',$data['dateEnd'])[1];
    
      $data['Table'] = $this->BlendingPlan_model->GetBlendingRecord($dateStart,$dateEnd);

  	  $this->load->view('BlendingPlan/Record', $data);


		}else {
			redirect(base_url());
		}
	}






}
?>
