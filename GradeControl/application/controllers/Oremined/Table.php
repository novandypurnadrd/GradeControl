
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table extends CI_Controller {

	public function Table(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		$this->load->model('OreInventory_model');
		$this->load->model('Oremined_model');
    $this->load->model('Stockpile_model');
		$this->load->model('ClosingStock_model');
		$this->load->model('Pit_model');
		$this->load->library('session');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "Oremined";
	      $data['date'] = '';
        $data['Table'] = $this->Oremined_model->getOreminedByDate($data['date']);
		    $this->load->view('Oremined/Table', $data);
    }else {
      redirect(base_url());
    }
	}

  public function Filter(){
		if ($this->session->userdata('GradeControl')) {
			$data['main'] = "Oremined";
			$data['date'] = $this->input->post('Date');
			$date = explode('/',$data['date'])[2].'-'.explode('/',$data['date'])[0].'-'.explode('/',$data['date'])[1];
			$data['defdate'] = $date;
			$data['Table'] = $this->Oremined_model->getOreminedByDate($date);
			$this->load->view('Oremined/Table', $data);
		}else {
			redirect(base_url());
		}
	}

	public function DeleteOremined($id, $date, $stockpile)
	{
		if ($this->session->userdata('GradeControl')) {
			$ToStockpile = $this->Stockpile_model->GetToStockpileForDel($date, $stockpile);
			$Oremined = $this->Oremined_model->GetOreminedByIDForDel($id);

			foreach ($ToStockpile as $tostockpilee) {
				$DensityS =  $tostockpilee->Density ;
				$TonnesS =  $tostockpilee->Tonnes ;
				$AuS =  $tostockpilee->Au ;
				$AgS =  $tostockpilee->Ag ;
				$idS = $tostockpilee->id ;
			}

			foreach ($Oremined as $oremined) {
				$DensityO =  $oremined->Density ;
				$TonnesO =  $oremined->TruckTally ;
				$AuO =  $oremined->Au ;
				$AgO =  $oremined->Ag ;
			}

			$Tonnes = $TonnesS - $TonnesO;
			if ($Tonnes == 0) {
				$this->Stockpile_model->DeleteToStockpile($idS);
			}
			else {
				$Density = (($DensityS*$TonnesS)-($DensityO*$TonnesO))/$Tonnes;
				$Au = (($AuS*$TonnesS)-($AuO*$TonnesO))/$Tonnes;
				$Ag = (($AgS*$TonnesS)-($AgO*$TonnesO))/$Tonnes;
				$Volume = $Tonnes / $Density;

				$ToStockpile = array(
					'Volume' => $Volume,
					'Au' => $Au,
					'Ag' => $Ag,
					'Tonnes' => $Tonnes,
					'Density' => $Density,
				);

				$this->Stockpile_model->UpdateToStockpile($ToStockpile, $date, $stockpile);
			}
			$this->Oremined_model->DeleteOremined($id);

			foreach ($Oremined as $oremined) {
				$Density =  $oremined->Density ;
				$TruckTally =  $oremined->TruckTally ;
				$Au =  $oremined->Au ;
				$Ag =  $oremined->Ag ;
			}

			$Temp = $this->ClosingStock_model->GetClosingStockByStockpile($stockpile);

			$Tonnes = $TruckTally;
			$Volume = $Tonnes/$Density;
			foreach ($Temp as $temp) {
				$Date = $temp->Date;
				$Tonnes = $temp->Tonnes - $TruckTally;
				if ($Tonnes == 0) {
					$Density = 0;
					$Au = 0;
					$Ag = 0;
					$Volume = 0;
				}
				else {
					$Density = (($temp->Density*$temp->Tonnes)-($Density*$TruckTally))/$Tonnes;
					$Au = (($temp->Au*$temp->Tonnes)-($Au*$TruckTally))/$Tonnes;
					$Ag = (($temp->Ag*$temp->Tonnes)-($Ag*$TruckTally))/$Tonnes;
					$Volume = $Tonnes / $Density;
				}
			}

			$Closing = array(
				'Volume' => $Volume,
				'Au' => $Au,
				'Ag' => $Ag,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $stockpile,
				'Date' => $Date,
			);

			$this->ClosingStock_model->InputClosingStock($Closing);

			redirect('Oremined/Table');
		}
		else {
			redirect(base_url());
		}
	}

	public function Update($id, $date, $stockpile)
	{
		if ($this->session->userdata('GradeControl')) {
			$this->session->set_userdata(
				array(
					'id' => $id,
					'date'=> $date,
					'stockpile'=> $stockpile,
				)
			);
			redirect('Oremined/Update');
		}
		else {
			redirect(base_url());
		}
	}

}
?>
