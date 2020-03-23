
<div class='box box-solid box-primary'>
    <div class='box-header'><h3 class='box-title'>
        <?= ($dashboardItem->title) ? h($dashboardItem->title):  __('Pending Certifications')  ?>
</h3>
    	<div class="box-tools pull-right">
    	<?= $this->Html->link('<span class="glyphicon glyphicon-list"></span><span class="sr-only">' . __('List') 
                 		. '</span>', ['controller'=>'Certifications','action'=>'index','filter'=>1,'Certifications[valid]'=>0], 
                 		['escape' => false, 'class' => 'btn btn-default', 'title' => __('List')]) ?>
      </div>
    </div>
    <div class='box-body dashboardModule'>
    <ul class="products-list product-list-in-box">
        <?php 
        $count = $users->count();
        
        $show = 5;
        $i = 1;
        foreach ($users as $user): ?>
        <?php 
        $avatar = 'profile.jpg';
        if(!empty($user->profile_url)){
            $avatar = $user->profile_url;
            $this->Dak->allow_file($avatar);
        }

        ?>
        <li class="item">
          <div class="product-img">
            <?php echo $this->Html->image($avatar);?>
          </div>
          <div class="product-info">
              
            <a href="<?= $this->Url->build(['controller'=>'Users','action'=>'view',$user->id])?>" class="product-title"><?= $user->name?>
              <span class="label label-warning pull-right"><?= $user->count ?></span></a>
              
                <span class="product-description"></span>
          </div>
        </li>
        <?php 
            if($i++ >= $show) break;
        endforeach; ?>
    </ul>
</div>

    <div class="box-footer text-center">
        <?php if($count > $show):?>
    <?= $this->Html->link(($count-$show).' more',['controller'=>'Certifications','action'=>'index','filter'=>1,'Certifications[valid]'=>0])?>
        <?php endif;?>&nbsp;
    </div>

</div>
