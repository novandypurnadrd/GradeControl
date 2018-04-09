<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Oreline_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function GetOreline(){
      $view = $this->db->get('oreline');
	    return $view->result();
		}

		function GetOrelineStatus(){
			$status = "Continue";
			  $d = $this->db->get_where('oreline',array('status'=>$status));
	    return $d->result();
		}

		function GetOreline2(){
      $view = $this->db->get('oreline');
	    return $view->result();
		}

		function GetOrelineByID($id){
			$view = $this->db->get_where('Oreline', array('id' => $id, ));
			return $view->result();
		}

		function GetOrelineByFile($file){
			$view = $this->db->get_where('Oreline', array('File' => $file, ));
			return $view->result();
		}

		function GetOrelineByPit($Pit){
			$view = $this->db->get_where('Oreline', array('Pit' => $Pit, ));
			return $view->result();
		}

    function InputOreline($data){
      $this->db->insert('Oreline',$data);
    }

    function DeleteOreline($id){
			$this->db->delete('Oreline',array('id'=>$id));
		}

    function UpdateOreline($data, $id){
			$this->db->where('id', $id);
			$this->db->update('Oreline',$data);
		}

	function GetBlocktoOreInventory(){
			$view = $this->db->query('SELECT ol.id, ol.pit, ol.Volume, ol.Tonnes, ol.Au, ol.Ag, ol.Aueq, ol.Class, ol.Dbdensity, ol.Partial, ol.Actual FROM oreline ol, OreInventory om WHERE ol.id <> om.Block  ');
		}

	function UpdateOrelineStatus($id,$status){
		$a="'";
		$view = $this->db->query('UPDATE oreline SET status ='.$a.$status.$a.' WHERE file = '.$a.$id.$a);
	}

	function DeleteMultipleOreline(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('oreline');

	}
}

	

	}

?>
