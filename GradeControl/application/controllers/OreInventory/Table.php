
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table extends CI_Controller {

	public function Table(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
    $this->load->model('OreInventory_model');
		$this->load->model('Pit_model');
		$this->load->model('Stockpile_model');
		$this->load->model('Closingstock_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "OreInventory";
        $data['Pit'] = $this->Pit_model->getPit();
	    $data['pitselected'] = '0';
        $data['Table'] = $this->OreInventory_model->getOreInventoryByPit($data['pitselected']);
		    $this->load->view('OreInventory/Table', $data);
    }else {
      redirect(base_url());
    }
	}


  public function Filter(){
		if ($this->session->userdata('GradeControl')) {
	  $data['main'] = "OreInventory";
      $data['Pit'] = $this->Pit_model->getPit();
      $data['pitselected'] = $this->input->post('Pit');
      $data['Table'] = $this->OreInventory_model->getOreInventoryByPit($data['pitselected']);
			$this->load->view('OreInventory/Table', $data);
		}else {
			redirect(base_url());
		}
	}

	public function DeleteOreInventory($id)
	{
		if ($this->session->userdata('GradeControl')) {

			$Au = 0;
			$Ag = 0;
			$Tonnes = 0;
			$date = 0;
			$Stockpile = 0;
			$Density = 0;
			$Volume = 0;
			$AuStockpile = 0;
			$AgStockpile = 0;
			$TonnesStockpile = 0;
			$DensityStockpile = 0;
			$VolumeStockpile = 0;				
			$RLStockpile = "";
			$StockpileMined	= 0;

			$Oremined = $this->OreInventory_model->GetOreInventoryByID($id);
			foreach ($Oremined as $oremined) {
				$Au = $oremined->Au;
				$Ag = $oremined->Ag;
				$Tonnes = $oremined->DryTonFF;
				$date = $oremined->Start;
				$Stockpile1 = $oremined->Stockpile;
				$Density = $oremined->Density;
				//$Volume = $oremined->Volume;
			}
			

			$Stockpile = $this->Stockpile_model->GetStockpileByDateandStockpile($date,$Stockpile1);
			foreach ($Stockpile as $stockpile) {
				$AuStockpile = $stockpile->Au;
				$AgStockpile = $stockpile->Ag;
				$TonnesStockpile = $stockpile->Tonnes;
				$DensityStockpile = $stockpile->Density;
				$VolumeStockpile = $stockpile->Volume;
				$RLStockpile = $stockpile->RL;
				$StockpileMined	= $stockpile->Stockpile;
			}
			
			if ($TonnesStockpile == 0){
				
				$TonnesStockpileUpdate = 0; 
				$AuStockpileUpdate = 0;
				$AgStockpileUpdate = 0;
				//$DensityStockpileUpdate = 0;
				$DensityStockpileUpdate = 0;
				$VolumeStockpileUpdate = 0;
				$AuEq75StockpileUpdate = 0;
				$Class = "";
			}
			else{
				
				$TonnesStockpileUpdate = $TonnesStockpile - $Tonnes; 
				$AuStockpileUpdate = round(((($AuStockpile*$TonnesStockpile)-($Au*$Tonnes))/$TonnesStockpileUpdate),2);
				$AgStockpileUpdate = round(((($AgStockpile*$TonnesStockpile)-($Ag*$Tonnes))/$TonnesStockpileUpdate),2);
				$DensityStockpileUpdate = round(((($DensityStockpile*$TonnesStockpile)-($Density*$Tonnes))/$TonnesStockpileUpdate),2);
				$VolumeStockpileUpdate = $TonnesStockpileUpdate/$DensityStockpile;
				$AuEq75StockpileUpdate = round($AuStockpileUpdate+($AgStockpileUpdate/75),2);
			if (0.65 <= $AuEq75StockpileUpdate && $AuEq75StockpileUpdate < 2.00){
					$Class="Marginal";
				}
				elseif(2<=$AuEq75StockpileUpdate && $AuEq75StockpileUpdate<4.00){
					$Class="Medium Grade";
				}
				elseif(4<=$AuEq75StockpileUpdate && $AuEq75StockpileUpdate<6.00){
					$Class="High Grade";
				}
				else{
					$Class="SHG";
				}

			}
			
			
			$ToStockpile = array(
				'Volume' => $VolumeStockpileUpdate,
				'RL' => $RLStockpile,
				'Au' => $AuStockpileUpdate,
				'Ag' => $AgStockpileUpdate,
				'AuEq75' => $AuEq75StockpileUpdate,
				'Class' =>$Class,
				'Tonnes' => $TonnesStockpileUpdate,
				'Density' => $DensityStockpileUpdate,
				'Stockpile' => $StockpileMined,
				'Date' => $date,
			);

			$this->Stockpile_model->UpdateToStockpile($ToStockpile,$date,$StockpileMined);

			$Closingstock = $this->Closingstock_model->GetClosingStockByStockpileandDate($Stockpile1,$date);

				$AuClosingstock = 0;
				$AgClosingstock = 0;
				$TonnesClosingstock = 0;
				$VolumeClosingstock = 0;
				$DensityClosingstock = 0;

			foreach ($Closingstock as $closingstock) {
				$AuClosingstock = $closingstock->Au;
				$AgClosingstock = $closingstock->Ag;
				$TonnesClosingstock = $closingstock->Tonnes;
				$VolumeClosingstock = $closingstock->Volume;
				$DensityClosingstock = $closingstock->Density;
				$StockpileClosingstock = $closingstock->Stockpile;
			}

			if($TonnesClosingstock == 0){
				$TonnesClosingstockUpdate = 0;
				$AgStockpileUpdate = 0;
				$AuClosingstockUpdate = 0;
				$VolumeClosingstockUpdate = 0;
				$DensityClosingstockUpdate = 0;
				$AuEq75ClosingstockUpdate = 0;
			}
			else{

			$TonnesClosingstockUpdate = $TonnesClosingstock-$Tonnes;
			$AuClosingstockUpdate = round(((($AuClosingstock*$TonnesClosingstock)-($Au*$Tonnes))/$TonnesClosingstockUpdate),2);
			$AgClosingstockUpdate = round(((($AgClosingstock*$TonnesClosingstock)-($Ag*$Tonnes))/$TonnesClosingstockUpdate),2);
			$DensityClosingstockUpdate=$DensityClosingstock;
			$VolumeClosingstockUpdate = $TonnesClosingstockUpdate/$DensityClosingstockUpdate;
			$AuEq75ClosingstockUpdate = round($AuClosingstockUpdate+($AgClosingstockUpdate/75),2);

			if (0.65 <= $AuEq75ClosingstockUpdate && $AuEq75ClosingstockUpdate < 2.00){
					$Class="Marginal";
				}
				elseif(2<=$AuEq75ClosingstockUpdate && $AuEq75ClosingstockUpdate<4.00){
					$Class="Medium Grade";
				}
				elseif(4<=$AuEq75ClosingstockUpdate && $AuEq75ClosingstockUpdate<6.00){
					$Class="High Grade";
				}
				else{
					$Class="SHG";
				}

			}

			$Closing = array(
				'Volume' => $VolumeClosingstockUpdate,
				'Au' => $AuClosingstockUpdate,
				'Ag' => $AgClosingstockUpdate,
				'AuEq75' => $AuEq75ClosingstockUpdate,
				'Class' =>$Class,
				'Tonnes' => $TonnesClosingstockUpdate,
				'Density' => $DensityClosingstockUpdate,
				'Stockpile' => $StockpileClosingstock,
				'Date' => $date,
			);

			$this->Closingstock_model->UpdateClosingStockByDate($Closing,$StockpileClosingstock,$date);

			$this->OreInventory_model->DeleteOreInventory($id);
			redirect('OreInventory/Table');
		}
		else {
			redirect(base_url());
		}
	}

	public function Update($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->session->set_userdata('update', $id);
			redirect('OreInventory/Update');
		}
		else {
			redirect(base_url());
		}
	}

}
?>
