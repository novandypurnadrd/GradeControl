<div id="menubar" class="menubar-inverse ">
  <div class="menubar-fixed-panel">
    <div>
      <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
        <i class="fa fa-bars"></i>
      </a>
    </div>
    <div class="expanded">
      <a href="<?php echo base_url().'Dashboard' ;?>">
        <span class="text-lg text-bold text-primary ">MATERIAL&nbsp;ADMIN</span>
      </a>
    </div>
  </div>
  <div class="menubar-scroll-panel">

    <!-- BEGIN MAIN MENU -->
    <ul id="main-menu" class="gui-controls">

      <!-- BEGIN DASHBOARD -->
      <li>
        <?php if($main == "Dashboard"){?>
          <a href="<?php echo base_url().'Dashboard' ;?>" class="active">
          <?php }
          else { ?>
          <a href="<?php echo base_url().'Dashboard' ;?>" class="">
        <?php } ?>
          <div class="gui-icon"><i class="md md-home"></i></div>
          <span class="title">Dashboard</span>
        </a>
      </li><!--end /menu-li -->
      <!-- END DASHBOARD -->

      <!-- BEGIN ORELINE -->
      <li class="gui-folder">
        <a>
          <div class="gui-icon"><i class="md md-assignment-returned"></i></div>
          <span class="title">Ore Inventory</span>
        </a>
        <!--start submenu -->
        <ul>
          <?php if($main == "ImportOreline"){?>
            <li><a href="<?php echo base_url().'Oreline/Import' ;?>"  class="active"><span class="title">Import CSV</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'Oreline/Import' ;?>" ><span class="title">Import CSV</span></a></li>
          <?php } ?>
          <?php if($main == "Oreline"){?>
            <li><a href="<?php echo base_url().'Oreline/Table' ;?>"  class="active"><span class="title">Record</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'Oreline/Table' ;?>" ><span class="title">Record</span></a></li>
          <?php } ?>
        </ul><!--end /submenu -->
      </li><!--end /menu-li -->
      <!-- END ORELINE -->

      <!-- BEGIN ORE INVENTORY -->
      <li class="gui-folder">
        <a>
          <div class="gui-icon"><i class="md md-description"></i></div>
          <span class="title">Oreline & Oremined</span>
        </a>
        <!--start submenu -->
        <ul>
          <?php if($main == "InputOreInventory"){?>
            <li><a href="<?php echo base_url().'OreInventory/Input' ;?>"  class="active"><span class="title">Input Oreline Oremined</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'OreInventory/Input' ;?>" ><span class="title">Input Oreline Oremined</span></a></li>
          <?php } ?>
          <?php if($main == "OreInventory"){?>
            <li><a href="<?php echo base_url().'OreInventory/Table' ;?>"  class="active"><span class="title">Daily Record</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'OreInventory/Table' ;?>" ><span class="title">Daily Record</span></a></li>
          <?php } ?>
           <?php if($main == "OreInventoryGeneral"){?>
            <li><a href="<?php echo base_url().'OreInventory/Table/IndexTableGeneral' ;?>" class="active"><span class="title">General Ore Record</span></a></li>
            <?php }
            else { ?>
            
            <li><a href="<?php echo base_url().'OreInventory/Table/IndexTableGeneral' ;?>" ><span class="title">General Ore Record</span></a></li>
          <?php } ?>
           <?php if($main == "OreInventoryGeneralVisual"){?>
            <li><a href="<?php echo base_url().'OreInventory/Table/IndexTableGeneralVisual' ;?>" class="active"><span class="title">General Minerlized Waste Record</span></a></li>
            <?php }
            else { ?>
            
            <li><a href="<?php echo base_url().'OreInventory/Table/IndexTableGeneralVisual' ;?>" ><span class="title">General Mineralized Waste Record</span></a></li>
          <?php } ?>
        </ul><!--end /submenu -->
      </li><!--end /menu-li -->
      <!-- END ORE INVENTORY -->


      <!-- BEGIN STOCKPILE -->
      <li class="gui-folder">
        <a>
          <div class="gui-icon"><i class="md md-settings-input-composite"></i></div>
          <span class="title">Stockpile</span>
        </a>
        <!--start submenu -->
        <ul>
          <?php if($main == "ToStockpile"){?>
            <li><a href="<?php echo base_url().'Oremined/ToStockpile' ;?>"  class="active"><span class="title">Stockpile Record</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'Oremined/ToStockpile' ;?>" ><span class="title">Stockpile Record</span></a></li>
          <?php } ?>
          <?php if($main == "Stockpile"){?>
            <li><a href="<?php echo base_url().'References/Stockpile' ;?>"  class="active"><span class="title">Stockpile List</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'References/Stockpile' ;?>" ><span class="title">Stockpile List</span></a></li>
          <?php } ?>
        </ul><!--end /submenu -->
      </li><!--end /menu-li -->
      <!-- END STOCKPILE -->

      <!-- BEGIN OreFeed -->
      <li class="gui-folder">
        <a>
          <div class="gui-icon"><i class="md md-group-work"></i></div>
          <span class="title">Ore Feed</span>
        </a>
        <!--start submenu -->
        <ul>
          <?php if($main == "InputOreFeed"){?>
            <li><a href="<?php echo base_url().'OreFeed/Input' ;?>"  class="active"><span class="title">Input Ore Feed</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'OreFeed/Input' ;?>" ><span class="title">Input Ore Feed</span></a></li>
          <?php } ?>
          <?php if($main == "Ore Feed"){?>
            <li><a href="<?php echo base_url().'OreFeed/Table' ;?>"  class="active"><span class="title">Record Ore Feed</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'OreFeed/Table' ;?>" ><span class="title">Record Ore Feed</span></a></li>
          <?php } ?>
        </ul><!--end /submenu -->
      </li><!--end /menu-li -->
      <!-- END OREFEED -->

        <!-- BEGIN CLOSING STOCK -->
      <li class="gui-folder">
        <a>
          <div class="gui-icon"><i class="md md-assignment-turned-in"></i></div>
          <span class="title">Closing Stock</span>
        </a>
        <!--start submenu -->
        <ul>

         <?php if($main == "Scat"){?>
            <li><a href="<?php echo base_url().'Closingstock/Scat' ;?>"  class="active"><span class="title">Scat</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'Closingstock/Scat' ;?>" ><span class="title">Scat</span></a></li>
          <?php } ?>
           <?php if($main == "Boulder"){?>
            <li><a href="<?php echo base_url().'Closingstock/Boulder' ;?>"  class="active"><span class="title">Boulder</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'Closingstock/Boulder' ;?>" ><span class="title">Boulder</span></a></li>
          <?php } ?>
          <?php if($main == "Closingstock"){?>
            <li><a href="<?php echo base_url().'Closingstock/Table' ;?>"  class="active"><span class="title">Closing Stock Record</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'Closingstock/Table' ;?>" ><span class="title">Closing Stock Record</span></a></li>
          <?php } ?>
        </ul><!--end /submenu -->
      </li><!--end /menu-li -->
      <!-- END CLOSINGSTOCK -->

      <!-- BEGIN OTHER SAMPLING -->
      <li class="gui-folder">
        <a>
          <div class="gui-icon"><i class="md md-web"></i></div>
          <span class="title">Other Daily Sampling</span>
        </a>
        <!--start submenu -->
        <ul>

         <?php if($main == "Grab Sample"){?>
            <li><a href="<?php echo base_url().'OtherSampling/GrabSample' ;?>"  class="active"><span class="title">Grab Sample</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'OtherSampling/GrabSample' ;?>" ><span class="title">Grab Sample</span></a></li>
          <?php } ?>
          <?php if($main == "Face Sample"){?>
            <li><a href="<?php echo base_url().'OtherSampling/FaceSample' ;?>"  class="active"><span class="title">Face Sample</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'OtherSampling/FaceSample' ;?>" ><span class="title">Face Sample</span></a></li>
          <?php } ?>
           <?php if($main == "Stockpile Sample"){?>
            <li><a href="<?php echo base_url().'OtherSampling/StockpileSample' ;?>"  class="active"><span class="title">Stockpile Sample</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'OtherSampling/StockpileSample' ;?>" ><span class="title">Stockpile Sample</span></a></li>
          <?php } ?>
           <?php if($main == "Acid Sample"){?>
            <li><a href="<?php echo base_url().'OtherSampling/AcidSample' ;?>"  class="active"><span class="title">Acid Sample</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'OtherSampling/AcidSample' ;?>" ><span class="title">Acid Sample</span></a></li>
          <?php } ?>
           <?php if($main == "Auger Sample"){?>
            <li><a href="<?php echo base_url().'OtherSampling/AugerSample' ;?>"  class="active"><span class="title">Auger Sample</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'OtherSampling/AugerSample' ;?>" ><span class="title">Auger Sample</span></a></li>
          <?php } ?>
          <?php if($main == "RC Drilling"){?>
            <li><a href="<?php echo base_url().'OtherSampling/RCDrilling' ;?>"  class="active"><span class="title">RC Drilling</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'OtherSampling/RCDrilling' ;?>" ><span class="title">RC Drilling</span></a></li>
          <?php } ?>
        </ul><!--end /submenu -->
      </li><!--end /menu-li -->
      <!-- END OREMINED -->

      <!-- BEGIN REFERENCES -->
      <li class="gui-folder">
        <a>
          <div class="gui-icon"><i class="md md-album"></i></div>
          <span class="title">References</span>
        </a>
        <!--start submenu -->
        <ul>
          <?php if($main == "Pit"){?>
            <li><a href="<?php echo base_url().'References/Pit' ;?>"  class="active"><span class="title">Pit</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'References/Pit' ;?>" ><span class="title">Pit</span></a></li>
          <?php } ?>
          <?php if($main == "Loader"){?>
            <li><a href="<?php echo base_url().'References/Loader' ;?>"  class="active"><span class="title">Loader</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'References/Loader' ;?>" ><span class="title">Loader</span></a></li>
          <?php } ?>
          <?php if($main == "Prospect"){?>
            <li><a href="<?php echo base_url().'References/Prospect' ;?>"  class="active"><span class="title">Prospect</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'References/Prospect' ;?>" ><span class="title">Prospect</span></a></li>
          <?php } ?>
           <?php if($main == "Location"){?>
            <li><a href="<?php echo base_url().'References/Location' ;?>"  class="active"><span class="title">Location</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'References/Location' ;?>" ><span class="title">Location</span></a></li>
          <?php } ?>
        </ul><!--end /submenu -->
      <!-- END REFERENCES -->

        <!-- BEGIN REFERENCES -->
      <li class="gui-folder">
        <a>
          <div class="gui-icon"><i class="md md-print"></i></div>
          <span class="title">Report</span>
        </a>
        <!--start submenu -->
        <ul>
          <?php if($main == "DailyReport"){?>
            <li><a href="<?php echo base_url().'Report/DailyReport' ;?>"  class="active"><span class="title">Daily Report</span></a></li>
            <?php }
            else { ?>
            <li><a href="<?php echo base_url().'Report/DailyReport' ;?>" ><span class="title">Daily Report</span></a></li>
          <?php } ?>
        </ul><!--end /submenu -->
      <!-- END REFERENCES -->


    </ul><!--end .main-menu -->
    <!-- END MAIN MENU -->

    <div class="menubar-foot-panel">
      <small class="no-linebreak hidden-folded">
        <span class="opacity-75">Copyright &copy; 2017</span> <strong>IT (Sect) PT.KBK</strong>
      </small>
    </div>
  </div><!--end .menubar-scroll-panel-->
</div><!--end #menubar-->
