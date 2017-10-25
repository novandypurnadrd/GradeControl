
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boulder extends CI_Controller {

	public function Boulder(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		$this->load->model('Oreline_model');
		$this->load->model('OreInventory_model');
    $this->load->model('Stockpile_model');
    $this->load->model('ClosingStock_model');
		$this->load->model('Pit_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "Boulder";
			
		
				$data['date'] = '';
				$selectedstockpile = "";
				$selectedyear = '0000-00-00';
				$data['Table'] = $this->ClosingStock_model->getBoulder();
        		
		    $this->load->view('ClosingStock/Boulder', $data);
    }else {
      redirect(base_url());
    }
	}

	public function InputBoulder()
	{
    	if ($this->session->userdata('GradeControl')) {
    		$Date =  $this->input->post('Date');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];
    		$DryTon = $this->input->post("DryTonFF");
    		$Au = $this->input->post("Augt");
    		$Ag = $this->input->post("Aggt");

    		$Boulder = array(
    			'Date' => $Date,
    			'Stockpile' => "Boulder",
    			'Tonnes' => $DryTon,
    			'Au' => $Au,
    			'Ag' => $Ag,
    			'usrid' => $this->session->userdata('usernameGradeControl'),
    			);

    		$this->ClosingStock_model->InputBoulder($Boulder);

    		redirect('ClosingStock/Boulder');
		}
		else {
			redirect(base_url());
		}

	}

	public function DeleteScat($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->ClosingStock_model->DeleteBoulder($id);
			redirect('ClosingStock/Boulder');
		}
		else {
			redirect(base_url());
		}
	}


}
?>
