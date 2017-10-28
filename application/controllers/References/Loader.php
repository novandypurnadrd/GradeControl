
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loader extends CI_Controller {

	public function Loader(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		$this->load->model('Loader_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "Loader";
        $data['Table'] = $this->Loader_model->getLoader();
		    $this->load->view('References/Loader', $data);
    }else {
      redirect(base_url());
    }
	}

	public function InputLoader()
	{
		if ($this->session->userdata('GradeControl')) {

			$data = array(
        'Capacity' => $this->input->post('Capacity'),
        'Density' => $this->input->post('Density'),
        'Tonnage' => $this->input->post('Tonnage'),
        'Tonnageper' => $this->input->post('Tonnageper'),
        'Percentage' => $this->input->post('Percentage'),
        'Material' => $this->input->post('Material'),
				'Equipment' => $this->input->post('Equipment'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);

			$this->Loader_model->InputLoader($data);

			redirect('References/Loader');
		}else {
			redirect(base_url());
		}
	}

	public function Delete($id)
	{
		if ($this->session->userdata('GradeControl')) {

			$this->Loader_model->DeleteLoader($id);

			redirect('References/Loader');
		}else {
			redirect(base_url());
		}
	}

	public function Delete_multiple()
    {
        if ($this->session->userdata('GradeControl')) {
            
            $this->Loader_model->DeleteMultipleLoader();

            redirect('References/Loader');
        }else {
            redirect(base_url());
        }
    }

}
?>
