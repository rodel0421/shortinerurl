


<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <?php foreach($dashboards as $id => $title):?>
        <li class="<?= $id == $dashboard->id?'active':''?>"><?= $this->Html->link($title,['action'=>'view',$id]);?></li>
        <?php endforeach;?>
      
      
      <li class="pull-right">
          <?= $this->Html->link('<i class="fa fa-plus"></i>', ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Create Dashboard']) ?></li>
      <li class="pull-right">      <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span><span class="sr-only">' . __('Edit Dashboard') 
                 		. '</span>', ['action' => 'edit', $dashboard->id], 
                 		['escape' => false, 'class' => 'btn btn-warning', 'title' => __('Edit Dashboard')]) ?>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active">
            <div class="row connectedSortable">
    <?php foreach ($dashboard->dashboard_items as $dashboardItems): ?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="<?= $dashboardItems->id?>"><?= $this->cell('Dashboard::'.$dashboardItems->name,[$dashboardItems,$currentFacility_id])?></div>
    <?php endforeach; ?>
</div>
        </div>
    </div>
</div>



<script type="text/javascript"> 
//<![CDTA[

$(document).ready(function(){
    $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.box-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999,
    stop: function( event, ui ) {
        var id = ui.item.attr('id');
        var order = ui.item.index() + 1;
        if(id){
            var url = "<?= $this->Url->build(['controller'=>'DashboardItems','action'=>'reorder']) ?>/" + id +"?order="+ order;
            $.get( url, function( data ) {
            //alert( "Load was performed." );
            });
        }
        
    }
  });
  $('.connectedSortable .box-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');
  
});

//]]>
</script>