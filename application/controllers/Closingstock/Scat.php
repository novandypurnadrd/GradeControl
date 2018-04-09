
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
			
		
				$data['date'] = '';
				$selectedstockpile = "";
				$selectedyear = '0000-00-00';
				$data['Table'] = $this->ClosingStock_model->getScat();
        		
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


    		$Temp = $this->ClosingStock_model->GetClosingStockTonnesStockpile($Stockpilescat);
			foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $DryTon;
				$Density = (($temp->Density*$temp->Tonnes)+($Density*$DryTon))/$Tonnes;
				$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$DryTon))/$Tonnes;
				$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$DryTon))/$Tonnes;
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
				'Tonnes' => $Tonnes,
				'Density' => $Density,
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
			$Temp = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($Stockpilescat,$Date);
			foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $DryTon;
				//$Density = (($temp->Density*$temp->Tonnes)+($Density*$OreminedTonnes))/$Tonnes;
				$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$DryTon))/$Tonnes;
				$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$DryTon))/$Tonnes;
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
				//$Volume = $Tonnes / $Density;
			}

			$Closing = array(
				//'Volume' => $Volume,
				'Au' => round($v_Au,2),
				'Ag' => round($v_Ag,2),
				'AuEq75' => round($AuEq75,2),
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				//'Density' => $Density,
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
				$this->Stockpile_model->UpdateToStockpilebyStockpile($ToStockpile, $Stockpile);
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
			$this->ClosingStock_model->DeleteScat($id);
			redirect('ClosingStock/Scat');
		}
		else {
			redirect(base_url());
		}
	}


}
?>
