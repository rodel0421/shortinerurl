<?php
/*
$output = [];
foreach($equipmentReservations as $equipmentReservation){
    
    if(isset($event['state']) && $event['state'] == 'repeat'){
        $event['className'] = 'label label-info';
        $output[] = $event;
    }else{
        $label = isset($status_classes[$event->state])?$status_classes[$event->state]:'label label-primary';
        $output[] = array_merge($event->toArray(),[
            'className'=>$label,
            'url'=>$this->Url->build(['action'=>'preview',$event->id])
            ]);
    }
}
*/
echo json_encode($events);