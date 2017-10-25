
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DailyReport extends CI_Controller {

    public function DailyReport(){
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model('Oremined_model');
        $this->load->model('ClosingStock_model');
        $this->load->model('OreInventory_model');
        $this->load->model('Stockpile_model');
        $this->load->model('Orefeed_model');
        $this->load->model('OtherSampling_model');
        $this->load->library('session');
        $this->load->library('Excel');
    }

    public function Index(){
   
    if ($this->session->userdata('GradeControl')) {
                $data['main'] = "DailyReport";
                $data['date'] = '';
                $this->load->view('Report/DailyReport', $data);
    }else {
      redirect(base_url());
    }
    }

    public function PrintExcell()
    {
    if ($this->session->userdata('GradeControl')) {

            $filterdate = $this->input->post('Date');
            $date = explode('/',$filterdate)[2].'-'.explode('/',$filterdate)[0].'-'.explode('/',$filterdate)[1];
            $ClosingStockdate = date('Y-m-d', strtotime('-1 day', strtotime($date)));
            $OpeningStockdate = date('Y-m-d', strtotime('-2 day', strtotime($date)));

       
            $tgl = date("d-F-Y", strtotime($date));

            $Oremine = $this->OreInventory_model->GetOreinventoryByDate($date);

            $OremineDistinct = $this->OreInventory_model->GetOreInventoryByDateDistinct($date);

            $RomMined = $this->OreInventory_model->getRomMined($date);

            $Marginal = $this->OreInventory_model->getMarginal($date);

            $Stockstatus = $this->Stockpile_model->GetStockpileByDate($date);

            $ListStockpile = $this->Stockpile_model->StockpileDistinct();

            //$Openingstock = $this->ClosingStock_model->GetOpenStockReport($ClosingStockdate);

            $Closingstock = $this->ClosingStock_model->GetClosingStockReport($date);

            $Orefeedtocrusher = $this->Orefeed_model->GetOrefeedtocrusher($date);

            $OpeningstockOremine = $this->OreInventory_model->GetOreinventoryByDate($ClosingStockdate);
           
            $OpeningstockOremineOld = $this->OreInventory_model->GetOreinventoryByDate($OpeningStockdate);

            $OpeningstockOrefeed = $this->Orefeed_model->GetOrefeedtocrusher($ClosingStockdate);
            $OpeningstockOreFeedOld = $this->Orefeed_model->GetOrefeedtocrusher($OpeningStockdate);

            $ClosingstockOremine = $this->OreInventory_model->GetOreinventoryByDate($date);
            $ClosingstockOrefeed = $this->Orefeed_model->GetOrefeedtocrusher($date);



            $Fresh = $this->Orefeed_model->SumFreshbyDate($date);
            if ($Fresh == 0){
                $Fresh =0;
            }
            $Bypass = $this->Orefeed_model->SumBypassbyDate($date);
            if ($Bypass == 0){
                $Bypass =0;
            }
            $Transition = $this->Orefeed_model->SumTransisibyDate($date);
            if ($Transition == 0){
                $Transition =0;
            }
            $Clay = $this->Orefeed_model->SumClaybyDate($date);
            if ($Clay == 0){
                $Clay =0;
            }
            $Clayfull = $this->Orefeed_model->SumClayfullbyDate($date);
            if ($Clayfull == 0){
                $Clayfull =0;
            }
            $Sumton = $Fresh+$Bypass+$Transition+$Clay+$Clayfull;
           
            
            if($Sumton == 0){
                $PersenFresh ='0'.'%';
                $PersenTransition='0'.'%';
                $PersenClay='0'.'%';
            }
            else{
                $PersenFresh = round((($Fresh+$Bypass)/$Sumton)*100,2).'%';
                $PersenTransition = round(($Transition/$Sumton)*100,2).'%';
                $PersenClay = round((($Clay+$Clayfull)/$Sumton)*100,2).'%';
            }
           

                $style_table_header = array(
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
          ),
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN,
            ),
          ),
          'font' => array(
            'bold' => true,
          ),
                    'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'f4bc42')
            )
        );
                $style_header = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ),
                    'borders' => array(
                      'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                      ),
                    ),
                    'font' => array(
                      'bold' => true,
                    ),
                            // 'fill' => array(
                //       'type' => PHPExcel_Style_Fill::FILL_SOLID,
                //       'color' => array('rgb' => '636261')
                    //)
                  );
                $style_subheader = array(
                    'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_BOTTOM,
          ),'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                                ),
                            ),'font' => array(
                                'bold' => true,
                            ),
                        );
                $style_subsubheader = array(
                    'borders' => array(
                      'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                      ),
            ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_BOTTOM,
                    ),'font' => array(
                                'color' => array('rgb' => 'f44242'),
                            ),
                );
                $style_program = array(
                            'font' => array(
                                'color' => array('rgb' => '425cf4'),
                            ),
                        );

                $style_bold =array('alignment' => array(
                             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                             'vertical' => PHPExcel_Style_Alignment::VERTICAL_BOTTOM,
                            ),
                                'font' => array(
                                'bold' => true,
                            ),
                );

            $style_table = array(
                  'borders' => array(
                    'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN,
                          ),
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_BOTTOM,
                          ),
            );
                $footer = array(
                  'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                  ),
                            'borders' => array(
                      'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                      ),
                    ),
                    'font' => array(
                      'bold' => true,
                    ),
                            'fill' => array(
                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
                      'color' => array('rgb' => 'f4bc42')
                    )
                );

                $this->excel->getDefaultStyle()->getFont()->setName('Calibri');
                $this->excel->getDefaultStyle()->getFont()->setSize(11);

                //Tampilkan Data
                                $this->excel->setActiveSheetIndex(0);

                    $this->excel->getActiveSheet()->setCellValue('A1', 'DAILY REPORT - GRADE CONTROL');
                    $this->excel->getActiveSheet()->mergeCells('A1:D1');
                $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_header);
                $this->excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_header);
                $this->excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_header);
                $this->excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_header);
                    $this->excel->getActiveSheet()->setCellValue('A2', 'Date');
                    $this->excel->getActiveSheet()->mergeCells('B2:D2');
                    $this->excel->getActiveSheet()->setCellValue('B2', $tgl);
                $this->excel->getActiveSheet()->getStyle('A2')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('B2')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('C2')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('D2')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('A4', 'OreMined');
                    $this->excel->getActiveSheet()->mergeCells('A4:B4');
                $this->excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('C4', 'DAILY');
                    $this->excel->getActiveSheet()->mergeCells('C4:G4');
                $this->excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('H4')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('C5', 'To Stockpile');
                $this->excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('D5', 'Dry Ton');
                $this->excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('E5', 'Au(g/t)');
                $this->excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('F5', 'Ag(g/t)');
                $this->excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('G5', 'AuEq75');
                $this->excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('H5', 'Pit');
                $this->excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_subheader);
        
                $row = 6;
                
                    $TonnesMined=0;
                    $Au =0;
                    $Ag=0;
                    $v_Au = 0;
                    $v_Ag = 0;

                    $RomMinedTonnes = 0;
                    $RomMinedAu = 0;
                    $RomMinedAg = 0;

                    $MarginalTonnes = 0;
                    $MarginalAu = 0;
                    $MarginalAg = 0;


                    foreach ($ListStockpile as $ls) {
                        
                        $OreminebyStockpile = $this->OreInventory_model->GetOreInventorybyStockpile($date,$ls->id);

                        $TonnesMined=0;
                        $Au =0;
                        $Ag=0;

                        if($OreminebyStockpile != null){


                        foreach ($OreminebyStockpile as $oremine) {

                            $TonnesMined = $TonnesMined+$oremine->DryTonFF;
                            $Au = $Au+(($oremine->Au)*($oremine->DryTonFF));
                            $Ag = $Ag+(($oremine->Ag)*($oremine->DryTonFF));

                        }

                         if($TonnesMined == 0){
                        $Au = 0;
                        $Ag = 0;
                    }else{
                        $TonnesMined = round($TonnesMined,2);
                        $Au = round($Au/$TonnesMined,2);
                        $Ag = round($Ag/$TonnesMined,2);
                        $AuEq75 = round(($Au+($Ag/75)),2);

                        $v_Au = $v_Au + ($Au*$TonnesMined);
                        $v_Ag = $v_Ag + ($Ag*$TonnesMined);



                        if($AuEq75 >= 2){
                            $RomMinedTonnes = $RomMinedTonnes + $TonnesMined;
                            $RomMinedAu = $RomMinedAu + ($Au * $TonnesMined);
                            $RomMinedAg = $RomMinedAg + ($Ag * $TonnesMined);

                        }
                        else{
                            $MarginalTonnes = $MarginalTonnes + $TonnesMined;
                            $MarginalAu = $MarginalAu + ($Au * $TonnesMined);
                            $MarginalAg = $MarginalAg + ($Ag * $TonnesMined);
                        }
                    }
                    
                     $this->excel->getActiveSheet()->setCellValue('C'.$row, $oremine->Stockpile);
                $this->excel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('D'.$row, $TonnesMined);
                $this->excel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('E'.$row, $Au);
                $this->excel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('F'.$row, $Ag);
                $this->excel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('G'.$row, $AuEq75);
                $this->excel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('H'.$row, $oremine->Pit);
                $this->excel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($style_table);
                                        
                    $row++;

                        }
                        else{
                             $this->excel->getActiveSheet()->setCellValue('C'.$row, $ls->Nama);
                $this->excel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('D'.$row, '-');
                $this->excel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('E'.$row, '-');
                $this->excel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('F'.$row, '-');
                $this->excel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('G'.$row, '-');
                $this->excel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('H'.$row, '-');
                $this->excel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($style_table);
                                        
                    $row++;
                        }

                }




                // foreach($OremineDistinct as $oremine){

                //     // $TonnesMined = $TonnesMined+$oremine->DryTonFF;
                //     // $Au = $Au+(($oremine->Au)*($oremine->DryTonFF));
                //     // $Ag = $Ag+(($oremine->Ag)*($oremine->DryTonFF));


                //     $TonnesMined=0;
                //     $Au =0;
                //     $Ag=0;

                //     foreach($Oremine as $oremineB) {

                //         if($oremine->Stockpile == $oremineB->Stockpile){

                //             $TonnesMined = $TonnesMined+$oremineB->DryTonFF;
                //             $Au = $Au+(($oremineB->Au)*($oremineB->DryTonFF));
                //             $Ag = $Ag+(($oremineB->Ag)*($oremineB->DryTonFF));

                //         }

                //     }

                //     if($TonnesMined == 0){
                //         $Au = 0;
                //         $Ag = 0;
                //     }else{
                //         $TonnesMined = round($TonnesMined,2);
                //         $Au = round($Au/$TonnesMined,2);
                //         $Ag = round($Ag/$TonnesMined,2);
                //         $AuEq75 = round(($Au+($Ag/75)),2);

                //         $v_Au = $v_Au + ($Au*$TonnesMined);
                //         $v_Ag = $v_Ag + ($Ag*$TonnesMined);



                //         if($AuEq75 >= 2){
                //             $RomMinedTonnes = $RomMinedTonnes + $TonnesMined;
                //             $RomMinedAu = $RomMinedAu + ($Au * $TonnesMined);
                //             $RomMinedAg = $RomMinedAg + ($Ag * $TonnesMined);

                //         }
                //         else{
                //             $MarginalTonnes = $MarginalTonnes + $TonnesMined;
                //             $MarginalAu = $MarginalAu + ($Au * $TonnesMined);
                //             $MarginalAg = $MarginalAg + ($Ag * $TonnesMined);
                //         }
                //     }
                    
                //      $this->excel->getActiveSheet()->setCellValue('C'.$row, $oremine->Stockpile);
                // $this->excel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($style_table);
                //     $this->excel->getActiveSheet()->setCellValue('D'.$row, $TonnesMined);
                // $this->excel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($style_table);
                //     $this->excel->getActiveSheet()->setCellValue('E'.$row, $Au);
                // $this->excel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($style_table);
                //     $this->excel->getActiveSheet()->setCellValue('F'.$row, $Ag);
                // $this->excel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($style_table);
                //     $this->excel->getActiveSheet()->setCellValue('G'.$row, $AuEq75);
                // $this->excel->getActiveSheet()->getStyle('G'.$row)->applyFromArray($style_table);
                //     $this->excel->getActiveSheet()->setCellValue('H'.$row, $oremine->Pit);
                // $this->excel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($style_table);
                                        
                //     $row++;
                // }

                $SumTon = $this->OreInventory_model->SumMined($date);
               

                if($SumTon==0){
                    $fix_Au = 0;
                    $fix_Ag = 0;
                }else{
                    $fix_Au = round(($v_Au)/$SumTon,2);
                    $fix_Ag = round(($v_Ag)/$SumTon,2);
                }
                

                    $this->excel->getActiveSheet()->setCellValue('C'.$row, 'Direct Feed to Crusher');
                $this->excel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('D'.$row, '-');
                $this->excel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('E'.$row, '-');
                $this->excel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('F'.$row, '-');
                $this->excel->getActiveSheet()->getStyle('F'.$row)->applyFromArray($style_table);
               
                

                $row0 = $row+1;
                    $this->excel->getActiveSheet()->setCellValue('C'.$row0, 'Total');
                $this->excel->getActiveSheet()->getStyle('C'.$row0)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('D'.$row0, $SumTon);
                $this->excel->getActiveSheet()->getStyle('D'.$row0)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('E'.$row0, $fix_Au);
                $this->excel->getActiveSheet()->getStyle('E'.$row0)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('F'.$row0, $fix_Ag);
                $this->excel->getActiveSheet()->getStyle('F'.$row0)->applyFromArray($style_subheader);

                // $RomMinedTonnes = 0;
                // $RomMinedAu = 0;
                // $RomMinedAg = 0;
                // foreach ($RomMined as $rommined) {
                //     $RomMinedTonnes = $RomMinedTonnes + $rommined->DryTonFF;
                //     $RomMinedAu = $RomMinedAu + ($rommined->Au * $rommined->DryTonFF);
                //     $RomMinedAg = $RomMinedAg + ($rommined->Ag * $rommined->DryTonFF);
                // }
                if($RomMinedTonnes == 0){
                    $v_Au = 0;
                    $v_Ag = 0;
                }
                else{
                    $v_Au = round(($RomMinedAu/$RomMinedTonnes),2);
                    $v_Ag = round(($RomMinedAg/$RomMinedTonnes),2);
                }
            
                $row1 = $row0+1;
                    $this->excel->getActiveSheet()->setCellValue('C'.$row1, 'ROM Mined');
                    $this->excel->getActiveSheet()->setCellValue('D'.$row1, $RomMinedTonnes);
                    $this->excel->getActiveSheet()->setCellValue('E'.$row1, $v_Au);
                    $this->excel->getActiveSheet()->setCellValue('F'.$row1, $v_Ag);
                $this->excel->getActiveSheet()->getStyle('C'.$row1)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('D'.$row1)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('E'.$row1)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('F'.$row1)->applyFromArray($style_subheader);

                // $MarginalTonnes = 0;
                // $MarginalAu = 0;
                // $MarginalAg = 0;

                // foreach ($Marginal as $marginal) {
                //     $MarginalTonnes = $MarginalTonnes + $marginal->DryTonFF;
                //     $MarginalAu = $MarginalAu + ($marginal->Au * $marginal->DryTonFF);
                //     $MarginalAg = $MarginalAg + ($marginal->Ag * $marginal->DryTonFF);
                // }

                if($MarginalTonnes == 0){
                    $v_Au = 0;
                    $v_Ag = 0;
                }
                else{
                    $v_Au = round(($MarginalAu/$MarginalTonnes),2);
                    $v_Ag = round(($MarginalAg/$MarginalTonnes),2);
                }

                 $row2 = $row1+1;
                    $this->excel->getActiveSheet()->setCellValue('C'.$row2, 'Marginal Mined');
                    $this->excel->getActiveSheet()->setCellValue('D'.$row2, $MarginalTonnes);
                    $this->excel->getActiveSheet()->setCellValue('E'.$row2, $v_Au);
                    $this->excel->getActiveSheet()->setCellValue('F'.$row2, $v_Ag);
                $this->excel->getActiveSheet()->getStyle('C'.$row2)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('D'.$row2)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('E'.$row2)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('F'.$row2)->applyFromArray($style_subheader);



                $rowA = $row2+4;
                    $this->excel->getActiveSheet()->setCellValue('A'.$rowA, 'RC Drilling Grade Control');
                    $this->excel->getActiveSheet()->mergeCells('A'.$rowA.':'.'B'.$rowA);
                $this->excel->getActiveSheet()->getStyle('A'.$rowA)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('B'.$rowA)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('C'.$rowA, 'Prospect');
                $this->excel->getActiveSheet()->getStyle('C'.$rowA)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('D'.$rowA, 'Drill');
                $this->excel->getActiveSheet()->getStyle('D'.$rowA)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('E'.$rowA, 'Total Hole');
                $this->excel->getActiveSheet()->getStyle('E'.$rowA)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('F'.$rowA, 'Total Sample');
                $this->excel->getActiveSheet()->getStyle('F'.$rowA)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('G'.$rowA, 'Location');
                $this->excel->getActiveSheet()->getStyle('G'.$rowA)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('H'.$rowA, 'Total Meter');
                $this->excel->getActiveSheet()->getStyle('H'.$rowA)->applyFromArray($style_subheader);

                $RCDrilling = $this->OtherSampling_model->getRCDrillingReport($date);

                $rowB = $rowA+1;
                $TotalHole2 =0;
                $TotalSample2 = 0;
                $TotalMeter2 = 0;
                foreach ($RCDrilling as $rcdrilling) {
                    
                    $Prospect = $rcdrilling->Prospect;
                    $Drill = $rcdrilling->Drill;
                    $TotalHole = $rcdrilling->TotalHole;
                    $TotalSample = $rcdrilling->TotalSample;
                    $Location = $rcdrilling->Location;
                    $TotalMeter = $rcdrilling->TotalMeter;
                    $TotalHole2 = $TotalHole2 + $TotalHole;
                    $TotalSample2 = $TotalSample2+$TotalSample;
                    $TotalMeter2 = $TotalMeter2+$TotalMeter;

                    $this->excel->getActiveSheet()->setCellValue('C'.$rowB, $Prospect);
                $this->excel->getActiveSheet()->getStyle('C'.$rowB)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('D'.$rowB, $Drill);
                $this->excel->getActiveSheet()->getStyle('D'.$rowB)->applyFromArray($style_table);
                        $this->excel->getActiveSheet()->setCellValue('E'.$rowB, $TotalHole);
                $this->excel->getActiveSheet()->getStyle('E'.$rowB)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('F'.$rowB, $TotalSample);
                $this->excel->getActiveSheet()->getStyle('F'.$rowB)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('G'.$rowB, $Location);
                $this->excel->getActiveSheet()->getStyle('G'.$rowB)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('H'.$rowB, $TotalMeter);
                $this->excel->getActiveSheet()->getStyle('H'.$rowB)->applyFromArray($style_table);
                $rowB++;
                }
                $rowC = $rowB;
                    $this->excel->getActiveSheet()->setCellValue('D'.$rowC, 'Total');
                $this->excel->getActiveSheet()->getStyle('D'.$rowC)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('E'.$rowC, $TotalHole2);
                $this->excel->getActiveSheet()->getStyle('E'.$rowC)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('F'.$rowC, $TotalSample2);
                $this->excel->getActiveSheet()->getStyle('F'.$rowC)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('G'.$rowC, '-');
                $this->excel->getActiveSheet()->getStyle('G'.$rowC)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('H'.$rowC, $TotalMeter2);
                $this->excel->getActiveSheet()->getStyle('H'.$rowC)->applyFromArray($style_table);


                $rowD = $rowC+3;
                    $this->excel->getActiveSheet()->setCellValue('A'.$rowD, 'Other Daily Sampling');
                    $this->excel->getActiveSheet()->mergeCells('A'.$rowD.':'.'B'.$rowD);
                $this->excel->getActiveSheet()->getStyle('A'.$rowD)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('B'.$rowD)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('C'.$rowD, 'Grab Sample(GS)');
                $this->excel->getActiveSheet()->getStyle('C'.$rowD)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('D'.$rowD, 'Face Sample(FS)');
                $this->excel->getActiveSheet()->getStyle('D'.$rowD)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('E'.$rowD, 'Stockpile Sample(ST&MS)');
                $this->excel->getActiveSheet()->getStyle('E'.$rowD)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('F'.$rowD, 'Acid Sample(GA)');
                $this->excel->getActiveSheet()->getStyle('F'.$rowD)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('G'.$rowD, 'Auger Sample(AS)');
                $this->excel->getActiveSheet()->getStyle('G'.$rowD)->applyFromArray($style_subheader);

                $GrabSample = $this->OtherSampling_model->GetGrabSampleReport($date);
                $TotalGS =0;
                foreach ($GrabSample as $gs) {
                    $TotalGS = $gs->TotalSample;
                }

                $StockpileSample = $this->OtherSampling_model->GetStockpileSampleReport($date);
                $TotalSS = 0;
                foreach ($StockpileSample as $ss) {
                    $TotalSS = $ss->TotalSample;
                }

                $FaceSample = $this->OtherSampling_model->getFaceSampleReport($date);
                $TotalFS=0;
                foreach ($FaceSample as $fs) {
                    $TotalFS = $fs->TotalSample;
                }

                $AcidSample = $this->OtherSampling_model->getAcidSampleReport($date);
                $TotalAS = 0;
                foreach ($AcidSample as $as) {
                    $TotalAS = $as->TotalSample;
                }

                $AugerSample = $this->OtherSampling_model->getAugerSampleReport($date);
                $TotalAuger = 0;
                foreach ($AugerSample as $aug) {
                    $TotalAuger = $aug->TotalSample;
                }



                $rowE = $rowD+1;
                for($i=0; $i<1;$i++){
                    $this->excel->getActiveSheet()->setCellValue('C'.$rowE, $TotalGS);
                $this->excel->getActiveSheet()->getStyle('C'.$rowE)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('D'.$rowE, $TotalFS);
                $this->excel->getActiveSheet()->getStyle('D'.$rowE)->applyFromArray($style_table);
                        $this->excel->getActiveSheet()->setCellValue('E'.$rowE, $TotalSS);
                $this->excel->getActiveSheet()->getStyle('E'.$rowE)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('F'.$rowE, $TotalAS);
                $this->excel->getActiveSheet()->getStyle('F'.$rowE)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('G'.$rowE, $TotalAuger);
                $this->excel->getActiveSheet()->getStyle('G'.$rowE)->applyFromArray($style_table);
                $rowD++;
                }


                 $row3 = $rowD+3;
                    $this->excel->getActiveSheet()->setCellValue('A'.$row3, 'Stock Status');
                    $this->excel->getActiveSheet()->mergeCells('A'.$row3.':'.'B'.$row3);
                $this->excel->getActiveSheet()->getStyle('A'.$row3)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('B'.$row3)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('C'.$row3, 'DAILY');
                    $this->excel->getActiveSheet()->mergeCells('C'.$row3.':'.'H'.$row3);
                $this->excel->getActiveSheet()->getStyle('C'.$row3)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('D'.$row3)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('E'.$row3)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('F'.$row3)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('G'.$row3)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('H'.$row3)->applyFromArray($style_subheader);



                $row4 = $row3+1;
                    $this->excel->getActiveSheet()->setCellValue('C'.$row4, 'Stockpile');
                $this->excel->getActiveSheet()->getStyle('C'.$row4)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('D'.$row4, 'Volume');
                $this->excel->getActiveSheet()->getStyle('D'.$row4)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('E'.$row4, 'Dry Ton');
                $this->excel->getActiveSheet()->getStyle('E'.$row4)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('F'.$row4, 'Au(g/t)');
                $this->excel->getActiveSheet()->getStyle('F'.$row4)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('G'.$row4, 'Ag(g/t)');
                $this->excel->getActiveSheet()->getStyle('G'.$row4)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('H'.$row4, 'AuEq75(g/t)');
                $this->excel->getActiveSheet()->getStyle('H'.$row4)->applyFromArray($style_subheader);

                $row5 = $row4+1;
               
                foreach ($ListStockpile as $ls) {
                    $ToStockpileStatus = $this->Stockpile_model->GetStockpileByDateandStockpileReport($date,$ls->id);

                    if($ToStockpileStatus != null){
                        foreach ($ToStockpileStatus as $stockstatus) {

                        $this->excel->getActiveSheet()->setCellValue('C'.$row5, $stockstatus->Stockpile);
                $this->excel->getActiveSheet()->getStyle('C'.$row5)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('D'.$row5, round($stockstatus->Volume,0));
                $this->excel->getActiveSheet()->getStyle('D'.$row5)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('E'.$row5, round($stockstatus->Tonnes,0));
                $this->excel->getActiveSheet()->getStyle('E'.$row5)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('F'.$row5, round($stockstatus->Au,2));
                $this->excel->getActiveSheet()->getStyle('F'.$row5)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('G'.$row5, round($stockstatus->Ag,2));
                $this->excel->getActiveSheet()->getStyle('G'.$row5)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('H'.$row5, round($stockstatus->AuEq75,2));
                $this->excel->getActiveSheet()->getStyle('H'.$row5)->applyFromArray($style_table);
                $row5++;
                    }


                    }
                    else{
                        $this->excel->getActiveSheet()->setCellValue('C'.$row5, $ls->Nama);
                $this->excel->getActiveSheet()->getStyle('C'.$row5)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('D'.$row5, '-');
                $this->excel->getActiveSheet()->getStyle('D'.$row5)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('E'.$row5, '-');
                $this->excel->getActiveSheet()->getStyle('E'.$row5)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('F'.$row5, '-');
                $this->excel->getActiveSheet()->getStyle('F'.$row5)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('G'.$row5, '-');
                $this->excel->getActiveSheet()->getStyle('G'.$row5)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('H'.$row5, '-');
                $this->excel->getActiveSheet()->getStyle('H'.$row5)->applyFromArray($style_table);
                $row5++;
                    }

                }

                    
                                        
                    
                

                $row6 = $row5+2;
                    $this->excel->getActiveSheet()->setCellValue('C'.$row6, 'Today Blending Plan');
                    $this->excel->getActiveSheet()->mergeCells('C'.$row6.':'.'G'.$row6);
                $this->excel->getActiveSheet()->getStyle('C'.$row6)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('D'.$row6)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('E'.$row6)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('F'.$row6)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('G'.$row6)->applyFromArray($style_subheader);

                $row7 = $row6+1;
                    $this->excel->getActiveSheet()->setCellValue('C'.$row7, 'Blending');
                    $this->excel->getActiveSheet()->mergeCells('C'.$row7.':'.'D'.$row7);
                $this->excel->getActiveSheet()->getStyle('C'.$row7)->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('D'.$row7)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('E'.$row7, 'Au(g/t)');
                $this->excel->getActiveSheet()->getStyle('E'.$row7)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('F'.$row7, 'Ag(g/t)');
                $this->excel->getActiveSheet()->getStyle('F'.$row7)->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('G'.$row7, 'AuEq75(g/t)');
                $this->excel->getActiveSheet()->getStyle('G'.$row7)->applyFromArray($style_subheader);


                $row8 = $row7+1;
                for($i=0; $i<2;$i++){
                    $this->excel->getActiveSheet()->setCellValue('C'.$row8, '-');
                    $this->excel->getActiveSheet()->mergeCells('C'.$row8.':'.'D'.$row8);
                $this->excel->getActiveSheet()->getStyle('C'.$row8)->applyFromArray($style_table);
                $this->excel->getActiveSheet()->getStyle('D'.$row8)->applyFromArray($style_table);
                        $this->excel->getActiveSheet()->setCellValue('E'.$row8, '-');
                $this->excel->getActiveSheet()->getStyle('E'.$row8)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('F'.$row8, '-');
                $this->excel->getActiveSheet()->getStyle('F'.$row8)->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('G'.$row8, '-');
                $this->excel->getActiveSheet()->getStyle('G'.$row8)->applyFromArray($style_table);
                
                $row8++;
                }

                $TonnesOpenOremine =0;
                $AuOpenOremine =0;
                $AgOpenOremine=0;
               

                foreach ($OpeningstockOremine as $openingoremine) {
                    $TonnesOpenOremine = $TonnesOpenOremine + $openingoremine->DryTonFF;
                   
                    $AuOpenOremine = $AuOpenOremine + (($openingoremine->DryTonFF)*($openingoremine->Au));
                    $AgOpenOremine = $AgOpenOremine + (($openingoremine->DryTonFF)*($openingoremine->Ag));
                }
                   

                if($TonnesOpenOremine == 0){
                    $AuOpenOremineFix = 0;
                    $AgOpenOremineFix = 0; 

                }else{
                    $TonnesOpenOremine = round($TonnesOpenOremine,0);
                    $AuOpenOremineFix = round(($AuOpenOremine/$TonnesOpenOremine),2);
                    $AgOpenOremineFix = round(($AgOpenOremine/$TonnesOpenOremine),2); 
                }

              


                $TonnesOpenOrefeed =0;
                $AuOpenOrefeed =0;
                $AgOpenOrefeed =0;
               

                foreach ($OpeningstockOrefeed as $openingorefeed) {
                    $TonnesOpenOrefeed = $TonnesOpenOrefeed + $openingorefeed->Tonnestocrush;
                    $AuOpenOrefeed = $AuOpenOrefeed + (($openingorefeed->DryTonFF)*($openingorefeed->Au));
                    $AgOpenOrefeed = $AgOpenOrefeed + (($openingorefeed->DryTonFF)*($openingorefeed->Ag));
                }

                if($TonnesOpenOrefeed == 0){
                    $AuOpenOrefeedFix = 0;
                    $AgOpenOrefeedFix = 0; 

                }else{
                    $TonnesOpenOrefeed = round($TonnesOpenOrefeed,0);
                    $AuOpenOrefeedFix = round(($AuOpenOrefeed/$TonnesOpenOrefeed),2);
                    $AgOpenOrefeedFix = round(($AgOpenOrefeed/$TonnesOpenOrefeed),2); 
                }


                //Opening Stock
                $TonnesOpenOremineOld =0;
                $AuOpenOremineOld =0;
                $AgOpenOremineOld=0;
                $TonnesOpenOremineFixOld =0;
               

                foreach ($OpeningstockOremineOld as $openingoremineOld) {
                    $TonnesOpenOremineOld = $TonnesOpenOremineOld + $openingoremineOld->DryTonFF;
                    $AuOpenOremineOld = $AuOpenOremineOld + (($openingoremineOld->DryTonFF)*($openingoremineOld->Au));
                    $AgOpenOremineOld = $AgOpenOremineOld + (($openingoremineOld->DryTonFF)*($openingoremineOld->Ag));
                }

                if($TonnesOpenOremineOld == 0){
                    $AuOpenOremineFixOld = 0;
                    $AgOpenOremineFixOld = 0; 

                }else{
                    $TonnesOpenOremineOld = round($TonnesOpenOremineOld,0);
                    $AuOpenOremineFixOld = round(($AuOpenOremineOld/$TonnesOpenOremineOld),2);
                    $AgOpenOremineFixOld = round(($AgOpenOremineOld/$TonnesOpenOremineOld),2); 
                }


                $TonnesOpenOrefeedOld =0;
                $AuOpenOrefeedOld =0;
                $AgOpenOrefeedOld =0;
                $TonnesOpenOrefeedFixOld =0;
               

                foreach ($OpeningstockOreFeedOld as $openingorefeedOld) {
                    $TonnesOpenOrefeedOld = $TonnesOpenOrefeedOld + $openingorefeedOld->Tonnestocrush;
                    $AuOpenOrefeedOld = $AuOpenOrefeedOld + (($openingorefeedOld->DryTonFF)*($openingorefeedOld->Au));
                    $AgOpenOrefeedOld = $AgOpenOrefeedOld + (($openingorefeedOld->DryTonFF)*($openingorefeedOld->Ag));
                }

                if($TonnesOpenOrefeedOld == 0){
                    $AuOpenOrefeedFixOld = 0;
                    $AgOpenOrefeedFixOld = 0; 

                }else{
                    $TonnesOpenOrefeedOld = round($TonnesOpenOrefeedOld,0);
                    $AuOpenOrefeedFixOld = round(($AuOpenOrefeedOld/$TonnesOpenOrefeedOld),2);
                    $AgOpenOrefeedFixOld = round(($AgOpenOrefeedOld/$TonnesOpenOrefeedOld),2); 
                }

              
                

                $Tonnes =0;
                $Au =0;
                $Ag=0;
                foreach ($Closingstock as $closingstock) {
                    $Tonnes = $Tonnes+$closingstock->Tonnes;
                    $Ag = $Ag+(($closingstock->Ag)*($closingstock->Tonnes));
                    $Au = $Au+(($closingstock->Au)*($closingstock->Tonnes));
                }

                    $this->excel->getActiveSheet()->setCellValue('J4', 'ROM Pad Stockpile');
                    $this->excel->getActiveSheet()->mergeCells('J4:K4');
                $this->excel->getActiveSheet()->getStyle('J4')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('K4')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('L4', 'Dry Ton');
                $this->excel->getActiveSheet()->getStyle('L4')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('M4', 'Au(g/t)');
                $this->excel->getActiveSheet()->getStyle('M4')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('N4', 'Ag(g/t)');
                $this->excel->getActiveSheet()->getStyle('N4')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('J5', 'Opening Stock');
                    $this->excel->getActiveSheet()->mergeCells('J5:K5');
                $this->excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('J6', 'Closing Stock');
                    $this->excel->getActiveSheet()->mergeCells('J6:K6');
                $this->excel->getActiveSheet()->getStyle('J6')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('K6')->applyFromArray($style_subheader);


                $TonnesOpen = ((($TonnesOpenOremineOld-$TonnesOpenOrefeedOld) + ($TonnesOpenOremine)) - ($TonnesOpenOrefeed));

               

                 if($TonnesOpen == 0){
                    $AuRompadOpen =0;
                    $AgRompadOpen =0;
                 }else{

                    $TonnesOpen = round($TonnesOpen,0);
                    $AuRompadOpen = round((((($AuOpenOremineFixOld * $TonnesOpenOremineFixOld) - ($AuOpenOrefeedFixOld * $TonnesOpenOrefeedFixOld)) + (($AuOpenOremineFix * $TonnesOpenOremine) - ($AuOpenOrefeedFix * $TonnesOpenOrefeed)))/$TonnesOpen),2);

                    $AgRompadOpen = round((((($AgOpenOremineFixOld * $TonnesOpenOremineFixOld) - ($AgOpenOrefeedFixOld * $TonnesOpenOrefeedFixOld)) + (($AgOpenOremineFix * $TonnesOpenOremine) - ($AgOpenOrefeedFix * $TonnesOpenOrefeed)))/$TonnesOpen),2);
                 }

                 //Closing Stock Rompad
                 foreach ($ClosingstockOremine as $closingstockoremine) {
                     $TonnesClosingstockormine = $TonnesClosingstockormine + $closingstockoremine->DryTonFF;
                     $AuClosingstockoremine = $AuClosingstockoremine + ($closingstockoremine->Au * $closingstockoremine->DryTonFF);
                     $AgClosingstockoremine = $AgClosingstockoremine + ($closingstockoremine->Au * $closingstockoremine->DryTonFF);
                 }

                 if($TonnesClosingstockormine == 0){
                    $AuClosingstockoremine = 0;
                    $AgClosingstockoremine = 0;
                 }
                 else{
                    $TonnesClosingstockormine = round($TonnesClosingstockormine,2);
                    $AuClosingstockoremine = round(($AuClosingstockoremine/$TonnesClosingstockormine),2);
                    $AgClosingstockoremine = round(($AgClosingstockoremine/$TonnesClosingstockormine),2);
                 }



                 foreach ($ClosingstockOrefeed as $closingstockorefeed) {
                     $TonnesClosingstockorefeed = $TonnesClosingstockorefeed + $closingstockorefeed->Tonnestocrush;
                     $AuClosingstockoremine = $AuClosingstockoremine + ($closingstockoremine->Au * $closingstockoremine->DryTonFF);
                     $AgClosingstockoremine = $AgClosingstockoremine + ($closingstockoremine->Au * $closingstockoremine->DryTonFF);
                 }

                 if($TonnesClosingstockorefeed == 0){
                    $AuClosingstockorefeed = 0;
                    $AgClosingstockorefeed = 0;
                 }
                 else{
                    $TonnesClosingstockorefeed = round($TonnesClosingstockorefeed,2);
                    $AuClosingstockorefeed = round(($AuClosingstockorefeed/$TonnesClosingstockorefeed),2);
                    $AgClosingstockorefeed = round(($AgClosingstockorefeed/$TonnesClosingstockorefeed),2);
                 }

                 $Tonnes = ($TonnesOpen + $TonnesClosingstockormine) - $TonnesClosingstockorefeed;


                            if($Tonnes == 0){
                                $AuRompad =0;
                                $AgRompad =0;
                                $Tonnes =0;
                            }
                            else{
                                $Tonnes = round($Tonnes,0);
                                $AuRompad = round(((($AuRompadOpen*$TonnesOpen)+($AuClosingstockoremine*$TonnesClosingstockormine)-($AuClosingstockorefeed*$TonnesClosingstockorefeed))/$Tonnes),2);

                                $AgRompad = round(((($AgRompadOpen*$TonnesOpen)+($AgClosingstockoremine*$TonnesClosingstockormine)-($AgClosingstockorefeed*$TonnesClosingstockorefeed))/$Tonnes),2);
                            }


                    $this->excel->getActiveSheet()->setCellValue('L5', $TonnesOpen);
                $this->excel->getActiveSheet()->getStyle('L5')->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('L6', $Tonnes);
                $this->excel->getActiveSheet()->getStyle('L6')->applyFromArray($style_table);

                $this->excel->getActiveSheet()->setCellValue('M5', $AuRompadOpen);
                $this->excel->getActiveSheet()->getStyle('M5')->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('N5', $AgRompadOpen);
                $this->excel->getActiveSheet()->getStyle('N5')->applyFromArray($style_table);


                    $this->excel->getActiveSheet()->setCellValue('M6', $AuRompad);
                $this->excel->getActiveSheet()->getStyle('M6')->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('N6', $AgRompad);
                $this->excel->getActiveSheet()->getStyle('N6')->applyFromArray($style_table);

                $TonnesFeed =0;
                $AuFeed =0;
                $AgFeed =0;
                foreach ($Orefeedtocrusher as $key) {
                    $TonnesFeed = $TonnesFeed+(($key->Tonnestocrush)+ floatval($key->Act));
                    $AuFeed = $AuFeed + (($key->AdjAu)*($key->Tonnestocrush));
                    $AgFeed = $AgFeed + (($key->AdjAg)*($key->Tonnestocrush));

                }

                if($TonnesFeed == 0){
                    $AuFeedRompad = 0;
                    $AgFeedRompad = 0;
                }
                else{
                        $TonnesFeed = round($TonnesFeed,0);
                        $AuFeedRompad = round(($AuFeed/$TonnesFeed),2);
                        $AgFeedRompad = round(($AgFeed/$TonnesFeed),2);
                }

                

                $this->excel->getActiveSheet()->setCellValue('J8', 'Ore Feed to Crusher');
                    $this->excel->getActiveSheet()->mergeCells('J8:K8');
                $this->excel->getActiveSheet()->getStyle('J8')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('K8')->applyFromArray($style_subheader);
                 $this->excel->getActiveSheet()->setCellValue('J9', 'Feed Material(%)');
                    $this->excel->getActiveSheet()->mergeCells('J9:K9');
                $this->excel->getActiveSheet()->getStyle('J9')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('K9')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('L8', $TonnesFeed);
                $this->excel->getActiveSheet()->getStyle('L8')->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('M8', $AuFeedRompad);
                $this->excel->getActiveSheet()->getStyle('M8')->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('N8', $AgFeedRompad);
                $this->excel->getActiveSheet()->getStyle('N8')->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('L9', 'Fresh');
                $this->excel->getActiveSheet()->getStyle('L9')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('L10', 'Transition');
                $this->excel->getActiveSheet()->getStyle('L10')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('L11', 'Clay');
                $this->excel->getActiveSheet()->getStyle('L11')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('M9', $PersenFresh);
                $this->excel->getActiveSheet()->getStyle('M9')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('M10', $PersenTransition);
                $this->excel->getActiveSheet()->getStyle('M10')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('M11', $PersenClay);
                $this->excel->getActiveSheet()->getStyle('M11')->applyFromArray($style_table);

                $TonnesScat=0;
                $AuScat =0;
                $AgScat=0;
                $Scat = $this->ClosingStock_model->GetScatTonnes($date);
                foreach ($Scat as $scat) {
                    $TonnesScat = $TonnesScat+$scat->Tonnes;
                    $AuScat = $AuScat+(($scat->Au)*($scat->Tonnes));
                    $AgScat = $AgScat+(($scat->Ag)*($scat->Tonnes));
                }

                if($TonnesScat == 0){
                    $AuScatFix = 0;
                    $AgScatFix = 0;
                }
                else{
                    $AuScatFix = round(($AuScat/$TonnesScat),2);
                    $AgScatFix = round(($AgScat/$TonnesScat),2);
                }
              

                $Bypass = $this->Orefeed_model->GetBypassTonnes($date);
                $TonnesBypass=0;
                $AuBypass =0;
                $AgBypass=0;
                foreach ($Bypass as $bypass) {
                    $TonnesBypass = $TonnesBypass+$bypass->Tonnestocrush;
                    $AuBypass = $AuBypass+(($bypass->Au)*($bypass->Tonnestocrush));
                    $AgBypass = $AgBypass+(($bypass->Ag)*($bypass->Tonnestocrush));
                }

                if($TonnesBypass == 0){
                    $AuByPassFix = 0;
                    $AgByPassFix = 0;
                }
                else{
                    $AuByPassFix = round(($AuByPass/$TonnesBypass),2);
                    $AgByPassFix = round(($AgByPass/$TonnesBypass),2);
                }

                
                $TonnesBoulder=0;
                $AuBoulder =0;
                $AgBoulder=0;
                $Boulder = $this->ClosingStock_model->GetBoulderTonnes($date);
               
                foreach ($Boulder as $boulder) {
                    $TonnesBoulder = $TonnesBoulder+$boulder->Tonnes;
                    $AuBoulder = $AuBoulder+(($boulder->Au)*($boulder->Tonnes));
                    $AgBoulder = $AgBoulder+(($boulder->Ag)*($boulder->Tonnes));
                }

                if($TonnesBoulder == 0){
                    $AuBoulderFix = 0;
                    $AgBoulderFix = 0;
                }
                else{
                    $AuBoulderFix = round(($AuBoulder/$TonnesBoulder),2);
                    $AgBoulderFix = round(($AgBoulder/$TonnesBoulder),2);
                }


                $ActualMilling = round($TonnesFeed+$TonnesScat+$TonnesBoulder,0);
                $ActualAu = round((($AuFeed+$AuScat+$AuBoulder)/$ActualMilling),2);
                $ActualAg = round((($AgFeed+$AgScat+$AgBoulder)/$ActualMilling),2);

                $this->excel->getActiveSheet()->setCellValue('J13', 'Actual Milling');
                    $this->excel->getActiveSheet()->mergeCells('J13:K13');
                $this->excel->getActiveSheet()->getStyle('J13')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('K13')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('L13', $ActualMilling);
                $this->excel->getActiveSheet()->getStyle('L13')->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('M13', $ActualAu);
                $this->excel->getActiveSheet()->getStyle('M13')->applyFromArray($style_table);
                    $this->excel->getActiveSheet()->setCellValue('N13', $ActualAg);
                $this->excel->getActiveSheet()->getStyle('N13')->applyFromArray($style_table);

                $this->excel->getActiveSheet()->setCellValue('J14', 'Scat Feed');
                    $this->excel->getActiveSheet()->mergeCells('J14:K14');
                $this->excel->getActiveSheet()->getStyle('J14')->applyFromArray($style_table);
                $this->excel->getActiveSheet()->getStyle('K14')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('L14', round($TonnesScat,0));
                $this->excel->getActiveSheet()->getStyle('L14')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('M14', $AuScatFix);
                $this->excel->getActiveSheet()->getStyle('M14')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('N14', $AgScatFix);
                $this->excel->getActiveSheet()->getStyle('N14')->applyFromArray($style_table);

                 $this->excel->getActiveSheet()->setCellValue('J15', 'CV04 MG Feed');
                    $this->excel->getActiveSheet()->mergeCells('J15:K15');
                $this->excel->getActiveSheet()->getStyle('J15')->applyFromArray($style_table);
                $this->excel->getActiveSheet()->getStyle('K15')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('L15', '-');
                $this->excel->getActiveSheet()->getStyle('L15')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('M15', '-');
                $this->excel->getActiveSheet()->getStyle('M15')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('N15', '-');
                $this->excel->getActiveSheet()->getStyle('N15')->applyFromArray($style_table);
    
                 $this->excel->getActiveSheet()->setCellValue('J16', 'CV04 LG Feed');
                    $this->excel->getActiveSheet()->mergeCells('J16:K16');
                $this->excel->getActiveSheet()->getStyle('J16')->applyFromArray($style_table);
                $this->excel->getActiveSheet()->getStyle('K16')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('L16', '-');
                $this->excel->getActiveSheet()->getStyle('L16')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('M16', '-');
                $this->excel->getActiveSheet()->getStyle('M16')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('N16', '-');
                $this->excel->getActiveSheet()->getStyle('N16')->applyFromArray($style_table);

                    $this->excel->getActiveSheet()->setCellValue('J17', 'CV04 HG Feed');
                    $this->excel->getActiveSheet()->mergeCells('J17:K17');
                $this->excel->getActiveSheet()->getStyle('J17')->applyFromArray($style_table);
                $this->excel->getActiveSheet()->getStyle('K17')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('L17', '-');
                $this->excel->getActiveSheet()->getStyle('L17')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('M17', '-');
                $this->excel->getActiveSheet()->getStyle('M17')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('N17', '-');
                $this->excel->getActiveSheet()->getStyle('N17')->applyFromArray($style_table);

                    $this->excel->getActiveSheet()->setCellValue('J18', 'Boulder Feed');
                    $this->excel->getActiveSheet()->mergeCells('J18:K18');
                $this->excel->getActiveSheet()->getStyle('J18')->applyFromArray($style_table);
                $this->excel->getActiveSheet()->getStyle('K18')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('L18', round($TonnesBoulder,0));
                $this->excel->getActiveSheet()->getStyle('L18')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('M18', $AuBoulderFix);
                $this->excel->getActiveSheet()->getStyle('M18')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('N18', $AgBoulderFix);
                $this->excel->getActiveSheet()->getStyle('N18')->applyFromArray($style_table);



                    $this->excel->getActiveSheet()->setCellValue('J20', 'Stockpile');
                    $this->excel->getActiveSheet()->mergeCells('J20:K20');
                $this->excel->getActiveSheet()->getStyle('J20')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('K20')->applyFromArray($style_subheader);
                    $this->excel->getActiveSheet()->setCellValue('L20', 'ByPass CV04 Stockpile');
                    $this->excel->getActiveSheet()->mergeCells('L20:N20');
                $this->excel->getActiveSheet()->getStyle('L20')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('M20')->applyFromArray($style_subheader);
                $this->excel->getActiveSheet()->getStyle('N20')->applyFromArray($style_subheader);

                
                    $this->excel->getActiveSheet()->setCellValue('J21', 'CV04 LG');
                    $this->excel->getActiveSheet()->mergeCells('J21:K21');
                $this->excel->getActiveSheet()->getStyle('J21')->applyFromArray($style_table);
                $this->excel->getActiveSheet()->getStyle('K21')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('L21', '-');
                $this->excel->getActiveSheet()->getStyle('L21')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('M21', '-');
                $this->excel->getActiveSheet()->getStyle('M21')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('N21', '-');
                $this->excel->getActiveSheet()->getStyle('N21')->applyFromArray($style_table);

                    $this->excel->getActiveSheet()->setCellValue('J22', 'CV04 MG');
                    $this->excel->getActiveSheet()->mergeCells('J22:K22');
                $this->excel->getActiveSheet()->getStyle('J22')->applyFromArray($style_table);
                $this->excel->getActiveSheet()->getStyle('K22')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('L22', '-');
                $this->excel->getActiveSheet()->getStyle('L22')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('M22', '-');
                $this->excel->getActiveSheet()->getStyle('M22')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('N22', '-');
                $this->excel->getActiveSheet()->getStyle('N22')->applyFromArray($style_table);

                    $this->excel->getActiveSheet()->setCellValue('J23', 'CV04 HG');
                    $this->excel->getActiveSheet()->mergeCells('J23:K23');
                $this->excel->getActiveSheet()->getStyle('J23')->applyFromArray($style_table);
                $this->excel->getActiveSheet()->getStyle('K23')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('L23', '-');
                $this->excel->getActiveSheet()->getStyle('L23')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('M23', '-');
                $this->excel->getActiveSheet()->getStyle('M23')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('N23', '-');
                $this->excel->getActiveSheet()->getStyle('N23')->applyFromArray($style_table);

                    $this->excel->getActiveSheet()->setCellValue('J24', 'Boulder Feed');
                    $this->excel->getActiveSheet()->mergeCells('J24:K24');
                $this->excel->getActiveSheet()->getStyle('J24')->applyFromArray($style_table);
                $this->excel->getActiveSheet()->getStyle('K24')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('L24', '-');
                $this->excel->getActiveSheet()->getStyle('L24')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('M24', '-');
                $this->excel->getActiveSheet()->getStyle('M24')->applyFromArray($style_table);
                   $this->excel->getActiveSheet()->setCellValue('N24', '-');
                $this->excel->getActiveSheet()->getStyle('N24')->applyFromArray($style_table);


                $this->excel->getActiveSheet()->setTitle('Daily Report');
                $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
                $this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);

                // Set Orientation, size and scaling
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
                $this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
                $this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
                $this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
                $this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
                $this->excel->getActiveSheet()->getSheetView()->setZoomScale(80);

                $now = date('Y-m-d');
                $nama = 'ReportGC_New_'.$date;
                $filename=$nama.'.xlsx';

                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache

                $objWriter = IOFactory::createWriter($this->excel, 'Excel2007');
                ob_end_clean();
                $objWriter->save('php://output');

    }
        else {
            redirect(base_url());
        }
    }

}
?>
