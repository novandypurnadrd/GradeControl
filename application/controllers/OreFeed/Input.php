
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
		$this->load->model('Loader_model');
		$this->load->model('OreFeed_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "InputOreFeed";
				$data['Pit'] = $this->Pit_model->getPit();
        $data['OreInventory'] = $this->OreInventory_model->getOreInventory();
        $data['Oreline'] = $this->Oreline_model->getOreline();
        $data['Stockpile'] = $this->Stockpile_model->GetStockpile();
        $data['ToStockpile'] = $this->Stockpile_model->ViewToStockpile();
        $data['Loader'] = $this->Loader_model->GetLoader();
        $data['message'] ="";

        $Stockpile = "";
        $ClosingStockdate = "";

        $data['Grade'] = $this->ClosingStock_model->GetGrade($Stockpile,$ClosingStockdate);


        $data['AuEq75'] = "";
        $data['Class'] = "";
        $data['Tonnes'] = "";
        $data['Density'] = "";
        $data['Volume'] = "";

        $data['Datedetails'] = "";
        $data['Stockpiledetails'] = "";
        
        $data['Material'] = $this->Loader_model->GetMaterial();
        $data['Percentage'] = $this->Loader_model->GetPercentage();
		    $this->load->view('Orefeed/Input', $data);
    }else {
      redirect(base_url());
    }
	}


	public function GetGrade(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "InputOreFeed";
				$data['Pit'] = $this->Pit_model->getPit();
        $data['OreInventory'] = $this->OreInventory_model->getOreInventory();
        $data['Oreline'] = $this->Oreline_model->getOreline();
        $data['Stockpile'] = $this->Stockpile_model->GetStockpile();
        $data['ToStockpile'] = $this->Stockpile_model->ViewToStockpile();
        $data['Loader'] = $this->Loader_model->GetLoader();
        $data['message'] ="";
        
        $data['Material'] = $this->Loader_model->GetMaterial();
        $data['Percentage'] = $this->Loader_model->GetPercentage();

        $Stockpile = $this->input->post('Stockpile1');
        $Date =  $this->input->post('Date');
		$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];

		$ClosingStockdate = date('Y-m-d', strtotime('-1 day', strtotime($Date)));

	
		$data['Grade'] = $this->ClosingStock_model->GetGradeStockpile($Stockpile);


        $data['AuEq75'] = $this->input->post('AuEq75');
        $data['Class'] = $this->input->post('Class');
        $data['Tonnes'] = $this->input->post('Tonnes');
        $data['Density'] = $this->input->post('Density');
        $data['Volume'] = $this->input->post('Volume');

        $data['Datedetails'] = $this->input->post('Date');
        $data['Stockpiledetails'] = $this->input->post('Stockpile1');
		    

		$this->load->view('Orefeed/Input', $data);
    }else {
      redirect(base_url());
    }
	}


	public function InputOreFeed(){
		if ($this->session->userdata('GradeControl')){
			$Type = $this->input->post('Type');

			if ($Type == "Oremill"){
				$Date =  $this->input->post('dateOrefeed');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];
			$Stockpile = $this->input->post('stockpileOrefeed');
			$Remarks = $this->input->post('remarksOrefeed');
			$Note = $this->input->post('noteOrefeed');
			$Au = $this->input->post('Au');
			$Ag = $this->input->post('Ag');
			//$Tonnes = $this->input->post('DryTonBM');
			$Density = $this->input->post('Density');
			$AdjTonnes = $this->input->post('Adjtonnes');
			$Volume = $this->input->post('Volume');
			$AdjAu = $this->input->post('AdjAu');
			$AdjAg = $this->input->post('AdjAg');
			$AdjAuPersen = $this->input->post('AdjAuPersen')."%";
			$AdjAgPersen = $this->input->post('AdjAgPersen')."%";
			$Loader = $this->input->post('Loader');
			$Material = $this->input->post('material');
			$Percentage = $this->input->post('percentage');
			$Bucket = $this->input->post('Bucket');
			$Tonnes2 = $this->input->post('Tonnes2');
			$Density2 = $this->input->post('Density2');
			$Total = $this->input->post('Total');
			$Stock = $this->input->post('Stock');
			$Tonnestocrush = $this->input->post('Total');
			$Act = $this->input->post('Act');
			$AuEq75 = $this->input->post('AuEq75');
			$Shift = $this->input->post('shiftOrefeed');
			$Class = $this->input->post('Class');
			$Type = $this->input->post('Type');



			
			if($AdjTonnes != null){
				$Tonnes = $AdjTonnes;
			}
			else{
				$Tonnes = $Stock;
			}
			

			$Orefeed = array(
				'Date' => $Date,
				'Stockpile' => $Stockpile,
				'Shift'=>$Shift,
				'Remarks' => $Remarks,
				'Au' => $Au,
				'Ag' => $Ag,
				'AuEq75' =>$AuEq75,
				'Class' => $Class,
				'AdjAu' =>$AdjAu,
				'AdjAg' =>$AdjAg,
				'AdjAuPersen' =>$AdjAuPersen,
				'AdjAgPersen' =>$AdjAgPersen,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Volume' => $Volume,
				'Loader' => $Loader,
				'Material' => $Material,
				'Percentage' => $Percentage,
				'Tonnestocrush' => $Tonnestocrush,
				'Act' => $Act,
				'Bucket' => $Bucket,
				'Type' => $Type,
				'Note' => $Note,
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);

				$this->OreFeed_model->InputOreFeed($Orefeed);
				//$this->Oremined_model->UpdateTonnes($Stockpile,$Date,$Tonnes);

			$OrefeedTonnes = $Total;
			$v_Au = $this->input->post('Au');
			$v_Ag = $this->input->post('Ag');
			$Au = $this->input->post('Au');
			$Ag = $this->input->post('Ag');
			$Density = $this->input->post('Density');


			//Update Closing Stock
			$Temp = $this->ClosingStock_model->GetClosingStockByStockpile($Stockpile);
			foreach ($Temp as $temp) {

					if($AdjTonnes != null){
					$Tonnes = $AdjTonnes;

						if($Tonnes == 0){
						$Density = 0;
						$v_Au = 0;
						$v_Ag = 0;
						$AuEq75 = 0;
						$Volume = 0;

					}else{
						$Density = $this->input->post('Density');
						$v_Au = $this->input->post('Au');
						$v_Ag = $this->input->post('Ag');
						$AuEq75 = round(($v_Au+($v_Ag/75)),2);
						$Volume = round($Tonnes / $Density,2);
					}

				}
				else{
						$Tonnes = $temp->Tonnes - $OrefeedTonnes;
						if($Tonnes == 0){
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;

						}else{
							$Density = round(((($temp->Density*$temp->Tonnes)-($Density*$OrefeedTonnes))/$Tonnes),2);
							$v_Au = round(((($temp->Au*$temp->Tonnes)-($Au*$OrefeedTonnes))/$Tonnes),2);
							$v_Ag = round(((($temp->Ag*$temp->Tonnes)-($Ag*$OrefeedTonnes))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = $Tonnes / $Density;
						}
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
				
			
				
			}

			$Closing = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('stockpileOrefeed'),
				'Date' => $Date,
				'Status' => "Complete",
			);

			if($Temp){
				$this->ClosingStock_model->UpdateClosingStockByStockpile($Closing,$Stockpile);
				
			}
			else{
				$this->ClosingStock_model->InputClosingStock($Closing);

			}


			//Update Closing Stock Grade
			
			$Temp = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($Stockpile,$Date);
			foreach ($Temp as $temp) {

				if($AdjTonnes != null){
						$Tonnes = $AdjTonnes;
						if($Tonnes == 0){
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;

						}else{
							$Density = $this->input->post('Density');
							$v_Au = $this->input->post('Au');
							$v_Ag = $this->input->post('Ag');
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = round($Tonnes / $Density,2);
						}
				}
				else{
						$Tonnes = $temp->Tonnes - $OrefeedTonnes;
						if($Tonnes == 0){
							$Density = 0;
							$v_Au = 0;
							$v_Ag = 0;
							$AuEq75 = 0;
							$Volume = 0;

						}else{
							$Density = round(((($temp->Density*$temp->Tonnes)-($Density*$OrefeedTonnes))/$Tonnes),2);
							$v_Au = round(((($temp->Au*$temp->Tonnes)-($Au*$OrefeedTonnes))/$Tonnes),2);
							$v_Ag = round(((($temp->Ag*$temp->Tonnes)-($Ag*$OrefeedTonnes))/$Tonnes),2);
							$AuEq75 = round(($v_Au+($v_Ag/75)),2);
							$Volume = $Tonnes / $Density;
						}
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
				

				
			}

			$Closing = array(
				'Volume' => $Volume,
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('stockpileOrefeed'),
				'Date' => $Date,
				//'Status' => "Complete",
			);

			if($Temp){
				$this->ClosingStock_model->UpdateClosingStockByDateGrade($Closing,$Stockpile,$Date);
				
			}
			else{
				$this->ClosingStock_model->InputClosingStockGrade($Closing);

			}



			//Update To Stockpile
			$Stockpile = $this->Stockpile_model->GetStockpileByStockpile($Stockpile);
			foreach ($Stockpile as $stockpile) {
				$AuStockpile = $stockpile->Au;
				$AgStockpile = $stockpile->Ag;
				$TonnesStockpile = $stockpile->Tonnes;
				$DensityStockpile = $stockpile->Density;
				$VolumeStockpile = $stockpile->Volume;
				$RLStockpile = $stockpile->RL;
				$StockpileFeed	= $stockpile->Stockpile;
				$IdStockpile = $stockpile->id;
			}


			
			if($AdjTonnes != null){
							$UpdateTonnesStockpile = $AdjTonnes;
						if($UpdateTonnesStockpile == 0){
							$UpdateAuStockpile = 0;
							$UpdateAgStockpile = 0;
							$UpdateDensityStockpile = 0;
							$UpdateAuEq75Stockpile = 0;
							$UpdateStockpileVolume = 0;
							$UpdateStockpileRL = $RLStockpile;
							$UpdateStockpileStockpile = $StockpileFeed;
						}else{
							$UpdateAuStockpile = $this->input->post('Au');
							$UpdateAgStockpile = $this->input->post('Ag');
							$UpdateDensityStockpile = $this->input->post('Density');
							$UpdateAuEq75Stockpile = round((($UpdateAuStockpile)+($UpdateAgStockpile/75)),2);
							$UpdateStockpileVolume = round(($UpdateTonnesStockpile/$UpdateDensityStockpile),2);
							$UpdateStockpileRL = $RLStockpile;
							$UpdateStockpileStockpile = $StockpileFeed;

						}
				}
				else{
							$UpdateTonnesStockpile = $TonnesStockpile-$Total;
						if($UpdateTonnesStockpile == 0){
							$UpdateAuStockpile = 0;
							$UpdateAgStockpile = 0;
							$UpdateDensityStockpile = 0;
							$UpdateAuEq75Stockpile = 0;
							$UpdateStockpileVolume = 0;
							$UpdateStockpileRL = $RLStockpile;
							$UpdateStockpileStockpile = $StockpileFeed;
						}else{
							$UpdateAuStockpile = round(((($AuStockpile*$TonnesStockpile)-($Au*$Total))/$UpdateTonnesStockpile),2);
							$UpdateAgStockpile = round(((($AgStockpile*$TonnesStockpile)-($Ag*$Total))/$UpdateTonnesStockpile),2);
							$UpdateDensityStockpile = round(((($DensityStockpile*$TonnesStockpile)-($Density*$Total))/$UpdateTonnesStockpile),2);
							$UpdateAuEq75Stockpile = round((($UpdateAuStockpile)+($UpdateAgStockpile/75)),2);
							$UpdateStockpileVolume = round(($UpdateTonnesStockpile/$UpdateDensityStockpile),2);
							$UpdateStockpileRL = $RLStockpile;
							$UpdateStockpileStockpile = $StockpileFeed;

						}
				}

			

			

			if (0.65<=$UpdateAuEq75Stockpile && $UpdateAuEq75Stockpile<2.00){
					$Class="Marginal";
				}
				elseif(2<=$UpdateAuEq75Stockpile && $UpdateAuEq75Stockpile<4.00){
					$Class="Medium Grade";
				}
				elseif(4<=$UpdateAuEq75Stockpile && $UpdateAuEq75Stockpile<6.00){
					$Class="High Grade";
				}
				elseif($UpdateAuEq75Stockpile >= 6.00){
					$Class="SHG";
				}
				else{
					$Class="-";
				}
			
			$ToStockpile = array(
				'Volume' => $UpdateStockpileVolume,
				'RL' => $UpdateStockpileRL,
				'Au' => $UpdateAuStockpile,
				'Ag' => $UpdateAgStockpile,
				'AuEq75' => $UpdateAuEq75Stockpile,
				'Class' =>$Class,
				'Tonnes' => $UpdateTonnesStockpile,
				'Density' => $UpdateDensityStockpile,
				'Stockpile' => $UpdateStockpileStockpile,
				'Date' => $Date,
			);

			if($Stockpile){
				$this->Stockpile_model->UpdateToStockpile($ToStockpile,$UpdateStockpileStockpile);
				
			}
			else{
				$this->Stockpile_model->InputToStockpile($ToStockpile);

			}

			redirect('OreFeed/Input');
			}
			else{

				$Date =  $this->input->post('dateOrefeed');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];
			$Stockpile = $this->input->post('stockpileOrefeed');
			$Remarks = $this->input->post('remarksOrefeed');
			$Note = $this->input->post('noteOrefeed');
			$Au = $this->input->post('Au');
			$Ag = $this->input->post('Ag');
			//$Tonnes = $this->input->post('DryTonBM');
			$Density = $this->input->post('Density');
			$AdjTonnes = $this->input->post('Adjtonnes');
			$Volume = $this->input->post('Volume');
			$AdjAu = $this->input->post('AdjAu');
			$AdjAg = $this->input->post('AdjAg');
			$AdjAuPersen = $this->input->post('AdjAuPersen')."%";
			$AdjAgPersen = $this->input->post('AdjAgPersen')."%";
			$Loader = $this->input->post('Loader');
			$Material = $this->input->post('material');
			$Percentage = $this->input->post('percentage');
			$Bucket = $this->input->post('Bucket');
			$Tonnes2 = $this->input->post('Tonnes2');
			$Density2 = $this->input->post('Density2');
			$Total = $this->input->post('Total');
			$Stock = $this->input->post('Stock');
			$Tonnestocrush = $this->input->post('Total');
			$AuEq75 = $this->input->post('AuEq75');
			$Shift = $this->input->post('shiftOrefeed');
			$Class = $this->input->post('Class');
			$Type = $this->input->post('Type');
			
			if($AdjTonnes != null){
				$Tonnes = $AdjTonnes;
			}
			else{
				$Tonnes = $Stock;
			}
			

			$Orefeed = array(
				'Date' => $Date,
				'Stockpile' => $Stockpile,
				'Shift'=>$Shift,
				'Remarks' => $Remarks,
				'Au' => $Au,
				'Ag' => $Ag,
				'AuEq75' =>$AuEq75,
				'Class' => $Class,
				'AdjAu' =>$AdjAu,
				'AdjAg' =>$AdjAg,
				'AdjAuPersen' =>$AdjAuPersen,
				'AdjAgPersen' =>$AdjAgPersen,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Volume' => $Volume,
				'Loader' => $Loader,
				'Material' => $Material,
				'Percentage' => $Percentage,
				'Tonnestocrush' => $Tonnestocrush,
				'Bucket' => $Bucket,
				'Type' => $Type,
				'Note' => $Note,
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);

				$this->OreFeed_model->InputOreFeed($Orefeed);
				redirect('OreFeed/Table');
			}
		}
	}

	public function InputBypass(){
		if ($this->session->userdata('GradeControl')){
			$Date =  $this->input->post('dateOrefeed');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];
			$Stockpile = $this->input->post('stockpileOrefeed');
			$Remarks = $this->input->post('remarksOrefeed');
			$Note = $this->input->post('noteOrefeed');
			$Au = $this->input->post('Au');
			$Ag = $this->input->post('Ag');
			//$Tonnes = $this->input->post('DryTonBM');
			$Density = $this->input->post('Density');
			$AdjTonnes = $this->input->post('Adjtonnes');
			$Volume = $this->input->post('Volume');
			$AdjAu = $this->input->post('AdjAu');
			$AdjAg = $this->input->post('AdjAg');
			$AdjAuPersen = $this->input->post('AdjAuPersen')."%";
			$AdjAgPersen = $this->input->post('AdjAgPersen')."%";
			$Loader = $this->input->post('Loader');
			$Material = $this->input->post('material');
			$Percentage = $this->input->post('percentage');
			$Bucket = $this->input->post('Bucket');
			$Tonnes2 = $this->input->post('Tonnes2');
			$Density2 = $this->input->post('Density2');
			$Total = $this->input->post('Total');
			$Stock = $this->input->post('Stock');
			$Tonnestocrush = $this->input->post('Total');
			$AuEq75 = $this->input->post('AuEq75');
			$Shift = $this->input->post('shiftOrefeed');
			$Class = $this->input->post('Class');
			$Type = $this->input->post('Type');
			
			if($AdjTonnes != null){
				$Tonnes = $AdjTonnes;
			}
			else{
				$Tonnes = $Stock;
			}
			

			$Orefeed = array(
				'Date' => $Date,
				'Stockpile' => $Stockpile,
				'Shift'=>$Shift,
				'Remarks' => $Remarks,
				'Au' => $Au,
				'Ag' => $Ag,
				'AuEq75' =>$AuEq75,
				'Class' => $Class,
				'AdjAu' =>$AdjAu,
				'AdjAg' =>$AdjAg,
				'AdjAuPersen' =>$AdjAuPersen,
				'AdjAgPersen' =>$AdjAgPersen,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Volume' => $Volume,
				'Loader' => $Loader,
				'Material' => $Material,
				'Percentage' => $Percentage,
				'Tonnestocrush' => $Tonnestocrush,
				'Bucket' => $Bucket,
				'Type' => $Type,
				'Note' => $Note,
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);

				$this->OreFeed_model->InputOreFeed($Orefeed);
				redirect('OreFeed/Table');
		}
		else {
			redirect(base_url());
		}
	}

	public function InputOreMill(){
    if ($this->session->userdata('GradeControl')) {
			$Date =  $this->input->post('dateOrefeed');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];
			$Stockpile = $this->input->post('stockpileOrefeed');
			$Remarks = $this->input->post('remarksOrefeed');
			$Note = $this->input->post('noteOrefeed');
			$Au = $this->input->post('Au');
			$Ag = $this->input->post('Ag');
			//$Tonnes = $this->input->post('DryTonBM');
			$Density = $this->input->post('Density');
			$AdjTonnes = $this->input->post('Adjtonnes');
			$Volume = $this->input->post('Volume');
			$AdjAu = $this->input->post('AdjAu');
			$AdjAg = $this->input->post('AdjAg');
			$AdjAuPersen = $this->input->post('AdjAuPersen')."%";
			$AdjAgPersen = $this->input->post('AdjAgPersen')."%";
			$Loader = $this->input->post('Loader');
			$Material = $this->input->post('material');
			$Percentage = $this->input->post('percentage');
			$Bucket = $this->input->post('Bucket');
			$Tonnes2 = $this->input->post('Tonnes2');
			$Density2 = $this->input->post('Density2');
			$Total = $this->input->post('Total');
			$Stock = $this->input->post('Stock');
			$Tonnestocrush = $this->input->post('Total');
			$AuEq75 = $this->input->post('AuEq75');
			$Shift = $this->input->post('shiftOrefeed');
			$Class = $this->input->post('Class');
			$Type = $this->input->post('Type');
			
			if($AdjTonnes != null){
				$Tonnes = $AdjTonnes;
			}
			else{
				$Tonnes = $Stock;
			}
			

			$Orefeed = array(
				'Date' => $Date,
				'Stockpile' => $Stockpile,
				'Shift'=>$Shift,
				'Remarks' => $Remarks,
				'Au' => $Au,
				'Ag' => $Ag,
				'AuEq75' =>$AuEq75,
				'Class' => $Class,
				'AdjAu' =>$AdjAu,
				'AdjAg' =>$AdjAg,
				'AdjAuPersen' =>$AdjAuPersen,
				'AdjAgPersen' =>$AdjAgPersen,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Volume' => $Volume,
				'Loader' => $Loader,
				'Material' => $Material,
				'Percentage' => $Percentage,
				'Tonnestocrush' => $Tonnestocrush,
				'Bucket' => $Bucket,
				'Type' => $Type,
				'Note' => $Note,
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);

				$this->OreFeed_model->InputOreFeed($Orefeed);
				$this->Oremined_model->UpdateTonnes($Stockpile,$Tonnes);

			$OrefeedTonnes = $Total;
			// $OpenTonnes = $this->input->post('DryTonBM');
			// $Tonnes = $OreminedTonnes + $OpenTonnes;
			$Au = $this->input->post('Au');
			// $Augt = $this->input->post('Augt');
			// $v_Au = (($Au*$OpenTonnes)+($Augt))/$Tonnes;
			$Ag = $this->input->post('Ag');
			// $AuEq75 = $this->input->post('AuEq75');
			// $Class =  $this->input->post('Class');
			$Density = $this->input->post('Density');
			
			

			$Temp = $this->ClosingStock_model->GetClosingStockByStockpile($Stockpile);
			foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes - $OrefeedTonnes;
				$Density = (($temp->Density*$temp->Tonnes)-($Density*$OrefeedTonnes))/$Tonnes;
				$v_Au = (($temp->Au*$temp->Tonnes)-($Au*$OrefeedTonnes))/$Tonnes;
				$v_Ag = (($temp->Ag*$temp->Tonnes)-($Ag*$OrefeedTonnes))/$Tonnes;
				$AuEq75 = $v_Au+($v_Ag/75);
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
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => $AuEq75,
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('stockpileOrefeed'),
				'Date' => $Date,
				'Status' => "Complete",
			);

			if($Temp){
				$this->ClosingStock_model->UpdateClosingStockByStockpile($Closing,$Stockpile);
				
			}
			else{
				$this->ClosingStock_model->InputClosingStock($Closing);

			}
			

			redirect('OreFeed/Input');
		}
		else {
			redirect(base_url());
		}
	}

}
?>
