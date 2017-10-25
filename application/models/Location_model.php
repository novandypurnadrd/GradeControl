<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Location_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function GetLocation(){
      $view = $this->db->get('location');
	    return $view->result();
		}

		function GetPitByID($id){
			$view = $this->db->get_where('Pit', array('id' => $id, ));
			return $view->result();
		}

    function InputLocation($data){
      $this->db->insert('location',$data);
    }

    function DeleteLocation($id){
			$this->db->delete('location',array('Id'=>$id));
		}

    function UpdatePit($data, $id){
			$this->db->where('id', $id);
			$this->db->update('Pit',$data);
		}

	function DeleteMultipleLocation(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('location');

	}
}

	}

?>
