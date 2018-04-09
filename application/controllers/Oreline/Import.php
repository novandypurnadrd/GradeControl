
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {

	public function Import(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('User_model');
    $this->load->model('Oreline_model');
		$this->load->model('Pit_model');
		$this->load->library('session');
		$this->load->library('Excel');
	}

	public function Index(){
    if ($this->session->userdata('GradeControl')) {
				$data['main'] = "ImportOreline";
        $data['Pit'] = $this->Pit_model->getPit();
        $data['msg'] = "";
		    $this->load->view('Oreline/Import', $data);
    }else {
      redirect(base_url());
    }
	}

	public function ImportOreline()
	{
    if ($this->session->userdata('GradeControl')) {


				$fileName = time().$_FILES['file']['name'];

        $config['upload_path'] = './excel/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(! $this->upload->do_upload('file') ){
					$data['main'] = "ImportOreline";
          $data['Pit'] = $this->Pit_model->getPit();
					$this->load->view('Oreline/Import', $data);
				}else {
					$media = $this->upload->data('file');
	        		$inputFileName = './excel/'.$fileName;

	        try {
	                $inputFileType = IOFactory::identify($inputFileName);
	                $objReader = IOFactory::createReader($inputFileType);
	                $objPHPExcel = $objReader->load($inputFileName);
	            } catch(Exception $e) {
	                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	            }

	            $sheet = $objPHPExcel->getSheet(0);
	            $highestRow = $sheet->getHighestRow();
	            $highestColumn = $sheet->getHighestColumn();

	            $File = explode('.', $_FILES['file']['name'])[0];
	            $CheckDuplicate = $this->Oreline_model->GetOrelineByFile($File);

	            if($CheckDuplicate){
	            	$data['msg'] = "Oreline already Input in Database";
	            }
	            else{
	            	for ($row = 17; $row <= 17; $row++){                  //  Read a row of data into an array
	                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
	                                                NULL,
	                                                TRUE,
	                                                FALSE);


									$Au = $rowData[0][2];
									$Ag = $rowData[0][3];
									$Grade = $Au + ($Ag/75);

									if ($Grade < 0.65) {
										$Class = "Waste";
									}
									elseif ($Grade >= 0.65 && $Grade < 2.00) {
										$Class = "Marginal";
									}
									elseif ($Grade >= 2.00 && $Grade < 4.00) {
										$Class = "Mid Grade";
									}
									elseif ($Grade >= 4.00 && $Grade <= 6.00) {
										$Class = "High Grade";
									}
									elseif ($Grade > 6.00) {
										$Class = "SHG";
									}

	                // Sesuaikan sama nama kolom tabel di database
	                 $data = array(
                     'File' => explode('.', $_FILES['file']['name'])[0],
                     'Pit' => $this->input->post('Pit'),
                     'Volume' => round($rowData[0][0],2),
                     'Tonnes' => round($rowData[0][1],2),
                     'Au' => round($rowData[0][2],2),
                     'Ag' => round($rowData[0][3],2),
					 'Aueq' => round($rowData[0][4],2),
                     'Class' => $Class,
                     'Dbdensity' => $rowData[0][5],
					 'Partial' => $rowData[0][6],
                     'Actual' => round($rowData[0][1] * $rowData[0][6],2),
                     'Status' => "Continue",
 					 'usrid' => $this->session->userdata('usernameGradeControl'),
	                );

	                //sesuaikan nama dengan nama tabel
	                $this->Oreline_model->InputOreline($data);
	                $data['msg'] = "Succes Import to Database";
	            }


	            }
	            			$data['main'] = "ImportOreline";
    						$data['Pit'] = $this->Pit_model->getPit();
							$this->load->helper('file');
							unlink($inputFileName);
							$this->load->view('Oreline/Import', $data);
							//redirect('Oreline/Import');
				}
		}
		else {
			redirect(base_url());
		}
	}

}
?>
