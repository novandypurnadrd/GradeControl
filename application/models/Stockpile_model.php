<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Stockpile_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function GetStockpile(){
      $view = $this->db->get('Stockpile');
	    return $view->result();
		}

		function StockpileDistinct(){
			$a = "'";
			$view = $this->db->query('SELECT id,Nama FROM Stockpile');
			return $view->result();
		}


		function GetToStockpile($stockpile, $year){
			$a = "'";
			if ($year != "0000-00-00") {
				if ($stockpile != "") {
					$view = $this->db->query('SELECT * FROM ToStockpile t, Stockpile s WHERE YEAR(t.Date) = '.$a.$year.$a.' AND t.Stockpile = '.$a.$stockpile.$a.' AND s.id = t.Stockpile ');
				}
				else {
					$view = $this->db->query('SELECT * FROM ToStockpile t, Stockpile s WHERE YEAR(t.Date) = '.$a.$year.$a);
				}
			}else {
				$view = $this->db->query('SELECT * FROM ToStockpile t, Stockpile s WHERE t.id = 0');
			}
	    return $view->result();
		}

		function TotalToStockpile($stockpile,$date){
			$a = "'";
			$view = $this->db->query('SELECT * FROM ToStockpile WHERE Date = '.$a.$date.$a.' AND Stockpile = '.$a.$stockpile.$a);
			return $view->result();
		}

		function TotalToStockpileByStockpile($stockpile){
			$a = "'";
			$view = $this->db->query('SELECT * FROM ToStockpile WHERE Stockpile = '.$a.$stockpile.$a);
			return $view->result();
		}


	

		function getActivityStockpile($stockpile,$date){
			$a = "'";
			$view = $this->db->query('SELECT * FROM oreinventory WHERE Start = '.$a.$date.$a.' AND Stockpile = '.$a.$stockpile.$a);
			return $view->result();
		}

		function getActivityStockpileByStockpile($stockpile){
			$a = "'";
			$view = $this->db->query('SELECT * FROM oreinventory WHERE Stockpile = '.$a.$stockpile.$a);
			return $view->result();
		}

		

		function ViewToStockpile(){
			 $view = $this->db->get('tostockpile');
	    return $view->result();
		}

		function GetToStockpileCalc($date, $stockpile){
			$a = "'";
			$view = $this->db->query('SELECT * FROM ToStockpile WHERE Date = '.$a.$date.$a.' AND Stockpile = '.$a.$stockpile.$a);
	    return $view->result();
		}

		function getYear(){
			$view = $this->db->query('SELECT DISTINCT YEAR(Start) as Year FROM oreinventory');
	    return $view->result();
		}

		function GetToStockpileForDel($date, $Stockpile){
			$view = $this->db->get_where('ToStockpile', array('Date' => $date, 'Stockpile' => $Stockpile));
			return $view->result();
		}


		function GetStockpileByID($id){
			$view = $this->db->get_where('Stockpile', array('id' => $id, ));
			return $view->result();
		}

		function GetStockpileByDate($date){
			$a = "'";
			$view = $this->db->query('SELECT ts.Volume, ts.Density, ts.Tonnes, ts.Au, ts.Ag, ts.AuEq75, s.Nama as Stockpile FROM ToStockpile ts, Stockpile s WHERE ts.Stockpile = s.id AND ts.Date ='.$a.$date.$a);
			return $view->result();
		}

		function GetStockpileByDateandStockpileReport($date,$stockpile){
			$a = "'";
			$view = $this->db->query('SELECT ts.Volume, ts.Density, ts.Tonnes, ts.Au, ts.Ag, ts.AuEq75, s.Nama as Stockpile FROM closingstockgrade ts, Stockpile s WHERE ts.Stockpile = s.id AND ts.Date <='.$a.$date.$a.' AND ts.Stockpile='.$a.$stockpile.$a.' ORDER BY ts.id DESC LIMIT 1');
			return $view->result();
		}

		function GetStockpileByDateandStockpile($date,$stockpile){
			$a = "'";
			$view = $this->db->query('SELECT * FROM ToStockpile WHERE Stockpile = '.$a.$stockpile.$a.' AND Date ='.$a.$date.$a);
			return $view->result();
		}

		function GetStockpileByStockpile($stockpile){
			$a = "'";
			$view = $this->db->query('SELECT * FROM ToStockpile WHERE Stockpile = '.$a.$stockpile.$a);
			return $view->result();
		}

		function GetStockpileByStockpileByID($id){
			$a = "'";
			$view = $this->db->query('SELECT * FROM ToStockpile WHERE id = '.$a.$id.$a);
			return $view->result();
		}

    function InputStockpile($data){
      $this->db->insert('Stockpile',$data);
    }

		function InputToStockpile($data){
      $this->db->insert('ToStockpile',$data);
    }

    function DeleteStockpile($id){
			$this->db->delete('Stockpile',array('id'=>$id));
		}

		function DeleteToStockpile($id){
			$this->db->delete('ToStockpile',array('id'=>$id));
		}

    function UpdateStockpile($data, $id){
			$this->db->where('id', $id);
			$this->db->update('Stockpile',$data);
		}

		function UpdateToStockpile($data,$stockpile){
			$array = array('Stockpile' => $stockpile);
			$this->db->where($array);
			$this->db->update('ToStockpile',$data);
		}

		function DeleteMultipleStockpile(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('stockpile');

		}
		}

		function GetToStockpileCalcStockpile($stockpile){
			$a = "'";
			$view = $this->db->query('SELECT * FROM ToStockpile WHERE Stockpile = '.$a.$stockpile.$a);
	    return $view->result();
		}

		function UpdateToStockpilebyStockpile($data,$stockpile){
			$array = array('Stockpile' => $stockpile);
			$this->db->where($array);
			$this->db->update('ToStockpile',$data);
		}


		function UpdateValueToStockpile($tonnes,$volume,$stockpile){
		$a="'";
		$view = $this->db->query('UPDATE tostockpile SET Tonnes ='.$a.$tonnes.$a. ', Volume ='.$a.$volume.$a. 'WHERE Stockpile ='.$a.$stockpile.$a);
	
	}

	}

?>
