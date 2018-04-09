
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input extends CI_Controller {

	public function Input(){
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
				$data['main'] = "InputOreInventory";
				$data['Pit'] = $this->Pit_model->getPit();
				$data['Oreline'] = $this->Oreline_model->GetOrelineStatus();
				$data['OreInventory'] = $this->OreInventory_model->getInventory();
        $data['Stockpile'] = $this->Stockpile_model->getStockpile();
		    $this->load->view('OreInventory/Input', $data);
    }else {
      redirect(base_url());
    }
	}

	public function InputOreInventory()
	{
    if ($this->session->userdata('GradeControl')) {
			$Date =  $this->input->post('Start');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];

			$Start =  $this->input->post('Start');
			$Start = explode('/', $Start)[2].'-'.explode('/', $Start)[0].'-'.explode('/', $Start)[1];

			$Finish =  $this->input->post('Finish');
			if ($Finish!= "") {
				$Finish = explode('/', $Finish)[2].'-'.explode('/', $Finish)[0].'-'.explode('/', $Finish)[1];
			}
			
			if ($this->input->post('Type') == "Ore") {
				$Block = $this->input->post('Block');
			}
			else {
				$Block = $this->input->post('Nonore');
			}
			
			$Stockpile = $this->input->post('Stockpile');

			$Achievement = $this->input->post('Achievement');
			$Status = $this->input->post('Status');
	
				// if($Achievement > 80 && $Status == "Completed"){
				// 	$Au = $this->input->post('Augt');
				// 	$Ag = $this->input->post('Aggt');
				// 	$AuEq75 = $this->input->post('AuEq75gr');
				// }
			$Value = $this->input->post('Value');

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

		

	


			$id = $this->input->post('Block');
			
			$status = $this->input->post('Status');
		
			$this->Oreline_model->UpdateOrelineStatus($id,$status);

			$OreInventory = $this->OreInventory_model->getOreInventoryByBlockGeneral($id,$Stockpile);
			if ($OreInventory) {
			foreach ($OreInventory as $key => $data) {

				
				$tonneslama= $data->DryTonFF;
              	$tonnesbaru = $tonneslama + $this->input->post('DryTonFF');
				$data = array(
				'Pit' => $this->input->post('Pit'),
				'Block' => $Block,
				'RL' => $this->input->post('RL'),
				'Type' => $this->input->post('Type'),
				'Au' =>$Au,
				'Ag' =>$Ag,
				'AuEq75' => $AuEq75,
				'Class' => $this->input->post('Class'),
				'Dbdensity' => $this->input->post('Density'),
				'DryTonBM' => $this->input->post('DryTonBM'),
				'DryTonFF' => $tonnesbaru,
				//'Start' => $Start,
				'Finish' => $Finish,
				'StartHour' => $this->input->post('StartHour'),
				'FinishHour' => $this->input->post('FinishHour'),
				'Stockpile' => $Stockpile,
				'Value' => $Value,
				'Status' => $this->input->post('Status'),
				'Achievement' => $this->input->post('Achievement'),
				'Density' => $this->input->post('Density'),
				'Note' => $this->input->post('Note'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);
			}
					
			$this->OreInventory_model->AddTonnesGeneral($id,$data);

			}else{

				$data = array(
				'Pit' => $this->input->post('Pit'),
				'Block' => $Block,
				'RL' => $this->input->post('RL'),
				'Type' => $this->input->post('Type'),
				'Au' =>$Au,
				'Ag' =>$Ag,
				'AuEq75' => $AuEq75,
				'Class' => $this->input->post('Class'),
				'Dbdensity' => $this->input->post('Density'),
				'DryTonBM' => $this->input->post('DryTonBM'),
				'DryTonFF' => $this->input->post('DryTonFF'),
				'Start' => $Start,
				'Finish' => $Finish,
				'StartHour' => $this->input->post('StartHour'),
				'FinishHour' => $this->input->post('FinishHour'),
				'Stockpile' => $Stockpile,
				'Value' => $Value,
				'Status' => $this->input->post('Status'),
				'Achievement' => $this->input->post('Achievement'),
				'Density' => $this->input->post('Density'),
				'Note' => $this->input->post('Note'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);
				$this->OreInventory_model->InputOreInventoryGeneral($data);
			}

			
			$TruckTally = $this->input->post('DryTonFF');
			$Density = round($this->input->post('Density')*0.8,2);
			$Tonnes = $TruckTally;

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


			$Class =  $this->input->post('Class');
			$checker = 0;
			$Volume = $Tonnes/$Density;

			$OpenTonnes = 0;
			$OpenAu = 0;
			$OpenAg = 0; 

			//Block yang sama dari continue -> completed sehingga ada update value Au Ag
			
			$CheckBlock = $this->OreInventory_model->getOreInventoryByBlockNew($Block,$Stockpile);
			if($CheckBlock != null){
				foreach ($CheckBlock as $valueblock) {

					$TonnesBlock = $valueblock->DryTonBM;
					$AuBlock = $valueblock->Au;
					$AgBlock = $valueblock->Ag;
					$DensityBlock = round($valueblock->Dbdensity*0.8,2);

					//Update To Stockpile table
					//Penghapusan tostockpile table berdasarkan oreinventory
					$StockpileValue = $this->Stockpile_model->GetStockpileByStockpile($Stockpile);
					foreach ($StockpileValue as $stockpilevalue) {
						$AuStockpile = $stockpilevalue->Au;
						$AgStockpile = $stockpilevalue->Ag;
						$TonnesStockpile = $stockpilevalue->Tonnes;
						$DensityStockpile = $stockpilevalue->Density;
						$VolumeStockpile = $stockpilevalue->Volume;
						$RLStockpile = $stockpilevalue->RL;
						$StockpileMined	= $stockpilevalue->Stockpile;
						$date = $stockpilevalue->Date;
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
						
						$TonnesStockpileUpdate = $TonnesStockpile - $TonnesBlock; 
						$AuStockpileUpdate = round(((($AuStockpile*$TonnesStockpile)-($AuBlock*$TonnesBlock))/$TonnesStockpileUpdate),2);
						$AgStockpileUpdate = round(((($AgStockpile*$TonnesStockpile)-($AgBlock*$TonnesBlock))/$TonnesStockpileUpdate),2);
						$DensityStockpileUpdate = round(((($DensityStockpile*$TonnesStockpile)-($DensityBlock*$TonnesBlock))/$TonnesStockpileUpdate),2);
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
						'Volume' => round($VolumeStockpileUpdate,2),
						'RL' => $RLStockpile,
						'Au' => round($AuStockpileUpdate,2),
						'Ag' => round($AgStockpileUpdate,2),
						'AuEq75' => round($AuEq75StockpileUpdate,2),
						'Class' =>$Class,
						'Tonnes' => round($TonnesStockpileUpdate,2),
						'Density' => round($DensityStockpileUpdate,2),
						'Stockpile' => $Stockpile,
						'Date' => $date,
					);
					$this->Stockpile_model->UpdateToStockpile($ToStockpile,$Stockpile);


					//Update Add ke tostokcpile table
					$StockpileValue = $this->Stockpile_model->GetStockpileByStockpile($Stockpile);
					foreach ($StockpileValue as $stockpilevalue) {
						$AuStockpile = $stockpilevalue->Au;
						$AgStockpile = $stockpilevalue->Ag;
						$TonnesStockpile = $stockpilevalue->Tonnes;
						$DensityStockpile = $stockpilevalue->Density;
						$VolumeStockpile = $stockpilevalue->Volume;
						$RLStockpile = $stockpilevalue->RL;
						$StockpileMined	= $stockpilevalue->Stockpile;
						$date = $stockpilevalue->Date;
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
						
						$TonnesStockpileUpdate = $TonnesStockpile + $TonnesBlock; 
						$AuStockpileUpdate = round(((($AuStockpile*$TonnesStockpile)+($Au*$TonnesBlock))/$TonnesStockpileUpdate),2);
						$AgStockpileUpdate = round(((($AgStockpile*$TonnesStockpile)+($Ag*$TonnesBlock))/$TonnesStockpileUpdate),2);
						$DensityStockpileUpdate = round(((($DensityStockpile*$TonnesStockpile)+($DensityBlock*$TonnesBlock))/$TonnesStockpileUpdate),2);
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
						'Volume' => round($VolumeStockpileUpdate,2),
						'RL' => $RLStockpile,
						'Au' => round($AuStockpileUpdate,2),
						'Ag' => round($AgStockpileUpdate,2),
						'AuEq75' => round($AuEq75StockpileUpdate,2),
						'Class' =>$Class,
						'Tonnes' => round($TonnesStockpileUpdate,2),
						'Density' => round($DensityStockpileUpdate,2),
						'Stockpile' => $Stockpile,
						'Date' => $date,
					);
					$this->Stockpile_model->UpdateToStockpile($ToStockpile,$Stockpile);


					//Update Closingstock table
					//Delete closingstock berdasarkan blok
					$Closingstock = $this->ClosingStock_model->GetClosingStockByStockpile($Stockpile);

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
						$AgClosingstockUpdate = 0;
						$AuClosingstockUpdate = 0;
						$VolumeClosingstockUpdate = 0;
						$DensityClosingstockUpdate = 0;
						$AuEq75ClosingstockUpdate = 0;
					}
					else{

					$TonnesClosingstockUpdate = $TonnesClosingstock-$TonnesBlock;
					$AuClosingstockUpdate = round(((($AuClosingstock*$TonnesClosingstock)-($AuBlock*$TonnesBlock))/$TonnesClosingstockUpdate),2);
					$AgClosingstockUpdate = round(((($AgClosingstock*$TonnesClosingstock)-($AgBlock*$TonnesBlock))/$TonnesClosingstockUpdate),2);
					$DensityClosingstockUpdate=round(((($DensityClosingstock*$TonnesClosingstock)-($DensityBlock*$TonnesBlock))/$TonnesClosingstockUpdate),2);
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
						'Volume' => round($VolumeClosingstockUpdate,2),
						'Au' => round($AuClosingstockUpdate,2),
						'Ag' => round($AgClosingstockUpdate,2),
						'AuEq75' => round($AuEq75ClosingstockUpdate,2),
						'Class' =>$Class,
						'Tonnes' => round($TonnesClosingstockUpdate,2),
						'Density' => round($DensityClosingstockUpdate,2),
						'Stockpile' => $Stockpile,
						'Date' => $date,
					);


					$this->ClosingStock_model->UpdateClosingStockByStockpile($Closing,$Stockpile);


					//Update Add closingstock berdasarkan blok
					$Closingstock = $this->ClosingStock_model->GetClosingStockByStockpile($Stockpile);

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
						$AgClosingstockUpdate = 0;
						$AuClosingstockUpdate = 0;
						$VolumeClosingstockUpdate = 0;
						$DensityClosingstockUpdate = 0;
						$AuEq75ClosingstockUpdate = 0;
					}
					else{

					$TonnesClosingstockUpdate = $TonnesClosingstock+$TonnesBlock;
					$AuClosingstockUpdate = round(((($AuClosingstock*$TonnesClosingstock)+($Au*$TonnesBlock))/$TonnesClosingstockUpdate),2);
					$AgClosingstockUpdate = round(((($AgClosingstock*$TonnesClosingstock)+($Ag*$TonnesBlock))/$TonnesClosingstockUpdate),2);
					$DensityClosingstockUpdate=round(((($DensityClosingstock*$TonnesClosingstock)+($DensityBlock*$TonnesBlock))/$TonnesClosingstockUpdate),2);
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
						'Volume' => round($VolumeClosingstockUpdate,2),
						'Au' => round($AuClosingstockUpdate,2),
						'Ag' => round($AgClosingstockUpdate,2),
						'AuEq75' => round($AuEq75ClosingstockUpdate,2),
						'Class' =>$Class,
						'Tonnes' => round($TonnesClosingstockUpdate,2),
						'Density' => round($DensityClosingstockUpdate,2),
						'Stockpile' => $Stockpile,
						'Date' => $date,
					);

					$this->ClosingStock_model->UpdateClosingStockByStockpile($Closing,$Stockpile);



					//Update Closing Stock Grade
					//Update Delete berdasarkan blok
					$Closingstock = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($Stockpile,$date);

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
						$AgClosingstockUpdate = 0;
						$AuClosingstockUpdate = 0;
						$VolumeClosingstockUpdate = 0;
						$DensityClosingstockUpdate = 0;
						$AuEq75ClosingstockUpdate = 0;
					}
					else{

					$TonnesClosingstockUpdate = $TonnesClosingstock-$TonnesBlock;
					$AuClosingstockUpdate = round(((($AuClosingstock*$TonnesClosingstock)-($AuBlock*$TonnesBlock))/$TonnesClosingstockUpdate),2);
					$AgClosingstockUpdate = round(((($AgClosingstock*$TonnesClosingstock)-($AgBlock*$TonnesBlock))/$TonnesClosingstockUpdate),2);
				
					$AuEq75ClosingstockUpdate = round($AuClosingstockUpdate+($AgClosingstockUpdate/75),2);
					$DensityClosingstockUpdate=round(((($DensityClosingstock*$TonnesClosingstock)-($DensityBlock*$TonnesBlock))/$TonnesClosingstockUpdate),2);
					$VolumeClosingstockUpdate = round($TonnesClosingstockUpdate/$DensityClosingstockUpdate,2);

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
						//'Volume' => $VolumeClosingstockUpdate,
						'Au' => round($AuClosingstockUpdate,2),
						'Ag' => round($AgClosingstockUpdate,2),
						'AuEq75' => round($AuEq75ClosingstockUpdate,2),
						'Class' =>$Class,
						'Tonnes' => round($TonnesClosingstockUpdate,2),
						'Density' => $DensityClosingstockUpdate,
						'Volume' => $VolumeClosingstockUpdate,
						'Stockpile' => $StockpileClosingstock,
						'Date' => $date,
					);

					$this->ClosingStock_model->UpdateClosingStockByDateGrade($Closing,$StockpileClosingstock,$date);


					//Update Add berdasarkan blok
					$Closingstock = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($Stockpile,$date);

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
						$VolumeClosingstock = 0;
						$DensityClosingstock = 0;
						$AuEq75ClosingstockUpdate = 0;
					}
					else{

					$TonnesClosingstockUpdate = $TonnesClosingstock+$TonnesBlock;
					$AuClosingstockUpdate = round(((($AuClosingstock*$TonnesClosingstock)+($Au*$TonnesBlock))/$TonnesClosingstockUpdate),2);
					$AgClosingstockUpdate = round(((($AgClosingstock*$TonnesClosingstock)+($Ag*$TonnesBlock))/$TonnesClosingstockUpdate),2);
				
					$AuEq75ClosingstockUpdate = round($AuClosingstockUpdate+($AgClosingstockUpdate/75),2);
					$DensityClosingstockUpdate=round(((($DensityClosingstock*$TonnesClosingstock)+($DensityBlock*$TonnesBlock))/$TonnesClosingstockUpdate),2);
					$VolumeClosingstockUpdate = round($TonnesClosingstockUpdate/$DensityClosingstockUpdate,2);

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
						//'Volume' => $VolumeClosingstockUpdate,
						'Au' => round($AuClosingstockUpdate,2),
						'Ag' => round($AgClosingstockUpdate,2),
						'AuEq75' => round($AuEq75ClosingstockUpdate,2),
						'Class' =>$Class,
						'Tonnes' => round($TonnesClosingstockUpdate,2),
						'Density' => $DensityClosingstockUpdate,
						'Volume' => round($VolumeClosingstockUpdate,2),
						'Stockpile' => $StockpileClosingstock,
						'Date' => $date,
					);

					$this->ClosingStock_model->UpdateClosingStockByDateGrade($Closing,$StockpileClosingstock,$date);


				}
			}
			


						//$ClosingStockdate = date('Y-m-d', strtotime('-1 day', strtotime($Date)));
						$Open = $this->ClosingStock_model->GetClosingStockTonnesStockpile($Stockpile);
						foreach ($Open as $open) {
							$OpenTonnes = $open->Tonnes;
							$OpenAu = $open->Au;
							$OpenAg = $open->Ag;
							
							}
					$Tonnes = $TruckTally + $OpenTonnes;


					$v_Au = (($OpenAu*$OpenTonnes)+($Au*$TruckTally))/$Tonnes;
					
					$v_Ag = (($OpenAg*$OpenTonnes)+($Ag*$TruckTally))/$Tonnes;


					$AuEq75 = round($v_Au+($v_Ag/75),2);
					if (0.65 <= $AuEq75 && $AuEq75 < 2.00){
							$Class="Marginal";
						}
						elseif(2<=$AuEq75 && $AuEq75<4.00){
							$Class="Medium Grade";
						}
						elseif(4<=$AuEq75 && $AuEq75<6.00){
							$Class="High Grade";
						}
						else{
							$Class="SHG";
						}
					$Volume = round(($Tonnes / $Density),2);

					$Temp = $this->Stockpile_model->GetToStockpileCalcStockpile($Stockpile);
					foreach ($Temp as $temp) {
						$Tonnes = $temp->Tonnes + $TruckTally;
						//$Density = (($temp->Density*$temp->Tonnes)+($Density*$TruckTally))/$Tonnes;

						$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$TruckTally))/$Tonnes;
						$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$TruckTally))/$Tonnes;
						$AuEq75 = round($v_Au+($v_Ag/75),2);
						
						if (0.65 <= $AuEq75 && $AuEq75 < 2.00){
							$Class="Marginal";
						}
						elseif(2<=$AuEq75 && $AuEq75<4.00){
							$Class="Medium Grade";
						}
						elseif(4<=$AuEq75 && $AuEq75<6.00){
							$Class="High Grade";
						}
						else{
							$Class="SHG";
						}
						$Volume = round(($Tonnes / $Density),2);
						$checker = 1;
					}
					
					$ToStockpile = array(
						'Volume' => round($Volume,2),
						'RL' => $this->input->post('RL'),
						'Au' => round($v_Au,2),
						'Ag' => round($v_Ag,2),
						'AuEq75' => round($AuEq75,2),
						'Class' =>$Class,
						'Tonnes' => round($Tonnes,2),
						'Density' => round($Density,2),
						'Stockpile' => $this->input->post('Stockpile'),
						'Date' => $Date,
					);

					if ($checker == 0) {
						$this->Stockpile_model->InputToStockpile($ToStockpile);
					}
					else {
						$this->Stockpile_model->UpdateToStockpilebyStockpile($ToStockpile, $Stockpile);
					}

					$OreminedTonnes = $this->input->post('DryTonFF');
					$OpenTonnes = 0;
					$OpenAu = 0;
					$OpenAg = 0; 
					//$ClosingStockdate = date('Y-m-d', strtotime('-1 day', strtotime($Date)));
				
						$Open = $this->ClosingStock_model->GetClosingStockTonnesStockpile($Stockpile);
						foreach ($Open as $open) {
							$OpenTonnes = $open->Tonnes;
							$OpenAu = $open->Au;
							$OpenAg = $open->Ag;
							
							}
					$Tonnes = $OreminedTonnes + $OpenTonnes;

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

					//$Aggt = $this->input->post('Aggt');
					//$v_Ag = (($OpenAg*$OpenTonnes)+($Aggt*$OreminedTonnes))/$Tonnes;
					$v_Au = $Au;
					$v_Ag = $Ag;
					$AuEq75 = $this->input->post('AuEq75');
					$Class =  $this->input->post('Class');
					$Density = round($this->input->post('Density')*0.8,2);
					
					$Volume = $Tonnes/$Density;

					
					$Temp = $this->ClosingStock_model->GetClosingStockTonnesStockpile($Stockpile);
					foreach ($Temp as $temp) {
						$Tonnes = $temp->Tonnes + $OreminedTonnes;
						$Density = (($temp->Density*$temp->Tonnes)+($Density*$OreminedTonnes))/$Tonnes;
						$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$OreminedTonnes))/$Tonnes;
						$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$OreminedTonnes))/$Tonnes;
						$AuEq75 = round($Au+($Ag/75),2);
						if (0.65<=$AuEq75 && $AuEq75<2.00){
							$Class="Marginal";
						}
						elseif(2<=$AuEq75 && $AuEq75<4.00){
							$Class="Medium Grade";
						}
						elseif(4<=$AuEq75 && $AuEq75<6.00){
							$Class="High Grade";
						}
						else{
							$Class="SHG";
						}
						$Volume = $Tonnes / $Density;
					}

					$Closing = array(
						'Volume' => $Volume,
						'Au' => round($v_Au,2),
						'Ag' => round($v_Ag,2),
						'AuEq75' => round($AuEq75,2),
						'Class' =>$Class,
						'Tonnes' => round($Tonnes,2),
						'Density' => round($Density,2),
						'Stockpile' => $this->input->post('Stockpile'),
						'Date' => $Date,
						'Status' => "Pending",
					);

					if($Temp){
						$this->ClosingStock_model->UpdateClosingStockByStockpile($Closing,$Stockpile);
						
					}
					else{
						$this->ClosingStock_model->InputClosingStock($Closing);

					}


					//Check for Closing Stock Grade
					$Density = round($this->input->post('Density')*0.8,2);
					$Temp = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($Stockpile,$Date);
					foreach ($Temp as $temp) {
						$Tonnes = $temp->Tonnes + $OreminedTonnes;
						$Density = (($temp->Density*$temp->Tonnes)+($Density*$OreminedTonnes))/$Tonnes;
						$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$OreminedTonnes))/$Tonnes;
						$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$OreminedTonnes))/$Tonnes;
						$AuEq75 = round($Au+($Ag/75),2);
						if (0.65<=$AuEq75 && $AuEq75<2.00){
							$Class="Marginal";
						}
						elseif(2<=$AuEq75 && $AuEq75<4.00){
							$Class="Medium Grade";
						}
						elseif(4<=$AuEq75 && $AuEq75<6.00){
							$Class="High Grade";
						}
						else{
							$Class="SHG";
						}
						$Volume = $Tonnes / $Density;
					}

					$Closing = array(
						'Volume' => $Volume,
						'Au' => round($v_Au,2),
						'Ag' => round($v_Ag,2),
						'AuEq75' => round($AuEq75,2),
						'Class' =>$Class,
						'Tonnes' => round($Tonnes,2),
						'Density' => $Density,
						'Stockpile' => $this->input->post('Stockpile'),
						'Date' => $Date,
						//'Status' => "Pending",
					);

					if($Temp){
						$this->ClosingStock_model->UpdateClosingStockByDateGrade($Closing,$Stockpile,$Date);
						
					}
					else{
						$this->ClosingStock_model->InputClosingStockGrade($Closing);

					}


			

			//Insert ke Inventory Table
			if ($this->input->post('Type') == "Ore") {
				$Block = $this->input->post('Block');
			}
			else {
				$Block = $this->input->post('Nonore');
			}
			
			$Stockpile = $this->input->post('Stockpile');

			$Achievement = $this->input->post('Achievement');
			$Status = $this->input->post('Status');

			$Value = $this->input->post('Value');

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

				$data = array(
				'Pit' => $this->input->post('Pit'),
				'Block' => $Block,
				'RL' => $this->input->post('RL'),
				'Type' => $this->input->post('Type'),
				'Au' =>$Au,
				'Ag' =>$Ag,
				'AuEq75' => $AuEq75,
				'Class' => $this->input->post('Class'),
				'Dbdensity' => $this->input->post('Density'),
				'DryTonBM' => $this->input->post('DryTonBM'),
				'DryTonFF' => $this->input->post('DryTonFF'),
				'Start' => $Start,
				'Finish' => $Finish,
				'StartHour' => $this->input->post('StartHour'),
				'FinishHour' => $this->input->post('FinishHour'),
				'Stockpile' => $Stockpile,
				'Value' => $Value,
				'Status' => $this->input->post('Status'),
				'Achievement' => $this->input->post('Achievement'),
				'Density' => $this->input->post('Density'),
				'Note' => $this->input->post('Note'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);
			$this->OreInventory_model->InputOreInventory($data);
			
			
			redirect('OreInventory/Input');

		}
		else {
			redirect(base_url());
		}
	}

}
?>
