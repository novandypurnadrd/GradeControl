<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Prospect_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function GetProspect(){
      $view = $this->db->get('prospect');
	    return $view->result();
		}

		function GetPitByID($id){
			$view = $this->db->get_where('Pit', array('id' => $id, ));
			return $view->result();
		}

    function InputProspect($data){
      $this->db->insert('Prospect',$data);
    }

    function DeleteProspect($id){
			$this->db->delete('prospect',array('Id'=>$id));
		}

    function UpdatePit($data, $id){
			$this->db->where('id', $id);
			$this->db->update('Pit',$data);
		}

	function DeleteMultipleProspect(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('prospect');

	}
}

	}

?>
