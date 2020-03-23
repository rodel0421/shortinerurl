<div class="box box-primary">
    <div class="box-header">
    <div class='row'>
<div class='col-sm-6 col-xs-12'>
    <?= $this->Form->input('Users.name',array(
        'class'=>'search', 'label' => false,
        'required'=>false,
        'div' => false, 
        'type'=>'text',
        'placeholder'=>'Search Name ...'
    ))?>
</div>

<div class='col-sm-6 col-xs-12'>
    <?= $this->Form->input('register_template_id',array(
        'class'=>'search select3', 
        'label' => false,
        'div' => false, 
        'required'=>false,
        'options'=>$registerTemplates,
        'empty'=>'Any Register...'
    ));?>
</div>
</div>
    </div>
    <div class="box-body">
    <ul class="products-list product-list-in-box">
        <?php foreach ($users as $user): 
            $avatar = 'profile.jpg';
            if(!empty($user->profile_url)){
                $avatar = $user->profile_url;
                $this->Dak->allow_file($avatar);
            }
            ?>
        
                <li class="item">
                    <?php echo $this->Html->image($avatar,
                        array('class'=>'direct-chat-img'));?>
                    <div class="product-info">
                    <a href="<?php if($isOfficer || $isAdmin){
                        echo $this->Url->build(['controller'=>'Users','action'=>'view',$user->id]);
                    }else{
                        echo 'javascript:void(0)';
                    }
                        ?>" class="product-title"><?= h($user->name) ?>
                        </a>
                      <span class="pull-right">
                        <?= $this->Dak->displayStatus($user->register_status) ?>
                        <?= $this->Dak->displayStatus($user->certification_status) ?>
                        <?= $this->Dak->displayStatus($user->equipment_status) ?></span>
                        
                    <span class="product-description">
                            <?php foreach($user->registers as $register):
                                $title = $register->register_template->name;
                                $title .= ': '.$register->register_class->title;
                                $title .= ' - '.$this->Dak->getStatus($register->cert_status);
                                $class = 'inline_icon status_'.$register->cert_status;
                                ?>
                                <?= ($register->register_class->icon)? $this->Html->image($register->register_class->icon,
                                    ['class'=>$class,'title'=>$title,'data-toggle'=>'tooltip']) : $title ?>
                            <?php endforeach;?>
                        </span>
                  </div>
                </li>
        <?php endforeach; ?>
        </ul>
    </div>
    <div class='box-body'>
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
    $('.select3').selectize();
    //document.body.requestFullscreen();
});


//]]>
</script>