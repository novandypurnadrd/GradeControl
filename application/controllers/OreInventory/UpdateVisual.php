
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UpdateVisual extends CI_Controller {

	public function UpdateVisual(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		$this->load->model('Oreline_model');
		$this->load->model('OreInventory_model');
    	$this->load->model('Stockpile_model');
    	$this->load->model('Closingstock_model');
		$this->load->model('Pit_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "OreInventory";
				$data['id'] = $this->session->userdata('update');
				$data['Pit'] = $this->Pit_model->getPit();
				$data['Oreline'] = $this->Oreline_model->getOreline();
				$data['OreInventory'] = $this->OreInventory_model->getInventory();
        		$data['Stockpile'] = $this->Stockpile_model->getStockpile();
				$data['Table'] = $this->OreInventory_model->GetOreInventoryforUpdateVisual($data['id']);
				$this->session->userdata('update', "");
		    $this->load->view('OreInventory/UpdateVisual', $data);
    }else {
      redirect(base_url());
    }
	}

	public function UpdateVisualRecord($id)
	{
		if ($this->session->userdata('GradeControl')) {

			$Start =  $this->input->post('Start');
			$Start = explode('/', $Start)[2].'-'.explode('/', $Start)[0].'-'.explode('/', $Start)[1];
			$Finish =  $this->input->post('Finish');
			if ($Finish!= "") {
				$Finish = explode('/', $Finish)[2].'-'.explode('/', $Finish)[0].'-'.explode('/', $Finish)[1];
			}


		
			$Value = $this->input->post('Value');




			if ($Value == "Final Figure"){
					$AuUpdate = $this->input->post('Augt');
					$AgUpdate = $this->input->post('Aggt');
					$AuEq75Update = $this->input->post('AuEq75gr');
				}
			else{

					$AuUpdate = $this->input->post('Au');
					$AgUpdate = $this->input->post('Ag');
					$AuEq75Update = $this->input->post('AuEq75');
				}


			
		


			//Update Ore Inventory
			$DryTonFFInventory = $this->input->post('DryTonFF');
			$DryTonFFUpdate = $DryTonFFInventory;
			$data = array(
				'Pit' => $this->input->post('Pit'),
				'Block' => $this->input->post('Nonore'),
				'RL' => $this->input->post('RL'),
				'Au' => $AuUpdate,
				'Ag' => $AgUpdate,
				'AuEq75' =>$AuEq75Update,
				'Dbdensity' => $this->input->post('Density'),
				'DryTonBM' => $this->input->post('DryTonBM'),
				'DryTonFF' => $DryTonFFUpdate,
				'Start' => $Start,
				'Finish' => $Finish,
				'StartHour' => $this->input->post('StartHour'),
				'FinishHour' => $this->input->post('FinishHour'),
				'Status' => $this->input->post('Status'),
				'Achievement' => $this->input->post('Achievement'),
				'Stockpile' => $this->input->post('Stockpile'),
				'Value' => $Value,
				'Note' => $this->input->post('Note'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);
		
		
	
			$this->OreInventory_model->UpdateOreInventory($data, $id);

			

			redirect('OreInventory/Table/IndexTableGeneralVisual');
		}else {
			redirect(base_url());
		}
	}

}
?>
