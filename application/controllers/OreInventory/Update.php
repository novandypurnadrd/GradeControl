
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
				$data['OreInventory'] = $this->OreInventory_model->getInventory();
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

			/**
			 * Update Nilai Au Ag Closingstock, Closingstockgrade dan tostockpile berdasarkan oremined yang memiliki block yang sama yg telah berganti menjadi complete.
			 */
			
			$Status = $this->input->post('Status');

			if ($this->input->post('Type') == "Ore") {
				$Block = $this->input->post('Block');
			}
			else {
				$Block = $this->input->post('Nonore');
			}

			$Stockpile = $this->input->post("Stockpile");

			
			//Block yang sama dari continue -> completed sehingga ada update value Au Ag

			$CheckBlock = $this->OreInventory_model->getOreInventoryByBlockNew($Block,$Stockpile);
			if($CheckBlock != null && $Status == "Completed" && $Value == "Final Figure"){
				foreach ($CheckBlock as $valueblock) {

					$TonnesBlock = $valueblock->DryTonFF;
					$AuBlock = $valueblock->Au;
					$AgBlock = $valueblock->Ag;
					$DensityBlock = round($valueblock->Dbdensity*0.8,2);
					$DateBlock = $valueblock->Start;


					
					
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
						$DensityStockpileUpdate = 0;
						$VolumeStockpileUpdate = 0;
						$AuEq75StockpileUpdate = 0;
						$Class = "";
					}
					else{
						
						$TonnesStockpileUpdate = $TonnesStockpile - $TonnesBlock;

						if($TonnesStockpileUpdate <= 0){
							$TonnesStockpileUpdate = 0;
							$AuStockpileUpdate = 0;
							$AgStockpileUpdate = 0;
							$DensityStockpileUpdate = 0;
							$VolumeStockpileUpdate = 0;
						}
						else{
							$AuStockpileUpdate = ((($AuStockpile*$TonnesStockpile)-($AuBlock*$TonnesBlock))/$TonnesStockpileUpdate);
						 
							$AgStockpileUpdate = ((($AgStockpile*$TonnesStockpile)-($AgBlock*$TonnesBlock))/$TonnesStockpileUpdate);
							$DensityStockpileUpdate = ((($DensityStockpile*$TonnesStockpile)-($DensityBlock*$TonnesBlock))/$TonnesStockpileUpdate);
							$VolumeStockpileUpdate = $TonnesStockpileUpdate/$DensityStockpile;
						}
						
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
						elseif($AuEq75StockpileUpdate >= 6.00){
							$Class="SHG";
						}
						else{
							$Class = "Min.Waste";
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
					
				
					
						
						$TonnesStockpileUpdate = $TonnesStockpile + $TonnesBlock; 
						$AuStockpileUpdate = ((($AuStockpile*$TonnesStockpile)+($Au*$TonnesBlock))/$TonnesStockpileUpdate);
						$AgStockpileUpdate = ((($AgStockpile*$TonnesStockpile)+($Ag*$TonnesBlock))/$TonnesStockpileUpdate);
						$DensityStockpileUpdate = ((($DensityStockpile*$TonnesStockpile)+($DensityBlock*$TonnesBlock))/$TonnesStockpileUpdate);
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
						elseif($AuEq75StockpileUpdate >= 6.00){
							$Class="SHG";
						}
						else{
							$Class = "Min.Waste";
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
					//Minus Closing stock berdasarkan oreinventiry yang memiliki blok yang sama

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


					$Closingstock = $this->Closingstock_model->GetClosingStockByStockpile($Stockpile);

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
						$Class = "-";
					}
					else{

					$TonnesClosingstockUpdate = $TonnesClosingstock-$TonnesBlock;
					if($TonnesClosingstockUpdate <= 0){
						$TonnesClosingstockUpdate = 0;
						$AuClosingstockUpdate = 0;
						$AgClosingstockUpdate = 0;
						$DensityClosingstockUpdate = 0;
						$VolumeClosingstockUpdate = 0;
						$AuEq75ClosingstockUpdate = 0;
						$Class="-";
					}
					else{
						$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)-($AuBlock*$TonnesBlock))/$TonnesClosingstockUpdate);
						$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)-($AgBlock*$TonnesBlock))/$TonnesClosingstockUpdate);
						$DensityClosingstockUpdate= ((($DensityClosingstock*$TonnesClosingstock)-($DensityBlock*$TonnesBlock))/$TonnesClosingstockUpdate);
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
						elseif($AuEq75ClosingstockUpdate >= 6.00){
							$Class="SHG";
						}
						else{
							$Class = "Min.Waste";
						}

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


					$this->Closingstock_model->UpdateClosingStockByStockpile($Closing,$Stockpile);


					//Update Add closingstock berdasarkan blok
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


					$Closingstock = $this->Closingstock_model->GetClosingStockByStockpile($Stockpile);

					foreach ($Closingstock as $closingstock) {
						$AuClosingstock = $closingstock->Au;
						$AgClosingstock = $closingstock->Ag;
						$TonnesClosingstock = $closingstock->Tonnes;
						$VolumeClosingstock = $closingstock->Volume;
						$DensityClosingstock = $closingstock->Density;
						$StockpileClosingstock = $closingstock->Stockpile;

					}

				

					$TonnesClosingstockUpdate = $TonnesClosingstock+$TonnesBlock;
					$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)+($Au*$TonnesBlock))/$TonnesClosingstockUpdate);
					$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)+($Ag*$TonnesBlock))/$TonnesClosingstockUpdate);
					$DensityClosingstockUpdate= ((($DensityClosingstock*$TonnesClosingstock)+($DensityBlock*$TonnesBlock))/$TonnesClosingstockUpdate);
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
						elseif($AuEq75ClosingstockUpdate >= 6.00){
							$Class="SHG";
						}
						else{
							$Class = "Min.Waste";
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

					$VolumeTemp = round($VolumeClosingstockUpdate,2);
					$AuTemp = round($AuClosingstockUpdate,2);
					$AgTemp = round($AgClosingstockUpdate,2);
					$AuEq75Temp = round($AuEq75ClosingstockUpdate,2);
					$ClassTemp = $Class;
					$DensityTemp = round($DensityClosingstockUpdate,2);
					$TonnesTemp = round($TonnesClosingstockUpdate,2);
					$StockpileTemp = $Stockpile;
				

					$this->Closingstock_model->UpdateClosingStockByStockpile($Closing,$Stockpile);



					//Update Closing Stock Grade Semuanya
					//Update Delete berdasarkan blok
					// $Closingstock = $this->ClosingStock_model->GetClosingStockByStockpileandDateGradeAll($Stockpile,$DateBlock,$date);


					$Closingstock = $this->Closingstock_model->GetClosingStockByStockpileandDateGrade($Stockpile,$DateBlock);

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
						$IdClosingstockGrade = $closingstock->id;

					if($TonnesClosingstock == 0){
						$TonnesClosingstockUpdate = 0;
						$AgClosingstockUpdate = 0;
						$AuClosingstockUpdate = 0;
						$VolumeClosingstockUpdate = 0;
						$DensityClosingstockUpdate = 0;
						$AuEq75ClosingstockUpdate = 0;
						$Class= "-";
					}
					else{

					$TonnesClosingstockUpdate = $TonnesClosingstock-$TonnesBlock;
					if($TonnesClosingstockUpdate <= 0){
						$AuClosingstockUpdate = 0;
						$AgClosingstockUpdate = 0;
						$DensityClosingstockUpdate = 0;
						$VolumeClosingstockUpdate = 0;
						$AuEq75ClosingstockUpdate = 0;
						$Class= "-";
					}
					else{
						$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)-($AuBlock*$TonnesBlock))/$TonnesClosingstockUpdate);
						$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)-($AgBlock*$TonnesBlock))/$TonnesClosingstockUpdate);
						$DensityClosingstockUpdate=((($DensityClosingstock*$TonnesClosingstock)-($DensityBlock*$TonnesBlock))/$TonnesClosingstockUpdate);
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
						elseif($AuEq75ClosingstockUpdate >= 6.00){
							$Class="SHG";
						}
						else{
							$Class = "Min.Waste";
						}


					}
					
				
					

					}

				

					$Closing = array(
						//'Volume' => $VolumeClosingstockUpdate,
						'Au' => round($AuClosingstockUpdate,2),
						'Ag' => round($AgClosingstockUpdate,2),
						'AuEq75' => round($AuEq75ClosingstockUpdate,2),
						'Class' =>$Class,
						'Tonnes' => round($TonnesClosingstockUpdate,2),
						'Density' => round($DensityClosingstockUpdate,2),
						'Volume' => round($VolumeClosingstockUpdate,2),
						'Stockpile' => $StockpileClosingstock,
						//'Date' => $date,
					);

					$this->Closingstock_model->UpdateClosingStockGrade($Closing,$IdClosingstockGrade);

					}


					//Update Add berdasarkan blok
					// $Closingstock = $this->ClosingStock_model->GetClosingStockByStockpileandDateGradeAll($Stockpile,$DateBlock,$date);

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

					$Closingstock = $this->Closingstock_model->GetClosingStockByStockpileandDateGrade($Stockpile,$DateBlock);

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
						$IdClosingstockGrade = $closingstock->id;

				

					$TonnesClosingstockUpdate = $TonnesClosingstock+$TonnesBlock;
					$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)+($Au*$TonnesBlock))/$TonnesClosingstockUpdate);
					$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)+($Ag*$TonnesBlock))/$TonnesClosingstockUpdate);
				
					$AuEq75ClosingstockUpdate = round($AuClosingstockUpdate+($AgClosingstockUpdate/75),2);
					$DensityClosingstockUpdate=((($DensityClosingstock*$TonnesClosingstock)+($DensityBlock*$TonnesBlock))/$TonnesClosingstockUpdate);
					$VolumeClosingstockUpdate = $TonnesClosingstockUpdate/$DensityClosingstockUpdate;

					if (0.65 <= $AuEq75ClosingstockUpdate && $AuEq75ClosingstockUpdate < 2.00){
							$Class="Marginal";
						}
						elseif(2<=$AuEq75ClosingstockUpdate && $AuEq75ClosingstockUpdate<4.00){
							$Class="Medium Grade";
						}
						elseif(4<=$AuEq75ClosingstockUpdate && $AuEq75ClosingstockUpdate<6.00){
							$Class="High Grade";
						}
						elseif($AuEq75ClosingstockUpdate){
							$Class="SHG";
						}
						else{
							$Class = "Min.Waste";
						}

				

					$Closing = array(
						//'Volume' => $VolumeClosingstockUpdate,
						'Au' => round($AuClosingstockUpdate,2),
						'Ag' => round($AgClosingstockUpdate,2),
						'AuEq75' => round($AuEq75ClosingstockUpdate,2),
						'Class' =>$Class,
						'Tonnes' => round($TonnesClosingstockUpdate,2),
						'Density' => round($DensityClosingstockUpdate,2),
						'Volume' => round($VolumeClosingstockUpdate,2),
						'Stockpile' => $StockpileClosingstock,
						
					);

					$this->Closingstock_model->UpdateClosingStockGrade($Closing,$IdClosingstockGrade);
					}



							$ClosingstockgradeSameDate = $this->Closingstock_model->GetClosingstockgradesamedate($Stockpile,$Start);
							if($ClosingstockgradeSameDate){

							}
							else{



							$Closing = array(
							'Stockpile' => $StockpileTemp,
							'Volume' => $VolumeTemp,
							'Density' => $DensityTemp,
							'Tonnes' => $TonnesTemp,
							'Au' => $AuTemp,
							'Ag' => $AgTemp,
							'AuEq75' => $AuEq75Temp,
							'Class' => $ClassTemp,
							'Status' => $StatusNew,
							'Date' => $Start,
							);

							
							$this->Closingstock_model->InputClosingStockGrade($Closing);

							}




				}
			}

			/**
			 * End Update Au Ag semua oremined yang memiliki block yang sama
			 */
			

			//Update to stockpile
			/**
			 * [Update tostockpile tabel dengan melakukan pengurangan value dari oremined yang akan diupdate nilainya]
			 * @var [type]
			 */

			$Oremined = $this->OreInventory_model->GetOreInventoryByID($id);
			foreach ($Oremined as $oremined) {
			
				$Au = $oremined->Au;
				$Ag = $oremined->Ag;
				$Tonnes = $oremined->DryTonFF;
				$date = $oremined->Start;
				$Stockpile1 = $oremined->Stockpile;
				$Density = $oremined->Dbdensity;
			}


			
			$Stockpile = $this->Stockpile_model->GetStockpileByStockpile($Stockpile1);
			foreach ($Stockpile as $stockpile) {
				$AuStockpile = $stockpile->Au;
				$AgStockpile = $stockpile->Ag;
				$TonnesStockpile = $stockpile->Tonnes;
				$DensityStockpile = $stockpile->Density;
				$VolumeStockpile = $stockpile->Volume;
				$RLStockpile = $stockpile->RL;
				$StockpileMined	= $stockpile->Stockpile;
			}

		

			if ($TonnesStockpile <= 0){
				
				$TonnesStockpileUpdate = 0; 
				$AuStockpileUpdate = 0;
				$AgStockpileUpdate = 0;
				$DensityStockpileUpdate = 0;
				$VolumeStockpileUpdate = 0;
				$AuEq75StockpileUpdate = 0;
				$Class = "";
			}
			else{
				
				$TonnesStockpileUpdate = $TonnesStockpile - $Tonnes; 

				if($TonnesStockpileUpdate > 0){

					$AuStockpileUpdate = round(((($AuStockpile*$TonnesStockpile)-($Au*$Tonnes))/$TonnesStockpileUpdate),2);
					$AgStockpileUpdate = round(((($AgStockpile*$TonnesStockpile)-($Ag*$Tonnes))/$TonnesStockpileUpdate),2);
		
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
				else{
					$TonnesStockpileUpdate = 0; 
					$AuStockpileUpdate = 0;
					$AgStockpileUpdate = 0;
				
					$DensityStockpileUpdate = 0;
					$VolumeStockpileUpdate = 0;
					$AuEq75StockpileUpdate = 0;
					$Class = "-";
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

		

			$this->Stockpile_model->UpdateToStockpilebyStockpile($ToStockpile,$StockpileMined);


			/**
			 * [$Update table tostockpile penambahan value dari oremined yang telah diupdate]
			 * @var [type]
			 */
			$Stockpile = $this->Stockpile_model->GetStockpileByStockpile($Stockpile1);
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
			$DensityUpdate = round($this->input->post('Density')*0.8,2);

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
		
		
			$this->Stockpile_model->UpdateToStockpile($UpdateStockpile,$StockpileNew);



			//Update Closingstock
			$Closingstock = $this->Closingstock_model->GetClosingStockByStockpile($Stockpile1);

			foreach ($Closingstock as $closingstock) {
				$AuClosingstock = $closingstock->Au;
				$AgClosingstock = $closingstock->Ag;
				$TonnesClosingstock = $closingstock->Tonnes;
				
				$VolumeClosingstock = $closingstock->Volume;
				$DensityClosingstock = $closingstock->Density;
				$StockpileClosingstock = $closingstock->Stockpile;
				
			}



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


			
			$TonnesClosingstockNew = $TonnesClosingstock-$Tonnes;

			if($TonnesClosingstockNew > 0){

			$AuClosingstockNew = round(((($AuClosingstock*$TonnesClosingstock)-($Au*$Tonnes))/$TonnesClosingstockNew),2);
			$AgClosingstockNew = round(((($AgClosingstock*$TonnesClosingstock)-($Ag*$Tonnes))/$TonnesClosingstockNew),2);
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

			
			$DensityNew = round(((($DensityClosingstock*$TonnesClosingstock)-($Density*$Tonnes))/$TonnesClosingstockNew),2);
			$VolumeNew = round(($TonnesClosingstockNew/$DensityNew),2);
		

			}
			else{

			$AuClosingstockNew = 0;
			$AgClosingstockNew = 0;
			$AuEq75New = 0;
			$DensityNew = 0;
			$VolumeNew = 0;
			$ClassNew="-";
			$TonnesClosingstockNew = 0;
			}

			$StockpileNew = $this->input->post('Stockpile');
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

			$this->Closingstock_model->UpdateClosingStockByStockpile($UpdateClosingstock,$StockpileClosingstock);


			$Closingstock = $this->Closingstock_model->GetClosingStockByStockpile($Stockpile1);
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
			$DensityUpdate = round($this->input->post('Density')*0.8,2);

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


			$this->Closingstock_model->UpdateClosingStockByStockpile($UpdateClosingstock,$StockpileClosingstock);



			//Update Closing Stock Grade
			

			$ClosingstockGrade = $this->Closingstock_model->GetGrade($Stockpile1,$date);
			foreach ($ClosingstockGrade as $closingstock) {
				$AuClosingstock = $closingstock->Au;
				$AgClosingstock = $closingstock->Ag;
				$TonnesClosingstock = $closingstock->Tonnes;
				$VolumeClosingstock = $closingstock->Volume;
				$DensityClosingstock = $closingstock->Density;
				$StockpileClosingstock = $closingstock->Stockpile;
				$IdClosingstock = $closingstock->id;

		
			$TonnesUpdate = $this->input->post('DryTonFF');
			$AchievementUpdate = $this->input->post('Achievement');
			$StatusUpdate = $this->input->post('Status');
			$DensityUpdate = round($this->input->post('Density')*0.8,2);

			

				
			$TonnesClosingstockNew = $TonnesClosingstock-$Tonnes;


		
			if($TonnesClosingstockNew > 0){


				$AuClosingstockNew = round(((($AuClosingstock*$TonnesClosingstock)-($Au*$Tonnes))/$TonnesClosingstockNew),2);
				$AgClosingstockNew = round(((($AgClosingstock*$TonnesClosingstock)-($Ag*$Tonnes))/$TonnesClosingstockNew),2);
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

			}
			else{

				$AuClosingstockNew = 0;
				$AgClosingstockNew = 0;
				$AuEq75New = 0;
				$TonnesClosingstockNew = 0;
				$ClassNew="-";
				$StockpileNew = $this->input->post('Stockpile');
				$DensityNew = 0;
				$VolumeNew = 0;
				$StatusNew = $this->input->post('Status');

			}
			

		
			$UpdateClosingstock = array (
				
			
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



			$this->Closingstock_model->UpdateClosingStockGrade($UpdateClosingstock,$IdClosingstock);


			}

			
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
			

			$ClosingstockGrade = $this->Closingstock_model->GetGrade($Stockpile1,$Start);
			foreach ($ClosingstockGrade as $closingstock) {
				$AuClosingstock = $closingstock->Au;
				$AgClosingstock = $closingstock->Ag;
				$TonnesClosingstock = $closingstock->Tonnes;
				$VolumeClosingstock = $closingstock->Volume;
				$DensityClosingstock = $closingstock->Density;
				$StockpileClosingstock = $closingstock->Stockpile;
				$IdClosingstock = $closingstock->id;
			

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
				
			
				'Stockpile' => $StockpileNew,
				'Volume' => $VolumeNew,
				'Density' => $DensityNew,
				'Tonnes' =>$TonnesClosingstockNew,
				'Au' => $AuClosingstockNew,
				'Ag' => $AgClosingstockNew,
				'AuEq75' => $AuEq75New,
				'Class' => $ClassNew,
				'Status' => $StatusNew,
				// 'Date' => $Start,
				);


			$this->Closingstock_model->UpdateClosingStockGrade($UpdateClosingstock,$IdClosingstock);


		}

		$ClosingstockgradeSameDate = $this->Closingstock_model->GetClosingstockgradesamedate($Stockpile1,$Start);
		if($ClosingstockgradeSameDate){

		}
		else{


							$Closing = array(
							'Stockpile' => $StockpileNew,
							'Volume' => $VolumeNew,
							'Density' => $DensityNew,
							'Tonnes' =>$TonnesClosingstockNew,
							'Au' => $AuClosingstockNew,
							'Ag' => $AgClosingstockNew,
							'AuEq75' => $AuEq75New,
							'Class' => $ClassNew,
							'Status' => $StatusNew,
							'Date' => $Start,
							);

							
							$this->Closingstock_model->InputClosingStockGrade($Closing);

		}



		//Update Ore Inventory
			$DryTonFFInventory = $this->input->post('DryTonFF');
			$DryTonFFUpdate = $DryTonFFInventory;
			$data = array(
				'Pit' => $this->input->post('Pit'),
				'Block' => $this->input->post('Block'),
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
			$blockline = $this->input->post('Block');
			$statusline = $this->input->post('Status');
			$this->Oreline_model->UpdateOrelineStatus($blockline,$statusline);
			$this->OreInventory_model->UpdateOreInventory($data, $id);

			redirect('OreInventory/Table');
		}else {
			redirect(base_url());
		}
	}

}
?>
