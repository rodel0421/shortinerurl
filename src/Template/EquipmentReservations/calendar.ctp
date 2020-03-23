<?php $this->assign('title', 'Equipment Reservations - Calendar');?>

        <div class="row">
            <div class="col-md-3">
                <div class='box'>
    <div class='box-header'>
        <h3 class='box-title'><i class="fa fa-fighter-jet" aria-hidden="true"></i> Equipment Reservations</h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>', 
            ['action' => 'add','back'=>$this->request->here],['escape'=>false,'class'=>'btn btn-default','title'=>'Add Reservation']) ?>
        
      </div>
      </div>
    </div>
    <div class='box-body'>
        <h3>Filter Calendar</h3>
                <?= 
                 $this->Form->input('Equipment.equipment_type_id',array(
                    'class'=>'search', 'label' => 'Type',
                    'div' => false, 'required'=>false,
                    'options'=>$equipmentTypes,'empty'=>true
                    ))?>
                <?= 
                 $this->Form->input('Equipment.title',array(
                    'class'=>'search', 'label' => 'Equipment',
                    'div' => false, 
                    'required'=>false,
                    'type'=>'text'
                    ))?>
        <?= 
                 $this->Form->input('Equipment.department_id',array(
                    'class'=>'search',
                    'div' => false, 'required'=>false,
                    'options'=>$departments,'empty'=>true
                    ))?>
                    <?php if(($isAdmin || $isOfficer)):?>
                <?= 
                 $this->Form->input('Users.name',array(
                    'class'=>'search', 'label' => 'User',
                    'div' => false, 
                    'required'=>false,
                    'type'=>'text'
                    ))?><?php endif;?>
                    <?= 
                 $this->Form->input('EquipmentReservations.approved',array(
                    'class'=>'search', 'label' => 'Status',
                    'style'=>'width:150px;',
                    'div' => false, 'required'=>false,
                    'options'=>['1'=>'Approved','0'=>'Not Approved','isnull'=>'Pending'],'empty'=>true
                    ))?>
                </div>
    <div class='box-footer'>
        <b>Colour Index</b><br/>
        <span class="label label-success">Approved Reservation</span><br/>
        <span class="label label-warning">Pending Approval</span><br/>
        <span class="label label-danger">Not Approved</span><br/>
</div>
</div>
</div>
<div class="col-md-9">
    <div class="box box-primary">
        <div class="box-body">
          <!-- THE CALENDAR -->
          <div id="calendar"></div>
        </div>
        <!-- /.box-body -->
      </div>
</div>
</div>

<script type="text/javascript"> 
//<![CDTA[
// define as global
  var calendar;
$(document).ready(function(){
    calendar = $('#calendar').fullCalendar({
            header: {
                    left: 'today',
                    center: 'title',
                    right: 'prev,next'
            },
            eventDataTransform: function( eventData ) {
               
                //Fix display end date if full day event only
                if(eventData.allDay){
                    eventData.end = moment(eventData.end).add(1, 'day').format();
                }
                
                if(eventData.approved === true){
                    eventData.className = 'label label-success';
                }else if(eventData.approved === false){
                    eventData.className = 'label label-danger';
                }else{
                    eventData.className = 'label label-warning';
                }
                
                
                eventData.url = '<?= $this->Url->build(['controller'=>'EquipmentReservations','action'=>'view'])?>/'+eventData.id+'/?back=<?= $this->Url->build(['controller'=>'EquipmentReservations','action'=>'calendar'], ['fullBase' => true])?>';
                
                return eventData;
            },
            eventClick: function(event) {
                if (event.url) {
                    var $url = event.url;
                    $('#previewModel-body').html('<img style="display: block; margin-left: auto; margin-right: auto" src="<?php echo $this->Url->build('/img/ajax_indicator.gif');?>"/>');

                    var $title = 'Equipment Reservation';
                    if($(this).attr('title')){
                        $title = $(this).attr('title');
                    }
                    $('#previewModelLabel').html($title);
                    $('#previewModel').modal();

                    $.ajax({
                        url     : $url,
                        type    : 'get',
                        success : function (response) {
                            $('#previewModel-body').html( response );
                        }
                    });
                    return false;
                }
            },
            eventSources: [
               "<?php
               $query = $this->request->query();
               
               echo $this->Url->build(['controller'=>'EquipmentReservations','action'=>'feed','_ext'=>'json','?'=>$query],['escape' => false]);?>"
            ]
        });
        
});

/*eventDataTransform: function( eventData ) {
                console.log(eventData);
                return eventData.events;
            },
            allDayDefault: true,
            eventLimit: true, // allow "more" link when too many events*/

//]]>
</script>