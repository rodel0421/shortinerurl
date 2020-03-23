<?php if(isset($facilityList) && count($facilityList) > 1):?>
<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
    
    <i class="fa fa-building-o" title='<?php 
      if(isset($currentFacility_id) && isset($facilityList[$currentFacility_id])){
          echo $facilityList[$currentFacility_id];
      }else{
          echo "Select Facility";
      }
?>'></i>
    </a>
    <ul class="dropdown-menu">
              <li class="header">Select your Facility</li>
              <li>
                <ul class="menu">
                    <?php foreach ($facilityList as $id => $name): 
                        if(isset($facilityABV[$id])):?>
                  <li class='<?= (isset($currentFacility_id) && $currentFacility_id==$id)?'active':''?>'><?= $this->Html->link($name, '/site/'.$facilityABV[$id]) ?></li>
                  <?php 
                  endif;
                  endforeach; ?>
                </ul>
              </li>
    </ul>
</li>
<?php endif;?>