
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prospect extends CI_Controller {

	public function Prospect(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		$this->load->model('Pit_model');
		$this->load->model('Prospect_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "Prospect";
        		$data['Table'] = $this->Prospect_model->getProspect();
		    	$this->load->view('References/Prospect', $data);
    }else {
      redirect(base_url());
    }
	}

	public function InputProspect()
	{
		if ($this->session->userdata('GradeControl')) {

			$data = array(
				'Nama' => $this->input->post('Nama'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);

			$this->Prospect_model->InputProspect($data);

			redirect('References/Prospect');
		}else {
			redirect(base_url());
		}
	}

	public function Delete($id)
	{
		if ($this->session->userdata('GradeControl')) {

			$this->Prospect_model->DeleteProspect($id);

			redirect('References/Prospect');
		}else {
			redirect(base_url());
		}
	}

	public function UpdatePit()
	{
		if ($this->session->userdata('GradeControl')) {

			$id = $this->session->userdata('update');
			$data = array(
				'Nama' => $this->input->post('Nama'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);

			$this->Pit_model->UpdatePit($data, $id);
			$this->session->userdata('update', '');

			redirect('References/Pit');
		}else {
			redirect(base_url());
		}
	}

	public function Update($id)
	{
		if ($this->session->userdata('GradeControl')) {

			$this->session->userdata('update', $id);
			$data['Table'] = $this->Pit_model->getPit();
			$data['Pit'] = $this->Pit_model->GetPitByID($id);

			redirect('References/Pit', $data);
		}else {
			redirect(base_url());
		}
	}

	public function Delete_multiple()
    {
        if ($this->session->userdata('GradeControl')) {
            
            $this->Prospect_model->DeleteMultipleProspect();

            redirect('References/Prospect');
        }else {
            redirect(base_url());
        }
    }

}
?>
