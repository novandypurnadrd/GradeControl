
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table extends CI_Controller {

	public function Table(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
    	$this->load->model('Stockpile_model');
		$this->load->model('Pit_model');
		$this->load->model('Orefeed_model');
		$this->load->model('Closingstock_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "Ore Feed";
				$data['selectedstockpile'] = '';
	   			$data['selectedyear'] = '0000-00-00';
	   			 $data['date'] = '';
				$selectedstockpile = "";
				$selectedyear = '';
				$data['Table'] = $this->Stockpile_model->getToStockpile($selectedstockpile,$selectedyear);
				//$data['Table'] = $this->Stockpile_model->getToStockpile($data['selectedstockpile'],$data['selectedyear']);
				$data['Year'] = $this->Stockpile_model->getYear();
        		$data['Stockpile'] = $this->Stockpile_model->getStockpile();

        	$sumclay = round($this->Orefeed_model->SumClay($selectedyear,$selectedstockpile),2);
			if ($sumclay == null){
				$sumclay = 0;
			}
			$sumclayfull = round($this->Orefeed_model->SumClayfull($selectedyear,$selectedstockpile),2);
			if ($sumclayfull == null){
				$sumclayfull = 0;
			}
			$sumfresh = round($this->Orefeed_model->SumFresh($selectedyear,$selectedstockpile),2);
			if ($sumfresh == null){
				$sumfresh = 0;
			}
			$sumbypass = round($this->Orefeed_model->SumBypass($selectedyear,$selectedstockpile),2);
			if ($sumbypass == null){
				$sumbypass = 0;
			}
			$sumtransisi = round($this->Orefeed_model->SumTransisi($selectedyear,$selectedstockpile),2);
			if ($sumtransisi == null){
				$sumtransisi = 0;
			}
			$sumtonnes = round($this->Orefeed_model->SumTonnestocrush($selectedyear,$selectedstockpile),2);
			if ($sumtonnes == null){
				$sumtonnes = 1;
			}
			// $data['clay'] = round($sumclay/$sumtonnes,2)*100;
			// $data['fresh'] = round($sumfresh/$sumtonnes,2)*100;
			// $data['transisi'] = round($sumtransisi/$sumtonnes,2)*100;
			$data['clay'] = $sumclay+$sumclayfull;
			$data['fresh'] = $sumfresh+$sumbypass;
			$data['transisi'] = $sumtransisi;
		    $this->load->view('OreFeed/Table', $data);
    }else {
      redirect(base_url());
    }
	}

  public function Filter(){
		if ($this->session->userdata('GradeControl')) {
			$data['main'] = "Ore Feed";
			$selectedstockpile = $this->input->post('Stockpile');
			$data['date'] = $this->input->post('Date');
			$date = explode('/',$data['date'])[2].'-'.explode('/',$data['date'])[0].'-'.explode('/',$data['date'])[1];
			$selectedyear = $date;
			$data['selectedstockpile'] = $this->input->post('Stockpile');
	   		$data['selectedyear'] = $date;
			$data['Table'] = $this->Orefeed_model->GetTableOreFeed($selectedstockpile,$selectedyear);
			$data['Year'] = $this->Stockpile_model->getYear();
			$data['Stockpile'] = $this->Stockpile_model->getStockpile();
			$sumclay = round($this->Orefeed_model->SumClay($selectedyear,$selectedstockpile),2);
			if ($sumclay == null){
				$sumclay = 0;
			}
			$sumclayfull = round($this->Orefeed_model->SumClayfull($selectedyear,$selectedstockpile),2);
			if ($sumclayfull == null){
				$sumclayfull = 0;
			}
			$sumfresh = round($this->Orefeed_model->SumFresh($selectedyear,$selectedstockpile),2);
			if ($sumfresh == null){
				$sumfresh = 0;
			}
			$sumbypass = round($this->Orefeed_model->SumBypass($selectedyear,$selectedstockpile),2);
			if ($sumbypass == null){
				$sumbypass = 0;
			}
			$sumtransisi = round($this->Orefeed_model->SumTransisi($selectedyear,$selectedstockpile),2);
			if ($sumtransisi == null){
				$sumtransisi = 0;
			}
			$sumtonnes = round($this->Orefeed_model->SumTonnestocrush($selectedyear,$selectedstockpile),2);
			if ($sumtonnes == null){
				$sumtonnes = 1;
			}
			// $data['clay'] = round($sumclay/$sumtonnes,2)*100;
			// $data['fresh'] = round($sumfresh/$sumtonnes,2)*100;
			// $data['transisi'] = round($sumtransisi/$sumtonnes,2)*100;
			$data['clay'] = $sumclay+$sumclayfull;
			$data['fresh'] = $sumfresh+$sumbypass;
			$data['transisi'] = $sumtransisi;
			$this->load->view('OreFeed/Table', $data);
		}else {
			redirect(base_url());
		}
	}

	public function DeleteOreFeed($id)
	{
		if ($this->session->userdata('GradeControl')) {

			// $TonnesClosingstock = 0;
			// $Tonnes = 0;
			// $AuClosingstock = 0;
			// $DensityClosingstock = 0;
			// $IdClosingstock = 0;


			$Orefeed = $this->Orefeed_model->GetOreFeedByID($id);
			foreach ($Orefeed as $orefeed) {
				$Tonnestocrush = $orefeed->Tonnestocrush;
				$Volumefeed = $orefeed->Volume;
				$Date = $orefeed->Date;
				$Stockpile = $orefeed->Stockpile;
				$AuFeed = $orefeed->Au;
				$AgFeed = $orefeed->Ag;
				$DensityFeed = $orefeed->Density;
				}



				$Closingstock = $this->Closingstock_model->GetClosingStockTonnesStockpileNew($Stockpile);
				foreach ($Closingstock as $key) {
					$IdClosingstock = $key->id;
					$TonnesClosingstock = $key->Tonnes;
					$VolumeClosingstock = $key->Volume;
					$AuClosingstock = $key->Au;
					$AgClosingstock = $key->Ag;
					$DensityClosingstock = $key->Density;
					$Tonnes = $key->Tonnes;
				}

			


				$UpdateTonnes = $TonnesClosingstock+$Tonnestocrush;
				$UpdateAu = round(((($AuFeed*$Tonnestocrush)+($AuClosingstock*$Tonnes))/$UpdateTonnes),2);
				$UpdateAg = round(((($AgFeed*$Tonnestocrush)+($AgClosingstock*$Tonnes))/$UpdateTonnes),2);
				$UpdateAuEq75 = round((($UpdateAu)+($UpdateAg/75)),2);
				$UpdateDensity = round(((($DensityClosingstock*$TonnesClosingstock)+($DensityFeed*$Tonnestocrush))/$UpdateTonnes),2);
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
			
			$ClosingstockUpdate = array(
				'Tonnes'=>$UpdateTonnes,
				'Volume'=>$UpdateVolume,
				'Density'=>$UpdateDensity,
				'Au'=>$UpdateAu,
				'Ag'=>$UpdateAg,
				'AuEq75'=>$UpdateAuEq75,
				'Class'=>$Class,
				);

			

			$this->Closingstock_model->UpdateClosingStock($ClosingstockUpdate,$IdClosingstock);

		

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
			
			$UpdateTonnesStockpile = $TonnesStockpile+$Tonnestocrush;
			$UpdateAuStockpile = round(((($AuFeed*$Tonnestocrush)+($AuStockpile*$TonnesStockpile))/$UpdateTonnesStockpile),2);
			$UpdateAgStockpile = round(((($AgFeed*$Tonnestocrush)+($AgStockpile*$TonnesStockpile))/$UpdateTonnesStockpile),2);
			$UpdateDensityStockpile = round(((($DensityFeed*$Tonnestocrush)+($DensityStockpile*$TonnesStockpile))/$UpdateTonnesStockpile),2);
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


			$this->Orefeed_model->DeleteOreFeed($id);
			redirect('OreFeed/Table');
		}
		else {
			redirect(base_url());
		}
	}

	public function Update($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->session->set_userdata('update', $id);
			redirect('OreFeed/Update');
		}
		else {
			redirect(base_url());
		}
	}

}
?>
