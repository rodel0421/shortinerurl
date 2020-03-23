<?php $this->assign('title', 'User Search Results');?>
<?= $this->Html->css('tarosearch.css')?>

<!-- content -->

<section class="banner">
    <div class="machine-search p-4 bg-white">
        <?= $this->Form->create(null, [ 'url' => ['controller' => 'Users', 'action' => 'search'], 'type' => 'GET']); ?>
            <div class="input-group">
                <?= $this->Form->text('search', [ 'placeholder' => "Search By Person", 'class' => ["form-control"], 'value' => $value]) ?>
                <div class="input-group-append">
                    <?= $this->Form->button('Search', ['class' => ['btn','btn-warning', 'font-weight-bold'], 'type' => 'submit' ]) ?>
                </div>
            </div>
        <?= $this->Form->end(); ?>	
    </div>		
</section>

<section class="result-section mb-3">
    <div class="container">
        <h3 class="header-title">
            SEARCH RESULTS
        </h3>
        <div class="results-container">
            <?php if($users): ?>
                <?php foreach($users as $index=>$user):?>
                    <?php
                        $avatar = 'img/profile.jpg';
                        if(!empty($user->profile_url)){
                            $avatar = $user['profile_url'];
                        }
                    ?>
                    <div class="position-relative result mt-3">
                        <?= $this->Html->image(
                            $avatar, 
                            [
                                'class' => ['position-absolute'], 
                                'width' => '75', 
                                'height' => '75', 
                                'url' => ['controller' => 'Users', 'action' => 'view', $user->id],
                                'pathPrefix' => ''
                            ]) ?>
                        <h4 class="font-weight-bold text-capitalize mb-0 text-body"><?= $this->Html->link(__($user->name), ['controller' => 'Users', 'action' => 'view', $user->id], ['class' => ['text-dark']]) ?></h4>
                        <small class="text-muted">@<?= $user->username ?></small>
                    </div>
                <?php endforeach;?>
            <?php else :?>
                <h2 class="text-danger">
                    No matches for search!
                </h2>
            <?php endif;?>
        </div>
        
    </div>
</section>