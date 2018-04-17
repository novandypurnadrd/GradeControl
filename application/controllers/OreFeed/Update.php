
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

        		$data['ToStockpile'] = $this->Stockpile_model->ViewToStockpile();
        		$data['Loader'] = $this->Loader_model->GetLoader();
        		$data['Material'] = $this->Loader_model->GetMaterial();
        		$data['Percentage'] = $this->Loader_model->GetPercentage();
				$data['Table'] = $this->OreFeed_model->GetOreFeedByIDNew($data['id']);
				$this->session->userdata('update', "");
		    $this->load->view('OreFeed/Update', $data);
    }else {
      redirect(base_url());
    }
	}

	public function UpdateOreFeed($id)
	{
		if ($this->session->userdata('GradeControl')) {

			$Orefeed = $this->OreFeed_model->GetOreFeedByIDNew($id);

			foreach ($Orefeed as $orefeedvalue) {
				
				$Volumeorefed = $orefeedvalue->Volume;
				$Auorefeed = $orefeedvalue->Au;
				$Agorefeed = $orefeedvalue->Ag;
				$AuEq75orefeed = $orefeedvalue->AuEq75;
				$Classorefeed = $orefeedvalue->Class;
				$Densityorefeed = $orefeedvalue->Density;
				$Tonnesorefeed = $oreinventory->Tonnes;
			}

			

			redirect('OreFeed/Table');
		}else {
			redirect(base_url());
		}
	}

}
?>
