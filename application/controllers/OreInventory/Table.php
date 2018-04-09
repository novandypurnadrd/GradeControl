
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
				else{
					$Class="SHG";
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
				'Date' => $date,
			);

			$this->Closingstock_model->UpdateClosingStockByDateGrade($Closing,$StockpileClosingstock,$date);


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


	public function DeleteVisual($id)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->OreInventory_model->DeleteVisual($id);
			redirect('OreInventory/Table/IndexTableGeneralVisual');
		}
		else {
			redirect(base_url());
		}
	}

}
?>
