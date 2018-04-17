<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function Dashboard(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
		$this->load->model('Closingstock_model');
		$this->load->model('Oreinventory_model');
		$this->load->model('Orefeed_model');
		$this->load->library('session');

	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
			$data['main'] = "Dashboard";
			$data['sub'] = "";
        	$data['subsub'] = "";
        	$date = date('Y-m-d');
        	$openingdate = date('Y-m-d', strtotime('-1 day', strtotime($date)));

           
        	$openingstock = $this->Closingstock_model->GetOpeningStockRompadDashboard($date);
        	if($openingstock == null){
        		$openingstock =2;
        	}
     
        	$closingstock = $this->Closingstock_model->GetClosingStockRompadDashboard($date);
        	if($closingstock == null){
        		$closingstock =0;
        	}

        
        	$totalblock = $this->Oreinventory_model->SelectCount($date);
            if($totalblock <= 1){
                $totalblock = 0;
            }
        
        	$feedtocrush= round($this->Orefeed_model->GetOrefeedtocrusherkDashboard($date),2);
        	if($feedtocrush == null){
        		$feedtocrush =0;
        	}
        	$data['openingstock'] = $openingstock;
        	$data['closingstock'] = $closingstock;
        	$data['totalblock'] = $totalblock;
        	$data['feedtocrush'] =$feedtocrush;

        	$Fresh = $this->Orefeed_model->SumFreshbyDate($date);
            if ($Fresh == null){
                $Fresh =0;
            }
            $Transition = $this->Orefeed_model->SumTransisibyDate($date);
            if ($Transition == null){
                $Transition =0;
            }
            $Clay = $this->Orefeed_model->SumClaybyDate($date);
            if ($Clay == null){
                $Clay =0;
            }
            $Sumton = $Fresh+$Transition+$Clay;
            if($Sumton == 0){
            	$Sumton = 1;
            }
            $data['PersenFresh'] = round(($Fresh/$Sumton)*100,2).'%';
            $data['PersenTransisi'] = round(($Transition/$Sumton)*100,2).'%';
            $data['PersenClay'] = round(($Clay/$Sumton)*100,2).'%';

		    $this->load->view('Dashboard', $data);
    }else {
      redirect('GradeControl');
    }
	}

	public function Logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
}
?>
