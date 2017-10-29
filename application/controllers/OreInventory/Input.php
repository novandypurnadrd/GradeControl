
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input extends CI_Controller {

	public function Input(){
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
				$data['main'] = "InputOreInventory";
				$data['Pit'] = $this->Pit_model->getPit();
				$data['Oreline'] = $this->Oreline_model->GetOrelineStatus();
				$data['OreInventory'] = $this->OreInventory_model->getInventory();
        $data['Stockpile'] = $this->Stockpile_model->getStockpile();
		    $this->load->view('OreInventory/Input', $data);
    }else {
      redirect(base_url());
    }
	}

	public function InputOreInventory()
	{
    if ($this->session->userdata('GradeControl')) {
			$Date =  $this->input->post('Start');
			$Date = explode('/', $Date)[2].'-'.explode('/', $Date)[0].'-'.explode('/', $Date)[1];

			$Start =  $this->input->post('Start');
			$Start = explode('/', $Start)[2].'-'.explode('/', $Start)[0].'-'.explode('/', $Start)[1];

			$Finish =  $this->input->post('Finish');
			if ($Finish!= "") {
				$Finish = explode('/', $Finish)[2].'-'.explode('/', $Finish)[0].'-'.explode('/', $Finish)[1];
			}
			
			if ($this->input->post('Type') == "Ore") {
				$Block = $this->input->post('Block');
			}
			else {
				$Block = $this->input->post('Nonore');
			}
			
			$Stockpile = $this->input->post('Stockpile');

			$Achievement = $this->input->post('Achievement');
			$Status = $this->input->post('Status');
	
				// if($Achievement > 80 && $Status == "Completed"){
				// 	$Au = $this->input->post('Augt');
				// 	$Ag = $this->input->post('Aggt');
				// 	$AuEq75 = $this->input->post('AuEq75gr');
				// }
			$Value = $this->input->post('Value');
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

			$data = array(
				'Pit' => $this->input->post('Pit'),
				'Block' => $Block,
				'RL' => $this->input->post('RL'),
				'Type' => $this->input->post('Type'),
				'Au' =>$Au,
				'Ag' =>$Ag,
				'AuEq75' => $AuEq75,
				'Class' => $this->input->post('Class'),
				'DryTonFF' => $this->input->post('DryTonFF'),
				'Start' => $Start,
				'Finish' => $Finish,
				'StartHour' => $this->input->post('StartHour'),
				'FinishHour' => $this->input->post('FinishHour'),
				'Stockpile' => $Stockpile,
				'Status' => $this->input->post('Status'),
				'Achievement' => $this->input->post('Achievement'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);
			$id = $this->input->post('Block');
			
			$status = $this->input->post('Status');
			$this->Oreline_model->UpdateOrelineStatus($id,$status);

			$OreInventory = $this->OreInventory_model->getOreInventoryByBlock($id,$Stockpile,$Date);
			if ($OreInventory) {
			foreach ($OreInventory as $key => $data) {

				
				$tonneslama= $data->DryTonFF;
              	$tonnesbaru = $tonneslama + $this->input->post('DryTonFF');
				$data = array(
				'Pit' => $this->input->post('Pit'),
				'Block' => $Block,
				'RL' => $this->input->post('RL'),
				'Type' => $this->input->post('Type'),
				'Au' =>$Au,
				'Ag' =>$Ag,
				'AuEq75' => $AuEq75,
				'Class' => $this->input->post('Class'),
				'DryTonFF' => $tonnesbaru,
				'Start' => $Start,
				'Finish' => $Finish,
				'StartHour' => $this->input->post('StartHour'),
				'FinishHour' => $this->input->post('FinishHour'),
				'Stockpile' => $Stockpile,
				'Status' => $this->input->post('Status'),
				'Achievement' => $this->input->post('Achievement'),
				'Density' => $this->input->post('Density'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);
			}
					
			$this->OreInventory_model->AddTonnes($id,$data);

			}else{

				$data = array(
				'Pit' => $this->input->post('Pit'),
				'Block' => $Block,
				'RL' => $this->input->post('RL'),
				'Type' => $this->input->post('Type'),
				'Au' =>$Au,
				'Ag' =>$Ag,
				'AuEq75' => $AuEq75,
				'Class' => $this->input->post('Class'),
				'DryTonFF' => $this->input->post('DryTonFF'),
				'Start' => $Start,
				'Finish' => $Finish,
				'StartHour' => $this->input->post('StartHour'),
				'FinishHour' => $this->input->post('FinishHour'),
				'Stockpile' => $Stockpile,
				'Status' => $this->input->post('Status'),
				'Achievement' => $this->input->post('Achievement'),
				'Density' => $this->input->post('Density'),
				'usrid' => $this->session->userdata('usernameGradeControl'),
			);
				$this->OreInventory_model->InputOreInventory($data);
			}

			
			$TruckTally = $this->input->post('DryTonFF');
			$Density = $this->input->post('Density');
			$Tonnes = $TruckTally;

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


			$Class =  $this->input->post('Class');
			$checker = 0;
			$Volume = $Tonnes/$Density;

			$OpenTonnes = 0;
			$OpenAu = 0;
			$OpenAg = 0; 
			//$ClosingStockdate = date('Y-m-d', strtotime('-1 day', strtotime($Date)));
		
				$Open = $this->ClosingStock_model->GetClosingStockTonnesStockpile($Stockpile);
				foreach ($Open as $open) {
					$OpenTonnes = $open->Tonnes;
					$OpenAu = $open->Au;
					$OpenAg = $open->Ag;
					
					}
			$Tonnes = $TruckTally + $OpenTonnes;
			//$Au = $this->input->post('Au');
			//$Augt = $this->input->post('Augt');
			//$v_Au = (($OpenAu*$OpenTonnes)+($Augt*$TruckTally))/$Tonnes;
			//$Ag = $this->input->post('Ag');
			//$Aggt = $this->input->post('Aggt');
			//$v_Ag = (($OpenAg*$OpenTonnes)+($Aggt*$TruckTally))/$Tonnes;
			//$AuEq75 = $this->input->post('AuEq75');

			// if($Achievement > 80 && $Status == "Completed"){
			// 		$Au = $this->input->post('Augt');
			// 		$Ag = $this->input->post('Aggt');
			// 		$AuEq75 = $this->input->post('AuEq75gr');
			// 	}
			// else{
			// 		$Au = $this->input->post('Au');
			// 		$Ag = $this->input->post('Ag');
			// 		$AuEq75 = $this->input->post('AuEq75');
			// }


			$v_Au = (($OpenAu*$OpenTonnes)+($Au*$TruckTally))/$Tonnes;
			
			$v_Ag = (($OpenAg*$OpenTonnes)+($Ag*$TruckTally))/$Tonnes;


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

			$Temp = $this->Stockpile_model->GetToStockpileCalcStockpile($Stockpile);
			foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $TruckTally;
				$Density = (($temp->Density*$temp->Tonnes)+($Density*$TruckTally))/$Tonnes;
				$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$TruckTally))/$Tonnes;
				$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$TruckTally))/$Tonnes;
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
				'Volume' => $Volume,
				'RL' => $this->input->post('RL'),
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => round($AuEq75,2),
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('Stockpile'),
				'Date' => $Date,
			);

			if ($checker == 0) {
				$this->Stockpile_model->InputToStockpile($ToStockpile);
			}
			else {
				$this->Stockpile_model->UpdateToStockpilebyStockpile($ToStockpile, $Stockpile);
			}

			$OreminedTonnes = $this->input->post('DryTonFF');
			$OpenTonnes = 0;
			$OpenAu = 0;
			$OpenAg = 0; 
			//$ClosingStockdate = date('Y-m-d', strtotime('-1 day', strtotime($Date)));
		
				$Open = $this->ClosingStock_model->GetClosingStockTonnesStockpile($Stockpile);
				foreach ($Open as $open) {
					$OpenTonnes = $open->Tonnes;
					$OpenAu = $open->Au;
					$OpenAg = $open->Ag;
					
					}
			$Tonnes = $OreminedTonnes + $OpenTonnes;

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

			//$Aggt = $this->input->post('Aggt');
			//$v_Ag = (($OpenAg*$OpenTonnes)+($Aggt*$OreminedTonnes))/$Tonnes;
			$v_Au = $Au;
			$v_Ag = $Ag;
			$AuEq75 = $this->input->post('AuEq75');
			$Class =  $this->input->post('Class');
			$Density = $this->input->post('Density');
			
			$Volume = $Tonnes/$Density;

			
			$Temp = $this->ClosingStock_model->GetClosingStockTonnesStockpile($Stockpile);
			foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $OreminedTonnes;
				$Density = (($temp->Density*$temp->Tonnes)+($Density*$OreminedTonnes))/$Tonnes;
				$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$OreminedTonnes))/$Tonnes;
				$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$OreminedTonnes))/$Tonnes;
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
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => round($AuEq75,2),
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				'Density' => $Density,
				'Stockpile' => $this->input->post('Stockpile'),
				'Date' => $Date,
				'Status' => "Pending",
			);

			if($Temp){
				$this->ClosingStock_model->UpdateClosingStockByStockpile($Closing,$Stockpile);
				
			}
			else{
				$this->ClosingStock_model->InputClosingStock($Closing);

			}


			//Check for Closing Stock Grade
			$Temp = $this->ClosingStock_model->GetClosingStockByStockpileandDateGrade($Stockpile,$Date);
			foreach ($Temp as $temp) {
				$Tonnes = $temp->Tonnes + $OreminedTonnes;
				//$Density = (($temp->Density*$temp->Tonnes)+($Density*$OreminedTonnes))/$Tonnes;
				$v_Au = (($temp->Au*$temp->Tonnes)+($Au*$OreminedTonnes))/$Tonnes;
				$v_Ag = (($temp->Ag*$temp->Tonnes)+($Ag*$OreminedTonnes))/$Tonnes;
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
				'Au' => $v_Au,
				'Ag' => $v_Ag,
				'AuEq75' => round($AuEq75,2),
				'Class' =>$Class,
				'Tonnes' => $Tonnes,
				//'Density' => $Density,
				'Stockpile' => $this->input->post('Stockpile'),
				'Date' => $Date,
				//'Status' => "Pending",
			);

			if($Temp){
				$this->ClosingStock_model->UpdateClosingStockByDateGrade($Closing,$Stockpile,$Date);
				
			}
			else{
				$this->ClosingStock_model->InputClosingStockGrade($Closing);

			}
			
			redirect('OreInventory/Input');

		}
		else {
			redirect(base_url());
		}
	}

}
?>
