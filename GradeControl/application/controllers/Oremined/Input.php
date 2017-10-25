
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input extends CI_Controller {

	public function Input(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		$this->load->model('Oreline_model');
		$this->load->model('Oremined_model');
		$this->load->model('OreInventory_model');
		$this->load->model('ClosingStock_model');
    $this->load->model('Stockpile_model');
		$this->load->model('Pit_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "InputOremined";
				$data['Pit'] = $this->Pit_model->getPit();
        $data['OreInventory'] = $this->OreInventory_model->getOreInventory();
        $data['Oreline'] = $this->Oreline_model->getOreline();
        $data['Stockpile'] = $this->Stockpile_model->getStockpile();
		    $this->load->view('Oremined/Input', $data);
    }else {
      redirect(base_url());
    }
	}

	public function InputOremined()
	{
    if ($this->session->userdata('GradeControl')) {
			$Date =  $this->input->post('Date');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];
			if ($this->input->post('Type') == "Ore") {
				$Block = $this->input->post('Block');
			}
			else {
				$Block = $this->input->post('Nonore');
			}
			$TruckTally = $this->input->post('TruckTally');
			$RL = $this->input->post('RL');
			$Au = $this->input->post('Au');
			$Ag = $this->input->post('Ag');
			$DryTon = $this->input->post('DryTonBM');
			$Density = $this->input->post('Density');
			$Stockpile = $this->input->post('Stockpile');

			$Oremined = array(
				'Block' => $Block,
				'TruckTally' => $TruckTally,
				'RL' => $RL,
				'Au' => $Au,
				'Ag' => $Ag,
				'DryTon' => $DryTon,
				'Density' => $Density,
				'Stockpile' => $Stockpile,
				'Type' => $this->input->post('Type'),
				'Date' => $Date,
				'Remarks' => $this->input->post('Remarks'),
				'Note' => $this->input->post('Note'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);

			$this->Oremined_model->InputOremined($Oremined);

			$Temp = $this->Stockpile_model->GetToStockpileCalcStockpile($Stockpile);

			$Tonnes = $TruckTally;
			$checker = 0;
			$Volume = $Tonnes/$Density;
			foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $TruckTally;
				$Density = (($temp->Density*$temp->Tonnes)+($Density*$TruckTally))/$Tonnes;
				$Au = (($temp->Au*$temp->Tonnes)+($Au*$TruckTally))/$Tonnes;
				$Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$TruckTally))/$Tonnes;
				$Volume = $Tonnes / $Density;
				$checker = 1;
			}

			$ToStockpile = array(
				'Volume' => $Volume,
				'RL' => $this->input->post('RL'),
				'Au' => $Au,
				'Ag' => $Ag,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('Stockpile'),
				'Date' => $Date,
			);

			if ($checker == 0) {
				$this->Stockpile_model->InputToStockpile($ToStockpile);
			}
			else {
				$this->Stockpile_model->UpdateToStockpilebyStockpile($ToStockpile,$Stockpile);
			}

			$TruckTally = $this->input->post('TruckTally');
			$Au = $this->input->post('Au');
			$Ag = $this->input->post('Ag');
			$Density = $this->input->post('Density');
			$Temp = $this->ClosingStock_model->GetClosingStockByStockpile($Stockpile);

			$Tonnes = $TruckTally;
			$Volume = $Tonnes/$Density;
			foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $TruckTally;
				$Density = (($temp->Density*$temp->Tonnes)+($Density*$TruckTally))/$Tonnes;
				$Au = (($temp->Au*$temp->Tonnes)+($Au*$TruckTally))/$Tonnes;
				$Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$TruckTally))/$Tonnes;
				$Volume = $Tonnes / $Density;
			}

			$Closing = array(
				'Volume' => $Volume,
				'Au' => $Au,
				'Ag' => $Ag,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('Stockpile'),
				'Date' => $Date,
			);

			$this->ClosingStock_model->InputClosingStock($Closing);

			redirect('Oremined/Table');

		}
		else {
			redirect(base_url());
		}
	}

}
?>
