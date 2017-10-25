
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table extends CI_Controller {

	public function Table(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
    $this->load->model('Oreline_model');
		$this->load->model('Pit_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "Oreline";
        $data['Pit'] = $this->Pit_model->getPit();
	      $data['pitselected'] = '';
        $data['Table'] = $this->Oreline_model->getOrelineByPit($data['pitselected']);
		    $this->load->view('Oreline/Table', $data);
    }else {
      redirect(base_url());
    }
	}

  public function Filter(){
		if ($this->session->userdata('GradeControl')) {
			$data['main'] = "Oreline";
      $data['Pit'] = $this->Pit_model->getPit();
      $data['pitselected'] = $this->input->post('Pit');
      $data['Table'] = $this->Oreline_model->getOrelineByPit($data['pitselected']);
			$this->load->view('Oreline/Table', $data);
		}else {
			redirect(base_url());
		}
	}

	public function DeleteOreline($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->Oreline_model->DeleteOreline($id);
			redirect('Oreline/Table');
		}
		else {
			redirect(base_url());
		}
	}

	public function Delete_multiple()
	{
		if ($this->session->userdata('GradeControl')) {
			
			$this->Oreline_model->DeleteMultipleOreline();

			redirect('Oreline/Table');
		}else {
			redirect(base_url());
		}
	}


}
?>
