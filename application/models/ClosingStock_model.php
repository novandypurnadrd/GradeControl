<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class ClosingStock_model extends CI_Model {

		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function GetClosingStock(){
      $view = $this->db->get('ClosingStock');
	    return $view->result();
		}

		function GetScat(){
      $view = $this->db->get('Scat');
	    return $view->result();
		}

		function GetBoulder(){
      $view = $this->db->get('Boulder');
	    return $view->result();
		}


		function GetClosingStockByStockpile($Stockpile){
			$a="'";
			$view = $this->db->query('SELECT * FROM ClosingStock WHERE Stockpile ='.$a.$Stockpile.$a.' ORDER BY id DESC limit 1');
	    return $view->result();
		}

		function GetClosingStockByStockpileandDate($Stockpile,$Date){
				$a="'";
			$view = $this->db->query('SELECT * FROM ClosingStock WHERE Stockpile ='.$a.$Stockpile.$a.' AND Date='.$a.$Date.$a.' ORDER BY id DESC');
	    return $view->result();
		}

		function GetClosingStockByStockpileandDateGrade($Stockpile,$Date){
				$a="'";
			$view = $this->db->query('SELECT * FROM closingstockgrade WHERE Stockpile ='.$a.$Stockpile.$a.' AND Date >='.$a.$Date.$a.' ORDER BY id DESC');
	    return $view->result();
		}

		function GetClosingStockByStockpileandDateGradeAll($Stockpile,$Dateblock,$date){
				$a="'";
			$view = $this->db->query('SELECT * FROM closingstockgrade WHERE Stockpile ='.$a.$Stockpile.$a.' AND Date BETWEEN ('.$a.$Dateblock.$a.') AND ('.$a.$date.$a.') ORDER BY id DESC');
	    return $view->result();
		}

		function GetClosingStockByStockpileGrade($Stockpile){
				$a="'";
			$view = $this->db->query('SELECT * FROM closingstockgrade WHERE Stockpile ='.$a.$Stockpile.$a.' ORDER BY id DESC limit 1');
	    return $view->result();
		}

		function GetClosingStockGradeByStockpileandDate($Stockpile,$Date){
				$a="'";
			$view = $this->db->query('SELECT * FROM closingstockgrade WHERE Stockpile ='.$a.$Stockpile.$a.' AND Date = '.$a.$Date.$a.' ORDER BY id DESC limit 1');
	    return $view->result();
		}
		
		

		function GetClosingStockByIDForDel($id){
			$a="'";
			$view = $this->db->query('SELECT * FROM ClosingStock WHERE id ='.$a.$id.$a);
	    return $view->result();
		}

		function getScatbyId($id){
			$a="'";
			$view = $this->db->query('SELECT * FROM Scat WHERE id ='.$a.$id.$a);
	    return $view->result();
		}

		function getBoulderbyId($id){
			$a="'";
			$view = $this->db->query('SELECT * FROM Boulder WHERE id ='.$a.$id.$a);
	    return $view->result();
		}

		// function GetClosingStockByDate($Date){
		// 	$a="'";
		// 	$status="Complete";
		// 	$view = $this->db->query('SELECT om.Date as tanggal,om.Volume as Volume,om.Tonnes as Tonnes,om.AuEq75 as AuEq75,om.Class as Class,om.id, om.Status, ol.Au as AuBM, ol.Ag as AgBM, om.Au, om.Ag, om.Density, oi.Au as AuFF, oi.Ag as AgFF, oi.RL,
		// 														ol.Actual as DryTonBM, oi.DryTonFF, ol.Dbdensity, s.Nama as Stockpile, p.Nama as Pit, s.id as idStockpile
		// 														FROM oreline ol, ClosingStock om, oreinventory oi, pit p, stockpile s
		// 														WHERE om.Stockpile = s.id AND om.Date ='.$a.$Date.$a.' AND om.Status ='.$a.$status.$a);
	 //    return $view->result();
		// }

		function GetClosingStockByDate($Date){
			$a="'";
			$view = $this->db->query('SELECT om.Date as tanggal,om.Volume as Volume,om.Tonnes as Tonnes,om.AuEq75 as AuEq75,om.Class as Class,om.id, om.Status, om.Au, om.Ag, om.Density as DryTonBM,om.Density as Density, s.Nama as Stockpile, s.id as idStockpile
																FROM  ClosingStock om, stockpile s
																WHERE om.Stockpile = s.id AND om.Date ='.$a.$Date.$a);
	    return $view->result();
		}



		function GetClosingStockTonnes($Stockpile,$Date){
			$a="'";
			$view = $this->db->query('SELECT * FROM ClosingStock WHERE Stockpile ='.$a.$Stockpile.$a.' AND Date='.$a.$Date.$a);
	    return $view->result();
		}

		function GetClosingStockTonnesStockpileNew($Stockpile){
			$a="'";
			$view = $this->db->query('SELECT * FROM ClosingStock WHERE Stockpile ='.$a.$Stockpile.$a);
	    return $view->result();
		}


    function InputClosingStock($data){
      $this->db->insert('ClosingStock',$data);
    }

    function InputClosingStockGrade($data){
      $this->db->insert('closingstockgrade',$data);
    }

    function DeleteClosingStock($id){
			$this->db->delete('ClosingStock',array('id'=>$id));
		}

	 function DeleteScat($id){
			$this->db->delete('Scat',array('id'=>$id));
		}

		function DeleteBoulder($id){
			$this->db->delete('Boulder',array('id'=>$id));
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

	function UpdateClosingStockByDateGrade($Closing,$Stockpile,$Date){
			$this->db->where('Stockpile', $Stockpile);
			$this->db->where('Date', $Date);
			$this->db->update('closingstockgrade',$Closing);
		}

	function UpdateClosingStockGrade($data, $id){
			$this->db->where('id', $id);
			$this->db->update('closingstockgrade',$data);
		}

	function UpdateClosingStockByStockpileGrade($Closing,$Stockpile){
			$this->db->where('Stockpile', $Stockpile);
			$this->db->update('closingstockgrade',$Closing);
		}

	function UpdateClosingStockByStockpile($Closing,$Stockpile){
			$this->db->where('Stockpile', $Stockpile);
			$this->db->update('ClosingStock',$Closing);
		}

	function UpdateScat($Scat,$Id){
			$this->db->where('Id', $Id);
			$this->db->update('scat',$Scat);
		}

	function UpdateBoulder($Boulder,$Id){
			$this->db->where('Id', $Id);
			$this->db->update('boulder',$Boulder);
		}

	function InputScat($Scat){
		$this->db->insert('Scat',$Scat);
	}


	function InputBoulder($Boulder){
		$this->db->insert('Boulder',$Boulder);
	}

	function GetClosingStockDashboard($Date){
		$a="'";
		$sum = $this->db->query('SELECT SUM(Tonnes) as SumTon FROM Closingstock WHERE Date='.$a.$Date.$a);
		return $sum->row()->SumTon;
	}


	function GetClosingStockRompadDashboard($Date){
			$a="'";
			$sum = $this->db->query('SELECT SUM(c.Tonnes) as SumTon FROM stockpile s , closingstockgrade AS c WHERE c.date = (
    				SELECT MAX(c2.date)
    				FROM closingstockgrade AS c2
    				WHERE c.stockpile = c2.stockpile AND c2.date <= '.$a.$Date.$a.'
      				) AND s.id = c.stockpile AND Stockpile != 20 AND Stockpile != 22 AND Stockpile != 23 ORDER BY s.id ASC');
	    	return $sum->row()->SumTon;
		}

	function GetOpenStockDashboard($Date){
		$a="'";
		$sum = $this->db->query('SELECT SUM(Tonnes) as SumTon FROM Closingstock WHERE Date='.$a.$Date.$a);
		return $sum->row()->SumTon;
	}

	function GetOpeningStockRompadDashboard($Date){
			$a="'";
				$sum = $this->db->query('SELECT SUM(c.Tonnes) as SumTon FROM stockpile s , closingstockgrade AS c WHERE c.date = (
    				SELECT MAX(c2.date)
    				FROM closingstockgrade AS c2
    				WHERE c.stockpile = c2.stockpile AND c2.date < '.$a.$Date.$a.'
      				) AND s.id = c.stockpile AND Stockpile != 20 AND Stockpile != 22 AND Stockpile != 23 ORDER BY s.id ASC');
	    	return $sum->row()->SumTon;
		}

	function GetOpenStockReport($Date){
			$a="'";
			$view = $this->db->query('SELECT * FROM ClosingStock WHERE Date='.$a.$Date.$a);
	    	return $view->result();
		}

	function GetOpeningStockRompad($Date){
			$a="'";
			$view = $this->db->query('SELECT * FROM ClosingStock WHERE Date<'.$a.$Date.$a.'AND Stockpile != 20 AND Stockpile != 22 AND Stockpile != 23');
	    	return $view->result();
		}

	function GetOpeningStockRompadNew($Date){
			$a="'";
				$view = $this->db->query('SELECT c.Date, c.Tonnes as Tonnes, c.AuEq75 as AuEq75, c.Class as Class, c.id, c.Status, c.Au, c.Ag, s.Nama as Stockpile, s.id as idStockpile FROM stockpile s , closingstockgrade AS c WHERE c.date = (
    				SELECT MAX(c2.date)
    				FROM closingstockgrade AS c2
    				WHERE c.stockpile = c2.stockpile AND c2.date < '.$a.$Date.$a.'
      				) AND s.id = c.stockpile AND Stockpile != 20 AND Stockpile != 22 AND Stockpile != 23 ORDER BY s.id ASC');
	    	return $view->result();
		}

	function GetClosingStockReport($Date){
			$a="'";
			$view = $this->db->query('SELECT * FROM ClosingStock WHERE Date<='.$a.$Date.$a.' AND Stockpile != 20 AND Stockpile != 22 AND Stockpile != 23');
	    	return $view->result();
		}

	function GetClosingStockRompadNew($Date){
			$a="'";
			$view = $this->db->query('SELECT c.Date, c.Tonnes as Tonnes, c.AuEq75 as AuEq75, c.Class as Class, c.id, c.Status, c.Au, c.Ag, s.Nama as Stockpile, s.id as idStockpile FROM stockpile s , closingstockgrade AS c WHERE c.date = (
    				SELECT MAX(c2.date)
    				FROM closingstockgrade AS c2
    				WHERE c.stockpile = c2.stockpile AND c2.date <= '.$a.$Date.$a.'
      				) AND s.id = c.stockpile AND Stockpile != 20 AND Stockpile != 22 AND Stockpile != 23 ORDER BY s.id ASC');
	    	return $view->result();
		}

	function GetScatTonnes($Date){
			$a="'";
			$view = $this->db->query('SELECT * FROM Scat WHERE Date='.$a.$Date.$a);
	    	return $view->result();
	}

	function GetScatTonnesReport($Date,$Stockpile){
			$a="'";
			$view = $this->db->query('SELECT * FROM orefeed WHERE Date='.$a.$Date.$a.' AND Stockpile='.$a.$Stockpile.$a);
	    	return $view->result();
	}

	function GetBoulderTonnes($Date){
			$a="'";
			$view = $this->db->query('SELECT * FROM Boulder WHERE Date='.$a.$Date.$a);
	    	return $view->result();
	}

	function GetBoulderTonnesReport($Date,$Stockpile){
			$a="'";
			$view = $this->db->query('SELECT * FROM orefeed WHERE Date='.$a.$Date.$a.' AND Stockpile='.$a.$Stockpile.$a);
	    	return $view->result();
	}


	function GetClosingStockTonnesStockpile($Stockpile){
		$a="'";
			$view = $this->db->query('SELECT * FROM ClosingStock WHERE Stockpile ='.$a.$Stockpile.$a);
	    return $view->result();
	}


	function GetClosingStockByStockpileTable($stockpile){
		$a="'";
			$view = $this->db->query('SELECT om.Date,om.Volume as Volume,om.Tonnes as Tonnes,om.AuEq75 as AuEq75,om.Class as Class,om.id, om.Status, om.Au, om.Ag, om.Density as DryTonBM,om.Density as Density, s.Nama as Stockpile, s.id as idStockpile
																FROM  ClosingStock om, stockpile s
																WHERE om.Stockpile = s.id AND om.Stockpile ='.$a.$stockpile.$a.'ORDER by Date');
	    return $view->result();
	}

	function GetClosingStockByStockpileandDateTable($stockpile,$date){
		$a="'";

		if($stockpile == "All"){

			$view = $this->db->query('SELECT om.Date,om.Volume as Volume,om.Tonnes as Tonnes,om.AuEq75 as AuEq75,om.Class as Class,om.id, om.Status, om.Au, om.Ag, om.Density as DryTonBM,om.Density as Density, s.Nama as Stockpile, s.id as idStockpile
																FROM  ClosingStock om, stockpile s
																WHERE om.Stockpile = s.id AND om.Date <='.$a.$date.$a.'Order by Date');

		}else{

			$view = $this->db->query('SELECT om.Date,om.Volume as Volume,om.Tonnes as Tonnes,om.AuEq75 as AuEq75,om.Class as Class,om.id, om.Status, om.Au, om.Ag, om.Density as DryTonBM,om.Density as Density, s.Nama as Stockpile, s.id as idStockpile
																FROM  ClosingStock om, stockpile s
																WHERE om.Stockpile = s.id AND om.Stockpile ='.$a.$stockpile.$a.' AND Date<='.$a.$date.$a.'Order by Date');
		}

		
	    return $view->result();
	}


	function GetClosingStockGradeByStockpileandDateTable($stockpile,$date){
		$a="'";

		if($stockpile == "All"){

			$view = $this->db->query('SELECT om.Date,om.Tonnes as Tonnes,om.AuEq75 as AuEq75,om.Class as Class,om.id, om.Status, om.Au, om.Ag, s.Nama as Stockpile, s.id as idStockpile
																FROM  closingstockgrade om, stockpile s
																WHERE om.Stockpile = s.id AND om.Date ='.$a.$date.$a.'Order by Date');

		}else{

			$view = $this->db->query('SELECT om.Date,om.Tonnes as Tonnes,om.AuEq75 as AuEq75,om.Class as Class,om.id, om.Status, om.Au, om.Ag,  s.Nama as Stockpile, s.id as idStockpile
																FROM  closingstockgrade om, stockpile s
																WHERE om.Stockpile = s.id AND om.Stockpile ='.$a.$stockpile.$a.' AND Date='.$a.$date.$a.'Order by Date');
		}

		
	    return $view->result();
	}

	function GetClosingStockIndex(){
			$a="'";
			$view = $this->db->query('SELECT om.Date,om.Volume as Volume,om.Tonnes as Tonnes,om.AuEq75 as AuEq75,om.Class as Class,om.id, om.Status, om.Au, om.Ag, om.Density as DryTonBM,om.Density as Density, s.Nama as Stockpile, s.id as idStockpile
																FROM  ClosingStock om, stockpile s
																WHERE om.Stockpile = s.id Order by om.Date DESC');
	    return $view->result();
	}

	function GetGrade($Stockpile,$Date){
		$a="'";
			$view = $this->db->query('SELECT * FROM closingstockgrade WHERE stockpile ='.$a.$Stockpile.$a.' AND date >='.$a.$Date.$a);
	    return $view->result();
	}

	function GetClosingstockgradesamedate($Stockpile,$Date){
		$a="'";
			$view = $this->db->query('SELECT * FROM closingstockgrade WHERE stockpile ='.$a.$Stockpile.$a.' AND date ='.$a.$Date.$a);
	    return $view->result();
	}

		function GetGradeStockpile($Stockpile){
		$a="'";
			$view = $this->db->query('SELECT * FROM closingstockgrade WHERE stockpile ='.$a.$Stockpile.$a.'ORDER by id asc limit 1');
	    return $view->result();
	}


		function GetStockpilebyName($name){
		$a="'";
			$view = $this->db->query('SELECT id FROM stockpile WHERE Nama ='.$a.$name.$a.'ORDER by id asc limit 1');
	    return $view->result();
	}


	function GetGradeStockpileScat(){
		$a="'";
			$view = $this->db->query('SELECT * FROM scat ORDER by id asc limit 1');
	    return $view->result();
	}


	function GetClosingStockGradeByStockpileandDateTableLast($stockpile,$date){
		$a="'";

		if($stockpile == "All"){

			$view = $this->db->query('SELECT c.Date, c.Tonnes as Tonnes, c.AuEq75 as AuEq75, c.Class as Class, c.id, c.Status, c.Au, c.Ag, s.Nama as Stockpile, s.id as idStockpile FROM stockpile s , closingstockgrade AS c WHERE c.date = (
    				SELECT MAX(c2.date)
    				FROM closingstockgrade AS c2
    				WHERE c.stockpile = c2.stockpile AND c2.date <= '.$a.$date.$a.'
      				) AND s.id = c.stockpile  ORDER BY s.id ASC');

		}else{

			$view = $this->db->query('SELECT om.Date,om.Tonnes as Tonnes,om.AuEq75 as AuEq75,om.Class as Class,om.id, om.Status, om.Au, om.Ag,  s.Nama as Stockpile, s.id as idStockpile
																FROM  closingstockgrade om, stockpile s
																WHERE om.Stockpile = s.id AND om.Stockpile ='.$a.$stockpile.$a.' AND Date <='.$a.$date.$a.'Order by Date desc limit 1');
		}

		
	    return $view->result();
	}


	function GetClosingstockUptodate($date){
		$a="'";

			$view = $this->db->query('SELECT c.Date, c.Tonnes as Tonnes, c.AuEq75 as AuEq75, .Class as Class, om.id, om.Status, om.Au, om.Ag, s.Nama as Stockpile, s.id as idStockpile FROM closingstockgrade c inner join closingstockgrade c2 ON c2.stockpile = c.stockpile WHERE ((l.date) BETWEEN ('.$a.$start.$a.') AND ('.$a.$finish.$a.') AND l.hole_id = l2.hole_id AND l2.form < l.t_o) OR ((l.date) BETWEEN ('.$a.$start.$a.') AND ('.$a.$finish.$a.')  AND l.t_o <= l.form) order by l.id');
      return $view->result();

}


	function UpdateValueClosingstock($tonnes,$volume,$stockpile){
		$a="'";
		$view = $this->db->query('UPDATE closingstock SET Tonnes ='.$a.$tonnes.$a. ', Volume ='.$a.$volume.$a. 'WHERE Stockpile ='.$a.$stockpile.$a);
	
	}

	function UpdateValueClosingstockNull($tonnes,$volume,$stockpile,$au,$ag,$aueq,$class,$density){
		$a="'";
		$view = $this->db->query('UPDATE closingstock SET Tonnes ='.$a.$tonnes.$a. ', Volume ='.$a.$volume.$a. ', Au ='.$a.$au.$a.', Ag ='.$a.$ag.$a.', AuEq75='.$a.$aueq.$a.', Class='.$a.$class.$a.', Density='.$a.$density.$a.' WHERE Stockpile ='.$a.$stockpile.$a);
	
	}


	function UpdateValueClosingstockGrade($tonnes,$volume,$id){
		$a="'";
		$view = $this->db->query('UPDATE closingstockgrade SET Tonnes ='.$a.$tonnes.$a. ', Volume ='.$a.$volume.$a. 'WHERE id ='.$a.$id.$a);
	
	}


	function UpdateValueClosingstockGradeNull($tonnes,$volume,$id,$au,$ag,$aueq,$class,$density){
		$a="'";
		$view = $this->db->query('UPDATE closingstockgrade SET Tonnes ='.$a.$tonnes.$a. ', Volume ='.$a.$volume.$a. ', Au ='.$a.$au.$a.', Ag ='.$a.$ag.$a.', AuEq75='.$a.$aueq.$a.', Class='.$a.$class.$a.', Density='.$a.$density.$a.' WHERE id ='.$a.$id.$a);
	
	}


	function GetScatbyDate($Start,$End){
				$a="'";
			$view = $this->db->query('SELECT * FROM scat WHERE Date BETWEEN ('.$a.$Start.$a.') AND ('.$a.$End.$a.') ORDER BY id DESC');
	    return $view->result();
		}


	function GetBoulderbyDate($Start,$End){
				$a="'";
			$view = $this->db->query('SELECT * FROM boulder WHERE Date BETWEEN ('.$a.$Start.$a.') AND ('.$a.$End.$a.') ORDER BY id DESC');
	    return $view->result();
		}


}


?>
