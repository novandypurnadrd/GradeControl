
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
        		$data['Stockpile'] = $this->Stockpile_model->getStockpile();
				$data['Table'] = $this->OreInventory_model->GetOreInventoryforUpdate($data['id']);
				$this->session->userdata('update', "");
		    $this->load->view('OreInventory/Update', $data);
    }else {
      redirect(base_url());
    }
	}

	public function UpdateOreInventory($id)
	{
		if ($this->session->userdata('GradeControl')) {

			$Start =  $this->input->post('Start');
			$Start = explode('/', $Start)[2].'-'.explode('/', $Start)[0].'-'.explode('/', $Start)[1];
			$Finish =  $this->input->post('Finish');
			if ($Finish!= "") {
				$Finish = explode('/', $Finish)[2].'-'.explode('/', $Finish)[0].'-'.explode('/', $Finish)[1];
			}


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
			$Value = $this->input->post('Value');


			$Oremined = $this->OreInventory_model->GetOreInventoryByID($id);
			foreach ($Oremined as $oremined) {
			
				$Au = $oremined->Au;
				$Ag = $oremined->Ag;
				$Tonnes = $oremined->DryTonFF;
				$date = $oremined->Start;
				$Stockpile1 = $oremined->Stockpile;
				//$Density = $oremined->Density;
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
				//$DensityStockpileUpdate = round((($DensityStockpile*$TonnesStockpile)-($Density*$Tonnes)),2);
				//$VolumeStockpileUpdate = round((($TonnesStockpile/$DensityStockpile)-($Tonnes/$Density)),2);
				$DensityStockpileUpdate=$DensityStockpile;
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

			$data = array(
				'Pit' => $this->input->post('Pit'),
				'Block' => $this->input->post('Block'),
				'RL' => $this->input->post('RL'),
				'Au' => $AuUpdate,
				'Ag' => $AgUpdate,
				'AuEq75' =>$AuEq75Update,
				'DryTonFF' => $this->input->post('DryTonFF'),
				'Start' => $Start,
				'Finish' => $Finish,
				'StartHour' => $this->input->post('StartHour'),
				'FinishHour' => $this->input->post('FinishHour'),
				'Status' => $this->input->post('Status'),
				'Achievement' => $this->input->post('Achievement'),
				'Stockpile' => $this->input->post('Stockpile'),
				'Note' => $this->input->post('Note'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);
			$blockline = $this->input->post('Block');
			$statusline = $this->input->post('Status');
			$this->Oreline_model->UpdateOrelineStatus($blockline,$statusline);
			$this->OreInventory_model->UpdateOreInventory($data, $id);

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

			$TonnesUpdate = $this->input->post('DryTonFF');
			$AchievementUpdate = $this->input->post('Achievement');
			$StatusUpdate = $this->input->post('Status');
			$DensityUpdate = $this->input->post('Density');

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

			$TonnesStockpileNew = $TonnesStockpile+$TonnesUpdate;
			$AuStockpileNew = round(((($AuStockpile*$TonnesStockpile)+($AuUpdate*$TonnesUpdate))/$TonnesStockpileNew),2);
			$AgStockpileNew = round(((($AgStockpile*$TonnesStockpile)+($AgUpdate*$TonnesUpdate))/$TonnesStockpileNew),2);
			$AuEq75New = round(($AuStockpileNew+($AgStockpileNew/75)),2);

			if (0.65 <= $AuEq75New && $AuEq75New < 2.00){
					$ClassNew="Marginal";
				}
				elseif(2<=$AuEq75New && $AuEq75New<4.00){
					$ClassNew="Medium Grade";
				}
				elseif(4<=$AuEq75New && $AuEq75New<6.00){
					$ClassNew="High Grade";
				}
				else{
					$ClassNew="SHG";
				}

			$RLStockpileNew = $this->input->post('RL');
			$StockpileNew = $this->input->post('Stockpile');
			$DensityNew = round(((($DensityStockpile*$TonnesStockpile)+($DensityUpdate*$TonnesUpdate))/$TonnesStockpileNew),2);
			$VolumeNew = round(($TonnesStockpileNew/$DensityNew),2);


			$UpdateStockpile = array(
			'Stockpile' => $StockpileNew,
			'RL' => $RLStockpileNew,
			'Volume' =>$VolumeNew,
			'Density' =>$DensityNew,
			'Tonnes' => $TonnesStockpileNew,
			'Au' => $AuStockpileNew,
			'Ag' => $AgStockpileNew,
			'AuEq75' => $AuEq75New,
			'Class' => $ClassNew,
			'Date' => $date,
			);

			$this->Stockpile_model->UpdateToStockpile($UpdateStockpile,$date,$StockpileNew);

			

			$Closingstock = $this->Closingstock_model->GetClosingStockByStockpileandDate($Stockpile1,$date);
			foreach ($Closingstock as $closingstock) {
				$AuClosingstock = $closingstock->Au;
				$AgClosingstock = $closingstock->Ag;
				$TonnesClosingstock = $closingstock->Tonnes;
				$VolumeClosingstock = $closingstock->Volume;
				$DensityClosingstock = $closingstock->Density;
				$StockpileClosingstock = $closingstock->Stockpile;
			}

			$TonnesUpdate = $this->input->post('DryTonFF');
			$AchievementUpdate = $this->input->post('Achievement');
			$StatusUpdate = $this->input->post('Status');
			$DensityUpdate = $this->input->post('Density');

			if ($Value == "Final Figure"){
					$Au = $this->input->post('Augt');
					$Ag = $this->input->post('Aggt');
					$AuEq75 = $this->input->post('AuEq75gr');
				}
			else{

					$Au = $this->input->post('Au');
					$Ag = $this->input->post('Ag');
					$AuEq75 = $this->input->post('AuEq75');
				}

			
			$TonnesClosingstockNew = $TonnesClosingstock+$TonnesUpdate;
			$AuClosingstockNew = round(((($AuClosingstock*$TonnesClosingstock)+($AuUpdate*$TonnesUpdate))/$TonnesClosingstockNew),2);
			$AgClosingstockNew = round(((($AgClosingstock*$TonnesClosingstock)+($AgUpdate*$TonnesUpdate))/$TonnesClosingstockNew),2);
			$AuEq75New = round(($AuClosingstockNew+($AgClosingstockNew/75)),2);

			if (0.65 <= $AuEq75New && $AuEq75New < 2.00){
					$ClassNew="Marginal";
				}
				elseif(2<=$AuEq75New && $AuEq75New<4.00){
					$ClassNew="Medium Grade";
				}
				elseif(4<=$AuEq75New && $AuEq75New<6.00){
					$ClassNew="High Grade";
				}
				else{
					$ClassNew="SHG";
				}

			$StockpileNew = $this->input->post('Stockpile');
			$DensityNew = round(((($DensityClosingstock*$TonnesClosingstock)+($DensityUpdate*$TonnesUpdate))/$TonnesClosingstockNew),2);
			$VolumeNew = round(($TonnesClosingstockNew/$DensityNew),2);
			$StatusNew = $this->input->post('Status');

			$UpdateClosingstock = array (
				
				'Date' => $date,
				'Stockpile' => $StockpileNew,
				'Volume' => $VolumeNew,
				'Density' => $DensityNew,
				'Tonnes' =>$TonnesClosingstockNew,
				'Au' => $AuClosingstockNew,
				'Ag' => $AgClosingstockNew,
				'AuEq75' => $AuEq75New,
				'Class' => $ClassNew,
				'Status' => $StatusNew,
				);


			$this->Closingstock_model->UpdateClosingStockByDate($UpdateClosingstock,$StockpileClosingstock,$date);

			redirect('OreInventory/Table');
		}else {
			redirect(base_url());
		}
	}

}
?>
