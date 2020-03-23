<div class='box'>
    <div class='box-header'><h3 class='box-title'>
        <i class="fa fa-cubes" aria-hidden="true"></i> <?= $this->request->query('archived')?'Deleted':''?> Register Templates</h3>
    	<div class="box-tools pull-right">
    	<div class="btn-group">
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>', 
            ['action' => 'add'],['escape'=>false,'class'=>'btn btn-default','title'=>'Add']) ?>
        
        <?php if($this->request->query('archived')){
            echo $this->Form->hidden('archived',['value'=>1,'class'=>'search','id'=>'archived']);
            echo $this->Html->link('<i class="fa fa fa-bars" aria-hidden="true"></i>', 
                ['action' => 'index'],['escape'=>false,'class'=>'btn btn-default','title'=>'Show All']);
        }else{
            echo $this->Html->link('<i class="fa fa-trash-o" aria-hidden="true"></i>', 
                ['action' => 'index','archived'=>1],['escape'=>false,'class'=>'btn btn-default','title'=>'Show Deleted']);
        }?>
      </div>
      </div>
    </div>
    <div class='box-body'>
    <div class="table-responsive">
        <table class="table table-striped table-hover dbclick2open">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('form_type') ?></th>
                <th><?= $this->Paginator->sort('order') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <tr>
                <th><?= 
                 $this->Form->input('RegisterTemplates.name',array(
                    'class'=>'search', 'label' => false,
                    'div' => false, 
                    'required'=>false,
                    'type'=>'text'
                    ))?></th>
                <th><?= 
                 $this->Form->input('RegisterTemplates.form_type',array(
                    'class'=>'search', 'label' => false,
                    'div' => false, 
                    'required'=>false,
                    'type'=>'text'
                    ))?></th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody class='connectedSortable'>
        <?php foreach ($registerTemplates as $registerTemplate): ?>
            <tr data-id="<?= $registerTemplate->id?>" id="<?= $registerTemplate->id?>">
                <td><?= h($registerTemplate->name) ?></td>
                <td><?= h($registerTemplate->form_type) ?></td>
                <td class="reorder"><i class='fa fa-reorder' title='Reorder'></i></td>
                <td><?= h($registerTemplate->created) ?></td>
                <td><?= h($registerTemplate->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span class="glyphicon glyphicon-zoom-in"></span><span class="sr-only">' . __('View') . '</span>', ['action' => 'view', $registerTemplate->id], ['escape' => false, 'class' => 'btn btn-xs btn-success', 'title' => __('View')]) ?>
                    <?php if(!$registerTemplate->active):?>
                    <?= $this->Form->postLink('<span class="fa fa-undo"></span><span class="sr-only">' . __('Restore') 
                        . '</span>', ['action' => 'delete', $registerTemplate->id], 
                        ['confirm' => __('Are you sure you want to restore this?'), 'escape' => false, 
                                        'class' => 'btn btn-xs btn-info', 'title' => __('Restore')]) ?>
                <?php endif;?>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
        </table>
    </div>
    </div>
    <div class='box-footer'>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
</div>
<script type="text/javascript"> 
//<![CDTA[

$(document).ready(function(){
    $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.reorder',
    forcePlaceholderSize: true,
    zIndex              : 999999,
    stop: function( event, ui ) {
        var id = ui.item.attr('id');
        var order = ui.item.index() + 1;
        if(id){
            var url = "<?= $this->Url->build(['action'=>'reorder']) ?>/" + id +"?order="+ order;
            $.get( url, function( data ) {
            //alert( "Load was performed." );
            });
        }
        
    }
  });
  $('.connectedSortable .reorder').css('cursor', 'move');
  
});

//]]>
</script>