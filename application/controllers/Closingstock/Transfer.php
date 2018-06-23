
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transfer extends CI_Controller {

	public function Transfer(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		$this->load->model('Oreline_model');
		$this->load->model('OreInventory_model');
	    $this->load->model('Stockpile_model');
	    $this->load->model('ClosingStock_model');
		$this->load->model('Pit_model');
		$this->load->model('Transfer_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "TransferStockpile";
			
				$data['Pit'] = $this->Pit_model->getPit();
				$data['Oreline'] = $this->Oreline_model->GetOrelineStatus();
				$data['OreInventory'] = $this->OreInventory_model->getInventory();
        		$data['Stockpile'] = $this->Stockpile_model->GetStockpileNoScatBoulder();

        		$data['date'] = "";
        		$data['dateStart'] = "";
        		$data['dateEnd'] = "";
        		$data['ToStockpile'] = $this->Stockpile_model->ViewToStockpile();
        		$data['Table'] = $this->Transfer_model->GetTransferRangeDate($data['dateStart'],$data['dateEnd']);

        		
		    $this->load->view('ClosingStock/Transfer', $data);
    }else {
      redirect(base_url());
    }
	}


	public function InsertTransfer(){

				$data['main'] = "TransferStockpile";
			
				$data['Pit'] = $this->Pit_model->getPit();
				$data['Oreline'] = $this->Oreline_model->GetOrelineStatus();
				$data['OreInventory'] = $this->OreInventory_model->getInventory();
        		$data['Stockpile'] = $this->Stockpile_model->GetStockpileNoScatBoulder();

        		$data['date'] = "";
        		$data['dateStart'] = "";
        		$data['dateEnd'] = "";
        		$data['ToStockpile'] = $this->Stockpile_model->ViewToStockpile();
        		$data['Table'] = $this->Transfer_model->GetTransferRangeDate($data['dateStart'],$data['dateEnd']);

        $Date = $this->input->post('Date');

        $Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];
      
        $StockpileSource = $this->input->post('StockpileSource');
        $AuSource = $this->input->post('sourceau');
        $AgSource = $this->input->post('sourceag');
        $DensitySource = $this->input->post('sourcedensity');
        $TransferTones = $this->input->post('transfertones');

    

        /**
         * Update Nilai Tonase Au Ag dari Source Stcokpile karena telah ditransfer ke stockpile lain sehingga dilakukan pengurangan nilai.
         */
        
        //Update Closing Stock
			$Closingstock = $this->ClosingStock_model->GetClosingStockByStockpile($StockpileSource);
			foreach ($Closingstock as $cls) {

				
						$Tonnes = $cls->Tonnes - $TransferTones;
						if($Tonnes <= 0){
							$Tonnes = 0;
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;
							$Class = "-";

						}else{
							$Density = round(((($cls->Density*$cls->Tonnes)-($DensitySource*$TransferTones))/$Tonnes),2);
							$v_Au = round(((($cls->Au*$cls->Tonnes)-($AuSource*$TransferTones))/$Tonnes),2);
							$v_Ag = round(((($cls->Ag*$cls->Tonnes)-($AgSource*$TransferTones))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = round(($Tonnes / $Density),2);

								if (0.65<=$AuEq75 && $AuEq75<2.00){
									$Class="Marginal";
								}
								elseif(2<=$AuEq75 && $AuEq75<4.00){
									$Class="Medium Grade";
								}
								elseif(4<=$AuEq75 && $AuEq75<6.00){
									$Class="High Grade";
								}
								elseif($AuEq75 >= 6.00){
									$Class="SHG";
								}
								else{
									$Class="-";
								}
						}
				
			}

			$Closing = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('StockpileSource'),
				'Date' => $Date,
				'Status' => "Complete",
				);


				$this->ClosingStock_model->UpdateClosingStockByStockpile($Closing,$StockpileSource);

			


			//Update Table tostockpile
			$ToStockpile = $this->Stockpile_model->GetStockpileByStockpile($StockpileSource);
			foreach ($ToStockpile as $tsp) {

				
						$Tonnes = $tsp->Tonnes - $TransferTones;
						if($Tonnes <= 0){
							$Tonnes = 0;
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;
							$Class = "-";

						}else{
							$Density = round(((($tsp->Density*$tsp->Tonnes)-($DensitySource*$TransferTones))/$Tonnes),2);
							$v_Au = round(((($tsp->Au*$tsp->Tonnes)-($AuSource*$TransferTones))/$Tonnes),2);
							$v_Ag = round(((($tsp->Ag*$tsp->Tonnes)-($AgSource*$TransferTones))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = round(($Tonnes / $Density),2);

								if (0.65<=$AuEq75 && $AuEq75<2.00){
									$Class="Marginal";
								}
								elseif(2<=$AuEq75 && $AuEq75<4.00){
									$Class="Medium Grade";
								}
								elseif(4<=$AuEq75 && $AuEq75<6.00){
									$Class="High Grade";
								}
								elseif($AuEq75 >= 6.00){
									$Class="SHG";
								}
								else{
									$Class="-";
								}
						}
				
			}

			$ToStockpileData = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('StockpileSource'),
				'Date' => $Date,
				);

			
				$this->Stockpile_model->UpdateToStockpile($ToStockpileData,$StockpileSource);


			//Update Closingstockgrade
			$Temp = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($StockpileSource,$Date);
			foreach ($Temp as $temp) {

			
						$Tonnes = $temp->Tonnes - $TransferTones;
						if($Tonnes <= 0){
							$Tonnes = 0;
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;


						}else{
							$Density = round(((($temp->Density*$temp->Tonnes)-($DensitySource*$TransferTones))/$Tonnes),2);
							$v_Au = round(((($temp->Au*$temp->Tonnes)-($AuSource*$TransferTones))/$Tonnes),2);
							$v_Ag = round(((($temp->Ag*$temp->Tonnes)-($AgSource*$TransferTones))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = round(($Tonnes / $Density),2);
						}
				

				

				

				if (0.65<=$AuEq75 && $AuEq75<2.00){
					$Class="Marginal";
				}
				elseif(2<=$AuEq75 && $AuEq75<4.00){
					$Class="Medium Grade";
				}
				elseif(4<=$AuEq75 && $AuEq75<6.00){
					$Class="High Grade";
				}
				elseif($AuEq75 >= 6.00){
					$Class="SHG";
				}
				else{
					$Class="-";
				}
				
				$IdClosingstock = $temp->id;


				$ClosingStockgradeData = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('StockpileSource'),
				'Date' => $Date,
				//'Status' => "Complete",
			);
				$this->ClosingStock_model->UpdateClosingStockGrade($ClosingStockgradeData,$IdClosingstock);

				
			}

			$ClosingStockgradeData = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('StockpileSource'),
				'Date' => $Date,
				//'Status' => "Complete",
			);

			if($Temp){
						
			}
			else{
				$this->ClosingStock_model->InputClosingStockGrade($ClosingStockgradeData);

			}

		


			/**
			 * Update Value Tonnes Au Ag di Stockpile Destination Tranfer karena mendapatkan tambahan Value Tonnes Au Ag dari transfer.
			 */
			
	
	
        $StockpileDestination = $this->input->post('StockpileDes');

        $BAu = $this->input->post('bau');
        $BAg = $this->input->post('bag');
        $BDensity = $this->input->post('bdensity');
        $TransferTones = $this->input->post('transfertones');

        

        //Update Closing Stock
			$Closingstock = $this->ClosingStock_model->GetClosingStockByStockpile($StockpileDestination);
			foreach ($Closingstock as $cls) {

				
						$Tonnes = $cls->Tonnes + $TransferTones;
						
						if($Tonnes <= 0){
							$Tonnes = 0;
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;
							$Class = "-";
						

						}else{
							
							$Density = round(((($cls->Density*$cls->Tonnes)+($DensitySource*$TransferTones))/$Tonnes),2);
							$v_Au = round(((($cls->Au*$cls->Tonnes)+($AuSource*$TransferTones))/$Tonnes),2);
							$v_Ag = round(((($cls->Ag*$cls->Tonnes)+($AgSource*$TransferTones))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
						
							$Volume = round(($Tonnes / $Density),2);

								if (0.65<=$AuEq75 && $AuEq75<2.00){
									$Class="Marginal";
								}
								elseif(2<=$AuEq75 && $AuEq75<4.00){
									$Class="Medium Grade";
								}
								elseif(4<=$AuEq75 && $AuEq75<6.00){
									$Class="High Grade";
								}
								elseif($AuEq75 >= 6.00){
									$Class="SHG";
								}
								else{
									$Class="-";
								}

						
						}

				
			}

			


			if($Closingstock){

				$Closing = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('StockpileDes'),
				'Date' => $Date,
				'Status' => "Complete",
				);
				$this->ClosingStock_model->UpdateClosingStockByStockpile($Closing,$StockpileDestination);
				
			}

			else{
				
				$Tonnes = $this->input->post('transfertones');
				$v_Au = $this->input->post('sourceau');
				$v_Ag = $this->input->post('sourceag');
				$AuEq75 = round(($v_Au + ($v_Ag/75)),2);
				$Density = $this->input->post('sourcedensity');
				$Volume = round(($Tonnes/$Density),2);
				$Date = $this->input->post('Date');

							if (0.65<=$AuEq75 && $AuEq75<2.00){
								$Class="Marginal";
							}
							elseif(2<=$AuEq75 && $AuEq75<4.00){
								$Class="Medium Grade";
							}
							elseif(4<=$AuEq75 && $AuEq75<6.00){
								$Class="High Grade";
							}
							elseif($AuEq75 >= 6.00){
								$Class="SHG";
							}
							else{
								$Class="-";
							}


				$Closing = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('StockpileDes'),
				'Date' => $Date,
				'Status' => "Complete",
				);
				$this->ClosingStock_model->InputClosingStock($Closing);

			}


			//Update tostockpile table
			$ToStockpile = $this->Stockpile_model->GetStockpileByStockpile($StockpileDestination);
			foreach ($ToStockpile as $tsp) {

				
						$Tonnes = $tsp->Tonnes + $TransferTones;
						if($Tonnes <= 0){
							$Tonnes = 0;
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;
							$Class = "-";

						}else{
							$Density = round(((($tsp->Density*$cls->Tonnes)+($DensitySource*$TransferTones))/$Tonnes),2);
							$v_Au = round(((($tsp->Au*$cls->Tonnes)+($AuSource*$TransferTones))/$Tonnes),2);
							$v_Ag = round(((($tsp->Ag*$cls->Tonnes)+($AgSource*$TransferTones))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = round(($Tonnes / $Density),2);

								if (0.65<=$AuEq75 && $AuEq75<2.00){
									$Class="Marginal";
								}
								elseif(2<=$AuEq75 && $AuEq75<4.00){
									$Class="Medium Grade";
								}
								elseif(4<=$AuEq75 && $AuEq75<6.00){
									$Class="High Grade";
								}
								elseif($AuEq75 >= 6.00){
									$Class="SHG";
								}
								else{
									$Class="-";
								}
						}
					}	

			


			if($ToStockpile){

				$ToStockpile = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('StockpileDes'),
				'Date' => $Date,
			
				);

				$this->Stockpile_model->UpdateToStockpile($ToStockpile,$StockpileDestination);
				
			}

			else{
				
				$Tonnes = $this->input->post('transfertones');
				$v_Au = $this->input->post('sourceau');
				$v_Ag = $this->input->post('sourceag');
				$AuEq75 = round(($v_Au + ($v_Ag/75)),2);
				$Density = $this->input->post('sourcedensity');
				$Volume = round(($Tonnes/$Density),2);
				$Date = $this->input->post('Date');

							if (0.65<=$AuEq75 && $AuEq75<2.00){
								$Class="Marginal";
							}
							elseif(2<=$AuEq75 && $AuEq75<4.00){
								$Class="Medium Grade";
							}
							elseif(4<=$AuEq75 && $AuEq75<6.00){
								$Class="High Grade";
							}
							elseif($AuEq75 >= 6.00){
								$Class="SHG";
							}
							else{
								$Class="-";
							}


				$ToStockpile = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('StockpileDes'),
				'Date' => $Date,
			
				);
				$this->Stockpile_model->InputToStockpile($ToStockpile);

			}


			//Update Closing Stock Grade Tabel
			$Temp = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($StockpileDestination,$Date);
			foreach ($Temp as $temp) {

			
						$Tonnes = $temp->Tonnes + $TransferTones;
						if($Tonnes <= 0){
							$Tonnes = 0;
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;


						}else{
							$Density = round(((($temp->Density*$temp->Tonnes)+($DensitySource*$TransferTones))/$Tonnes),2);
							$v_Au = round(((($temp->Au*$temp->Tonnes)+($AuSource*$TransferTones))/$Tonnes),2);
							$v_Ag = round(((($temp->Ag*$temp->Tonnes)+($AgSource*$TransferTones))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = round(($Tonnes / $Density),2);
						}
				

				

				

				if (0.65<=$AuEq75 && $AuEq75<2.00){
					$Class="Marginal";
				}
				elseif(2<=$AuEq75 && $AuEq75<4.00){
					$Class="Medium Grade";
				}
				elseif(4<=$AuEq75 && $AuEq75<6.00){
					$Class="High Grade";
				}
				elseif($AuEq75 >= 6.00){
					$Class="SHG";
				}
				else{
					$Class="-";
				}
				
			$IdClosingstock = $temp->id;


			$ClosingStockgradeData = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('StockpileDes'),
				
				//'Status' => "Complete",
			);

			
				$this->ClosingStock_model->UpdateClosingStockGrade($ClosingStockgradeData,$IdClosingstock);
				
			}

			if($Temp){

			}else{

				
				$ClosingStockgradeData = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('StockpileDes'),
				'Date' => $Date,
				);
				$this->ClosingStock_model->InputClosingStockGrade($ClosingStockgradeData);
			}



			/**
			 * Insert Data Transfer ke Table Transfer.
			 */
			
			$AuSource = $this->input->post('sourceau');
			$AgSource = $this->input->post('sourceag');

			$AuEq75 = round(($AuSource + ($AgSource)/75),2);

							if (0.65<=$AuEq75 && $AuEq75<2.00){
								$Class="Marginal";
							}
							elseif(2<=$AuEq75 && $AuEq75<4.00){
								$Class="Medium Grade";
							}
							elseif(4<=$AuEq75 && $AuEq75<6.00){
								$Class="High Grade";
							}
							elseif($AuEq75 >= 6.00){
								$Class="SHG";
							}
							else{
								$Class="-";
							}

			$Volume = round(($this->input->post('transfertones')/$this->input->post('sourcedensity')),2);

		
			$Transfer = array(

			'date' => $Date,
			'stockpile_source' => $this->input->post('StockpileSource'),
			'stockpile_destination' => $this->input->post('StockpileDes'),
			'tonase_transfer' => $this->input->post('transfertones'),
			'au_transfer' => $this->input->post('sourceau'),
			'ag_transfer' => $this->input->post('sourceag'),
			'aueq_transfer' => $AuEq75,
			'density_transfer' => $this->input->post('sourcedensity'),
			'volume_transfer' => $Volume,
			'class_transfer' => $Class,
			'note' => $this->input->post('note'),

			);
			
			$this->Transfer_model->InputTransfer($Transfer);

			redirect('Closingstock/Transfer');

	}


	public function Filter(){
	if ($this->session->userdata('GradeControl')) {
	  $data['main'] = "Transfer";
	  $data['Pit'] = $this->Pit_model->getPit();
	  $data['Oreline'] = $this->Oreline_model->GetOrelineStatus();
	  $data['OreInventory'] = $this->OreInventory_model->getInventory();
      $data['Stockpile'] = $this->Stockpile_model->GetStockpileNoScatBoulder();
      $data['ToStockpile'] = $this->Stockpile_model->ViewToStockpile();

      $data['dateStart'] = $this->input->post('start');
      $data['dateEnd'] = $this->input->post('end');
      $data['date'] = '';

      $dateStart = explode('/',$data['dateStart'])[2].'-'.explode('/',$data['dateStart'])[0].'-'.explode('/',$data['dateStart'])[1];
      $dateEnd = explode('/',$data['dateEnd'])[2].'-'.explode('/',$data['dateEnd'])[0].'-'.explode('/',$data['dateEnd'])[1];
    
      $data['Table'] = $this->Transfer_model->GetTransferRangeDate($dateStart,$dateEnd);

      
      
      
			$this->load->view('ClosingStock/Transfer', $data);
		}else {
			redirect(base_url());
		}
	}


	public function DeleteTransfer($id){

	  $data['main'] = "Transfer";

	  $data['Pit'] = $this->Pit_model->getPit();
	  $data['Oreline'] = $this->Oreline_model->GetOrelineStatus();
	  $data['OreInventory'] = $this->OreInventory_model->getInventory();
      $data['Stockpile'] = $this->Stockpile_model->GetStockpileNoScatBoulder();
      $data['ToStockpile'] = $this->Stockpile_model->ViewToStockpile();

      $data['dateStart'] = "";
      $data['dateEnd'] = "";
      $data['date'] = '';
      $data['Table'] = $this->Transfer_model->GetTransferRangeDate($data['dateStart'],$data['dateEnd']);

      $Transfer = $this->Transfer_model->GetTransferbyId($id);
      foreach ($Transfer as $tf) {
      
      	$StockpileSource = $tf->stockpile_source;
      	$StockpileDestination = $tf->stockpile_destination;
      	$TransferTones = $tf->tonase_transfer;
      	$AuTransfer = $tf->au_transfer;
      	$AgTransfer = $tf->ag_transfer;
      	$DensityTransfer = $tf->density_transfer;
      	$Date = $tf->date;

      }

      /**
       * Update Value Tonase Au Ag di tabel Closingstock, ToStockpile dan Closingstockgrade dengan melakukan pengurangan terhadap value transfer dari stockpile destination.
       */
      
      //ClosingStock Table
      	$Closingstock = $this->ClosingStock_model->GetClosingStockByStockpile($StockpileDestination);
			foreach ($Closingstock as $cls) {

				
						$Tonnes = $cls->Tonnes - $TransferTones;
						if($Tonnes <= 0){
							$Tonnes = 0;
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;
							$Class = "-";

						}else{
							$Density = round(((($cls->Density*$cls->Tonnes)-($DensityTransfer*$TransferTones))/$Tonnes),2);
							$v_Au = round(((($cls->Au*$cls->Tonnes)-($AuTransfer*$TransferTones))/$Tonnes),2);
							$v_Ag = round(((($cls->Ag*$cls->Tonnes)-($AgTransfer*$TransferTones))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = round(($Tonnes / $Density),2);

								if (0.65<=$AuEq75 && $AuEq75<2.00){
									$Class="Marginal";
								}
								elseif(2<=$AuEq75 && $AuEq75<4.00){
									$Class="Medium Grade";
								}
								elseif(4<=$AuEq75 && $AuEq75<6.00){
									$Class="High Grade";
								}
								elseif($AuEq75 >= 6.00){
									$Class="SHG";
								}
								else{
									$Class="-";
								}
						}
				
			}

			$Closing = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $StockpileDestination,
				'Date' => $Date,
				'Status' => "Complete",
				);


				$this->ClosingStock_model->UpdateClosingStockByStockpile($Closing,$StockpileDestination);


		//Update ToStockpile Table
		$ToStockpile = $this->Stockpile_model->GetStockpileByStockpile($StockpileDestination);
			foreach ($ToStockpile as $tsp) {

				
						$Tonnes = $tsp->Tonnes - $TransferTones;
						if($Tonnes <= 0){
							$Tonnes = 0;
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;
							$Class = "-";

						}else{
							$Density = round(((($tsp->Density*$tsp->Tonnes)-($DensityTransfer*$TransferTones))/$Tonnes),2);
							$v_Au = round(((($tsp->Au*$tsp->Tonnes)-($AuTransfer*$TransferTones))/$Tonnes),2);
							$v_Ag = round(((($tsp->Ag*$tsp->Tonnes)-($AgTransfer*$TransferTones))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = round(($Tonnes / $Density),2);

								if (0.65<=$AuEq75 && $AuEq75<2.00){
									$Class="Marginal";
								}
								elseif(2<=$AuEq75 && $AuEq75<4.00){
									$Class="Medium Grade";
								}
								elseif(4<=$AuEq75 && $AuEq75<6.00){
									$Class="High Grade";
								}
								elseif($AuEq75 >= 6.00){
									$Class="SHG";
								}
								else{
									$Class="-";
								}
						}
				
			}

			$ToStockpileData = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $StockpileDestination,
				'Date' => $Date,
				);

			
				$this->Stockpile_model->UpdateToStockpile($ToStockpileData,$StockpileDestination);


		//Update ClosingStock Grade Table
		$Temp = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($StockpileDestination,$Date);
			foreach ($Temp as $temp) {

			
						$Tonnes = $temp->Tonnes - $TransferTones;
						if($Tonnes <= 0){
							$Tonnes = 0;
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;


						}else{
							$Density = round(((($temp->Density*$temp->Tonnes)-($DensityTransfer*$TransferTones))/$Tonnes),2);
							$v_Au = round(((($temp->Au*$temp->Tonnes)-($AuTransfer*$TransferTones))/$Tonnes),2);
							$v_Ag = round(((($temp->Ag*$temp->Tonnes)-($AgTransfer*$TransferTones))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = round(($Tonnes / $Density),2);
						}
				

				

				

				if (0.65<=$AuEq75 && $AuEq75<2.00){
					$Class="Marginal";
				}
				elseif(2<=$AuEq75 && $AuEq75<4.00){
					$Class="Medium Grade";
				}
				elseif(4<=$AuEq75 && $AuEq75<6.00){
					$Class="High Grade";
				}
				elseif($AuEq75 >= 6.00){
					$Class="SHG";
				}
				else{
					$Class="-";
				}
				
				$IdClosingstock = $temp->id;


				$ClosingStockgradeData = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $StockpileDestination,
				'Date' => $Date,
				//'Status' => "Complete",
			);
				$this->ClosingStock_model->UpdateClosingStockGrade($ClosingStockgradeData,$IdClosingstock);

				
			}

			$ClosingStockgradeData = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $StockpileDestination,
				'Date' => $Date,
				//'Status' => "Complete",
			);

			if($Temp){
						
			}
			else{
				$this->ClosingStock_model->InputClosingStockGrade($ClosingStockgradeData);

			}


		/**
		 * Update Value Tonase, Au dan Ag di Closingstock, ToStockpile dan closingstock grade table dengan melakukan penambahan value dari transfer table stockpile source
		 */
		
		//ClosingStock Table
      	$Closingstock = $this->ClosingStock_model->GetClosingStockByStockpile($StockpileSource);
			foreach ($Closingstock as $cls) {

				
						$Tonnes = $cls->Tonnes + $TransferTones;
						if($Tonnes <= 0){
							$Tonnes = 0;
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;
							$Class = "-";

						}else{
							$Density = round(((($cls->Density*$cls->Tonnes)+($DensityTransfer*$TransferTones))/$Tonnes),2);
							$v_Au = round(((($cls->Au*$cls->Tonnes)+($AuTransfer*$TransferTones))/$Tonnes),2);
							$v_Ag = round(((($cls->Ag*$cls->Tonnes)+($AgTransfer*$TransferTones))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = round(($Tonnes / $Density),2);

								if (0.65<=$AuEq75 && $AuEq75<2.00){
									$Class="Marginal";
								}
								elseif(2<=$AuEq75 && $AuEq75<4.00){
									$Class="Medium Grade";
								}
								elseif(4<=$AuEq75 && $AuEq75<6.00){
									$Class="High Grade";
								}
								elseif($AuEq75 >= 6.00){
									$Class="SHG";
								}
								else{
									$Class="-";
								}
						}
				
			}

			$Closing = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $StockpileSource,
				'Date' => $Date,
				'Status' => "Complete",
				);


				$this->ClosingStock_model->UpdateClosingStockByStockpile($Closing,$StockpileSource);



			//Update ToStockpile Table
			$ToStockpile = $this->Stockpile_model->GetStockpileByStockpile($StockpileSource);
			foreach ($ToStockpile as $tsp) {

				
						$Tonnes = $tsp->Tonnes + $TransferTones;
						if($Tonnes <= 0){
							$Tonnes = 0;
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;
							$Class = "-";

						}else{
							$Density = round(((($tsp->Density*$tsp->Tonnes)+($DensityTransfer*$TransferTones))/$Tonnes),2);
							$v_Au = round(((($tsp->Au*$tsp->Tonnes)+($AuTransfer*$TransferTones))/$Tonnes),2);
							$v_Ag = round(((($tsp->Ag*$tsp->Tonnes)+($AgTransfer*$TransferTones))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = round(($Tonnes / $Density),2);

								if (0.65<=$AuEq75 && $AuEq75<2.00){
									$Class="Marginal";
								}
								elseif(2<=$AuEq75 && $AuEq75<4.00){
									$Class="Medium Grade";
								}
								elseif(4<=$AuEq75 && $AuEq75<6.00){
									$Class="High Grade";
								}
								elseif($AuEq75 >= 6.00){
									$Class="SHG";
								}
								else{
									$Class="-";
								}
						}
				
			}

			$ToStockpileData = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $StockpileSource,
				'Date' => $Date,
				);

			
				$this->Stockpile_model->UpdateToStockpile($ToStockpileData,$StockpileSource);



		//Update ClosingStock Grade Table
			$Temp = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($StockpileSource,$Date);
			foreach ($Temp as $temp) {

			
						$Tonnes = $temp->Tonnes + $TransferTones;
						if($Tonnes <= 0){
							$Tonnes = 0;
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;


						}else{
							$Density = round(((($temp->Density*$temp->Tonnes)+($DensityTransfer*$TransferTones))/$Tonnes),2);
							$v_Au = round(((($temp->Au*$temp->Tonnes)+($AuTransfer*$TransferTones))/$Tonnes),2);
							$v_Ag = round(((($temp->Ag*$temp->Tonnes)+($AgTransfer*$TransferTones))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = round(($Tonnes / $Density),2);
						}
				

				

				

				if (0.65<=$AuEq75 && $AuEq75<2.00){
					$Class="Marginal";
				}
				elseif(2<=$AuEq75 && $AuEq75<4.00){
					$Class="Medium Grade";
				}
				elseif(4<=$AuEq75 && $AuEq75<6.00){
					$Class="High Grade";
				}
				elseif($AuEq75 >= 6.00){
					$Class="SHG";
				}
				else{
					$Class="-";
				}
				
				$IdClosingstock = $temp->id;


				$ClosingStockgradeData = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $StockpileSource,
				'Date' => $Date,
				//'Status' => "Complete",
			);
				$this->ClosingStock_model->UpdateClosingStockGrade($ClosingStockgradeData,$IdClosingstock);

				
			}

			$ClosingStockgradeData = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $StockpileSource,
				'Date' => $Date,
				//'Status' => "Complete",
			);

			if($Temp){
						
			}
			else{
				$this->ClosingStock_model->InputClosingStockGrade($ClosingStockgradeData);

			}



			$this->Transfer_model->DeleteTransfer($id);

			redirect('Closingstock/Transfer');
		

	}




}
?>
