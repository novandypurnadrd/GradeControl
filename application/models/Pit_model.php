<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Pit_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function GetPit(){
      $view = $this->db->get('Pit');
	    return $view->result();
		}

		function GetPitByID($id){
			$view = $this->db->get_where('Pit', array('id' => $id, ));
			return $view->result();
		}

    function InputPit($data){
      $this->db->insert('Pit',$data);
    }

    function DeletePit($id){
			$this->db->delete('Pit',array('id'=>$id));
		}

    function UpdatePit($data, $id){
			$this->db->where('id', $id);
			$this->db->update('Pit',$data);
		}

	function DeleteMultiplePit(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('pit');

	}
}

	}

?>
