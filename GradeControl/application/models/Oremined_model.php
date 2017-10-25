<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Oremined_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function GetOremined(){
      $view = $this->db->get('Oremined');
	    return $view->result();
		}

		function GetOreminedByID($id){
			$a="'";
			$view = $this->db->query('SELECT om.id, om.Type, ol.Au as AuBM, ol.Ag as AgBM, om.RL, om.Au, om.Ag, om.DryTon, om.Density, oi.Au as AuFF, oi.Ag as AgFF, oi.RL,
																ol.Actual as DryTonBM, oi.DryTonFF, om.TruckTally, ol.Dbdensity, s.id as Stockpile, om.Block, p.id as Pit, om.Remarks, om.Note, om.Date
																FROM oreline ol, oremined om, oreinventory oi, pit p, stockpile s
																WHERE p.id = oi.Pit AND ol.pit = p.id AND om.Stockpile = s.id AND om.id ='.$a.$id.$a);
	    return $view->result();
		}

		function GetOreminedByIDForDel($id){
			$a="'";
			$view = $this->db->query('SELECT * FROM oremined WHERE id ='.$a.$id.$a);
	    return $view->result();
		}

		function GetOreminedByDate($Date){
			$a="'";
			$view = $this->db->query('SELECT om.id, om.Type, ol.Au as AuBM, ol.Ag as AgBM, om.RL, om.Au, om.Ag, om.DryTon, om.Density, oi.Au as AuFF, oi.Ag as AgFF, oi.RL, oi.Achievement as Achievement,
																ol.Actual as DryTonBM, oi.DryTonFF, om.TruckTally, ol.Dbdensity, s.Nama as Stockpile, om.Block, p.Nama as Pit, om.Remarks, om.Note, s.id as idStockpile
																FROM oreline ol, oremined om, oreinventory oi, pit p, stockpile s
																WHERE p.id = oi.Pit AND ol.pit = p.id AND om.Stockpile = s.id AND om.Date ='.$a.$Date.$a);
	    return $view->result();
		}

    function InputOremined($data){
      $this->db->insert('Oremined',$data);
    }

    function DeleteOremined($id){
			$this->db->delete('Oremined',array('id'=>$id));
		}

    function UpdateOremined($data, $id){
			$this->db->where('id', $id);
			$this->db->update('Oremined',$data);
		}

	function UpdateTonnes($Stockpile,$Tonnes){
		$a="'";
		$view = $this->db->query('UPDATE tostockpile SET Tonnes ='.$a.$Tonnes.$a.' WHERE Stockpile = '.$a.$Stockpile.$a);
	}
	

	}

?>
