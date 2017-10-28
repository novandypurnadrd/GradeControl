<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class OreInventory_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function GetOreInventory(){
			$view = $this->db->query('SELECT om.id, om.Block, om.RL, om.Au as Augt, om.Ag as Aggt, ol.Actual AS DryTon, om.DryTonFF, om.Achievement, ol.Dbdensity,
																om.Status, ol.Au as Au, ol.Ag as Ag
																FROM OreInventory om, oreline ol WHERE ol.id = om.Block');
	    return $view->result();
		}

		function getInventory(){
			 $view = $this->db->get('OreInventory');
	    return $view->result();
		}

		function getOreInventoryByBlock($block,$stockpile,$date){
			$a="'";
			$view = $this->db->query('SELECT * FROM oreinventory WHERE block='.$a.$block.$a.'AND Stockpile='.$a.$stockpile.$a.'AND Start ='.$a.$date.$a);
			return $view->result();
		}


		function GetOreInventoryByID($id){
			$view = $this->db->get_where('OreInventory', array('id' => $id, ));
			return $view->result();
		}

		function GetOreInventoryforUpdate($id){
			$a = "'";
			$query = $this->db->query('SELECT oi.PIT as Pit, oi.Block, oi.RL, oi.Type, oi.Au, oi.Ag, oi.AuEq75, oi.Class, oi.DryTonFF as DryTonFF, oi.Start, oi.StartHour, oi.Finish, oi.FinishHour, oi.Stockpile, oi.Status, oi.Achievement,oi.Note, ol.Au as AuOreline, ol.Ag as AgOreline, ol.Actual as Tonnes, ol.Dbdensity as Density FROM OreInventory oi, Oreline ol WHERE oi.Block = ol.id AND oi.id ='.$a.$id.$a);
			return $query->result();
		}


		function GetBlock(){
			$view = $this->db->query('SELECT DISTINCT Block FROM oreinventory');
			return $view->result();
		}

		function GetOreInventoryByPit($Pit){
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block, om.Start, om.RL, om.Au as Augt, om.Ag as Aggt, ol.Actual AS DryTon, om.DryTonFF, om.Achievement, ol.Dbdensity,
																	om.Status, ol.Au as Au, ol.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile
																	FROM OreInventory om, oreline ol, stockpile s WHERE s.id = om.Stockpile AND ol.id = om.Block');
			}
			else {
				$view = $this->db->query('SELECT om.id, om.Block, om.Start, om.RL, om.Au as Augt, om.Ag as Aggt, ol.Actual AS DryTon, om.DryTonFF, om.Achievement, ol.Dbdensity,
																	om.Status, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile, ol.File as Block
																	FROM OreInventory om, oreline ol, stockpile s WHERE ol.id = om.Block AND s.id = om.Stockpile AND om.pit = '.$Pit);
			}
	    return $view->result();
		}

		

		function GetOreInventoryByDate($date){
			$a="'";
			$view = $this->db->query('SELECT oi.Au, oi.Ag, oi.DryTonFF,oi.Stockpile as idStockpile, s.Nama as Stockpile, p.Nama as Pit FROM oreinventory oi, stockpile s, pit p WHERE s.id = oi.Stockpile AND p.id = oi.Pit AND Start='.$a.$date.$a.'ORDER BY s.Nama ASC');
			return $view->result();
		}

		function GetOreInventoryByDateDistinct($date){
			$a="'";
			$view = $this->db->query('SELECT DISTINCT s.Nama as Stockpile, p.Nama as Pit FROM oreinventory oi, stockpile s, pit p WHERE s.id = oi.Stockpile AND p.id = oi.Pit AND Start='.$a.$date.$a.'ORDER BY s.Nama ASC');
			return $view->result();
		}

		function GetOreInventorybyStockpile($date,$id){
			$a="'";
			$view = $this->db->query('SELECT oi.Au, oi.Ag, oi.DryTonFF,oi.Stockpile as idStockpile, s.Nama as Stockpile, p.Nama as Pit FROM oreinventory oi, stockpile s, pit p WHERE s.id = oi.Stockpile AND p.id = oi.Pit AND Start='.$a.$date.$a.' AND oi.Stockpile= '.$a.$id.$a.' ORDER BY s.Nama ASC');
			return $view->result();
		}




    function InputOreInventory($data){
      $this->db->insert('OreInventory',$data);
    }

    function DeleteOreInventory($id){
			$this->db->delete('OreInventory',array('id'=>$id));
		}

    function UpdateOreInventory($data, $id){
			$this->db->where('id', $id);
			$this->db->update('OreInventory',$data);
		}

	function AddTonnes($id,$data){
			$this->db->where('block', $id);
			$this->db->update('OreInventory',$data);
	}

	function CountBlock($block){
		$a="'";
		$query = $this->db->query('SELECT * FROM OreInventory WHERE Block = ' .$a.$block.$a);
        return $query->num_rows();
	}

	function SumMined($Date){
		$a="'";
		$sum = $this->db->query('SELECT SUM(DryTonFF) as SumTon FROM OreInventory WHERE Start='.$a.$Date.$a);
		return $sum->row()->SumTon;
	}

		function SelectCount($date){
		$a="'";
		$view = $this->db->query('SELECT DISTINCT Block FROM oreinventory WHERE Start='.$a.$date.$a);
		return $view->num_rows();
	}

		function getRomMined($date){
		$a = "'";
		$AuEq75 = 2;
		$view = $this->db->query('SELECT * FROM OreInventory WHERE Start='.$a.$date.$a.' AND AuEq75>'.$a.$AuEq75.$a);
		return $view->result();
	}

	function getMarginal($date){
		$a = "'";
		$AuEq751 = 0.65;
		$AuEq75 = 2;
		$view = $this->db->query('SELECT * FROM OreInventory WHERE Start='.$a.$date.$a.' AND '.$a.$AuEq751.$a.'<AuEq75 AND AuEq75 <' .$a.$AuEq75.$a);
		return $view->result();
	}

	function GetCalcOreMine($Date){
		$a="'";
		$sum = $this->db->query('SELECT SUM(DryTonFF) as SumTon FROM OreInventory WHERE Start='.$a.$Date.$a);
		return $sum->row()->SumTon;
	}

	}

?>
