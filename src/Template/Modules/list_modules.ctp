<?php $this->assign('title', 'Search By Machine Results');?>
<?= $this->Html->css('tarosearch.css')?>


<!-- content -->

<section class="banner">
    <div class="machine-search p-4 bg-white">
        <?=
            $this->Form->create(null, [
                'url' => [
                    'controller' => 'Student',
                    'action' => 'search'
                ]
            ]);
        ?>
        <?= $this->Form->hidden('searchMethod', ['value' => 'person']);?>
        <div class="input-group">
                <?= $this->Form->text('searchValue',
                [ 
                    'placeholder' => "Search By Modules",
                    'class' => ["form-control"] 
                ]) ?>
            <div class="input-group-append">
                <?= $this->Form->button('Search', [
                    'class' => ['btn','btn-warning'],
                    'type' => 'submit'
                ]) ?>
            </div>
        </div>
        <?= $this->Form->end(); ?>
    </div>		
</section>

<section class="result-section">
    <div class="container">
        <h3 class="header-title">
            List Modules
        </h3>
        <div class="results-container">
            <?php if($modules): ?>
                <?php foreach ($modules as $module): ?>
                    <div class="search-result">
                        <div class="card mb-3">
                            <div class="no-gutters">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold"> <?= $this->Html->link(__($module->header), ['controller' => 'Modules', 'action' => 'viewModules',$module->id]) ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else :?>
                <h2 class="text-danger">
                    No matches for search!
                </h2>
            <?php endif;?>
        </div>
        </section>