
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scat extends CI_Controller {

	public function Scat(){
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
				$data['main'] = "Scat";
			
		
				$data['dateStart'] = '';
				$data['dateEnd'] = '';
			
				$data['date'] = '';
				$selectedstockpile = "";
				$selectedyear = '0000-00-00';
				$data['Table'] = $this->ClosingStock_model->GetScatbyDate($data['dateStart'],$data['dateEnd']);
        		
		    $this->load->view('ClosingStock/Scat', $data);
    }else {
      redirect(base_url());
    }
	}

	public function InputScat()
	{
    	if ($this->session->userdata('GradeControl')) {
    		$Date =  $this->input->post('Date');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];
    		$Volume = $this->input->post("Volume");
    		$Density = $this->input->post("Density");
    		$Tonnes = round(($Volume*$Density),2);
    		$Au = $this->input->post("Augt");
    		$Ag = $this->input->post("Aggt");
    		$AuEq75 = round($Au+($Ag/75),2);
    		$DryTon = $Tonnes;

    		$Scat = array(
    			'Date' => $Date,
    			'Stockpile' => "Scat",
    			'Tonnes' => $Tonnes,
    			'Volume' => $Volume,
    			'Density' => $Density,
    			'Au' => $Au,
    			'Ag' => $Ag,
    			'AuEq75' => $AuEq75,
    			'usrid' => $this->session->userdata('usernameGradeControl'),
    			);

    		$this->ClosingStock_model->InputScat($Scat);


    		$v_Au = $Au;
			$v_Ag = $Ag;
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
			$name = "Scat";
			$Stockpile = $this->ClosingStock_model->GetStockpilebyName($name);
			$Stockpilescat ="";

			foreach ($Stockpile as $stockpile) {
				$Stockpilescat = $stockpile->id;
			}

			//Insert Closing Stock
			$Volume = $this->input->post("Volume");
    		$Density = $this->input->post("Density");
			$Au = $this->input->post("Augt");
    		$Ag = $this->input->post("Aggt");
    		$Temp = $this->ClosingStock_model->GetClosingStockTonnesStockpile($Stockpilescat);
			foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $DryTon;
				$Density = (($temp->Density*$temp->Tonnes)+($Density*$DryTon))/$Tonnes;
				$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$DryTon))/$Tonnes;
				$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$DryTon))/$Tonnes;
				$AuEq75 = round($v_Au+($v_Ag/75),2);

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
				'Volume' => round($Volume,2),
				'Au' => round($v_Au,2),
				'Ag' => round($v_Ag,2),
				'AuEq75' => round($AuEq75,2),
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => round($Density,2),
				'Stockpile' => $Stockpilescat,
				'Date' => $Date,
				'Status' => "Pending",
			);

	

			if($Temp){
				$this->ClosingStock_model->UpdateClosingStockByStockpile($Closing,$Stockpilescat);
				
			}
			else{
				$this->ClosingStock_model->InputClosingStock($Closing);

			}


			//Check for Closing Stock Grade
			$Volume = $this->input->post("Volume");
    		$Density = $this->input->post("Density");
			$Au = $this->input->post("Augt");
    		$Ag = $this->input->post("Aggt");
			$Temp = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($Stockpilescat,$Date);
			foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $DryTon;
				
				$Density = (($temp->Density*$temp->Tonnes)+($Density*$DryTon))/$Tonnes;
				$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$DryTon))/$Tonnes;
				$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$DryTon))/$Tonnes;
				$AuEq75 = round($v_Au+($v_Ag/75),2);
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
				
				$Volume = $Tonnes / round($Density,2);
				
			}


			$Closing = array(
				'Volume' => round($Volume,2),
				'Au' => round($v_Au,2),
				'Ag' => round($v_Ag,2),
				'AuEq75' => round($AuEq75,2),
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => round($Density,2),
				'Stockpile' => $Stockpilescat,
				'Date' => $Date,
				//'Status' => "Pending",
			);

			if($Temp){
				$this->ClosingStock_model->UpdateClosingStockByDateGrade($Closing,$Stockpilescat,$Date);
				
			}
			else{
				$this->ClosingStock_model->InputClosingStockGrade($Closing);

			}

			//Input To Stockpile
			$Volume = $this->input->post("Volume");
    		$Density = $this->input->post("Density");
			$Au = $this->input->post("Augt");
    		$Ag = $this->input->post("Aggt");
				$Temp = $this->Stockpile_model->GetToStockpileCalcStockpile($Stockpilescat);
				foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $DryTon;
				$Density = (($temp->Density*$temp->Tonnes)+($Density*$DryTon))/$Tonnes;
				$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$DryTon))/$Tonnes;
				$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$DryTon))/$Tonnes;
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
				'RL' => "",
				'Au' => round($v_Au,2),
				'Ag' => round($v_Ag,2),
				'AuEq75' => round($AuEq75,2),
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => round($Density,2),
				'Stockpile' => $Stockpilescat,
				'Date' => $Date,
			);

			if ($checker == 0) {
				$this->Stockpile_model->InputToStockpile($ToStockpile);
			}
			else {
				$this->Stockpile_model->UpdateToStockpilebyStockpile($ToStockpile, $Stockpilescat);
			}


    		redirect('ClosingStock/Scat');
		}
		else {
			redirect(base_url());
		}

	}

	public function DeleteScat($id)
	{
		if ($this->session->userdata('GradeControl')) {

			$StockpileScat = "";
			$ScatClosingstock = $this->ClosingStock_model->getScatbyId($id);
			foreach ($ScatClosingstock as $scat) {
				$ScatTonnes = $scat->Tonnes;
				$ScatVolume = $scat->Volume;
				$ScatDensity = $scat->Density;
				$ScatAu = $scat->Au;
				$ScatAg = $scat->Ag;
				$Date = $scat->Date;
				$StockpileScat = $scat->Stockpile;
			}
			

			$StockpileId = $this->Stockpile_model->getScatId($StockpileScat);
			$Stockpile = "";
			foreach ($StockpileId as $key) {
				$Stockpile = $key->id;
			}

			
			//Update Closing Stock
			$Closingstock = $this->ClosingStock_model->GetClosingStockTonnesStockpileNew($Stockpile);
			foreach ($Closingstock as $key) {
					$IdClosingstock = $key->id;
					$TonnesClosingstock = $key->Tonnes;
					$VolumeClosingstock = $key->Volume;
					$AuClosingstock = $key->Au;
					$AgClosingstock = $key->Ag;
					$DensityClosingstock = $key->Density;
					$Tonnes = $key->Tonnes;
				}

				$UpdateTonnes = $TonnesClosingstock-$ScatTonnes;

				if($UpdateTonnes > 0){
						$UpdateAu = round(((($AuClosingstock*$Tonnes)-($ScatAu*$ScatTonnes))/$UpdateTonnes),2);
						$UpdateAg = round(((($AgClosingstock*$Tonnes)-($ScatAg*$ScatTonnes))/$UpdateTonnes),2);
						$UpdateAuEq75 = round((($UpdateAu)+($UpdateAg/75)),2);
						$UpdateDensity = round(((($DensityClosingstock*$TonnesClosingstock)-($ScatDensity*$ScatTonnes))/$UpdateTonnes),2);
						$UpdateVolume = round(($UpdateTonnes/$UpdateDensity),2);

						if (0.65 <= $UpdateAuEq75 && $UpdateAuEq75 < 2.00){
							$Class="Marginal";
						}
						elseif(2<=$UpdateAuEq75 && $UpdateAuEq75<4.00){
							$Class="Medium Grade";
						}
						elseif(4<=$UpdateAuEq75 && $UpdateAuEq75<6.00){
							$Class="High Grade";
						}
						else{
							$Class="SHG";
						}
				}
				else{
						$UpdateTonnes = 0;
						$UpdateAu = 0;
						$UpdateAg = 0;
						$UpdateAuEq75 = 0;
						$UpdateDensity = 0;
						$UpdateVolume = 0;
						$Class = "-";
				}
			
			
			$ClosingstockUpdate = array(
				'Tonnes'=>$UpdateTonnes,
				'Volume'=>$UpdateVolume,
				'Density'=>$UpdateDensity,
				'Au'=>$UpdateAu,
				'Ag'=>$UpdateAg,
				'AuEq75'=>$UpdateAuEq75,
				'Class'=>$Class,
				);


			$this->ClosingStock_model->UpdateClosingStock($ClosingstockUpdate,$IdClosingstock);


			//Update Closng Stock Grade
				$Closingstock = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($Stockpile,$Date);
				foreach ($Closingstock as $key) {
					$IdClosingstock = $key->id;
					$TonnesClosingstock = $key->Tonnes;
					$VolumeClosingstock = $key->Volume;
					$AuClosingstock = $key->Au;
					$AgClosingstock = $key->Ag;
					$DensityClosingstock = $key->Density;
					$Tonnes = $key->Tonnes;


				$UpdateTonnes = $TonnesClosingstock-$ScatTonnes;

				if($UpdateTonnes > 0){
					$UpdateAu = round(((($AuClosingstock*$Tonnes)-($ScatAu*$ScatTonnes))/$UpdateTonnes),2);
					$UpdateAg = round(((($AgClosingstock*$Tonnes)-($ScatAg*$ScatTonnes))/$UpdateTonnes),2);
					$UpdateAuEq75 = round((($UpdateAu)+($UpdateAg/75)),2);
					$UpdateDensity = round(((($DensityClosingstock*$TonnesClosingstock)-($ScatDensity*$ScatTonnes))/$UpdateTonnes),2);
					$UpdateVolume = round(($UpdateTonnes/$UpdateDensity),2);

					if (0.65 <= $UpdateAuEq75 && $UpdateAuEq75 < 2.00){
						$Class="Marginal";
					}
					elseif(2<=$UpdateAuEq75 && $UpdateAuEq75<4.00){
						$Class="Medium Grade";
					}
					elseif(4<=$UpdateAuEq75 && $UpdateAuEq75<6.00){
						$Class="High Grade";
					}
					else{
						$Class="SHG";
					}
				}
				else{
					$UpdateTonnes = 0;
					$UpdateAu = 0;
					$UpdateAg = 0;
					$UpdateAuEq75 = 0;
					$UpdateDensity = 0;
					$UpdateVolume = 0;
					$Class = "-";
				}
				
			
			$ClosingstockUpdate = array(
				'Tonnes'=>$UpdateTonnes,
				'Volume'=>$UpdateVolume,
				'Density'=>$UpdateDensity,
				'Au'=>$UpdateAu,
				'Ag'=>$UpdateAg,
				'AuEq75'=>$UpdateAuEq75,
				'Class'=>$Class,
				);

			

			$this->ClosingStock_model->UpdateClosingStockGrade($ClosingstockUpdate,$IdClosingstock);
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
				$StockpileMined	= $stockpile->Stockpile;
				$IdStockpile = $stockpile->id;
			}
			
			$UpdateTonnesStockpile = $TonnesStockpile-$ScatTonnes;


			if($UpdateTonnesStockpile > 0){
				$UpdateAuStockpile = round(((($AuStockpile*$TonnesStockpile)-($ScatAu*$ScatTonnes))/$UpdateTonnesStockpile),2);
				$UpdateAgStockpile = round(((($AgStockpile*$TonnesStockpile)-($ScatAg*$ScatTonnes))/$UpdateTonnesStockpile),2);
				$UpdateDensityStockpile = round(((($DensityStockpile*$TonnesStockpile)-($ScatDensity*$ScatTonnes))/$UpdateTonnesStockpile),2);
				$UpdateAuEq75Stockpile = round((($UpdateAuStockpile)+($UpdateAgStockpile/75)),2);
				$UpdateStockpileVolume = round(($UpdateTonnesStockpile/$UpdateDensityStockpile),2);
				$UpdateStockpileRL = $RLStockpile;
				$UpdateStockpileStockpile = $StockpileMined;

				if (0.65 <= $UpdateAuEq75Stockpile && $UpdateAuEq75Stockpile < 2.00){
						$ClassStockpile="Marginal";
					}
					elseif(2<=$UpdateAuEq75Stockpile && $UpdateAuEq75Stockpile<4.00){
						$ClassStockpile="Medium Grade";
					}
					elseif(4<=$UpdateAuEq75Stockpile && $UpdateAuEq75Stockpile<6.00){
						$ClassStockpile="High Grade";
					}
					else{
						$ClassStockpile="SHG";
					}
			}
			else{
					$UpdateTonnesStockpile = 0;
					$UpdateAuStockpile = 0;
					$UpdateAgStockpile = 0;
					$UpdateDensityStockpile = 0;
					$UpdateAuEq75Stockpile = 0;
					$UpdateStockpileVolume = 0;
					$UpdateStockpileRL = "-";
					$ClassStockpile ="-";
					$UpdateStockpileStockpile = $StockpileMined;
			}
			



			$ToStockpile = array(
				'Volume' => $UpdateStockpileVolume,
				'RL' => $UpdateStockpileRL,
				'Au' => $UpdateAuStockpile,
				'Ag' => $UpdateAgStockpile,
				'AuEq75' => $UpdateAuEq75Stockpile,
				'Class' =>$ClassStockpile,
				'Tonnes' => $UpdateTonnesStockpile,
				'Density' => $UpdateDensityStockpile,
				'Stockpile' => $UpdateStockpileStockpile,
				'Date' => $Date,
			);

	
			$this->Stockpile_model->UpdateToStockpilebyStockpile($ToStockpile,$UpdateStockpileStockpile);



			$this->ClosingStock_model->DeleteScat($id);
			redirect('ClosingStock/Scat');
		}
		else {
			redirect(base_url());
		}
	}


	public function index_update($id){
		if ($this->session->userdata('GradeControl')) {
			$data['main'] = "Scat";
			$data['View'] = $this->ClosingStock_model->getScatbyId($id);
			$this->load->view('ClosingStock/Scat_Update', $data);
		}
		else {
			redirect(base_url());
		}
	}

	public function UpdateScat($id)
	{
		if ($this->session->userdata('GradeControl')) {


			$Scat = $this->ClosingStock_model->getScatbyId($id);

			foreach ($Scat as $scat) {
				
				$ScatTonnes = $scat->Tonnes;
				$ScatStockpile = $scat->Stockpile;
				$ScatDate = $scat->Date;
				$ScatAu = $scat->Au;
				$ScatAg = $scat->Ag;
				$ScatDensity = $scat->Density;
				$ScatVolume = $scat->Volume;
			}

			$StockpileId = $this->Stockpile_model->getScatId($ScatStockpile);
			$Stockpile = "";
			foreach ($StockpileId as $key) {
				$Stockpile = $key->id;
			}

		//Update Closing Stock
			$Closingstock = $this->ClosingStock_model->GetClosingStockTonnesStockpileNew($Stockpile);
			foreach ($Closingstock as $key) {
					$IdClosingstock = $key->id;
					$TonnesClosingstock = $key->Tonnes;
					$VolumeClosingstock = $key->Volume;
					$AuClosingstock = $key->Au;
					$AgClosingstock = $key->Ag;
					$DensityClosingstock = $key->Density;
					$Tonnes = $key->Tonnes;
				}

				$UpdateTonnes = $TonnesClosingstock-$ScatTonnes;

				if($UpdateTonnes > 0){
						$UpdateAu = round(((($AuClosingstock*$Tonnes)-($ScatAu*$ScatTonnes))/$UpdateTonnes),2);
						$UpdateAg = round(((($AgClosingstock*$Tonnes)-($ScatAg*$ScatTonnes))/$UpdateTonnes),2);
						$UpdateAuEq75 = round((($UpdateAu)+($UpdateAg/75)),2);
						$UpdateDensity = round(((($DensityClosingstock*$TonnesClosingstock)-($ScatDensity*$ScatTonnes))/$UpdateTonnes),2);
						$UpdateVolume = round(($UpdateTonnes/$UpdateDensity),2);

						if (0.65 <= $UpdateAuEq75 && $UpdateAuEq75 < 2.00){
							$Class="Marginal";
						}
						elseif(2<=$UpdateAuEq75 && $UpdateAuEq75<4.00){
							$Class="Medium Grade";
						}
						elseif(4<=$UpdateAuEq75 && $UpdateAuEq75<6.00){
							$Class="High Grade";
						}
						else{
							$Class="SHG";
						}
				}
				else{
						$UpdateTonnes = 0;
						$UpdateAu = 0;
						$UpdateAg = 0;
						$UpdateAuEq75 = 0;
						$UpdateDensity = 0;
						$UpdateVolume = 0;
						$Class = "-";
				}
			
			
			$ClosingstockUpdate = array(
				'Tonnes'=>$UpdateTonnes,
				'Volume'=>$UpdateVolume,
				'Density'=>$UpdateDensity,
				'Au'=>$UpdateAu,
				'Ag'=>$UpdateAg,
				'AuEq75'=>$UpdateAuEq75,
				'Class'=>$Class,
				);


			$this->ClosingStock_model->UpdateClosingStock($ClosingstockUpdate,$IdClosingstock);

			//Insert Closing Stock
			$Date =  $this->input->post('Date');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];
			$Volume = $this->input->post("Volume");
    		$Density = $this->input->post("Density");
			$Au = $this->input->post("Augt");
    		$Ag = $this->input->post("Aggt");
    		$Tonnes = round(($Volume*$Density),2);
    		$DryTon = $Tonnes;

    		$Temp = $this->ClosingStock_model->GetClosingStockTonnesStockpile($Stockpile);
			foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $DryTon;
				$Density = (($temp->Density*$temp->Tonnes)+($Density*$DryTon))/$Tonnes;
				$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$DryTon))/$Tonnes;
				$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$DryTon))/$Tonnes;
				$AuEq75 = round($v_Au+($v_Ag/75),2);

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
				'Volume' => round($Volume,2),
				'Au' => round($v_Au,2),
				'Ag' => round($v_Ag,2),
				'AuEq75' => round($AuEq75,2),
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => round($Density,2),
				'Stockpile' => $Stockpile,
			
				'Status' => "Pending",
			);

				$this->ClosingStock_model->UpdateClosingStockByStockpile($Closing,$Stockpile);
				
			//Update Closng Stock Grade
				$Closingstock = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($Stockpile,$Date);
				foreach ($Closingstock as $key) {
					$IdClosingstock = $key->id;
					$TonnesClosingstock = $key->Tonnes;
					$VolumeClosingstock = $key->Volume;
					$AuClosingstock = $key->Au;
					$AgClosingstock = $key->Ag;
					$DensityClosingstock = $key->Density;
					$Tonnes = $key->Tonnes;


				$UpdateTonnes = $TonnesClosingstock-$ScatTonnes;

				if($UpdateTonnes > 0){
					$UpdateAu = round(((($AuClosingstock*$Tonnes)-($ScatAu*$ScatTonnes))/$UpdateTonnes),2);
					$UpdateAg = round(((($AgClosingstock*$Tonnes)-($ScatAg*$ScatTonnes))/$UpdateTonnes),2);
					$UpdateAuEq75 = round((($UpdateAu)+($UpdateAg/75)),2);
					$UpdateDensity = round(((($DensityClosingstock*$TonnesClosingstock)-($ScatDensity*$ScatTonnes))/$UpdateTonnes),2);
					$UpdateVolume = round(($UpdateTonnes/$UpdateDensity),2);

					if (0.65 <= $UpdateAuEq75 && $UpdateAuEq75 < 2.00){
						$Class="Marginal";
					}
					elseif(2<=$UpdateAuEq75 && $UpdateAuEq75<4.00){
						$Class="Medium Grade";
					}
					elseif(4<=$UpdateAuEq75 && $UpdateAuEq75<6.00){
						$Class="High Grade";
					}
					else{
						$Class="SHG";
					}
				}
				else{
					$UpdateTonnes = 0;
					$UpdateAu = 0;
					$UpdateAg = 0;
					$UpdateAuEq75 = 0;
					$UpdateDensity = 0;
					$UpdateVolume = 0;
					$Class = "-";
				}
				
			
			$ClosingstockUpdate = array(
				'Tonnes'=>$UpdateTonnes,
				'Volume'=>$UpdateVolume,
				'Density'=>$UpdateDensity,
				'Au'=>$UpdateAu,
				'Ag'=>$UpdateAg,
				'AuEq75'=>$UpdateAuEq75,
				'Class'=>$Class,
				);

			

			$this->ClosingStock_model->UpdateClosingStockGrade($ClosingstockUpdate,$IdClosingstock);
				}

			//Check for Closing Stock Grade
			$Volume = $this->input->post("Volume");
    		$Density = $this->input->post("Density");
			$Au = $this->input->post("Augt");
    		$Ag = $this->input->post("Aggt");
    		$Tonnes = round(($Volume*$Density),2);
    		$DryTon = $Tonnes;

			$Temp = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($Stockpile,$Date);
			foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $DryTon;

				$Density = (($temp->Density*$temp->Tonnes)+($Density*$DryTon))/$Tonnes;
				$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$DryTon))/$Tonnes;
				$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$DryTon))/$Tonnes;
				$AuEq75 = round($v_Au+($v_Ag/75),2);
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
				
				$Volume = $Tonnes / round($Density,2);
				$IdClosingstock = $temp->id;


				$Closing = array(
				'Volume' => round($Volume,2),
				'Au' => round($v_Au,2),
				'Ag' => round($v_Ag,2),
				'AuEq75' => round($AuEq75,2),
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => round($Density,2),
				'Stockpile' => $Stockpile,
				
				//'Status' => "Pending",
			);

				$this->ClosingStock_model->UpdateClosingStockGrade($Closing,$IdClosingstock);
				
			}


			//Update To Stockpile

			$StockpileA = $this->Stockpile_model->GetStockpileByStockpile($Stockpile);
			foreach ($StockpileA as $stockpile) {
				$AuStockpile = $stockpile->Au;
				$AgStockpile = $stockpile->Ag;
				$TonnesStockpile = $stockpile->Tonnes;
				$DensityStockpile = $stockpile->Density;
				$VolumeStockpile = $stockpile->Volume;
				$RLStockpile = $stockpile->RL;
				$StockpileMined	= $stockpile->Stockpile;
				$IdStockpile = $stockpile->id;
			}
			
			$UpdateTonnesStockpile = $TonnesStockpile-$ScatTonnes;


			if($UpdateTonnesStockpile > 0){
				$UpdateAuStockpile = round(((($AuStockpile*$TonnesStockpile)-($ScatAu*$ScatTonnes))/$UpdateTonnesStockpile),2);
				$UpdateAgStockpile = round(((($AgStockpile*$TonnesStockpile)-($ScatAg*$ScatTonnes))/$UpdateTonnesStockpile),2);
				$UpdateDensityStockpile = round(((($DensityStockpile*$TonnesStockpile)-($ScatDensity*$ScatTonnes))/$UpdateTonnesStockpile),2);
				$UpdateAuEq75Stockpile = round((($UpdateAuStockpile)+($UpdateAgStockpile/75)),2);
				$UpdateStockpileVolume = round(($UpdateTonnesStockpile/$UpdateDensityStockpile),2);
				$UpdateStockpileRL = $RLStockpile;
				$UpdateStockpileStockpile = $StockpileMined;

				if (0.65 <= $UpdateAuEq75Stockpile && $UpdateAuEq75Stockpile < 2.00){
						$ClassStockpile="Marginal";
					}
					elseif(2<=$UpdateAuEq75Stockpile && $UpdateAuEq75Stockpile<4.00){
						$ClassStockpile="Medium Grade";
					}
					elseif(4<=$UpdateAuEq75Stockpile && $UpdateAuEq75Stockpile<6.00){
						$ClassStockpile="High Grade";
					}
					else{
						$ClassStockpile="SHG";
					}
			}
			else{
					$UpdateTonnesStockpile = 0;
					$UpdateAuStockpile = 0;
					$UpdateAgStockpile = 0;
					$UpdateDensityStockpile = 0;
					$UpdateAuEq75Stockpile = 0;
					$UpdateStockpileVolume = 0;
					$UpdateStockpileRL = "-";
					$ClassStockpile ="-";
					$UpdateStockpileStockpile = $StockpileMined;
			}
			



			$ToStockpile = array(
				'Volume' => $UpdateStockpileVolume,
				'RL' => $UpdateStockpileRL,
				'Au' => $UpdateAuStockpile,
				'Ag' => $UpdateAgStockpile,
				'AuEq75' => $UpdateAuEq75Stockpile,
				'Class' =>$ClassStockpile,
				'Tonnes' => $UpdateTonnesStockpile,
				'Density' => $UpdateDensityStockpile,
				'Stockpile' => $UpdateStockpileStockpile,
		
			);

	
			$this->Stockpile_model->UpdateToStockpilebyStockpile($ToStockpile,$UpdateStockpileStockpile);
				
		
			//Input To Stockpile
			$Volume = $this->input->post("Volume");
    		$Density = $this->input->post("Density");
			$Au = $this->input->post("Augt");
    		$Ag = $this->input->post("Aggt");
    		$Tonnes = round(($Volume*$Density),2);
    		$DryTon = $Tonnes;
				$Temp = $this->Stockpile_model->GetToStockpileCalcStockpile($Stockpile);
				foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $DryTon;
				$Density = (($temp->Density*$temp->Tonnes)+($Density*$DryTon))/$Tonnes;
				$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$DryTon))/$Tonnes;
				$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$DryTon))/$Tonnes;
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
				'RL' => "",
				'Au' => round($v_Au,2),
				'Ag' => round($v_Ag,2),
				'AuEq75' => round($AuEq75,2),
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => round($Density,2),
				'Stockpile' => $Stockpile,
				
			);

				
				$this->Stockpile_model->UpdateToStockpilebyStockpile($ToStockpile, $Stockpile);
		

		
		

			//update tabel scat
			$Date =  $this->input->post('Date');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];
    		$Volume = $this->input->post("Volume");
    		$Density = $this->input->post("Density");
    		$Tonnes = round(($Volume*$Density),2);
    		$Au = $this->input->post("Augt");
    		$Ag = $this->input->post("Aggt");
    		$AuEq75 = round($Au+($Ag/75),2);
    		$DryTon = $Tonnes;

    		$Scat = array(
    			'Date' => $Date,
    			'Stockpile' => "Scat",
    			'Tonnes' => $Tonnes,
    			'Volume' => $Volume,
    			'Density' => $Density,
    			'Au' => $Au,
    			'Ag' => $Ag,
    			'AuEq75' => $AuEq75,
    			'usrid' => $this->session->userdata('usernameGradeControl'),
    			);
			
    			
				$this->ClosingStock_model->UpdateScat($Scat,$id);



			redirect('ClosingStock/Scat');
		}else {
			redirect(base_url());
		}
	}


	public function Filter(){
		if ($this->session->userdata('GradeControl')) {
	  $data['main'] = "Scat";
      $data['dateStart'] = $this->input->post('start');
      $data['dateEnd'] = $this->input->post('end');
      $data['date'] = '';

      $dateStart = explode('/',$data['dateStart'])[2].'-'.explode('/',$data['dateStart'])[0].'-'.explode('/',$data['dateStart'])[1];
      $dateEnd = explode('/',$data['dateEnd'])[2].'-'.explode('/',$data['dateEnd'])[0].'-'.explode('/',$data['dateEnd'])[1];
    
      $data['Table'] = $this->ClosingStock_model->GetScatbyDate($dateStart,$dateEnd);

      
      
      
			$this->load->view('ClosingStock/Scat', $data);
		}else {
			redirect(base_url());
		}
	}


}
?>
