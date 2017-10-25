
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {

	public function Update(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		$this->load->model('Oreline_model');
		$this->load->model('OreInventory_model');
    $this->load->model('Stockpile_model');
		$this->load->model('Pit_model');
		$this->load->model('OreFeed_model');
		$this->load->model('Loader_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "OreFeed";
				$data['id'] = $this->session->userdata('update');
				$data['Pit'] = $this->Pit_model->getPit();
				$data['Oreline'] = $this->Oreline_model->getOreline();
        		$data['Stockpile'] = $this->Stockpile_model->getStockpile();
        		$data['Loader'] = $this->Loader_model->GetLoader();
        		$data['Material'] = $this->Loader_model->GetMaterial();
        		$data['Percentage'] = $this->Loader_model->GetPercentage();
				$data['Table'] = $this->OreFeed_model->GetOreFeedByID($data['id']);
				$this->session->userdata('update', "");
		    $this->load->view('OreFeed/Update', $data);
    }else {
      redirect(base_url());
    }
	}

	public function UpdateOreFeed($id)
	{
		if ($this->session->userdata('GradeControl')) {

			$Start =  $this->input->post('Start');
			$Start = explode('/', $Start)[2].'-'.explode('/', $Start)[0].'-'.explode('/', $Start)[1];
			$Finish =  $this->input->post('Finish');
			if ($Finish!= "") {
				$Finish = explode('/', $Finish)[2].'-'.explode('/', $Finish)[0].'-'.explode('/', $Finish)[1];
			}

			$data = array(
				'Pit' => $this->input->post('Pit'),
				'Block' => $this->input->post('Block'),
				'RL' => $this->input->post('RL'),
				'Au' => $this->input->post('Augt'),
				'Ag' => $this->input->post('Aggt'),
				'DryTonFF' => $this->input->post('DryTonFF'),
				'Start' => $Start,
				'Finish' => $Finish,
				'StartHour' => $this->input->post('StartHour'),
				'FinishHour' => $this->input->post('FinishHour'),
				'Status' => $this->input->post('Status'),
				'Achievement' => $this->input->post('Achievement'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);

			$this->OreInventory_model->UpdateOreInventory($data, $id);

			redirect('OreInventory/Table');
		}else {
			redirect(base_url());
		}
	}

}
?>
