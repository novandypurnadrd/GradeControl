<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class OreFeed_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function GetOreFeed(){
      $view = $this->db->get('OreFeed');
	    return $view->result();
		}


		function GetOreFeedByIDNew($id){
			$a="'";
			$view = $this->db->query('SELECT * FROM OreFeed WHERE id ='.$a.$id.$a);
	    return $view->result();
		}


		function GetOreFeedByID($id){
			$a="'";
			$view = $this->db->query('SELECT om.id, ol.Au as AuBM, ol.Ag as AgBM, om.Au, om.Ag, om.Class, om.AuEq75, om.Density, om.Volume,om.Material,om.Percentage,om.Bucket, oi.Au as AuFF, oi.Ag as AgFF, oi.RL,
																ol.Actual as DryTonBM, oi.DryTonFF, ol.Dbdensity, s.id as Stockpile,s.nama as Nama, p.id as Pit, om.Remarks, om.Note, om.Date, om.shift, om.Loader ,om.Tonnestocrush
																FROM oreline ol, OreFeed om, oreinventory oi, pit p, stockpile s
																WHERE p.id = oi.Pit AND ol.pit = p.id AND om.Stockpile = s.id AND om.id ='.$a.$id.$a);
	    return $view->result();
		}

		function GetOreFeedByDate($Date){
			$a="'";
			$view = $this->db->query('SELECT om.id, om.Type, ol.Au as AuBM, ol.Ag as AgBM, om.RL, om.Au, om.Ag, om.DryTon, om.Density, oi.Au as AuFF, oi.Ag as AgFF, oi.RL,
																ol.Actual as DryTonBM, oi.DryTonFF, om.TruckTally, ol.Dbdensity, s.Nama as Stockpile, om.Block, p.Nama as Pit, om.Remarks, om.Note
																FROM oreline ol, OreFeed om, oreinventory oi, pit p, stockpile s
																WHERE p.id = oi.Pit AND ol.pit = p.id AND om.Stockpile = s.id AND om.Date ='.$a.$Date.$a);
	    return $view->result();
		}

		function GetTableOreFeed($Stockpile,$Date){
			$a="'";

			if($Stockpile == "All"){
				$view = $this->db->query('SELECT of.id as id, of.Date as tanggal, of.Stockpile , of.Au as Au, of.Ag as Ag, of.Tonnes as Tonnes, of.AdjAu as AdjAu, of.AdjAg as AdjAg, of.AuEq75 as AuEq75, of.AdjAuPersen as AdjAuPersen, of.AdjAgPersen as AdjAgPersen, of.Loader as Loader, of.Remarks , of.Note as Note, of.Density as Density, of.Volume as Volume, s.Nama as Stockpile, of.Tonnestocrush as Tonnestocrush FROM orefeed of, stockpile s WHERE of.Stockpile = s.id AND of.Date = '.$a.$Date.$a);
			return $view->result();
			}else{
				$view = $this->db->query('SELECT of.id as id, of.Date as tanggal, of.Stockpile , of.Au as Au, of.Ag as Ag, of.Tonnes as Tonnes, of.AdjAu as AdjAu, of.AdjAg as AdjAg, of.AuEq75 as AuEq75, of.AdjAuPersen as AdjAuPersen, of.AdjAgPersen as AdjAgPersen, of.Loader as Loader, of.Remarks , of.Note as Note, of.Density as Density, of.Volume as Volume, s.Nama as Stockpile, of.Tonnestocrush as Tonnestocrush FROM orefeed of, stockpile s WHERE of.Stockpile = s.id AND of.Stockpile='.$a.$Stockpile.$a.'AND of.Date = '.$a.$Date.$a);
			return $view->result();	
			}
			
		}


    function InputOreFeed($data){
      $this->db->insert('OreFeed',$data);
    }

    function DeleteOreFeed($id){
			$this->db->delete('OreFeed',array('id'=>$id));
		}

    function UpdateOreFeed($data, $id){
			$this->db->where('id', $id);
			$this->db->update('OreFeed',$data);
		}

	function SumClay($Date,$Stockpile){
		$a="'";
		$material = "Clay";
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as SumClay FROM OreFeed WHERE Material='.$a.$material.$a.' AND Date='.$a.$Date.$a.' AND Stockpile='.$a.$Stockpile.$a);
		return $sum->row()->SumClay;
	}

	function SumClayfull($Date,$Stockpile){
		$a="'";
		$material = "Clayfull";
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as SumClay FROM OreFeed WHERE Material='.$a.$material.$a.' AND Date='.$a.$Date.$a.' AND Stockpile='.$a.$Stockpile.$a);
		return $sum->row()->SumClay;
	}

	function SumFresh($Date,$Stockpile){
		$a="'";
		$material = "Fresh";
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as SumFresh FROM OreFeed WHERE Material='.$a.$material.$a.' AND Date='.$a.$Date.$a.' AND Stockpile='.$a.$Stockpile.$a);
		return $sum->row()->SumFresh;
	}

	function SumBypass($Date,$Stockpile){
		$a="'";
		$type = "Bypass";
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as SumFresh FROM OreFeed WHERE Type='.$a.$type.$a.' AND Date='.$a.$Date.$a.' AND Stockpile='.$a.$Stockpile.$a);
		return $sum->row()->SumFresh;
	}

	function SumTransisi($Date,$Stockpile){
		$a="'";
		$material = "Transisi";
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as SumTransisi FROM OreFeed WHERE Material='.$a.$material.$a.'AND Date='.$a.$Date.$a.' AND Stockpile='.$a.$Stockpile.$a);
		return $sum->row()->SumTransisi;
	}

	function SumClaybyDate($Date){
		$a="'";
		$material = "Clay";
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as SumClay FROM OreFeed WHERE Material='.$a.$material.$a.' AND Date='.$a.$Date.$a);
		return $sum->row()->SumClay;
	}

	function SumClayFullbyDate($Date){
		$a="'";
		$material = "Clayfull";
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as SumClay FROM OreFeed WHERE Material='.$a.$material.$a.' AND Date='.$a.$Date.$a);
		return $sum->row()->SumClay;
	}

	function SumFreshbyDate($Date){
		$a="'";
		$material = "Fresh";
	
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as SumFresh FROM OreFeed WHERE Material='.$a.$material.$a.' AND Date='.$a.$Date.$a);
		return $sum->row()->SumFresh;
	}

	function SumBypassbyDate($Date){
		$a="'";
		$type = "Bypass";
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as SumFresh FROM OreFeed WHERE Type='.$a.$type.$a.'  AND Date='.$a.$Date.$a);
		return $sum->row()->SumFresh;
	}

	function SumTransisibyDate($Date){
		$a="'";
		$material = "Transisi";
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as SumTransisi FROM OreFeed WHERE Material='.$a.$material.$a.'AND Date='.$a.$Date.$a);
		return $sum->row()->SumTransisi;
	}

	function SumTonnestocrush($Date,$Stockpile){
		$a="'";
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as tot FROM OreFeed WHERE  Date='.$a.$Date.$a.' AND Stockpile='.$a.$Stockpile.$a);
		return $sum->row()->tot;
	}

	function SumTonnestocrushbyDate($Date){
		$a="'";
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as tot FROM OreFeed WHERE  Date='.$a.$Date.$a);
		return $sum->row()->tot;
	}

	// function GetOrefeedtocrusher($Date){
	// 	$a="'";
	// 	$sum = $this->db->query('SELECT SUM(Tonnestocrush) as SumTon FROM OreFeed WHERE Date='.$a.$Date.$a);
	// 	return $sum->row()->SumTon;
	// }

	function GetOrefeedtocrusher($Date){
		$a="'";
			$view = $this->db->query('SELECT * FROM orefeed WHERE Date='.$a.$Date.$a);
	    	return $view->result();
	}

	function GetBypassTonnes($Date){
		$a="'";
		$Type = "Bypass";
	 	$sum = $this->db->query('SELECT * FROM orefeed WHERE Date='.$a.$Date.$a.' AND Type='.$a.$Type.$a);
	 	return $sum->result();
	}

	function GetOrefeedtocrusherkDashboard($Date){
		$a="'";
		$sum = $this->db->query('SELECT SUM(Tonnestocrush) as SumTon FROM orefeed WHERE Date='.$a.$Date.$a);
		return $sum->row()->SumTon;
	}

	function GetOrefeedtocrusherkDashboardNew(){
		$a="'";
		$sum = $this->db->query('SELECT SUM(Tonnes) as SumTon FROM orefeed');
		return $sum->row()->SumTon;
	}

	function GetCalcOreFeed($Date){
		$a="'";
		$sum = $this->db->query('SELECT SUM(Tonnes) as SumTon FROM orefeed WHERE Date='.$a.$Date.$a);
		return $sum->row()->SumTon;
	}

	}

?>
