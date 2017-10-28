
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {

	public function Update(){
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
				$data['main'] = "Oremined";
				$data['id'] = $this->session->userdata('id');
				$data['date'] = $this->session->userdata('date');
				$data['stockpile'] = $this->session->userdata('stockpile');
				$data['Pit'] = $this->Pit_model->getPit();
        $data['OreInventory'] = $this->OreInventory_model->getOreInventory();
				$data['Oreline'] = $this->Oreline_model->getOreline();
        $data['Stockpile'] = $this->Stockpile_model->getStockpile();
				$data['Table'] = $this->Oremined_model->GetOreminedByID($data['id']);
				$this->session->userdata('update', "");
		    $this->load->view('Oremined/Update', $data);
    }else {
      redirect(base_url());
    }
	}

	public function UpdateOremined($id, $date, $stockpile)
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
			$Oremined = array(
				'Block' => $Block,
				'TruckTally' => $this->input->post('TruckTally'),
				'RL' => $this->input->post('RL'),
				'Au' => $this->input->post('Au'),
				'Ag' => $this->input->post('Ag'),
				'DryTon' => $this->input->post('DryTonBM'),
				'Density' => $this->input->post('Density'),
				'Stockpile' => $this->input->post('Stockpile'),
				'Type' => $this->input->post('Type'),
				'Date' => $Date,
				'Remarks' => $this->input->post('Remarks'),
				'Note' => $this->input->post('Note'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);

			$ToStockpile = $this->Stockpile_model->GetToStockpileForDel($date, $stockpile);
			$Oremine = $this->Oremined_model->GetOreminedByIDForDel($id);

			foreach ($ToStockpile as $tostockpilee) {
				$DensityS =  $tostockpilee->Density ;
				$TonnesS =  $tostockpilee->Tonnes ;
				$AuS =  $tostockpilee->Au ;
				$AgS =  $tostockpilee->Ag ;
				$idS = $tostockpilee->id ;
			}

			foreach ($Oremine as $oremined) {
				$DensityO =  $oremined->Density ;
				$TonnesO =  $oremined->TruckTally ;
				$AuO =  $oremined->Au ;
				$AgO =  $oremined->Ag ;
			}

			$DensityN =  $this->input->post('Density') ;
			$TonnesN =  $this->input->post('TruckTally') ;
			$AuN =  $this->input->post('Au') ;
			$AgN =  $this->input->post('Ag') ;

			$Tonness = $TonnesS - $TonnesO;
			$Density = (($DensityS*$TonnesS)-($DensityO*$TonnesO))/$Tonness;
			$Au = (($AuS*$TonnesS)-($AuO*$TonnesO))/$Tonness;
			$Ag = (($AgS*$TonnesS)-($AgO*$TonnesO))/$Tonness;

			$TonnesT = $Tonness + $TonnesN;
			$DensityT = (($Density*$Tonness)+($DensityN*$TonnesN))/$TonnesT;
			$AuT = (($AuN*$TonnesN)+($Au*$Tonness))/$TonnesT;
			$AgT = (($AgN*$TonnesN)+($Ag*$Tonness))/$TonnesT;
			$VolumeT = $TonnesT / $DensityT;

			$ToStockpile = array(
				'Volume' => $VolumeT,
				'Au' => $AuT,
				'Ag' => $AgT,
				'Tonnes' => $TonnesT,
				'Density' => $DensityT,
			);

			$this->Stockpile_model->UpdateToStockpile($ToStockpile, $date, $stockpile);

			$Temp = $this->ClosingStock_model->GetClosingStockByStockpile($stockpile);

			foreach ($Temp as $temp) {
				$Date = $temp->Date;
				$TonnesA = $temp->Tonnes - $TonnesO;
				$DensityA = (($temp->Density*$temp->Tonnes)-($DensityO*$TonnesO))/$TonnesA;
				$AuA = (($temp->Au*$temp->Tonnes)-($AuO*$TonnesO))/$TonnesA;
				$AgA = (($temp->Ag*$temp->Tonnes)-($AgO*$TonnesO))/$TonnesA;
			}

			$Tonnes = $TonnesA + $TonnesN;
			$Density = (($DensityA*$TonnesA)+($DensityN*$TonnesN))/$Tonnes;
			$Au = (($AuN*$TonnesN)+($AuA*$TonnesA))/$Tonnes;
			$Ag = (($AgN*$TonnesN)+($AgA*$TonnesA))/$Tonnes;
			$Volume = $Tonnes / $Density;

			$Closing = array(
				'Volume' => $Volume,
				'Au' => $Au,
				'Ag' => $Ag,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $stockpile,
				'Date' => $Date,
			);

			$this->ClosingStock_model->InputClosingStock($Closing);

			$this->Oremined_model->UpdateOremined($Oremined, $id);

			redirect('Oremined/Table');
		}else {
			redirect(base_url());
		}
	}

}
?>
