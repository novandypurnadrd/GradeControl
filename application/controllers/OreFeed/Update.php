
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
    	$this->load->model('ClosingStock_model');
		$this->load->model('Pit_model');
		$this->load->model('OreFeed_model');
		$this->load->model('Loader_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "OreFeed";
				$data['id'] = $this->session->userdata('update');
				$data['Pit'] = $this->Pit_model->getPit();
				$data['Oreline'] = $this->Oreline_model->getOreline();
        		$data['Stockpile'] = $this->Stockpile_model->getStockpile();

        		$data['ToStockpile'] = $this->Stockpile_model->ViewToStockpile();
        		$data['Loader'] = $this->Loader_model->GetLoader();
        		$data['Material'] = $this->Loader_model->GetMaterial();
        		$data['Percentage'] = $this->Loader_model->GetPercentage();
				$data['Table'] = $this->OreFeed_model->GetOreFeedByIDNew($data['id']);
				$this->session->userdata('update', "");
		    $this->load->view('OreFeed/Update', $data);
    }else {
      redirect(base_url());
    }
	}

	public function UpdateOreFeed($id)
	{
		if ($this->session->userdata('GradeControl')) {

			$Orefeed = $this->OreFeed_model->GetOreFeedByIDNew($id);

			foreach ($Orefeed as $orefeedvalue) {
				
				$Tonnestocrushorefeed = $orefeedvalue->Tonnestocrush;
				$Stockpileorefeed = $orefeedvalue->Stockpile;
				$Dateorefeed = $orefeedvalue->Date;
			}

			

			//update tabel closingstock
			$Closingstock = $this->ClosingStock_model->GetClosingStockByStockpile($Stockpileorefeed);
			if($Closingstock){

				foreach ($Closingstock as $closingstockvalue) {
					
					$TonnesUpdate = $closingstockvalue->Tonnes + $Tonnestocrushorefeed;
					$DensityUpdate = $closingstockvalue->Density;
					$VolumeUpdate = $TonnesUpdate / $DensityUpdate;
				

				}

			
				$this->ClosingStock_model->UpdateValueClosingstock($TonnesUpdate,$VolumeUpdate,$Stockpileorefeed);


				$Closingstock = $this->ClosingStock_model->GetClosingStockByStockpile($Stockpileorefeed);
				foreach ($Closingstock as $closingstockvalue) {
			
					$TonnesUpdate = $closingstockvalue->Tonnes - (float) $this->input->post('Total');
					$DensityUpdate = $closingstockvalue->Density;
					$VolumeUpdate = $TonnesUpdate / $DensityUpdate;

				}
		

				if($TonnesUpdate <= 0){

					$TonnesUpdate = 0;
					$AuUpdate = 0;
					$AgUpdate = 0;
					$AuEq75Update = 0;
					$ClassUpdate = "-";
					$DensityUpdate = 0;
					$VolumeUpdate = 0;
					$this->ClosingStock_model->UpdateValueClosingstockNull($TonnesUpdate,$VolumeUpdate,$Stockpileorefeed,$AuUpdate,$AgUpdate,$AuEq75Update,$ClassUpdate,$DensityUpdate);

				}
				else{

					$this->ClosingStock_model->UpdateValueClosingstock($TonnesUpdate,$VolumeUpdate,$Stockpileorefeed);
				}

				

			}


			//update table tostockpile
			$ToStockpile = $this->Stockpile_model->GetStockpileByStockpile($Stockpileorefeed);
			if($ToStockpile){
				foreach ($ToStockpile as $tostockpile) {
					$TonnesUpdate = $tostockpile->Tonnes + $Tonnestocrushorefeed;
					$DensityUpdate = $tostockpile->Density;
					$VolumeUpdate = $TonnesUpdate / $DensityUpdate;
				}

				$this->Stockpile_model->UpdateValueToStockpile($TonnesUpdate,$VolumeUpdate,$Stockpileorefeed);



				$ToStockpile = $this->Stockpile_model->GetStockpileByStockpile($Stockpileorefeed);
				foreach ($ToStockpile as $tostockpile) {
					$TonnesUpdate = $tostockpile->Tonnes - (float) $this->input->post('Total');
					$DensityUpdate = $tostockpile->Density;
					$VolumeUpdate = $TonnesUpdate / $DensityUpdate;
				}


				if($TonnesUpdate <= 0){

					$TonnesUpdate = 0;
					$AuUpdate = 0;
					$AgUpdate = 0;
					$AuEq75Update = 0;
					$ClassUpdate = "-";
					$DensityUpdate = 0;
					$VolumeUpdate = 0;
					$this->Stockpile_model->UpdateValueToStockpileNull($TonnesUpdate,$VolumeUpdate,$Stockpileorefeed,$AuUpdate,$AgUpdate,$AuEq75Update,$ClassUpdate,$DensityUpdate);

				}
				else{

					$this->Stockpile_model->UpdateValueToStockpile($TonnesUpdate,$VolumeUpdate,$Stockpileorefeed);
				}

				

			}


			//update tabel closingstockgrade
			$ClosingstockGrade = $this->ClosingStock_model->GetGrade($Stockpileorefeed,$Dateorefeed);
			if($ClosingstockGrade){
				foreach ($ClosingstockGrade as $grade) {
					$TonnesUpdate = $grade->Tonnes + $Tonnestocrushorefeed;
					$DensityUpdate = $grade->Density;
					$VolumeUpdate = $TonnesUpdate / $DensityUpdate;
					$idClosingstockgrade = $grade->id;
					$this->ClosingStock_model->UpdateValueClosingstockGrade($TonnesUpdate,$VolumeUpdate,$idClosingstockgrade);
				}

				


				$ClosingstockGrade = $this->ClosingStock_model->GetGrade($Stockpileorefeed,$Dateorefeed);
				foreach ($ClosingstockGrade as $grade) {
					$TonnesUpdate = $grade->Tonnes - (float) $this->input->post('Total');
					$DensityUpdate = $grade->Density;
					$VolumeUpdate = $TonnesUpdate / $DensityUpdate;
					$idClosingstockgrade = $grade->id;

					if($TonnesUpdate <= 0){

						$TonnesUpdate = 0;
						$AuUpdate = 0;
						$AgUpdate = 0;
						$AuEq75Update = 0;
						$ClassUpdate = "-";
						$DensityUpdate = 0;
						$VolumeUpdate = 0;
						$this->ClosingStock_model->UpdateValueClosingstockGradeNull($TonnesUpdate,$VolumeUpdate,$idClosingstockgrade,$AuUpdate,$AgUpdate,$AuEq75Update,$ClassUpdate,$DensityUpdate);

					}
					else{

						$this->ClosingStock_model->UpdateValueClosingstockGrade($TonnesUpdate,$VolumeUpdate,$idClosingstockgrade);

					}
					
				}

				

			}


			//update tabel orefeed
				$LoaderUpdate = $this->input->post('Loader');
				$MaterialUpdate = $this->input->post('material');
				$PercentageUpdate = $this->input->post('percentage');
				$BucketUpdate = $this->input->post('Bucket');
			
				$TonnesUpdate = $TonnesUpdate;
				$Tonnestocrush = $this->input->post('Total');
				$VolumeUpdate = $this->input->post('Volume');
				$DensityUpdate = $this->input->post('Density');

				$this->OreFeed_model->UpdateValueOrefeed($TonnesUpdate, $VolumeUpdate, $LoaderUpdate, $MaterialUpdate, $PercentageUpdate, $BucketUpdate, $Tonnestocrush, $id);



			redirect('OreFeed/Table');
		}else {
			redirect(base_url());
		}
	}

}
?>
