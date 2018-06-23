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
        $this->load->model('Stockpile_model');
		$this->load->library('session');

	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
			$data['main'] = "Dashboard";
			$data['sub'] = "";
        	$data['subsub'] = "";
        	$date = date('Y-m-d');
        	$openingdate = date('Y-m-d', strtotime('-1 day', strtotime($date)));

           
        	$openingstock = round($this->Closingstock_model->GetOpeningStockRompadDashboard($openingdate),2);
        	if($openingstock == null){
        		$openingstock =0;
        	}
       
     
        	$closingstock = round($this->Closingstock_model->GetClosingStockRompadDashboard($openingdate),2);
        	if($closingstock == null){
        		$closingstock =0;
        	}
       
        
        	$totalblock = $this->Oreinventory_model->SelectCount($date);
            if($totalblock <= 1){
                $totalblock = 0;
            }
        
        	$feedtocrush= round($this->Orefeed_model->GetOrefeedtocrusherkDashboard($openingdate),2);
        	if($feedtocrush == null){
        		$feedtocrush =0;
        	}

            $SumTon = $this->Oreinventory_model->SumMined($openingdate);
            if($SumTon == null){
                $SumTon = 0;
            }

        	$data['openingstock'] = $openingstock;
        	$data['closingstock'] = $closingstock;
        	$data['totalmined'] = $SumTon;
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


           
            $sumclay = round($this->Orefeed_model->SumClaybyDate($openingdate),2);
            if ($sumclay == null){
                $sumclay = 0;
            }
            $sumclayfull = round($this->Orefeed_model->SumClayfullbyDate($openingdate),2);
            if ($sumclayfull == null){
                $sumclayfull = 0;
            }
            $sumfresh = round($this->Orefeed_model->SumFreshbyDate($openingdate),2);
            if ($sumfresh == null){
                $sumfresh = 0;
            }
            $sumbypass = round($this->Orefeed_model->SumBypassbyDate($openingdate),2);
            if ($sumbypass == null){
                $sumbypass = 0;
            }
            $sumtransisi = round($this->Orefeed_model->SumTransisibyDate($openingdate),2);
            if ($sumtransisi == null){
                $sumtransisi = 0;
            }
            $sumtonnes = round($this->Orefeed_model->SumTonnestocrushbyDate($openingdate),2);
            if ($sumtonnes == null){
                $sumtonnes = 1;
            }
            // $data['clay'] = round($sumclay/$sumtonnes,2)*100;
            // $data['fresh'] = round($sumfresh/$sumtonnes,2)*100;
            // $data['transisi'] = round($sumtransisi/$sumtonnes,2)*100;
            $data['clay'] = $sumclay+$sumclayfull;
            $data['fresh'] = $sumfresh+$sumbypass;
            $data['transisi'] = $sumtransisi;

            $data['ListStockpile'] = $this->Stockpile_model->StockpileDistinct();

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
