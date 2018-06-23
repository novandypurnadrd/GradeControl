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


		function getOreInventoryByBlockNew($block,$stockpile){
			$a="'";
			$view = $this->db->query('SELECT * FROM oreinventory WHERE block='.$a.$block.$a.'AND Stockpile='.$a.$stockpile.$a);
			return $view->result();
		}

		function getOreInventoryByBlockOnly($block){
			$a="'";
			$view = $this->db->query('SELECT * FROM oreinventory WHERE block='.$a.$block.$a);
			return $view->result();
		}


			function getOreInventoryByBlockGeneral($block,$stockpile){
			$a="'";
			$view = $this->db->query('SELECT * FROM oreinventorygeneral WHERE block='.$a.$block.$a.'AND Stockpile='.$a.$stockpile.$a);
			return $view->result();
		}

		function SearchBlock($block){
			$a="'";
			$view = $this->db->query('SELECT om.id, om.Block, om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile
																	FROM OreInventory om, stockpile s WHERE s.id = om.Stockpile AND block='.$a.$block.$a);
			return $view->result();
		}

		function SearchBlockDitinct($block){
			$a="'";
			$view = $this->db->query('SELECT DISTINCT Block FROM oreinventory WHERE block='.$a.$block.$a);
			return $view->result();
		}


		function GetOreInventoryByID($id){
			$view = $this->db->get_where('OreInventory', array('id' => $id, ));
			return $view->result();
		}

		function GetOreInventoryforUpdate($id){
			$a = "'";
			$query = $this->db->query('SELECT oi.PIT as Pit, oi.Block, oi.RL, oi.Type, oi.Au, oi.Ag, oi.AuEq75, oi.Class, oi.DryTonFF as DryTonFF, oi.Start, oi.StartHour, oi.Finish, oi.FinishHour, oi.Stockpile,oi.Value, oi.Status, oi.Achievement,oi.Note, ol.Au as AuOreline, ol.Ag as AgOreline, ol.Actual as Tonnes, ol.Dbdensity as Density FROM OreInventory oi, Oreline ol WHERE oi.Block = ol.File AND oi.id ='.$a.$id.$a.'ORDER BY oi.id DESC limit 1');
			return $query->result();
		}


		function GetOreInventoryforUpdateVisual($id){
			$a = "'";
			$query = $this->db->query('SELECT oi.PIT as Pit, oi.Block, oi.RL, oi.Type, oi.Au, oi.Ag, oi.AuEq75, oi.Class, oi.DryTonFF as DryTonFF, oi.Start, oi.StartHour, oi.Finish, oi.FinishHour, oi.Stockpile,oi.Value, oi.Status, oi.Achievement,oi.Note, oi.Au as AuOreline, oi.Ag as AgOreline, oi.DryTonBM as Tonnes, oi.Dbdensity as Density FROM OreInventory oi WHERE oi.id ='.$a.$id.$a.'ORDER BY oi.id DESC limit 1');
			return $query->result();
		}


		function GetOreInventoryforUpdateMinWaste($id){
			$a = "'";
			$query = $this->db->query('SELECT oi.PIT as Pit, oi.Block, oi.RL, oi.Type, oi.Au, oi.Ag, oi.AuEq75, oi.Class, oi.DryTonFF as DryTonFF, oi.Start, oi.StartHour, oi.Finish, oi.FinishHour, oi.Stockpile,oi.Value, oi.Status, oi.Achievement,oi.Note, oi.Au as AuOreline, oi.Ag as AgOreline, oi.DryTonBM as Tonnes, oi.Dbdensity as Density FROM OreInventory oi WHERE oi.id ='.$a.$id.$a.'ORDER BY oi.id DESC limit 1');
			return $query->result();
		}


		function GetBlock(){
			$view = $this->db->query('SELECT DISTINCT Block FROM oreinventory');
			return $view->result();
		}

		function GetOreInventoryByPit($Pit){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, ol.Au as Au, ol.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile
																	FROM OreInventory om, oreline ol, stockpile s WHERE s.id = om.Stockpile AND om.Block = ol.File Order by om.Start DESC');
			}
			else {
				$view = $this->db->query('SELECT DISTINCT (om.id), om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status,om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile, ol.File as Block
																	FROM OreInventory om, oreline ol, stockpile s WHERE s.id = om.Stockpile AND om.Block = ol.File AND om.pit = '.$a.$Pit.$a.'Order by om.Start DESC');
			}
	    return $view->result();
		}


		function DailyRecord($Pit){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block, om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile
																	FROM OreInventory om, stockpile s WHERE s.id = om.Stockpile AND om.Type = "Ore" Order by om.Start DESC');
			}
			else {
				$view = $this->db->query('SELECT DISTINCT (om.id), om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status,om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile 
																	FROM OreInventory om, stockpile s WHERE s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Ore"  Order by om.Start DESC');
			}
	    return $view->result();
		}


		function DailyRecordDate($Pit,$date){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block, om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile
																	FROM OreInventory om, stockpile s WHERE om.Start = '.$a.$date.$a.' AND s.id = om.Stockpile AND om.Type = "Ore" Order by om.Start DESC');
			}
			else {
				$view = $this->db->query('SELECT DISTINCT (om.id), om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status,om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile 
																	FROM OreInventory om, stockpile s WHERE om.Start = '.$a.$date.$a.' AND s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Ore" Order by om.Start DESC');
			}
	    return $view->result();
		}


		// 	function GeneralOreRecord($Pit,$dateStart,$dateEnd){
		// 	$a = "'";
		// 	if ($Pit == "All") {
		// 		$view = $this->db->query('SELECT om.id, om.Block, om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
		// 															om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile
		// 															FROM OreInventoryGeneral om, stockpile s WHERE ( (om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.Type = "Ore") OR ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.Type = "Visual") Order by om.Start DESC');
		// 	}
		// 	else {
		// 		$view = $this->db->query('SELECT DISTINCT (om.id), om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
		// 															om.Status,om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile 
		// 															FROM OreInventoryGeneral om, stockpile s WHERE ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Ore") OR ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Visual") Order by om.Start DESC');
		// 	}
	 //    return $view->result();
		// }


			function GeneralOreRecord($Pit,$dateStart,$dateEnd){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block, om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile
																	FROM OreInventory om, stockpile s WHERE ( (om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.Type = "Ore") OR ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.Type = "Visual") OR ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.Type = "Mineralized Waste") Order by om.Start ASC');
			}
			else {
				$view = $this->db->query('SELECT DISTINCT (om.id), om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status,om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile 
																	FROM OreInventory om, stockpile s WHERE ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Ore") OR ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Visual") OR ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Mineralized Waste") Order by om.Start ASC');
			}
	    return $view->result();
		}


		function GeneralOreRecordDistinct($Pit,$dateStart,$dateEnd){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT DISTINCT (om.Block)
																	FROM OreInventory om, stockpile s WHERE ( (om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.Type = "Ore") OR ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.Type = "Visual") OR ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.Type = "Mineralized Waste") Order by om.Start ASC');
			}
			else {
				$view = $this->db->query('SELECT DISTINCT (om.Block)
																	FROM OreInventory om, stockpile s WHERE ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Ore") OR ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Visual") OR ((om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Mineralized Waste") Order by om.Start ASC');
			}
	    return $view->result();
		}

		function GeneralOreRecordPit($Pit){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block, om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile
																	FROM OreInventory om, stockpile s WHERE (s.id = om.Stockpile AND om.Type = "Ore") OR ( s.id = om.Stockpile AND om.Type = "Visual") OR ( s.id = om.Stockpile AND om.Type = "Mineralized Waste") Order by om.Start ASC');
			}
			else {
				$view = $this->db->query('SELECT DISTINCT (om.id), om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status,om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile 
																	FROM OreInventory om, stockpile s WHERE (s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Ore") OR (s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Visual") OR (s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Mineralized Waste") Order by om.Start ASC');
			}
	    return $view->result();
		}


		function GeneralOreRecordPitDistinct($Pit){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT DISTINCT(om.Block)
																	FROM OreInventory om, stockpile s WHERE (s.id = om.Stockpile AND om.Type = "Ore") OR ( s.id = om.Stockpile AND om.Type = "Visual") OR ( s.id = om.Stockpile AND om.Type = "Mineralized Waste") Order by om.Start ASC');
			}
			else {
				$view = $this->db->query('SELECT DISTINCT (om.Block)
																	FROM OreInventory om, stockpile s WHERE (s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Ore") OR (s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Visual") OR (s.id = om.Stockpile AND om.pit = '.$a.$Pit.$a.' AND om.Type = "Mineralized Waste") Order by om.Start ASC');
			}
	    return $view->result();
		}





		function GetOreInventoryByPitGeneral($Pit,$dateStart,$dateEnd){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, ol.Au as Au, ol.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile
																	FROM OreInventory om, oreline ol, stockpile s WHERE s.id = om.Stockpile AND om.Block = ol.File Order by om.Start ASC');
			}
			else {
				$view = $this->db->query('SELECT DISTINCT (om.id), om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status,om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile, ol.File as Block
																	FROM OreInventory om, oreline ol, stockpile s WHERE s.id = om.Stockpile AND om.Block = ol.File AND om.pit = '.$a.$Pit.$a.'Order by om.Start ASC');
			}
	    return $view->result();
		}


		function GetOreInventoryByPitGeneralVisual($Pit){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile FROM oreinventory om, stockpile s WHERE om.type = "Visual"
																		AND s.id = om.Stockpile Order by om.Start DESC');
			}
			else {
				$view = $this->db->query('SELECT om.id, om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile FROM oreinventory om, stockpile s WHERE om.pit = '.$a.$Pit.$a.' AND om.type = "Visual"
																		AND s.id = om.Stockpile Order by om.Start DESC');
			}
	    return $view->result();
		}


		function GetOreInventoryByPitGeneralMinWaste($Pit){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile FROM oreinventory om, stockpile s WHERE om.type = "Mineralized Waste" AND s.id = om.Stockpile
																		 Order by om.Start DESC');
			}
			else {
				$view = $this->db->query('SELECT om.id, om.Block,om.Note, om.Start, om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile FROM oreinventory om, stockpile s WHERE om.pit = '.$a.$Pit.$a.' AND om.type = "Mineralized Waste" AND s.id = om.Stockpile
																		 Order by om.Start DESC');
			}
	    return $view->result();
		}


		function GetOreInventoryByPitandDate($Pit,$dateStart,$dateEnd){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block, om.Note, om.Start,om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, ol.Au as Au, ol.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile
																	FROM OreInventory om, oreline ol, stockpile s WHERE (om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND s.id = om.Stockpile AND om.Block = ol.File Order by om.Start DESC');
			}
			else {
				$view = $this->db->query('SELECT DISTINCT (om.id), om.Block,om.Note, om.Start,om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status,om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile, ol.File as Block
																	FROM OreInventory om, oreline ol, stockpile s WHERE s.id = om.Stockpile AND om.Block = ol.File AND (om.Start) BETWEEN ('.$a.$dateStart.$a.') AND ('.$a.$dateEnd.$a.') AND om.pit = '.$a.$Pit.$a.'Order by om.Start DESC');
			}
	    return $view->result();
		}


		function GetOreInventoryByPitandDateGeneral($Pit,$Date){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block, om.Note, om.Start,om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, ol.Au as Au, ol.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile
																	FROM OreInventorygeneral om, oreline ol, stockpile s WHERE om.Start='.$a.$Date.$a.' AND s.id = om.Stockpile AND om.Block = ol.File Order by om.Start DESC');
			}
			else {
				$view = $this->db->query('SELECT DISTINCT (om.id), om.Block, om.Note, om.Start,om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status,om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile, ol.File as Block
																	FROM OreInventorygeneral om, oreline ol, stockpile s WHERE s.id = om.Stockpile AND om.Block = ol.File AND om.Start='.$a.$Date.$a.' AND om.pit = '.$a.$Pit.$a.'Order by om.Start DESC');
			}
	    return $view->result();
		}


		function GetOreInventoryByPitandDateGeneralVisual($Pit,$Date){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block, om.Note, om.Start,om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile FROM oreinventory om, stockpile s WHERE om.Start='.$a.$Date.$a.' AND om.type="Visual" AND s.id = om.Stockpile Order by om.Start DESC');
			}
			else {
				$view = $this->db->query('SELECT om.id, om.Block, om.Note, om.Start,om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile FROM oreinventory om, stockpile s WHERE (om.Start='.$a.$Date.$a.' AND om.pit = '.$a.$Pit.$a.' AND om.type="Visual" AND s.id = om.Stockpile Order by om.Start DESC');
			}
	    return $view->result();
		}


		function GetOreInventoryByPitandDateGeneralMinWaste($Pit,$Date){
			$a = "'";
			if ($Pit == "All") {
				$view = $this->db->query('SELECT om.id, om.Block, om.Note, om.Start,om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile FROM oreinventory om, stockpile s WHERE om.Start='.$a.$Date.$a.' AND om.type = "Mineralized Waste" AND s.id = om.Stockpile Order by om.Start DESC');
			}
			else {
				$view = $this->db->query('SELECT om.id, om.Block, om.Note, om.Start,om.Finish, om.RL, om.Au as Augt, om.Ag as Aggt, om.DryTonBM, om.DryTonFF, om.Achievement, om.Dbdensity,
																	om.Status, om.Value, om.Au as Au, om.Ag as Ag, om.AuEq75 as AuEq75, om.Class as Class, s.Nama as Stockpile FROM oreinventory om, stockpile s WHERE om.Start='.$a.$Date.$a.' AND om.pit = '.$a.$Pit.$a.' AND om.type = "Mineralized Waste" AND s.id = om.Stockpile Order by om.Start DESC');
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

    function InputOreInventoryGeneral($data){
      $this->db->insert('OreInventorygeneral',$data);
    }


    function DeleteOreInventory($id){
			$this->db->delete('OreInventory',array('id'=>$id));
		}

	 function DeleteVisual($id){
			$this->db->delete('OreInventory',array('id'=>$id));
		}

	 function DeleteMinWaste($id){
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

	function AddTonnesGeneral($id,$data){
			$this->db->where('block', $id);
			$this->db->update('OreInventorygeneral',$data);
	}

	function CountBlock($block){
		$a="'";
		$query = $this->db->query('SELECT * FROM OreInventory WHERE Block = ' .$a.$block.$a);
        return $query->num_rows();
	}

	function SumMined($Date){
		$a="'";
		$sum = $this->db->query('SELECT SUM(DryTonFF) as SumTon FROM OreInventory WHERE Start='.$a.$Date.$a.' AND Stockpile != 20 AND Stockpile != 23');
		return $sum->row()->SumTon;
	}

	function SumMW($Date){
		$a="'";
		$sum = $this->db->query('SELECT SUM(DryTonFF) as SumTon FROM OreInventory WHERE Start='.$a.$Date.$a.' AND Stockpile = 20 AND Stockpile = 23');
		return $sum->row()->SumTon;
	}

	function GradeTotal($Date){
		$a="'";
		$view = $this->db->query('SELECT DryTonFF, Au, Ag FROM OreInventory WHERE Start='.$a.$Date.$a.' AND Stockpile != 20 AND Stockpile != 23');
		return $view->result();
	}

		function SelectCount($date){
		$a="'";
		$view = $this->db->query('SELECT DISTINCT Count(DISTINCT Block) FROM oreinventory WHERE Start='.$a.$date.$a);
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
