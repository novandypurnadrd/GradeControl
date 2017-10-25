
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stockpile extends CI_Controller {

	public function Stockpile(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		$this->load->model('Stockpile_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "Stockpile";
        $data['Table'] = $this->Stockpile_model->getStockpile();
		    $this->load->view('References/Stockpile', $data);
    }else {
      redirect(base_url());
    }
	}

	public function InputStockpile()
	{
		if ($this->session->userdata('GradeControl')) {

			$data = array(
				'Nama' => $this->input->post('Nama'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);

			$this->Stockpile_model->InputStockpile($data);

			redirect('References/Stockpile');
		}else {
			redirect(base_url());
		}
	}

	public function Delete($id)
	{
		if ($this->session->userdata('GradeControl')) {

			$this->Stockpile_model->DeleteStockpile($id);

			redirect('References/Stockpile');
		}else {
			redirect(base_url());
		}
	}

	public function UpdateStockpile()
	{
		if ($this->session->userdata('GradeControl')) {

			$id = $this->session->userdata('update');
			$data = array(
				'Nama' => $this->input->post('Nama'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);

			$this->Stockpile_model->UpdateStockpile($data, $id);
			$this->session->userdata('update', '');

			redirect('References/Stockpile');
		}else {
			redirect(base_url());
		}
	}

	public function Update($id)
	{
		if ($this->session->userdata('GradeControl')) {

			$this->session->userdata('update', $id);
			$data['Table'] = $this->Stockpile_model->getStockpile();
			$data['Stockpile'] = $this->Stockpile_model->GetStockpileByID($id);

			redirect('References/Stockpile', $data);
		}else {
			redirect(base_url());
		}
	}

	public function Delete_multiple()
    {
        if ($this->session->userdata('GradeControl')) {
            
            $this->Stockpile_model->DeleteMultipleStockpile();

            redirect('References/Stockpile');
        }else {
            redirect(base_url());
        }
    }

}
?>
