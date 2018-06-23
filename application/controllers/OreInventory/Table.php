
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
		$this->load->model('Oreline_model');
		$this->load->model('Closingstock_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
		$data['main'] = "OreInventory";
        $data['Pit'] = $this->Pit_model->getPit();
	    $data['pitselected'] = '0';
	    $data['date'] = '';
        $data['Table'] = $this->OreInventory_model->DailyRecord($data['pitselected']);
		    $this->load->view('OreInventory/Table', $data);
	    }else {
	     redirect(base_url());
    	}
	}


	public function IndexTableGeneral(){
    if ($this->session->userdata('GradeControl')) {
		$data['main'] = "OreInventoryGeneral";
        $data['Pit'] = $this->Pit_model->getPit();
	    $data['pitselected'] = '0';
	    $data['dateStart'] = '';
	    $data['dateEnd'] = '';
	    $data['Block'] = '';
        $data['Table'] = $this->OreInventory_model->GeneralOreRecord($data['pitselected'],$data['dateStart'],$data['dateEnd']);
        $data['TableDistinct'] = $this->OreInventory_model->GeneralOreRecordDistinct($data['pitselected'],$data['dateStart'],$data['dateEnd']);
		    $this->load->view('OreInventory/TableGeneral', $data);
    }else {
      redirect(base_url());
    }
	}

	public function IndexTableGeneralVisual(){
    if ($this->session->userdata('GradeControl')) {
		$data['main'] = "OreInventoryGeneralVisual";
        $data['Pit'] = $this->Pit_model->getPit();
	    $data['pitselected'] = '0';
	    $data['date'] = '';
        $data['Table'] = $this->OreInventory_model->GetOreInventoryByPitGeneralVisual($data['pitselected']);
		    $this->load->view('OreInventory/TableGeneralVisual', $data);
    }else {
      redirect(base_url());
    }
	}


	public function IndexTableGeneralMinWaste(){
    if ($this->session->userdata('GradeControl')) {
		$data['main'] = "OreInventoryGeneralMinWaste";
        $data['Pit'] = $this->Pit_model->getPit();
	    $data['pitselected'] = '0';
	    $data['date'] = '';
        $data['Table'] = $this->OreInventory_model->GetOreInventoryByPitGeneralMinWaste($data['pitselected']);
		    $this->load->view('OreInventory/TableGeneralMinWaste', $data);
    }else {
      redirect(base_url());
    }
	}


  public function Filter(){
		if ($this->session->userdata('GradeControl')) {
	  $data['main'] = "OreInventory";
      $data['Pit'] = $this->Pit_model->getPit();
      $data['pitselected'] = $this->input->post('Pit');
      $data['date'] = $this->input->post('Date');
      $date['Block'] = "";


      if($data['date'] == null){
      		$dateStart = "";
      		$dateEnd = "";
      		$data['Table'] = $this->OreInventory_model->DailyRecord($data['pitselected']);
      }
      else{
      		$date = explode('/',$data['date'])[2].'-'.explode('/',$data['date'])[0].'-'.explode('/',$data['date'])[1];

      		$data['Table'] = $this->OreInventory_model->DailyRecordDate($data['pitselected'],$date);
      }
      
      
			$this->load->view('OreInventory/Table', $data);
		}else {
			redirect(base_url());
		}
	}


	public function FilterGeneral(){
		if ($this->session->userdata('GradeControl')) {
	  $data['main'] = "OreInventoryGeneral";
      $data['Pit'] = $this->Pit_model->getPit();
      $data['pitselected'] = $this->input->post('Pit');
      $data['dateStart'] = $this->input->post('start');
      $data['dateEnd'] = $this->input->post('end');
      $data['Block'] = "";

      if($data['dateStart'] == null){
      		$date = "";
      		$data['Table'] = $this->OreInventory_model->GeneralOreRecordPit($data['pitselected']);
      		$data['TableDistinct'] = $this->OreInventory_model->GeneralOreRecordPitDistinct($data['pitselected']);
      }
      else{
      		
      		$dateStart = explode('/',$data['dateStart'])[2].'-'.explode('/',$data['dateStart'])[0].'-'.explode('/',$data['dateStart'])[1];
      		$dateEnd = explode('/',$data['dateEnd'])[2].'-'.explode('/',$data['dateEnd'])[0].'-'.explode('/',$data['dateEnd'])[1];


      		$data['Table'] = $this->OreInventory_model->GeneralOreRecord($data['pitselected'],$dateStart,$dateEnd);
      		$data['TableDistinct'] = $this->OreInventory_model->GeneralOreRecordDistinct($data['pitselected'],$dateStart,$dateEnd);
      }
      
      
			$this->load->view('OreInventory/TableGeneral', $data);
		}else {
			redirect(base_url());
		}
	}

	public function FilterGeneralVisual(){
		if ($this->session->userdata('GradeControl')) {
	  $data['main'] = "OreInventoryGeneralVisual";
      $data['Pit'] = $this->Pit_model->getPit();
      $data['pitselected'] = $this->input->post('Pit');
      $data['date'] = $this->input->post('Date');
      $data['Block'] = "";

      if($data['date'] == null){
      		$date = "";
      		$data['Table'] = $this->OreInventory_model->GetOreInventoryByPitGeneralVisual($data['pitselected']);
      }
      else{
      		$date = explode('/',$data['date'])[2].'-'.explode('/',$data['date'])[0].'-'.explode('/',$data['date'])[1];
      		$data['Table'] = $this->OreInventory_model->GetOreInventoryByPitandDateGeneralVisual($data['pitselected'],$date);
      }
      
      
			$this->load->view('OreInventory/TableGeneralVisual', $data);
		}else {
			redirect(base_url());
		}
	}


	public function FilterGeneralMinWaste(){
		if ($this->session->userdata('GradeControl')) {
	  $data['main'] = "OreInventoryGeneralMinWaste";
      $data['Pit'] = $this->Pit_model->getPit();
      $data['pitselected'] = $this->input->post('Pit');
      $data['date'] = $this->input->post('Date');
      $data['Block'] = "";

      if($data['date'] == null){
      		$date = "";
      		$data['Table'] = $this->OreInventory_model->GetOreInventoryByPitGeneralMinWaste($data['pitselected']);
      }
      else{
      		$date = explode('/',$data['date'])[2].'-'.explode('/',$data['date'])[0].'-'.explode('/',$data['date'])[1];
      		$data['Table'] = $this->OreInventory_model->GetOreInventoryByPitandDateGeneralMinWaste($data['pitselected'],$date);
      }
      
      
			$this->load->view('OreInventory/TableGeneralMinWaste', $data);
		}else {
			redirect(base_url());
		}
	}


	public function SearchBlock(){
		if ($this->session->userdata('GradeControl')) {
	  $data['main'] = "OreInventoryGeneral";
	  $data['pitselected'] = '0';
      $data['Pit'] = $this->Pit_model->getPit();
      $data['Block'] = $this->input->post('block');
      $data['dateStart'] = "";
      $data['dateEnd'] = "";

      $data['Table'] = $this->OreInventory_model->SearchBlock($data['Block']);
      $data['TableDistinct'] = $this->OreInventory_model->SearchBlockDitinct($data['Block']);
      
      
      
			$this->load->view('OreInventory/TableGeneral', $data);
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
				$Block = $oremined->Block;
				$Status = $oremined->Status;
				//$Volume = $oremined->Volume;

			}

			if($Status == "Completed"){
				$block = $Block;
			
				$status = "Continue";
			
				$this->Oreline_model->UpdateOrelineStatus($block,$status);
			}
			
	

			//Update To Stockpile table
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
			
			if ($TonnesStockpile == 0){
				
				$TonnesStockpileUpdate = 0; 
				$AuStockpileUpdate = 0;
				$AgStockpileUpdate = 0;
				$RLStockpile ="";
				$DensityStockpileUpdate = 0;
				$VolumeStockpileUpdate = 0;
				$AuEq75StockpileUpdate = 0;
				$Class = "-";
			}
			else{
				
				$TonnesStockpileUpdate = $TonnesStockpile - $Tonnes;
				if($TonnesStockpileUpdate > 0){

						$AuStockpileUpdate = ((($AuStockpile*$TonnesStockpile)-($Au*$Tonnes))/$TonnesStockpileUpdate);
						$AgStockpileUpdate = ((($AgStockpile*$TonnesStockpile)-($Ag*$Tonnes))/$TonnesStockpileUpdate);
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
						elseif($AuEq75StockpileUpdate >= 6.00){
							$Class="SHG";
						}
						else{
							$Class="Min.Waste";
						}

						$RLStockpile ="";
				} 
				else{
					$TonnesStockpileUpdate = 0; 
					$AuStockpileUpdate = 0;
					$AgStockpileUpdate = 0;
					$RLStockpile ="";
					$DensityStockpileUpdate = 0;
					$VolumeStockpileUpdate = 0;
					$AuEq75StockpileUpdate = 0;
					$Class = "-";
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
				'Stockpile' => $StockpileMined,
				'Date' => $date,
			);
			$this->Stockpile_model->UpdateToStockpile($ToStockpile,$StockpileMined);

			


			//Update Closingstock table
			$Closingstock = $this->Closingstock_model->GetClosingStockByStockpile($Stockpile1);

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
				$Class = "-";
			}
			else{

			$TonnesClosingstockUpdate = $TonnesClosingstock-$Tonnes;
			if($TonnesClosingstockUpdate > 0 ){
				$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)-($Au*$Tonnes))/$TonnesClosingstockUpdate);
			$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)-($Ag*$Tonnes))/$TonnesClosingstockUpdate);
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
				elseif($AuEq75ClosingstockUpdate >= 6.00){
					$Class="SHG";
				}
				else{
					$Class="Min.Waste";
				}


			}
			else{
				$TonnesClosingstockUpdate = 0;
				$AgClosingstockUpdate = 0;
				$AuClosingstockUpdate = 0;
				$VolumeClosingstockUpdate = 0;
				$DensityClosingstockUpdate = 0;
				$AuEq75ClosingstockUpdate = 0;
				$Class = "-";
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
				'Stockpile' => $StockpileClosingstock,
				'Date' => $date,
			);

			$this->Closingstock_model->UpdateClosingStockByStockpile($Closing,$StockpileClosingstock);



			$Oremined = $this->OreInventory_model->GetOreInventoryByID($id);
			foreach ($Oremined as $oremined) {
				$Au = $oremined->Au;
				$Ag = $oremined->Ag;
				$Tonnes = $oremined->DryTonFF;
				$date = $oremined->Start;
				$Stockpile1 = $oremined->Stockpile;
				$Density = $oremined->Density;
				$Block = $oremined->Block;
				$Status = $oremined->Status;
		

			}
			//Update Closing Stock Grade
			$Closingstock = $this->Closingstock_model->GetClosingStockByStockpileandDateGrade($Stockpile1,$date);

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
				$IdClosingstock = $closingstock->id;

			

				if($TonnesClosingstock == 0){
				$TonnesClosingstockUpdate = 0;
				$AuClosingstockUpdate = 0;
				$AuClosingstockUpdate = 0;
				$VolumeClosingstockUpdate = 0;
				$DensityClosingstockUpdate = 0;
				$AuEq75ClosingstockUpdate = 0;
				$Class = "-";
			}

			else{

			$TonnesClosingstockUpdate = $TonnesClosingstock-$Tonnes;

			if($TonnesClosingstockUpdate > 0){
				$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)-($Au*$Tonnes))/$TonnesClosingstockUpdate);
			$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)-($Ag*$Tonnes))/$TonnesClosingstockUpdate);
			$DensityClosingstockUpdate=round(((($DensityClosingstock*$TonnesClosingstock)-($Density*$Tonnes))/$TonnesClosingstockUpdate),2);
			$VolumeClosingstockUpdate = round($TonnesClosingstockUpdate/$DensityClosingstockUpdate,2);
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
					$Class="Min.Waste";
				}
			}
			else{
				$TonnesClosingstockUpdate = 0;
				$AgClosingstockUpdate = 0;
				$AuClosingstockUpdate = 0;
				$VolumeClosingstockUpdate = 0;
				$DensityClosingstockUpdate = 0;
				$AuEq75ClosingstockUpdate = 0;
				$Class = "-";
			}
			

			}


			$Closing = array(
				'Volume' => $VolumeClosingstockUpdate,
				'Au' => round($AuClosingstockUpdate,2),
				'Ag' => round($AgClosingstockUpdate,2),
				'AuEq75' => round($AuEq75ClosingstockUpdate,2),
				'Class' =>$Class,
				'Tonnes' => round($TonnesClosingstockUpdate,2),
				'Density' => $DensityClosingstockUpdate,
				'Stockpile' => $StockpileClosingstock,
			);

			$this->Closingstock_model->UpdateClosingStockGrade($Closing,$IdClosingstock);


			}

			
			$Oremined = $this->OreInventory_model->GetOreInventoryByID($id);
			foreach ($Oremined as $oremined) {
				$AuFG = $oremined->Au;
				$AgFG = $oremined->Ag;
				$Status = $oremined->Status;
				$Value = $oremined->Value;
			}

			
	
			$this->OreInventory_model->DeleteOreInventory($id);


			/**
			 * Update Value Closingstock, Tostockpile dan Closingstockgrade karena oremine complete di hapus. sehingga harus ada update ulang mengenai nilai Au Ag menggunakan nilai Au Ag Block Model.
			 */
		
			$CheckBlock = $this->OreInventory_model->getOreInventoryByBlockNew($Block,$Stockpile1);
			if($CheckBlock != null && $Status == "Completed" && $Value == "Final Figure"){
				foreach ($CheckBlock as $valueblock) {

					$TonnesBlock = $valueblock->DryTonFF;
					$AuBlock = $valueblock->Au;
					$AgBlock = $valueblock->Ag;
					$DensityBlock = round($valueblock->Dbdensity*0.8,2);
					$DateBlock = $valueblock->Start;
					$Stockpile = $valueblock->Stockpile;
			
					
					//Update To Stockpile table
					//Penghapusan tostockpile table berdasarkan oreinventory
					$StockpileValue = $this->Stockpile_model->GetStockpileByStockpile($Stockpile1);
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
							$AuStockpileUpdate = 0;
							$Class="-";
						}
						else{
							$AuStockpileUpdate = ((($AuStockpile*$TonnesStockpile)-($AuFG*$TonnesBlock))/$TonnesStockpileUpdate);
						 
							$AgStockpileUpdate = ((($AgStockpile*$TonnesStockpile)-($AgFG*$TonnesBlock))/$TonnesStockpileUpdate);
							$DensityStockpileUpdate = ((($DensityStockpile*$TonnesStockpile)-($DensityBlock*$TonnesBlock))/$TonnesStockpileUpdate);
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
					
				
					
						
						$TonnesStockpileUpdate = $TonnesStockpile + $TonnesBlock; 
						$AuStockpileUpdate = ((($AuStockpile*$TonnesStockpile)+($AuBlock*$TonnesBlock))/$TonnesStockpileUpdate);
						$AgStockpileUpdate = ((($AgStockpile*$TonnesStockpile)+($AgBlock*$TonnesBlock))/$TonnesStockpileUpdate);
						$DensityStockpileUpdate = ((($DensityStockpile*$TonnesStockpile)+($DensityBlock*$TonnesBlock))/$TonnesStockpileUpdate);
						$VolumeStockpileUpdate = $TonnesStockpileUpdate/$DensityStockpileUpdate;
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
						$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)-($AuFG*$TonnesBlock))/$TonnesClosingstockUpdate);
						$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)-($AgFG*$TonnesBlock))/$TonnesClosingstockUpdate);
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
					$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)+($AuBlock*$TonnesBlock))/$TonnesClosingstockUpdate);
					$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)+($AgBlock*$TonnesBlock))/$TonnesClosingstockUpdate);
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
						$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)-($AuFG*$TonnesBlock))/$TonnesClosingstockUpdate);
						$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)-($AgFG*$TonnesBlock))/$TonnesClosingstockUpdate);
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
					
					);

					$this->Closingstock_model->UpdateClosingStockGrade($Closing,$IdClosingstockGrade);

					}


					//Update Add berdasarkan blok
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

				

					$TonnesClosingstockUpdate = $TonnesClosingstock+$TonnesBlock;
					$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)+($AuBlock*$TonnesBlock))/$TonnesClosingstockUpdate);
					$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)+($AgBlock*$TonnesBlock))/$TonnesClosingstockUpdate);
				
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




				}
			}


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


	public function UpdateVisual($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->session->set_userdata('update', $id);
			redirect('OreInventory/UpdateVisual');
		}
		else {
			redirect(base_url());
		}
	}


	public function UpdateMinWaste($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->session->set_userdata('update', $id);
			redirect('OreInventory/UpdateMinWaste');
		}
		else {
			redirect(base_url());
		}
	}


	public function DeleteVisual($id)
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
				$Block = $oremined->Block;
				$Status = $oremined->Status;
				//$Volume = $oremined->Volume;

			}

			if($Status == "Completed"){
				$block = $Block;
			
				$status = "Continue";
			
				$this->Oreline_model->UpdateOrelineStatus($block,$status);
			}
			
	

			//Update To Stockpile table
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
			
			if ($TonnesStockpile == 0){
				
				$TonnesStockpileUpdate = 0; 
				$AuStockpileUpdate = 0;
				$AgStockpileUpdate = 0;
				//$DensityStockpileUpdate = 0;
				$DensityStockpileUpdate = 0;
				$VolumeStockpileUpdate = 0;
				$AuEq75StockpileUpdate = 0;
				$Class = "-";
			}
			else{
				
				$TonnesStockpileUpdate = $TonnesStockpile - $Tonnes;
				if($TonnesStockpileUpdate > 0){

						$AuStockpileUpdate = ((($AuStockpile*$TonnesStockpile)-($Au*$Tonnes))/$TonnesStockpileUpdate);
						$AgStockpileUpdate = ((($AgStockpile*$TonnesStockpile)-($Ag*$Tonnes))/$TonnesStockpileUpdate);
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
						elseif($AuEq75StockpileUpdate >= 6.00){
							$Class="SHG";
						}
						else{
							$Class="Min.Waste";
						}
				} 
				else{
					$TonnesStockpileUpdate = 0; 
					$AuStockpileUpdate = 0;
					$AgStockpileUpdate = 0;
					//$DensityStockpileUpdate = 0;
					$DensityStockpileUpdate = 0;
					$VolumeStockpileUpdate = 0;
					$AuEq75StockpileUpdate = 0;
					$Class = "-";
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
				'Stockpile' => $StockpileMined,
				'Date' => $date,
			);
			$this->Stockpile_model->UpdateToStockpile($ToStockpile,$StockpileMined);

			


			//Update Closingstock table
			$Closingstock = $this->Closingstock_model->GetClosingStockByStockpile($Stockpile1);

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
				$Class = "-";
			}
			else{

			$TonnesClosingstockUpdate = $TonnesClosingstock-$Tonnes;
			if($TonnesClosingstockUpdate > 0 ){
				$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)-($Au*$Tonnes))/$TonnesClosingstockUpdate);
			$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)-($Ag*$Tonnes))/$TonnesClosingstockUpdate);
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
				elseif($AuEq75ClosingstockUpdate >= 6.00){
					$Class="SHG";
				}
				else{
					$Class="Min.Waste";
				}


			}
			else{
				$TonnesClosingstockUpdate = 0;
				$AgClosingstockUpdate = 0;
				$AuClosingstockUpdate = 0;
				$VolumeClosingstockUpdate = 0;
				$DensityClosingstockUpdate = 0;
				$AuEq75ClosingstockUpdate = 0;
				$Class = "-";
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
				'Stockpile' => $StockpileClosingstock,
				'Date' => $date,
			);

			$this->Closingstock_model->UpdateClosingStockByStockpile($Closing,$StockpileClosingstock);



			$Oremined = $this->OreInventory_model->GetOreInventoryByID($id);
			foreach ($Oremined as $oremined) {
				$Au = $oremined->Au;
				$Ag = $oremined->Ag;
				$Tonnes = $oremined->DryTonFF;
				$date = $oremined->Start;
				$Stockpile1 = $oremined->Stockpile;
				$Density = $oremined->Density;
				$Block = $oremined->Block;
				$Status = $oremined->Status;
				//$Volume = $oremined->Volume;

			}
			//Update Closing Stock Grade
			$Closingstock = $this->Closingstock_model->GetClosingStockByStockpileandDateGrade($Stockpile1,$date);

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
				$IdClosingstock = $closingstock->id;

			

				if($TonnesClosingstock == 0){
				$TonnesClosingstockUpdate = 0;
				$AuClosingstockUpdate = 0;
				$AuClosingstockUpdate = 0;
				$VolumeClosingstockUpdate = 0;
				$DensityClosingstockUpdate = 0;
				$AuEq75ClosingstockUpdate = 0;
				$Class = "-";
			}

			else{

			$TonnesClosingstockUpdate = $TonnesClosingstock-$Tonnes;

			if($TonnesClosingstockUpdate > 0){
				$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)-($Au*$Tonnes))/$TonnesClosingstockUpdate);
			$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)-($Ag*$Tonnes))/$TonnesClosingstockUpdate);
			$DensityClosingstockUpdate=round(((($DensityClosingstock*$TonnesClosingstock)-($DensityBlock*$TonnesBlock))/$TonnesClosingstockUpdate),2);
			$VolumeClosingstockUpdate = round($TonnesClosingstockUpdate/$DensityClosingstockUpdate,2);
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
					$Class="Min.Waste";
				}
			}
			else{
				$TonnesClosingstockUpdate = 0;
				$AgClosingstockUpdate = 0;
				$AuClosingstockUpdate = 0;
				$VolumeClosingstockUpdate = 0;
				$DensityClosingstockUpdate = 0;
				$AuEq75ClosingstockUpdate = 0;
				$Class = "-";
			}
			

			}


			$Closing = array(
				'Volume' => $VolumeClosingstockUpdate,
				'Au' => round($AuClosingstockUpdate,2),
				'Ag' => round($AgClosingstockUpdate,2),
				'AuEq75' => round($AuEq75ClosingstockUpdate,2),
				'Class' =>$Class,
				'Tonnes' => round($TonnesClosingstockUpdate,2),
				'Density' => $DensityClosingstockUpdate,
				'Stockpile' => $StockpileClosingstock,
			);

			$this->Closingstock_model->UpdateClosingStockGrade($Closing,$IdClosingstock);


			}


			$this->OreInventory_model->DeleteVisual($id);
			redirect('OreInventory/Table/IndexTableGeneralVisual');
		}
		else {
			redirect(base_url());
		}
	}


	public function DeleteMinWaste($id)
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
				$Block = $oremined->Block;
				$Status = $oremined->Status;
				//$Volume = $oremined->Volume;

			}

			if($Status == "Completed"){
				$block = $Block;
			
				$status = "Continue";
			
				$this->Oreline_model->UpdateOrelineStatus($block,$status);
			}
			
	

			//Update To Stockpile table
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
			
			if ($TonnesStockpile == 0){
				
				$TonnesStockpileUpdate = 0; 
				$AuStockpileUpdate = 0;
				$AgStockpileUpdate = 0;
				//$DensityStockpileUpdate = 0;
				$DensityStockpileUpdate = 0;
				$VolumeStockpileUpdate = 0;
				$AuEq75StockpileUpdate = 0;
				$Class = "-";
			}
			else{
				
				$TonnesStockpileUpdate = $TonnesStockpile - $Tonnes;
				if($TonnesStockpileUpdate > 0){

						$AuStockpileUpdate = ((($AuStockpile*$TonnesStockpile)-($Au*$Tonnes))/$TonnesStockpileUpdate);
						$AgStockpileUpdate = ((($AgStockpile*$TonnesStockpile)-($Ag*$Tonnes))/$TonnesStockpileUpdate);
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
						elseif($AuEq75StockpileUpdate >= 6.00){
							$Class="SHG";
						}
						else{
							$Class="Min.Waste";
						}
				} 
				else{
					$TonnesStockpileUpdate = 0; 
					$AuStockpileUpdate = 0;
					$AgStockpileUpdate = 0;
					//$DensityStockpileUpdate = 0;
					$DensityStockpileUpdate = 0;
					$VolumeStockpileUpdate = 0;
					$AuEq75StockpileUpdate = 0;
					$Class = "-";
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
				'Stockpile' => $StockpileMined,
				'Date' => $date,
			);
			$this->Stockpile_model->UpdateToStockpile($ToStockpile,$StockpileMined);

			


			//Update Closingstock table
			$Closingstock = $this->Closingstock_model->GetClosingStockByStockpile($Stockpile1);

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
				$Class = "-";
			}
			else{

			$TonnesClosingstockUpdate = $TonnesClosingstock-$Tonnes;
			if($TonnesClosingstockUpdate > 0 ){
				$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)-($Au*$Tonnes))/$TonnesClosingstockUpdate);
			$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)-($Ag*$Tonnes))/$TonnesClosingstockUpdate);
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
				elseif($AuEq75ClosingstockUpdate >= 6.00){
					$Class="SHG";
				}
				else{
					$Class="Min.Waste";
				}


			}
			else{
				$TonnesClosingstockUpdate = 0;
				$AgClosingstockUpdate = 0;
				$AuClosingstockUpdate = 0;
				$VolumeClosingstockUpdate = 0;
				$DensityClosingstockUpdate = 0;
				$AuEq75ClosingstockUpdate = 0;
				$Class = "-";
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
				'Stockpile' => $StockpileClosingstock,
				'Date' => $date,
			);

			$this->Closingstock_model->UpdateClosingStockByStockpile($Closing,$StockpileClosingstock);



			$Oremined = $this->OreInventory_model->GetOreInventoryByID($id);
			foreach ($Oremined as $oremined) {
				$Au = $oremined->Au;
				$Ag = $oremined->Ag;
				$Tonnes = $oremined->DryTonFF;
				$date = $oremined->Start;
				$Stockpile1 = $oremined->Stockpile;
				$Density = $oremined->Density;
				$Block = $oremined->Block;
				$Status = $oremined->Status;
				//$Volume = $oremined->Volume;

			}
			//Update Closing Stock Grade
			$Closingstock = $this->Closingstock_model->GetClosingStockByStockpileandDateGrade($Stockpile1,$date);

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
				$IdClosingstock = $closingstock->id;

			

				if($TonnesClosingstock == 0){
				$TonnesClosingstockUpdate = 0;
				$AuClosingstockUpdate = 0;
				$AuClosingstockUpdate = 0;
				$VolumeClosingstockUpdate = 0;
				$DensityClosingstockUpdate = 0;
				$AuEq75ClosingstockUpdate = 0;
				$Class = "-";
			}

			else{

			$TonnesClosingstockUpdate = $TonnesClosingstock-$Tonnes;

			if($TonnesClosingstockUpdate > 0){
				$AuClosingstockUpdate = ((($AuClosingstock*$TonnesClosingstock)-($Au*$Tonnes))/$TonnesClosingstockUpdate);
			$AgClosingstockUpdate = ((($AgClosingstock*$TonnesClosingstock)-($Ag*$Tonnes))/$TonnesClosingstockUpdate);
			$DensityClosingstockUpdate=round(((($DensityClosingstock*$TonnesClosingstock)-($DensityBlock*$TonnesBlock))/$TonnesClosingstockUpdate),2);
			$VolumeClosingstockUpdate = round($TonnesClosingstockUpdate/$DensityClosingstockUpdate,2);
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
					$Class="Min.Waste";
				}
			}
			else{
				$TonnesClosingstockUpdate = 0;
				$AgClosingstockUpdate = 0;
				$AuClosingstockUpdate = 0;
				$VolumeClosingstockUpdate = 0;
				$DensityClosingstockUpdate = 0;
				$AuEq75ClosingstockUpdate = 0;
				$Class = "-";
			}
			

			}


			$Closing = array(
				'Volume' => $VolumeClosingstockUpdate,
				'Au' => round($AuClosingstockUpdate,2),
				'Ag' => round($AgClosingstockUpdate,2),
				'AuEq75' => round($AuEq75ClosingstockUpdate,2),
				'Class' =>$Class,
				'Tonnes' => round($TonnesClosingstockUpdate,2),
				'Density' => $DensityClosingstockUpdate,
				'Stockpile' => $StockpileClosingstock,
			);

			$this->Closingstock_model->UpdateClosingStockGrade($Closing,$IdClosingstock);


			}


			$this->OreInventory_model->DeleteMinWaste($id);
			redirect('OreInventory/Table/IndexTableGeneralMinWaste');
		}
		else {
			redirect(base_url());
		}
	}

}
?>
