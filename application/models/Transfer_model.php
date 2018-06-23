<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Transfer_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		
		function InputTransfer($data){
      		$this->db->insert('transfer',$data);
    	}

   

    	function GetTransferRangeDate($Start,$End){
    		$a="'";
			$view = $this->db->query('SELECT s1.Nama as stockpile_source , s2.Nama as stockpile_destination, t.tonase_transfer, t.au_transfer, t.ag_transfer, t.aueq_transfer, t.class_transfer, t.note, t.id, t.date  FROM transfer t, stockpile s1 INNER JOIN stockpile s2 WHERE t.stockpile_source = s1.id AND t.stockpile_destination = s2.id AND Date BETWEEN ('.$a.$Start.$a.') AND ('.$a.$End.$a.') ORDER BY id DESC');
	    return $view->result();
    	}


    	function DeleteTransfer($id){
			$this->db->delete('transfer',array('id'=>$id));
		}


		function GetTransferbyId($id){
			$a="'";
			$view = $this->db->query('SELECT * FROM transfer WHERE id ='.$a.$id.$a);
	    return $view->result();
		}



	}

?>
