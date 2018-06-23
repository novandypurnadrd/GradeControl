<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class OtherSampling_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function GetGrabSample(){
     	$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location,g.Id, g.Date, g.FromGS, g.ToGS, g.TotalSample,g.Remarks FROM prospect p, location l, grabsample g WHERE g.prospect = p.Id AND g.location = l.Id');
	    return $view->result();
		}


		function GetGrabSampleRangeDate($Start, $End){
			$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, g.Id, g.Date, g.FromGS, g.ToGS, g.TotalSample, g.Remarks FROM prospect p, location l, grabsample g WHERE g.prospect = p.Id AND g.location = l.Id AND Date BETWEEN ('.$a.$Start.$a.') AND ('.$a.$End.$a.') ORDER BY id DESC');
	    	return $view->result();
		}


		function GetFaceSampleRangeDate($Start, $End){
			$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, f.id, f.Date, f.FromHoleID, F.ToHoleID, f.TotalHole, f.FromSample, f.ToSample, f.TotalSample, f.Remarks FROM prospect p, location l, facesample f WHERE f.prospect = p.Id AND f.location = l.Id AND Date BETWEEN ('.$a.$Start.$a.') AND ('.$a.$End.$a.') ORDER BY id DESC');
	    	return $view->result();
		}


		function GetAcidSampleRangeDate($Start, $End){
			$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, f.id, f.Date, f.FromHoleID, F.ToHoleID, f.TotalHole, f.FromSample, f.ToSample, f.TotalSample, f.Remarks FROM prospect p, location l, acidsample f WHERE f.prospect = p.Id AND f.location = l.Id AND Date BETWEEN ('.$a.$Start.$a.') AND ('.$a.$End.$a.') ORDER BY id DESC');
	    	return $view->result();
		}


		function GetAugerSampleRangeDate($Start, $End){
			$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, f.id, f.Date, f.FromHoleID, F.ToHoleID, f.TotalHole, f.FromSample, f.ToSample, f.TotalSample, f.Remarks FROM prospect p, location l, augersample f WHERE f.prospect = p.Id AND f.location = l.Id AND Date BETWEEN ('.$a.$Start.$a.') AND ('.$a.$End.$a.') ORDER BY id DESC');
	    	return $view->result();
		}


		function GetRCDrillingRangeDate($Start, $End){
			$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, f.id, f.Date, f.FromHoleID, F.ToHoleID, f.TotalHole, f.FromSample, f.ToSample, f.TotalSample, f.TotalMeter, f.Drill, f.Remarks FROM prospect p, location l, rcdrilling f WHERE f.prospect = p.Id AND f.location = l.Id AND Date BETWEEN ('.$a.$Start.$a.') AND ('.$a.$End.$a.') ORDER BY id DESC');
	    	return $view->result();
		}



		function GetStockpileSampleRangeDate($Start, $End){
			$a="'";
			$view = $this->db->query('SELECT * FROM stockpilesample WHERE Date BETWEEN ('.$a.$Start.$a.') AND ('.$a.$End.$a.') ORDER BY id DESC');
	    	return $view->result();
		}


		function GetGrabSampleReport($date){
			$a="'";
			$view = $this->db->query('SELECT * FROM grabsample WHERE Date='.$a.$date.$a);
	    	return $view->result();
		}

		function GetStockpileSampleReport($date){
			$a="'";
			$view = $this->db->query('SELECT * FROM stockpilesample WHERE Date='.$a.$date.$a);
	    	return $view->result();
		}

		function GetStockpileSample(){
      $view = $this->db->get('stockpilesample');
	    return $view->result();
		}

	
		function GetRCDrilling(){
     	$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, r.id, r.Date, r.FromHoleID, r.ToHoleID, r.TotalHole, r.FromSample, r.TotalSample, r.ToSample, r.Drill, r.TotalMeter,r.Remarks FROM prospect p, location l, rcdrilling r WHERE r.prospect = p.Id AND r.location = l.Id ORDER by r.Date DESC');
	    return $view->result();
		}

		function getRCDrillingReport($date){
     	$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, r.id, r.Date, r.FromHoleID, r.ToHoleID, r.TotalHole, r.FromSample, r.TotalSample, r.ToSample, r.Drill, r.TotalMeter FROM prospect p, location l, rcdrilling r WHERE r.prospect = p.Id AND r.location = l.Id AND r.Date='.$a.$date.$a);
	    return $view->result();
		}

		function getFaceSampleReport($date){
     	$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, r.id, r.Date, r.FromHoleID, r.ToHoleID, r.TotalHole, r.FromSample, r.TotalSample, r.ToSample FROM prospect p, location l, facesample r WHERE r.prospect = p.Id AND r.location = l.Id AND r.Date='.$a.$date.$a);
	    return $view->result();
		}

		function GetFaceSample(){
     	$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, r.id, r.Date, r.FromHoleID, r.ToHoleID, r.TotalHole, r.FromSample, r.TotalSample, r.ToSample,r.Remarks FROM prospect p, location l, facesample r WHERE r.prospect = p.Id AND r.location = l.Id');
	    return $view->result();
		}

		function GetAcidSample(){
     	$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, r.id, r.Date, r.FromHoleID, r.ToHoleID, r.TotalHole, r.FromSample, r.TotalSample, r.ToSample,r.Remarks FROM prospect p, location l, acidsample r WHERE r.prospect = p.Id AND r.location = l.Id');
	    return $view->result();
		}

		function getAcidSampleReport($date){
     	$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, r.id, r.Date, r.FromHoleID, r.ToHoleID, r.TotalHole, r.FromSample, r.TotalSample, r.ToSample FROM prospect p, location l, acidsample r WHERE r.prospect = p.Id AND r.location = l.Id AND r.Date='.$a.$date.$a);
	    return $view->result();
		}

		function GetAugerSample(){
     	$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, r.id, r.Date, r.FromHoleID, r.ToHoleID, r.TotalHole, r.FromSample, r.TotalSample, r.ToSample,r.Remarks FROM prospect p, location l, augersample r WHERE r.prospect = p.Id AND r.location = l.Id ORDER by r.Date DESC');
	    return $view->result();
		}

		function getAugerSampleReport($date){
     	$a="'";
			$view = $this->db->query('SELECT p.Nama as Prospect , l.Nama as Location, r.id, r.Date, r.FromHoleID, r.ToHoleID, r.TotalHole, r.FromSample, r.TotalSample, r.ToSample FROM prospect p, location l, augersample r WHERE r.prospect = p.Id AND r.location = l.Id AND r.Date='.$a.$date.$a);
	    return $view->result();
		}

    function InputGrabSample($data){
      $this->db->insert('grabsample',$data);
    }

     function InputRCDrilling($data){
      $this->db->insert('rcdrilling',$data);
    }

    function InputFaceSample($data){
      $this->db->insert('facesample',$data);
    }

    function InputAcidSample($data){
      $this->db->insert('acidsample',$data);
    }

    function InputAugerSample($data){
      $this->db->insert('augersample',$data);
    }


    function DeleteGrabSample($id){
			$this->db->delete('grabsample',array('Id'=>$id));
		}

	 function DeleteStockpileSample($id){
			$this->db->delete('stockpilesample',array('id'=>$id));
		}

	function DeleteRCDrilling($id){
			$this->db->delete('rcdrilling',array('id'=>$id));
		}

	function DeleteFaceSample($id){
			$this->db->delete('facesample',array('id'=>$id));
		}

	function DeleteAcidSample($id){
			$this->db->delete('acidsample',array('id'=>$id));
		}

	function DeleteAugerSample($id){
			$this->db->delete('augersample',array('id'=>$id));
		}



    function UpdateClosingStock($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ClosingStock',$data);
		}

	function UpdateClosingStockByDate($Closing,$Stockpile,$Date){
			$this->db->where('Stockpile', $Stockpile);
			$this->db->where('Date', $Date);
			$this->db->update('ClosingStock',$Closing);
		}

	function InputStockpileSample($data){
		$this->db->insert('stockpilesample',$data);
	}

	function DeleteMultipleAcidSample(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('acidsample');

	}
}

	function DeleteMultipleAugerSample(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('augersample');

	}
}

function DeleteMultipleFaceSample(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('facesample');

	}
}

function DeleteMultipleGrabSample(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('grabsample');

	}
}

function DeleteMultipleRCDrilling(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('rcdrilling');

	}
}

function DeleteMultipleStockpileSample(){
		$delete = $this->input->post('msg');
		for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id', $delete[$i]);
				$this->db->delete('stockpilesample');

	}
}


}


?>
