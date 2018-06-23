<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class BlendingPlan_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		
		function InsertBlendingPlan($data){
      		$this->db->insert('blendingplan',$data);
    	}

    	function UpdateValue($data,$id){
    		
			$this->db->where('id', $id);
			$this->db->update('blendingplan',$data);
	
    	}

    	function GetBlendingToday($date){
    		
    		$a="'";
			$view = $this->db->query('SELECT * FROM blendingplan WHERE Date ='.$a.$date.$a);
			return $view->result();
    	}

   

    	function GetBlendingRecord($Start,$End){
    		$a="'";
			$view = $this->db->query('SELECT * FROM blendingplan WHERE Date BETWEEN ('.$a.$Start.$a.') AND ('.$a.$End.$a.') ORDER BY Date DESC');
	    return $view->result();
    	}


    	function DeleteTransfer($id){
			$this->db->delete('transfer',array('id'=>$id));
		}


		function GetBlendingbyId($id){
			$a="'";
			$view = $this->db->query('SELECT * FROM blendingplan WHERE id ='.$a.$id.$a);
	    return $view->result();
		}


		 function DeleteBlending($id){
			$this->db->delete('blendingplan',array('id'=>$id));
		}


		function DeleteMultipleBlending(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('blendingplan');

	}
}



	}

?>
