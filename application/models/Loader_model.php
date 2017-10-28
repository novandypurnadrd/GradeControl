<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Loader_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function GetLoader(){
      $view = $this->db->get('Loader');
	    return $view->result();
		}

		function GetMaterial(){
     	$a = "'";
			$view = $this->db->query('SELECT DISTINCT material FROM loader');
	    return $view->result();
		}

		function GetPercentage(){
     	$a = "'";
			$view = $this->db->query('SELECT DISTINCT percentage FROM loader');
	    return $view->result();
		}

		function GetLoaderByID($id){
			$view = $this->db->get_where('Loader', array('id' => $id, ));
			return $view->result();
		}

		function GetLoaderByPit($Pit){
			$view = $this->db->get_where('Loader', array('Pit' => $Pit, ));
			return $view->result();
		}

    function InputLoader($data){
      $this->db->insert('Loader',$data);
    }

    function DeleteLoader($id){
			$this->db->delete('Loader',array('id'=>$id));
		}

		function DeleteMultipleLoader(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('loader');

	}
}

	}

?>
