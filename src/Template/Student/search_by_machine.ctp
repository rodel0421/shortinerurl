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
        <?= $this->Form->hidden('searchMethod', ['value' => 'machine']);?>
        <div class="input-group">
                <?= $this->Form->text('searchValue',
                [ 
                    'placeholder' => "Search By Machine",
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
            SEARCH RESULTS
        </h3>
        <div class="results-container">
            <?php if($results): ?>
                <?php foreach($results as $index=>$result):?>
                    <div class="search-result">
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-3 py-3 pl-3">
                                    <?= $this->Html->image($result['img'],
                                        [
                                            "class" => ["card-img", "w-100"]
                                        ]
                                    ) ?>
                                </div>
                                <div class="col-md-9">
                                <div class="card-body" id=<?= $result['machine_name'].'-parent'?>>
                                    <h5 class="card-title font-weight-bold text-warning"><?= $result['machine_name'] ?></h5>
                                    <p class="card-text"><?= $result['description'] ?></p>
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target=<?= '#'.$result['machine_name'].'-div'?> aria-expanded="true" aria-controls="collapseOne"> View Passers > </button>
                                    <div class="passers-div collapse" id=<?= $result['machine_name'].'-div'?> data-parent=<?= '#'.$result['machine_name'].'-parent'?>>
                                        <?php if($result['passers']): ?>
                                            <table class="table">
                                                <tbody>
                                                    <?php foreach($result['passers'] as $passer):?>
                                                        <tr>
                                                            <td width="5%">
                                                                <?= $this->Html->image($passer['profile_picture'],
                                                                    [
                                                                        "class" => ["td-icon"]
                                                                    ]
                                                                ) ?>
                                                            </td>
                                                            <td>
                                                                <?= $passer['name']?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        <?php else:?>
                                            <h5 class="text-danger">
                                                No one has passed this yet!.
                                            </h5>
                                        <?php endif;?>
                                    </div>
                                </div>
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
        
    </div>
</section>